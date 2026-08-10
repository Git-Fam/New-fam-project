import {
  AXES,
  AXIS_ORDER,
  DEFAULT_CARDS,
  DEFAULT_SETTINGS,
  STORAGE_KEYS,
  buildSettingsFromMaster,
  getConfiguredResults,
  getCurrentComparisonCount,
  getDiagnosisCards,
  getResultKey,
  loadAdminSettings
} from "./data.js?v=20260807-100q-balanced-v2";

const config = window.CAREER_APP_CONFIG || {};

function getLocalRuntimeSettings() {
  const localSettings = loadAdminSettings();
  return {
    ...DEFAULT_SETTINGS,
    ...localSettings,
    requireLineBeforeResult:
      Boolean(config.requireLineBeforeResult) || localSettings.requireLineBeforeResult
  };
}

let settings = getLocalRuntimeSettings();
let cards = getDiagnosisCards(settings);
let results = getConfiguredResults(settings);
let masterLoadPromise = null;
let comparisonTicker = null;
const GOOGLE_ANALYTICS_EVENTS = new Set([
  "diagnosis_start",
  "diagnosis_complete",
  "result_view",
  "jobs_view",
  "line_button_click",
  "line_login_success",
  "result_sent",
  "share_click",
  "retry_click"
]);

const state = {
  answers: [],
  currentIndex: 0,
  cardStartedAt: 0,
  isAnimating: false,
  currentDiagnosis: null,
  funnelId: null,
  loggedResultViews: new Set(),
  loggedJobsViews: new Set()
};

const $ = (selector) => document.querySelector(selector);
const $$ = (selector) => [...document.querySelectorAll(selector)];

function escapeHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

function formatNumber(value) {
  return Number(value || 0).toLocaleString("ja-JP");
}

function getEstimatedDurationMinutes(questionCount = cards.length) {
  return Math.max(1, Math.ceil((Number(questionCount || 1) * 3) / 60));
}

function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function animateNumber({ duration, from, to, onUpdate }) {
  const startedAt = performance.now();
  return new Promise((resolve) => {
    function tick(now) {
      const elapsed = now - startedAt;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = Math.round(from + (to - from) * eased);
      onUpdate(value);

      if (progress < 1) {
        requestAnimationFrame(tick);
        return;
      }

      resolve();
    }

    requestAnimationFrame(tick);
  });
}

function createId(prefix) {
  const id = crypto.randomUUID ? crypto.randomUUID() : `${Date.now()}-${Math.random().toString(16).slice(2)}`;
  return `${prefix}_${id}`;
}

function getOrCreateLocalId(key, prefix) {
  let value = localStorage.getItem(key);
  if (!value) {
    value = createId(prefix);
    localStorage.setItem(key, value);
  }
  return value;
}

function getOrCreateSessionId() {
  let value = sessionStorage.getItem(STORAGE_KEYS.sessionId);
  if (!value) {
    value = createId("sess");
    sessionStorage.setItem(STORAGE_KEYS.sessionId, value);
  }
  return value;
}

function captureUtmParams() {
  const params = new URLSearchParams(window.location.search);
  const current = {
    utmSource: params.get("utm_source") || "",
    utmMedium: params.get("utm_medium") || "",
    utmCampaign: params.get("utm_campaign") || ""
  };

  if (current.utmSource || current.utmMedium || current.utmCampaign) {
    localStorage.setItem(STORAGE_KEYS.utm, JSON.stringify(current));
    return current;
  }

  try {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.utm) || "{}");
  } catch {
    return {};
  }
}

function getDeviceType() {
  const width = window.innerWidth;
  if (width <= 430) return "mobile";
  if (width <= 820) return "tablet";
  return "desktop";
}

function getCurrentFunnelId() {
  if (state.funnelId) return state.funnelId;
  const draft = state.currentDiagnosis || loadDraft();
  if (draft?.funnelId) {
    state.funnelId = draft.funnelId;
    return draft.funnelId;
  }
  return localStorage.getItem(STORAGE_KEYS.funnelId) || null;
}

function startNewFunnel() {
  const funnelId = createId("fun");
  state.funnelId = funnelId;
  localStorage.setItem(STORAGE_KEYS.funnelId, funnelId);
  return funnelId;
}

function getAnalyticsContext(payload = {}) {
  const utm = captureUtmParams();
  return {
    visitorId: getOrCreateLocalId(STORAGE_KEYS.visitorId, "vis"),
    sessionId: getOrCreateSessionId(),
    funnelId: payload.funnelId || getCurrentFunnelId(),
    resultType: payload.resultType || state.currentDiagnosis?.resultType || null,
    utmSource: utm.utmSource || null,
    utmMedium: utm.utmMedium || null,
    utmCampaign: utm.utmCampaign || null,
    deviceType: getDeviceType(),
    pagePath: `${window.location.pathname}${window.location.hash || ""}`
  };
}

function showScreen(name) {
  $$(".screen").forEach((screen) => {
    const isActive = screen.dataset.screen === name;
    screen.hidden = !isActive;
    screen.classList.toggle("is-active", isActive);
  });
  document.body.dataset.view = name;
}

function saveDraft(diagnosis) {
  localStorage.setItem(STORAGE_KEYS.diagnosisDraft, JSON.stringify(diagnosis));
}

function loadDraft() {
  try {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.diagnosisDraft) || "null");
  } catch {
    return null;
  }
}

function saveLineConnection(connection) {
  localStorage.setItem(
    STORAGE_KEYS.lineConnection,
    JSON.stringify({
      ...connection,
      savedAt: new Date().toISOString()
    })
  );
}

function loadLineConnection() {
  try {
    const connection = JSON.parse(localStorage.getItem(STORAGE_KEYS.lineConnection) || "null");
    if (connection?.lineConnectionId || connection?.diagnosisId) return connection;
  } catch {
    // Fall through to the legacy draft fallback below.
  }

  const draft = loadDraft();
  if (draft?.diagnosisId && ["linked", "sent"].includes(String(draft.status))) {
    return {
      diagnosisId: draft.diagnosisId,
      lineConnectionId: null,
      lastSentDiagnosisId: draft.diagnosisId
    };
  }

  return null;
}

function pushLocalEvent(eventName, payload = {}) {
  const context = getAnalyticsContext(payload);
  const events = JSON.parse(localStorage.getItem(STORAGE_KEYS.eventLog) || "[]");
  events.push({
    eventName,
    payload,
    ...context,
    diagnosisId: state.currentDiagnosis?.diagnosisId || payload.diagnosisId || null,
    createdAt: new Date().toISOString()
  });
  localStorage.setItem(STORAGE_KEYS.eventLog, JSON.stringify(events.slice(-120)));
}

function getFunctionsBaseUrl() {
  return String(config.supabaseFunctionsBaseUrl || "").replace(/\/$/, "");
}

async function callEdgeFunction(path, body) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;

  const response = await fetch(`${baseUrl}/${path}`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(body)
  });

  if (!response.ok) {
    const text = await response.text();
    throw new Error(text || `Edge Function failed: ${path}`);
  }

  return response.json();
}

async function fetchEdgeFunction(path) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) return null;

  const response = await fetch(`${baseUrl}/${path}`);
  if (!response.ok) {
    const text = await response.text();
    throw new Error(text || `Edge Function failed: ${path}`);
  }

  return response.json();
}

function applyRuntimeSettings(nextSettings) {
  settings = {
    ...DEFAULT_SETTINGS,
    ...nextSettings,
    requireLineBeforeResult:
      Boolean(config.requireLineBeforeResult) || Boolean(nextSettings.requireLineBeforeResult)
  };
  cards = getDiagnosisCards(settings);
  results = getConfiguredResults(settings);
}

async function loadRemoteMaster() {
  try {
    const master = await fetchEdgeFunction("admin-master");
    if (!master) return;
    applyRuntimeSettings(buildSettingsFromMaster(master));
  } catch (error) {
    console.warn(error);
  }
}

function renderLandingMetrics() {
  const durationMinutes = getEstimatedDurationMinutes(cards.length);
  const lpQuestionCount = $("#lpQuestionCount");
  if (lpQuestionCount) lpQuestionCount.textContent = formatNumber(cards.length);
  const lpDuration = $("#lpDuration");
  if (lpDuration) lpDuration.textContent = `診断時間：約${durationMinutes}分`;
  const startButton = $("#startFromHero");
  if (startButton) startButton.textContent = `診断スタート（約${durationMinutes}分）`;
  $("#lpCompareCount").textContent = formatNumber(getCurrentComparisonCount(settings));
  $("#lpJobCount").textContent = formatNumber(settings.jobCount);
}

function renderComparisonMetrics() {
  const currentComparisonCount = formatNumber(getCurrentComparisonCount(settings));
  const lpCompareCount = $("#lpCompareCount");
  const compareCount = $("#compareCount");
  if (lpCompareCount) lpCompareCount.textContent = currentComparisonCount;
  if (compareCount) compareCount.textContent = currentComparisonCount;
}

function startComparisonTicker() {
  if (comparisonTicker) clearInterval(comparisonTicker);
  comparisonTicker = setInterval(renderComparisonMetrics, 60 * 1000);
}

function logEvent(eventName, payload = {}) {
  const rawDiagnosisId = state.currentDiagnosis?.diagnosisId || payload.diagnosisId || null;
  const diagnosisId =
    rawDiagnosisId && String(rawDiagnosisId).startsWith("diag_") ? null : rawDiagnosisId;
  const context = getAnalyticsContext(payload);
  pushLocalEvent(eventName, payload);
  trackGoogleAnalyticsEvent(eventName);
  callEdgeFunction("event-log", {
    eventName,
    diagnosisId,
    ...context,
    payload
  }).catch(() => {});
}

function trackGoogleAnalyticsEvent(eventName) {
  if (!GOOGLE_ANALYTICS_EVENTS.has(eventName) || typeof window.gtag !== "function") return;

  window.gtag("event", eventName, {
    event_category: "career_diagnosis",
    transport_type: "beacon"
  });
}

function logDiagnosisProgress(payload = {}) {
  const funnelId = payload.funnelId || state.funnelId || getCurrentFunnelId();
  if (!funnelId) return;
  const context = getAnalyticsContext({ ...payload, funnelId });
  callEdgeFunction("event-log", {
    eventName: "diagnosis_progress",
    diagnosisId: null,
    ...context,
    payload: {
      funnelId,
      totalQuestions: cards.length,
      ...payload
    }
  }).catch(() => {});
}

function calculateScores(cardList, answerList) {
  const totalScores = Object.fromEntries(AXIS_ORDER.map((axis) => [axis, 0]));

  answerList.forEach((answerData) => {
    const card = cardList.find((item) => item.id === answerData.imageId);
    if (!card) return;

    const scores = answerData.answer === "yes" ? card.yesScores : card.noScores;
    Object.entries(scores).forEach(([key, value]) => {
      totalScores[key] += value;
    });
  });

  return totalScores;
}

function calculateMaxScores(cardList) {
  const maxScores = Object.fromEntries(AXIS_ORDER.map((axis) => [axis, 0]));

  cardList.forEach((card) => {
    AXIS_ORDER.forEach((axis) => {
      maxScores[axis] += Math.max(card.yesScores[axis] || 0, card.noScores[axis] || 0);
    });
  });

  return maxScores;
}

function calculateScoreRates(scores, maxScores) {
  return Object.fromEntries(
    AXIS_ORDER.map((axis) => {
      const max = maxScores[axis] || 1;
      return [axis, Math.round((scores[axis] / max) * 100)];
    })
  );
}

function pickTopAxes(scores, scoreRates) {
  return [...AXIS_ORDER].sort((a, b) => {
    if (scoreRates[b] !== scoreRates[a]) return scoreRates[b] - scoreRates[a];
    if (scores[b] !== scores[a]) return scores[b] - scores[a];
    return AXIS_ORDER.indexOf(a) - AXIS_ORDER.indexOf(b);
  });
}

function buildDiagnosis() {
  const scores = calculateScores(cards, state.answers);
  const maxScores = calculateMaxScores(cards);
  const scoreRates = calculateScoreRates(scores, maxScores);
  const rankedAxes = pickTopAxes(scores, scoreRates);
  const primaryAxis = rankedAxes[0];
  const secondaryAxis = rankedAxes[1];
  const resultType = getResultKey(primaryAxis, secondaryAxis);
  const result = results[resultType];
  const now = new Date();
  const expiresAt = new Date(now.getTime() + 24 * 60 * 60 * 1000);

  return {
    diagnosisId: crypto.randomUUID ? `diag_${crypto.randomUUID()}` : `diag_${Date.now()}`,
    answers: state.answers,
    scores,
    maxScores,
    scoreRates,
    primaryAxis,
    secondaryAxis,
    rankedAxes,
    resultType,
    result,
    funnelId: state.funnelId || getCurrentFunnelId(),
    lineUserId: null,
    status: "waiting_for_line",
    savedToSupabase: false,
    createdAt: now.toISOString(),
    expiresAt: expiresAt.toISOString()
  };
}

async function saveDiagnosis(diagnosis) {
  const payload = {
    answers: diagnosis.answers,
    scores: diagnosis.scores,
    scoreRates: diagnosis.scoreRates,
    primaryAxis: diagnosis.primaryAxis,
    secondaryAxis: diagnosis.secondaryAxis,
    resultType: diagnosis.resultType,
    resultPayload: diagnosis.result,
    funnelId: diagnosis.funnelId,
    ...getAnalyticsContext({
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType
    }),
    status: "waiting_for_line",
    expiresAt: diagnosis.expiresAt
  };

  const remote = await callEdgeFunction("save-diagnosis", payload);
  if (!remote) return diagnosis;

  return {
    ...diagnosis,
    diagnosisId: remote.diagnosisId,
    createdAt: remote.createdAt || diagnosis.createdAt,
    expiresAt: remote.expiresAt || diagnosis.expiresAt,
    savedToSupabase: true,
    saveError: null
  };
}

function resetDiagnosis() {
  state.answers = [];
  state.currentIndex = 0;
  state.cardStartedAt = performance.now();
  state.isAnimating = false;
  state.currentDiagnosis = null;
  state.funnelId = null;
}

async function startDiagnosis() {
  if (masterLoadPromise) await masterLoadPromise;
  cards = getDiagnosisCards(settings);
  resetDiagnosis();
  const funnelId = startNewFunnel();
  logEvent("diagnosis_start", {
    cardCount: cards.length,
    totalQuestions: cards.length,
    currentOrder: 1,
    currentImageId: cards[0]?.id || null,
    lastAnsweredOrder: 0,
    lastAnsweredImageId: null,
    funnelId
  });
  showScreen("swipe");
  renderSwipeCard();
}

function cardTemplate(card, index, isNext = false) {
  const cardNumber = index + 1;
  // JS hooks: swipe-card, is-next, choice-yes, choice-no are used by gesture logic.
  // Rename them only together with selectors in renderSwipeCard(), bindCardGesture(), and chooseAnswer().
  return `
    <article class="swipe-card${isNext ? " is-next" : ""}" data-card-id="${escapeHtml(card.id)}">
      <div class="choice-badge choice-no">NO</div>
      <div class="choice-badge choice-yes">YES</div>
      <div class="card-photo" style="background-image: url('${escapeHtml(card.image)}')"></div>
      <div class="card-shade"></div>
      <div class="card-content">
        <div class="card-meta">${String(cardNumber).padStart(2, "0")} / ${cards.length}</div>
        <h2>${escapeHtml(card.question)}</h2>
      </div>
    </article>
  `;
}

function renderSwipeCard() {
  const progress = state.currentIndex / cards.length;
  $("#progressFill").style.transform = `scaleX(${progress})`;
  $("#progressText").textContent = `${state.currentIndex + 1} / ${cards.length}`;
  const progressHint = $("#progressHint");
  if (progressHint) {
    const answeredRate = state.currentIndex / cards.length;
    progressHint.textContent =
      answeredRate >= 0.75
        ? "ラストスパート！"
        : answeredRate >= 0.45
          ? "半分まであと少し！"
          : answeredRate >= 0.2
            ? "いいペースです"
            : "直感で選ぶだけ";
  }

  const current = cards[state.currentIndex];
  const next = cards[state.currentIndex + 1];
  const stack = $("#cardStack");
  stack.innerHTML = [next ? cardTemplate(next, state.currentIndex + 1, true) : "", cardTemplate(current, state.currentIndex)]
    .join("");

  state.cardStartedAt = performance.now();
  bindCardGesture($(".swipe-card:not(.is-next)"));
  preloadCardImage(next);
}

function preloadCardImage(card) {
  if (!card) return;
  const img = new Image();
  img.src = card.image;
}

function bindCardGesture(card) {
  if (!card) return;

  let startX = 0;
  let startY = 0;
  let currentX = 0;
  let currentY = 0;
  let dragging = false;
  let activePointerId = null;

  const moveCard = () => {
    const rotate = currentX / 18;
    const yesOpacity = Math.min(1, Math.max(0, currentX / 120));
    const noOpacity = Math.min(1, Math.max(0, -currentX / 120));
    card.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) rotate(${rotate}deg)`;
    card.querySelector(".choice-yes").style.opacity = yesOpacity;
    card.querySelector(".choice-no").style.opacity = noOpacity;
  };

  const resetCardPosition = () => {
    card.style.transform = "";
    card.querySelector(".choice-yes").style.opacity = "";
    card.querySelector(".choice-no").style.opacity = "";
  };

  const cleanupPointerListeners = () => {
    window.removeEventListener("pointermove", handlePointerMove);
    window.removeEventListener("pointerup", endDrag);
    window.removeEventListener("pointercancel", cancelDrag);
    window.removeEventListener("blur", cancelDrag);
  };

  const releasePointer = () => {
    if (activePointerId === null) return;
    try {
      if (card.hasPointerCapture?.(activePointerId)) {
        card.releasePointerCapture(activePointerId);
      }
    } catch {
      // Pointer capture may already be released by the browser.
    }
    activePointerId = null;
  };

  const handlePointerMove = (event) => {
    if (!dragging || state.isAnimating || event.pointerId !== activePointerId) return;
    event.preventDefault();
    currentX = event.clientX - startX;
    currentY = event.clientY - startY;
    moveCard();
  };

  const endDrag = (event) => {
    if (!dragging || event.pointerId !== activePointerId) return;
    dragging = false;
    card.classList.remove("is-dragging");
    cleanupPointerListeners();
    releasePointer();

    if (state.isAnimating) return;

    if (Math.abs(currentX) > 92) {
      chooseAnswer(currentX > 0 ? "yes" : "no", Math.sign(currentX), currentX, currentY);
      return;
    }

    resetCardPosition();
  };

  const cancelDrag = () => {
    if (!dragging) return;
    dragging = false;
    card.classList.remove("is-dragging");
    cleanupPointerListeners();
    releasePointer();
    if (!state.isAnimating) resetCardPosition();
  };

  card.addEventListener("pointerdown", (event) => {
    if (state.isAnimating || event.button > 0) return;
    event.preventDefault();
    dragging = true;
    activePointerId = event.pointerId;
    startX = event.clientX;
    startY = event.clientY;
    currentX = 0;
    currentY = 0;
    card.classList.add("is-dragging");
    try {
      card.setPointerCapture(event.pointerId);
    } catch {
      // Window-level listeners below still keep desktop dragging reliable.
    }
    window.addEventListener("pointermove", handlePointerMove, { passive: false });
    window.addEventListener("pointerup", endDrag);
    window.addEventListener("pointercancel", cancelDrag);
    window.addEventListener("blur", cancelDrag);
  });
}

function chooseAnswer(answer, direction = answer === "yes" ? 1 : -1, startX = 0, startY = 0) {
  if (state.isAnimating || state.currentIndex >= cards.length) return;
  state.isAnimating = true;

  const card = $(".swipe-card:not(.is-next)");
  const currentCard = cards[state.currentIndex];
  const answerOrder = state.currentIndex + 1;
  const nextCard = cards[state.currentIndex + 1];
  const responseTime = performance.now() - state.cardStartedAt;

  state.answers.push({
    imageId: currentCard.id,
    answer,
    answerOrder,
    responseTime: Math.round(responseTime)
  });

  if (answerOrder < cards.length) {
    logDiagnosisProgress({
      currentOrder: answerOrder + 1,
      currentImageId: nextCard?.id || null,
      lastAnsweredOrder: answerOrder,
      lastAnsweredImageId: currentCard.id
    });
  }

  if (card) {
    const targetX = direction * Math.max(window.innerWidth * 1.15, 520);
    const targetY = startY * 0.7 - 24;
    card.querySelector(".choice-yes").style.opacity = answer === "yes" ? 1 : 0;
    card.querySelector(".choice-no").style.opacity = answer === "no" ? 1 : 0;
    card.classList.add(answer === "yes" ? "fly-yes" : "fly-no");
    card.style.transform = `translate3d(${targetX}px, ${targetY}px, 0) rotate(${direction * 24}deg)`;
  }

  setTimeout(() => {
    state.currentIndex += 1;
    $("#progressFill").style.transform = `scaleX(${state.currentIndex / cards.length})`;

    if (state.currentIndex >= cards.length) {
      completeDiagnosis();
      return;
    }

    state.isAnimating = false;
    renderSwipeCard();
  }, 230);
}

async function completeDiagnosis() {
  const diagnosis = buildDiagnosis();
  const lastAnswer = diagnosis.answers[diagnosis.answers.length - 1] || null;
  state.currentDiagnosis = diagnosis;
  saveDraft(diagnosis);
  logEvent("diagnosis_complete", {
    answeredCount: diagnosis.answers.length,
    totalQuestions: cards.length,
    currentOrder: cards.length,
    currentImageId: cards[cards.length - 1]?.id || null,
    lastAnsweredOrder: diagnosis.answers.length,
    lastAnsweredImageId: lastAnswer?.imageId || null,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    totalTime: diagnosis.answers.reduce((sum, answer) => sum + answer.responseTime, 0)
  });

  renderAnalysisChecklist();
  showScreen("analysis");
  const analysisProgressPromise = runAnalysisProgress();

  try {
    state.currentDiagnosis = await saveDiagnosis(diagnosis);
    saveDraft(state.currentDiagnosis);
  } catch (error) {
    console.warn(error);
    state.currentDiagnosis = {
      ...diagnosis,
      savedToSupabase: false,
      saveError: error.message || "Supabase保存に失敗しました"
    };
    saveDraft(state.currentDiagnosis);
  }

  await analysisProgressPromise;
  showAnalysisResultButton();
}

function renderAnalysisChecklist() {
  $("#compareCount").textContent = formatNumber(getCurrentComparisonCount(settings));
  updateAnalysisProgress(0, "選択傾向を読み込み中");
  const resultButton = $("#analysisResultButton");
  if (resultButton) {
    resultButton.hidden = true;
    resultButton.disabled = true;
  }
  $$(".analysis-check li").forEach((item, index) => {
    item.style.animationDelay = `${index * 280 + 220}ms`;
  });
}

function showAnalysisResultButton() {
  updateAnalysisProgress(100, "診断結果の準備完了");
  const resultButton = $("#analysisResultButton");
  if (!resultButton) return;
  resultButton.hidden = false;
  resultButton.disabled = false;
  resultButton.focus({ preventScroll: true });
}

function proceedFromAnalysisToResult() {
  const resultButton = $("#analysisResultButton");
  if (resultButton) resultButton.disabled = true;
  renderResult();
}

function updateAnalysisProgress(percent, label) {
  const safePercent = Math.max(0, Math.min(100, Math.round(percent)));
  const fill = $("#analysisProgressFill");
  const percentText = $("#analysisProgressPercent");
  const labelText = $("#analysisProgressLabel");

  if (fill) fill.style.transform = `scaleX(${safePercent / 100})`;
  if (percentText) percentText.textContent = `${safePercent}%`;
  if (labelText && label) labelText.textContent = label;
}

async function runAnalysisProgress() {
  updateAnalysisProgress(0, "選択傾向を読み込み中");
  await animateNumber({
    duration: 720,
    from: 0,
    to: 42,
    onUpdate: (value) => updateAnalysisProgress(value, "選択傾向を分析中")
  });
  await animateNumber({
    duration: 780,
    from: 42,
    to: 76,
    onUpdate: (value) => updateAnalysisProgress(value, "思考パターンを照合中")
  });
  await animateNumber({
    duration: 650,
    from: 76,
    to: 98,
    onUpdate: (value) => updateAnalysisProgress(value, "類似タイプを比較中")
  });
  updateAnalysisProgress(98, "診断結果を作成中");
  await delay(3000); //98%で待たせる時間
  await animateNumber({
    duration: 260,
    from: 98,
    to: 100,
    onUpdate: (value) => updateAnalysisProgress(value, "診断結果の準備完了")
  });
  await delay(160);
}

function renderAxisBars(diagnosis) {
  return diagnosis.rankedAxes
    .map((axis) => {
      const rate = diagnosis.scoreRates[axis];
      const axisMeta = AXES[axis];
      return `
        <div class="axis-row">
          <div class="axis-label">
            <span>${axisMeta.label}</span>
            <strong>${rate}%</strong>
          </div>
          <div class="axis-track"><span style="width: ${rate}%; background: ${axisMeta.color}"></span></div>
        </div>
      `;
    })
    .join("");
}

function renderResult() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) {
    showScreen("lp");
    return;
  }

  state.currentDiagnosis = diagnosis;

  const result = results[diagnosis.resultType] || diagnosis.result;
  const primary = AXES[diagnosis.primaryAxis] || AXES.people;
  const secondary = AXES[diagnosis.secondaryAxis] || AXES.challenge;

  $("#resultCard").style.setProperty("--accent-a", primary.color);
  $("#resultCard").style.setProperty("--accent-b", secondary.color);
  $("#resultType").textContent = result.name;
  $("#resultCopy").textContent = result.catchCopy;
  $("#resultDescription").textContent = result.description;
  $("#sameTypePercent").textContent = `${result.percent || 8}%`;
  $("#strengthList").innerHTML = result.strengths
    .slice(0, 5)
    .map((strength) => `<li>${escapeHtml(strength)}</li>`)
    .join("");
  $("#jobList").innerHTML = result.jobs
    .slice(0, 5)
    .map((job, index) => {
      const rating = Math.max(4, 5 - Math.floor(index / 2));
      return `
        <li>
          <span>${escapeHtml(job)}</span>
          <strong aria-label="${rating}つ星">${"★".repeat(rating)}${"☆".repeat(5 - rating)}</strong>
        </li>
      `;
    })
    .join("");
  $("#industryList").innerHTML = (result.industries || [])
    .slice(0, 5)
    .map((industry) => `<li>${escapeHtml(industry)}</li>`)
    .join("");
  $("#axisBars").innerHTML = renderAxisBars(diagnosis);
  if (diagnosis.savedToSupabase) {
    $("#saveNotice").textContent = `Supabaseへ保存済み: ${diagnosis.diagnosisId}`;
  } else if (diagnosis.saveError) {
    $("#saveNotice").textContent = `Supabase保存失敗: ${diagnosis.saveError}`;
  } else {
    $("#saveNotice").textContent = "ローカル保存中";
  }
  renderResultOffer(diagnosis);

  showScreen("result");
  if (!state.loggedResultViews.has(diagnosis.funnelId)) {
    state.loggedResultViews.add(diagnosis.funnelId);
    logEvent("result_view", {
      diagnosisId: diagnosis.diagnosisId,
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType
    });
  }
}

function renderResultOffer(diagnosis) {
  const hasLineConnection = Boolean(loadLineConnection());
  const lineCtaLabel = hasLineConnection ? "LINEで結果を受け取る" : "LINEで結果と求人を見る";

  $("#jobCount").textContent = formatNumber(settings.jobCount);
  $("#highMatchCount").textContent = formatNumber(settings.highMatchCount);
  $("#jobLeadTitle").textContent = "あなたに合う求人が見つかりました";
  $("#jobLeadCopy").textContent = hasLineConnection
    ? "LINE連携済みです。タップすると新しい診断結果をLINEに送信します。"
    : "特性分析から高マッチ度の候補を厳選";
  const lineCtaText = $("#lineCtaText");
  if (lineCtaText) {
    lineCtaText.textContent = lineCtaLabel;
  } else {
    $("#lineCta").textContent = lineCtaLabel;
  }

  const funnelId = diagnosis?.funnelId || getCurrentFunnelId();
  if (funnelId && !state.loggedJobsViews.has(funnelId)) {
    state.loggedJobsViews.add(funnelId);
    logEvent("jobs_view", {
      diagnosisId: diagnosis?.diagnosisId || null,
      funnelId,
      resultType: diagnosis?.resultType || null,
      hasLineConnection
    });
  }
}

async function sendLineResultWithSavedConnection(diagnosis) {
  const connection = loadLineConnection();
  if (!connection || !diagnosis?.savedToSupabase || !getFunctionsBaseUrl()) return false;

  const remote = await callEdgeFunction("send-line-result", {
    diagnosisId: diagnosis.diagnosisId,
    lineConnectionId: connection.lineConnectionId || null,
    linkedDiagnosisId: connection.diagnosisId || null,
    ...getAnalyticsContext({
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType
    })
  });

  if (remote?.status !== "sent") return false;

  saveLineConnection({
    ...connection,
    lineConnectionId: remote.lineConnectionId || connection.lineConnectionId || null,
    diagnosisId: diagnosis.diagnosisId,
    lastSentDiagnosisId: diagnosis.diagnosisId
  });

  state.currentDiagnosis = {
    ...diagnosis,
    status: "sent",
    lineSentBySavedConnection: true
  };
  saveDraft(state.currentDiagnosis);
  return true;
}

async function requestLineLoginUrl() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return null;

  const appCompleteUrl = `${window.location.origin}/line-complete.html`;

  const remote = await callEdgeFunction("line-login-url", {
    diagnosisId: diagnosis.diagnosisId,
    appCompleteUrl,
    ...getAnalyticsContext({
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType
    })
  });

  if (remote?.authorizationUrl) return remote.authorizationUrl;

  if (!config.lineLoginChannelId || !config.lineRedirectUri) return null;

  const params = new URLSearchParams({
    response_type: "code",
    client_id: config.lineLoginChannelId,
    redirect_uri: config.lineRedirectUri,
    state: diagnosis.diagnosisId,
    scope: "profile openid",
    nonce: crypto.randomUUID ? crypto.randomUUID() : String(Date.now())
  });

  return `https://access.line.me/oauth2/v2.1/authorize?${params.toString()}`;
}

async function handleLineClick() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return;

  state.currentDiagnosis = diagnosis;
  logEvent("line_button_click", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId
  });

  try {
    if (await sendLineResultWithSavedConnection(diagnosis)) {
      renderResult();
      return;
    }
  } catch (error) {
    console.warn(error);
  }

  try {
    const authorizationUrl = await requestLineLoginUrl();
    if (authorizationUrl) {
      window.location.href = authorizationUrl;
      return;
    }
  } catch (error) {
    console.warn(error);
    if (getFunctionsBaseUrl()) {
      $("#jobLeadCopy").textContent =
        "LINE連携の設定を確認してください。認証URLを作成できませんでした。";
      return;
    }
  }

  if (getFunctionsBaseUrl()) {
    $("#jobLeadCopy").textContent =
      "LINE連携の設定を確認してください。認証URLを作成できませんでした。";
    return;
  }

  logEvent("line_login_success", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    demo: true
  });
  logEvent("result_sent", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    demo: true
  });
  state.currentDiagnosis = { ...diagnosis, status: "sent" };
  saveDraft(state.currentDiagnosis);
  renderResult();
}

function shareToX() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return;
  const result = results[diagnosis.resultType] || diagnosis.result;
  logEvent("share_click", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    channel: "x"
  });
  const text = `私のAIキャリア診断は「${result.name}」でした。${result.catchCopy}`;
  const url = new URL("https://twitter.com/intent/tweet");
  url.searchParams.set("text", text);
  url.searchParams.set("url", window.location.origin + window.location.pathname);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function shareToLine() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (diagnosis) {
    logEvent("share_click", {
      diagnosisId: diagnosis.diagnosisId,
      resultType: diagnosis.resultType,
      funnelId: diagnosis.funnelId,
      channel: "line"
    });
  }
  const url = new URL("https://social-plugins.line.me/lineit/share");
  url.searchParams.set("url", window.location.origin + window.location.pathname);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function bindEvents() {
  $("#startFromHero").addEventListener("click", startDiagnosis);
  $("#swipeYes").addEventListener("click", () => chooseAnswer("yes", 1));
  $("#swipeNo").addEventListener("click", () => chooseAnswer("no", -1));
  $("#analysisResultButton").addEventListener("click", proceedFromAnalysisToResult);
  $("#lineCta").addEventListener("click", handleLineClick);
  $("#retryResult").addEventListener("click", () => {
    const diagnosis = state.currentDiagnosis || loadDraft();
    logEvent("retry_click", {
      diagnosisId: diagnosis?.diagnosisId || null,
      resultType: diagnosis?.resultType || null,
      funnelId: diagnosis?.funnelId || getCurrentFunnelId(),
      from: "result"
    });
    startDiagnosis();
  });
  $("#shareX").addEventListener("click", shareToX);
  $("#shareLine").addEventListener("click", shareToLine);

  window.addEventListener("keydown", (event) => {
    if (document.body.dataset.view !== "swipe") return;
    if (event.key === "ArrowRight") chooseAnswer("yes", 1);
    if (event.key === "ArrowLeft") chooseAnswer("no", -1);
  });
}

function initHeroImage() {
  const firstImage = cards[0]?.image || DEFAULT_CARDS[0].image;
  document.documentElement.style.setProperty("--hero-image", `url("${firstImage}")`);
}

function init() {
  initHeroImage();
  bindEvents();
  renderLandingMetrics();
  startComparisonTicker();
  masterLoadPromise = loadRemoteMaster().then(() => {
    initHeroImage();
    renderLandingMetrics();
  });
  if (window.location.hash === "#result" && loadDraft()) {
    state.currentDiagnosis = loadDraft();
    renderResult();
    logEvent("lp_view", { returningFromLine: true });
    return;
  }
  showScreen("lp");
  logEvent("lp_view", {
    comparisonCount: settings.comparisonCount,
    cardCount: cards.length
  });
}

init();
