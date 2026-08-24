import {
  DEFAULT_SETTINGS,
  buildSettingsFromMaster,
  getConfiguredCards,
  getConfiguredResults,
  getCurrentComparisonCount,
  loadAdminSettings,
  saveAdminSettings,
  serializeSettingsForMaster
} from "./data.js?v=20260821-specialq-flow";

const config = window.CAREER_APP_CONFIG || {};
const ADMIN_SESSION_STORAGE_KEY = "ai-career-admin-session";
let settings = loadAdminSettings();
let results = getConfiguredResults(settings);
let cards = getConfiguredCards(settings);
let kpiSummary = null;
let kpiRange = "daily";
let userDashboard = null;
let selectedAdminUserId = "";
let adminUserTab = "diagnoses";
let activeAdminPage = "kpi";
let adminSessionToken = sessionStorage.getItem(ADMIN_SESSION_STORAGE_KEY) || "";
let adminEventsBound = false;

const $ = (selector) => document.querySelector(selector);
const IMAGE_UPLOAD_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);
const MAX_UPLOAD_WIDTH = 1200;
const TARGET_UPLOAD_BYTES = 150 * 1024;
const INITIAL_WEBP_QUALITY = 0.86;
const MIN_WEBP_QUALITY = 0.62;
const WEBP_QUALITY_STEP = 0.06;
// 管理操作ログを画面に戻す場合は true に変更して src/admin.js をアップロードする。
const SHOW_ADMIN_AUDIT_LOGS = false;
const DEFAULT_LINE_SURVEY_QUESTIONS = [
  {
    key: "desired_location",
    label: "希望勤務地は？",
    options: [
      { value: "tokyo", label: "東京" },
      { value: "osaka", label: "大阪" },
      { value: "hokkaido", label: "北海道" },
      { value: "other", label: "その他" }
    ],
    sortOrder: 1
  },
  {
    key: "job_change_timing",
    label: "転職時期は？",
    options: [
      { value: "soon", label: "すぐ" },
      { value: "within_3_months", label: "3ヶ月以内" },
      { value: "within_6_months", label: "半年以内" },
      { value: "undecided", label: "まだ未定" }
    ],
    sortOrder: 2
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
    ],
    sortOrder: 3
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
    ],
    sortOrder: 4
  }
];

let lineSurveyQuestions = normalizeLineSurveyQuestions([]);
let selectedLineSurveyKey = lineSurveyQuestions[0]?.key || "";
let specialQuestions = [];
let selectedSpecialQuestionKey = "";
let deletedSpecialQuestionKeys = [];

function escapeHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

function splitLines(value) {
  return String(value)
    .split("\n")
    .map((item) => item.trim())
    .filter(Boolean);
}

function joinLines(value) {
  return Array.isArray(value) ? value.join("\n") : "";
}

function slugifyLineSurveyOption(value, fallback) {
  const normalized = String(value || "")
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9_-]/g, "_")
    .replace(/_+/g, "_")
    .replace(/^_+|_+$/g, "");
  return normalized || fallback;
}

function getOptionLabel(option) {
  if (typeof option === "string") return option.trim();
  return String(option?.label || "").trim();
}

function getOptionValue(option, index) {
  if (typeof option === "object" && option !== null && option.value) {
    return slugifyLineSurveyOption(option.value, `option_${index + 1}`);
  }
  return slugifyLineSurveyOption(getOptionLabel(option), `option_${index + 1}`);
}

function normalizeLineSurveyQuestions(value) {
  const source = Array.isArray(value) && value.length ? value : DEFAULT_LINE_SURVEY_QUESTIONS;
  const fallbackByKey = new Map(DEFAULT_LINE_SURVEY_QUESTIONS.map((question) => [question.key, question]));

  return source
    .map((question, index) => {
      const key = String(question?.key || "").trim();
      const fallback = fallbackByKey.get(key);
      if (!fallback) return null;

      const options = Array.isArray(question.options) ? question.options : fallback.options;
      const normalizedOptions = options
        .map((option, optionIndex) => {
          const label = getOptionLabel(option).slice(0, 20);
          if (!label) return null;
          return {
            value: getOptionValue(option, optionIndex),
            label
          };
        })
        .filter(Boolean);

      return {
        key,
        label: String(question.label || fallback.label).trim() || fallback.label,
        options: normalizedOptions.length
          ? normalizedOptions
          : fallback.options.map((option, optionIndex) => ({
              value: getOptionValue(option, optionIndex),
              label: getOptionLabel(option)
            })),
        sortOrder: Number(question.sortOrder || index + 1),
        enabled: question.enabled !== false
      };
    })
    .filter(Boolean)
    .sort((a, b) => Number(a.sortOrder || 0) - Number(b.sortOrder || 0));
}

function normalizeSpecialQuestionKey(value, fallback = "") {
  const normalized = String(value || "")
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9_-]/g, "-")
    .replace(/-+/g, "-")
    .replace(/^-+|-+$/g, "");
  return normalized || fallback;
}

function normalizeSpecialQuestions(value) {
  const source = Array.isArray(value) ? value : [];

  return source
    .map((question, index) => {
      const key = normalizeSpecialQuestionKey(
        question?.key || question?.questionKey,
        `special-${String(index + 1).padStart(3, "0")}`
      );
      const questionText = String(question?.questionText || "").trim();
      const optionALabel = String(question?.optionALabel || "").trim();
      const optionBLabel = String(question?.optionBLabel || "").trim();
      if (!key || !questionText || !optionALabel || !optionBLabel) return null;

      return {
        id: question?.id || "",
        key,
        questionText,
        optionALabel,
        optionBLabel,
        category: String(question?.category || "preference").trim() || "preference",
        enabled: question?.enabled !== false,
        insertAfterOrder: Math.max(1, Math.floor(Number(question?.insertAfterOrder || 1))),
        displayOrder: Math.max(1, Math.floor(Number(question?.displayOrder || index + 1))),
        backgroundImageUrl: String(question?.backgroundImageUrl || "").trim(),
        backgroundStoragePath: String(question?.backgroundStoragePath || "").trim(),
        payload:
          question?.payload && typeof question.payload === "object" && !Array.isArray(question.payload)
            ? question.payload
            : {}
      };
    })
    .filter(Boolean)
    .sort((a, b) => {
      if (a.insertAfterOrder !== b.insertAfterOrder) return a.insertAfterOrder - b.insertAfterOrder;
      if (a.displayOrder !== b.displayOrder) return a.displayOrder - b.displayOrder;
      return a.key.localeCompare(b.key);
    });
}

function formatBytes(bytes) {
  return `${Math.max(1, Math.round(bytes / 1024))}KB`;
}

function getOutputFileName(file, extension) {
  const baseName = file.name.replace(/\.[^.]+$/, "") || "swipe-image";
  return `${baseName}.${extension}`;
}

function canvasToBlob(canvas, type, quality) {
  return new Promise((resolve, reject) => {
    canvas.toBlob((blob) => {
      if (!blob) {
        reject(new Error("画像の変換に失敗しました"));
        return;
      }
      resolve(blob);
    }, type, quality);
  });
}

function loadImageSource(file) {
  return new Promise((resolve, reject) => {
    const image = new Image();
    const objectUrl = URL.createObjectURL(file);

    image.addEventListener(
      "load",
      () => {
        resolve({
          image,
          width: image.naturalWidth,
          height: image.naturalHeight,
          cleanup: () => URL.revokeObjectURL(objectUrl)
        });
      },
      { once: true }
    );
    image.addEventListener(
      "error",
      () => {
        URL.revokeObjectURL(objectUrl);
        reject(new Error("画像を読み込めませんでした"));
      },
      { once: true }
    );
    image.src = objectUrl;
  });
}

async function optimizeImageForUpload(file) {
  if (!IMAGE_UPLOAD_TYPES.has(file.type)) {
    throw new Error("JPG / PNG / WebP の画像を選択してください");
  }

  const source = await loadImageSource(file);

  try {
    const scale = Math.min(1, MAX_UPLOAD_WIDTH / source.width);
    const width = Math.max(1, Math.round(source.width * scale));
    const height = Math.max(1, Math.round(source.height * scale));

    const canvas = document.createElement("canvas");
    canvas.width = width;
    canvas.height = height;
    const context = canvas.getContext("2d");
    if (!context) throw new Error("画像の変換に失敗しました");

    context.drawImage(source.image, 0, 0, width, height);

    let quality = INITIAL_WEBP_QUALITY;
    let blob = await canvasToBlob(canvas, "image/webp", quality);

    while (blob.size > TARGET_UPLOAD_BYTES && quality > MIN_WEBP_QUALITY) {
      quality = Math.max(MIN_WEBP_QUALITY, Number((quality - WEBP_QUALITY_STEP).toFixed(2)));
      blob = await canvasToBlob(canvas, "image/webp", quality);
    }

    if (blob.type !== "image/webp") {
      blob = await canvasToBlob(canvas, "image/jpeg", 0.82);
      return new File([blob], getOutputFileName(file, "jpg"), {
        type: "image/jpeg",
        lastModified: Date.now()
      });
    }

    if (scale === 1 && file.size <= TARGET_UPLOAD_BYTES && file.size < blob.size) {
      return file;
    }

    return new File([blob], getOutputFileName(file, "webp"), {
      type: "image/webp",
      lastModified: Date.now()
    });
  } finally {
    source.cleanup();
  }
}

function setStatus(message) {
  $("#adminStatus").textContent = message;
  window.setTimeout(() => {
    if ($("#adminStatus").textContent === message) $("#adminStatus").textContent = "";
  }, 2600);
}

function clearAdminSession() {
  adminSessionToken = "";
  sessionStorage.removeItem(ADMIN_SESSION_STORAGE_KEY);
  window.location.reload();
}

function getFunctionsBaseUrl() {
  return String(config.supabaseFunctionsBaseUrl || "").replace(/\/$/, "");
}

function getAdminHeaders() {
  const headers = { "Content-Type": "application/json" };
  if (adminSessionToken) headers["x-admin-session"] = adminSessionToken;
  return headers;
}

function getAdminTokenHeaders() {
  const headers = {};
  if (adminSessionToken) headers["x-admin-session"] = adminSessionToken;
  return headers;
}

function isUnauthorizedError(error) {
  const message = error?.message || "";
  return error?.status === 401 || message.includes("Unauthorized") || message.includes("401");
}

async function requestKpiSummary() {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;
  const params = new URLSearchParams({ days: "14" });
  if (SHOW_ADMIN_AUDIT_LOGS) params.set("includeAdminLogs", "1");

  const response = await fetch(`${baseUrl}/kpi-summary?${params.toString()}`, {
    method: "GET",
    headers: getAdminTokenHeaders()
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "KPI集計の読み込みに失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.json();
}

async function requestAdminMaster(method = "GET", body = null) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;

  const response = await fetch(`${baseUrl}/admin-master`, {
    method,
    headers: getAdminHeaders(),
    body: body ? JSON.stringify(body) : null
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "Supabase保存に失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.json();
}

async function requestAdminUsers(userId = "") {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;

  const params = new URLSearchParams({ action: "users" });
  if (userId) params.set("userId", userId);

  const response = await fetch(`${baseUrl}/admin-master?${params.toString()}`, {
    method: "GET",
    headers: getAdminTokenHeaders()
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "ユーザー情報の読み込みに失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.json();
}

async function requestUpdateHandoffStatus(handoffId, status) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;

  const response = await fetch(`${baseUrl}/admin-master?action=update-handoff-status`, {
    method: "POST",
    headers: getAdminHeaders(),
    body: JSON.stringify({ handoffId, status })
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "対応ステータスの更新に失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.json();
}

async function uploadCardImage(file, originalFile = file) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) {
    setStatus("画像アップロードにはSupabase接続設定が必要です");
    return;
  }

  if (!file || !file.type.startsWith("image/")) {
    setStatus("画像ファイルを選択してください");
    return;
  }

  const cardId = $("#cardSelect").value;
  const formData = new FormData();
  formData.append("image", file);
  formData.append("cardId", cardId);
  formData.append("oldImage", $("#cardImageInput").value.trim());
  formData.append("oldImageStoragePath", $("#cardImageStoragePathInput").value.trim());

  setStatus("画像をアップロード中です…");

  const response = await fetch(`${baseUrl}/admin-master?action=upload-card-image`, {
    method: "POST",
    headers: getAdminTokenHeaders(),
    body: formData
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "画像アップロードに失敗しました");
    error.status = response.status;
    throw error;
  }

  const data = await response.json();
  $("#cardImageInput").value = data.publicUrl;
  $("#cardImageStoragePathInput").value = data.path || "";
  renderCardPreviewFromInputs();
  setStatus(
    `画像をアップロードしました（${formatBytes(originalFile.size)} → ${formatBytes(file.size)}）。保存するとDBを軽い参照情報で更新します`
  );
}

async function uploadSpecialQuestionImage(file, originalFile = file) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) {
    setStatus("画像アップロードにはSupabase接続設定が必要です");
    return;
  }

  if (!file || !file.type.startsWith("image/")) {
    setStatus("画像ファイルを選択してください");
    return;
  }

  const questionKey = $("#specialQuestionKeyInput")?.value.trim();
  if (!questionKey) {
    setStatus("先にスペシャルクエスチョンを選択してください");
    return;
  }

  const formData = new FormData();
  formData.append("image", file);
  formData.append("cardId", questionKey);
  formData.append("oldImage", $("#specialQuestionImageInput")?.value.trim() || "");
  formData.append("oldImageStoragePath", $("#specialQuestionImageStoragePathInput")?.value.trim() || "");

  setStatus("背景画像をアップロード中です…");

  const response = await fetch(`${baseUrl}/admin-master?action=upload-card-image`, {
    method: "POST",
    headers: getAdminTokenHeaders(),
    body: formData
  });

  if (!response.ok) {
    const text = await response.text();
    const error = new Error(text || "背景画像アップロードに失敗しました");
    error.status = response.status;
    throw error;
  }

  const data = await response.json();
  $("#specialQuestionImageInput").value = data.publicUrl;
  $("#specialQuestionImageStoragePathInput").value = data.path || "";
  renderSpecialQuestionPreviewFromInputs();
  setStatus(
    `背景画像をアップロードしました（${formatBytes(originalFile.size)} → ${formatBytes(file.size)}）。保存するとスペシャルクエスチョンへ反映します`
  );
}

async function loadRemoteSettings() {
  const master = await requestAdminMaster("GET");
  if (!master) return false;

  settings = buildSettingsFromMaster(master);
  lineSurveyQuestions = normalizeLineSurveyQuestions(master.lineSurveyQuestions);
  selectedLineSurveyKey = lineSurveyQuestions.some((question) => question.key === selectedLineSurveyKey)
    ? selectedLineSurveyKey
    : lineSurveyQuestions[0]?.key || "";
  specialQuestions = normalizeSpecialQuestions(master.specialQuestions);
  selectedSpecialQuestionKey = specialQuestions.some((question) => question.key === selectedSpecialQuestionKey)
    ? selectedSpecialQuestionKey
    : specialQuestions[0]?.key || "";
  deletedSpecialQuestionKeys = [];
  saveAdminSettings(settings);
  results = getConfiguredResults(settings);
  cards = getConfiguredCards(settings);
  return true;
}

async function persistMaster(statusMessage) {
  if ($("#lineSurveyKeyInput")?.value && !saveLineSurveyQuestionFromInputs()) {
    return;
  }
  if ($("#specialQuestionKeyInput")?.value && !saveSpecialQuestionFromInputs()) {
    return;
  }
  const currentQuestionCount = $("#diagnosisQuestionCountInput")
    ? getSafeQuestionCount($("#diagnosisQuestionCountInput").value)
    : getSafeQuestionCount();
  if (!validateSpecialQuestionCapacity(currentQuestionCount)) {
    return;
  }
  if ($("#lineAiMaxRepliesInput")) {
    settings = {
      ...settings,
      ...getAiConversationSettingsFromInputs()
    };
  }
  settings = {
    ...settings,
    specialQuestions
  };

  saveAdminSettings(settings);

  if (!getFunctionsBaseUrl()) {
    setStatus(`${statusMessage}（ローカル保存）`);
    return;
  }

  try {
    const master = await requestAdminMaster("POST", {
      ...serializeSettingsForMaster(settings),
      lineSurveyQuestions,
      specialQuestions,
      deletedSpecialQuestionKeys
    });
    if (master) {
      settings = buildSettingsFromMaster(master);
      lineSurveyQuestions = normalizeLineSurveyQuestions(master.lineSurveyQuestions);
      selectedLineSurveyKey = lineSurveyQuestions.some((question) => question.key === selectedLineSurveyKey)
        ? selectedLineSurveyKey
        : lineSurveyQuestions[0]?.key || "";
      specialQuestions = normalizeSpecialQuestions(master.specialQuestions);
      selectedSpecialQuestionKey = specialQuestions.some((question) => question.key === selectedSpecialQuestionKey)
        ? selectedSpecialQuestionKey
        : specialQuestions[0]?.key || "";
      deletedSpecialQuestionKeys = [];
      saveAdminSettings(settings);
      results = getConfiguredResults(settings);
      cards = getConfiguredCards(settings);
      renderSpecialQuestionEditor();
    }
    setStatus(`${statusMessage} / Supabaseへ保存しました`);
  } catch (error) {
    if (isUnauthorizedError(error)) {
      clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
      return;
    }
    setStatus(`${statusMessage} / Supabase保存失敗: ${error.message}`);
  }
}

function save(settingsPatch = {}) {
  settings = {
    ...DEFAULT_SETTINGS,
    ...settings,
    ...settingsPatch,
    resultOverrides: settingsPatch.resultOverrides || settings.resultOverrides || {},
    cardOverrides: settingsPatch.cardOverrides || settings.cardOverrides || {},
    deletedCardIds: settingsPatch.deletedCardIds || settings.deletedCardIds || [],
    useMasterCardsOnly: settingsPatch.useMasterCardsOnly ?? settings.useMasterCardsOnly ?? false
  };
  saveAdminSettings(settings);
  results = getConfiguredResults(settings);
  cards = getConfiguredCards(settings);
}

function getCardSettings(card, patch = {}) {
  return {
    question: card.question || "",
    visual: card.visual || "",
    image: card.image || "",
    imageStoragePath: card.imageStoragePath || "",
    yesScores: card.yesScores || {},
    noScores: card.noScores || {},
    enabled: card.enabled !== false,
    sortOrder: Number(card.sortOrder || cards.findIndex((item) => item.id === card.id) + 1),
    ...patch
  };
}

function getActiveCardCount() {
  return cards.filter((card) => card.enabled !== false).length;
}

function getTotalActiveQuestionCount() {
  return getActiveCardCount() + getActiveSpecialQuestionCount();
}

function getSafeQuestionCount(value = settings.diagnosisQuestionCount, activeCount = getTotalActiveQuestionCount()) {
  const requestedCount = Math.floor(Number(value || DEFAULT_SETTINGS.diagnosisQuestionCount));
  return Math.max(1, Math.min(Math.max(activeCount, 1), requestedCount));
}

function validateSpecialQuestionCapacity(questionCount = getSafeQuestionCount()) {
  const specialCount = getActiveSpecialQuestionCount();
  if (specialCount > questionCount) {
    setStatus(
      `出題ONのスペシャルクエスチョンが${formatNumber(specialCount)}問あります。診断に使う質問数を${formatNumber(specialCount)}問以上にしてください`
    );
    return false;
  }
  return true;
}

function renderActiveCardCount() {
  const activeCount = getActiveCardCount();
  const specialCount = getActiveSpecialQuestionCount();
  const totalCount = activeCount + specialCount;
  const activeCardCount = $("#activeCardCount");
  const questionCountInput = $("#diagnosisQuestionCountInput");
  if (activeCardCount) activeCardCount.textContent = formatNumber(totalCount);
  if (questionCountInput) {
    questionCountInput.max = Math.max(totalCount, 1);
    if (!questionCountInput.value) {
      questionCountInput.value = getSafeQuestionCount(settings.diagnosisQuestionCount, totalCount);
    }
  }
  const questionCountHelp = $("#diagnosisQuestionCountHelp");
  if (questionCountHelp) {
    questionCountHelp.textContent =
      `通常${formatNumber(activeCount)}問 + スペシャル${formatNumber(specialCount)}問の候補から、設定した件数を出題します。`;
  }
}

function saveQuestionCountFromInput() {
  const input = $("#diagnosisQuestionCountInput");
  if (!input) return true;
  const safeCount = getSafeQuestionCount(input.value);
  if (!validateSpecialQuestionCapacity(safeCount)) {
    input.value = settings.diagnosisQuestionCount || safeCount;
    return false;
  }
  input.value = safeCount;
  save({ diagnosisQuestionCount: safeCount });
  renderActiveCardCount();
  return true;
}

function getNextCardId() {
  const knownIds = [...cards.map((card) => card.id), ...(settings.deletedCardIds || [])];
  const maxNumber = knownIds.reduce((max, id) => {
    const match = String(id).match(/^image-(\d+)$/);
    return match ? Math.max(max, Number(match[1])) : max;
  }, 0);
  return `image-${String(maxNumber + 1).padStart(3, "0")}`;
}

function updateCardEnabled(cardId, enabled) {
  const card = cards.find((item) => item.id === cardId);
  if (!card) return;

  if (!enabled && getActiveCardCount() <= 1) {
    setStatus("出題する質問は最低1問必要です");
    renderCardList(cardId);
    renderCardEditor();
    return;
  }

  const nextActiveCount = Math.max(1, getActiveCardCount() + (enabled ? 1 : -1));
  save({
    diagnosisQuestionCount: getSafeQuestionCount(settings.diagnosisQuestionCount, nextActiveCount),
    cardOverrides: {
      ...(settings.cardOverrides || {}),
      [cardId]: getCardSettings(card, { enabled })
    }
  });
  populateSelects($("#resultSelect").value, cardId);
  renderGeneral();
  renderCardEditor();
  setStatus("出題設定を変更しました。反映するには「出題設定を保存」を押してください");
}

async function deleteSelectedCard() {
  const cardId = $("#cardSelect").value;
  const cardIndex = cards.findIndex((item) => item.id === cardId);
  const card = cards[cardIndex];
  if (!card) return;

  if (cards.length <= 1 || (card.enabled !== false && getActiveCardCount() <= 1)) {
    setStatus("質問は最低1問必要です");
    return;
  }

  const confirmed = window.confirm(
    `「${card.question || card.id}」を削除します。\nこの質問とSupabase Storage内の画像を削除します。`
  );
  if (!confirmed) return;

  const nextCardOverrides = { ...(settings.cardOverrides || {}) };
  delete nextCardOverrides[cardId];
  const nextActiveCount = Math.max(1, getActiveCardCount() - (card.enabled !== false ? 1 : 0));

  save({
    diagnosisQuestionCount: getSafeQuestionCount(settings.diagnosisQuestionCount, nextActiveCount),
    cardOverrides: nextCardOverrides,
    deletedCardIds: [...new Set([...(settings.deletedCardIds || []), cardId])]
  });

  const nextSelectedCard = cards[Math.min(cardIndex, cards.length - 1)]?.id;
  populateSelects($("#resultSelect").value, nextSelectedCard);
  renderGeneral();
  renderCardEditor();
  await persistMaster("質問を削除しました");
}

function populateSelects(selectedResult = $("#resultSelect")?.value, selectedCard = $("#cardSelect")?.value) {
  $("#resultSelect").innerHTML = Object.entries(results)
    .map(([key, result]) => `<option value="${key}">${escapeHtml(result.name)}</option>`)
    .join("");
  if (selectedResult && results[selectedResult]) $("#resultSelect").value = selectedResult;
  renderResultTypeList($("#resultSelect").value);

  $("#cardSelect").innerHTML = cards.map((card, index) => {
    const number = String(index + 1).padStart(2, "0");
    return `<option value="${card.id}">${number} ${escapeHtml(card.question)}</option>`;
  }).join("");
  if (selectedCard && cards.some((card) => card.id === selectedCard)) {
    $("#cardSelect").value = selectedCard;
  }
  renderCardList($("#cardSelect").value);
}

function renderResultTypeList(selectedResult = $("#resultSelect").value) {
  $("#resultTypeList").innerHTML = Object.entries(results)
    .map(([key, result], index) => {
      const number = String(index + 1).padStart(2, "0");
      const activeClass = key === selectedResult ? " is-active" : "";
      return `
        <button class="admin-type-button${activeClass}" type="button" data-result-key="${key}">
          <span>${number}</span>
          <strong>${escapeHtml(result.name)}</strong>
          <small>${escapeHtml(key)}</small>
        </button>
      `;
    })
    .join("");
}

function renderCardList(selectedCard = $("#cardSelect").value) {
  renderActiveCardCount();
  $("#cardList").innerHTML = cards
    .map((card, index) => {
      const number = String(index + 1).padStart(2, "0");
      const activeClass = card.id === selectedCard ? " is-active" : "";
      const disabledClass = card.enabled === false ? " is-disabled" : "";
      const checked = card.enabled !== false ? " checked" : "";
      return `
        <div class="admin-card-row${disabledClass}">
          <label class="card-enabled-toggle">
            <input type="checkbox" data-card-enabled-id="${escapeHtml(card.id)}"${checked} />
            <span>出題</span>
          </label>
          <button class="admin-type-button admin-card-button${activeClass}" type="button" data-card-id="${card.id}">
            <span>${number}</span>
            <strong>${escapeHtml(card.question)}</strong>
            <small>${escapeHtml(card.id)} / ${escapeHtml(card.visual)}</small>
          </button>
        </div>
      `;
    })
    .join("");
}

function renderGeneral() {
  $("#comparisonCountInput").value = getCurrentComparisonCount(settings);
  $("#comparisonIntervalInput").value = settings.comparisonIncrementIntervalHours;
  $("#comparisonIncrementInput").value = settings.comparisonIncrementCount;
  renderActiveCardCount();
  $("#diagnosisQuestionCountInput").value = getSafeQuestionCount(settings.diagnosisQuestionCount);
  $("#jobCountInput").value = settings.jobCount;
  $("#highMatchCountInput").value = settings.highMatchCount;
  $("#requireLineInput").checked = Boolean(settings.requireLineBeforeResult);
  renderAiConversationSettings();
}

function getSafeLineAiMaxReplies(value) {
  return Math.max(1, Math.min(10, Math.floor(Number(value || DEFAULT_SETTINGS.lineAiMaxReplies || 4))));
}

function renderAiConversationSettings() {
  if (!$("#lineAiMaxRepliesInput")) return;

  $("#lineAiMaxRepliesInput").value = getSafeLineAiMaxReplies(settings.lineAiMaxReplies);
  $("#lineAiCtaMessageInput").value = settings.lineAiCtaMessage || DEFAULT_SETTINGS.lineAiCtaMessage;
  $("#lineAiCtaPrimaryLabelInput").value =
    settings.lineAiCtaPrimaryLabel || DEFAULT_SETTINGS.lineAiCtaPrimaryLabel;
  $("#lineAiCtaPrimaryTextInput").value =
    settings.lineAiCtaPrimaryText || DEFAULT_SETTINGS.lineAiCtaPrimaryText;
  $("#lineAiCtaSecondaryLabelInput").value =
    settings.lineAiCtaSecondaryLabel || DEFAULT_SETTINGS.lineAiCtaSecondaryLabel;
  $("#lineAiCtaSecondaryTextInput").value =
    settings.lineAiCtaSecondaryText || DEFAULT_SETTINGS.lineAiCtaSecondaryText;
}

function getAiConversationSettingsFromInputs() {
  return {
    lineAiMaxReplies: getSafeLineAiMaxReplies($("#lineAiMaxRepliesInput").value),
    lineAiCtaMessage:
      $("#lineAiCtaMessageInput").value.trim() || DEFAULT_SETTINGS.lineAiCtaMessage,
    lineAiCtaPrimaryLabel:
      $("#lineAiCtaPrimaryLabelInput").value.trim().slice(0, 20) ||
      DEFAULT_SETTINGS.lineAiCtaPrimaryLabel,
    lineAiCtaPrimaryText:
      $("#lineAiCtaPrimaryTextInput").value.trim().slice(0, 300) ||
      DEFAULT_SETTINGS.lineAiCtaPrimaryText,
    lineAiCtaSecondaryLabel:
      $("#lineAiCtaSecondaryLabelInput").value.trim().slice(0, 20) ||
      DEFAULT_SETTINGS.lineAiCtaSecondaryLabel,
    lineAiCtaSecondaryText:
      $("#lineAiCtaSecondaryTextInput").value.trim().slice(0, 300) ||
      DEFAULT_SETTINGS.lineAiCtaSecondaryText
  };
}

async function persistAiConversationSettings() {
  const aiSettings = getAiConversationSettingsFromInputs();
  $("#lineAiMaxRepliesInput").value = aiSettings.lineAiMaxReplies;
  save(aiSettings);
  renderAiConversationSettings();
  await persistMaster("AI会話設定を保存しました");
}

function getSelectedLineSurveyQuestion() {
  return (
    lineSurveyQuestions.find((question) => question.key === selectedLineSurveyKey) ||
    lineSurveyQuestions[0] ||
    null
  );
}

function renderLineSurveyList() {
  const target = $("#lineSurveyQuestionList");
  if (!target) return;

  target.innerHTML = lineSurveyQuestions
    .map((question, index) => {
      const activeClass = question.key === selectedLineSurveyKey ? " is-active" : "";
      return `
        <button class="line-survey-button${activeClass}" type="button" data-line-survey-key="${escapeHtml(question.key)}">
          <span>${String(index + 1).padStart(2, "0")}</span>
          <strong>${escapeHtml(question.label)}</strong>
          <small>${escapeHtml(question.key)} / 選択肢${formatNumber(question.options.length)}件</small>
        </button>
      `;
    })
    .join("");
}

function renderLineSurveyEditor() {
  const question = getSelectedLineSurveyQuestion();
  if (!question) return;

  $("#lineSurveyKeyInput").value = question.key;
  $("#lineSurveySortInput").value = Number(question.sortOrder || 1);
  $("#lineSurveyLabelInput").value = question.label;
  $("#lineSurveyOptionsInput").value = question.options.map((option) => option.label).join("\n");
  renderLineSurveyList();
}

function saveLineSurveyQuestionFromInputs() {
  const key = $("#lineSurveyKeyInput").value.trim();
  const base = lineSurveyQuestions.find((question) => question.key === key);
  if (!base) return false;

  const labels = splitLines($("#lineSurveyOptionsInput").value)
    .map((label) => label.slice(0, 20))
    .filter(Boolean);
  if (!$("#lineSurveyLabelInput").value.trim()) {
    setStatus("LINEアンケートの質問文を入力してください");
    return false;
  }
  if (!labels.length) {
    setStatus("LINEアンケートの選択肢を1つ以上入力してください");
    return false;
  }

  lineSurveyQuestions = normalizeLineSurveyQuestions(
    lineSurveyQuestions.map((question) => {
      if (question.key !== key) return question;
      return {
        ...question,
        label: $("#lineSurveyLabelInput").value.trim(),
        sortOrder: Math.max(1, Math.floor(Number($("#lineSurveySortInput").value || question.sortOrder || 1))),
        options: labels.map((label, index) => {
          const existing = question.options[index];
          return {
            value: existing?.label === label ? existing.value : slugifyLineSurveyOption(label, `option_${index + 1}`),
            label
          };
        })
      };
    })
  );
  selectedLineSurveyKey = key;
  renderLineSurveyEditor();
  return true;
}

async function persistLineSurveyQuestions() {
  if (!saveLineSurveyQuestionFromInputs()) return;

  try {
    const master = await requestAdminMaster("POST", { lineSurveyQuestions });
    if (master) {
      lineSurveyQuestions = normalizeLineSurveyQuestions(master.lineSurveyQuestions);
      renderLineSurveyEditor();
    }
    setStatus("LINEアンケート設定を保存しました / Supabaseへ保存しました");
  } catch (error) {
    if (isUnauthorizedError(error)) {
      clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
      return;
    }
    setStatus(`LINEアンケート設定保存失敗: ${error.message}`);
  }
}

function getActiveSpecialQuestionCount() {
  return specialQuestions.filter((question) => question.enabled !== false).length;
}

function getSelectedSpecialQuestion() {
  return (
    specialQuestions.find((question) => question.key === selectedSpecialQuestionKey) ||
    specialQuestions[0] ||
    null
  );
}

function getNextSpecialQuestionKey() {
  const knownKeys = [
    ...specialQuestions.map((question) => question.key),
    ...deletedSpecialQuestionKeys
  ];
  const maxNumber = knownKeys.reduce((max, key) => {
    const match = String(key).match(/^special-(\d+)$/);
    return match ? Math.max(max, Number(match[1])) : max;
  }, 0);
  return `special-${String(maxNumber + 1).padStart(3, "0")}`;
}

function renderSpecialQuestionCount() {
  const target = $("#specialQuestionActiveCount");
  if (target) target.textContent = formatNumber(getActiveSpecialQuestionCount());
}

function renderSpecialQuestionList() {
  const target = $("#specialQuestionList");
  if (!target) return;

  renderSpecialQuestionCount();

  if (!specialQuestions.length) {
    target.innerHTML = `<p class="admin-user-empty">まだスペシャルクエスチョンがありません。</p>`;
    return;
  }

  target.innerHTML = specialQuestions
    .map((question, index) => {
      const activeClass = question.key === selectedSpecialQuestionKey ? " is-active" : "";
      const disabledClass = question.enabled === false ? " is-disabled" : "";
      const checked = question.enabled !== false ? " checked" : "";
      return `
        <div class="special-question-admin-row${disabledClass}">
          <label class="card-enabled-toggle">
            <input type="checkbox" data-special-question-enabled-key="${escapeHtml(question.key)}"${checked} />
            <span>出題</span>
          </label>
          <button class="special-question-admin-button${activeClass}" type="button" data-special-question-key="${escapeHtml(question.key)}">
            <span>${String(index + 1).padStart(2, "0")} / ${formatNumber(question.insertAfterOrder)}枚目に表示</span>
            <strong>${escapeHtml(question.questionText)}</strong>
            <small>A: ${escapeHtml(question.optionALabel)} / B: ${escapeHtml(question.optionBLabel)}</small>
          </button>
        </div>
      `;
    })
    .join("");
}

function renderSpecialQuestionPreviewFromInputs() {
  const target = $("#specialQuestionPreview");
  if (!target) return;

  const questionText = $("#specialQuestionTextInput")?.value.trim() || "質問文を入力してください";
  const optionALabel = $("#specialQuestionOptionAInput")?.value.trim() || "選択肢A";
  const optionBLabel = $("#specialQuestionOptionBInput")?.value.trim() || "選択肢B";
  const category = $("#specialQuestionCategoryInput")?.value.trim() || "preference";
  const imageUrl = $("#specialQuestionImageInput")?.value.trim() || "";

  target.style.backgroundImage = imageUrl
    ? `linear-gradient(135deg, rgba(17, 24, 39, 0.16), rgba(37, 99, 235, 0.16)), url("${imageUrl}")`
    : "";
  target.style.backgroundPosition = imageUrl ? "center" : "";
  target.style.backgroundSize = imageUrl ? "cover" : "";

  target.innerHTML = `
    <small>${escapeHtml(category)}</small>
    <strong>${escapeHtml(questionText)}</strong>
    <div class="special-question-admin-choice-grid">
      <div class="special-question-admin-choice">
        <b>A</b>
        <span>${escapeHtml(optionALabel)}</span>
      </div>
      <div class="special-question-admin-choice">
        <b>B</b>
        <span>${escapeHtml(optionBLabel)}</span>
      </div>
    </div>
  `;
}

function renderSpecialQuestionEditor() {
  const question = getSelectedSpecialQuestion();
  const deleteButton = $("#deleteSpecialQuestion");
  if (deleteButton) deleteButton.disabled = specialQuestions.length === 0;

  if (!question) {
    if ($("#specialQuestionKeyInput")) $("#specialQuestionKeyInput").value = "";
    if ($("#specialQuestionEnabledInput")) $("#specialQuestionEnabledInput").checked = false;
    if ($("#specialQuestionInsertAfterInput")) $("#specialQuestionInsertAfterInput").value = 1;
    if ($("#specialQuestionDisplayOrderInput")) $("#specialQuestionDisplayOrderInput").value = 1;
    if ($("#specialQuestionCategoryInput")) $("#specialQuestionCategoryInput").value = "";
    if ($("#specialQuestionTextInput")) $("#specialQuestionTextInput").value = "";
    if ($("#specialQuestionOptionAInput")) $("#specialQuestionOptionAInput").value = "";
    if ($("#specialQuestionOptionBInput")) $("#specialQuestionOptionBInput").value = "";
    if ($("#specialQuestionImageInput")) $("#specialQuestionImageInput").value = "";
    if ($("#specialQuestionImageStoragePathInput")) $("#specialQuestionImageStoragePathInput").value = "";
    renderSpecialQuestionList();
    renderSpecialQuestionPreviewFromInputs();
    return;
  }

  $("#specialQuestionKeyInput").value = question.key;
  $("#specialQuestionEnabledInput").checked = question.enabled !== false;
  $("#specialQuestionInsertAfterInput").value = Number(question.insertAfterOrder || 1);
  $("#specialQuestionDisplayOrderInput").value = Number(question.displayOrder || 1);
  $("#specialQuestionCategoryInput").value = question.category || "preference";
  $("#specialQuestionTextInput").value = question.questionText;
  $("#specialQuestionOptionAInput").value = question.optionALabel;
  $("#specialQuestionOptionBInput").value = question.optionBLabel;
  $("#specialQuestionImageInput").value = question.backgroundImageUrl || "";
  $("#specialQuestionImageStoragePathInput").value = question.backgroundStoragePath || "";
  renderSpecialQuestionList();
  renderSpecialQuestionPreviewFromInputs();
}

function saveSpecialQuestionFromInputs() {
  const key = $("#specialQuestionKeyInput")?.value.trim();
  if (!key) return true;

  const questionText = $("#specialQuestionTextInput").value.trim();
  const optionALabel = $("#specialQuestionOptionAInput").value.trim();
  const optionBLabel = $("#specialQuestionOptionBInput").value.trim();

  if (!questionText) {
    setStatus("スペシャルクエスチョンの質問文を入力してください");
    return false;
  }
  if (!optionALabel || !optionBLabel) {
    setStatus("スペシャルクエスチョンの選択肢A/Bを入力してください");
    return false;
  }

  const existing = specialQuestions.find((question) => question.key === key) || {};
  specialQuestions = normalizeSpecialQuestions(
    specialQuestions.map((question) => {
      if (question.key !== key) return question;
      return {
        ...question,
        questionText,
        optionALabel,
        optionBLabel,
        category: $("#specialQuestionCategoryInput").value.trim() || "preference",
        enabled: $("#specialQuestionEnabledInput").checked,
        insertAfterOrder: Math.max(
          1,
          Math.floor(Number($("#specialQuestionInsertAfterInput").value || 1))
        ),
        displayOrder: Math.max(
          1,
          Math.floor(Number($("#specialQuestionDisplayOrderInput").value || existing.displayOrder || 1))
        ),
        backgroundImageUrl: $("#specialQuestionImageInput")?.value.trim() || "",
        backgroundStoragePath: $("#specialQuestionImageStoragePathInput")?.value.trim() || ""
      };
    })
  );
  selectedSpecialQuestionKey = key;
  renderSpecialQuestionEditor();
  return true;
}

function updateSpecialQuestionEnabled(key, enabled) {
  const question = specialQuestions.find((item) => item.key === key);
  if (!question) return;

  specialQuestions = normalizeSpecialQuestions(
    specialQuestions.map((item) => (item.key === key ? { ...item, enabled } : item))
  );
  selectedSpecialQuestionKey = key;
  renderSpecialQuestionEditor();
  renderActiveCardCount();
  setStatus("スペシャルクエスチョンの出題設定を変更しました。反映するには「スペシャル設定を保存」を押してください");
}

async function addSpecialQuestion() {
  if (!saveSpecialQuestionFromInputs()) return;

  const key = getNextSpecialQuestionKey();
  const displayOrder = Math.max(0, ...specialQuestions.map((question) => Number(question.displayOrder || 0))) + 1;
  specialQuestions = normalizeSpecialQuestions([
    ...specialQuestions,
    {
      key,
      questionText: "どちらの会社で働きたい？",
      optionALabel: "年収500万円でほぼ定時退社",
      optionBLabel: "年収800万円で成果主義。忙しい",
      category: "income",
      enabled: true,
      insertAfterOrder: 10,
      displayOrder,
      backgroundImageUrl: "",
      backgroundStoragePath: ""
    }
  ]);
  selectedSpecialQuestionKey = key;
  renderSpecialQuestionEditor();
  await persistMaster("スペシャルクエスチョンを追加しました。内容を編集してください");
}

async function deleteSelectedSpecialQuestion() {
  const key = $("#specialQuestionKeyInput")?.value.trim();
  const questionIndex = specialQuestions.findIndex((question) => question.key === key);
  const question = specialQuestions[questionIndex];
  if (!question) return;

  const confirmed = window.confirm(
    `「${question.questionText || question.key}」を削除します。\n過去の回答データは削除せず、質問マスタだけ削除します。`
  );
  if (!confirmed) return;

  deletedSpecialQuestionKeys = [...new Set([...deletedSpecialQuestionKeys, question.key])];
  specialQuestions = specialQuestions.filter((item) => item.key !== question.key);
  selectedSpecialQuestionKey =
    specialQuestions[Math.min(questionIndex, specialQuestions.length - 1)]?.key || "";
  renderSpecialQuestionEditor();
  await persistMaster("スペシャルクエスチョンを削除しました");
}

async function persistSpecialQuestions() {
  if (!saveSpecialQuestionFromInputs()) return;
  if (!validateSpecialQuestionCapacity()) return;

  try {
    const master = await requestAdminMaster("POST", {
      specialQuestions,
      deletedSpecialQuestionKeys
    });
    if (master) {
      specialQuestions = normalizeSpecialQuestions(master.specialQuestions);
      selectedSpecialQuestionKey = specialQuestions.some((question) => question.key === selectedSpecialQuestionKey)
        ? selectedSpecialQuestionKey
        : specialQuestions[0]?.key || "";
      deletedSpecialQuestionKeys = [];
      renderSpecialQuestionEditor();
    }
    setStatus("スペシャルクエスチョン設定を保存しました / Supabaseへ保存しました");
  } catch (error) {
    if (isUnauthorizedError(error)) {
      clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
      return;
    }
    setStatus(`スペシャルクエスチョン設定保存失敗: ${error.message}`);
  }
}

function formatNumber(value) {
  return Number(value || 0).toLocaleString("ja-JP");
}

function formatRate(value) {
  if (value === null || value === undefined || Number.isNaN(Number(value))) return "-";
  return `${Number(value).toFixed(1)}%`;
}

function renderKpiMessage(message) {
  $("#kpiSummaryCards").innerHTML = `
    <div class="kpi-card kpi-message">
      <span>KPI集計</span>
      <strong>${escapeHtml(message)}</strong>
    </div>
  `;
  $("#kpiDailyTable").innerHTML = "";
  $("#kpiResultTypes").innerHTML = "";
  $("#kpiDropoffs").innerHTML = "";
  const adminAuditLogTable = $("#adminAuditLogTable");
  if (adminAuditLogTable) adminAuditLogTable.innerHTML = "";
}

function renderKpiCards(latest) {
  const cards = [
    ["LP表示", formatNumber(latest?.lp_view), "診断ページを開いた数"],
    ["診断開始率", formatRate(latest?.start_rate), "LP表示 → 診断開始"],
    ["診断完了率", formatRate(latest?.complete_rate), "診断開始 → 出題分すべて完了"],
    ["LINE送信率", formatRate(latest?.result_sent_rate), "診断完了 → LINE送信"]
  ];

  $("#kpiSummaryCards").innerHTML = cards
    .map(
      ([label, value, note]) => `
        <div class="kpi-card">
          <span>${escapeHtml(label)}</span>
          <strong>${escapeHtml(value)}</strong>
          <small>${escapeHtml(note)}</small>
        </div>
      `
    )
    .join("");
}

function renderKpiDailyTable(rows = []) {
  if (!rows.length) {
    $("#kpiDailyTable").innerHTML = `<p class="kpi-empty">まだイベントログがありません。</p>`;
    return;
  }

  $("#kpiDailyTable").innerHTML = `
    <table class="kpi-table">
      <thead>
        <tr>
          <th>期間</th>
          <th>LP</th>
          <th>開始</th>
          <th>完了</th>
          <th>結果表示</th>
          <th>LINE押下</th>
          <th>送信</th>
          <th>シェア</th>
          <th>開始率</th>
          <th>完了率</th>
          <th>結果到達率</th>
          <th>送信率</th>
          <th>シェア率</th>
        </tr>
      </thead>
      <tbody>
        ${rows
          .map(
            (row) => `
              <tr>
                <td>${escapeHtml(row.event_date || row.period_start || "-")}</td>
                <td>${formatNumber(row.lp_view)}</td>
                <td>${formatNumber(row.diagnosis_start)}</td>
                <td>${formatNumber(row.diagnosis_complete)}</td>
                <td>${formatNumber(row.result_view)}</td>
                <td>${formatNumber(row.line_button_click)}</td>
                <td>${formatNumber(row.result_sent)}</td>
                <td>${formatNumber(row.share_click)}</td>
                <td>${formatRate(row.start_rate)}</td>
                <td>${formatRate(row.complete_rate)}</td>
                <td>${formatRate(row.result_view_rate)}</td>
                <td>${formatRate(row.result_sent_rate)}</td>
                <td>${formatRate(row.share_rate)}</td>
              </tr>
            `
          )
          .join("")}
      </tbody>
    </table>
  `;
}

function renderKpiResultTypes(rows = []) {
  if (!rows.length) {
    $("#kpiResultTypes").innerHTML = `<p class="kpi-empty">まだ診断タイプ集計がありません。</p>`;
    return;
  }

  $("#kpiResultTypes").innerHTML = rows
    .map((row) => {
      const rate = Math.max(0, Math.min(100, Number(row.diagnosis_rate || 0)));
      const label = results[row.result_type]?.name || row.result_type || "不明";
      return `
        <div class="kpi-result-row">
          <div>
            <strong>${escapeHtml(label)}</strong>
            <span>${formatNumber(row.diagnosis_count)}件 / ${formatRate(rate)}</span>
          </div>
          <div class="kpi-bar" aria-hidden="true"><span style="width: ${rate}%"></span></div>
        </div>
      `;
    })
    .join("");
}

function renderKpiDropoffs(rows = []) {
  if (!rows.length) {
    $("#kpiDropoffs").innerHTML = `<p class="kpi-empty">まだ離脱集計がありません。</p>`;
    return;
  }

  const maxCount = Math.max(...rows.map((row) => Number(row.dropoff_count || 0)), 1);

  $("#kpiDropoffs").innerHTML = rows
    .map((row) => {
      const count = Number(row.dropoff_count || 0);
      const rate = Math.max(2, Math.min(100, (count / maxCount) * 100));
      const card = cards.find((item) => item.id === row.image_id);
      const fallbackCard = cards[Number(row.question_order || 1) - 1];
      const question = card?.question || fallbackCard?.question || "現在の質問マスタと一致なし";
      const imageId = row.image_id || fallbackCard?.id || "-";
      return `
        <div class="kpi-result-row kpi-dropoff-row">
          <div>
            <strong>${formatNumber(row.question_order)}枚目</strong>
            <span>${formatNumber(count)}件</span>
          </div>
          <small>${escapeHtml(question)} / ${escapeHtml(imageId)}</small>
          <div class="kpi-bar" aria-hidden="true"><span style="width: ${rate}%"></span></div>
        </div>
      `;
    })
    .join("");
}

function formatDateTime(value) {
  if (!value) return "-";
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return String(value);
  return date.toLocaleString("ja-JP", {
    month: "2-digit",
    day: "2-digit",
    hour: "2-digit",
    minute: "2-digit"
  });
}

function getAdminEventLabel(eventName) {
  const labels = {
    admin_login_success: "ログイン成功",
    admin_login_failed: "ログイン失敗",
    admin_login_rate_limited: "ログイン制限",
    admin_ui_view: "管理画面表示",
    admin_master_save: "マスタ保存",
    admin_image_upload: "画像アップロード",
    admin_user_view: "ユーザー情報閲覧",
    admin_handoff_status_update: "対応ステータス更新",
    admin_kpi_view: "KPI閲覧"
  };
  return labels[eventName] || eventName || "-";
}

function getAdminLogSummary(row) {
  const metadata = row.metadata && typeof row.metadata === "object" ? row.metadata : {};
  if (row.event_name === "admin_master_save") {
    return [
      metadata.settingsUpdated ? "表示数値" : "",
      Number(metadata.resultsCount || 0) ? `結果${metadata.resultsCount}件` : "",
      Number(metadata.cardsCount || 0) ? `質問${metadata.cardsCount}件` : "",
      Number(metadata.deletedCardsCount || 0) ? `削除${metadata.deletedCardsCount}件` : "",
      Number(metadata.lineSurveyQuestionsCount || 0) ? `LINEアンケート${metadata.lineSurveyQuestionsCount}件` : "",
      Number(metadata.specialQuestionsCount || 0) ? `スペシャル${metadata.specialQuestionsCount}件` : "",
      Number(metadata.deletedSpecialQuestionsCount || 0) ? `スペシャル削除${metadata.deletedSpecialQuestionsCount}件` : ""
    ]
      .filter(Boolean)
      .join(" / ") || "-";
  }
  if (row.event_name === "admin_kpi_view") return `${metadata.days || 14}日分`;
  if (row.event_name === "admin_login_rate_limited") return "失敗回数の上限超過";
  if (row.event_name === "admin_image_upload") return "スワイプ画像";
  return "-";
}

function renderAdminAuditLogs(rows = []) {
  const target = $("#adminAuditLogTable");
  if (!target) return;
  if (!rows.length) {
    target.innerHTML = `<p class="kpi-empty">まだ管理操作ログがありません。</p>`;
    return;
  }

  target.innerHTML = `
    <table class="kpi-table admin-audit-table">
      <thead>
        <tr>
          <th>日時</th>
          <th>操作</th>
          <th>結果</th>
          <th>概要</th>
          <th>IP</th>
        </tr>
      </thead>
      <tbody>
        ${rows
          .map(
            (row) => `
              <tr>
                <td>${escapeHtml(formatDateTime(row.created_at))}</td>
                <td>${escapeHtml(getAdminEventLabel(row.event_name))}</td>
                <td>${row.success === false ? "失敗" : "成功"}</td>
                <td>${escapeHtml(getAdminLogSummary(row))}</td>
                <td>${escapeHtml(row.ip_address || "-")}</td>
              </tr>
            `
          )
          .join("")}
      </tbody>
    </table>
  `;
}

function renderKpiDashboard(summary) {
  kpiSummary = summary;
  const rangeMap = {
    daily: { title: "日別KPI", rows: Array.isArray(summary?.daily) ? summary.daily : [] },
    weekly: { title: "週別KPI", rows: Array.isArray(summary?.weekly) ? summary.weekly : [] },
    monthly: { title: "月別KPI", rows: Array.isArray(summary?.monthly) ? summary.monthly : [] }
  };
  const current = rangeMap[kpiRange] || rangeMap.daily;
  const resultTypes = Array.isArray(summary?.resultTypes) ? summary.resultTypes : [];
  const dropoffs = Array.isArray(summary?.dropoffs) ? summary.dropoffs : [];
  const adminAuditPanel = $("#adminAuditPanel");
  if (adminAuditPanel) adminAuditPanel.hidden = !SHOW_ADMIN_AUDIT_LOGS;
  $("#kpiTableTitle").textContent = current.title;
  renderKpiCards(current.rows[0] || null);
  renderKpiDailyTable(current.rows);
  renderKpiResultTypes(resultTypes);
  renderKpiDropoffs(dropoffs);
  if (SHOW_ADMIN_AUDIT_LOGS) {
    renderAdminAuditLogs(Array.isArray(summary?.adminLogs) ? summary.adminLogs : []);
  }
}

async function loadKpiDashboard() {
  if (!getFunctionsBaseUrl()) {
    renderKpiMessage("Supabase接続後に表示されます");
    return false;
  }

  try {
    const summary = await requestKpiSummary();
    if (!summary) {
      renderKpiMessage("Supabase接続後に表示されます");
      return false;
    }
    renderKpiDashboard(summary);
    return true;
  } catch (error) {
    if (isUnauthorizedError(error)) {
      clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
      return false;
    }
    renderKpiMessage("KPIを読み込めません");
    setStatus(`KPI読み込み失敗: ${error.message}`);
    return false;
  }
}

function setUserStatus(message) {
  const target = $("#adminUserStatus");
  if (!target) return;
  target.textContent = message;
}

function getResultLabel(resultType) {
  if (!resultType) return "-";
  return results[resultType]?.name || resultType;
}

function getAiStatusLabel(status) {
  const labels = {
    idle: "待機中",
    ai_replying: "AI返信中",
    cta_shown: "相談CTA表示済み",
    handed_off: "人間引き継ぎ済み",
    stopped: "停止中"
  };
  return labels[status] || status || "-";
}

function getHandoffStatusLabel(status) {
  const labels = {
    new: "未対応",
    notified: "通知済み",
    notification_failed: "通知失敗",
    in_progress: "対応中",
    completed: "対応済み",
    canceled: "対応不要"
  };
  return labels[status] || status || "-";
}

function renderHandoffStatusOptions(selectedStatus) {
  const options = [
    ["new", "未対応"],
    ["in_progress", "対応中"],
    ["completed", "対応済み"],
    ["canceled", "対応不要"]
  ];

  return options
    .map(([value, label]) => {
      const selected = value === selectedStatus ? " selected" : "";
      return `<option value="${value}"${selected}>${escapeHtml(label)}</option>`;
    })
    .join("");
}

function getConversationTypeLabel(type) {
  const labels = {
    survey: "アンケート",
    ai_career: "AI相談",
    ai_career_cta: "相談CTA",
    ai_handoff: "引き継ぎ",
    diagnosis_result: "診断結果",
    job_lead: "求人導線",
    general: "通常"
  };
  return labels[type] || type || "-";
}

function formatBlank(value) {
  return value || "-";
}

function renderAdminUserMessage(message) {
  const targets = [
    "#adminUserList",
    "#adminUserOverview",
    "#adminUserDiagnoses",
    "#adminUserPreferences",
    "#adminUserSurveyAnswers",
    "#adminUserSpecialAnswers",
    "#adminUserAiState",
    "#adminUserHandoffs",
    "#adminUserConversations"
  ];
  targets.forEach((selector) => {
    const target = $(selector);
    if (target) target.innerHTML = `<p class="admin-user-empty">${escapeHtml(message)}</p>`;
  });
}

function setAdminUserTab(tabKey = adminUserTab) {
  const availableTabs = new Set(["diagnoses", "preferences", "special", "ai", "handoffs", "conversations"]);
  adminUserTab = availableTabs.has(tabKey) ? tabKey : "diagnoses";

  document.querySelectorAll("[data-admin-user-tab]").forEach((button) => {
    button.classList.toggle("is-active", button.dataset.adminUserTab === adminUserTab);
  });
  document.querySelectorAll("[data-admin-user-panel]").forEach((panel) => {
    panel.classList.toggle("is-active", panel.dataset.adminUserPanel === adminUserTab);
  });
}

function setAdminPage(pageKey = activeAdminPage) {
  const availablePages = new Set(["kpi", "users", "editor"]);
  activeAdminPage = availablePages.has(pageKey) ? pageKey : "kpi";

  document.querySelectorAll("[data-admin-page]").forEach((button) => {
    button.classList.toggle("is-active", button.dataset.adminPage === activeAdminPage);
  });
  document.querySelectorAll("[data-admin-page-panel]").forEach((panel) => {
    const isActive = panel.dataset.adminPagePanel === activeAdminPage;
    panel.classList.toggle("is-active", isActive);
    panel.hidden = !isActive;
  });
}

function renderAdminUserList(users = [], selectedUserId = "") {
  const target = $("#adminUserList");
  if (!target) return;

  if (!users.length) {
    target.innerHTML = `<p class="admin-user-empty">まだLINE連携済みユーザーがいません。</p>`;
    return;
  }

  target.innerHTML = users
    .map((user) => {
      const activeClass = user.userId === selectedUserId ? " is-active" : "";
      const displayName = user.displayName || "LINE名未取得";
      const internalUserId = user.internalUserId || user.userId;
      const latestResult = getResultLabel(user.latestDiagnosis?.result_type);
      const handoffLabel = getHandoffStatusLabel(user.handoff?.status);
      return `
        <button class="admin-user-button${activeClass}" type="button" data-admin-user-id="${escapeHtml(user.userId)}">
          <strong>${escapeHtml(displayName)}</strong>
          <span>${escapeHtml(internalUserId)} / ${escapeHtml(latestResult)}</span>
          <small>診断${formatNumber(user.diagnosisCount)}件 / ${escapeHtml(handoffLabel)} / ${escapeHtml(formatDateTime(user.lastSeenAt))}</small>
        </button>
      `;
    })
    .join("");
}

function renderAdminUserOverview(detail) {
  const target = $("#adminUserOverview");
  if (!target) return;
  const user = detail?.user;
  if (!user) {
    target.innerHTML = `<p class="admin-user-empty">ユーザーを選択してください。</p>`;
    return;
  }

  target.innerHTML = `
    <h3>${escapeHtml(user.displayName || "LINE名未取得")}</h3>
    <p>${escapeHtml(user.internalUserId || user.userId)} / ${escapeHtml(user.lineUserId || "LINE未連携")}</p>
    <div class="admin-user-meta">
      <div class="admin-user-meta-item">
        <span>初回流入</span>
        <strong>${escapeHtml(formatBlank(user.initialUtmSource))}</strong>
      </div>
      <div class="admin-user-meta-item">
        <span>端末</span>
        <strong>${escapeHtml(formatBlank(user.initialDeviceType))}</strong>
      </div>
      <div class="admin-user-meta-item">
        <span>初回確認</span>
        <strong>${escapeHtml(formatDateTime(user.firstSeenAt))}</strong>
      </div>
      <div class="admin-user-meta-item">
        <span>最終確認</span>
        <strong>${escapeHtml(formatDateTime(user.lastSeenAt))}</strong>
      </div>
    </div>
  `;
}

const ADMIN_AXIS_LABELS = {
  people: "人との関わり",
  focus: "集中力",
  challenge: "挑戦",
  stability: "安定",
  creativity: "発想力",
  execution: "実行力"
};

function getAdminAxisLabel(axis) {
  return ADMIN_AXIS_LABELS[axis] || axis || "-";
}

function renderScoreRates(scoreRates = {}) {
  return Object.entries(ADMIN_AXIS_LABELS)
    .map(([key, label]) => {
      const value = scoreRates?.[key];
      return `<span class="admin-user-pill">${escapeHtml(label)} ${escapeHtml(value ?? "-")}</span>`;
    })
    .join("");
}

function formatResponseTimeMs(value) {
  const number = Number(value);
  if (!Number.isFinite(number) || number < 0) return "-";
  if (number < 1000) return `${Math.round(number)}ms`;
  return `${(number / 1000).toFixed(1)}秒`;
}

function getAnswerLabel(answer) {
  if (answer === "yes") return "YES";
  if (answer === "no") return "NO";
  return answer || "-";
}

function renderDiagnosisAnswers(answers = []) {
  if (!Array.isArray(answers) || !answers.length) {
    return `
      <details class="admin-user-answer-details">
        <summary>YES / NO履歴を見る</summary>
        <p class="admin-user-empty">回答履歴がありません。</p>
      </details>
    `;
  }

  const orderedAnswers = [...answers].sort(
    (a, b) => Number(a.answerOrder || 0) - Number(b.answerOrder || 0)
  );

  return `
    <details class="admin-user-answer-details">
      <summary>YES / NO履歴を見る（${formatNumber(orderedAnswers.length)}件）</summary>
      <div class="admin-user-answer-list">
        ${orderedAnswers
          .map((answerData, index) => {
            const imageId = answerData.imageId || "";
            const card = cards.find((item) => item.id === imageId);
            const order = Number(answerData.answerOrder || index + 1);
            const answer = getAnswerLabel(answerData.answer);
            const answerClass = answerData.answer === "yes" ? " is-yes" : answerData.answer === "no" ? " is-no" : "";
            return `
              <div class="admin-user-answer-row">
                <span class="admin-user-answer-order">${formatNumber(order)}</span>
                <div>
                  <strong>${escapeHtml(card?.question || imageId || "質問マスタと一致なし")}</strong>
                  <small>${escapeHtml(imageId || "-")} / ${escapeHtml(formatResponseTimeMs(answerData.responseTime))}</small>
                </div>
                <span class="admin-user-answer-badge${answerClass}">${escapeHtml(answer)}</span>
              </div>
            `;
          })
          .join("")}
      </div>
    </details>
  `;
}

function renderAdminUserDiagnoses(diagnoses = []) {
  const target = $("#adminUserDiagnoses");
  if (!target) return;

  if (!diagnoses.length) {
    target.innerHTML = `<p class="admin-user-empty">診断履歴がありません。</p>`;
    return;
  }

  target.innerHTML = `
    <div class="admin-user-record-list">
      ${diagnoses
        .map(
          (diagnosis) => `
            <article class="admin-user-record">
              <div class="admin-user-record-head">
                <strong>${escapeHtml(getResultLabel(diagnosis.result_type))}</strong>
                <time>${escapeHtml(formatDateTime(diagnosis.diagnosed_at))}</time>
              </div>
              <small>${escapeHtml(getAdminAxisLabel(diagnosis.primary_axis))} / ${escapeHtml(getAdminAxisLabel(diagnosis.secondary_axis))} / ${formatNumber(diagnosis.answered_count)}問回答</small>
              <div class="admin-user-pill-row">${renderScoreRates(diagnosis.score_rates)}</div>
              <div class="admin-user-pill-row">
                <span class="admin-user-pill">流入 ${escapeHtml(formatBlank(diagnosis.utm_source))}</span>
                <span class="admin-user-pill">端末 ${escapeHtml(formatBlank(diagnosis.device_type))}</span>
              </div>
              ${renderDiagnosisAnswers(diagnosis.answers)}
            </article>
          `
        )
        .join("")}
    </div>
  `;
}

function renderAdminUserPreferences(preferences) {
  const target = $("#adminUserPreferences");
  if (!target) return;

  if (!preferences) {
    target.innerHTML = `<p class="admin-user-empty">LINEアンケートの完了情報がありません。</p>`;
    return;
  }

  target.innerHTML = `
    <dl class="admin-user-kv">
      <div>
        <dt>希望勤務地</dt>
        <dd>${escapeHtml(formatBlank(preferences.desired_location_label))}</dd>
      </div>
      <div>
        <dt>転職時期</dt>
        <dd>${escapeHtml(formatBlank(preferences.job_change_timing_label))}</dd>
      </div>
      <div>
        <dt>現在職種</dt>
        <dd>${escapeHtml(formatBlank(preferences.current_job_label))}</dd>
      </div>
      <div>
        <dt>重視するもの</dt>
        <dd>${escapeHtml(formatBlank(preferences.priority_label))}</dd>
      </div>
    </dl>
  `;
}

function renderAdminUserSurveyAnswers(answers = []) {
  const target = $("#adminUserSurveyAnswers");
  if (!target) return;

  if (!answers.length) {
    target.innerHTML = "";
    return;
  }

  const ordered = [...answers].sort((a, b) => Number(a.answered_order || 0) - Number(b.answered_order || 0));
  target.innerHTML = `
    <div class="admin-user-record-list">
      ${ordered
        .map(
          (answer) => `
            <article class="admin-user-record">
              <div class="admin-user-record-head">
                <strong>${escapeHtml(answer.question_label || answer.question_key || "-")}</strong>
                <time>${escapeHtml(formatDateTime(answer.answered_at))}</time>
              </div>
              <small>${escapeHtml(answer.answer_label || answer.answer_value || "-")}</small>
            </article>
          `
        )
        .join("")}
    </div>
  `;
}

function renderAdminUserSpecialAnswers(answers = []) {
  const target = $("#adminUserSpecialAnswers");
  if (!target) return;

  if (!answers.length) {
    target.innerHTML = `<p class="admin-user-empty">スペシャル回答はまだありません。</p>`;
    return;
  }

  const ordered = [...answers].sort((a, b) => {
    const dateDiff = new Date(b.answered_at || 0).getTime() - new Date(a.answered_at || 0).getTime();
    if (dateDiff) return dateDiff;
    return Number(a.answer_order || 0) - Number(b.answer_order || 0);
  });

  target.innerHTML = `
    <p class="admin-user-panel-note">直近${formatNumber(ordered.length)}件を表示しています。各行を開くと質問文を確認できます。</p>
    <div class="admin-user-special-list">
      ${ordered
        .map((answer, index) => {
          const answeredAt = formatDateTime(answer.answered_at);
          const selectedLabel = answer.selected_label || "-";
          const selectedOption = answer.selected_option ? `${answer.selected_option}. ` : "";
          return `
            <details class="admin-user-special-details"${index === 0 ? " open" : ""}>
              <summary>
                <span>${escapeHtml(selectedOption)}${escapeHtml(selectedLabel)}</span>
                <time>${escapeHtml(answeredAt)}</time>
              </summary>
              <dl class="admin-user-kv admin-user-special-kv">
                <div>
                  <dt>質問文</dt>
                  <dd>${escapeHtml(formatBlank(answer.question_text))}</dd>
                </div>
                <div>
                  <dt>選択内容</dt>
                  <dd>${escapeHtml(selectedOption)}${escapeHtml(selectedLabel)}</dd>
                </div>
                <div>
                  <dt>回答日時</dt>
                  <dd>${escapeHtml(answeredAt)}</dd>
                </div>
              </dl>
            </details>
          `;
        })
        .join("")}
    </div>
  `;
}

function renderAdminUserAiState(aiState) {
  const target = $("#adminUserAiState");
  if (!target) return;

  if (!aiState) {
    target.innerHTML = `<p class="admin-user-empty">AI会話状態はまだありません。</p>`;
    return;
  }

  target.innerHTML = `
    <dl class="admin-user-kv">
      <div>
        <dt>状態</dt>
        <dd>${escapeHtml(getAiStatusLabel(aiState.status))}</dd>
      </div>
      <div>
        <dt>返信回数</dt>
        <dd>${formatNumber(aiState.ai_reply_count)} / ${formatNumber(aiState.max_replies)}</dd>
      </div>
      <div>
        <dt>最終ユーザー発言</dt>
        <dd>${escapeHtml(formatDateTime(aiState.last_user_message_at))}</dd>
      </div>
      <div>
        <dt>最終AI返信</dt>
        <dd>${escapeHtml(formatDateTime(aiState.last_ai_reply_at))}</dd>
      </div>
      <div>
        <dt>CTA表示</dt>
        <dd>${escapeHtml(formatDateTime(aiState.cta_shown_at))}</dd>
      </div>
      <div>
        <dt>引き継ぎ</dt>
        <dd>${escapeHtml(formatDateTime(aiState.handed_off_at))}</dd>
      </div>
    </dl>
  `;
}

function renderAdminUserHandoffs(handoffs = []) {
  const target = $("#adminUserHandoffs");
  if (!target) return;

  if (!handoffs.length) {
    target.innerHTML = `<p class="admin-user-empty">相談依頼はまだありません。</p>`;
    return;
  }

  target.innerHTML = `
    <div class="admin-user-record-list">
      ${handoffs
        .map(
          (handoff) => `
            <article class="admin-user-record">
              <div class="admin-user-record-head">
                <strong>${escapeHtml(getHandoffStatusLabel(handoff.status))}</strong>
                <time>${escapeHtml(formatDateTime(handoff.requested_at))}</time>
              </div>
              <small>AI返信 ${formatNumber(handoff.ai_reply_count)} / ${formatNumber(handoff.max_replies)} 回</small>
              <div class="admin-user-handoff-form">
                <label>
                  対応ステータス
                  <select data-handoff-status-id="${escapeHtml(handoff.id)}">
                    ${renderHandoffStatusOptions(handoff.status)}
                  </select>
                </label>
                <button class="secondary-button" type="button" data-handoff-status-save="${escapeHtml(handoff.id)}">更新</button>
              </div>
            </article>
          `
        )
        .join("")}
    </div>
  `;
}

function renderAdminUserConversations(messages = []) {
  const target = $("#adminUserConversations");
  if (!target) return;

  if (!messages.length) {
    target.innerHTML = `<p class="admin-user-empty">LINE会話履歴はまだありません。</p>`;
    return;
  }

  target.innerHTML = `
    <div class="admin-user-record-list">
      ${messages
        .map((message) => {
          const directionClass = message.direction === "incoming" ? " is-incoming" : " is-outgoing";
          const speaker = message.sender_type === "user" ? "ユーザー" : message.sender_type === "ai" ? "AI" : message.sender_type || "-";
          return `
            <article class="admin-user-message${directionClass}">
              <small>${escapeHtml(formatDateTime(message.occurred_at))} / ${escapeHtml(speaker)} / ${escapeHtml(getConversationTypeLabel(message.conversation_type))}</small>
              <p>${escapeHtml(message.message_text || `[${message.message_type || "message"}]`)}</p>
            </article>
          `;
        })
        .join("")}
    </div>
  `;
}

function renderAdminUserDashboard(data) {
  userDashboard = data;
  selectedAdminUserId = data?.selectedUserId || "";
  renderAdminUserList(Array.isArray(data?.users) ? data.users : [], selectedAdminUserId);
  renderAdminUserOverview(data?.detail);
  renderAdminUserDiagnoses(data?.detail?.diagnoses || []);
  renderAdminUserPreferences(data?.detail?.preferences || null);
  renderAdminUserSurveyAnswers(data?.detail?.surveyAnswers || []);
  renderAdminUserSpecialAnswers(data?.detail?.specialAnswers || []);
  renderAdminUserAiState(data?.detail?.aiState || null);
  renderAdminUserHandoffs(data?.detail?.handoffRequests || []);
  renderAdminUserConversations(data?.detail?.conversationMessages || []);
  setAdminUserTab(adminUserTab);
}

async function loadAdminUsers(userId = selectedAdminUserId) {
  if (!getFunctionsBaseUrl()) {
    renderAdminUserMessage("Supabase接続後に表示されます");
    return false;
  }

  try {
    setUserStatus("ユーザー情報を読み込み中です…");
    const data = await requestAdminUsers(userId);
    if (!data) {
      renderAdminUserMessage("Supabase接続後に表示されます");
      return false;
    }
    renderAdminUserDashboard(data);
    setUserStatus("ユーザー情報を読み込みました");
    return true;
  } catch (error) {
    if (isUnauthorizedError(error)) {
      clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
      return false;
    }
    renderAdminUserMessage("ユーザー情報を読み込めません");
    setUserStatus(`ユーザー情報読み込み失敗: ${error.message}`);
    return false;
  }
}

function renderResultEditor() {
  const key = $("#resultSelect").value;
  const result = results[key];
  $("#resultTypeKeyInput").value = key;
  $("#resultNameInput").value = result.name;
  $("#resultCatchInput").value = result.catchCopy;
  $("#resultDescriptionInput").value = result.description;
  $("#resultStrengthsInput").value = joinLines(result.strengths);
  $("#resultJobsInput").value = joinLines(result.jobs);
  $("#resultIndustriesInput").value = joinLines(result.industries);
  $("#resultLineInput").value = result.lineMessage;
  $("#resultPercentInput").value = result.percent;
}

function renderCardEditor() {
  const cardId = $("#cardSelect").value;
  const card = cards.find((item) => item.id === cardId);
  if (!card) return;
  const deleteButton = $("#deleteCard");
  if (deleteButton) deleteButton.disabled = cards.length <= 1;
  $("#cardQuestionInput").value = card.question;
  $("#cardImageInput").value = card.image;
  $("#cardImageStoragePathInput").value = card.imageStoragePath || "";
  $("#cardVisualInput").value = card.visual;
  renderCardPreviewFromInputs();
}

function renderCardPreviewFromInputs() {
  const imageUrl = $("#cardImageInput").value.trim();
  const visual = $("#cardVisualInput").value.trim();
  const question = $("#cardQuestionInput").value.trim();
  $("#cardPreview").style.backgroundImage = `linear-gradient(180deg, transparent, rgba(0,0,0,.64)), url("${imageUrl}")`;
  $("#cardPreview").innerHTML = `<small>${escapeHtml(visual)}</small><strong>${escapeHtml(question)}</strong>`;
}

function bindImageUploadEvents() {
  const dropzone = $("#cardImageDropzone");
  const input = $("#cardImageFileInput");

  const handleFile = async (file) => {
    try {
      setStatus("画像を最適化中です…");
      const optimizedFile = await optimizeImageForUpload(file);
      await uploadCardImage(optimizedFile, file);
    } catch (error) {
      if (isUnauthorizedError(error)) {
        clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
        return;
      }
      setStatus(`画像アップロード失敗: ${error.message}`);
    } finally {
      input.value = "";
      dropzone.classList.remove("is-dragging");
    }
  };

  dropzone.addEventListener("click", () => input.click());
  dropzone.addEventListener("keydown", (event) => {
    if (event.key === "Enter" || event.key === " ") {
      event.preventDefault();
      input.click();
    }
  });
  input.addEventListener("change", () => {
    const file = input.files?.[0];
    if (file) handleFile(file);
  });
  dropzone.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropzone.classList.add("is-dragging");
  });
  dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("is-dragging");
  });
  dropzone.addEventListener("drop", (event) => {
    event.preventDefault();
    const file = event.dataTransfer?.files?.[0];
    if (file) handleFile(file);
  });
}

function bindSpecialQuestionImageUploadEvents() {
  const dropzone = $("#specialQuestionImageDropzone");
  const input = $("#specialQuestionImageFileInput");
  if (!dropzone || !input) return;

  const handleFile = async (file) => {
    try {
      setStatus("背景画像を最適化中です…");
      const optimizedFile = await optimizeImageForUpload(file);
      await uploadSpecialQuestionImage(optimizedFile, file);
    } catch (error) {
      if (isUnauthorizedError(error)) {
        clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
        return;
      }
      setStatus(`背景画像アップロード失敗: ${error.message}`);
    } finally {
      input.value = "";
      dropzone.classList.remove("is-dragging");
    }
  };

  input.addEventListener("change", () => {
    const file = input.files?.[0];
    if (file) handleFile(file);
  });

  dropzone.addEventListener("click", () => input.click());
  dropzone.addEventListener("keydown", (event) => {
    if (event.key === "Enter" || event.key === " ") {
      event.preventDefault();
      input.click();
    }
  });

  dropzone.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropzone.classList.add("is-dragging");
  });

  dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("is-dragging");
  });

  dropzone.addEventListener("drop", (event) => {
    event.preventDefault();
    const file = event.dataTransfer?.files?.[0];
    if (file) handleFile(file);
  });
}

function bindEvents() {
  if (adminEventsBound) return;
  adminEventsBound = true;

  $("#adminLogout").addEventListener("click", () => {
    clearAdminSession("ログアウトしました");
  });

  const adminPageTabs = document.querySelector(".admin-page-tabs");
  if (adminPageTabs) {
    adminPageTabs.addEventListener("click", (event) => {
      const button = event.target.closest("[data-admin-page]");
      if (!button) return;
      setAdminPage(button.dataset.adminPage);
    });
  }

  document.querySelector(".kpi-range-tabs").addEventListener("click", (event) => {
    const button = event.target.closest("[data-kpi-range]");
    if (!button) return;
    kpiRange = button.dataset.kpiRange;
    document.querySelectorAll("[data-kpi-range]").forEach((item) => {
      item.classList.toggle("is-active", item === button);
    });
    if (kpiSummary) renderKpiDashboard(kpiSummary);
  });

  $("#refreshKpi").addEventListener("click", async () => {
    if (await loadKpiDashboard()) {
      setStatus("KPIを更新しました");
    }
  });

  const lineSurveyQuestionList = $("#lineSurveyQuestionList");
  if (lineSurveyQuestionList) {
    lineSurveyQuestionList.addEventListener("click", (event) => {
      const button = event.target.closest("[data-line-survey-key]");
      if (!button) return;
      if (!saveLineSurveyQuestionFromInputs()) return;
      selectedLineSurveyKey = button.dataset.lineSurveyKey || selectedLineSurveyKey;
      renderLineSurveyEditor();
    });
  }

  const saveLineSurvey = $("#saveLineSurvey");
  if (saveLineSurvey) {
    saveLineSurvey.addEventListener("click", persistLineSurveyQuestions);
  }

  const specialQuestionList = $("#specialQuestionList");
  if (specialQuestionList) {
    specialQuestionList.addEventListener("click", (event) => {
      const button = event.target.closest("[data-special-question-key]");
      if (!button) return;
      if (!saveSpecialQuestionFromInputs()) return;
      selectedSpecialQuestionKey = button.dataset.specialQuestionKey || selectedSpecialQuestionKey;
      renderSpecialQuestionEditor();
    });

    specialQuestionList.addEventListener("change", (event) => {
      const checkbox = event.target.closest("[data-special-question-enabled-key]");
      if (!checkbox) return;
      updateSpecialQuestionEnabled(checkbox.dataset.specialQuestionEnabledKey, checkbox.checked);
    });
  }

  const saveSpecialQuestions = $("#saveSpecialQuestions");
  if (saveSpecialQuestions) {
    saveSpecialQuestions.addEventListener("click", persistSpecialQuestions);
  }

  const addSpecialQuestionButton = $("#addSpecialQuestion");
  if (addSpecialQuestionButton) {
    addSpecialQuestionButton.addEventListener("click", async () => {
      try {
        await addSpecialQuestion();
      } catch (error) {
        if (isUnauthorizedError(error)) {
          clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
          return;
        }
        setStatus(`スペシャルクエスチョン追加失敗: ${error.message}`);
      }
    });
  }

  const deleteSpecialQuestionButton = $("#deleteSpecialQuestion");
  if (deleteSpecialQuestionButton) {
    deleteSpecialQuestionButton.addEventListener("click", async () => {
      try {
        await deleteSelectedSpecialQuestion();
      } catch (error) {
        if (isUnauthorizedError(error)) {
          clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
          return;
        }
        setStatus(`スペシャルクエスチョン削除失敗: ${error.message}`);
      }
    });
  }

  [
    "#specialQuestionTextInput",
    "#specialQuestionOptionAInput",
    "#specialQuestionOptionBInput",
    "#specialQuestionCategoryInput"
  ].forEach((selector) => {
    const input = $(selector);
    if (input) input.addEventListener("input", renderSpecialQuestionPreviewFromInputs);
  });

  const specialQuestionImageInput = $("#specialQuestionImageInput");
  if (specialQuestionImageInput) {
    specialQuestionImageInput.addEventListener("input", () => {
      $("#specialQuestionImageStoragePathInput").value = "";
      renderSpecialQuestionPreviewFromInputs();
    });
  }
  bindSpecialQuestionImageUploadEvents();

  const refreshAdminUsers = $("#refreshAdminUsers");
  if (refreshAdminUsers) {
    refreshAdminUsers.addEventListener("click", async () => {
      if (await loadAdminUsers(selectedAdminUserId)) {
        setStatus("ユーザー情報を更新しました");
      }
    });
  }

  const adminUserList = $("#adminUserList");
  if (adminUserList) {
    adminUserList.addEventListener("click", async (event) => {
      const button = event.target.closest("[data-admin-user-id]");
      if (!button) return;
      selectedAdminUserId = button.dataset.adminUserId || "";
      renderAdminUserList(userDashboard?.users || [], selectedAdminUserId);
      await loadAdminUsers(selectedAdminUserId);
    });
  }

  document.querySelectorAll("[data-admin-user-tab]").forEach((button) => {
    button.addEventListener("click", () => {
      setAdminUserTab(button.dataset.adminUserTab);
    });
  });

  const adminUserHandoffs = $("#adminUserHandoffs");
  if (adminUserHandoffs) {
    adminUserHandoffs.addEventListener("click", async (event) => {
      const button = event.target.closest("[data-handoff-status-save]");
      if (!button) return;

      const handoffId = button.dataset.handoffStatusSave || "";
      const select = [...adminUserHandoffs.querySelectorAll("[data-handoff-status-id]")]
        .find((item) => item.dataset.handoffStatusId === handoffId);
      const status = select?.value || "";
      if (!handoffId || !status) return;

      button.disabled = true;
      setUserStatus("対応ステータスを更新中です…");

      try {
        await requestUpdateHandoffStatus(handoffId, status);
        setStatus("対応ステータスを更新しました");
        await loadAdminUsers(selectedAdminUserId);
        setAdminUserTab("handoffs");
      } catch (error) {
        if (isUnauthorizedError(error)) {
          clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
          return;
        }
        setUserStatus(`対応ステータス更新失敗: ${error.message}`);
      } finally {
        button.disabled = false;
      }
    });
  }

  $("#saveGeneral").addEventListener("click", async () => {
    const safeQuestionCount = getSafeQuestionCount($("#diagnosisQuestionCountInput").value);
    if (!validateSpecialQuestionCapacity(safeQuestionCount)) return;
    $("#diagnosisQuestionCountInput").value = safeQuestionCount;
    save({
      comparisonCount: Number($("#comparisonCountInput").value || 0),
      comparisonIncrementIntervalHours: Number($("#comparisonIntervalInput").value || 0),
      comparisonIncrementCount: Number($("#comparisonIncrementInput").value || 0),
      comparisonCountUpdatedAt: new Date().toISOString(),
      diagnosisQuestionCount: safeQuestionCount,
      jobCount: Number($("#jobCountInput").value || 0),
      highMatchCount: Number($("#highMatchCountInput").value || 0),
      requireLineBeforeResult: $("#requireLineInput").checked
    });
    await persistMaster("表示数値を保存しました");
  });

  const saveAiConversationSettings = $("#saveAiConversationSettings");
  if (saveAiConversationSettings) {
    saveAiConversationSettings.addEventListener("click", persistAiConversationSettings);
  }

  $("#resultSelect").addEventListener("change", () => {
    renderResultEditor();
    renderResultTypeList($("#resultSelect").value);
  });

  $("#resultTypeList").addEventListener("click", (event) => {
    const button = event.target.closest("[data-result-key]");
    if (!button) return;
    $("#resultSelect").value = button.dataset.resultKey;
    renderResultEditor();
    renderResultTypeList(button.dataset.resultKey);
  });

  $("#saveResult").addEventListener("click", async () => {
    const key = $("#resultSelect").value;
    const base = results[key];
    save({
      resultOverrides: {
        ...(settings.resultOverrides || {}),
        [key]: {
          ...base,
          name: $("#resultNameInput").value.trim(),
          catchCopy: $("#resultCatchInput").value.trim(),
          description: $("#resultDescriptionInput").value.trim(),
          strengths: splitLines($("#resultStrengthsInput").value),
          jobs: splitLines($("#resultJobsInput").value),
          industries: splitLines($("#resultIndustriesInput").value),
          lineMessage: $("#resultLineInput").value.trim(),
          percent: Number($("#resultPercentInput").value || base.percent)
        }
      }
    });
    populateSelects(key, $("#cardSelect").value);
    renderResultEditor();
    renderResultTypeList(key);
    await persistMaster("診断結果文章を保存しました");
  });

  $("#cardSelect").addEventListener("change", () => {
    renderCardEditor();
    renderCardList($("#cardSelect").value);
  });

  $("#cardList").addEventListener("click", (event) => {
    const button = event.target.closest("[data-card-id]");
    if (!button) return;
    $("#cardSelect").value = button.dataset.cardId;
    renderCardEditor();
    renderCardList(button.dataset.cardId);
  });
  $("#cardList").addEventListener("change", (event) => {
    const checkbox = event.target.closest("[data-card-enabled-id]");
    if (!checkbox) return;
    updateCardEnabled(checkbox.dataset.cardEnabledId, checkbox.checked);
  });

  $("#cardQuestionInput").addEventListener("input", renderCardPreviewFromInputs);
  $("#cardImageInput").addEventListener("input", () => {
    $("#cardImageStoragePathInput").value = "";
    renderCardPreviewFromInputs();
  });
  $("#cardVisualInput").addEventListener("input", renderCardPreviewFromInputs);
  bindImageUploadEvents();
  $("#diagnosisQuestionCountInput").addEventListener("input", renderActiveCardCount);
  $("#diagnosisQuestionCountInput").addEventListener("change", saveQuestionCountFromInput);

  $("#addCard").addEventListener("click", async () => {
    const cardId = getNextCardId();
    const sortOrder = Math.max(...cards.map((card) => Number(card.sortOrder || 0))) + 1;
    const nextActiveCount = getActiveCardCount() + 1;
    save({
      diagnosisQuestionCount: getSafeQuestionCount(settings.diagnosisQuestionCount, nextActiveCount),
      cardOverrides: {
        ...(settings.cardOverrides || {}),
        [cardId]: {
          question: "新しい質問を入力してください",
          image: cards[0]?.image || "",
          imageStoragePath: "",
          visual: "新規カード",
          yesScores: { people: 1 },
          noScores: { focus: 1 },
          enabled: true,
          sortOrder
        }
      }
    });
    populateSelects($("#resultSelect").value, cardId);
    renderGeneral();
    renderCardEditor();
    await persistMaster("新規質問を追加しました。内容を編集してください");
  });

  const deleteCardButton = $("#deleteCard");
  if (deleteCardButton) {
    deleteCardButton.addEventListener("click", async () => {
      try {
        await deleteSelectedCard();
      } catch (error) {
        if (isUnauthorizedError(error)) {
          clearAdminSession("管理セッションが切れました。もう一度ログインしてください");
          return;
        }
        setStatus(`質問削除失敗: ${error.message}`);
      }
    });
  }

  $("#saveCardActivation").addEventListener("click", async () => {
    if (!saveQuestionCountFromInput()) return;
    await persistMaster("出題設定を保存しました");
  });

  $("#saveCard").addEventListener("click", async () => {
    const cardId = $("#cardSelect").value;
    const card = cards.find((item) => item.id === cardId);
    if (!card) return;
    save({
      cardOverrides: {
        ...(settings.cardOverrides || {}),
        [cardId]: getCardSettings(card, {
          question: $("#cardQuestionInput").value.trim(),
          image: $("#cardImageInput").value.trim(),
          imageStoragePath: $("#cardImageStoragePathInput").value.trim(),
          visual: $("#cardVisualInput").value.trim()
        })
      }
    });
    populateSelects($("#resultSelect").value, cardId);
    renderGeneral();
    renderCardEditor();
    await persistMaster("スワイプ画像/質問内容を保存しました");
  });

  $("#syncSupabase").addEventListener("click", async () => {
    await persistMaster("全データを保存しました");
  });

  $("#exportSettings").addEventListener("click", () => {
    $("#settingsJson").value = JSON.stringify(settings, null, 2);
    setStatus("設定を書き出しました");
  });

  $("#importSettings").addEventListener("click", async () => {
    try {
      const parsed = JSON.parse($("#settingsJson").value);
      save(parsed);
      populateSelects();
      renderGeneral();
      renderLineSurveyEditor();
      renderSpecialQuestionEditor();
      renderResultEditor();
      renderCardEditor();
      await persistMaster("設定を読み込みました");
    } catch {
      setStatus("JSONを確認してください");
    }
  });

  $("#resetSettings").addEventListener("click", async () => {
    saveAdminSettings(DEFAULT_SETTINGS);
    settings = loadAdminSettings();
    results = getConfiguredResults(settings);
    cards = getConfiguredCards(settings);
    lineSurveyQuestions = normalizeLineSurveyQuestions([]);
    selectedLineSurveyKey = lineSurveyQuestions[0]?.key || "";
    specialQuestions = [];
    selectedSpecialQuestionKey = "";
    deletedSpecialQuestionKeys = [];
    populateSelects();
    renderGeneral();
    renderLineSurveyEditor();
    renderSpecialQuestionEditor();
    renderResultEditor();
    renderCardEditor();
    $("#settingsJson").value = "";
    await persistMaster("設定をリセットしました");
  });
}

export async function initAdminApp() {
  if (!$("#adminApp")) {
    throw new Error("管理画面HTMLが読み込まれていません");
  }

  try {
    const loadedRemote = await loadRemoteSettings();
    if (loadedRemote) {
      setStatus("Supabaseから管理データを読み込みました");
    }
  } catch (error) {
    if (getFunctionsBaseUrl() && isUnauthorizedError(error)) {
      clearAdminSession("管理パスワードを入力してください");
      throw error;
    }
    setStatus(`Supabase読み込み失敗: ${error.message}`);
  }

  populateSelects();
  renderGeneral();
  renderLineSurveyEditor();
  renderSpecialQuestionEditor();
  renderResultEditor();
  renderCardEditor();
  setAdminPage(activeAdminPage);
  bindEvents();
  await loadKpiDashboard();
  await loadAdminUsers();
}
