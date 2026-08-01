/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

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
      expires_at: expiresAt,
      visitor_id: body.visitorId || null,
      session_id: body.sessionId || null,
      funnel_id: body.funnelId || null,
      result_type: body.resultType || null,
      utm_source: body.utmSource || null,
      utm_medium: body.utmMedium || null,
      utm_campaign: body.utmCampaign || null,
      device_type: body.deviceType || null,
      page_path: body.pagePath || null
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
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
