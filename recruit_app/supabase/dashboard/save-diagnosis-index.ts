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

type SpecialAnswerInput = {
  questionId?: unknown;
  questionKey?: unknown;
  questionText?: unknown;
  optionALabel?: unknown;
  optionBLabel?: unknown;
  selectedOption?: unknown;
  selectedLabel?: unknown;
  answerOrder?: unknown;
  responseTime?: unknown;
  category?: unknown;
  payload?: unknown;
};

function stringValue(value: unknown) {
  return typeof value === "string" ? value.trim() : "";
}

function normalizeSpecialQuestionKey(value: unknown) {
  return stringValue(value).replace(/^special:/, "");
}

function safePositiveInteger(value: unknown, fallback: number) {
  const number = Math.floor(Number(value));
  return Number.isFinite(number) && number > 0 ? number : fallback;
}

function safeNonNegativeNumber(value: unknown) {
  const number = Number(value);
  return Number.isFinite(number) && number >= 0 ? number : 0;
}

function getObjectPayload(value: unknown) {
  return value && typeof value === "object" && !Array.isArray(value)
    ? value as Record<string, unknown>
    : {};
}

async function insertSpecialQuestionAnswers(
  supabase: ReturnType<typeof createClient>,
  params: {
    diagnosisId: string;
    answers: SpecialAnswerInput[];
    visitorId?: string | null;
    sessionId?: string | null;
    funnelId?: string | null;
  }
) {
  if (!params.answers.length) return 0;

  const questionKeys = [
    ...new Set(
      params.answers
        .map((answer) => normalizeSpecialQuestionKey(answer.questionKey || answer.questionId))
        .filter(Boolean)
    )
  ];

  const questionByKey = new Map<string, Record<string, any>>();
  if (questionKeys.length > 0) {
    const { data, error } = await supabase
      .from("special_questions")
      .select("id,question_key,question_text,option_a_label,option_b_label,category,payload")
      .in("question_key", questionKeys);

    if (error) throw error;
    (data || []).forEach((question: Record<string, any>) => {
      if (question.question_key) questionByKey.set(String(question.question_key), question);
    });
  }

  const now = new Date().toISOString();
  const rows = params.answers
    .map((answer, index) => {
      const questionKey = normalizeSpecialQuestionKey(answer.questionKey || answer.questionId);
      const question = questionKey ? questionByKey.get(questionKey) : null;
      const selectedOption = stringValue(answer.selectedOption).toUpperCase();
      if (selectedOption !== "A" && selectedOption !== "B") return null;

      const selectedLabel = stringValue(answer.selectedLabel);
      const optionALabel =
        stringValue(answer.optionALabel) ||
        stringValue(question?.option_a_label) ||
        (selectedOption === "A" ? selectedLabel : "A");
      const optionBLabel =
        stringValue(answer.optionBLabel) ||
        stringValue(question?.option_b_label) ||
        (selectedOption === "B" ? selectedLabel : "B");
      const questionText =
        stringValue(answer.questionText) ||
        stringValue(question?.question_text) ||
        "スペシャルクエスチョン";

      return {
        diagnosis_id: params.diagnosisId,
        visitor_id: params.visitorId || null,
        session_id: params.sessionId || null,
        funnel_id: params.funnelId || null,
        question_id: question?.id || null,
        question_key: questionKey || null,
        question_text: questionText,
        category: stringValue(answer.category) || stringValue(question?.category) || null,
        option_a_label: optionALabel,
        option_b_label: optionBLabel,
        selected_option: selectedOption,
        selected_label:
          selectedLabel || (selectedOption === "A" ? optionALabel : optionBLabel),
        answer_order: safePositiveInteger(answer.answerOrder, index + 1),
        response_time_ms: safeNonNegativeNumber(answer.responseTime),
        payload: {
          ...getObjectPayload(question?.payload),
          ...getObjectPayload(answer.payload)
        },
        answered_at: now,
        created_at: now,
        updated_at: now
      };
    })
    .filter((row): row is Record<string, unknown> => Boolean(row));

  if (!rows.length) return 0;

  const { error } = await supabase.from("special_question_answers").insert(rows);
  if (error) throw error;
  return rows.length;
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

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    if (!body.resultType) {
      return jsonResponse({ error: "resultType is required" }, 400);
    }

    const supabase = getSupabaseClient();
    const expiresAt =
      body.expiresAt || new Date(Date.now() + 24 * 60 * 60 * 1000).toISOString();
    const answers = Array.isArray(body.answers) ? body.answers : [];
    const specialAnswers = Array.isArray(body.specialAnswers)
      ? body.specialAnswers as SpecialAnswerInput[]
      : [];

    const { data, error } = await supabase
      .from("diagnoses")
      .insert({
        answers,
        scores: body.scores || {},
        score_rates: body.scoreRates || {},
        primary_axis: body.primaryAxis,
        secondary_axis: body.secondaryAxis,
        result_type: body.resultType,
        result_payload: body.resultPayload || {},
        visitor_id: body.visitorId || null,
        session_id: body.sessionId || null,
        funnel_id: body.funnelId || null,
        utm_source: body.utmSource || null,
        utm_medium: body.utmMedium || null,
        utm_campaign: body.utmCampaign || null,
        device_type: body.deviceType || null,
        page_path: body.pagePath || null,
        status: body.status || "waiting_for_line",
        expires_at: expiresAt
      })
      .select("id, created_at, expires_at")
      .single();

    if (error) throw error;

    const specialAnswersSaved = await insertSpecialQuestionAnswers(supabase, {
      diagnosisId: data.id,
      answers: specialAnswers,
      visitorId: body.visitorId || null,
      sessionId: body.sessionId || null,
      funnelId: body.funnelId || null
    });

    if (body.funnelId) {
      const { error: progressDeleteError } = await supabase
        .from("diagnosis_progress_sessions")
        .delete()
        .eq("funnel_id", body.funnelId);

      if (progressDeleteError) {
        console.warn("diagnosis progress delete failed", progressDeleteError);
      }
    }

    try {
      await insertEvent(supabase, "diagnosis_complete", {
        diagnosisId: data.id,
        visitorId: body.visitorId || null,
        sessionId: body.sessionId || null,
        funnelId: body.funnelId || null,
        resultType: body.resultType || null,
        utmSource: body.utmSource || null,
        utmMedium: body.utmMedium || null,
        utmCampaign: body.utmCampaign || null,
        deviceType: body.deviceType || null,
        pagePath: body.pagePath || null,
        payload: {
          resultType: body.resultType,
          answeredCount: answers.length + specialAnswers.length,
          normalAnsweredCount: answers.length,
          specialAnsweredCount: specialAnswers.length,
          specialAnswersSaved,
          totalResponseTime: [...answers, ...specialAnswers].reduce(
            (sum: number, answer: { responseTime?: number }) => sum + Number(answer.responseTime || 0),
            0
          )
        },
        request
      });
    } catch (eventError) {
      console.warn("diagnosis_complete event insert failed", eventError);
    }

    return jsonResponse({
      diagnosisId: data.id,
      createdAt: data.created_at,
      expiresAt: data.expires_at,
      specialAnswersSaved
    });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
