import { createClient } from "npm:@supabase/supabase-js@2";

const allowedEvents = new Set([
  "lp_view",
  "diagnosis_start",
  "diagnosis_complete",
  "line_button_click",
  "line_login_success",
  "line_friend_added",
  "result_sent"
]);

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
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

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    if (!allowedEvents.has(body.eventName)) {
      return jsonResponse({ error: "Unknown event" }, 400);
    }

    const supabase = getSupabaseClient();
    const userAgent = request.headers.get("user-agent") || null;
    const { error } = await supabase.from("diagnosis_events").insert({
      event_name: body.eventName,
      diagnosis_id: body.diagnosisId || null,
      line_user_id: body.lineUserId || null,
      payload: body.payload || {},
      user_agent: userAgent
    });

    if (error) throw error;

    return jsonResponse({ ok: true });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
