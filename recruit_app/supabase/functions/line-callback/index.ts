/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  redirectResponse
} from "../_shared/cors.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";
import {
  buildLineMessages,
  exchangeLineToken,
  fetchLineFriendshipStatus,
  fetchLineProfile,
  pushLineMessages
} from "../_shared/line.ts";

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  try {
    const requestUrl = new URL(request.url);
    const code = requestUrl.searchParams.get("code");
    const state = requestUrl.searchParams.get("state");
    const friendshipStatusChanged = requestUrl.searchParams.get("friendship_status_changed");
    const redirectUri = Deno.env.get("LINE_REDIRECT_URI");
    const appOrigin = Deno.env.get("APP_ORIGIN") || requestUrl.origin;

    if (!code || !state || !redirectUri) {
      return redirectResponse(`${appOrigin}/line-complete.html?status=error`);
    }

    const supabase = getSupabaseClient();
    const { data: lineState, error: stateError } = await supabase
      .from("line_states")
      .select("state, diagnosis_id, completion_url, expires_at, consumed_at")
      .eq("state", state)
      .single();

    if (stateError || !lineState || lineState.consumed_at) {
      return redirectResponse(`${appOrigin}/line-complete.html?status=invalid_state`);
    }

    if (new Date(lineState.expires_at).getTime() < Date.now()) {
      return redirectResponse(`${appOrigin}/line-complete.html?status=expired`);
    }

    const token = await exchangeLineToken(code, redirectUri);
    const profile = await fetchLineProfile(token.access_token);
    let friendFlag: boolean | null = null;
    try {
      friendFlag = (await fetchLineFriendshipStatus(token.access_token)).friendFlag;
    } catch (friendshipError) {
      console.warn("LINE friendship status fetch failed", friendshipError);
    }
    const diagnosisId = lineState.diagnosis_id;
    let lineConnectionId: string | null = null;

    try {
      const { data: lineConnection, error: lineConnectionError } = await supabase
        .from("line_connections")
        .insert({
          line_user_id: profile.userId,
          last_used_at: new Date().toISOString()
        })
        .select("id")
        .single();

      if (lineConnectionError) throw lineConnectionError;
      lineConnectionId = lineConnection?.id || null;
    } catch (lineConnectionError) {
      console.warn("line_connections insert failed", lineConnectionError);
    }

    await supabase
      .from("diagnoses")
      .update({
        line_user_id: profile.userId,
        status: "linked"
      })
      .eq("id", diagnosisId);

    try {
      await insertEvent(supabase, "line_login_success", {
        diagnosisId,
        lineUserId: profile.userId,
        payload: {
          displayName: profile.displayName || null,
          friendFlag,
          friendshipStatusChanged
        },
        request
      });
    } catch (eventError) {
      console.warn("line_login_success event insert failed", eventError);
    }

    const { data: diagnosis, error: diagnosisError } = await supabase
      .from("diagnoses")
      .select("*")
      .eq("id", diagnosisId)
      .single();
    if (diagnosisError || !diagnosis) throw diagnosisError;

    const { data: appSettings } = await supabase
      .from("app_settings")
      .select("job_count, high_match_count")
      .eq("id", true)
      .maybeSingle();

    await pushLineMessages(profile.userId, buildLineMessages(diagnosis, appSettings || {}));

    await supabase
      .from("diagnoses")
      .update({
        status: "sent",
        line_sent_at: new Date().toISOString()
      })
      .eq("id", diagnosisId);

    await supabase
      .from("line_states")
      .update({ consumed_at: new Date().toISOString() })
      .eq("state", state);

    try {
      await insertEvent(supabase, "result_sent", {
        diagnosisId,
        lineUserId: profile.userId,
        payload: { resultType: diagnosis.result_type, friendFlag },
        request
      });
    } catch (eventError) {
      console.warn("result_sent event insert failed", eventError);
    }

    const completionUrl =
      lineState.completion_url || `${appOrigin}/line-complete.html`;
    const url = new URL(completionUrl);
    url.searchParams.set("status", "sent");
    url.searchParams.set("diagnosisId", diagnosisId);
    if (lineConnectionId) {
      url.searchParams.set("lineConnectionId", lineConnectionId);
    }
    return redirectResponse(url.toString());
  } catch (error) {
    const appOrigin = Deno.env.get("APP_ORIGIN") || new URL(request.url).origin;
    const url = new URL(`${appOrigin}/line-complete.html`);
    url.searchParams.set("status", "error");
    url.searchParams.set("message", errorMessage(error));
    return new Response(null, {
      status: 302,
      headers: {
        Location: url.toString(),
        ...corsHeaders
      }
    });
  }
});
