import {
  DEFAULT_SETTINGS,
  buildSettingsFromMaster,
  getConfiguredCards,
  getConfiguredResults,
  getCurrentComparisonCount,
  loadAdminSettings,
  saveAdminSettings,
  serializeSettingsForMaster
} from "./data.js?v=20260807-100q-balanced-v2";

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
let adminSessionToken = sessionStorage.getItem(ADMIN_SESSION_STORAGE_KEY) || "";
let adminEventsBound = false;

const $ = (selector) => document.querySelector(selector);
const IMAGE_UPLOAD_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);
const MAX_UPLOAD_WIDTH = 1200;
const TARGET_UPLOAD_BYTES = 150 * 1024;
const INITIAL_WEBP_QUALITY = 0.86;
const MIN_WEBP_QUALITY = 0.62;
const WEBP_QUALITY_STEP = 0.06;
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

  const response = await fetch(`${baseUrl}/kpi-summary?days=14`, {
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

async function loadRemoteSettings() {
  const master = await requestAdminMaster("GET");
  if (!master) return false;

  settings = buildSettingsFromMaster(master);
  lineSurveyQuestions = normalizeLineSurveyQuestions(master.lineSurveyQuestions);
  selectedLineSurveyKey = lineSurveyQuestions.some((question) => question.key === selectedLineSurveyKey)
    ? selectedLineSurveyKey
    : lineSurveyQuestions[0]?.key || "";
  saveAdminSettings(settings);
  results = getConfiguredResults(settings);
  cards = getConfiguredCards(settings);
  return true;
}

async function persistMaster(statusMessage) {
  if ($("#lineSurveyKeyInput")?.value && !saveLineSurveyQuestionFromInputs()) {
    return;
  }

  saveAdminSettings(settings);

  if (!getFunctionsBaseUrl()) {
    setStatus(`${statusMessage}（ローカル保存）`);
    return;
  }

  try {
    const master = await requestAdminMaster("POST", {
      ...serializeSettingsForMaster(settings),
      lineSurveyQuestions
    });
    if (master) {
      settings = buildSettingsFromMaster(master);
      lineSurveyQuestions = normalizeLineSurveyQuestions(master.lineSurveyQuestions);
      selectedLineSurveyKey = lineSurveyQuestions.some((question) => question.key === selectedLineSurveyKey)
        ? selectedLineSurveyKey
        : lineSurveyQuestions[0]?.key || "";
      saveAdminSettings(settings);
      results = getConfiguredResults(settings);
      cards = getConfiguredCards(settings);
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

function getSafeQuestionCount(value = settings.diagnosisQuestionCount, activeCount = getActiveCardCount()) {
  const requestedCount = Math.floor(Number(value || DEFAULT_SETTINGS.diagnosisQuestionCount));
  return Math.max(1, Math.min(Math.max(activeCount, 1), requestedCount));
}

function renderActiveCardCount() {
  const activeCount = getActiveCardCount();
  const activeCardCount = $("#activeCardCount");
  const questionCountInput = $("#diagnosisQuestionCountInput");
  if (activeCardCount) activeCardCount.textContent = formatNumber(activeCount);
  if (questionCountInput) {
    questionCountInput.max = Math.max(activeCount, 1);
    if (!questionCountInput.value) {
      questionCountInput.value = getSafeQuestionCount(settings.diagnosisQuestionCount, activeCount);
    }
  }
  const questionCountHelp = $("#diagnosisQuestionCountHelp");
  if (questionCountHelp) {
    questionCountHelp.textContent =
      `出題候補${formatNumber(activeCount)}問から、設定した件数をランダムで出題します。`;
  }
}

function saveQuestionCountFromInput() {
  const input = $("#diagnosisQuestionCountInput");
  if (!input) return;
  const safeCount = getSafeQuestionCount(input.value);
  input.value = safeCount;
  save({ diagnosisQuestionCount: safeCount });
  renderActiveCardCount();
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
      Number(metadata.lineSurveyQuestionsCount || 0) ? `LINEアンケート${metadata.lineSurveyQuestionsCount}件` : ""
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
  const adminLogs = Array.isArray(summary?.adminLogs) ? summary.adminLogs : [];
  $("#kpiTableTitle").textContent = current.title;
  renderKpiCards(current.rows[0] || null);
  renderKpiDailyTable(current.rows);
  renderKpiResultTypes(resultTypes);
  renderKpiDropoffs(dropoffs);
  renderAdminAuditLogs(adminLogs);
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
  const availableTabs = new Set(["diagnoses", "preferences", "ai", "handoffs", "conversations"]);
  adminUserTab = availableTabs.has(tabKey) ? tabKey : "diagnoses";

  document.querySelectorAll("[data-admin-user-tab]").forEach((button) => {
    button.classList.toggle("is-active", button.dataset.adminUserTab === adminUserTab);
  });
  document.querySelectorAll("[data-admin-user-panel]").forEach((panel) => {
    panel.classList.toggle("is-active", panel.dataset.adminUserPanel === adminUserTab);
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

function renderScoreRates(scoreRates = {}) {
  const axisLabels = {
    people: "People",
    focus: "Focus",
    challenge: "Challenge",
    stability: "Stability",
    creativity: "Creativity",
    execution: "Execution"
  };

  return Object.entries(axisLabels)
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
              <small>${escapeHtml(diagnosis.primary_axis || "-")} / ${escapeHtml(diagnosis.secondary_axis || "-")} / ${formatNumber(diagnosis.answered_count)}問回答</small>
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

function bindEvents() {
  if (adminEventsBound) return;
  adminEventsBound = true;

  $("#adminLogout").addEventListener("click", () => {
    clearAdminSession("ログアウトしました");
  });

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
    saveQuestionCountFromInput();
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
    populateSelects();
    renderGeneral();
    renderLineSurveyEditor();
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
  renderResultEditor();
  renderCardEditor();
  bindEvents();
  await loadKpiDashboard();
  await loadAdminUsers();
}
