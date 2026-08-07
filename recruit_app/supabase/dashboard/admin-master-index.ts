import { createClient } from "npm:@supabase/supabase-js@2";

const STORAGE_BUCKET = "swipe-images";
const MAX_IMAGE_SIZE = 8 * 1024 * 1024;
const ALLOWED_IMAGE_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-admin-token, x-admin-session",
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

function getAdminClientInfo(request: Request) {
  const forwardedFor = request.headers.get("x-forwarded-for") || "";
  const ipAddress =
    forwardedFor.split(",")[0]?.trim() ||
    request.headers.get("cf-connecting-ip") ||
    request.headers.get("x-real-ip") ||
    "unknown";

  return {
    ipAddress,
    userAgent: request.headers.get("user-agent") || null
  };
}

async function insertAdminAuditLog(
  supabase: ReturnType<typeof createClient>,
  request: Request,
  eventName: string,
  options: { success?: boolean; metadata?: Record<string, unknown> } = {}
) {
  const clientInfo = getAdminClientInfo(request);
  const { error } = await supabase.from("admin_audit_logs").insert({
    event_name: eventName,
    success: options.success !== false,
    metadata: options.metadata || {},
    ip_address: clientInfo.ipAddress,
    user_agent: clientInfo.userAgent
  });

  if (error) console.warn("admin audit insert failed", error);
}

function base64UrlDecodeBytes(value: string) {
  const normalized = value.replaceAll("-", "+").replaceAll("_", "/");
  const padded = normalized.padEnd(Math.ceil(normalized.length / 4) * 4, "=");
  const binary = atob(padded);
  return Uint8Array.from(binary, (char) => char.charCodeAt(0));
}

function base64UrlDecodeText(value: string) {
  return new TextDecoder().decode(base64UrlDecodeBytes(value));
}

async function importSessionKey(secret: string, usage: KeyUsage[]) {
  return crypto.subtle.importKey(
    "raw",
    new TextEncoder().encode(secret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    usage
  );
}

async function verifyPayloadSignature(payload: string, signature: string, secret: string) {
  const key = await importSessionKey(secret, ["verify"]);
  return crypto.subtle.verify(
    "HMAC",
    key,
    base64UrlDecodeBytes(signature),
    new TextEncoder().encode(payload)
  );
}

async function hasValidAdminSession(request: Request) {
  const secret = Deno.env.get("ADMIN_SESSION_SECRET");
  if (!secret) return false;

  const token = request.headers.get("x-admin-session") || "";
  const parts = token.split(".");
  if (parts.length !== 2 || !parts[0] || !parts[1]) return false;

  try {
    const verified = await verifyPayloadSignature(parts[0], parts[1], secret);
    if (!verified) return false;

    const payload = JSON.parse(base64UrlDecodeText(parts[0]));
    return payload?.purpose === "admin" && Number(payload.exp || 0) > Date.now();
  } catch {
    return false;
  }
}

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

async function ensureImageBucket(supabase: ReturnType<typeof createClient>) {
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
  supabase: ReturnType<typeof createClient>,
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
  supabase: ReturnType<typeof createClient>,
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
          requireLineBeforeResult: settings.require_line_before_result
        }
      : null,
    results: (resultsResponse.data || []).map((result) => ({
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
    cards: (cardsResponse.data || []).map((card) => ({
      id: card.card_id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.image_storage_path || "",
      yesScores: card.yes_scores,
      noScores: card.no_scores,
      enabled: card.enabled !== false,
      sortOrder: card.sort_order
    }))
  };
}

async function writeMaster(body: {
  settings?: {
    comparisonCount?: number;
    comparisonIncrementIntervalHours?: number;
    comparisonIncrementCount?: number;
    comparisonCountUpdatedAt?: string;
    diagnosisQuestionCount?: number;
    jobCount?: number;
    highMatchCount?: number;
    requireLineBeforeResult?: boolean;
  };
  results?: Array<{
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
  }>;
  cards?: Array<{
    id: string;
    question: string;
    visual: string;
    image: string;
    imageStoragePath?: string;
    yesScores: Record<string, number>;
    noScores: Record<string, number>;
    enabled?: boolean;
    sortOrder?: number;
  }>;
  deletedCardIds?: string[];
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

  return readMaster();
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  try {
    if (request.method === "GET") {
      return jsonResponse(await readMaster());
    }

    if (request.method !== "POST") {
      return jsonResponse({ error: "Method not allowed" }, 405);
    }

    if (!(await hasValidAdminSession(request))) {
      return jsonResponse({ error: "Unauthorized" }, 401);
    }

    const auditSupabase = getSupabaseClient();
    const url = new URL(request.url);
    if (url.searchParams.get("action") === "upload-card-image") {
      const response = await uploadCardImage(request);
      await insertAdminAuditLog(auditSupabase, request, "admin_image_upload", {
        metadata: { action: "upload-card-image" }
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
        deletedCardsCount: Array.isArray(body.deletedCardIds) ? body.deletedCardIds.length : 0
      }
    });
    return jsonResponse(master);
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
