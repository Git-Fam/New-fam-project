import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-admin-token, x-admin-session",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS"
};

function jsonResponse(body: unknown, status = 200) {
  return new Response(JSON.stringify(body), {
    status,
    headers: {
      ...corsHeaders,
      "Content-Type": "application/json"
    }
  });
}

function errorMessage(error: unknown) {
  if (error instanceof Error) return error.message;
  if (typeof error === "object" && error !== null) return JSON.stringify(error);
  return String(error);
}

function getSupabaseClient() {
  const secretKeys = Deno.env.get("SUPABASE_SECRET_KEYS");
  const legacyServiceRoleKey = Deno.env.get("SUPABASE_SERVICE_ROLE_KEY");
  const serviceRoleKey = secretKeys ? JSON.parse(secretKeys).default : legacyServiceRoleKey;
  const supabaseUrl = Deno.env.get("SUPABASE_URL");

  if (!supabaseUrl || !serviceRoleKey) {
    throw new Error("SUPABASE_URL and service role key are required");
  }

  return createClient(supabaseUrl, serviceRoleKey, {
    auth: { persistSession: false }
  });
}

function getAdminClientInfo(request: Request) {
  const forwardedFor = request.headers.get("x-forwarded-for") || "";
  const ipAddress =
    forwardedFor.split(",")[0]?.trim() ||
    request.headers.get("cf-connecting-ip") ||
    request.headers.get("x-real-ip") ||
    "unknown";

  return {
    ipAddress,
    userAgent: request.headers.get("user-agent") || null
  };
}

async function insertAdminAuditLog(
  supabase: ReturnType<typeof createClient>,
  request: Request,
  eventName: string,
  options: { success?: boolean; metadata?: Record<string, unknown> } = {}
) {
  const clientInfo = getAdminClientInfo(request);
  const { error } = await supabase.from("admin_audit_logs").insert({
    event_name: eventName,
    success: options.success !== false,
    metadata: options.metadata || {},
    ip_address: clientInfo.ipAddress,
    user_agent: clientInfo.userAgent
  });

  if (error) console.warn("admin audit insert failed", error);
}

function base64UrlDecodeBytes(value: string) {
  const normalized = value.replaceAll("-", "+").replaceAll("_", "/");
  const padded = normalized.padEnd(Math.ceil(normalized.length / 4) * 4, "=");
  const binary = atob(padded);
  return Uint8Array.from(binary, (char) => char.charCodeAt(0));
}

function base64UrlDecodeText(value: string) {
  return new TextDecoder().decode(base64UrlDecodeBytes(value));
}

async function importSessionKey(secret: string, usage: KeyUsage[]) {
  return crypto.subtle.importKey(
    "raw",
    new TextEncoder().encode(secret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    usage
  );
}

async function verifyPayloadSignature(payload: string, signature: string, secret: string) {
  const key = await importSessionKey(secret, ["verify"]);
  return crypto.subtle.verify(
    "HMAC",
    key,
    base64UrlDecodeBytes(signature),
    new TextEncoder().encode(payload)
  );
}

async function hasValidAdminSession(request: Request) {
  const secret = Deno.env.get("ADMIN_SESSION_SECRET");
  if (!secret) return false;

  const token = request.headers.get("x-admin-session") || "";
  const parts = token.split(".");
  if (parts.length !== 2 || !parts[0] || !parts[1]) return false;

  try {
    const verified = await verifyPayloadSignature(parts[0], parts[1], secret);
    if (!verified) return false;

    const payload = JSON.parse(base64UrlDecodeText(parts[0]));
    return payload?.purpose === "admin" && Number(payload.exp || 0) > Date.now();
  } catch {
    return false;
  }
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (!(await hasValidAdminSession(request))) {
    return jsonResponse({ error: "Unauthorized" }, 401);
  }

  if (request.method !== "GET") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const requestUrl = new URL(request.url);
    const days = Math.max(1, Math.min(90, Number(requestUrl.searchParams.get("days") || 14)));
    const supabase = getSupabaseClient();

    await insertAdminAuditLog(supabase, request, "admin_kpi_view", {
      metadata: { days }
    });

    const { error: dropoffFinalizeError } = await supabase.rpc(
      "finalize_diagnosis_dropoffs",
      { abandoned_after: "00:30:00" }
    );
    if (dropoffFinalizeError) {
      console.warn("dropoff finalize failed", dropoffFinalizeError);
    }

    const { data: daily, error: dailyError } = await supabase
      .from("daily_kpi_summary")
      .select("*")
      .order("event_date", { ascending: false })
      .limit(days);
    if (dailyError) throw dailyError;

    const { data: weekly, error: weeklyError } = await supabase
      .from("weekly_kpi_summary")
      .select("*")
      .order("period_start", { ascending: false })
      .limit(12);
    if (weeklyError) throw weeklyError;

    const { data: monthly, error: monthlyError } = await supabase
      .from("monthly_kpi_summary")
      .select("*")
      .order("period_start", { ascending: false })
      .limit(13);
    if (monthlyError) throw monthlyError;

    const { data: resultTypes, error: resultTypesError } = await supabase
      .from("result_type_summary")
      .select("*")
      .limit(15);
    if (resultTypesError) throw resultTypesError;

    const { data: dropoffs, error: dropoffsError } = await supabase
      .from("dropoff_question_summary")
      .select("*")
      .limit(20);
    if (dropoffsError) throw dropoffsError;

    const { data: adminLogs, error: adminLogsError } = await supabase
      .from("admin_audit_logs")
      .select("event_name, success, metadata, ip_address, created_at")
      .order("created_at", { ascending: false })
      .limit(50);
    if (adminLogsError) {
      console.warn("admin audit logs select failed", adminLogsError);
    }

    return jsonResponse({
      daily: daily || [],
      weekly: weekly || [],
      monthly: monthly || [],
      resultTypes: resultTypes || [],
      dropoffs: dropoffs || [],
      adminLogs: adminLogsError ? [] : adminLogs || []
    });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
