import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS"
};

const CAREER_SURVEY_KEY = "career_preferences";
const SURVEY_RETENTION_DAYS = 180;
const SURVEY_START_WORDS = ["希望条件", "アンケート", "再回答", "やり直し"];
const AI_REPLY_WINDOW_HOURS = 24;
const DEFAULT_AI_MAX_REPLIES = 4;
const DEFAULT_AI_MAX_INPUT_CHARS = 500;
const DEFAULT_AI_REPLY_MAX_CHARS = 360;
const DEFAULT_AI_PROVIDER = "gemini";
const DEFAULT_GEMINI_MODEL = "gemini-3.5-flash-lite";
const DEFAULT_AI_CTA_MESSAGE =
  "お話を聞く限り、\n" +
  "年収面と今後のキャリアについて\n" +
  "一度担当者と整理してみても良さそうです。\n\n" +
  "担当者と一度相談してみますか？";
const DEFAULT_AI_CTA_PRIMARY_LABEL = "相談してみる";
const DEFAULT_AI_CTA_PRIMARY_TEXT = "相談してみる";
const DEFAULT_AI_CTA_SECONDARY_LABEL = "もう少しAIに聞く";
const DEFAULT_AI_CTA_SECONDARY_TEXT = "もう少しAIに聞く";
const CAREER_CONSULTATION_START_WORDS = ["キャリア相談", "相談したい", "詳しく聞く"];
const AI_HANDOFF_REQUEST_WORDS = ["相談してみる", "担当者と相談", "担当者に相談", "人に相談"];
const AI_CONTINUE_REQUEST_WORDS = ["もう少しAIに聞く", "もう少し聞く", "もう少し相談", "aiに聞く"];
const AI_STOP_WORDS = ["停止", "ストップ", "ai停止", "aiを停止", "ai相談停止"];

type SurveyOption = {
  value: string;
  label: string;
};

type SurveyQuestion = {
  key: string;
  label: string;
  options: SurveyOption[];
};

const CAREER_SURVEY_QUESTIONS: SurveyQuestion[] = [
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
] as SurveyQuestion[];

type SupabaseClient = ReturnType<typeof createClient>;

type AiCareerContext = {
  diagnosis: Record<string, any> | null;
  preferences: Record<string, any> | null;
  specialAnswers: SpecialAnswerContext[];
  recentMessages: Array<Record<string, any>>;
};

type SpecialAnswerContext = {
  questionText: string;
  selectedLabel: string;
};

type AiConversationStatus = "idle" | "ai_replying" | "cta_shown" | "handed_off" | "stopped";

type AiConversationState = {
  id: string;
  user_id: string | null;
  line_user_id: string;
  status: AiConversationStatus;
  current_session_id: string | null;
  current_session_started_at: string | null;
  ai_reply_count: number;
  max_replies: number;
  cta_shown_at: string | null;
  handed_off_at: string | null;
  stopped_at: string | null;
};

type AiConversationSettings = {
  maxReplies: number;
  ctaMessage: string;
  ctaPrimaryLabel: string;
  ctaPrimaryText: string;
  ctaSecondaryLabel: string;
  ctaSecondaryText: string;
};

type AppUser = {
  id: string;
  internal_user_id: string | null;
  display_name?: string | null;
};

type LineHandoffRequest = {
  id: string;
  status: string;
  notification_target: string | null;
  notified_at: string | null;
};

type SurveySession = {
  id: string;
  user_id: string | null;
  line_user_id: string;
  current_step: number;
  status: string;
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

async function verifyLineSignature(body: string, signature: string | null) {
  const channelSecret = Deno.env.get("LINE_CHANNEL_SECRET");
  if (!channelSecret || !signature) return false;

  const encoder = new TextEncoder();
  const key = await crypto.subtle.importKey(
    "raw",
    encoder.encode(channelSecret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    ["sign"]
  );
  const digest = await crypto.subtle.sign("HMAC", key, encoder.encode(body));
  const expected = btoa(String.fromCharCode(...new Uint8Array(digest)));

  return expected === signature;
}

async function insertEvent(
  supabase: SupabaseClient,
  eventName: string,
  options: {
    lineUserId?: string | null;
    payload?: Record<string, unknown>;
    request?: Request;
  } = {}
) {
  const userAgent = options.request?.headers.get("user-agent") || null;

  const { error } = await supabase.from("diagnosis_events").insert({
    event_name: eventName,
    diagnosis_id: null,
    line_user_id: options.lineUserId || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (error) throw error;

  const { error: analyticsError } = await supabase.from("analytics_events").insert({
    event_name: eventName,
    line_user_id: options.lineUserId || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (analyticsError) {
    console.warn("analytics_events insert failed", analyticsError);
  }
}

function createRetentionExpiresAt() {
  return new Date(Date.now() + SURVEY_RETENTION_DAYS * 24 * 60 * 60 * 1000).toISOString();
}

function getEventOccurredAt(event: Record<string, any>) {
  return event.timestamp ? new Date(Number(event.timestamp)).toISOString() : new Date().toISOString();
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

function getConversationTypeFromText(text: string, fallback = "general") {
  if (isCareerConsultationStartText(text)) return "career_consultation";
  if (isSurveyStartText(text)) return "survey";
  return fallback;
}

async function saveLineConversationMessage(
  supabase: SupabaseClient,
  params: {
    userId?: string | null;
    lineUserId: string;
    direction: "incoming" | "outgoing";
    senderType: "user" | "bot" | "ai" | "staff" | "system";
    conversationType: string;
    messageType?: string;
    messageText?: string | null;
    payload?: Record<string, unknown>;
    lineMessageId?: string | null;
    relatedDiagnosisId?: string | null;
    relatedSurveySessionId?: string | null;
    occurredAt?: string | null;
  }
) {
  const { error } = await supabase.from("line_conversation_messages").insert({
    user_id: params.userId || null,
    line_user_id: params.lineUserId,
    direction: params.direction,
    sender_type: params.senderType,
    conversation_type: params.conversationType,
    message_type: params.messageType || "text",
    message_text: params.messageText || null,
    payload: params.payload || {},
    line_message_id: params.lineMessageId || null,
    related_diagnosis_id: params.relatedDiagnosisId || null,
    related_survey_session_id: params.relatedSurveySessionId || null,
    occurred_at: params.occurredAt || new Date().toISOString(),
    body_retention_expires_at: createRetentionExpiresAt()
  });

  if (error) {
    console.warn("line conversation message insert failed", error);
  }
}

async function replyAndSaveLineMessages(
  supabase: SupabaseClient,
  replyToken: string,
  messages: unknown[],
  params: {
    appUser: AppUser;
    lineUserId: string;
    conversationType: string;
    relatedSurveySessionId?: string | null;
  }
) {
  await replyLineMessages(replyToken, messages);

  await Promise.all(
    messages.map((message) =>
      saveLineConversationMessage(supabase, {
        userId: params.appUser.id,
        lineUserId: params.lineUserId,
        direction: "outgoing",
        senderType: "bot",
        conversationType: params.conversationType,
        messageType: getOutboundMessageType(message),
        messageText: getOutboundMessageText(message),
        payload: { message },
        relatedSurveySessionId: params.relatedSurveySessionId || null
      })
    )
  );
}

function normalizeText(value: string) {
  return value.replace(/\s+/g, "").toLowerCase();
}

function isSurveyStartText(text: string) {
  const normalized = normalizeText(text);
  return SURVEY_START_WORDS.some((word) => normalized.includes(normalizeText(word)));
}

function normalizeSurveyQuestion(row: Record<string, any>): SurveyQuestion | null {
  const key = String(row.question_key || "").trim();
  const label = String(row.question_label || "").trim();
  const options = Array.isArray(row.options)
    ? row.options
        .map((option: Record<string, any>) => ({
          value: String(option?.value || "").trim(),
          label: String(option?.label || "").trim()
        }))
        .filter((option: SurveyOption) => option.value && option.label)
    : [];
  if (!key || !label || options.length === 0) return null;
  return { key, label, options };
}

async function getCareerSurveyQuestions(supabase: SupabaseClient): Promise<SurveyQuestion[]> {
  const { data, error } = await supabase
    .from("line_survey_questions")
    .select("question_key, question_label, options")
    .eq("survey_key", CAREER_SURVEY_KEY)
    .eq("enabled", true)
    .order("sort_order", { ascending: true });

  if (error) {
    console.warn("line survey questions lookup failed", error);
    return CAREER_SURVEY_QUESTIONS;
  }

  const questions = (data || [])
    .map((row: Record<string, any>) => normalizeSurveyQuestion(row))
    .filter((question): question is SurveyQuestion => Boolean(question));

  return questions.length > 0 ? questions : CAREER_SURVEY_QUESTIONS;
}

function findQuestionIndex(questions: SurveyQuestion[], questionKey: string) {
  return questions.findIndex((question) => question.key === questionKey);
}

function findOptionByValue(question: SurveyQuestion, value: string | null) {
  return question.options.find((option) => option.value === value) || null;
}

function findOptionByText(question: SurveyQuestion, text: string) {
  const normalized = normalizeText(text);
  return (
    question.options.find((option) => normalizeText(option.label) === normalized) ||
    question.options.find((option) => normalizeText(option.value) === normalized) ||
    null
  );
}

function parseSurveyPostback(data: string | undefined) {
  if (!data) return null;
  const params = new URLSearchParams(data);
  if (params.get("survey") !== CAREER_SURVEY_KEY) return null;

  return {
    questionKey: params.get("question") || "",
    answerValue: params.get("answer") || ""
  };
}

function buildCareerSurveyQuestionMessage(question: SurveyQuestion, intro = "") {
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

function createCurrentQuestionMessage(
  session: SurveySession | null,
  questions: SurveyQuestion[],
  intro = ""
) {
  const step = Math.max(0, Math.min(Number(session?.current_step || 0), questions.length - 1));
  return buildCareerSurveyQuestionMessage(questions[step], intro);
}

function buildSurveyCompleteQuickReply() {
  return {
    items: [
      {
        type: "action",
        action: {
          type: "message",
          label: "キャリア相談",
          text: "キャリア相談で詳しく聞く"
        }
      }
    ]
  };
}

function buildFallbackSurveyCompleteText(preferences: Record<string, string | null>) {
  const location = preferences.desired_location_label || "希望勤務地";
  const timing = preferences.job_change_timing_label || "転職時期";
  const priority = preferences.priority_label || "重視したい条件";

  return (
    "回答ありがとうございます。\n\n" +
    "あなたの場合、\n" +
    `「${location}で働ける環境」\n` +
    `「${timing}を前提に動ける働き方」\n` +
    `「${priority}を大切にできる職場」\n\n` +
    "との相性が高そうです。\n" +
    "さらに、現在の条件に合う紹介可能な選択肢があります。"
  );
}

function buildSurveyCompleteMessage(
  preferences: Record<string, string | null>,
  generatedText?: string | null
) {
  return {
    type: "text",
    text: generatedText || buildFallbackSurveyCompleteText(preferences),
    quickReply: buildSurveyCompleteQuickReply()
  };
}

function buildSurveySummaryText(preferences: Record<string, string | null>) {
  const location = preferences.desired_location_label || "未回答";
  const timing = preferences.job_change_timing_label || "未回答";
  const currentJob = preferences.current_job_label || "未回答";
  const priority = preferences.priority_label || "未回答";

  return [
    "希望条件アンケート",
    `勤務地: ${location}`,
    `転職時期: ${timing}`,
    `現在職種: ${currentJob}`,
    `重視条件: ${priority}`
  ].join("\n");
}

async function saveLineConversationSummary(
  supabase: SupabaseClient,
  params: {
    appUser: AppUser;
    lineUserId: string;
    summaryType: string;
    summaryKey: string;
    summaryText: string;
    sourceMessageCount: number;
    relatedSurveySessionId?: string | null;
    payload?: Record<string, unknown>;
  }
) {
  const now = new Date().toISOString();
  const { error } = await supabase.from("line_conversation_summaries").upsert(
    {
      user_id: params.appUser.id,
      line_user_id: params.lineUserId,
      summary_type: params.summaryType,
      summary_key: params.summaryKey,
      summary_text: params.summaryText,
      source_message_count: params.sourceMessageCount,
      source_survey_session_id: params.relatedSurveySessionId || null,
      source_period_end: now,
      payload: params.payload || {},
      updated_at: now
    },
    { onConflict: "line_user_id,summary_key" }
  );

  if (error) {
    console.warn("line conversation summary upsert failed", error);
  }
}

function getNumberEnv(name: string, defaultValue: number, minValue: number, maxValue: number) {
  const rawValue = Deno.env.get(name);
  const value = rawValue ? Number(rawValue) : defaultValue;
  if (!Number.isFinite(value)) return defaultValue;
  return Math.max(minValue, Math.min(maxValue, Math.floor(value)));
}

function truncateText(text: string, maxChars: number) {
  if (text.length <= maxChars) return text;
  return `${text.slice(0, Math.max(0, maxChars - 1))}…`;
}

function redactForAi(text: string) {
  return text
    .replace(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/gi, "[email]")
    .replace(/0\d{1,4}[-\s]?\d{1,4}[-\s]?\d{3,4}/g, "[phone]");
}

function getAiProvider() {
  return (Deno.env.get("AI_PROVIDER") || DEFAULT_AI_PROVIDER).toLowerCase();
}

function getAiModel(provider = getAiProvider()) {
  const explicitModel = Deno.env.get("AI_MODEL");
  if (explicitModel) return explicitModel;
  if (provider === "gemini" || provider === "google") {
    return Deno.env.get("GEMINI_MODEL") || DEFAULT_GEMINI_MODEL;
  }
  return DEFAULT_GEMINI_MODEL;
}

function getAiMaxReplies() {
  return getNumberEnv("LINE_AI_MAX_REPLIES", DEFAULT_AI_MAX_REPLIES, 1, 10);
}

function sanitizeLineSetting(value: unknown, fallback: string, maxChars: number) {
  const text = typeof value === "string" ? value.trim() : "";
  if (!text) return fallback;
  return truncateText(text, maxChars);
}

function sanitizeQuickReplyLabel(value: unknown, fallback: string) {
  return sanitizeLineSetting(value, fallback, 20);
}

async function getAiConversationSettings(supabase: SupabaseClient): Promise<AiConversationSettings> {
  const fallback: AiConversationSettings = {
    maxReplies: getAiMaxReplies(),
    ctaMessage: DEFAULT_AI_CTA_MESSAGE,
    ctaPrimaryLabel: DEFAULT_AI_CTA_PRIMARY_LABEL,
    ctaPrimaryText: DEFAULT_AI_CTA_PRIMARY_TEXT,
    ctaSecondaryLabel: DEFAULT_AI_CTA_SECONDARY_LABEL,
    ctaSecondaryText: DEFAULT_AI_CTA_SECONDARY_TEXT
  };

  const { data, error } = await supabase
    .from("app_settings")
    .select(
      "line_ai_max_replies, line_ai_cta_message, line_ai_cta_primary_label, line_ai_cta_primary_text, line_ai_cta_secondary_label, line_ai_cta_secondary_text"
    )
    .eq("id", true)
    .maybeSingle();

  if (error) {
    console.warn("LINE AI settings lookup failed", error);
    return fallback;
  }

  const value = Number(data?.line_ai_max_replies || getAiMaxReplies());
  const maxReplies = Number.isFinite(value)
    ? Math.max(1, Math.min(10, Math.floor(value)))
    : fallback.maxReplies;

  return {
    maxReplies,
    ctaMessage: sanitizeLineSetting(data?.line_ai_cta_message, fallback.ctaMessage, 900),
    ctaPrimaryLabel: sanitizeQuickReplyLabel(data?.line_ai_cta_primary_label, fallback.ctaPrimaryLabel),
    ctaPrimaryText: sanitizeLineSetting(data?.line_ai_cta_primary_text, fallback.ctaPrimaryText, 300),
    ctaSecondaryLabel: sanitizeQuickReplyLabel(data?.line_ai_cta_secondary_label, fallback.ctaSecondaryLabel),
    ctaSecondaryText: sanitizeLineSetting(data?.line_ai_cta_secondary_text, fallback.ctaSecondaryText, 300)
  };
}

function getAiMaxInputChars() {
  return getNumberEnv("LINE_AI_MAX_INPUT_CHARS", DEFAULT_AI_MAX_INPUT_CHARS, 120, 1200);
}

function getAiReplyMaxChars() {
  return getNumberEnv("LINE_AI_REPLY_MAX_CHARS", DEFAULT_AI_REPLY_MAX_CHARS, 120, 600);
}

function isCareerConsultationStartText(text: string) {
  const normalized = normalizeText(text);
  return CAREER_CONSULTATION_START_WORDS.some((word) => normalized.includes(normalizeText(word)));
}

function matchesAnyNormalized(text: string, candidates: string[]) {
  const normalized = normalizeText(text);
  return candidates
    .map((word) => normalizeText(word))
    .filter(Boolean)
    .some((word) => normalized.includes(word));
}

function isAiHandoffRequestText(text: string, settings: AiConversationSettings) {
  return matchesAnyNormalized(text, [
    settings.ctaPrimaryText,
    settings.ctaPrimaryLabel,
    ...AI_HANDOFF_REQUEST_WORDS
  ]);
}

function isAiContinueRequestText(text: string, settings: AiConversationSettings) {
  return matchesAnyNormalized(text, [
    settings.ctaSecondaryText,
    settings.ctaSecondaryLabel,
    ...AI_CONTINUE_REQUEST_WORDS
  ]);
}

function isAiStopText(text: string) {
  const normalized = normalizeText(text);
  return AI_STOP_WORDS.some((word) => normalized === normalizeText(word));
}

function buildAiHandoffQuickReply(settings: AiConversationSettings) {
  return {
    items: [
      {
        type: "action",
        action: {
          type: "message",
          label: settings.ctaPrimaryLabel,
          text: settings.ctaPrimaryText
        }
      },
      {
        type: "action",
        action: {
          type: "message",
          label: settings.ctaSecondaryLabel,
          text: settings.ctaSecondaryText
        }
      }
    ]
  };
}

function buildCareerConsultationStartMessage() {
  return {
    type: "text",
    text:
      "今の仕事や転職で気になっていることを、1つだけ送ってください。\n\n" +
      "例：\n" +
      "・給料が上がらなくて不安\n" +
      "・未経験で営業に行けるか知りたい\n" +
      "・自分に合う働き方を整理したい"
  };
}

function buildNonCareerRedirectMessage() {
  return {
    type: "text",
    text:
      "ここでは仕事・転職・働き方の相談に絞って回答します。\n\n" +
      "今の仕事で気になっていることや、転職で不安なことを送ってください。"
  };
}

function buildAiLimitMessage(settings: AiConversationSettings) {
  return {
    type: "text",
    text: settings.ctaMessage,
    quickReply: buildAiHandoffQuickReply(settings)
  };
}

function buildAiHandoffAcceptedMessage() {
  return {
    type: "text",
    text:
      "担当者に相談する希望を受け付けました。\n\n" +
      "確認でき次第、担当者から順番にご連絡します。"
  };
}

function buildAiAlreadyHandedOffMessage() {
  return {
    type: "text",
    text:
      "すでに担当者への相談希望を受け付けています。\n\n" +
      "確認でき次第、担当者から順番にご連絡します。"
  };
}

function buildAiStoppedMessage() {
  return {
    type: "text",
    text:
      "AI相談を停止しました。\n\n" +
      "再開したい場合は「キャリア相談で詳しく聞く」を押してください。"
  };
}

function buildAiStoppedNoticeMessage() {
  return {
    type: "text",
    text:
      "現在AI相談は停止中です。\n\n" +
      "再開したい場合は「キャリア相談で詳しく聞く」を押してください。"
  };
}

function buildAiFallbackMessage() {
  return {
    type: "text",
    text:
      "相談内容を受け取りました。\n\n" +
      "今だけAI返信が不安定なため、もう少し具体的に「仕事・転職・働き方」で気になる点を送ってください。"
  };
}

function isMissingAiStateTable(error: unknown) {
  return errorMessage(error).includes("line_ai_conversation_states");
}

async function getAiConversationState(supabase: SupabaseClient, lineUserId: string) {
  const { data, error } = await supabase
    .from("line_ai_conversation_states")
    .select("*")
    .eq("line_user_id", lineUserId)
    .maybeSingle();

  if (error) {
    if (!isMissingAiStateTable(error)) {
      console.warn("AI conversation state lookup failed", error);
    }
    return null;
  }

  return (data || null) as AiConversationState | null;
}

async function upsertAiConversationState(
  supabase: SupabaseClient,
  params: {
    appUser: AppUser;
    lineUserId: string;
    status: AiConversationStatus;
    currentSessionId?: string | null;
    currentSessionStartedAt?: string | null;
    aiReplyCount?: number;
    maxReplies?: number;
    ctaShownAt?: string | null;
    handedOffAt?: string | null;
    stoppedAt?: string | null;
    lastUserMessageAt?: string | null;
    lastAiReplyAt?: string | null;
    payload?: Record<string, unknown>;
  }
) {
  const now = new Date().toISOString();
  const row: Record<string, unknown> = {
    user_id: params.appUser.id,
    line_user_id: params.lineUserId,
    status: params.status,
    updated_at: now
  };

  if (params.currentSessionId !== undefined) row.current_session_id = params.currentSessionId;
  if (params.currentSessionStartedAt !== undefined) {
    row.current_session_started_at = params.currentSessionStartedAt;
  }
  if (params.aiReplyCount !== undefined) row.ai_reply_count = params.aiReplyCount;
  if (params.maxReplies !== undefined) row.max_replies = params.maxReplies;
  if (params.ctaShownAt !== undefined) row.cta_shown_at = params.ctaShownAt;
  if (params.handedOffAt !== undefined) row.handed_off_at = params.handedOffAt;
  if (params.stoppedAt !== undefined) row.stopped_at = params.stoppedAt;
  if (params.lastUserMessageAt !== undefined) row.last_user_message_at = params.lastUserMessageAt;
  if (params.lastAiReplyAt !== undefined) row.last_ai_reply_at = params.lastAiReplyAt;
  if (params.payload !== undefined) row.payload = params.payload;

  const { data, error } = await supabase
    .from("line_ai_conversation_states")
    .upsert(row, { onConflict: "line_user_id" })
    .select("*")
    .single();

  if (error) {
    if (!isMissingAiStateTable(error)) {
      console.warn("AI conversation state upsert failed", error);
    }
    return null;
  }

  return data as AiConversationState;
}

async function startAiConversationSession(
  supabase: SupabaseClient,
  params: {
    appUser: AppUser;
    lineUserId: string;
    maxReplies: number;
  }
) {
  const now = new Date().toISOString();
  return upsertAiConversationState(supabase, {
    appUser: params.appUser,
    lineUserId: params.lineUserId,
    status: "ai_replying",
    currentSessionId: crypto.randomUUID(),
    currentSessionStartedAt: now,
    aiReplyCount: 0,
    maxReplies: params.maxReplies,
    ctaShownAt: null,
    handedOffAt: null,
    stoppedAt: null,
    lastUserMessageAt: null,
    lastAiReplyAt: null,
    payload: {}
  });
}

async function getLatestCareerConsultationSessionStartedAt(supabase: SupabaseClient, lineUserId: string) {
  const startMessageText = buildCareerConsultationStartMessage().text;
  const { data, error } = await supabase
    .from("line_conversation_messages")
    .select("occurred_at")
    .eq("line_user_id", lineUserId)
    .eq("direction", "outgoing")
    .eq("sender_type", "bot")
    .eq("conversation_type", "career_consultation")
    .eq("message_text", startMessageText)
    .order("occurred_at", { ascending: false })
    .limit(1)
    .maybeSingle();

  if (error) {
    console.warn("AI consultation session lookup failed", error);
    return null;
  }

  return typeof data?.occurred_at === "string" ? data.occurred_at : null;
}

async function getCurrentCareerSessionAiReplyCount(
  supabase: SupabaseClient,
  lineUserId: string,
  sessionStartedAt: string | null
) {
  const fallbackSince = new Date(Date.now() - AI_REPLY_WINDOW_HOURS * 60 * 60 * 1000).toISOString();
  const since = sessionStartedAt || fallbackSince;
  const { count, error } = await supabase
    .from("line_conversation_messages")
    .select("id", { count: "exact", head: true })
    .eq("line_user_id", lineUserId)
    .eq("direction", "outgoing")
    .eq("sender_type", "ai")
    .eq("conversation_type", "career_consultation")
    .gte("occurred_at", since);

  if (error) {
    console.warn("AI consultation reply count lookup failed", error);
    return 0;
  }

  return count || 0;
}

async function readSpecialAnswerContext(
  supabase: SupabaseClient,
  appUser: AppUser,
  diagnosisId?: string | null
): Promise<SpecialAnswerContext[]> {
  let query = supabase
    .from("special_question_answers")
    .select("question_text,selected_label,answer_order,answered_at")
    .eq("user_id", appUser.id)
    .limit(6);

  if (diagnosisId) {
    query = query.eq("diagnosis_id", diagnosisId).order("answer_order", { ascending: true });
  } else {
    query = query.order("answered_at", { ascending: false });
  }

  const { data, error } = await query;
  if (error) {
    console.warn("AI special answer context lookup failed", error);
    return [];
  }

  return (data || [])
    .map((answer: Record<string, any>) => ({
      questionText: String(answer.question_text || "").trim(),
      selectedLabel: String(answer.selected_label || "").trim()
    }))
    .filter((answer) => answer.questionText && answer.selectedLabel);
}

async function getAiCareerContext(
  supabase: SupabaseClient,
  appUser: AppUser,
  lineUserId: string,
  sessionStartedAt: string | null
): Promise<AiCareerContext> {
  let messagesQuery = supabase
    .from("line_conversation_messages")
    .select("direction, sender_type, conversation_type, message_text, occurred_at")
    .eq("line_user_id", lineUserId)
    .in("conversation_type", ["career_consultation", "survey", "general"])
    .order("occurred_at", { ascending: false })
    .limit(8);

  if (sessionStartedAt) {
    messagesQuery = messagesQuery.gte("occurred_at", sessionStartedAt);
  }

  const [diagnosisResult, preferencesResult, messagesResult] = await Promise.all([
    supabase
      .from("user_diagnosis_records")
      .select("diagnosis_id,result_type")
      .eq("user_id", appUser.id)
      .order("diagnosed_at", { ascending: false })
      .limit(1)
      .maybeSingle(),
    supabase
      .from("line_user_preferences")
      .select("desired_location_label, job_change_timing_label, current_job_label, priority_label, completed_at")
      .eq("user_id", appUser.id)
      .maybeSingle(),
    messagesQuery
  ]);

  if (diagnosisResult.error) console.warn("AI diagnosis context lookup failed", diagnosisResult.error);
  if (preferencesResult.error) console.warn("AI preferences context lookup failed", preferencesResult.error);
  if (messagesResult.error) console.warn("AI recent messages lookup failed", messagesResult.error);

  const diagnosis = diagnosisResult.data || null;
  const specialAnswers = await readSpecialAnswerContext(
    supabase,
    appUser,
    diagnosis?.diagnosis_id || null
  );

  return {
    diagnosis,
    preferences: preferencesResult.data || null,
    specialAnswers,
    recentMessages: Array.isArray(messagesResult.data) ? [...messagesResult.data].reverse() : []
  };
}

function formatDiagnosisForPrompt(diagnosis: Record<string, any> | null) {
  return `診断タイプ: ${diagnosis?.result_type || "未取得"}`;
}

function formatPreferencesForPrompt(preferences: Record<string, any> | null) {
  if (!preferences) return "希望条件: 未回答";
  return [
    `希望勤務地: ${preferences.desired_location_label || "未回答"}`,
    `転職時期: ${preferences.job_change_timing_label || "未回答"}`,
    `現在職種: ${preferences.current_job_label || "未回答"}`,
    `重視条件: ${preferences.priority_label || "未回答"}`
  ].join("\n");
}

function formatSpecialAnswersForPrompt(answers: SpecialAnswerContext[] = []) {
  if (!answers.length) return "スペシャル回答: なし";
  return [
    "スペシャル回答:",
    ...answers.slice(0, 6).map((answer) => {
      return [
        `質問: ${truncateText(redactForAi(answer.questionText), 120)}`,
        `選択: ${truncateText(redactForAi(answer.selectedLabel), 80)}`
      ].join("\n");
    })
  ].join("\n");
}

function formatRecentMessagesForPrompt(messages: Array<Record<string, any>>) {
  if (!messages.length) return "直近会話: なし";
  return messages
    .map((message) => {
      const role = message.sender_type === "user" ? "ユーザー" : "AIまたはBot";
      return `${role}: ${truncateText(redactForAi(String(message.message_text || "")), 160)}`;
    })
    .join("\n");
}

function buildAiSystemPrompt(maxReplyChars: number, isFinalReply: boolean) {
  return [
    "あなたは20代前半の求職者向けのLINEキャリア相談AIです。",
    "まず、今回のユーザー発言と直近会話を見て、キャリア、仕事、転職、職場、人間関係、働き方、年収、適職に関する相談として自然に続けるべきか判断してください。",
    "前のAI質問への短い返答や否定だけの返答でも、直近会話がキャリア相談ならcareerRelatedはtrueにしてください。",
    "明らかな雑談、遊び、キャリアと無関係な質問ならcareerRelatedはfalseにしてください。",
    "求人企業名や実在企業名は出さず、断定的な内定保証・収入保証もしないでください。",
    "医療、法律、投資など高リスク領域は専門家確認を促し、キャリア観点に戻してください。",
    isFinalReply
      ? "今回が最後のAI返信です。相談内容を1〜2文で自然に整理してください。担当者相談への誘導文はシステム側で追加するため書かないでください。"
      : "毎回1つだけ追加質問または確認をしてください。",
    `${maxReplyChars}文字以内。LINEで読みやすい短い日本語。箇条書きは最大3つまで。`,
    "出力はJSONのみ。Markdownやコードブロックは禁止です。",
    '{"careerRelated":true,"reply":"返信文"} または {"careerRelated":false,"reply":""} の形式で返してください。'
  ].join("\n");
}

function buildAiUserPrompt(params: {
  userText: string;
  aiReplyCount: number;
  maxReplies: number;
  isFinalReply: boolean;
  context: AiCareerContext;
}) {
  return [
    `AI返信回数: ${params.aiReplyCount + 1} / ${params.maxReplies}`,
    `今回が最後のAI返信か: ${params.isFinalReply ? "はい" : "いいえ"}`,
    formatDiagnosisForPrompt(params.context.diagnosis),
    formatPreferencesForPrompt(params.context.preferences),
    formatSpecialAnswersForPrompt(params.context.specialAnswers),
    formatRecentMessagesForPrompt(params.context.recentMessages),
    `今回のユーザー発言: ${truncateText(redactForAi(params.userText), getAiMaxInputChars())}`
  ].join("\n\n");
}

function extractGeminiOutputText(data: Record<string, any>) {
  const chunks: string[] = [];
  const candidates = Array.isArray(data.candidates) ? data.candidates : [];

  for (const candidate of candidates) {
    const parts = Array.isArray(candidate?.content?.parts) ? candidate.content.parts : [];
    for (const part of parts) {
      if (typeof part?.text === "string") {
        chunks.push(part.text);
      }
    }
  }

  return chunks.join("\n").trim();
}

function parseJsonObject(text: string) {
  const trimmed = text.trim().replace(/^```(?:json)?\s*/i, "").replace(/\s*```$/i, "");
  try {
    return JSON.parse(trimmed) as Record<string, any>;
  } catch {
    const match = trimmed.match(/\{[\s\S]*\}/);
    if (!match) return null;
    try {
      return JSON.parse(match[0]) as Record<string, any>;
    } catch {
      return null;
    }
  }
}

function parseAiCareerDecision(text: string) {
  const parsed = parseJsonObject(text);
  if (!parsed) {
    throw new Error("AI response JSON was invalid");
  }

  const rawCareerRelated = parsed.careerRelated ?? parsed.career_related;
  const careerRelated = rawCareerRelated === true || rawCareerRelated === "true";
  const reply = typeof parsed.reply === "string" ? parsed.reply.trim() : "";

  return { careerRelated, reply };
}

function getPreferenceAnswer(preferences: Record<string, string | null>, questionKey: string) {
  return preferences[`${questionKey}_label`] || preferences[questionKey] || "未回答";
}

function formatSurveyAnswersForPrompt(
  questions: SurveyQuestion[],
  preferences: Record<string, string | null>
) {
  return questions
    .map((question) => `${question.label}: ${getPreferenceAnswer(preferences, question.key)}`)
    .join("\n");
}

function buildSurveyCompleteSystemPrompt() {
  return [
    "あなたは20代前半の求職者向けキャリア診断サービスのLINE文面を作るコピーライターです。",
    "LINEアンケート回答をもとに、ユーザーが「自分はそういう場所で輝けるのかも」と思える短い結果文を作ってください。",
    "回答をそのまま差し込むだけの文は禁止です。回答を抽象化し、少し前向きで魅力的な言葉に言い換えてください。",
    "求人企業名、実在企業名、収入保証、内定保証は書かないでください。",
    "断定しすぎず、「力を発揮しやすそう」「相性が高そう」程度の表現にしてください。",
    "本文は日本語で220文字以内。LINEで読みやすく改行してください。",
    "以下の構成にしてください: 回答へのお礼、3つの引用フレーズ、相性が高そうという一文、紹介可能な選択肢がある一文。",
    "出力はJSONのみ。Markdownやコードブロックは禁止です。",
    '{"message":"回答ありがとうございます。\\n\\nあなたは、\\n「刺激がたくさんある環境」\\n「フレキシブルな働き方」\\n「自分の意見を大切にできる職場」\\n\\nで力を発揮しやすそうです。\\n\\nさらに、今の希望条件に近い紹介可能な選択肢があります。"} の形式で返してください。'
  ].join("\n");
}

function buildSurveyCompleteUserPrompt(params: {
  questions: SurveyQuestion[];
  preferences: Record<string, string | null>;
  diagnosis: Record<string, any> | null;
  specialAnswers?: SpecialAnswerContext[];
}) {
  return [
    formatDiagnosisForPrompt(params.diagnosis),
    formatSpecialAnswersForPrompt(params.specialAnswers || []),
    "LINEアンケート回答:",
    formatSurveyAnswersForPrompt(params.questions, params.preferences)
  ].join("\n\n");
}

function parseSurveyCompleteMessage(text: string) {
  const parsed = parseJsonObject(text);
  if (!parsed) {
    throw new Error("AI survey completion JSON was invalid");
  }

  const message = typeof parsed.message === "string" ? parsed.message.trim() : "";
  if (!message) {
    throw new Error("AI survey completion message was empty");
  }

  return truncateText(message, 420);
}

async function generateGeminiSurveyCompleteMessage(params: {
  questions: SurveyQuestion[];
  preferences: Record<string, string | null>;
  diagnosis: Record<string, any> | null;
  specialAnswers?: SpecialAnswerContext[];
}) {
  const apiKey = Deno.env.get("GEMINI_API_KEY") || Deno.env.get("GOOGLE_API_KEY");
  if (!apiKey) {
    throw new Error("GEMINI_API_KEY is required");
  }

  const model = getAiModel("gemini");
  const modelPath = model.startsWith("models/") ? model : `models/${model}`;
  const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/${modelPath}:generateContent`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "x-goog-api-key": apiKey
    },
    body: JSON.stringify({
      systemInstruction: {
        parts: [{ text: buildSurveyCompleteSystemPrompt() }]
      },
      contents: [
        {
          role: "user",
          parts: [{ text: buildSurveyCompleteUserPrompt(params) }]
        }
      ],
      generationConfig: {
        maxOutputTokens: 450,
        temperature: 0.85,
        responseMimeType: "application/json"
      }
    })
  });

  const data = (await response.json().catch(() => ({}))) as Record<string, any>;
  if (!response.ok) {
    throw new Error(errorMessage(data) || `Gemini request failed: ${response.status}`);
  }

  const text = extractGeminiOutputText(data);
  if (!text) {
    throw new Error("Gemini survey completion text was empty");
  }

  return {
    provider: "gemini",
    model,
    text: parseSurveyCompleteMessage(text),
    usage: data.usageMetadata || null,
    responseId: null
  };
}

async function generateAiSurveyCompleteMessage(params: {
  questions: SurveyQuestion[];
  preferences: Record<string, string | null>;
  diagnosis: Record<string, any> | null;
  specialAnswers?: SpecialAnswerContext[];
}) {
  const provider = getAiProvider();
  if (provider === "gemini" || provider === "google") {
    return generateGeminiSurveyCompleteMessage(params);
  }

  throw new Error(`Unsupported AI_PROVIDER: ${provider}`);
}

async function generateGeminiCareerReply(params: {
  userText: string;
  aiReplyCount: number;
  maxReplies: number;
  isFinalReply: boolean;
  context: AiCareerContext;
}) {
  const apiKey = Deno.env.get("GEMINI_API_KEY") || Deno.env.get("GOOGLE_API_KEY");
  if (!apiKey) {
    throw new Error("GEMINI_API_KEY is required");
  }

  const model = getAiModel("gemini");
  const modelPath = model.startsWith("models/") ? model : `models/${model}`;
  const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/${modelPath}:generateContent`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "x-goog-api-key": apiKey
    },
    body: JSON.stringify({
      systemInstruction: {
        parts: [{ text: buildAiSystemPrompt(getAiReplyMaxChars(), params.isFinalReply) }]
      },
      contents: [
        {
          role: "user",
          parts: [{ text: buildAiUserPrompt(params) }]
        }
      ],
      generationConfig: {
        maxOutputTokens: 500,
        temperature: 0.6,
        responseMimeType: "application/json"
      }
    })
  });

  const data = (await response.json().catch(() => ({}))) as Record<string, any>;
  if (!response.ok) {
    throw new Error(errorMessage(data) || `Gemini request failed: ${response.status}`);
  }

  const text = extractGeminiOutputText(data);
  if (!text) {
    throw new Error("Gemini response text was empty");
  }
  const decision = parseAiCareerDecision(text);
  if (decision.careerRelated && !decision.reply) {
    throw new Error("Gemini career reply was empty");
  }

  return {
    provider: "gemini",
    model,
    careerRelated: decision.careerRelated,
    text: truncateText(decision.reply, getAiReplyMaxChars()),
    usage: data.usageMetadata || null,
    responseId: null
  };
}

async function generateAiCareerReply(params: {
  userText: string;
  aiReplyCount: number;
  maxReplies: number;
  isFinalReply: boolean;
  context: AiCareerContext;
}) {
  const provider = getAiProvider();
  if (provider === "gemini" || provider === "google") {
    return generateGeminiCareerReply(params);
  }

  throw new Error(`Unsupported AI_PROVIDER: ${provider}`);
}

async function replyAndSaveAiMessage(
  supabase: SupabaseClient,
  replyToken: string,
  params: {
    appUser: AppUser;
    lineUserId: string;
    messageText: string;
    quickReply?: Record<string, unknown>;
    payload?: Record<string, unknown>;
  }
) {
  const message: Record<string, unknown> = {
    type: "text",
    text: params.messageText
  };
  if (params.quickReply) {
    message.quickReply = params.quickReply;
  }

  await replyLineMessages(replyToken, [message]);
  await saveLineConversationMessage(supabase, {
    userId: params.appUser.id,
    lineUserId: params.lineUserId,
    direction: "outgoing",
    senderType: "ai",
    conversationType: "career_consultation",
    messageType: "text",
    messageText: params.messageText,
    payload: {
      message,
      ...(params.payload || {})
    }
  });
}

function isMissingHandoffTable(error: unknown) {
  return errorMessage(error).includes("line_handoff_requests");
}

async function getOpenHandoffRequest(supabase: SupabaseClient, lineUserId: string) {
  const { data, error } = await supabase
    .from("line_handoff_requests")
    .select("id, status, notification_target, notified_at")
    .eq("line_user_id", lineUserId)
    .in("status", ["new", "notified", "notification_failed", "in_progress"])
    .order("requested_at", { ascending: false })
    .limit(1)
    .maybeSingle();

  if (error) {
    if (!isMissingHandoffTable(error)) console.warn("handoff request lookup failed", error);
    return null;
  }

  return (data || null) as LineHandoffRequest | null;
}

async function createLineHandoffRequest(
  supabase: SupabaseClient,
  params: {
    appUser: AppUser;
    lineUserId: string;
    aiState: AiConversationState | null;
    context: AiCareerContext;
    now: string;
  }
) {
  const existing = await getOpenHandoffRequest(supabase, params.lineUserId);
  if (existing) {
    return { request: existing, created: false };
  }

  const { data, error } = await supabase
    .from("line_handoff_requests")
    .insert({
      user_id: params.appUser.id,
      line_user_id: params.lineUserId,
      internal_user_id: params.appUser.internal_user_id || null,
      display_name: params.appUser.display_name || null,
      status: "new",
      source: "ai_cta",
      ai_session_id: params.aiState?.current_session_id || null,
      ai_reply_count: Number(params.aiState?.ai_reply_count || 0),
      max_replies: Number(params.aiState?.max_replies || DEFAULT_AI_MAX_REPLIES),
      requested_at: params.now,
      payload: {
        diagnosis: params.context.diagnosis,
        preferences: params.context.preferences,
        recentMessages: params.context.recentMessages
      },
      retention_expires_at: createRetentionExpiresAt(),
      created_at: params.now,
      updated_at: params.now
    })
    .select("id, status, notification_target, notified_at")
    .single();

  if (error) {
    if (!isMissingHandoffTable(error)) console.warn("handoff request insert failed", error);
    return { request: null, created: false };
  }

  return { request: data as LineHandoffRequest, created: true };
}

async function handleAiHandoffRequest(
  supabase: SupabaseClient,
  params: {
    event: Record<string, any>;
    appUser: AppUser;
    lineUserId: string;
    request: Request;
  },
  now: string
) {
  const aiState = await getAiConversationState(supabase, params.lineUserId);
  const wasAlreadyHandedOff = aiState?.status === "handed_off";
  const sessionStartedAt =
    aiState?.current_session_started_at ||
    (await getLatestCareerConsultationSessionStartedAt(supabase, params.lineUserId));
  const context = await getAiCareerContext(
    supabase,
    params.appUser,
    params.lineUserId,
    sessionStartedAt
  );
  const handoffResult = await createLineHandoffRequest(supabase, {
    appUser: params.appUser,
    lineUserId: params.lineUserId,
    aiState,
    context,
    now
  });

  await upsertAiConversationState(supabase, {
    appUser: params.appUser,
    lineUserId: params.lineUserId,
    status: "handed_off",
    handedOffAt: now,
    lastUserMessageAt: now,
    payload: {
      handoffRequestId: handoffResult.request?.id || null,
      handoffCreated: handoffResult.created,
      notificationStatus: "pending_in_admin"
    }
  });

  try {
    await insertEvent(supabase, "line_handoff_requested", {
      lineUserId: params.lineUserId,
      payload: {
        internalUserId: params.appUser.internal_user_id || null,
        handoffRequestId: handoffResult.request?.id || null,
        handoffCreated: handoffResult.created,
        notificationStatus: "pending_in_admin"
      },
      request: params.request
    });
  } catch (eventError) {
    console.warn("line_handoff_requested event insert failed", eventError);
  }

  await replyAndSaveLineMessages(
    supabase,
    params.event.replyToken,
    [
      wasAlreadyHandedOff && !handoffResult.created
        ? buildAiAlreadyHandedOffMessage()
        : buildAiHandoffAcceptedMessage()
    ],
    {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      conversationType: "career_consultation"
    }
  );

  return true;
}

async function continueAiCareerConversation(
  supabase: SupabaseClient,
  params: {
    event: Record<string, any>;
    appUser: AppUser;
    lineUserId: string;
    request: Request;
  },
  aiSettings: AiConversationSettings,
  previousSessionStartedAt: string | null,
  now: string
) {
  const maxReplies = aiSettings.maxReplies;
  const aiState = await startAiConversationSession(supabase, {
    appUser: params.appUser,
    lineUserId: params.lineUserId,
    maxReplies
  });
  const sessionStartedAt = aiState?.current_session_started_at || now;

  try {
    const context = await getAiCareerContext(
      supabase,
      params.appUser,
      params.lineUserId,
      previousSessionStartedAt
    );
    const isFinalReply = maxReplies <= 1;
    const result = await generateAiCareerReply({
      userText:
        "ユーザーが「もう少しAIに聞く」を選択しました。直近会話の続きとして、自然な補足または確認質問を1つだけ返してください。",
      aiReplyCount: 0,
      maxReplies,
      isFinalReply,
      context
    });

    if (!result.careerRelated) {
      await upsertAiConversationState(supabase, {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        status: "ai_replying",
        aiReplyCount: 0,
        maxReplies,
        lastUserMessageAt: now
      });
      await replyAndSaveLineMessages(
        supabase,
        params.event.replyToken,
        [buildNonCareerRedirectMessage()],
        {
          appUser: params.appUser,
          lineUserId: params.lineUserId,
          conversationType: "career_consultation"
        }
      );
      return true;
    }

    const messageText = isFinalReply ? `${result.text}\n\n${aiSettings.ctaMessage}` : result.text;
    const nextAiReplyCount = 1;
    await upsertAiConversationState(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      status: isFinalReply ? "cta_shown" : "ai_replying",
      aiReplyCount: nextAiReplyCount,
      maxReplies,
      ctaShownAt: isFinalReply ? now : null,
      lastUserMessageAt: now,
      lastAiReplyAt: now,
      payload: {
        provider: result.provider,
        model: result.model,
        continuedFromCta: true,
        handoffShown: isFinalReply,
        ctaPrimaryText: isFinalReply ? aiSettings.ctaPrimaryText : null,
        ctaSecondaryText: isFinalReply ? aiSettings.ctaSecondaryText : null
      }
    });

    await replyAndSaveAiMessage(supabase, params.event.replyToken, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      messageText,
      quickReply: isFinalReply ? buildAiHandoffQuickReply(aiSettings) : undefined,
      payload: {
        provider: result.provider,
        model: result.model,
        responseId: result.responseId,
        usage: result.usage,
        careerRelated: result.careerRelated,
        aiReplyCount: nextAiReplyCount,
        maxReplies,
        sessionStartedAt,
        previousSessionStartedAt,
        continuedFromCta: true,
        handoffShown: isFinalReply,
        ctaPrimaryText: isFinalReply ? aiSettings.ctaPrimaryText : null,
        ctaSecondaryText: isFinalReply ? aiSettings.ctaSecondaryText : null
      }
    });

    try {
      await insertEvent(supabase, "ai_reply_sent", {
        lineUserId: params.lineUserId,
        payload: {
          internalUserId: params.appUser.internal_user_id || null,
          provider: result.provider,
          model: result.model,
          responseId: result.responseId,
          aiReplyCount: nextAiReplyCount,
          maxReplies,
          sessionStartedAt,
          previousSessionStartedAt,
          continuedFromCta: true,
          handoffShown: isFinalReply,
          usage: result.usage
        },
        request: params.request
      });
    } catch (eventError) {
      console.warn("ai_reply_sent event insert failed", eventError);
    }
  } catch (aiError) {
    console.warn("AI career continuation failed", aiError);
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiFallbackMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
  }

  return true;
}

async function handleAiCareerText(
  supabase: SupabaseClient,
  params: {
    event: Record<string, any>;
    appUser: AppUser;
    lineUserId: string;
    text: string;
    request: Request;
  }
) {
  if (!params.event.replyToken) return true;

  const aiSettings = await getAiConversationSettings(supabase);
  const maxReplies = aiSettings.maxReplies;
  const now = new Date().toISOString();

  if (isCareerConsultationStartText(params.text)) {
    await startAiConversationSession(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      maxReplies
    });
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildCareerConsultationStartMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  if (isAiContinueRequestText(params.text, aiSettings)) {
    const previousAiState = await getAiConversationState(supabase, params.lineUserId);
    const previousSessionStartedAt =
      previousAiState?.current_session_started_at ||
      (await getLatestCareerConsultationSessionStartedAt(supabase, params.lineUserId));
    return continueAiCareerConversation(
      supabase,
      {
        event: params.event,
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        request: params.request
      },
      aiSettings,
      previousSessionStartedAt,
      now
    );
  }

  if (isAiStopText(params.text)) {
    await upsertAiConversationState(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      status: "stopped",
      stoppedAt: now,
      lastUserMessageAt: now
    });
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiStoppedMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  if (isAiHandoffRequestText(params.text, aiSettings)) {
    return handleAiHandoffRequest(
      supabase,
      {
        event: params.event,
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        request: params.request
      },
      now
    );
  }

  let aiState = await getAiConversationState(supabase, params.lineUserId);
  if (aiState?.status === "stopped") {
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiStoppedNoticeMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  if (aiState?.status === "handed_off") {
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiAlreadyHandedOffMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  if (aiState?.status === "cta_shown") {
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiLimitMessage(aiSettings)],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  let sessionStartedAt =
    aiState?.current_session_started_at ||
    (await getLatestCareerConsultationSessionStartedAt(supabase, params.lineUserId));

  if (!sessionStartedAt) {
    aiState = await startAiConversationSession(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      maxReplies
    });
    sessionStartedAt = aiState?.current_session_started_at || now;
  } else {
    aiState = await upsertAiConversationState(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      status: "ai_replying",
      currentSessionId: aiState?.current_session_id || crypto.randomUUID(),
      currentSessionStartedAt: sessionStartedAt,
      maxReplies,
      lastUserMessageAt: now
    }) || aiState;
  }

  const countedAiReplyCount = await getCurrentCareerSessionAiReplyCount(
    supabase,
    params.lineUserId,
    sessionStartedAt
  );
  const stateAiReplyCount =
    aiState && aiState.current_session_started_at === sessionStartedAt
      ? Number(aiState.ai_reply_count || 0)
      : 0;
  const aiReplyCount = Math.max(countedAiReplyCount, stateAiReplyCount);
  if (aiReplyCount >= maxReplies) {
    await upsertAiConversationState(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      status: "cta_shown",
      aiReplyCount,
      maxReplies,
      ctaShownAt: now,
      lastUserMessageAt: now
    });
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiLimitMessage(aiSettings)],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
    return true;
  }

  try {
    const context = await getAiCareerContext(
      supabase,
      params.appUser,
      params.lineUserId,
      sessionStartedAt
    );
    const isFinalReply = aiReplyCount + 1 >= maxReplies;
    const result = await generateAiCareerReply({
      userText: params.text,
      aiReplyCount,
      maxReplies,
      isFinalReply,
      context
    });

    if (!result.careerRelated) {
      await upsertAiConversationState(supabase, {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        status: "ai_replying",
        aiReplyCount,
        maxReplies,
        lastUserMessageAt: now
      });
      await replyAndSaveLineMessages(
        supabase,
        params.event.replyToken,
        [buildNonCareerRedirectMessage()],
        {
          appUser: params.appUser,
          lineUserId: params.lineUserId,
          conversationType: "general"
        }
      );
      return true;
    }

    const messageText = isFinalReply ? `${result.text}\n\n${aiSettings.ctaMessage}` : result.text;
    const nextAiReplyCount = aiReplyCount + 1;
    await upsertAiConversationState(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      status: isFinalReply ? "cta_shown" : "ai_replying",
      aiReplyCount: nextAiReplyCount,
      maxReplies,
      ctaShownAt: isFinalReply ? now : null,
      lastUserMessageAt: now,
      lastAiReplyAt: now,
      payload: {
        provider: result.provider,
        model: result.model,
        handoffShown: isFinalReply,
        ctaPrimaryText: isFinalReply ? aiSettings.ctaPrimaryText : null,
        ctaSecondaryText: isFinalReply ? aiSettings.ctaSecondaryText : null
      }
    });

    await replyAndSaveAiMessage(supabase, params.event.replyToken, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      messageText,
      quickReply: isFinalReply ? buildAiHandoffQuickReply(aiSettings) : undefined,
      payload: {
        provider: result.provider,
        model: result.model,
        responseId: result.responseId,
        usage: result.usage,
        careerRelated: result.careerRelated,
        aiReplyCount: nextAiReplyCount,
        maxReplies,
        sessionStartedAt,
        handoffShown: isFinalReply,
        ctaPrimaryText: isFinalReply ? aiSettings.ctaPrimaryText : null,
        ctaSecondaryText: isFinalReply ? aiSettings.ctaSecondaryText : null
      }
    });

    try {
      await insertEvent(supabase, "ai_reply_sent", {
        lineUserId: params.lineUserId,
        payload: {
          internalUserId: params.appUser.internal_user_id || null,
          provider: result.provider,
          model: result.model,
          responseId: result.responseId,
          aiReplyCount: nextAiReplyCount,
          maxReplies,
          sessionStartedAt,
          handoffShown: isFinalReply,
          usage: result.usage
        },
        request: params.request
      });
    } catch (eventError) {
      console.warn("ai_reply_sent event insert failed", eventError);
    }
  } catch (aiError) {
    console.warn("AI career reply failed", aiError);
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [buildAiFallbackMessage()],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "career_consultation"
      }
    );
  }

  return true;
}

async function replyLineMessages(replyToken: string, messages: unknown[]) {
  const channelAccessToken = Deno.env.get("LINE_CHANNEL_ACCESS_TOKEN");
  if (!channelAccessToken) throw new Error("LINE_CHANNEL_ACCESS_TOKEN is required");

  const response = await fetch("https://api.line.me/v2/bot/message/reply", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${channelAccessToken}`,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ replyToken, messages })
  });

  if (!response.ok) throw new Error(await response.text());
}

async function markLineMessagesAsRead(markAsReadToken: string) {
  const channelAccessToken = Deno.env.get("LINE_CHANNEL_ACCESS_TOKEN");
  if (!channelAccessToken) throw new Error("LINE_CHANNEL_ACCESS_TOKEN is required");

  const response = await fetch("https://api.line.me/v2/bot/chat/markAsRead", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${channelAccessToken}`,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ markAsReadToken })
  });

  if (!response.ok) throw new Error(await response.text());
}

async function markIncomingMessageAsRead(event: Record<string, any>) {
  const token = event.message?.markAsReadToken;
  if (typeof token !== "string" || !token) return;

  try {
    await markLineMessagesAsRead(token);
  } catch (error) {
    console.warn("LINE mark as read failed", error);
  }
}

async function ensureAppUserByLineId(supabase: SupabaseClient, lineUserId: string): Promise<AppUser> {
  const now = new Date().toISOString();
  const { data: existing, error: lookupError } = await supabase
    .from("app_users")
    .select("id, internal_user_id, display_name")
    .eq("line_user_id", lineUserId)
    .maybeSingle();

  if (lookupError) throw lookupError;

  if (existing?.id) {
    const { data, error } = await supabase
      .from("app_users")
      .update({ last_seen_at: now, updated_at: now })
      .eq("id", existing.id)
      .select("id, internal_user_id, display_name")
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
    .select("id, internal_user_id, display_name")
    .single();

  if (error) throw error;
  return data;
}

async function getActiveSurveySession(supabase: SupabaseClient, lineUserId: string) {
  const { data, error } = await supabase
    .from("line_survey_sessions")
    .select("id, user_id, line_user_id, current_step, status")
    .eq("line_user_id", lineUserId)
    .eq("survey_key", CAREER_SURVEY_KEY)
    .eq("status", "in_progress")
    .order("created_at", { ascending: false })
    .limit(1)
    .maybeSingle();

  if (error) throw error;
  return (data || null) as SurveySession | null;
}

async function getOrCreateSurveySession(
  supabase: SupabaseClient,
  appUser: AppUser,
  lineUserId: string
) {
  const existing = await getActiveSurveySession(supabase, lineUserId);
  if (existing) return existing;

  const now = new Date().toISOString();
  const { data, error } = await supabase
    .from("line_survey_sessions")
    .insert({
      user_id: appUser.id,
      line_user_id: lineUserId,
      survey_key: CAREER_SURVEY_KEY,
      status: "in_progress",
      current_step: 0,
      started_at: now,
      retention_expires_at: createRetentionExpiresAt(),
      created_at: now,
      updated_at: now
    })
    .select("id, user_id, line_user_id, current_step, status")
    .single();

  if (error) throw error;
  return data as SurveySession;
}

async function saveSurveyAnswer(
  supabase: SupabaseClient,
  params: {
    session: SurveySession;
    appUser: AppUser;
    lineUserId: string;
    question: SurveyQuestion;
    questionIndex: number;
    questions: SurveyQuestion[];
    option: SurveyOption;
  }
) {
  const now = new Date().toISOString();
  const retentionExpiresAt = createRetentionExpiresAt();
  const nextStep = Math.max(Number(params.session.current_step || 0), params.questionIndex + 1);
  const completed = nextStep >= params.questions.length;

  const { error: answerError } = await supabase.from("line_survey_answers").upsert(
    {
      session_id: params.session.id,
      user_id: params.appUser.id,
      line_user_id: params.lineUserId,
      survey_key: CAREER_SURVEY_KEY,
      question_key: params.question.key,
      question_label: params.question.label,
      answer_value: params.option.value,
      answer_label: params.option.label,
      answered_order: params.questionIndex + 1,
      answered_at: now,
      updated_at: now
    },
    { onConflict: "session_id,question_key" }
  );

  if (answerError) throw answerError;

  const preferencePayload: Record<string, string | null> = {
    user_id: params.appUser.id,
    line_user_id: params.lineUserId,
    survey_session_id: params.session.id,
    [`${params.question.key}`]: params.option.value,
    [`${params.question.key}_label`]: params.option.label,
    retention_expires_at: retentionExpiresAt,
    updated_at: now
  };

  if (completed) preferencePayload.completed_at = now;

  const { error: preferenceError } = await supabase.from("line_user_preferences").upsert(
    preferencePayload,
    { onConflict: "user_id" }
  );
  if (preferenceError) throw preferenceError;

  const { error: sessionError } = await supabase
    .from("line_survey_sessions")
    .update({
      user_id: params.appUser.id,
      current_step: completed ? params.questions.length : nextStep,
      status: completed ? "completed" : "in_progress",
      completed_at: completed ? now : null,
      retention_expires_at: retentionExpiresAt,
      updated_at: now
    })
    .eq("id", params.session.id);

  if (sessionError) throw sessionError;

  const { data: preferences } = await supabase
    .from("line_user_preferences")
    .select("*")
    .eq("user_id", params.appUser.id)
    .maybeSingle();

  return {
    completed,
    nextStep,
    preferences: (preferences || preferencePayload) as Record<string, string | null>
  };
}

async function handleSurveyAnswer(
  supabase: SupabaseClient,
  params: {
    event: Record<string, any>;
    appUser: AppUser;
    lineUserId: string;
    questionKey: string;
    answerValue: string;
    questions: SurveyQuestion[];
    request: Request;
  }
) {
  const questionIndex = findQuestionIndex(params.questions, params.questionKey);
  const question = params.questions[questionIndex];
  if (!question) return false;

  const option = findOptionByValue(question, params.answerValue);
  if (!option) return false;

  const session = await getOrCreateSurveySession(supabase, params.appUser, params.lineUserId);
  if (params.event.type === "postback") {
    await saveLineConversationMessage(supabase, {
      userId: params.appUser.id,
      lineUserId: params.lineUserId,
      direction: "incoming",
      senderType: "user",
      conversationType: "survey",
      messageType: "postback",
      messageText: option.label,
      payload: {
        surveyKey: CAREER_SURVEY_KEY,
        sessionId: session.id,
        questionKey: question.key,
        answerValue: option.value,
        answerLabel: option.label,
        postbackData: params.event.postback?.data || null
      },
      relatedSurveySessionId: session.id,
      occurredAt: getEventOccurredAt(params.event)
    });
  }

  const result = await saveSurveyAnswer(supabase, {
    session,
    appUser: params.appUser,
    lineUserId: params.lineUserId,
    question,
    questionIndex,
    questions: params.questions,
    option
  });

  try {
    await insertEvent(supabase, "line_survey_answer", {
      lineUserId: params.lineUserId,
      payload: {
        internalUserId: params.appUser.internal_user_id || null,
        surveyKey: CAREER_SURVEY_KEY,
        sessionId: session.id,
        questionKey: question.key,
        answerValue: option.value,
        answerLabel: option.label,
        completed: result.completed
      },
      request: params.request
    });
  } catch (eventError) {
    console.warn("line_survey_answer event insert failed", eventError);
  }

  if (result.completed) {
    let surveyCompleteMessage = buildSurveyCompleteMessage(result.preferences);
    let generatedSurveyMessage: Awaited<ReturnType<typeof generateAiSurveyCompleteMessage>> | null = null;
    let aiContext: AiCareerContext | null = null;
    try {
      aiContext = await getAiCareerContext(supabase, params.appUser, params.lineUserId, null);
      generatedSurveyMessage = await generateAiSurveyCompleteMessage({
        questions: params.questions,
        preferences: result.preferences,
        diagnosis: aiContext.diagnosis,
        specialAnswers: aiContext.specialAnswers
      });
      surveyCompleteMessage = buildSurveyCompleteMessage(result.preferences, generatedSurveyMessage.text);
    } catch (aiError) {
      console.warn("AI survey completion message failed", aiError);
    }

    await saveLineConversationSummary(supabase, {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      summaryType: "line_survey",
      summaryKey: `line_survey:${session.id}`,
      summaryText: buildSurveySummaryText(result.preferences),
      sourceMessageCount: params.questions.length,
      relatedSurveySessionId: session.id,
      payload: {
        surveyKey: CAREER_SURVEY_KEY,
        preferences: result.preferences,
        specialAnswers: aiContext?.specialAnswers || [],
        aiGeneratedMessage: generatedSurveyMessage
          ? {
              provider: generatedSurveyMessage.provider,
              model: generatedSurveyMessage.model,
              responseId: generatedSurveyMessage.responseId,
              usage: generatedSurveyMessage.usage
            }
          : null
      }
    });

    if (!params.event.replyToken) return true;

    await replyAndSaveLineMessages(supabase, params.event.replyToken, [surveyCompleteMessage], {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      conversationType: "survey",
      relatedSurveySessionId: session.id
    });
    return true;
  }

  if (!params.event.replyToken) return true;

  await replyAndSaveLineMessages(
    supabase,
    params.event.replyToken,
    [
      buildCareerSurveyQuestionMessage(
        params.questions[result.nextStep],
        `${questionIndex + 1} / ${params.questions.length} 回答しました。`
      )
    ],
    {
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      conversationType: "survey",
      relatedSurveySessionId: session.id
    }
  );
  return true;
}

async function handleSurveyText(
  supabase: SupabaseClient,
  params: {
    event: Record<string, any>;
    appUser: AppUser;
    lineUserId: string;
    text: string;
    request: Request;
  }
) {
  const surveyQuestions = await getCareerSurveyQuestions(supabase);
  const activeSession = await getActiveSurveySession(supabase, params.lineUserId);
  const conversationType = activeSession
    ? "survey"
    : getConversationTypeFromText(params.text, "general");

  await saveLineConversationMessage(supabase, {
    userId: params.appUser.id,
    lineUserId: params.lineUserId,
    direction: "incoming",
    senderType: "user",
    conversationType,
    messageType: "text",
    messageText: params.text,
    payload: {
      lineMessageType: params.event.message?.type || null
    },
    lineMessageId: params.event.message?.id || null,
    relatedSurveySessionId: activeSession?.id || null,
    occurredAt: getEventOccurredAt(params.event)
  });

  if (activeSession) {
    const step = Math.max(0, Math.min(Number(activeSession.current_step || 0), surveyQuestions.length - 1));
    const question = surveyQuestions[step];
    const option = findOptionByText(question, params.text);

    if (!option) {
      if (params.event.replyToken) {
        await replyAndSaveLineMessages(
          supabase,
          params.event.replyToken,
          [createCurrentQuestionMessage(activeSession, surveyQuestions, "選択肢から選んでください。")],
          {
            appUser: params.appUser,
            lineUserId: params.lineUserId,
            conversationType: "survey",
            relatedSurveySessionId: activeSession.id
          }
        );
      }
      return true;
    }

    return handleSurveyAnswer(supabase, {
      event: params.event,
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      questionKey: question.key,
      answerValue: option.value,
      questions: surveyQuestions,
      request: params.request
    });
  }

  const firstQuestion = surveyQuestions[0];
  const firstAnswer = findOptionByText(firstQuestion, params.text);
  if (firstAnswer) {
    return handleSurveyAnswer(supabase, {
      event: params.event,
      appUser: params.appUser,
      lineUserId: params.lineUserId,
      questionKey: firstQuestion.key,
      answerValue: firstAnswer.value,
      questions: surveyQuestions,
      request: params.request
    });
  }

  if (!isSurveyStartText(params.text)) return false;

  const session = await getOrCreateSurveySession(supabase, params.appUser, params.lineUserId);
  if (params.event.replyToken) {
    await replyAndSaveLineMessages(
      supabase,
      params.event.replyToken,
      [createCurrentQuestionMessage(session, surveyQuestions, `希望条件を${surveyQuestions.length}つだけ教えてください。`)],
      {
        appUser: params.appUser,
        lineUserId: params.lineUserId,
        conversationType: "survey",
        relatedSurveySessionId: session.id
      }
    );
  }
  return true;
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const bodyText = await request.text();
    const signature = request.headers.get("x-line-signature");
    const valid = await verifyLineSignature(bodyText, signature);
    if (!valid) return jsonResponse({ error: "Invalid signature" }, 401);

    const body = JSON.parse(bodyText);
    const supabase = getSupabaseClient();

    for (const event of body.events || []) {
      const lineUserId = event.source?.userId || null;

      if (event.type === "follow") {
        try {
          await insertEvent(supabase, "line_friend_added", {
            lineUserId,
            payload: event,
            request
          });
        } catch (eventError) {
          console.warn("line_friend_added event insert failed", eventError);
        }
      }

      if (!lineUserId) continue;

      if (event.type === "message") {
        await markIncomingMessageAsRead(event);
      }

      if (event.type === "postback") {
        const parsed = parseSurveyPostback(event.postback?.data);
        if (!parsed) continue;

        const appUser = await ensureAppUserByLineId(supabase, lineUserId);
        const surveyQuestions = await getCareerSurveyQuestions(supabase);
        await handleSurveyAnswer(supabase, {
          event,
          appUser,
          lineUserId,
          questionKey: parsed.questionKey,
          answerValue: parsed.answerValue,
          questions: surveyQuestions,
          request
        });
      }

      if (event.type === "message" && event.message?.type === "text") {
        const appUser = await ensureAppUserByLineId(supabase, lineUserId);
        const handledSurvey = await handleSurveyText(supabase, {
          event,
          appUser,
          lineUserId,
          text: event.message.text || "",
          request
        });

        if (!handledSurvey) {
          await handleAiCareerText(supabase, {
            event,
            appUser,
            lineUserId,
            text: event.message.text || "",
            request
          });
        }
      }
    }

    return jsonResponse({ ok: true });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
