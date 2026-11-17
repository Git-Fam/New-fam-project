import {
  AXES,
  AXIS_ORDER,
  DNA_AXES,
  TYPE_CATEGORY_COLOR,
  DEFAULT_CARDS,
  DEFAULT_SETTINGS,
  STORAGE_KEYS,
  buildSettingsFromMaster,
  getConfiguredResults,
  getConfiguredResults16,
  calculateTypeDiagnosis,
  canUseTaggedEngine,
  getCurrentComparisonCount,
  getDiagnosisQuestionError,
  getDiagnosisCards,
  getResultKey,
  loadAdminSettings,
} from "./data.js?v=20260925-16type-fix3";

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
  results = getConfiguredResults(settings);

  // 診断が既に始まっている（1問でも回答済み）場合、ここでcardsを差し替えると
  // 「回答した質問」と「採点対象のcards」が食い違い、スコアが壊れる。
  // その場合はcardsを更新せず、次回の診断開始時（startDiagnosis）に反映させる。
  const diagnosisInProgress =
    (state.answers && state.answers.length > 0) ||
    (state.specialAnswers && state.specialAnswers.length > 0);
  if (!diagnosisInProgress) {
    cards = getDiagnosisCards(settings);
  }
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
  return isSpecialCard(card)
    ? card.questionKey || card.key || card.id
    : card.id;
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
  const now = new Date();
  const expiresAt = new Date(now.getTime() + 24 * 60 * 60 * 1000);

  // 80問QUESTION BANK（DNA/TYPEタグ付き）が使える時は新しい16TYPE判定エンジンを使う。
  // そうでない場合（旧6軸カードのまま等）は、これまで通りの15タイプ判定にフォールバックする。
  if (canUseTaggedEngine(cards)) {
    const diagnosis16 = calculateTypeDiagnosis(
      state.answers,
      state.specialAnswers,
      cards,
    );
    const results16 = getConfiguredResults16(settings);
    const resultType = diagnosis16.primaryType;
    const result = results16[resultType];

    // DNAは4問中のYES数から算出するため0/25/50/75/100の5値しか取らない。
    // 画面表示だけ±3のランダムなブレを加えて不自然な「キリの良さ」を和らげる。
    // 判定・保存用のdnaScores自体はブレさせない（診断精度・ログには影響させない）。
    const dnaScoresDisplay = Object.fromEntries(
      Object.entries(diagnosis16.dnaScores).map(([category, score]) => {
        const jitter = Math.floor(Math.random() * 7) - 3; // -3〜+3
        const displayScore = Math.min(100, Math.max(0, score + jitter));
        return [category, displayScore];
      }),
    );

    return {
      diagnosisId: crypto.randomUUID
        ? `diag_${crypto.randomUUID()}`
        : `diag_${Date.now()}`,
      answers: [...state.answers],
      specialAnswers: [...state.specialAnswers],
      dnaScores: diagnosis16.dnaScores,
      dnaScoresDisplay,
      typeDirect: diagnosis16.typeDirect,
      dnaFit: diagnosis16.dnaFit,
      specialByType: diagnosis16.specialByType,
      finalScores: diagnosis16.finalScores,
      primaryType: diagnosis16.primaryType,
      secondaryType: diagnosis16.secondaryType,
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

  const scores = calculateScores(cards, state.answers);
  const maxScores = calculateMaxScores(cards);
  const scoreRates = calculateScoreRates(scores, maxScores);
  const rankedAxes = pickTopAxes(scores, scoreRates);
  const primaryAxis = rankedAxes[0];
  const secondaryAxis = rankedAxes[1];
  const resultType = getResultKey(primaryAxis, secondaryAxis);
  const result = results[resultType];

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
  cards = getDiagnosisCards(settings, { recordExposure: true });
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
        <div class="choice-badge choice-no"></div>
        <div class="choice-badge choice-yes"></div>
        <div class="special-question-card__media" aria-hidden="true"></div>
        <div class="special-question-card__top-fade" aria-hidden="true"></div>
        <div class="special-question-card__bottom-fade" aria-hidden="true"></div>
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
  $("#progressText").innerHTML =
    `<span class="progress-current">${state.currentIndex + 1}</span> / ${cards.length}`;
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

// スペシャルクエスチョンの時だけ、共通ヘッダーにバッジ・見出し・ネオン枠を出す
function updateSpecialQuestionHeader(card) {
  const header = $("#specialQuestionHeader");
  const title = $("#specialQuestionHeaderTitle");
  const neonFrame = $("#swipeNeonFrame");
  const stack = $("#cardStack");
  const shell = document.querySelector(".swipe-shell");

  if (isSpecialCard(card)) {
    if (title) title.textContent = card.questionText || card.question || "";
    if (header) header.hidden = false;
    if (neonFrame) neonFrame.hidden = false;
    if (stack) stack.classList.add("is-special-active");
    if (shell) shell.classList.add("is-special-mode");
  } else {
    if (header) header.hidden = true;
    if (neonFrame) neonFrame.hidden = true;
    if (stack) stack.classList.remove("is-special-active");
    if (shell) shell.classList.remove("is-special-mode");
  }
}

function renderSwipeCard() {
  updateSwipeProgressUI();
  updateSwipeActionButtons();
  updateSpecialQuestionHeader(cards[state.currentIndex]);

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

// ===== 結果キャラ画像：浮遊・たまに一回転・タップで拡大 =====
let heroSpinTimer = null;

// 8〜16秒のランダムな間隔で、1回だけクルンと回す。結果画面を離れたら止める。
function scheduleHeroImageOccasionalSpin() {
  if (heroSpinTimer) return; // すでに動いていれば何もしない
  const tick = () => {
    const inner = document.querySelector(".hero-image-inner");
    const onResultScreen =
      document.body.dataset.view === "result" &&
      !document.querySelector('[data-screen="result"]').hidden;
    if (inner && onResultScreen && !inner.classList.contains("is-spinning")) {
      inner.classList.add("is-spinning");
      inner.addEventListener(
        "animationend",
        () => inner.classList.remove("is-spinning"),
        { once: true },
      );
    }
    const nextDelay = 8000 + Math.random() * 8000;
    heroSpinTimer = window.setTimeout(tick, nextDelay);
  };
  heroSpinTimer = window.setTimeout(tick, 8000 + Math.random() * 8000);
}

function openImageLightbox(src) {
  if (!src) return;
  const lightbox = $("#imageLightbox");
  $("#imageLightboxImg").src = src;
  lightbox.hidden = false;
  document.body.style.overflow = "hidden";
}

function closeImageLightbox() {
  const lightbox = $("#imageLightbox");
  lightbox.hidden = true;
  $("#imageLightboxImg").src = "";
  document.body.style.overflow = "";
}

// ===== スペシャルクエスチョンの場面転換 =====
// 使える演出：wipe（斜めに走る）/ iris（円）/ curtain（上下から閉じる）/ flash（光る）/ burst（選んだボタンから広がる）
// 変えたい時は、下の SPECIAL_TRANSITION_DEFAULTS を書き換える。
// 本番で試したい時は、URL の末尾に ?sqEnter=iris&sqExit=flash のように付けると
// その場で演出を切り替えられる（設定は保存されない）。
const SPECIAL_TRANSITION_STYLES = ["wipe", "iris", "curtain", "flash", "burst"];
// burst＝選んだA/Bボタンから、青/ピンクが広がる（退場専用。登場に指定した場合は iris になる）
const SPECIAL_TRANSITION_DEFAULTS = { enter: "curtain", exit: "burst" };
// cover：覆う時間 / hold：覆ったまま見せる時間 / uncover：開く時間（ミリ秒）
const SPECIAL_TRANSITION_TIMING = {
  enter: { cover: 260, hold: 320, uncover: 380 },
  // 退場の cover は「波紋が2回広がる → 全体を塗りつぶす」までの時間（長くすると、ゆっくりになる）
  exit: { cover: 900, hold: 0, uncover: 300 },
};

function getSpecialTransitionStyle(kind) {
  const paramName = kind === "enter" ? "sqEnter" : "sqExit";
  const requested = new URLSearchParams(window.location.search).get(paramName);
  return SPECIAL_TRANSITION_STYLES.includes(requested)
    ? requested
    : SPECIAL_TRANSITION_DEFAULTS[kind];
}

// 画面を覆う → 覆っている間に onSwap（カードの入れ替え）→ 開く。終わったら解決する。
function runSpecialTransition(kind, direction, onSwap, options = {}) {
  return new Promise((resolve) => {
    const overlay = $("#sqTransition");
    const reduceMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;
    if (!overlay || reduceMotion) {
      onSwap();
      resolve();
      return;
    }

    const timing = SPECIAL_TRANSITION_TIMING[kind];
    let style = getSpecialTransitionStyle(kind);
    const origin = options.origin || null;
    if (style === "burst") {
      if (!origin) {
        style = "iris"; // 起点になるボタンが無い（登場など）時は、円の演出で代用
      } else {
        // 選んだボタンの中心から、画面の一番遠い角まで届く半径を計算する
        const rect = origin.getBoundingClientRect();
        const x = rect.left + rect.width / 2;
        const y = rect.top + rect.height / 2;
        const radius =
          Math.hypot(
            Math.max(x, window.innerWidth - x),
            Math.max(y, window.innerHeight - y),
          ) + 12;
        overlay.style.setProperty("--sq-x", `${x}px`);
        overlay.style.setProperty("--sq-y", `${y}px`);
        overlay.style.setProperty("--sq-r", `${radius}px`);
        origin.classList.add("is-chosen");
      }
    }
    overlay.dataset.choice = options.choice || "";
    overlay.dataset.style = style;
    overlay.dataset.kind = kind;
    overlay.dataset.dir = direction < 0 ? "left" : "right";
    overlay.style.setProperty("--sq-cover", `${timing.cover}ms`);
    overlay.style.setProperty("--sq-uncover", `${timing.uncover}ms`);
    overlay.dataset.phase = "cover";
    overlay.hidden = false;

    setTimeout(() => {
      overlay.dataset.phase = "hold";
      setTimeout(() => {
        // 完全に覆われている間に、カードとヘッダーを入れ替える
        onSwap();
        // 押した色のボタンの塗りも、覆われている間に元へ戻す
        if (origin) origin.classList.remove("is-chosen");
        overlay.dataset.phase = "uncover";
        setTimeout(() => {
          overlay.hidden = true;
          overlay.dataset.phase = "";
          if (origin) origin.classList.remove("is-chosen");
          resolve();
        }, timing.uncover);
      }, timing.hold);
    }, timing.cover);
  });
}

// 回答後、後ろにスタンバイしていた次のカードをそのまま前面に昇格させる。
// stack.innerHTML を作り直さないことで、is-next → 通常状態への
// CSSトランジション（縮小・奥まった位置 → 等倍・手前）がそのまま効く。
function promoteNextCard({ reveal = false } = {}) {
  const stack = $("#cardStack");

  // 飛んでいった直前のカード（既に画面外 or 消えかけ）を除去
  const spentCard = stack.querySelector(".swipe-card:not(.is-next)");
  if (spentCard) spentCard.remove();

  updateSwipeProgressUI();

  const promoted = stack.querySelector(".swipe-card.is-next");
  const upcoming = cards[state.currentIndex + 1];
  updateSwipeActionButtons(cards[state.currentIndex]);
  updateSpecialQuestionHeader(cards[state.currentIndex]);

  if (promoted) {
    // is-next を外した瞬間、CSSのtransitionで
    // 「奥で待機 → 手前にせり出す」動きになる
    promoted.classList.remove("is-next");
    // スペシャルの登場演出（画像のズームイン等）は、昇格の瞬間だけ動かす
    if (reveal && isSpecialCard(cards[state.currentIndex])) {
      promoted.classList.add("is-revealing");
    }
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
      // 80問QUESTION BANK対応：16TYPE判定エンジンがSPECIAL補正に使う
      typeCodeA: currentCard.typeCodeA || "",
      typeCodeB: currentCard.typeCodeB || "",
      selectedTypeCode:
        selectedOption === "B"
          ? currentCard.typeCodeB || ""
          : currentCard.typeCodeA || "",
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

  // スペシャルクエスチョンは全画面なので、普通のカードのように放り投げず、
  // 場面転換の演出で次へ移る。
  //  ・スペシャルに答えた後（退場）：exit 演出
  //  ・スペシャルの直前のカードに答えた後（登場）：投げた後に enter 演出
  const leavingSpecial =
    isSpecialCard(currentCard) && answerOrder < cards.length;
  const enteringSpecial =
    !isSpecialCard(currentCard) && isSpecialCard(nextCard);

  if (leavingSpecial) {
    // A＝左のボタン（swipeNo）、B＝右のボタン（swipeYes）。選んだ方から色が広がる
    runSpecialTransition(
      "exit",
      direction,
      () => {
        state.currentIndex += 1;
        promoteNextCard();
      },
      {
        origin: $(answer === "yes" ? "#swipeYes" : "#swipeNo"),
        choice: answer === "yes" ? "b" : "a",
      },
    ).then(() => {
      state.isAnimating = false;
    });
    return;
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

  if (enteringSpecial) {
    // 投げたカードが消えかけるタイミングから、演出を重ねて始める
    setTimeout(
      () => {
        const shell = document.querySelector(".experience-shell.tossing");
        if (shell) shell.classList.remove("tossing");
        runSpecialTransition("enter", direction, () => {
          state.currentIndex += 1;
          promoteNextCard({ reveal: true });
        }).then(() => {
          state.isAnimating = false;
        });
      },
      Math.max(exitDuration - 180, 0),
    );
    return;
  }

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
    totalTime: allAnswers.reduce((sum, answer) => sum + answer.responseTime, 0),
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
    resultButton.disabled = true;
    resultButton.classList.remove("is-ready");
  }
  $$(".a-step").forEach((step) => {
    step.classList.remove("is-active", "is-done");
  });

  // カードを分析中の状態に戻す（再診断対応）
  const card = document.querySelector(".analysis-card");
  const cardIcon = document.querySelector(".analysis-card .card-icon");
  if (card) {
    card.classList.remove("is-complete");
    card.style.setProperty("--fan", String(calcFan(0)));
    card.style.setProperty("--closeAmount", "0");
  }
  if (cardIcon) {
    cardIcon.classList.remove("is-swapping-out");
    cardIcon.src = "./assets/figma/analysis-star.webp";
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

  // ゴーストが閉じる（--fanは上のupdateAnalysisProgressで既に0）のと同時に
  // 本体・アイコンも縮み始める＝「吸収される」ように揃える
  const card = document.querySelector(".analysis-card");
  const cardIcon = document.querySelector(".analysis-card .card-icon");
  if (card && cardIcon) {
    card.classList.add("is-complete");
    card.style.setProperty("--closeAmount", "0");
    cardIcon.classList.add("is-swapping-out");
    setTimeout(() => {
      cardIcon.src = "./assets/figma/card-check.svg";
      cardIcon.classList.remove("is-swapping-out");
    }, 180); // 本体がゆっくり押し出されてくるタイミングに合わせてチェックへ差し替え
  }

  const resultButton = $("#analysisResultButton");
  if (!resultButton) return;
  resultButton.disabled = false;
  resultButton.classList.add("is-ready");

  resultButton.focus({ preventScroll: true });
}

function proceedFromAnalysisToResult() {
  const resultButton = $("#analysisResultButton");
  if (resultButton) resultButton.disabled = true;
  renderResult();
}

// 0-62%：コンパクトなまま大きめにシャッフル（あまり広がらない）
// 62-78%：一気に開く（パッと見せる瞬間）
// 78-90%：全開をキープ（画像のような見た目）
// 90-98%：ゆっくり縮んでいく（急にではなく、じわっと閉じる）
// 98-100%：閉じきった状態をキープ（この後ポンッと弾む）
function calcFan(percent) {
  if (percent >= 100) return 0;
  if (percent < 62) return 0.22;
  if (percent < 78) {
    const t = (percent - 62) / 16;
    return 0.22 + t * 0.78;
  }
  if (percent < 90) return 1;
  if (percent < 98) {
    const t = (percent - 90) / 8;
    return 1 - t;
  }
  return 0;
}

// 手前のカード本体の縮み具合。シャッフル中・開いている間は常に1（普通サイズ）のまま、
// 90-98%の間だけゆっくり縮む。--fanとは別軸にして、開閉の切り替わりで
// 本体サイズが余計に上下しないようにする。
function calcClose(percent) {
  if (percent < 90) return 0;
  if (percent < 98) return (percent - 90) / 8;
  return 1;
}

function updateAnalysisProgress(percent, label) {
  const safePercent = Math.max(0, Math.min(100, Math.round(percent)));
  const fill = $("#analysisProgressFill");
  const percentText = $("#analysisProgressPercent");
  const labelText = $("#analysisProgressLabel");

  if (fill) fill.style.transform = `scaleX(${safePercent / 100})`;
  if (percentText) percentText.innerHTML = `${safePercent}<small>%</small>`;
  if (labelText && label) labelText.textContent = label;

  updateAnalysisSteps(safePercent);

  // 進捗が進むほど扇(--fan)を閉じていく＝候補が1つに絞り込まれていく表現
  const card = document.querySelector(".analysis-card");
  if (card) {
    card.style.setProperty("--fan", String(calcFan(safePercent)));
    card.style.setProperty("--closeAmount", String(calcClose(safePercent)));
    // シャッフル（がたがた揺れる）のは中央でコンパクトな間だけ。開く/閉じる時は滑らかに。
    card.classList.toggle("is-shuffling", safePercent < 62);
  }

  const btn = $("#analysisResultButton");
  if (btn) btn.classList.toggle("is-ready", safePercent >= 100);
}

// 進捗率に応じて3ステップ（選択データ/思考パターン/求人マッチング）のリング表示を切り替える
function updateAnalysisSteps(percent) {
  const steps = $$(".a-step");
  if (!steps.length) return;

  // 0-42%: step1が実行中 / 42-76%: step2 / 76-100%: step3
  let activeIndex = 0;
  if (percent >= 76) activeIndex = 2;
  else if (percent >= 42) activeIndex = 1;

  steps.forEach((step, index) => {
    step.classList.toggle("is-active", index === activeIndex && percent < 100);
    step.classList.toggle("is-done", index < activeIndex || percent >= 100);
  });
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
    to: 90,
    onUpdate: (value) => updateAnalysisProgress(value, "類似タイプを比較中"),
  });
  // ここで待たせる間、カードは全開(--fan:1)のまま＝見える状態でキープする。
  // 閉じてから待たせると「何も見えない時間」ができて苦痛に感じるため、
  // 開いた状態を見せながら待たせる形に変更。
  updateAnalysisProgress(90, "診断結果を作成中");
  await delay(1200);
  // 90→100を一気に：ここでゴーストが閉じて本体も吸収されるが、
  // 見えなくなる時間はこのアニメーションの終盤(98-100%)のごく一瞬だけになる。
  await animateNumber({
    duration: 900,
    from: 90,
    to: 100,
    onUpdate: (value) => updateAnalysisProgress(value, "診断結果の準備完了"),
  });
  await delay(160);
}

function renderAxisBars(diagnosis) {
  // 新エンジン（80問QUESTION BANK）：5つのWORK DNAをそのままメーターにする
  // 表示用にジッターを掛けたdnaScoresDisplayがあればそちらを優先する
  const dnaScoresForDisplay = diagnosis.dnaScoresDisplay || diagnosis.dnaScores;
  if (dnaScoresForDisplay) {
    return Object.entries(dnaScoresForDisplay)
      .map(([category, score]) => {
        const meta = DNA_AXES[category] || { label: category, color: "#999" };
        return `
          <div class="axis-row">
            <div class="axis-label">
              <span>${meta.label}</span>
              <strong>${score}%</strong>
            </div>
            <div class="axis-track"><span style="width: ${score}%; background: ${meta.color}"></span></div>
          </div>
        `;
      })
      .join("");
  }

  // 旧エンジン（6軸）：フォールバック
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

// 結果画面の背景に、星・丸をゆっくり降らせる装飾（一度だけ生成すればOK）
function renderResultBgDeco() {
  const stage = document.getElementById("resultBgDeco");
  if (!stage || stage.dataset.rendered) return; // 二重生成防止
  stage.dataset.rendered = "true";

  const ASSETS = [
    `<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.03564 0C9.03564 0 10.8506 3.6221 12.6499 5.42135C14.4491 7.2206 18.0712 9.03558 18.0712 9.03558C18.0712 9.03558 14.4491 10.8506 12.6499 12.6498C10.8506 14.4491 9.03564 18.0712 9.03564 18.0712C9.03564 18.0712 7.22066 14.4491 5.42141 12.6498C3.62216 10.8506 6.08458e-05 9.03558 6.08458e-05 9.03558C6.08458e-05 9.03558 3.62216 7.2206 5.42141 5.42135C7.22066 3.6221 9.03564 0 9.03564 0Z" fill="#98E6FD"/></svg>`,
    `<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.98779 0C4.98779 0 5.98971 1.99948 6.98293 2.99271C7.97616 3.98594 9.97564 4.98785 9.97564 4.98785C9.97564 4.98785 7.97616 5.98976 6.98293 6.98299C5.98971 7.97622 4.98779 9.9757 4.98779 9.9757C4.98779 9.9757 3.98588 7.97622 2.99265 6.98299C1.99943 5.98976 -5.71883e-05 4.98785 -5.71883e-05 4.98785C-5.71883e-05 4.98785 1.99943 3.98594 2.99265 2.99271C3.98588 1.99948 4.98779 0 4.98779 0Z" fill="#ECD6FF"/></svg>`,
    `<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.30334 0C6.30334 0 7.56949 2.52681 8.82466 3.78198C10.0798 5.03715 12.6066 6.3033 12.6066 6.3033C12.6066 6.3033 10.0798 7.56944 8.82466 8.82461C7.56949 10.0798 6.30334 12.6066 6.30334 12.6066C6.30334 12.6066 5.0372 10.0798 3.78203 8.82461C2.52686 7.56944 4.97246e-05 6.3033 4.97246e-05 6.3033C4.97246e-05 6.3033 2.52686 5.03715 3.78203 3.78198C5.0372 2.52681 6.30334 0 6.30334 0Z" fill="#F5A9CF"/></svg>`,
    `<svg width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2.5" cy="2.5" r="2.5" fill="#ECD6FF"/></svg>`,
    `<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#A4EADF"/></svg>`,
  ];

  function toDataUri(svg) {
    return (
      "data:image/svg+xml;base64," + btoa(unescape(encodeURIComponent(svg)))
    );
  }

  const stageWidth = window.innerWidth; // 非表示中に測ると0になるため、常にウィンドウ幅を使う
  const COUNT = 14;

  for (let i = 0; i < COUNT; i++) {
    const el = document.createElement("span");
    el.className = "bg-deco";
    const asset = ASSETS[i % ASSETS.length];
    const size = 14 + Math.random() * 22;
    const left = Math.random() * (stageWidth - size);
    const duration = 10 + Math.random() * 8;
    const delay = -Math.random() * duration;
    const dx = (Math.random() * 2 - 1) * 20;
    const rot = (Math.random() > 0.5 ? 1 : -1) * (280 + Math.random() * 260);
    const opacity = 0.18 + Math.random() * 0.22;

    el.style.left = left + "px";
    el.style.width = size + "px";
    el.style.height = size + "px";
    el.style.animationDuration = duration + "s";
    el.style.animationDelay = delay + "s";
    el.style.setProperty("--dx", dx + "px");
    el.style.setProperty("--rot", rot + "deg");
    el.style.setProperty("--op", opacity);

    const img = document.createElement("img");
    img.src = toDataUri(asset);
    el.appendChild(img);
    stage.appendChild(el);
  }
}

function renderResult() {
  renderResultBgDeco();
  scheduleHeroImageOccasionalSpin();
  updateShareNativeButtonVisibility();
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) {
    showScreen("lp");
    return;
  }

  state.currentDiagnosis = diagnosis;

  const result = results[diagnosis.resultType] || diagnosis.result;

  // 新エンジン（80問QUESTION BANK）：タイプが属する系統カラーを使う
  // 旧エンジン（6軸）：これまで通り上位2軸の色を使う
  if (diagnosis.primaryType) {
    const accent = TYPE_CATEGORY_COLOR[diagnosis.primaryType] || "#ff4d6d";
    $("#resultCard").style.setProperty("--accent-a", accent);
    $("#resultCard").style.setProperty("--accent-b", accent);
  } else {
    const primary = AXES[diagnosis.primaryAxis] || AXES.people;
    const secondary = AXES[diagnosis.secondaryAxis] || AXES.challenge;
    $("#resultCard").style.setProperty("--accent-a", primary.color);
    $("#resultCard").style.setProperty("--accent-b", secondary.color);
  }
  $("#resultType").textContent = result.name;

  // タイプごとのキャラクター画像（管理画面で設定）をカード表面に反映
  const characterImage = $("#resultCharacterImage");
  if (characterImage) {
    if (result.characterImage) {
      characterImage.src = result.characterImage;
      characterImage.hidden = false;
    } else {
      characterImage.src = "";
      characterImage.hidden = true; // 未設定の間はグレーのプレースホルダーのまま
    }
  }
  $("#resultCopy").textContent = result.catchCopy;
  $("#resultDescription").textContent = result.description;
  const weaponEl = $("#resultWeapon");
  if (weaponEl) weaponEl.textContent = result.weapon || "";
  // 「弱み」→「武器」のbefore/afterチップ（例：「飽きっぽさ」→「開拓者」）
  const weaponBeforeEl = $("#resultWeaponBefore");
  const weaponAfterEl = $("#resultWeaponAfter");
  if (weaponBeforeEl && weaponAfterEl) {
    const weaponMatch = String(result.weapon || "").match(/「(.+?)」/);
    const typeShortName = String(result.name || "")
      .split("｜")
      .pop();
    if (weaponMatch) {
      weaponBeforeEl.textContent = `「${weaponMatch[1]}」`;
      weaponAfterEl.textContent = typeShortName
        ? `${typeShortName}の才能`
        : "実はあなたの武器";
      $("#weaponFlip").hidden = false;
    } else {
      $("#weaponFlip").hidden = true;
    }
  }
  const bestEnvironmentEl = $("#resultBestEnvironment");
  if (bestEnvironmentEl)
    bestEnvironmentEl.textContent = result.bestEnvironment || "";
  $("#sameTypePercent").textContent = `${result.percent || 8}`;
  $("#strengthList").innerHTML = result.strengths
    .slice(0, 5)
    .map((strength) => {
      // 新エンジンの才能データは「強み — 説明文」の形式
      const [title, ...descParts] = String(strength).split(" — ");
      const description = descParts.join(" — ");
      return description
        ? `<li><div><strong>${escapeHtml(title)}</strong><small>${escapeHtml(description)}</small></div></li>`
        : `<li><div><strong>${escapeHtml(title)}</strong></div></li>`;
    })
    .join("");
  $("#jobList").innerHTML = result.jobs
    .slice(0, 5)
    .map((job) => {
      // 新エンジンの職業データは「職種名 — 説明文」の形式。区切りが無ければ職種名のみ扱う
      const [title, ...descParts] = String(job).split(" — ");
      const description = descParts.join(" — ");
      return description
        ? `<li><span>${escapeHtml(title)}</span><small>${escapeHtml(description)}</small></li>`
        : `<li><span>${escapeHtml(title)}</span></li>`;
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
      showLineConnectionError(
        "LINE連携の設定を確認してください。認証URLを作成できませんでした。",
      );
      return;
    }
  }

  if (getFunctionsBaseUrl()) {
    showLineConnectionError(
      "LINE連携の設定を確認してください。認証URLを作成できませんでした。",
    );
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

// シェアするURL（現在のページ）
function getShareUrl() {
  return window.location.origin + window.location.pathname;
}

// シェア用の文章。診断結果が取れない場合は空文字を返す（URLだけをシェアする）
const SHARE_HASHTAG = "働き方タイプ診断";
function buildShareText(diagnosis) {
  const result = diagnosis
    ? results[diagnosis.resultType] || diagnosis.result
    : null;
  if (!result || !result.name) return "";
  const lines = [`私のAIキャリア診断は「${result.name}」でした。`];
  if (result.catchCopy) lines.push(result.catchCopy);
  lines.push("あなたは何タイプ？");
  return lines.join("\n");
}

function logShareClick(diagnosis, channel) {
  if (!diagnosis) return;
  logEvent("share_click", {
    diagnosisId: diagnosis.diagnosisId,
    resultType: diagnosis.resultType,
    funnelId: diagnosis.funnelId,
    channel,
  });
}

function shareToX() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return;
  logShareClick(diagnosis, "x");
  const url = new URL("https://twitter.com/intent/tweet");
  url.searchParams.set("text", buildShareText(diagnosis));
  url.searchParams.set("url", getShareUrl());
  url.searchParams.set("hashtags", SHARE_HASHTAG);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function shareToLine() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  logShareClick(diagnosis, "line");
  const url = new URL("https://social-plugins.line.me/lineit/share");
  url.searchParams.set("url", getShareUrl());
  const text = buildShareText(diagnosis);
  if (text) url.searchParams.set("text", text);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

// クリップボードへコピー。成功したら true、失敗したら false を返す
async function copyToClipboard(text) {
  if (navigator.clipboard && navigator.clipboard.writeText) {
    try {
      await navigator.clipboard.writeText(text);
      return true;
    } catch (e) {
      // 権限がない等の場合は、下の古い方式にフォールバックする
    }
  }
  const ta = document.createElement("textarea");
  ta.value = text;
  ta.style.position = "fixed";
  ta.style.opacity = "0";
  document.body.appendChild(ta);
  ta.select();
  let ok = false;
  try {
    ok = document.execCommand("copy");
  } catch (e) {
    ok = false;
  }
  document.body.removeChild(ta);
  return ok;
}

// 今の診断結果のキャラクター画像を取得する（無ければ null）
function getResultImageUrl(diagnosis) {
  const result = diagnosis
    ? results[diagnosis.resultType] || diagnosis.result
    : null;
  return result?.characterImage || "";
}

// 画像URLをFileに変換する（シェア・クリップボードへの画像添付に使う）
async function fetchImageAsFile(url, filename = "result.png") {
  if (!url) return null;
  try {
    const response = await fetch(url);
    if (!response.ok) return null;
    const blob = await response.blob();
    return new File([blob], filename, { type: blob.type || "image/png" });
  } catch (e) {
    return null; // 画像の取得に失敗しても、文章だけのシェアにフォールバックする
  }
}

// クリップボードへの画像コピーは、ブラウザの仕様でPNG形式しか受け付けない
// （JPEG/WebPのまま渡すとエラーになる）ため、一度キャンバスに描いてPNGへ変換する
async function convertBlobToPngFile(blob, filename = "career-type.png") {
  const bitmap = await createImageBitmap(blob);
  const canvas = document.createElement("canvas");
  canvas.width = bitmap.width;
  canvas.height = bitmap.height;
  const ctx = canvas.getContext("2d");
  ctx.drawImage(bitmap, 0, 0);
  const pngBlob = await new Promise((resolve) =>
    canvas.toBlob(resolve, "image/png"),
  );
  if (!pngBlob) return null;
  return new File([pngBlob], filename, { type: "image/png" });
}

// この端末で「画像付きの共有」ができるかどうか（対応していないボタンは表示しない）
function supportsNativeImageShare() {
  return Boolean(navigator.share && navigator.canShare);
}

// 対応端末だけ、結果画面に「画像付きでシェア」ボタンを出す
function updateShareNativeButtonVisibility() {
  const button = $("#shareNative");
  if (button) button.hidden = !supportsNativeImageShare();
}

// 画像＋文章＋URLを、スマホの共有シート（LINE・Instagram・TikTok等を選べる画面）へまとめて渡す
async function shareNative() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return;
  logShareClick(diagnosis, "native");

  const text = buildShareText(diagnosis);
  const shareData = { title: "AIキャリア診断", url: getShareUrl() };
  if (text) shareData.text = `${text}\n`;

  const imageUrl = getResultImageUrl(diagnosis);
  const file = await fetchImageAsFile(imageUrl, "career-type.png");
  if (file && navigator.canShare({ files: [file] })) {
    shareData.files = [file];
  }

  try {
    await navigator.share(shareData);
  } catch (e) {
    // ユーザーが共有をキャンセルした場合もここに来るので、エラー表示はしない
  }
}

async function copyResultLink(message = "結果とリンクをコピーしました。") {
  const diagnosis = state.currentDiagnosis || loadDraft();
  logShareClick(diagnosis, "copy");
  const shareText = buildShareText(diagnosis);
  const text = shareText
    ? `${shareText}\n${getShareUrl()}\n#${SHARE_HASHTAG}`
    : getShareUrl();

  // 対応ブラウザでは、文章と画像の両方をクリップボードへ入れる。
  // 画像を受け取れる貼り付け先（Instagram等）では画像が、文章しか受け取れない貼り付け先
  // （LINEのトーク欄等）では文章が、それぞれ自然に使われる。
  const imageUrl = getResultImageUrl(diagnosis);
  if (imageUrl && window.ClipboardItem && navigator.clipboard?.write) {
    try {
      const file = await fetchImageAsFile(imageUrl, "career-type.png");
      const pngFile = file ? await convertBlobToPngFile(file) : null;
      if (pngFile) {
        await navigator.clipboard.write([
          new ClipboardItem({
            "text/plain": new Blob([text], { type: "text/plain" }),
            "image/png": pngFile,
          }),
        ]);
        window.alert(
          "結果（文章＋画像）とリンクをコピーしました。画像を貼り付けられる場所では画像が、文章だけの場所では文章が貼り付きます。",
        );
        return;
      }
    } catch (e) {
      // 複数形式のコピーに失敗した場合は、下の文章だけのコピーにフォールバックする
    }
  }

  const ok = await copyToClipboard(text);
  window.alert(
    ok ? message : "コピーできませんでした。もう一度お試しください。",
  );
}

function bindEvents() {
  $("#resultHeroImage").addEventListener("click", () => {
    const img = $("#resultCharacterImage");
    if (img && !img.hidden && img.src) openImageLightbox(img.src);
  });
  $("#imageLightboxClose").addEventListener("click", closeImageLightbox);
  $("#imageLightboxBackdrop").addEventListener("click", closeImageLightbox);
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !$("#imageLightbox").hidden) {
      closeImageLightbox();
    }
  });
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
  const shareNativeButton = $("#shareNative");
  if (shareNativeButton)
    shareNativeButton.addEventListener("click", shareNative);
  if (shareXRound) shareXRound.addEventListener("click", shareToX);
  const shareCopy = $("#shareCopy");
  if (shareCopy) shareCopy.addEventListener("click", () => copyResultLink());
  // TikTok / Instagram はURL投稿ができないため、リンクコピー＋案内にする
  const shareTiktok = $("#shareTiktok");
  if (shareTiktok)
    shareTiktok.addEventListener("click", () =>
      copyResultLink(
        "結果とリンクをコピーしました。TikTokアプリで貼り付けてシェアできます。",
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
