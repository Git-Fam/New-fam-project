import {
  AXES,
  AXIS_ORDER,
  DEFAULT_CARDS,
  DEFAULT_SETTINGS,
  STORAGE_KEYS,
  buildSettingsFromMaster,
  getConfiguredResults,
  getCurrentComparisonCount,
  getDiagnosisQuestionError,
  getDiagnosisCards,
  getResultKey,
  loadAdminSettings,
} from "./data.js?v=20260821-specialq-flow";

const config = window.CAREER_APP_CONFIG || {};

function getLocalRuntimeSettings() {
  const localSettings = loadAdminSettings();
  return {
    ...DEFAULT_SETTINGS,
    ...localSettings,
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
  "retry_click",
]);

const state = {
  answers: [],
  specialAnswers: [],
  currentIndex: 0,
  cardStartedAt: 0,
  isAnimating: false,
  currentDiagnosis: null,
  funnelId: null,
  loggedResultViews: new Set(),
  loggedJobsViews: new Set(),
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
  const id = crypto.randomUUID
    ? crypto.randomUUID()
    : `${Date.now()}-${Math.random().toString(16).slice(2)}`;
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
    utmCampaign: params.get("utm_campaign") || "",
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
    resultType:
      payload.resultType || state.currentDiagnosis?.resultType || null,
    utmSource: utm.utmSource || null,
    utmMedium: utm.utmMedium || null,
    utmCampaign: utm.utmCampaign || null,
    deviceType: getDeviceType(),
    pagePath: `${window.location.pathname}${window.location.hash || ""}`,
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
    return JSON.parse(
      localStorage.getItem(STORAGE_KEYS.diagnosisDraft) || "null",
    );
  } catch {
    return null;
  }
}

function saveLineConnection(connection) {
  localStorage.setItem(
    STORAGE_KEYS.lineConnection,
    JSON.stringify({
      ...connection,
      savedAt: new Date().toISOString(),
    }),
  );
}

function loadLineConnection() {
  try {
    const connection = JSON.parse(
      localStorage.getItem(STORAGE_KEYS.lineConnection) || "null",
    );
    if (connection?.lineConnectionId || connection?.diagnosisId)
      return connection;
  } catch {
    // Fall through to the legacy draft fallback below.
  }

  const draft = loadDraft();
  if (draft?.diagnosisId && ["linked", "sent"].includes(String(draft.status))) {
    return {
      diagnosisId: draft.diagnosisId,
      lineConnectionId: null,
      lastSentDiagnosisId: draft.diagnosisId,
    };
  }

  return null;
}

function pushLocalEvent(eventName, payload = {}) {
  const context = getAnalyticsContext(payload);
  const events = JSON.parse(
    localStorage.getItem(STORAGE_KEYS.eventLog) || "[]",
  );
  events.push({
    eventName,
    payload,
    ...context,
    diagnosisId:
      state.currentDiagnosis?.diagnosisId || payload.diagnosisId || null,
    createdAt: new Date().toISOString(),
  });
  localStorage.setItem(
    STORAGE_KEYS.eventLog,
    JSON.stringify(events.slice(-120)),
  );
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
    body: JSON.stringify(body),
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
  if (startButton)
    startButton.textContent = `診断スタート（約${durationMinutes}分）`;
  const compareEl = $("#lpCompareCount");
  const compareTarget = getCurrentComparisonCount(settings);
  if (compareEl) {
    if (!compareEl.dataset.counted) {
      compareEl.dataset.counted = "1";
      animateNumber({
        duration: 1200,
        from: 0,
        to: compareTarget,
        onUpdate: (v) => {
          compareEl.textContent = formatNumber(v);
        },
      });
    } else {
      compareEl.textContent = formatNumber(compareTarget);
    }
  }
  $("#lpJobCount").textContent = formatNumber(settings.jobCount);
}

function renderComparisonMetrics() {
  const currentComparisonCount = formatNumber(
    getCurrentComparisonCount(settings),
  );
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
  const rawDiagnosisId =
    state.currentDiagnosis?.diagnosisId || payload.diagnosisId || null;
  const diagnosisId =
    rawDiagnosisId && String(rawDiagnosisId).startsWith("diag_")
      ? null
      : rawDiagnosisId;
  const context = getAnalyticsContext(payload);
  pushLocalEvent(eventName, payload);
  trackGoogleAnalyticsEvent(eventName);
  callEdgeFunction("event-log", {
    eventName,
    diagnosisId,
    ...context,
    payload,
  }).catch(() => {});
}

function trackGoogleAnalyticsEvent(eventName) {
  if (
    !GOOGLE_ANALYTICS_EVENTS.has(eventName) ||
    typeof window.gtag !== "function"
  )
    return;

  window.gtag("event", eventName, {
    event_category: "career_diagnosis",
    transport_type: "beacon",
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
      ...payload,
    },
  }).catch(() => {});
}

function isSpecialCard(card) {
  return card?.kind === "special";
}

function getQuestionTrackingId(card) {
  if (!card) return null;
  return isSpecialCard(card) ? card.questionKey || card.key || card.id : card.id;
}

function getAllDiagnosisAnswers(diagnosis) {
  return [
    ...(diagnosis?.answers || []),
    ...(diagnosis?.specialAnswers || []),
  ].sort((a, b) => Number(a.answerOrder || 0) - Number(b.answerOrder || 0));
}

function calculateScores(cardList, answerList) {
  const totalScores = Object.fromEntries(AXIS_ORDER.map((axis) => [axis, 0]));

  answerList.forEach((answerData) => {
    const card = cardList.find((item) => item.id === answerData.imageId);
    if (!card || isSpecialCard(card)) return;

    const scores =
      answerData.answer === "yes" ? card.yesScores || {} : card.noScores || {};
    Object.entries(scores).forEach(([key, value]) => {
      totalScores[key] += value;
    });
  });

  return totalScores;
}

function calculateMaxScores(cardList) {
  const maxScores = Object.fromEntries(AXIS_ORDER.map((axis) => [axis, 0]));

  cardList.forEach((card) => {
    if (isSpecialCard(card)) return;
    AXIS_ORDER.forEach((axis) => {
      maxScores[axis] += Math.max(
        card.yesScores?.[axis] || 0,
        card.noScores?.[axis] || 0,
      );
    });
  });

  return maxScores;
}

function calculateScoreRates(scores, maxScores) {
  return Object.fromEntries(
    AXIS_ORDER.map((axis) => {
      const max = maxScores[axis] || 1;
      return [axis, Math.round((scores[axis] / max) * 100)];
    }),
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
    diagnosisId: crypto.randomUUID
      ? `diag_${crypto.randomUUID()}`
      : `diag_${Date.now()}`,
    answers: [...state.answers],
    specialAnswers: [...state.specialAnswers],
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
    expiresAt: expiresAt.toISOString(),
  };
}

async function saveDiagnosis(diagnosis) {
  const payload = {
    answers: diagnosis.answers,
    specialAnswers: diagnosis.specialAnswers || [],
    scores: diagnosis.scores,
    scoreRates: diagnosis.scoreRates,
    primaryAxis: diagnosis.primaryAxis,
    secondaryAxis: diagnosis.secondaryAxis,
    resultType: diagnosis.resultType,
    resultPayload: diagnosis.result,
    funnelId: diagnosis.funnelId,
    ...getAnalyticsContext({
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType,
    }),
    status: "waiting_for_line",
    expiresAt: diagnosis.expiresAt,
  };

  const remote = await callEdgeFunction("save-diagnosis", payload);
  if (!remote) return diagnosis;

  return {
    ...diagnosis,
    diagnosisId: remote.diagnosisId,
    createdAt: remote.createdAt || diagnosis.createdAt,
    expiresAt: remote.expiresAt || diagnosis.expiresAt,
    savedToSupabase: true,
    saveError: null,
  };
}

function resetDiagnosis() {
  state.answers = [];
  state.specialAnswers = [];
  state.currentIndex = 0;
  state.cardStartedAt = performance.now();
  state.isAnimating = false;
  state.currentDiagnosis = null;
  state.funnelId = null;
}

async function startDiagnosis() {
  if (masterLoadPromise) await masterLoadPromise;
  const questionPlanError = getDiagnosisQuestionError(settings);
  if (questionPlanError) {
    window.alert(questionPlanError);
    showScreen("lp");
    return;
  }
  cards = getDiagnosisCards(settings);
  resetDiagnosis();
  const funnelId = startNewFunnel();
  logEvent("diagnosis_start", {
    cardCount: cards.length,
    totalQuestions: cards.length,
    currentOrder: 1,
    currentImageId: getQuestionTrackingId(cards[0]),
    currentQuestionKind: cards[0]?.kind || "normal",
    lastAnsweredOrder: 0,
    lastAnsweredImageId: null,
    funnelId,
  });
  showScreen("swipe");
  renderSwipeCard();
}

function cardTemplate(card, index, isNext = false) {
  const cardNumber = index + 1;
  // JS hooks: swipe-card, is-next, choice-yes, choice-no are used by gesture logic.
  // Rename them only together with selectors in renderSwipeCard(), bindCardGesture(), and chooseAnswer().
  if (isSpecialCard(card)) {
    const backgroundStyle = card.backgroundImageUrl
      ? ` style="--special-question-bg: url('${escapeHtml(card.backgroundImageUrl)}')"`
      : "";

    return `
      <article class="swipe-card special-question-card${isNext ? " is-next" : ""}" data-card-id="${escapeHtml(card.id)}" data-card-kind="special"${backgroundStyle}>
        <div class="choice-badge choice-no">A</div>
        <div class="choice-badge choice-yes">B</div>
        <div class="special-question-card__media" aria-hidden="true"></div>
        <div class="special-question-card__surface">
          <div class="special-question-card__topline">
            <span>SPECIAL QUESTION</span>
            <b># ${cardNumber}</b>
          </div>
          <h2>${escapeHtml(card.questionText || card.question)}</h2>
          <div class="special-question-card__choices" aria-label="選択肢">
            <div class="special-question-card__choice special-question-card__choice--a">
              <span>A</span>
              <strong>${escapeHtml(card.optionALabel)}</strong>
            </div>
            <div class="special-question-card__choice special-question-card__choice--b">
              <span>B</span>
              <strong>${escapeHtml(card.optionBLabel)}</strong>
            </div>
          </div>
        </div>
      </article>
    `;
  }

  return `
    <article class="swipe-card${isNext ? " is-next" : ""}" data-card-id="${escapeHtml(card.id)}" data-card-kind="normal">
      <div class="choice-badge choice-no">NO</div>
      <div class="choice-badge choice-yes">YES</div>
      <div class="card-photo" style="background-image: url('${escapeHtml(card.image)}')"></div>
      <div class="card-shade"></div>
      <div class="card-content">
        <div class="card-meta"># ${cardNumber}</div>
        <h2>${escapeHtml(card.question)}</h2>
      </div>
    </article>
  `;
}

function updateSwipeProgressUI() {
  const progress = state.currentIndex / cards.length;
  $("#progressFill").style.transform = `scaleX(${progress})`;
  $("#progressText").textContent =
    `${state.currentIndex + 1} / ${cards.length}`;
  const progressHint = $("#progressHint");
  if (progressHint) {
    const answeredRate = state.currentIndex / cards.length;
    progressHint.textContent =
      answeredRate >= 0.75
        ? "ラストスパート！"
        : answeredRate >= 0.51
          ? "折り返し地点！"
          : answeredRate >= 0.45
            ? "半分まであと少し！"
            : answeredRate >= 0.2
              ? "いいペースです"
      : "直感で選ぶだけ";
  }
}

function updateSwipeActionButtons(card = cards[state.currentIndex]) {
  const noButton = $("#swipeNo");
  const yesButton = $("#swipeYes");
  if (!noButton || !yesButton) return;

  if (isSpecialCard(card)) {
    noButton.setAttribute("aria-label", "Aを選ぶ");
    yesButton.setAttribute("aria-label", "Bを選ぶ");
    noButton.innerHTML = "<span>A</span>";
    yesButton.innerHTML = "<span>B</span>";
    return;
  }

  noButton.setAttribute("aria-label", "違う");
  yesButton.setAttribute("aria-label", "好き");
  noButton.innerHTML = '<img src="./assets/figma/pc-x.svg" alt="" />';
  yesButton.innerHTML = '<img src="./assets/figma/pc-heart.svg" alt="" />';
}

function renderSwipeCard() {
  updateSwipeProgressUI();
  updateSwipeActionButtons();

  const current = cards[state.currentIndex];
  const next = cards[state.currentIndex + 1];
  const stack = $("#cardStack");
  stack.innerHTML = [
    next ? cardTemplate(next, state.currentIndex + 1, true) : "",
    cardTemplate(current, state.currentIndex),
  ].join("");

  state.cardStartedAt = performance.now();
  bindCardGesture($(".swipe-card:not(.is-next)"));
  preloadCardImage(next);
}

// 回答後、後ろにスタンバイしていた次のカードをそのまま前面に昇格させる。
// stack.innerHTML を作り直さないことで、is-next → 通常状態への
// CSSトランジション（縮小・奥まった位置 → 等倍・手前）がそのまま効く。
function promoteNextCard() {
  const stack = $("#cardStack");

  // 飛んでいった直前のカード（既に画面外 or 消えかけ）を除去
  const spentCard = stack.querySelector(".swipe-card:not(.is-next)");
  if (spentCard) spentCard.remove();

  updateSwipeProgressUI();

  const promoted = stack.querySelector(".swipe-card.is-next");
  const upcoming = cards[state.currentIndex + 1];
  updateSwipeActionButtons(cards[state.currentIndex]);

  if (promoted) {
    // is-next を外した瞬間、CSSのtransitionで
    // 「奥で待機 → 手前にせり出す」動きになる
    promoted.classList.remove("is-next");
  } else {
    // 保険：is-nextが無ければ通常描画にフォールバック
    renderSwipeCard();
    return;
  }

  if (upcoming) {
    stack.insertAdjacentHTML(
      "afterbegin",
      cardTemplate(upcoming, state.currentIndex + 1, true),
    );
  }

  state.cardStartedAt = performance.now();
  bindCardGesture(promoted);
  preloadCardImage(upcoming);
}

function preloadCardImage(card) {
  if (!card) return;
  const source = card.image || card.backgroundImageUrl;
  if (!source) return;
  const img = new Image();
  img.src = source;
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

    // ▼ 追加：ある程度動かしたら色をかぶせる
    card.classList.toggle("tint-yes", currentX > 40);
    card.classList.toggle("tint-no", currentX < -40);
  };

  const resetCardPosition = () => {
    card.style.transform = "";
    card.querySelector(".choice-yes").style.opacity = "";
    card.querySelector(".choice-no").style.opacity = "";
    card.classList.remove("tint-yes", "tint-no");
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
    if (!dragging || state.isAnimating || event.pointerId !== activePointerId)
      return;
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
      chooseAnswer(
        currentX > 0 ? "yes" : "no",
        Math.sign(currentX),
        currentX,
        currentY,
      );
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
    window.addEventListener("pointermove", handlePointerMove, {
      passive: false,
    });
    window.addEventListener("pointerup", endDrag);
    window.addEventListener("pointercancel", cancelDrag);
    window.addEventListener("blur", cancelDrag);
  });
}

function chooseAnswer(
  answer,
  direction = answer === "yes" ? 1 : -1,
  startX = 0,
  startY = 0,
  fromButton = false,
) {
  if (state.isAnimating || state.currentIndex >= cards.length) return;
  state.isAnimating = true;

  const card = $(".swipe-card:not(.is-next)");
  const currentCard = cards[state.currentIndex];
  const answerOrder = state.currentIndex + 1;
  const nextCard = cards[state.currentIndex + 1];
  const responseTime = performance.now() - state.cardStartedAt;
  const answeredQuestionId = getQuestionTrackingId(currentCard);
  const questionKind = currentCard?.kind || "normal";

  if (isSpecialCard(currentCard)) {
    const selectedOption = answer === "yes" ? "B" : "A";
    state.specialAnswers.push({
      questionId: currentCard.questionKey || currentCard.key || currentCard.id,
      questionKey: currentCard.questionKey || currentCard.key || currentCard.id,
      questionText: currentCard.questionText || currentCard.question,
      optionALabel: currentCard.optionALabel,
      optionBLabel: currentCard.optionBLabel,
      selectedOption,
      selectedLabel:
        selectedOption === "B"
          ? currentCard.optionBLabel
          : currentCard.optionALabel,
      answerOrder,
      responseTime: Math.round(responseTime),
      category: currentCard.category || null,
    });
  } else {
    state.answers.push({
      imageId: currentCard.id,
      answer,
      answerOrder,
      responseTime: Math.round(responseTime),
    });
  }

  if (answerOrder < cards.length) {
    logDiagnosisProgress({
      currentOrder: answerOrder + 1,
      currentImageId: getQuestionTrackingId(nextCard),
      currentQuestionKind: nextCard?.kind || "normal",
      lastAnsweredOrder: answerOrder,
      lastAnsweredImageId: answeredQuestionId,
      lastAnsweredKind: questionKind,
    });
  }

  if (card) {
    card.querySelector(".choice-yes").style.opacity = answer === "yes" ? 1 : 0;
    card.querySelector(".choice-no").style.opacity = answer === "no" ? 1 : 0;
    card.classList.add(answer === "yes" ? "tint-yes" : "tint-no");

    // 飛ぶ間だけ、枠のはみ出しを見せる
    const shell = card.closest(".experience-shell");
    if (shell) shell.classList.add("tossing");

    if (fromButton) {
      // ボタン：放物線でポイッと投げる
      card.classList.add(answer === "yes" ? "toss-yes" : "toss-no");
    } else {
      // スワイプ：指の位置からそのまま飛ばす（元の動き）
      const targetX = direction * Math.max(window.innerWidth * 1.15, 520);
      const targetY = startY * 0.7 - 24;
      card.style.transform = `translate3d(${targetX}px, ${targetY}px, 0) rotate(${direction * 24}deg)`;
    }
  }

  // ボタン押下時は toss アニメーション（0.7s）に合わせて待つが、
  // スワイプ時はカードが .swipe-card の transform transition（230ms）で
  // 素早く飛び去るだけなので、その分待機時間も短くして体感の遅れをなくす。
  const exitDuration = fromButton ? 700 : 260;

  setTimeout(() => {
    const shell = document.querySelector(".experience-shell.tossing");
    if (shell) shell.classList.remove("tossing");

    state.currentIndex += 1;

    if (state.currentIndex >= cards.length) {
      $("#progressFill").style.transform =
        `scaleX(${state.currentIndex / cards.length})`;
      completeDiagnosis();
      return;
    }

    state.isAnimating = false;
    promoteNextCard();
  }, exitDuration);
}

async function completeDiagnosis() {
  const diagnosis = buildDiagnosis();
  const allAnswers = getAllDiagnosisAnswers(diagnosis);
  const lastAnswer = allAnswers[allAnswers.length - 1] || null;
  state.currentDiagnosis = diagnosis;
  saveDraft(diagnosis);
  logEvent("diagnosis_complete", {
    answeredCount: allAnswers.length,
    normalAnsweredCount: diagnosis.answers.length,
    specialAnsweredCount: diagnosis.specialAnswers.length,
    totalQuestions: cards.length,
    currentOrder: cards.length,
    currentImageId: getQuestionTrackingId(cards[cards.length - 1]),
    currentQuestionKind: cards[cards.length - 1]?.kind || "normal",
    lastAnsweredOrder: allAnswers.length,
    lastAnsweredImageId: lastAnswer?.imageId || lastAnswer?.questionId || null,
    lastAnsweredKind: lastAnswer?.imageId ? "normal" : "special",
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    totalTime: allAnswers.reduce(
      (sum, answer) => sum + answer.responseTime,
      0,
    ),
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
      saveError: error.message || "Supabase保存に失敗しました",
    };
    saveDraft(state.currentDiagnosis);
  }

  await analysisProgressPromise;
  showAnalysisResultButton();
}

function renderAnalysisChecklist() {
  // $("#compareCount").textContent = formatNumber(
  //   getCurrentComparisonCount(settings),
  // );
  updateAnalysisProgress(0, "選択傾向を読み込み中");
  const resultButton = $("#analysisResultButton");
  if (resultButton) {
    resultButton.hidden = true;
    resultButton.disabled = true;
  }
  $$(".analysis-check li").forEach((item, index) => {
    item.style.animationDelay = `${index * 280 + 220}ms`;
  });

  // オーブを分析中の状態に戻す（再診断対応）
  const orb = document.querySelector(".analysis-orb");
  const orbImage = document.querySelector(".analysis-orb .orb-image");
  if (orb) orb.classList.remove("is-complete");
  if (orbImage) {
    orbImage.classList.remove("is-swapping-out");
    orbImage.src = "./assets/figma/orb.png";
  }

  startRotator();
}

function showAnalysisResultButton() {
  updateAnalysisProgress(100, "診断結果の準備完了");

  // 先にローテーションを止めてから文言を確定させる
  stopRotator();

  // 100%到達時の演出
  const title = document.querySelector("#analysisTitle");
  if (title) title.textContent = "あなたの選択を分析しました！";

  const rotator = document.querySelector("#analysisRotator");
  if (rotator) {
    rotator.style.opacity = "1";
    rotator.textContent = "Complete";
  }

  const label = document.querySelector("#analysisProgressLabel");
  if (label) label.textContent = "診断結果の準備完了";

  // オーブを完了状態に：縮んで消える→チェックオーブがポンと出る
  const orb = document.querySelector(".analysis-orb");
  const orbImage = document.querySelector(".analysis-orb .orb-image");
  if (orb && orbImage) {
    orbImage.classList.add("is-swapping-out");
    setTimeout(() => {
      orbImage.src = "./assets/figma/orbcheck.png";
      orbImage.classList.remove("is-swapping-out");
      orb.classList.add("is-complete"); // ここで pop-in と チェック登場
    }, 320); // orbSwapOut と同じ長さ
  }

  const resultButton = $("#analysisResultButton");
  if (!resultButton) return;
  resultButton.hidden = false; // まず存在させる
  resultButton.disabled = false;

  // 次のフレームでクラスを付けると transition が効く
  requestAnimationFrame(() => {
    const action = document.querySelector(".analysis-result-action");
    if (action) action.classList.add("is-visible");
  });

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
  if (percentText) percentText.innerHTML = `${safePercent}<small>%</small>`;
  if (labelText && label) labelText.textContent = label;
}

async function runAnalysisProgress() {
  updateAnalysisProgress(0, "選択傾向を読み込み中");
  await animateNumber({
    duration: 1100,
    from: 0,
    to: 42,
    onUpdate: (value) => updateAnalysisProgress(value, "選択傾向を分析中"),
  });
  await animateNumber({
    duration: 1300,
    from: 42,
    to: 76,
    onUpdate: (value) => updateAnalysisProgress(value, "思考パターンを照合中"),
  });
  await animateNumber({
    duration: 1200,
    from: 76,
    to: 98,
    onUpdate: (value) => updateAnalysisProgress(value, "類似タイプを比較中"),
  });
  updateAnalysisProgress(98, "診断結果を作成中");
  await delay(3000); //98%で待たせる時間
  await animateNumber({
    duration: 600,
    from: 98,
    to: 100,
    onUpdate: (value) => updateAnalysisProgress(value, "診断結果の準備完了"),
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

function setupScrollReveal() {
  // 対象：結果画面の主要セクション
  const targets = document.querySelectorAll(
    ".result-section, .result-share-panel, .jobs-hit-header, .match-job-list, .line-lead, .result-offer-card > .line-button, .result-offer-card > .line-note",
  );
  if (!targets.length) return;

  // 対応していない環境ではそのまま表示
  if (!("IntersectionObserver" in window)) {
    targets.forEach((el) => el.classList.add("is-revealed"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-revealed");
          observer.unobserve(entry.target); // 一度出たら監視解除
        }
      });
    },
    { threshold: 0.15, rootMargin: "0px 0px -40px 0px" },
  );

  targets.forEach((el) => {
    el.classList.add("reveal-on-scroll");
    observer.observe(el);
  });
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
  $("#sameTypePercent").textContent = `${result.percent || 8}`;
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
    $("#saveNotice").textContent =
      `Supabaseへ保存済み: ${diagnosis.diagnosisId}`;
  } else if (diagnosis.saveError) {
    $("#saveNotice").textContent = `Supabase保存失敗: ${diagnosis.saveError}`;
  } else {
    $("#saveNotice").textContent = "ローカル保存中";
  }
  renderResultOffer(diagnosis);

  showScreen("result");
  setupScrollReveal();
  if (!state.loggedResultViews.has(diagnosis.funnelId)) {
    state.loggedResultViews.add(diagnosis.funnelId);
    logEvent("result_view", {
      diagnosisId: diagnosis.diagnosisId,
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType,
    });
  }
}

function renderMatchJobCards() {
  const container = $("#matchJobList");
  if (!container) return;

  const roles = [
    "コンテンツプロデューサー",
    "クリエイティブディレクター",
    "SNSコンテンツプランナー",
    "ブランドデザイナー",
    "動画クリエイター",
    "UXデザイナー",
    "アートディレクター",
    "コピーライター",
    "PRプランナー",
    "映像ディレクター",
    "Webデザイナー",
    "企画プロデューサー",
  ];

  // ランダムに4件選ぶ
  const shuffled = [...roles].sort(() => Math.random() - 0.5).slice(0, 4);

  // マッチ度は90〜99%のランダム、降順に並べる
  const matches = shuffled
    .map(() => 90 + Math.floor(Math.random() * 10))
    .sort((a, b) => b - a);

  container.innerHTML = shuffled
    .map(
      (role, i) => `
      <div class="match-job-card" data-card-index="${i}">
        <p class="match-job-card-match">MATCH ${matches[i]}%</p>
        <p class="match-job-card-role">${escapeHtml(role)}</p>
      </div>`,
    )
    .join("");
}

function renderResultOffer(diagnosis) {
  const hasLineConnection = Boolean(loadLineConnection());
  const lineCtaLabel = hasLineConnection
    ? "LINEで結果を受け取る"
    : "友だち追加で今すぐ結果を見る";

  const jobLeadCopy = $("#jobLeadCopy");
  if (jobLeadCopy) {
    jobLeadCopy.textContent = "";
    jobLeadCopy.hidden = true;
  }

  $("#jobCount").textContent = formatNumber(settings.jobCount);
  const highMatch = $("#highMatchCount");
  if (highMatch) highMatch.textContent = formatNumber(settings.highMatchCount);

  // LINE誘導のタイプ名・件数
  const leadJobCount = $("#lineLeadJobCount");
  if (leadJobCount) leadJobCount.textContent = formatNumber(settings.jobCount);
  const leadType = $("#lineLeadType");
  if (leadType && diagnosis) {
    const leadResult = results[diagnosis.resultType] || diagnosis.result;
    if (leadResult && leadResult.name) leadType.textContent = leadResult.name;
  }

  // 求人カードを生成（求人名はぼかし表示なのでランダムな職種名でOK）
  renderMatchJobCards();

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
      hasLineConnection,
    });
  }
}

function showLineConnectionError(message) {
  const target = $("#jobLeadCopy") || $(".line-note");
  if (!target) return;
  target.textContent = message;
  target.hidden = false;
}

async function sendLineResultWithSavedConnection(diagnosis) {
  const connection = loadLineConnection();
  if (!connection || !diagnosis?.savedToSupabase || !getFunctionsBaseUrl())
    return false;

  const remote = await callEdgeFunction("send-line-result", {
    diagnosisId: diagnosis.diagnosisId,
    lineConnectionId: connection.lineConnectionId || null,
    linkedDiagnosisId: connection.diagnosisId || null,
    ...getAnalyticsContext({
      funnelId: diagnosis.funnelId,
      resultType: diagnosis.resultType,
    }),
  });

  if (remote?.status !== "sent") return false;

  saveLineConnection({
    ...connection,
    lineConnectionId:
      remote.lineConnectionId || connection.lineConnectionId || null,
    diagnosisId: diagnosis.diagnosisId,
    lastSentDiagnosisId: diagnosis.diagnosisId,
  });

  state.currentDiagnosis = {
    ...diagnosis,
    status: "sent",
    lineSentBySavedConnection: true,
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
      resultType: diagnosis.resultType,
    }),
  });

  if (remote?.authorizationUrl) return remote.authorizationUrl;

  if (!config.lineLoginChannelId || !config.lineRedirectUri) return null;

  const params = new URLSearchParams({
    response_type: "code",
    client_id: config.lineLoginChannelId,
    redirect_uri: config.lineRedirectUri,
    state: diagnosis.diagnosisId,
    scope: "profile openid",
    nonce: crypto.randomUUID ? crypto.randomUUID() : String(Date.now()),
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
    funnelId: diagnosis.funnelId,
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
      showLineConnectionError("LINE連携の設定を確認してください。認証URLを作成できませんでした。");
      return;
    }
  }

  if (getFunctionsBaseUrl()) {
    showLineConnectionError("LINE連携の設定を確認してください。認証URLを作成できませんでした。");
    return;
  }

  logEvent("line_login_success", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    demo: true,
  });
  logEvent("result_sent", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    demo: true,
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
    channel: "x",
  });
  const text = `私のAIキャリア診断は「${result.name}」でした。${result.catchCopy}`;
  const url = new URL("https://twitter.com/intent/tweet");
  url.searchParams.set("text", text);
  url.searchParams.set(
    "url",
    window.location.origin + window.location.pathname,
  );
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function shareToLine() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (diagnosis) {
    logEvent("share_click", {
      diagnosisId: diagnosis.diagnosisId,
      resultType: diagnosis.resultType,
      funnelId: diagnosis.funnelId,
      channel: "line",
    });
  }
  const url = new URL("https://social-plugins.line.me/lineit/share");
  url.searchParams.set(
    "url",
    window.location.origin + window.location.pathname,
  );
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function copyResultLink(message = "リンクをコピーしました。") {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (diagnosis) {
    logEvent("share_click", {
      diagnosisId: diagnosis.diagnosisId,
      resultType: diagnosis.resultType,
      funnelId: diagnosis.funnelId,
      channel: "copy",
    });
  }
  const link = window.location.origin + window.location.pathname;
  const done = () => window.alert(message);
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(link).then(done, done);
  } else {
    // 古い環境向けフォールバック
    const ta = document.createElement("textarea");
    ta.value = link;
    document.body.appendChild(ta);
    ta.select();
    try {
      document.execCommand("copy");
    } catch (e) {}
    document.body.removeChild(ta);
    done();
  }
}

function bindEvents() {
  $("#startFromHero").addEventListener("click", startDiagnosis);
  $("#swipeYes").addEventListener("click", (e) => {
    pressButton(e.currentTarget);
    // "\uFE0E" はテキスト表示を明示するセレクタ。
    // 付けないと端末によってはカラー絵文字として扱われ、
    // 初回描画時のグリフ読み込みでカクつく（✕は素のテキストなので発生しない）。
    burstParticles(e.currentTarget, "♥\uFE0E");
    chooseAnswer("yes", 1, 0, 0, true); // ← 最後に true
  });
  $("#swipeNo").addEventListener("click", (e) => {
    pressButton(e.currentTarget);
    burstParticles(e.currentTarget, "✕");
    chooseAnswer("no", -1, 0, 0, true); // ← 最後に true
  });
  $("#analysisResultButton").addEventListener(
    "click",
    proceedFromAnalysisToResult,
  );
  $("#lineCta").addEventListener("click", handleLineClick);
  $("#retryResult").addEventListener("click", () => {
    const diagnosis = state.currentDiagnosis || loadDraft();
    logEvent("retry_click", {
      diagnosisId: diagnosis?.diagnosisId || null,
      resultType: diagnosis?.resultType || null,
      funnelId: diagnosis?.funnelId || getCurrentFunnelId(),
      from: "result",
    });
    startDiagnosis();
  });

  // カンプの丸型シェアボタン
  const shareXRound = $("#shareXRound");
  if (shareXRound) shareXRound.addEventListener("click", shareToX);
  const shareCopy = $("#shareCopy");
  if (shareCopy) shareCopy.addEventListener("click", () => copyResultLink());
  // TikTok / Instagram はURL投稿ができないため、リンクコピー＋案内にする
  const shareTiktok = $("#shareTiktok");
  if (shareTiktok)
    shareTiktok.addEventListener("click", () =>
      copyResultLink(
        "リンクをコピーしました。TikTokアプリで貼り付けてシェアできます。",
      ),
    );
  const shareLineRound = $("#shareLineRound");
  if (shareLineRound) shareLineRound.addEventListener("click", shareToLine);

  window.addEventListener("keydown", (event) => {
    if (document.body.dataset.view !== "swipe") return;
    if (event.key === "ArrowRight") chooseAnswer("yes", 1, 0, 0, true);
    if (event.key === "ArrowLeft") chooseAnswer("no", -1, 0, 0, true);
  });
}

function initHeroImage() {
  const firstImage = cards[0]?.image || DEFAULT_CARDS[0].image;
  document.documentElement.style.setProperty(
    "--hero-image",
    `url("${firstImage}")`,
  );
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
    cardCount: cards.length,
  });
}

init();

// 0817

function countUp(el, target, duration = 1200) {
  const start = performance.now();

  function tick(now) {
    const progress = Math.min((now - start) / duration, 1); // 0→1
    // 最後にゆっくり止まる動き（イージング）
    const eased = 1 - Math.pow(1 - progress, 3);
    const current = Math.round(target * eased);

    // カンマ区切りで表示
    el.textContent = current.toLocaleString();

    if (progress < 1) {
      requestAnimationFrame(tick);
    } else {
      el.textContent = target.toLocaleString(); // 最後は正確な値で固定
    }
  }

  requestAnimationFrame(tick);
}

// 実行
const ninzu = document.querySelector(".ninzu");
if (ninzu) {
  const target = parseInt(ninzu.textContent.replace(/,/g, ""), 10); // "5,061" → 5061
  ninzu.textContent = "0";
  countUp(ninzu, target);
}

function burstParticles(btn, symbol) {
  const rect = btn.getBoundingClientRect();
  const count = 6; // 飛ぶ数

  for (let i = 0; i < count; i++) {
    const p = document.createElement("span");
    p.className = "pop-particle";
    p.textContent = symbol;

    // ボタンの中心を基準に、少し左右にばらけさせる
    const spread = (Math.random() - 0.5) * 60; // -30〜30px
    p.style.left = `${rect.left + rect.width / 2 + spread}px`;
    p.style.top = `${rect.top + rect.height / 2}px`;
    p.style.position = "fixed"; // 画面基準で配置
    p.style.color = symbol.startsWith("♥") ? "#ff2d8e" : "#9aa0ac";
    p.style.animationDelay = `${i * 40}ms`;
    p.style.fontSize = `${16 + Math.random() * 12}px`; // 大きさをバラす

    document.body.appendChild(p);

    // アニメ後に片付け
    setTimeout(() => p.remove(), 1000);
  }
}
function pressButton(btn) {
  btn.classList.remove("is-pressed");
  void btn.offsetWidth; // アニメを再生し直すおまじない
  btn.classList.add("is-pressed");
}

// 分析中テキスト切り替え
const rotatorMessages = [
  "回答パターンを分析中…",
  "マッチ度の高い求人を検索中…",
  "結果を準備しています…",
  "{count}人の診断データと比較中…",
  "あなたの価値観の輪郭を描いています…",
];
let rotatorIndex = 0;
let rotatorTimer = null;
let rotatorStopped = false;

function startRotator() {
  const el = document.querySelector("#analysisRotator");
  if (!el) return;
  stopRotator();
  rotatorStopped = false;
  rotatorTimer = setInterval(() => {
    rotatorIndex = (rotatorIndex + 1) % rotatorMessages.length;

    // {count} を最新の人数に置き換える（失敗しても巡回は止めない）
    let count = "";
    try {
      count = formatNumber(getCurrentComparisonCount(settings));
    } catch (e) {
      count = "";
    }
    const text = rotatorMessages[rotatorIndex].replace("{count}", count);

    el.style.opacity = "0";
    el.style.transform = "translateY(8px)"; // ちょっと下へ沈めて消す
    setTimeout(() => {
      if (rotatorStopped) return;
      el.textContent = text;
      el.style.transform = "translateY(8px)"; // 新テキストも一旦下に置いて
      // 次のフレームで定位置へ上げる → 下からぬんっ
      requestAnimationFrame(() => {
        el.style.opacity = "1";
        el.style.transform = "translateY(0)";
      });
    }, 250);
  }, 1800);
}

function stopRotator() {
  rotatorStopped = true;
  if (rotatorTimer) {
    clearInterval(rotatorTimer);
    rotatorTimer = null;
  }
}
