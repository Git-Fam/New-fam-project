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

const LINKED_DIAGNOSIS_RETENTION_DAYS = 180;

type AppUser = {
  id: string;
  internal_user_id: string | null;
  first_diagnosis_id?: string | null;
};

function createLinkedDiagnosisExpiresAt() {
  return new Date(
    Date.now() + LINKED_DIAGNOSIS_RETENTION_DAYS * 24 * 60 * 60 * 1000
  ).toISOString();
}

async function ensureAppUser(
  supabase: ReturnType<typeof getSupabaseClient>,
  profile: { userId: string; displayName?: string | null },
  lineState: Record<string, string | null>,
  diagnosisId: string
): Promise<AppUser> {
  const now = new Date().toISOString();
  const { data: existing, error: lookupError } = await supabase
    .from("app_users")
    .select("id, internal_user_id, first_diagnosis_id")
    .eq("line_user_id", profile.userId)
    .maybeSingle();

  if (lookupError) throw lookupError;

  if (existing?.id) {
    const { data, error } = await supabase
      .from("app_users")
      .update({
        display_name: profile.displayName || null,
        first_diagnosis_id: existing.first_diagnosis_id || diagnosisId,
        last_seen_at: now,
        updated_at: now
      })
      .eq("id", existing.id)
      .select("id, internal_user_id, first_diagnosis_id")
      .single();

    if (error) throw error;
    return data;
  }

  const { data, error } = await supabase
    .from("app_users")
    .insert({
      line_user_id: profile.userId,
      display_name: profile.displayName || null,
      initial_utm_source: lineState.utm_source || null,
      initial_utm_medium: lineState.utm_medium || null,
      initial_utm_campaign: lineState.utm_campaign || null,
      initial_device_type: lineState.device_type || null,
      initial_page_path: lineState.page_path || null,
      first_diagnosis_id: diagnosisId,
      first_seen_at: now,
      last_seen_at: now,
      created_at: now,
      updated_at: now
    })
    .select("id, internal_user_id, first_diagnosis_id")
    .single();

  if (error) throw error;
  return data;
}

async function saveUserDiagnosisRecord(
  supabase: ReturnType<typeof getSupabaseClient>,
  params: {
    diagnosisId: string;
    userId: string;
    lineUserId: string;
    context: Record<string, string | null>;
  }
) {
  const { data, error } = await supabase.rpc("upsert_user_diagnosis_record", {
    p_diagnosis_id: params.diagnosisId,
    p_user_id: params.userId,
    p_line_user_id: params.lineUserId,
    p_visitor_id: params.context.visitor_id || null,
    p_session_id: params.context.session_id || null,
    p_funnel_id: params.context.funnel_id || null,
    p_utm_source: params.context.utm_source || null,
    p_utm_medium: params.context.utm_medium || null,
    p_utm_campaign: params.context.utm_campaign || null,
    p_device_type: params.context.device_type || null,
    p_page_path: params.context.page_path || null
  });

  if (error) {
    console.warn("user diagnosis record upsert failed", error);
    return null;
  }

  return data as string | null;
}

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
      .select(
        "state, diagnosis_id, completion_url, expires_at, consumed_at, visitor_id, session_id, funnel_id, result_type, utm_source, utm_medium, utm_campaign, device_type, page_path"
      )
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
    const appUser = await ensureAppUser(supabase, profile, lineState, diagnosisId);
    let lineConnectionId: string | null = null;

    try {
      const { data: lineConnection, error: lineConnectionError } = await supabase
        .from("line_connections")
        .insert({
          user_id: appUser.id,
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
        user_id: appUser.id,
        line_user_id: profile.userId,
        status: "linked",
        expires_at: createLinkedDiagnosisExpiresAt()
      })
      .eq("id", diagnosisId);

    try {
      await insertEvent(supabase, "line_login_success", {
        diagnosisId,
        lineUserId: profile.userId,
        visitorId: lineState.visitor_id || null,
        sessionId: lineState.session_id || null,
        funnelId: lineState.funnel_id || null,
        resultType: lineState.result_type || null,
        utmSource: lineState.utm_source || null,
        utmMedium: lineState.utm_medium || null,
        utmCampaign: lineState.utm_campaign || null,
        deviceType: lineState.device_type || null,
        pagePath: lineState.page_path || null,
        payload: {
          internalUserId: appUser.internal_user_id || null,
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

    const userDiagnosisRecordId = await saveUserDiagnosisRecord(supabase, {
      diagnosisId,
      userId: appUser.id,
      lineUserId: profile.userId,
      context: lineState
    });

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
        line_sent_at: new Date().toISOString(),
        expires_at: createLinkedDiagnosisExpiresAt()
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
        visitorId: lineState.visitor_id || null,
        sessionId: lineState.session_id || null,
        funnelId: lineState.funnel_id || null,
        resultType: diagnosis.result_type || lineState.result_type || null,
        utmSource: lineState.utm_source || null,
        utmMedium: lineState.utm_medium || null,
        utmCampaign: lineState.utm_campaign || null,
        deviceType: lineState.device_type || null,
        pagePath: lineState.page_path || null,
        payload: {
          resultType: diagnosis.result_type,
          internalUserId: appUser.internal_user_id || null,
          userDiagnosisRecordId,
          friendFlag
        },
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
