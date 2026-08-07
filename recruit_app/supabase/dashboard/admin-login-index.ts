import { createClient } from "npm:@supabase/supabase-js@2";

const ADMIN_SESSION_TTL_SECONDS = 8 * 60 * 60;
const MAX_LOGIN_FAILURES = 5;
const LOGIN_WINDOW_MINUTES = 15;

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token, x-admin-session",
  "Access-Control-Allow-Methods": "POST, OPTIONS"
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
  if (typeof error === "object" && error !== null) {
    return JSON.stringify(error);
  }
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
    userAgent: request.headers.get("user-agent") || null,
    attemptKey: ipAddress
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

async function isLoginRateLimited(
  supabase: ReturnType<typeof createClient>,
  attemptKey: string
) {
  const since = new Date(Date.now() - LOGIN_WINDOW_MINUTES * 60 * 1000).toISOString();
  const { count, error } = await supabase
    .from("admin_login_attempts")
    .select("id", { count: "exact", head: true })
    .eq("attempt_key", attemptKey)
    .eq("success", false)
    .gte("created_at", since);

  if (error) {
    console.warn("admin login rate limit check failed", error);
    return false;
  }

  return Number(count || 0) >= MAX_LOGIN_FAILURES;
}

async function recordLoginAttempt(
  supabase: ReturnType<typeof createClient>,
  attemptKey: string,
  success: boolean
) {
  const { error } = await supabase.from("admin_login_attempts").insert({
    attempt_key: attemptKey,
    success
  });

  if (error) console.warn("admin login attempt insert failed", error);
}

async function clearFailedLoginAttempts(
  supabase: ReturnType<typeof createClient>,
  attemptKey: string
) {
  const { error } = await supabase
    .from("admin_login_attempts")
    .delete()
    .eq("attempt_key", attemptKey)
    .eq("success", false);

  if (error) console.warn("admin login attempts cleanup failed", error);
}

function base64UrlEncodeBytes(bytes: ArrayBuffer | Uint8Array) {
  const array = bytes instanceof Uint8Array ? bytes : new Uint8Array(bytes);
  let binary = "";
  array.forEach((byte) => {
    binary += String.fromCharCode(byte);
  });
  return btoa(binary).replaceAll("+", "-").replaceAll("/", "_").replace(/=+$/, "");
}

function base64UrlEncodeText(value: string) {
  return base64UrlEncodeBytes(new TextEncoder().encode(value));
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

async function signPayload(payload: string, secret: string) {
  const key = await importSessionKey(secret, ["sign"]);
  const signature = await crypto.subtle.sign("HMAC", key, new TextEncoder().encode(payload));
  return base64UrlEncodeBytes(signature);
}

function hasValidPassword(password: string) {
  const requiredPassword = Deno.env.get("ADMIN_LOGIN_PASSWORD");
  if (!requiredPassword) {
    throw new Error("ADMIN_LOGIN_PASSWORD is required");
  }
  return password === requiredPassword;
}

async function createAdminSessionToken() {
  const secret = Deno.env.get("ADMIN_SESSION_SECRET");
  if (!secret) throw new Error("ADMIN_SESSION_SECRET is required");

  const now = Date.now();
  const payload = base64UrlEncodeText(
    JSON.stringify({
      purpose: "admin",
      iat: now,
      exp: now + ADMIN_SESSION_TTL_SECONDS * 1000,
      nonce: crypto.randomUUID()
    })
  );

  return {
    sessionToken: `${payload}.${await signPayload(payload, secret)}`,
    expiresInSeconds: ADMIN_SESSION_TTL_SECONDS
  };
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const supabase = getSupabaseClient();
    const { attemptKey } = getAdminClientInfo(request);
    const body = await request.json().catch(() => ({}));
    const password = String(body?.password || "");

    if (await isLoginRateLimited(supabase, attemptKey)) {
      await insertAdminAuditLog(supabase, request, "admin_login_rate_limited", {
        success: false,
        metadata: { windowMinutes: LOGIN_WINDOW_MINUTES, maxFailures: MAX_LOGIN_FAILURES }
      });
      return jsonResponse({ error: "Too many login attempts" }, 429);
    }

    if (!hasValidPassword(password)) {
      await recordLoginAttempt(supabase, attemptKey, false);
      await insertAdminAuditLog(supabase, request, "admin_login_failed", {
        success: false
      });
      return jsonResponse({ error: "Unauthorized" }, 401);
    }

    await recordLoginAttempt(supabase, attemptKey, true);
    await clearFailedLoginAttempts(supabase, attemptKey);
    await insertAdminAuditLog(supabase, request, "admin_login_success");

    return jsonResponse(await createAdminSessionToken());
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
