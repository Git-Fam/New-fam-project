import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS"
};

const LINKED_DIAGNOSIS_RETENTION_DAYS = 180;

function createLinkedDiagnosisExpiresAt() {
  return new Date(
    Date.now() + LINKED_DIAGNOSIS_RETENTION_DAYS * 24 * 60 * 60 * 1000
  ).toISOString();
}

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

const CAREER_SURVEY_KEY = "career_preferences";

type CareerSurveyOption = {
  value: string;
  label: string;
};

type CareerSurveyQuestion = {
  key: string;
  label: string;
  options: CareerSurveyOption[];
};

const CAREER_SURVEY_QUESTIONS: CareerSurveyQuestion[] = [
  {
    key: "desired_location",
    label: "希望勤務地は？",
    options: [
      { value: "tokyo", label: "東京" },
      { value: "osaka", label: "大阪" },
      { value: "hokkaido", label: "北海道" },
      { value: "other", label: "その他" }
    ]
  },
  {
    key: "job_change_timing",
    label: "転職時期は？",
    options: [
      { value: "soon", label: "すぐ" },
      { value: "within_3_months", label: "3ヶ月以内" },
      { value: "within_6_months", label: "半年以内" },
      { value: "undecided", label: "まだ未定" }
    ]
  },
  {
    key: "current_job",
    label: "現在の職種は？",
    options: [
      { value: "sales", label: "営業" },
      { value: "retail", label: "販売・接客" },
      { value: "office", label: "事務" },
      { value: "it", label: "IT" },
      { value: "other", label: "その他" }
    ]
  },
  {
    key: "priority",
    label: "転職で一番重視するものは？",
    options: [
      { value: "income", label: "年収" },
      { value: "work_style", label: "働き方" },
      { value: "growth", label: "成長" },
      { value: "stability", label: "安定" },
      { value: "job_content", label: "仕事内容" }
    ]
  }
] as CareerSurveyQuestion[];

function normalizeCareerSurveyQuestions(value: unknown): CareerSurveyQuestion[] {
  if (!Array.isArray(value)) return CAREER_SURVEY_QUESTIONS;

  const questions = value
    .map((question: Record<string, any>) => {
      const key = String(question?.key || question?.question_key || "").trim();
      const label = String(question?.label || question?.question_label || "").trim();
      const options = Array.isArray(question?.options)
        ? question.options
            .map((option: Record<string, any>) => ({
              value: String(option?.value || "").trim(),
              label: String(option?.label || "").trim()
            }))
            .filter((option: CareerSurveyOption) => option.value && option.label)
        : [];

      if (!key || !label || options.length === 0) return null;
      return { key, label, options };
    })
    .filter((question): question is CareerSurveyQuestion => Boolean(question));

  return questions.length > 0 ? questions : CAREER_SURVEY_QUESTIONS;
}

function buildCareerSurveyQuestionMessage(
  question: CareerSurveyQuestion = CAREER_SURVEY_QUESTIONS[0],
  intro = ""
) {
  return {
    type: "text",
    text: `${intro ? `${intro}\n\n` : ""}${question.label}`,
    quickReply: {
      items: question.options.map((option) => ({
        type: "action",
        action: {
          type: "postback",
          label: option.label,
          data: `survey=${CAREER_SURVEY_KEY}&question=${question.key}&answer=${option.value}`,
          displayText: option.label
        }
      }))
    }
  };
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
  const surveyQuestions = normalizeCareerSurveyQuestions(appSettings.surveyQuestions);

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
    buildCareerSurveyQuestionMessage(
      surveyQuestions[0],
      `続けて、希望条件を${surveyQuestions.length}つだけ教えてください。`
    )
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

function getOutboundMessageText(message: unknown) {
  if (typeof message !== "object" || message === null) return null;
  const record = message as Record<string, unknown>;
  return typeof record.text === "string" ? record.text : null;
}

function getOutboundMessageType(message: unknown) {
  if (typeof message !== "object" || message === null) return "unknown";
  const record = message as Record<string, unknown>;
  return typeof record.type === "string" ? record.type : "unknown";
}

function getOutboundConversationType(message: unknown) {
  const text = getOutboundMessageText(message) || "";
  if (text.includes("希望勤務地") || text.includes("希望条件")) return "survey";
  return "diagnosis_result";
}

async function saveOutgoingLineMessages(
  supabase: ReturnType<typeof createClient>,
  params: {
    userId: string;
    lineUserId: string;
    diagnosisId: string;
    messages: unknown[];
  }
) {
  const retentionExpiresAt = createLinkedDiagnosisExpiresAt();

  await Promise.all(
    params.messages.map(async (message) => {
      const { error } = await supabase.from("line_conversation_messages").insert({
        user_id: params.userId,
        line_user_id: params.lineUserId,
        direction: "outgoing",
        sender_type: "bot",
        conversation_type: getOutboundConversationType(message),
        message_type: getOutboundMessageType(message),
        message_text: getOutboundMessageText(message),
        payload: { message },
        related_diagnosis_id: params.diagnosisId,
        occurred_at: new Date().toISOString(),
        body_retention_expires_at: retentionExpiresAt
      });

      if (error) {
        console.warn("line conversation message insert failed", error);
      }
    })
  );
}

async function readLineSurveyQuestions(supabase: ReturnType<typeof createClient>) {
  const { data, error } = await supabase
    .from("line_survey_questions")
    .select("question_key, question_label, options")
    .eq("survey_key", CAREER_SURVEY_KEY)
    .eq("enabled", true)
    .order("sort_order", { ascending: true });

  if (error) {
    console.warn("line survey questions lookup failed", error);
    return [];
  }

  return (data || [])
    .map((question: Record<string, any>) => ({
      key: String(question.question_key || ""),
      label: String(question.question_label || ""),
      options: Array.isArray(question.options) ? question.options : []
    }))
    .filter((question) => question.key && question.label && question.options.length > 0);
}

type AppUser = {
  id: string;
  internal_user_id: string | null;
};

async function ensureAppUserByLineId(
  supabase: ReturnType<typeof createClient>,
  lineUserId: string,
  currentUserId: string | null = null
): Promise<AppUser> {
  const now = new Date().toISOString();

  if (currentUserId) {
    const { data, error } = await supabase
      .from("app_users")
      .update({
        last_seen_at: now,
        updated_at: now
      })
      .eq("id", currentUserId)
      .select("id, internal_user_id")
      .maybeSingle();

    if (error) throw error;
    if (data?.id) return data;
  }

  const { data: existing, error: lookupError } = await supabase
    .from("app_users")
    .select("id, internal_user_id")
    .eq("line_user_id", lineUserId)
    .maybeSingle();

  if (lookupError) throw lookupError;

  if (existing?.id) {
    const { data, error } = await supabase
      .from("app_users")
      .update({
        last_seen_at: now,
        updated_at: now
      })
      .eq("id", existing.id)
      .select("id, internal_user_id")
      .single();

    if (error) throw error;
    return data;
  }

  const { data, error } = await supabase
    .from("app_users")
    .insert({
      line_user_id: lineUserId,
      first_seen_at: now,
      last_seen_at: now,
      created_at: now,
      updated_at: now
    })
    .select("id, internal_user_id")
    .single();

  if (error) throw error;
  return data;
}

async function saveUserDiagnosisRecord(
  supabase: ReturnType<typeof createClient>,
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
    p_visitor_id: params.context.visitorId || null,
    p_session_id: params.context.sessionId || null,
    p_funnel_id: params.context.funnelId || null,
    p_utm_source: params.context.utmSource || null,
    p_utm_medium: params.context.utmMedium || null,
    p_utm_campaign: params.context.utmCampaign || null,
    p_device_type: params.context.deviceType || null,
    p_page_path: params.context.pagePath || null
  });

  if (error) {
    console.warn("user diagnosis record upsert failed", error);
    return null;
  }

  return data as string | null;
}

async function resolveLineConnection(
  supabase: ReturnType<typeof createClient>,
  body: Record<string, string | null>
) {
  if (body.lineConnectionId) {
    const { data, error } = await supabase
      .from("line_connections")
      .select("id, line_user_id, user_id")
      .eq("id", body.lineConnectionId)
      .maybeSingle();

    if (!error && data?.line_user_id) {
      return {
        lineUserId: data.line_user_id,
        userId: data.user_id || null,
        lineConnectionId: data.id,
        source: "line_connection"
      };
    }

    if (error) console.warn("line_connections lookup failed", error);
  }

  if (!body.linkedDiagnosisId) return null;

  const { data, error } = await supabase
    .from("diagnoses")
    .select("id, line_user_id, user_id, status")
    .eq("id", body.linkedDiagnosisId)
    .maybeSingle();

  if (error || !data?.line_user_id) return null;
  if (!["linked", "sent"].includes(String(data.status))) return null;

  return {
    lineUserId: data.line_user_id,
    userId: data.user_id || null,
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

    const appUser = await ensureAppUserByLineId(
      supabase,
      connection.lineUserId,
      connection.userId
    );

    await supabase
      .from("diagnoses")
      .update({
        user_id: appUser.id,
        line_user_id: connection.lineUserId,
        status: "linked",
        expires_at: createLinkedDiagnosisExpiresAt()
      })
      .eq("id", diagnosisId);

    const { data: diagnosis, error: diagnosisError } = await supabase
      .from("diagnoses")
      .select("*")
      .eq("id", diagnosisId)
      .single();
    if (diagnosisError || !diagnosis) throw diagnosisError;

    const userDiagnosisRecordId = await saveUserDiagnosisRecord(supabase, {
      diagnosisId,
      userId: appUser.id,
      lineUserId: connection.lineUserId,
      context: body
    });

    const { data: appSettings } = await supabase
      .from("app_settings")
      .select("job_count, high_match_count")
      .eq("id", true)
      .maybeSingle();

    const surveyQuestions = await readLineSurveyQuestions(supabase);
    const lineMessages = buildLineMessages(diagnosis, {
      ...(appSettings || {}),
      surveyQuestions
    });
    await pushLineMessages(connection.lineUserId, lineMessages);
    await saveOutgoingLineMessages(supabase, {
      userId: appUser.id,
      lineUserId: connection.lineUserId,
      diagnosisId,
      messages: lineMessages
    });

    await supabase
      .from("diagnoses")
      .update({
        status: "sent",
        line_sent_at: new Date().toISOString(),
        expires_at: createLinkedDiagnosisExpiresAt()
      })
      .eq("id", diagnosisId);

    if (connection.lineConnectionId) {
      await supabase
        .from("line_connections")
        .update({
          user_id: appUser.id,
          last_used_at: new Date().toISOString()
        })
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
          internalUserId: appUser.internal_user_id || null,
          userDiagnosisRecordId,
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
      internalUserId: appUser.internal_user_id || null,
      userDiagnosisRecordId,
      source: connection.source
    });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
