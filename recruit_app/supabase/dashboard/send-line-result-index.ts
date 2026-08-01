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

async function resolveLineConnection(
  supabase: ReturnType<typeof createClient>,
  body: Record<string, string | null>
) {
  if (body.lineConnectionId) {
    const { data, error } = await supabase
      .from("line_connections")
      .select("id, line_user_id")
      .eq("id", body.lineConnectionId)
      .maybeSingle();

    if (!error && data?.line_user_id) {
      return {
        lineUserId: data.line_user_id,
        lineConnectionId: data.id,
        source: "line_connection"
      };
    }

    if (error) console.warn("line_connections lookup failed", error);
  }

  if (!body.linkedDiagnosisId) return null;

  const { data, error } = await supabase
    .from("diagnoses")
    .select("id, line_user_id, status")
    .eq("id", body.linkedDiagnosisId)
    .maybeSingle();

  if (error || !data?.line_user_id) return null;
  if (!["linked", "sent"].includes(String(data.status))) return null;

  return {
    lineUserId: data.line_user_id,
    lineConnectionId: null,
    source: "diagnosis"
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
    const body = await request.json();
    const diagnosisId = body.diagnosisId;
    if (!diagnosisId) return jsonResponse({ error: "diagnosisId is required" }, 400);

    const supabase = getSupabaseClient();
    const connection = await resolveLineConnection(supabase, {
      lineConnectionId: body.lineConnectionId || null,
      linkedDiagnosisId: body.linkedDiagnosisId || null
    });

    if (!connection) {
      return jsonResponse({ error: "Saved LINE connection was not found" }, 404);
    }

    await supabase
      .from("diagnoses")
      .update({
        line_user_id: connection.lineUserId,
        status: "linked"
      })
      .eq("id", diagnosisId);

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

    await pushLineMessages(connection.lineUserId, buildLineMessages(diagnosis, appSettings || {}));

    await supabase
      .from("diagnoses")
      .update({
        status: "sent",
        line_sent_at: new Date().toISOString()
      })
      .eq("id", diagnosisId);

    if (connection.lineConnectionId) {
      await supabase
        .from("line_connections")
        .update({ last_used_at: new Date().toISOString() })
        .eq("id", connection.lineConnectionId);
    }

    try {
      await insertEvent(supabase, "result_sent", {
        diagnosisId,
        lineUserId: connection.lineUserId,
        visitorId: body.visitorId || null,
        sessionId: body.sessionId || null,
        funnelId: body.funnelId || null,
        resultType: diagnosis.result_type || body.resultType || null,
        utmSource: body.utmSource || null,
        utmMedium: body.utmMedium || null,
        utmCampaign: body.utmCampaign || null,
        deviceType: body.deviceType || null,
        pagePath: body.pagePath || null,
        payload: {
          resultType: diagnosis.result_type,
          reusedLineConnection: true,
          source: connection.source
        },
        request
      });
    } catch (eventError) {
      console.warn("result_sent event insert failed", eventError);
    }

    return jsonResponse({
      status: "sent",
      diagnosisId,
      lineConnectionId: connection.lineConnectionId,
      source: connection.source
    });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
