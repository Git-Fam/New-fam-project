const config = window.CAREER_APP_CONFIG || {};
const ADMIN_SESSION_STORAGE_KEY = "ai-career-admin-session";
const ADMIN_ASSET_VERSION = "20260807-card-delete";

const $ = (selector) => document.querySelector(selector);

function getFunctionsBaseUrl() {
  return String(config.supabaseFunctionsBaseUrl || "").replace(/\/$/, "");
}

function setLoginStatus(message) {
  $("#adminLoginStatus").textContent = message;
}

function showLogin(message = "") {
  $("#adminLoginScreen").hidden = false;
  $("#adminAppMount").hidden = true;
  $("#adminAppMount").innerHTML = "";
  setLoginStatus(message);
  $("#adminPasswordInput").focus({ preventScroll: true });
}

function getAdminSessionHeaders(sessionToken) {
  return sessionToken ? { "x-admin-session": sessionToken } : {};
}

function isUnauthorizedError(error) {
  return error?.status === 401 || String(error?.message || "").includes("Unauthorized");
}

function isRateLimitedError(error) {
  return error?.status === 429 || String(error?.message || "").includes("Too many login attempts");
}

async function requestAdminLogin(password) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) throw new Error("Supabase接続設定が必要です");

  const response = await fetch(`${baseUrl}/admin-login`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ password })
  });

  if (!response.ok) {
    const error = new Error((await response.text()) || "ログインに失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.json();
}

async function requestAdminUi(sessionToken) {
  const baseUrl = getFunctionsBaseUrl();
  if (!baseUrl) throw new Error("Supabase接続設定が必要です");

  const response = await fetch(`${baseUrl}/admin-ui`, {
    method: "GET",
    headers: getAdminSessionHeaders(sessionToken)
  });

  if (!response.ok) {
    const error = new Error((await response.text()) || "管理画面の読み込みに失敗しました");
    error.status = response.status;
    throw error;
  }

  return response.text();
}

async function loadAdminApp(sessionToken) {
  const html = await requestAdminUi(sessionToken);
  $("#adminAppMount").innerHTML = html;
  $("#adminLoginScreen").hidden = true;
  $("#adminAppMount").hidden = false;

  const adminModule = await import(`./admin.js?v=${ADMIN_ASSET_VERSION}`);
  await adminModule.initAdminApp();
}

function bindLoginEvents() {
  $("#adminLoginForm").addEventListener("submit", async (event) => {
    event.preventDefault();
    const password = $("#adminPasswordInput").value;
    if (!password) {
      setLoginStatus("管理パスワードを入力してください");
      return;
    }

    setLoginStatus("確認中です…");

    try {
      const login = await requestAdminLogin(password);
      if (!login?.sessionToken) {
        throw new Error("ログインセッションを取得できませんでした");
      }
      sessionStorage.setItem(ADMIN_SESSION_STORAGE_KEY, login.sessionToken);
      $("#adminPasswordInput").value = "";
      await loadAdminApp(login.sessionToken);
    } catch (error) {
      sessionStorage.removeItem(ADMIN_SESSION_STORAGE_KEY);
      showLogin(
        isRateLimitedError(error)
          ? "ログイン失敗が多すぎます。15分後に再試行してください"
          : isUnauthorizedError(error)
            ? "管理パスワードが正しくありません"
            : `ログイン失敗: ${error.message}`
      );
    }
  });
}

async function init() {
  bindLoginEvents();

  const sessionToken = sessionStorage.getItem(ADMIN_SESSION_STORAGE_KEY) || "";
  if (!sessionToken) {
    showLogin("管理パスワードを入力してください");
    return;
  }

  try {
    setLoginStatus("管理セッションを確認中です…");
    await loadAdminApp(sessionToken);
  } catch (error) {
    if (isUnauthorizedError(error)) {
      sessionStorage.removeItem(ADMIN_SESSION_STORAGE_KEY);
      showLogin("管理セッションが切れました。もう一度ログインしてください");
      return;
    }

    $("#adminLoginScreen").hidden = false;
    $("#adminAppMount").hidden = true;
    setLoginStatus(`管理画面読み込み失敗: ${error.message}`);
  }
}

init();
