import {
  AXES,
  AXIS_ORDER,
  DEFAULT_CARDS,
  DEFAULT_SETTINGS,
  STORAGE_KEYS,
  buildSettingsFromMaster,
  getConfiguredCards,
  getConfiguredResults,
  getResultKey,
  loadAdminSettings
} from "./data.js";

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
let cards = getConfiguredCards(settings);
let results = getConfiguredResults(settings);

const state = {
  answers: [],
  currentIndex: 0,
  cardStartedAt: 0,
  isAnimating: false,
  currentDiagnosis: null
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

function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
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
  const events = JSON.parse(localStorage.getItem(STORAGE_KEYS.eventLog) || "[]");
  events.push({
    eventName,
    payload,
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
  cards = getConfiguredCards(settings);
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

function logEvent(eventName, payload = {}) {
  const diagnosisId = state.currentDiagnosis?.diagnosisId || payload.diagnosisId || null;
  pushLocalEvent(eventName, payload);
  if (diagnosisId && String(diagnosisId).startsWith("diag_")) return;
  callEdgeFunction("event-log", {
    eventName,
    diagnosisId,
    payload
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
}

function startRules() {
  showScreen("rules");
}

function startDiagnosis() {
  resetDiagnosis();
  logEvent("diagnosis_start", { cardCount: cards.length });
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

  const moveCard = () => {
    const rotate = currentX / 18;
    card.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) rotate(${rotate}deg)`;
    card.querySelector(".choice-yes").style.opacity = Math.max(0, currentX / 120);
    card.querySelector(".choice-no").style.opacity = Math.max(0, -currentX / 120);
  };

  card.addEventListener("pointerdown", (event) => {
    if (state.isAnimating) return;
    dragging = true;
    startX = event.clientX;
    startY = event.clientY;
    currentX = 0;
    currentY = 0;
    card.classList.add("is-dragging");
    card.setPointerCapture(event.pointerId);
  });

  card.addEventListener("pointermove", (event) => {
    if (!dragging || state.isAnimating) return;
    currentX = event.clientX - startX;
    currentY = event.clientY - startY;
    moveCard();
  });

  const endDrag = () => {
    if (!dragging || state.isAnimating) return;
    dragging = false;
    card.classList.remove("is-dragging");

    if (Math.abs(currentX) > 92) {
      chooseAnswer(currentX > 0 ? "yes" : "no", Math.sign(currentX), currentX, currentY);
      return;
    }

    card.style.transform = "";
    card.querySelector(".choice-yes").style.opacity = 0;
    card.querySelector(".choice-no").style.opacity = 0;
  };

  card.addEventListener("pointerup", endDrag);
  card.addEventListener("pointercancel", endDrag);
}

function chooseAnswer(answer, direction = answer === "yes" ? 1 : -1, startX = 0, startY = 0) {
  if (state.isAnimating || state.currentIndex >= cards.length) return;
  state.isAnimating = true;

  const card = $(".swipe-card:not(.is-next)");
  const currentCard = cards[state.currentIndex];
  const responseTime = performance.now() - state.cardStartedAt;

  state.answers.push({
    imageId: currentCard.id,
    answer,
    answerOrder: state.currentIndex + 1,
    responseTime: Math.round(responseTime)
  });

  if (card) {
    const targetX = direction * Math.max(window.innerWidth * 1.15, 520);
    const targetY = startY * 0.7 - 24;
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
  state.currentDiagnosis = diagnosis;
  saveDraft(diagnosis);
  logEvent("diagnosis_complete", {
    answeredCount: diagnosis.answers.length,
    resultType: diagnosis.resultType,
    totalTime: diagnosis.answers.reduce((sum, answer) => sum + answer.responseTime, 0)
  });

  renderAnalysisChecklist();
  showScreen("analysis");
  await delay(2450);

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

  if (settings.requireLineBeforeResult) {
    renderJobs(true);
  } else {
    renderResult();
  }
}

function renderAnalysisChecklist() {
  $("#compareCount").textContent = formatNumber(settings.comparisonCount);
  $$(".analysis-check li").forEach((item, index) => {
    item.style.animationDelay = `${index * 280 + 220}ms`;
  });
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

  showScreen("result");
}

function renderJobs(isLocked = false) {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (diagnosis) state.currentDiagnosis = diagnosis;
  const hasLineConnection = Boolean(loadLineConnection());

  $("#jobCount").textContent = formatNumber(settings.jobCount);
  $("#highMatchCount").textContent = formatNumber(settings.highMatchCount);
  $("#jobLeadTitle").textContent = isLocked
    ? "あなたに合う求人があります。"
    : "このタイプに合う求人があります。";
  $("#jobLeadCopy").textContent = isLocked
    ? hasLineConnection
      ? "LINE連携済みです。タップすると新しい診断結果をLINEに送信します。"
      : "診断結果の詳細と一緒に、あなた向けの求人情報をLINEで受け取れます。"
    : "企業名は登録後に公開されます。今は件数とマッチ度だけ確認できます。";
  $("#lineCta").textContent = hasLineConnection ? "LINEで結果を受け取る" : "LINEで詳細を見る";

  showScreen("jobs");
}

async function sendLineResultWithSavedConnection(diagnosis) {
  const connection = loadLineConnection();
  if (!connection || !diagnosis?.savedToSupabase || !getFunctionsBaseUrl()) return false;

  const remote = await callEdgeFunction("send-line-result", {
    diagnosisId: diagnosis.diagnosisId,
    lineConnectionId: connection.lineConnectionId || null,
    linkedDiagnosisId: connection.diagnosisId || null
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
    appCompleteUrl
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
    resultType: diagnosis.resultType
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

  logEvent("line_login_success", { diagnosisId: diagnosis.diagnosisId, demo: true });
  logEvent("result_sent", { diagnosisId: diagnosis.diagnosisId, demo: true });
  state.currentDiagnosis = { ...diagnosis, status: "sent" };
  saveDraft(state.currentDiagnosis);
  renderResult();
}

function shareToX() {
  const diagnosis = state.currentDiagnosis || loadDraft();
  if (!diagnosis) return;
  const result = results[diagnosis.resultType] || diagnosis.result;
  const text = `私のAIキャリア診断は「${result.name}」でした。${result.catchCopy}`;
  const url = new URL("https://twitter.com/intent/tweet");
  url.searchParams.set("text", text);
  url.searchParams.set("url", window.location.origin + window.location.pathname);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function shareToLine() {
  const url = new URL("https://social-plugins.line.me/lineit/share");
  url.searchParams.set("url", window.location.origin + window.location.pathname);
  window.open(url.toString(), "_blank", "noopener,noreferrer");
}

function bindEvents() {
  $("#startFromLp").addEventListener("click", startRules);
  $("#startFromHero").addEventListener("click", startRules);
  $("#startSwipe").addEventListener("click", startDiagnosis);
  $("#skipRules").addEventListener("click", startDiagnosis);
  $("#swipeYes").addEventListener("click", () => chooseAnswer("yes", 1));
  $("#swipeNo").addEventListener("click", () => chooseAnswer("no", -1));
  $("#showJobs").addEventListener("click", () => renderJobs(false));
  $("#lineCta").addEventListener("click", handleLineClick);
  $("#retryResult").addEventListener("click", startRules);
  $("#retryJobs").addEventListener("click", startRules);
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

async function init() {
  await loadRemoteMaster();
  initHeroImage();
  bindEvents();
  $("#lpCompareCount").textContent = formatNumber(settings.comparisonCount);
  $("#lpJobCount").textContent = formatNumber(settings.jobCount);
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
