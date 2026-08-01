import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS"
};

function redirectResponse(url: string) {
  return new Response(null, {
    status: 302,
    headers: {
      Location: url,
      ...corsHeaders
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

async function insertEvent(
  supabase: ReturnType<typeof createClient>,
  eventName: string,
  options: {
    diagnosisId?: string | null;
    lineUserId?: string | null;
    visitorId?: string | null;
    sessionId?: string | null;
    funnelId?: string | null;
    resultType?: string | null;
    utmSource?: string | null;
    utmMedium?: string | null;
    utmCampaign?: string | null;
    deviceType?: string | null;
    pagePath?: string | null;
    payload?: Record<string, unknown>;
    request?: Request;
  } = {}
) {
  const userAgent = options.request?.headers.get("user-agent") || null;

  const { error } = await supabase.from("diagnosis_events").insert({
    event_name: eventName,
    diagnosis_id: options.diagnosisId || null,
    line_user_id: options.lineUserId || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (error) throw error;

  const { error: analyticsError } = await supabase.from("analytics_events").insert({
    event_name: eventName,
    diagnosis_id: options.diagnosisId || null,
    line_user_id: options.lineUserId || null,
    visitor_id: options.visitorId || null,
    session_id: options.sessionId || null,
    funnel_id: options.funnelId || null,
    result_type: options.resultType || options.payload?.resultType || null,
    utm_source: options.utmSource || null,
    utm_medium: options.utmMedium || null,
    utm_campaign: options.utmCampaign || null,
    device_type: options.deviceType || null,
    page_path: options.pagePath || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (analyticsError) {
    console.warn("analytics_events insert failed", analyticsError);
  }
}

async function exchangeLineToken(code: string, redirectUri: string) {
  const clientId = Deno.env.get("LINE_LOGIN_CHANNEL_ID");
  const clientSecret = Deno.env.get("LINE_LOGIN_CHANNEL_SECRET");

  if (!clientId || !clientSecret) {
    throw new Error("LINE_LOGIN_CHANNEL_ID and LINE_LOGIN_CHANNEL_SECRET are required");
  }

  const params = new URLSearchParams({
    grant_type: "authorization_code",
    code,
    redirect_uri: redirectUri,
    client_id: clientId,
    client_secret: clientSecret
  });

  const response = await fetch("https://api.line.me/oauth2/v2.1/token", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: params.toString()
  });

  if (!response.ok) throw new Error(await response.text());
  return response.json() as Promise<{ access_token: string; id_token?: string }>;
}

async function fetchLineProfile(accessToken: string) {
  const response = await fetch("https://api.line.me/v2/profile", {
    headers: { Authorization: `Bearer ${accessToken}` }
  });

  if (!response.ok) throw new Error(await response.text());
  return response.json() as Promise<{ userId: string; displayName?: string }>;
}

async function fetchLineFriendshipStatus(accessToken: string) {
  const response = await fetch("https://api.line.me/friendship/v1/status", {
    headers: { Authorization: `Bearer ${accessToken}` }
  });

  if (!response.ok) throw new Error(await response.text());
  return response.json() as Promise<{ friendFlag: boolean }>;
}

function buildLineMessages(diagnosis: Record<string, any>, appSettings: Record<string, any> = {}) {
  const result = diagnosis.result_payload || {};
  const jobCount = appSettings.job_count || Deno.env.get("DEFAULT_JOB_COUNT") || "12";
  const highMatchCount =
    appSettings.high_match_count || Deno.env.get("DEFAULT_HIGH_MATCH_COUNT") || "4";
  const jobs = Array.isArray(result.jobs) ? result.jobs.slice(0, 5).join(" / ") : "";

  return [
    {
      type: "text",
      text:
        result.lineMessage ||
        `診断結果は「${result.name || diagnosis.result_type}」でした。`
    },
    {
      type: "text",
      text:
        `あなたに合う求人があります。\n` +
        `紹介可能求人 ${jobCount}件\n` +
        `マッチ度90%以上 ${highMatchCount}件\n` +
        (jobs ? `向いている仕事: ${jobs}` : "")
    },
    {
      type: "text",
      text:
        "希望条件を教えてください。\n" +
        "1. 勤務地\n2. 転職時期\n3. 経験\n4. 希望職種\n5. 希望年収"
    }
  ];
}

async function pushLineMessages(lineUserId: string, messages: unknown[]) {
  const channelAccessToken = Deno.env.get("LINE_CHANNEL_ACCESS_TOKEN");
  if (!channelAccessToken) {
    throw new Error("LINE_CHANNEL_ACCESS_TOKEN is required");
  }

  const response = await fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${channelAccessToken}`,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      to: lineUserId,
      messages
    })
  });

  if (!response.ok) throw new Error(await response.text());
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

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
        visitorId: lineState.visitor_id || null,
        sessionId: lineState.session_id || null,
        funnelId: lineState.funnel_id || null,
        resultType: diagnosis.result_type || lineState.result_type || null,
        utmSource: lineState.utm_source || null,
        utmMedium: lineState.utm_medium || null,
        utmCampaign: lineState.utm_campaign || null,
        deviceType: lineState.device_type || null,
        pagePath: lineState.page_path || null,
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
