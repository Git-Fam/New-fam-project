import {
  DEFAULT_SETTINGS,
  buildSettingsFromMaster,
  getConfiguredCards,
  getConfiguredResults,
  loadAdminSettings,
  saveAdminSettings,
  serializeSettingsForMaster
} from "./data.js";

const config = window.CAREER_APP_CONFIG || {};
let settings = loadAdminSettings();
let results = getConfiguredResults(settings);
let cards = getConfiguredCards(settings);

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

function getFunctionsBaseUrl() {
  return String(config.supabaseFunctionsBaseUrl || "").replace(/\/$/, "");
}

function getAdminHeaders() {
  const headers = { "Content-Type": "application/json" };
  if (config.adminApiToken) headers["x-admin-token"] = config.adminApiToken;
  return headers;
}

function getAdminTokenHeaders() {
  const headers = {};
  if (config.adminApiToken) headers["x-admin-token"] = config.adminApiToken;
  return headers;
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
    throw new Error(text || "Supabase保存に失敗しました");
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
    throw new Error(text || "画像アップロードに失敗しました");
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
    await requestAdminMaster("POST", serializeSettingsForMaster(settings));
    setStatus(`${statusMessage} / Supabaseへ保存しました`);
  } catch (error) {
    setStatus(`${statusMessage} / Supabase保存失敗: ${error.message}`);
  }
}

function save(settingsPatch = {}) {
  settings = {
    ...DEFAULT_SETTINGS,
    ...settings,
    ...settingsPatch,
    resultOverrides: settingsPatch.resultOverrides || settings.resultOverrides || {},
    cardOverrides: settingsPatch.cardOverrides || settings.cardOverrides || {}
  };
  saveAdminSettings(settings);
  results = getConfiguredResults(settings);
  cards = getConfiguredCards(settings);
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
  $("#cardList").innerHTML = cards
    .map((card, index) => {
      const number = String(index + 1).padStart(2, "0");
      const activeClass = card.id === selectedCard ? " is-active" : "";
      return `
        <button class="admin-type-button admin-card-button${activeClass}" type="button" data-card-id="${card.id}">
          <span>${number}</span>
          <strong>${escapeHtml(card.question)}</strong>
          <small>${escapeHtml(card.id)} / ${escapeHtml(card.visual)}</small>
        </button>
      `;
    })
    .join("");
}

function renderGeneral() {
  $("#comparisonCountInput").value = settings.comparisonCount;
  $("#jobCountInput").value = settings.jobCount;
  $("#highMatchCountInput").value = settings.highMatchCount;
  $("#requireLineInput").checked = Boolean(settings.requireLineBeforeResult);
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
  $("#saveGeneral").addEventListener("click", async () => {
    save({
      comparisonCount: Number($("#comparisonCountInput").value || 0),
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

  $("#cardQuestionInput").addEventListener("input", renderCardPreviewFromInputs);
  $("#cardImageInput").addEventListener("input", () => {
    $("#cardImageStoragePathInput").value = "";
    renderCardPreviewFromInputs();
  });
  $("#cardVisualInput").addEventListener("input", renderCardPreviewFromInputs);
  bindImageUploadEvents();

  $("#saveCard").addEventListener("click", async () => {
    const cardId = $("#cardSelect").value;
    save({
      cardOverrides: {
        ...(settings.cardOverrides || {}),
        [cardId]: {
          question: $("#cardQuestionInput").value.trim(),
          image: $("#cardImageInput").value.trim(),
          imageStoragePath: $("#cardImageStoragePathInput").value.trim(),
          visual: $("#cardVisualInput").value.trim()
        }
      }
    });
    populateSelects($("#resultSelect").value, cardId);
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

async function init() {
  try {
    const loadedRemote = await loadRemoteSettings();
    if (loadedRemote) {
      setStatus("Supabaseから管理データを読み込みました");
    }
  } catch (error) {
    setStatus(`Supabase読み込み失敗: ${error.message}`);
  }

  populateSelects();
  renderGeneral();
  renderResultEditor();
  renderCardEditor();
  bindEvents();
}

init();
