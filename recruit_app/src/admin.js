import {
  DEFAULT_SETTINGS,
  buildSettingsFromMaster,
  getConfiguredCards,
  getConfiguredResults,
  getCurrentComparisonCount,
  loadAdminSettings,
  saveAdminSettings,
  serializeSettingsForMaster
} from "./data.js";

const config = window.CAREER_APP_CONFIG || {};
const ADMIN_SESSION_STORAGE_KEY = "ai-career-admin-session";
let settings = loadAdminSettings();
let results = getConfiguredResults(settings);
let cards = getConfiguredCards(settings);
let kpiSummary = null;
let kpiRange = "daily";
let adminSessionToken = sessionStorage.getItem(ADMIN_SESSION_STORAGE_KEY) || "";
let adminEventsBound = false;

const $ = (selector) => document.querySelector(selector);
const IMAGE_UPLOAD_TYPES = new Set(["image/jpeg", "image/png", "image/webp"]);
const MAX_UPLOAD_WIDTH = 1200;
const TARGET_UPLOAD_BYTES = 150 * 1024;
const INITIAL_WEBP_QUALITY = 0.86;
const MIN_WEBP_QUALITY = 0.62;
const WEBP_QUALITY_STEP = 0.06;

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
  saveAdminSettings(settings);
  results = getConfiguredResults(settings);
  cards = getConfiguredCards(settings);
  return true;
}

async function persistMaster(statusMessage) {
  saveAdminSettings(settings);

  if (!getFunctionsBaseUrl()) {
    setStatus(`${statusMessage}（ローカル保存）`);
    return;
  }

  try {
    const master = await requestAdminMaster("POST", serializeSettingsForMaster(settings));
    if (master) {
      settings = buildSettingsFromMaster(master);
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

function renderActiveCardCount() {
  const activeCount = getActiveCardCount();
  const activeCardCount = $("#activeCardCount");
  const questionCountInput = $("#diagnosisQuestionCountInput");
  if (activeCardCount) activeCardCount.textContent = formatNumber(activeCount);
  if (questionCountInput) questionCountInput.value = activeCount;
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

  save({
    diagnosisQuestionCount: Math.max(1, getActiveCardCount() + (enabled ? 1 : -1)),
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

  save({
    diagnosisQuestionCount: Math.max(1, getActiveCardCount() - (card.enabled !== false ? 1 : 0)),
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
  $("#jobCountInput").value = settings.jobCount;
  $("#highMatchCountInput").value = settings.highMatchCount;
  $("#requireLineInput").checked = Boolean(settings.requireLineBeforeResult);
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
      Number(metadata.deletedCardsCount || 0) ? `削除${metadata.deletedCardsCount}件` : ""
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

  $("#saveGeneral").addEventListener("click", async () => {
    save({
      comparisonCount: Number($("#comparisonCountInput").value || 0),
      comparisonIncrementIntervalHours: Number($("#comparisonIntervalInput").value || 0),
      comparisonIncrementCount: Number($("#comparisonIncrementInput").value || 0),
      comparisonCountUpdatedAt: new Date().toISOString(),
      diagnosisQuestionCount: getActiveCardCount(),
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

  $("#addCard").addEventListener("click", async () => {
    const cardId = getNextCardId();
    const sortOrder = Math.max(...cards.map((card) => Number(card.sortOrder || 0))) + 1;
    save({
      diagnosisQuestionCount: getActiveCardCount() + 1,
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
    populateSelects();
    renderGeneral();
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
  renderResultEditor();
  renderCardEditor();
  bindEvents();
  await loadKpiDashboard();
}
