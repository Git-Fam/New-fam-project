import { createClient } from "npm:@supabase/supabase-js@2";

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

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    const diagnosisId = body.diagnosisId;
    const clientId = Deno.env.get("LINE_LOGIN_CHANNEL_ID");
    const redirectUri = Deno.env.get("LINE_REDIRECT_URI");

    if (!diagnosisId) return jsonResponse({ error: "diagnosisId is required" }, 400);
    if (!clientId || !redirectUri) {
      return jsonResponse(
        { error: "LINE_LOGIN_CHANNEL_ID and LINE_REDIRECT_URI are required" },
        500
      );
    }

    const supabase = getSupabaseClient();
    const state = crypto.randomUUID();
    const nonce = crypto.randomUUID();
    const expiresAt = new Date(Date.now() + 10 * 60 * 1000).toISOString();

    const { error } = await supabase.from("line_states").insert({
      state,
      diagnosis_id: diagnosisId,
      completion_url: body.appCompleteUrl || null,
      expires_at: expiresAt
    });
    if (error) throw error;

    const url = new URL("https://access.line.me/oauth2/v2.1/authorize");
    url.searchParams.set("response_type", "code");
    url.searchParams.set("client_id", clientId);
    url.searchParams.set("redirect_uri", redirectUri);
    url.searchParams.set("state", state);
    url.searchParams.set("scope", "profile openid");
    url.searchParams.set("nonce", nonce);
    url.searchParams.set("bot_prompt", Deno.env.get("LINE_BOT_PROMPT") || "aggressive");

    return jsonResponse({ authorizationUrl: url.toString(), expiresAt });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
