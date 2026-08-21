/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { insertAdminAuditLog } from "../_shared/admin-audit.ts";
import { hasValidAdminSession } from "../_shared/admin-session.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

const STORAGE_BUCKET = "swipe-images";
const MAX_IMAGE_SIZE = 8 * 1024 * 1024;
const ALLOWED_IMAGE_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);
const CAREER_SURVEY_KEY = "career_preferences";
const LINE_SURVEY_QUESTION_KEYS = new Set([
  "desired_location",
  "job_change_timing",
  "current_job",
  "priority"
]);
const HANDOFF_STATUS_LABELS: Record<string, string> = {
  new: "未対応",
  in_progress: "対応中",
  completed: "対応済み",
  canceled: "対応不要"
};
const HANDOFF_STATUS_VALUES = new Set(Object.keys(HANDOFF_STATUS_LABELS));

type AdminSettingsPayload = {
  comparisonCount?: number;
  comparisonIncrementIntervalHours?: number;
  comparisonIncrementCount?: number;
  comparisonCountUpdatedAt?: string;
  diagnosisQuestionCount?: number;
  jobCount?: number;
  highMatchCount?: number;
  requireLineBeforeResult?: boolean;
  lineAiMaxReplies?: number;
  lineAiCtaMessage?: string;
  lineAiCtaPrimaryLabel?: string;
  lineAiCtaPrimaryText?: string;
  lineAiCtaSecondaryLabel?: string;
  lineAiCtaSecondaryText?: string;
};

type DiagnosisResultPayload = {
  resultType: string;
  name: string;
  catchCopy: string;
  description: string;
  strengths: string[];
  jobs: string[];
  industries: string[];
  lineMessage: string;
  percent: number;
  sortOrder?: number;
};

type SwipeCardPayload = {
  id: string;
  question: string;
  visual: string;
  image: string;
  imageStoragePath?: string;
  yesScores: Record<string, number>;
  noScores: Record<string, number>;
  enabled?: boolean;
  sortOrder?: number;
};

type LineSurveyQuestionPayload = {
  key: string;
  label: string;
  options: Array<{
    value: string;
    label: string;
  }>;
  sortOrder?: number;
  enabled?: boolean;
};

type AdminUserRow = {
  id: string;
  internal_user_id: string | null;
  line_user_id: string | null;
  display_name: string | null;
  initial_utm_source: string | null;
  initial_utm_medium: string | null;
  initial_utm_campaign: string | null;
  initial_device_type: string | null;
  first_seen_at: string | null;
  last_seen_at: string | null;
  created_at: string | null;
  updated_at: string | null;
};

function sanitizePathPart(value: string) {
  return value.replace(/[^a-zA-Z0-9_-]/g, "-").replace(/-+/g, "-");
}

function getImageExtension(file: File) {
  const fromName = file.name.split(".").pop()?.toLowerCase();
  if (fromName && ["jpg", "jpeg", "png", "webp"].includes(fromName)) {
    return fromName === "jpeg" ? "jpg" : fromName;
  }
  if (file.type === "image/png") return "png";
  if (file.type === "image/webp") return "webp";
  return "jpg";
}

function getStoragePathFromPublicUrl(publicUrl: string, supabaseUrl: string) {
  if (!publicUrl) return null;

  try {
    const url = new URL(publicUrl);
    const expectedOrigin = new URL(supabaseUrl).origin;
    const prefix = `/storage/v1/object/public/${STORAGE_BUCKET}/`;

    if (url.origin !== expectedOrigin || !url.pathname.startsWith(prefix)) {
      return null;
    }

    return decodeURIComponent(url.pathname.slice(prefix.length));
  } catch {
    return null;
  }
}

function isMissingStoragePathColumn(error: unknown) {
  return errorMessage(error).includes("image_storage_path");
}

async function ensureImageBucket(supabase: ReturnType<typeof getSupabaseClient>) {
  const { data, error } = await supabase.storage.getBucket(STORAGE_BUCKET);
  if (data && !error) return;

  const { error: createError } = await supabase.storage.createBucket(STORAGE_BUCKET, {
    public: true,
    fileSizeLimit: MAX_IMAGE_SIZE,
    allowedMimeTypes: [...ALLOWED_IMAGE_TYPES]
  });

  if (createError && !String(createError.message || "").includes("already exists")) {
    throw createError;
  }
}

async function uploadCardImage(request: Request) {
  const supabase = getSupabaseClient();
  const formData = await request.formData();
  const file = formData.get("image");
  const cardId = String(formData.get("cardId") || "");

  if (!(file instanceof File)) {
    return jsonResponse({ error: "Image file is required" }, 400);
  }

  if (!cardId) {
    return jsonResponse({ error: "cardId is required" }, 400);
  }

  if (!ALLOWED_IMAGE_TYPES.has(file.type)) {
    return jsonResponse({ error: "Unsupported image type" }, 400);
  }

  if (file.size > MAX_IMAGE_SIZE) {
    return jsonResponse({ error: "Image file is too large" }, 400);
  }

  await ensureImageBucket(supabase);

  const extension = getImageExtension(file);
  const path = `${sanitizePathPart(cardId)}/${Date.now()}-${crypto.randomUUID()}.${extension}`;
  const { error: uploadError } = await supabase.storage.from(STORAGE_BUCKET).upload(path, file, {
    cacheControl: "31536000",
    contentType: file.type,
    upsert: false
  });

  if (uploadError) throw uploadError;

  const { data } = supabase.storage.from(STORAGE_BUCKET).getPublicUrl(path);

  return jsonResponse({
    publicUrl: data.publicUrl,
    path
  });
}

async function removeChangedStorageImages(
  supabase: ReturnType<typeof getSupabaseClient>,
  existingImages: Map<string, string>,
  existingImagePaths: Map<string, string>,
  nextCards: Array<{ id: string; image: string; imageStoragePath?: string }>
) {
  const supabaseUrl = Deno.env.get("SUPABASE_URL") || "";
  const paths = nextCards
    .map((card) => {
      const oldImage = existingImages.get(card.id) || "";
      if (!oldImage || oldImage === card.image) return null;

      const oldPath = existingImagePaths.get(card.id) || getStoragePathFromPublicUrl(oldImage, supabaseUrl);
      const nextPath = card.imageStoragePath || getStoragePathFromPublicUrl(card.image, supabaseUrl);
      if (!oldPath || oldPath === nextPath) return null;

      return oldPath;
    })
    .filter((path): path is string => Boolean(path));

  const uniquePaths = [...new Set(paths)];
  if (uniquePaths.length === 0) return;

  const { error } = await supabase.storage.from(STORAGE_BUCKET).remove(uniquePaths);
  if (error) console.warn("Old image delete failed", error);
}

async function removeDeletedCards(
  supabase: ReturnType<typeof getSupabaseClient>,
  cardIds: string[]
) {
  const uniqueCardIds = [...new Set(cardIds.map((id) => String(id || "").trim()).filter(Boolean))];
  if (uniqueCardIds.length === 0) return 0;

  let deletedCards: Array<Record<string, string | null>> = [];
  const cardsResponse = await supabase
    .from("swipe_cards")
    .select("card_id, image, image_storage_path")
    .in("card_id", uniqueCardIds);

  if (cardsResponse.error && isMissingStoragePathColumn(cardsResponse.error)) {
    const fallbackResponse = await supabase
      .from("swipe_cards")
      .select("card_id, image")
      .in("card_id", uniqueCardIds);
    if (fallbackResponse.error) throw fallbackResponse.error;
    deletedCards = fallbackResponse.data || [];
  } else {
    if (cardsResponse.error) throw cardsResponse.error;
    deletedCards = cardsResponse.data || [];
  }

  const { error, count } = await supabase
    .from("swipe_cards")
    .delete({ count: "exact" })
    .in("card_id", uniqueCardIds);
  if (error) throw error;

  const supabaseUrl = Deno.env.get("SUPABASE_URL") || "";
  const storagePaths = [
    ...new Set(
      deletedCards
        .map((card) => String(card.image_storage_path || "") || getStoragePathFromPublicUrl(String(card.image || ""), supabaseUrl))
        .filter(Boolean)
    )
  ];

  if (storagePaths.length > 0) {
    const { error: storageError } = await supabase.storage.from(STORAGE_BUCKET).remove(storagePaths);
    if (storageError) console.warn("Deleted card image remove failed", storageError);
  }

  return count || 0;
}

async function readMaster() {
  const supabase = getSupabaseClient();

  const [settingsResponse, resultsResponse, cardsResponse] = await Promise.all([
    supabase.from("app_settings").select("*").eq("id", true).maybeSingle(),
    supabase.from("diagnosis_results").select("*").order("sort_order", { ascending: true }),
    supabase.from("swipe_cards").select("*").order("sort_order", { ascending: true })
  ]);

  if (settingsResponse.error) throw settingsResponse.error;
  if (resultsResponse.error) throw resultsResponse.error;
  if (cardsResponse.error) throw cardsResponse.error;

  const surveyQuestionsResponse = await supabase
    .from("line_survey_questions")
    .select("question_key, question_label, options, sort_order, enabled")
    .eq("survey_key", CAREER_SURVEY_KEY)
    .order("sort_order", { ascending: true });
  if (surveyQuestionsResponse.error) {
    console.warn("line survey questions lookup failed", surveyQuestionsResponse.error);
  }

  const settings = settingsResponse.data;

  return {
    settings: settings
      ? {
          comparisonCount: settings.comparison_count,
          comparisonIncrementIntervalHours: settings.comparison_increment_interval_hours,
          comparisonIncrementCount: settings.comparison_increment_count,
          comparisonCountUpdatedAt: settings.comparison_count_updated_at,
          diagnosisQuestionCount: settings.diagnosis_question_count,
          jobCount: settings.job_count,
          highMatchCount: settings.high_match_count,
          requireLineBeforeResult: settings.require_line_before_result,
          lineAiMaxReplies: settings.line_ai_max_replies ?? 4,
          lineAiCtaMessage: settings.line_ai_cta_message || "",
          lineAiCtaPrimaryLabel: settings.line_ai_cta_primary_label || "相談してみる",
          lineAiCtaPrimaryText: settings.line_ai_cta_primary_text || "相談してみる",
          lineAiCtaSecondaryLabel: settings.line_ai_cta_secondary_label || "もう少しAIに聞く",
          lineAiCtaSecondaryText: settings.line_ai_cta_secondary_text || "もう少しAIに聞く"
        }
      : null,
    results: (resultsResponse.data || []).map((result: Record<string, any>) => ({
      resultType: result.result_type,
      name: result.name,
      catchCopy: result.catch_copy,
      description: result.description,
      strengths: result.strengths,
      jobs: result.jobs,
      industries: result.industries,
      lineMessage: result.line_message,
      percent: result.percent,
      sortOrder: result.sort_order
    })),
    cards: (cardsResponse.data || []).map((card: Record<string, any>) => ({
      id: card.card_id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.image_storage_path || "",
      yesScores: card.yes_scores,
      noScores: card.no_scores,
      enabled: card.enabled !== false,
      sortOrder: card.sort_order
    })),
    lineSurveyQuestions: (surveyQuestionsResponse.data || []).map((question: Record<string, any>) => ({
      key: question.question_key,
      label: question.question_label,
      options: Array.isArray(question.options) ? question.options : [],
      sortOrder: question.sort_order,
      enabled: question.enabled !== false
    }))
  };
}

function groupLatestByUser<T extends { user_id?: string | null }>(rows: T[]) {
  const map = new Map<string, T>();
  rows.forEach((row) => {
    if (!row.user_id || map.has(row.user_id)) return;
    map.set(row.user_id, row);
  });
  return map;
}

function groupCountByUser<T extends { user_id?: string | null }>(rows: T[]) {
  const map = new Map<string, number>();
  rows.forEach((row) => {
    if (!row.user_id) return;
    map.set(row.user_id, (map.get(row.user_id) || 0) + 1);
  });
  return map;
}

async function readAdminUsers(url: URL) {
  const supabase = getSupabaseClient();
  const selectedUserId = String(url.searchParams.get("userId") || "").trim();

  const usersResponse = await supabase
    .from("app_users")
    .select(
      [
        "id",
        "internal_user_id",
        "line_user_id",
        "display_name",
        "initial_utm_source",
        "initial_utm_medium",
        "initial_utm_campaign",
        "initial_device_type",
        "first_seen_at",
        "last_seen_at",
        "created_at",
        "updated_at"
      ].join(",")
    )
    .order("last_seen_at", { ascending: false })
    .limit(50);
  if (usersResponse.error) throw usersResponse.error;

  let users = (usersResponse.data || []) as AdminUserRow[];

  if (selectedUserId && !users.some((user) => user.id === selectedUserId)) {
    const selectedResponse = await supabase
      .from("app_users")
      .select(
        [
          "id",
          "internal_user_id",
          "line_user_id",
          "display_name",
          "initial_utm_source",
          "initial_utm_medium",
          "initial_utm_campaign",
          "initial_device_type",
          "first_seen_at",
          "last_seen_at",
          "created_at",
          "updated_at"
        ].join(",")
      )
      .eq("id", selectedUserId)
      .maybeSingle();
    if (selectedResponse.error) throw selectedResponse.error;
    if (selectedResponse.data) users = [selectedResponse.data as AdminUserRow, ...users];
  }

  const userIds = users.map((user) => user.id).filter(Boolean);
  const effectiveSelectedUserId =
    selectedUserId && users.some((user) => user.id === selectedUserId)
      ? selectedUserId
      : users[0]?.id || "";

  const [diagnosesResponse, preferencesResponse, aiStatesResponse, handoffsResponse] =
    userIds.length > 0
      ? await Promise.all([
          supabase
            .from("user_diagnosis_records_for_admin")
            .select(
              "id,user_id,result_type,score_rates,answered_count,utm_source,diagnosed_at"
            )
            .in("user_id", userIds)
            .order("diagnosed_at", { ascending: false })
            .limit(500),
          supabase
            .from("line_user_preferences_for_admin")
            .select(
              [
                "user_id",
                "desired_location_label",
                "job_change_timing_label",
                "current_job_label",
                "priority_label",
                "completed_at",
                "updated_at"
              ].join(",")
            )
            .in("user_id", userIds),
          supabase
            .from("line_ai_conversation_states_for_admin")
            .select(
              [
                "user_id",
                "status",
                "ai_reply_count",
                "max_replies",
                "cta_shown_at",
                "handed_off_at",
                "stopped_at",
                "updated_at"
              ].join(",")
            )
            .in("user_id", userIds),
          supabase
            .from("line_handoff_requests_for_admin")
            .select("id,user_id,status,requested_at,updated_at")
            .in("user_id", userIds)
            .order("requested_at", { ascending: false })
            .limit(200)
        ])
      : [
          { data: [], error: null },
          { data: [], error: null },
          { data: [], error: null },
          { data: [], error: null }
        ];

  if (diagnosesResponse.error) throw diagnosesResponse.error;
  if (preferencesResponse.error) throw preferencesResponse.error;
  if (aiStatesResponse.error) throw aiStatesResponse.error;
  if (handoffsResponse.error) throw handoffsResponse.error;

  const diagnosisRows = diagnosesResponse.data || [];
  const diagnosisLatestByUser = groupLatestByUser(diagnosisRows);
  const diagnosisCountByUser = groupCountByUser(diagnosisRows);
  const preferencesByUser = groupLatestByUser(preferencesResponse.data || []);
  const aiStatesByUser = groupLatestByUser(aiStatesResponse.data || []);
  const handoffsByUser = groupLatestByUser(handoffsResponse.data || []);

  const userSummaries = users.map((user) => {
    const latestDiagnosis = diagnosisLatestByUser.get(user.id) || null;
    const preferences = preferencesByUser.get(user.id) || null;
    const aiState = aiStatesByUser.get(user.id) || null;
    const handoff = handoffsByUser.get(user.id) || null;
    return {
      userId: user.id,
      internalUserId: user.internal_user_id,
      lineUserId: user.line_user_id,
      displayName: user.display_name,
      initialUtmSource: user.initial_utm_source,
      initialUtmMedium: user.initial_utm_medium,
      initialUtmCampaign: user.initial_utm_campaign,
      initialDeviceType: user.initial_device_type,
      firstSeenAt: user.first_seen_at,
      lastSeenAt: user.last_seen_at,
      diagnosisCount: diagnosisCountByUser.get(user.id) || 0,
      latestDiagnosis,
      preferences,
      aiState,
      handoff
    };
  });

  let selectedUser: AdminUserRow | null = null;
  let detail = null;

  if (effectiveSelectedUserId) {
    selectedUser = users.find((user) => user.id === effectiveSelectedUserId) || null;

    const [
      detailDiagnosesResponse,
      detailPreferencesResponse,
      surveyAnswersResponse,
      conversationMessagesResponse,
      aiStateResponse,
      handoffRequestsResponse
    ] = await Promise.all([
      supabase
        .from("user_diagnosis_records_for_admin")
        .select(
          [
            "id",
            "diagnosis_id",
            "result_type",
            "primary_axis",
            "secondary_axis",
            "scores",
            "score_rates",
            "answers",
            "answered_count",
            "total_response_time_ms",
            "utm_source",
            "utm_medium",
            "utm_campaign",
            "device_type",
            "page_path",
            "diagnosed_at",
            "retention_expires_at"
          ].join(",")
        )
        .eq("user_id", effectiveSelectedUserId)
        .order("diagnosed_at", { ascending: false })
        .limit(10),
      supabase
        .from("line_user_preferences_for_admin")
        .select("*")
        .eq("user_id", effectiveSelectedUserId)
        .maybeSingle(),
      supabase
        .from("line_survey_answers")
        .select("question_key,question_label,answer_value,answer_label,answered_order,answered_at")
        .eq("user_id", effectiveSelectedUserId)
        .order("answered_at", { ascending: false })
        .limit(20),
      supabase
        .from("line_conversation_messages_for_admin")
        .select(
          [
            "id",
            "direction",
            "sender_type",
            "conversation_type",
            "message_type",
            "message_text",
            "occurred_at",
            "body_retention_expires_at"
          ].join(",")
        )
        .eq("user_id", effectiveSelectedUserId)
        .order("occurred_at", { ascending: false })
        .limit(30),
      supabase
        .from("line_ai_conversation_states_for_admin")
        .select("*")
        .eq("user_id", effectiveSelectedUserId)
        .maybeSingle(),
      supabase
        .from("line_handoff_requests_for_admin")
        .select("*")
        .eq("user_id", effectiveSelectedUserId)
        .order("requested_at", { ascending: false })
        .limit(10)
    ]);

    if (detailDiagnosesResponse.error) throw detailDiagnosesResponse.error;
    if (detailPreferencesResponse.error) throw detailPreferencesResponse.error;
    if (surveyAnswersResponse.error) throw surveyAnswersResponse.error;
    if (conversationMessagesResponse.error) throw conversationMessagesResponse.error;
    if (aiStateResponse.error) throw aiStateResponse.error;
    if (handoffRequestsResponse.error) throw handoffRequestsResponse.error;

    detail = {
      user: selectedUser
        ? {
            userId: selectedUser.id,
            internalUserId: selectedUser.internal_user_id,
            lineUserId: selectedUser.line_user_id,
            displayName: selectedUser.display_name,
            initialUtmSource: selectedUser.initial_utm_source,
            initialUtmMedium: selectedUser.initial_utm_medium,
            initialUtmCampaign: selectedUser.initial_utm_campaign,
            initialDeviceType: selectedUser.initial_device_type,
            firstSeenAt: selectedUser.first_seen_at,
            lastSeenAt: selectedUser.last_seen_at,
            createdAt: selectedUser.created_at,
            updatedAt: selectedUser.updated_at
          }
        : null,
      diagnoses: detailDiagnosesResponse.data || [],
      preferences: detailPreferencesResponse.data || null,
      surveyAnswers: surveyAnswersResponse.data || [],
      conversationMessages: conversationMessagesResponse.data || [],
      aiState: aiStateResponse.data || null,
      handoffRequests: handoffRequestsResponse.data || []
    };
  }

  return {
    users: userSummaries,
    selectedUserId: effectiveSelectedUserId,
    detail
  };
}

async function updateHandoffStatus(body: { handoffId?: string; status?: string }) {
  const handoffId = String(body.handoffId || "").trim();
  const status = String(body.status || "").trim();

  if (!handoffId) {
    return jsonResponse({ error: "handoffId is required" }, 400);
  }

  if (!HANDOFF_STATUS_VALUES.has(status)) {
    return jsonResponse({ error: "Invalid handoff status" }, 400);
  }

  const supabase = getSupabaseClient();
  const { data, error } = await supabase
    .from("line_handoff_requests")
    .update({
      status,
      updated_at: new Date().toISOString()
    })
    .eq("id", handoffId)
    .select("id,user_id,line_user_id,internal_user_id,display_name,status,requested_at,updated_at")
    .maybeSingle();

  if (error) throw error;
  if (!data) {
    return jsonResponse({ error: "Handoff request not found" }, 404);
  }

  return jsonResponse({
    handoff: data,
    statusLabel: HANDOFF_STATUS_LABELS[status]
  });
}

function sanitizeOptionValue(value: string, fallback: string) {
  const normalized = value
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9_-]/g, "_")
    .replace(/_+/g, "_")
    .replace(/^_+|_+$/g, "");
  return normalized || fallback;
}

function sanitizeLineSurveyQuestions(questions: LineSurveyQuestionPayload[]) {
  return questions
    .map((question, index) => {
      const key = String(question.key || "").trim();
      if (!LINE_SURVEY_QUESTION_KEYS.has(key)) return null;

      const label = String(question.label || "").trim();
      const options = Array.isArray(question.options) ? question.options : [];
      const sanitizedOptions = options
        .map((option, optionIndex) => {
          const optionLabel = String(option.label || "").trim().slice(0, 20);
          if (!optionLabel) return null;
          return {
            value: sanitizeOptionValue(String(option.value || ""), `option_${optionIndex + 1}`),
            label: optionLabel
          };
        })
        .filter((option): option is { value: string; label: string } => Boolean(option));

      if (!label || sanitizedOptions.length === 0) return null;

      return {
        survey_key: CAREER_SURVEY_KEY,
        question_key: key,
        question_label: label.slice(0, 120),
        options: sanitizedOptions,
        sort_order: Number(question.sortOrder || index + 1),
        enabled: question.enabled !== false,
        updated_at: new Date().toISOString()
      };
    })
    .filter((question): question is NonNullable<typeof question> => Boolean(question));
}

async function writeMaster(body: {
  settings?: AdminSettingsPayload;
  results?: DiagnosisResultPayload[];
  cards?: SwipeCardPayload[];
  deletedCardIds?: string[];
  lineSurveyQuestions?: LineSurveyQuestionPayload[];
}) {
  const supabase = getSupabaseClient();
  const deletedCardIds = Array.isArray(body.deletedCardIds) ? body.deletedCardIds : [];

  if (deletedCardIds.length > 0) {
    await removeDeletedCards(supabase, deletedCardIds);
  }

  if (body.settings) {
    const { error } = await supabase.from("app_settings").upsert({
      id: true,
      comparison_count: Number(body.settings.comparisonCount || 0),
      comparison_increment_interval_hours: Number(
        body.settings.comparisonIncrementIntervalHours || 0
      ),
      comparison_increment_count: Number(body.settings.comparisonIncrementCount || 0),
      comparison_count_updated_at:
        body.settings.comparisonCountUpdatedAt || new Date().toISOString(),
      diagnosis_question_count: Math.max(
        1,
        Math.floor(Number(body.settings.diagnosisQuestionCount || 40))
      ),
      job_count: Number(body.settings.jobCount || 0),
      high_match_count: Number(body.settings.highMatchCount || 0),
      require_line_before_result: Boolean(body.settings.requireLineBeforeResult),
      line_ai_max_replies: Math.max(
        1,
        Math.min(10, Math.floor(Number(body.settings.lineAiMaxReplies || 4)))
      ),
      line_ai_cta_message: String(body.settings.lineAiCtaMessage || ""),
      line_ai_cta_primary_label: String(body.settings.lineAiCtaPrimaryLabel || "相談してみる"),
      line_ai_cta_primary_text: String(body.settings.lineAiCtaPrimaryText || "相談してみる"),
      line_ai_cta_secondary_label: String(body.settings.lineAiCtaSecondaryLabel || "もう少しAIに聞く"),
      line_ai_cta_secondary_text: String(body.settings.lineAiCtaSecondaryText || "もう少しAIに聞く"),
      updated_at: new Date().toISOString()
    });
    if (error) throw error;
  }

  if (Array.isArray(body.results) && body.results.length > 0) {
    const { error } = await supabase.from("diagnosis_results").upsert(
      body.results.map((result, index) => ({
        result_type: result.resultType,
        name: result.name,
        catch_copy: result.catchCopy,
        description: result.description,
        strengths: result.strengths || [],
        jobs: result.jobs || [],
        industries: result.industries || [],
        line_message: result.lineMessage,
        percent: Number(result.percent || 8),
        sort_order: Number(result.sortOrder || index + 1),
        updated_at: new Date().toISOString()
      }))
    );
    if (error) throw error;
  }

  if (Array.isArray(body.cards) && body.cards.length > 0) {
    const supabaseUrl = Deno.env.get("SUPABASE_URL") || "";
    const deletedIdSet = new Set(deletedCardIds);
    const nextCards = body.cards.filter((card) => !deletedIdSet.has(card.id)).map((card, index) => ({
      id: card.id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.imageStoragePath || getStoragePathFromPublicUrl(card.image, supabaseUrl) || "",
      yesScores: card.yesScores || {},
      noScores: card.noScores || {},
      enabled: card.enabled !== false,
      sortOrder: Number(card.sortOrder || index + 1)
    }));
    if (nextCards.length === 0) return readMaster();

    const cardIds = nextCards.map((card) => card.id);
    const existingImages = new Map<string, string>();
    const existingImagePaths = new Map<string, string>();
    let supportsStoragePathColumn = true;
    let existingCards: Array<Record<string, string | null>> = [];
    const existingCardsResponse = await supabase
      .from("swipe_cards")
      .select("card_id, image, image_storage_path")
      .in("card_id", cardIds);

    if (existingCardsResponse.error && isMissingStoragePathColumn(existingCardsResponse.error)) {
      supportsStoragePathColumn = false;
      const fallbackResponse = await supabase
        .from("swipe_cards")
        .select("card_id, image")
        .in("card_id", cardIds);
      if (fallbackResponse.error) throw fallbackResponse.error;
      existingCards = fallbackResponse.data || [];
    } else {
      if (existingCardsResponse.error) throw existingCardsResponse.error;
      existingCards = existingCardsResponse.data || [];
    }

    (existingCards || []).forEach((card) => {
      existingImages.set(String(card.card_id), String(card.image || ""));
      existingImagePaths.set(String(card.card_id), String(card.image_storage_path || ""));
    });

    const rowsWithStoragePath = nextCards.map((card) => ({
      card_id: card.id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      image_storage_path: card.imageStoragePath || null,
      yes_scores: card.yesScores,
      no_scores: card.noScores,
      enabled: card.enabled,
      sort_order: card.sortOrder,
      updated_at: new Date().toISOString()
    }));

    const rows = supportsStoragePathColumn
      ? rowsWithStoragePath
      : rowsWithStoragePath.map(({ image_storage_path: _imageStoragePath, ...row }) => row);

    let { error } = await supabase.from("swipe_cards").upsert(rows);
    if (error && supportsStoragePathColumn && isMissingStoragePathColumn(error)) {
      supportsStoragePathColumn = false;
      const fallbackRows = rowsWithStoragePath.map(({ image_storage_path: _imageStoragePath, ...row }) => row);
      ({ error } = await supabase.from("swipe_cards").upsert(fallbackRows));
    }
    if (error) throw error;

    await removeChangedStorageImages(supabase, existingImages, existingImagePaths, nextCards);
  }

  if (Array.isArray(body.lineSurveyQuestions)) {
    const rows = sanitizeLineSurveyQuestions(body.lineSurveyQuestions);
    if (rows.length === 0) {
      return readMaster();
    }

    const { error } = await supabase
      .from("line_survey_questions")
      .upsert(rows, { onConflict: "survey_key,question_key" });
    if (error) throw error;
  }

  return readMaster();
}

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  try {
    const url = new URL(request.url);

    if (request.method === "GET") {
      if (url.searchParams.get("action") === "users") {
        if (!(await hasValidAdminSession(request))) {
          return jsonResponse({ error: "Unauthorized" }, 401);
        }

        const data = await readAdminUsers(url);
        await insertAdminAuditLog(getSupabaseClient(), request, "admin_user_view", {
          metadata: {
            selectedUserId: data.selectedUserId || null,
            usersCount: Array.isArray(data.users) ? data.users.length : 0
          }
        });
        return jsonResponse(data);
      }

      return jsonResponse(await readMaster());
    }

    if (request.method !== "POST") {
      return jsonResponse({ error: "Method not allowed" }, 405);
    }

    if (!(await hasValidAdminSession(request))) {
      return jsonResponse({ error: "Unauthorized" }, 401);
    }

    const auditSupabase = getSupabaseClient();
    if (url.searchParams.get("action") === "upload-card-image") {
      const response = await uploadCardImage(request);
      await insertAdminAuditLog(auditSupabase, request, "admin_image_upload", {
        metadata: { action: "upload-card-image" }
      });
      return response;
    }

    if (url.searchParams.get("action") === "update-handoff-status") {
      const body = await request.json();
      const response = await updateHandoffStatus(body);
      await insertAdminAuditLog(auditSupabase, request, "admin_handoff_status_update", {
        metadata: {
          handoffId: body.handoffId || null,
          status: body.status || null
        }
      });
      return response;
    }

    const body = await request.json();
    const master = await writeMaster(body);
    await insertAdminAuditLog(auditSupabase, request, "admin_master_save", {
      metadata: {
        settingsUpdated: Boolean(body.settings),
        resultsCount: Array.isArray(body.results) ? body.results.length : 0,
        cardsCount: Array.isArray(body.cards) ? body.cards.length : 0,
        deletedCardsCount: Array.isArray(body.deletedCardIds) ? body.deletedCardIds.length : 0,
        lineSurveyQuestionsCount: Array.isArray(body.lineSurveyQuestions)
          ? body.lineSurveyQuestions.length
          : 0
      }
    });
    return jsonResponse(master);
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
