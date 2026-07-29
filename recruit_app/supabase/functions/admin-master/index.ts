/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

const STORAGE_BUCKET = "swipe-images";
const MAX_IMAGE_SIZE = 8 * 1024 * 1024;
const ALLOWED_IMAGE_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);

type AdminSettingsPayload = {
  comparisonCount?: number;
  jobCount?: number;
  highMatchCount?: number;
  requireLineBeforeResult?: boolean;
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
  sortOrder?: number;
};

function hasValidAdminToken(request: Request) {
  const requiredToken = Deno.env.get("ADMIN_API_TOKEN");
  if (!requiredToken) return true;
  return request.headers.get("x-admin-token") === requiredToken;
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
      sortOrder: card.sort_order
    }))
  };
}

async function writeMaster(body: {
  settings?: AdminSettingsPayload;
  results?: DiagnosisResultPayload[];
  cards?: SwipeCardPayload[];
}) {
  const supabase = getSupabaseClient();

  if (body.settings) {
    const { error } = await supabase.from("app_settings").upsert({
      id: true,
      comparison_count: Number(body.settings.comparisonCount || 0),
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
    const nextCards = body.cards.map((card, index) => ({
      id: card.id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.imageStoragePath || getStoragePathFromPublicUrl(card.image, supabaseUrl) || "",
      yesScores: card.yesScores || {},
      noScores: card.noScores || {},
      sortOrder: Number(card.sortOrder || index + 1)
    }));
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
  const options = handleOptions(request);
  if (options) return options;

  try {
    if (request.method === "GET") {
      return jsonResponse(await readMaster());
    }

    if (request.method !== "POST") {
      return jsonResponse({ error: "Method not allowed" }, 405);
    }

    if (!hasValidAdminToken(request)) {
      return jsonResponse({ error: "Unauthorized" }, 401);
    }

    const url = new URL(request.url);
    if (url.searchParams.get("action") === "upload-card-image") {
      return uploadCardImage(request);
    }

    const body = await request.json();
    return jsonResponse(await writeMaster(body));
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
