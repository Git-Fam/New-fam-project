/// <reference path="./edge-runtime.d.ts" />

export async function exchangeLineToken(code: string, redirectUri: string) {
  const clientId = Deno.env.get("LINE_LOGIN_CHANNEL_ID");
  const clientSecret = Deno.env.get("LINE_LOGIN_CHANNEL_SECRET");

  if (!clientId || !clientSecret) {
    throw new Error("LINE_LOGIN_CHANNEL_ID and LINE_LOGIN_CHANNEL_SECRET are required");
  }

  const params = new URLSearchParams({
    grant_type: "authorization_code",
    code,
    redirect_uri: redirectUri,
    client_id: clientId,
    client_secret: clientSecret
  });

  const response = await fetch("https://api.line.me/oauth2/v2.1/token", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: params.toString()
  });

  if (!response.ok) {
    throw new Error(await response.text());
  }

  return response.json() as Promise<{ access_token: string; id_token?: string }>;
}

export async function fetchLineProfile(accessToken: string) {
  const response = await fetch("https://api.line.me/v2/profile", {
    headers: { Authorization: `Bearer ${accessToken}` }
  });

  if (!response.ok) {
    throw new Error(await response.text());
  }

  return response.json() as Promise<{ userId: string; displayName?: string }>;
}

export async function fetchLineFriendshipStatus(accessToken: string) {
  const response = await fetch("https://api.line.me/friendship/v1/status", {
    headers: { Authorization: `Bearer ${accessToken}` }
  });

  if (!response.ok) {
    throw new Error(await response.text());
  }

  return response.json() as Promise<{ friendFlag: boolean }>;
}

export function buildLineMessages(diagnosis: Record<string, any>, appSettings: Record<string, any> = {}) {
  const result = diagnosis.result_payload || {};
  const jobCount = appSettings.job_count || Deno.env.get("DEFAULT_JOB_COUNT") || "12";
  const highMatchCount =
    appSettings.high_match_count || Deno.env.get("DEFAULT_HIGH_MATCH_COUNT") || "4";
  const jobs = Array.isArray(result.jobs) ? result.jobs.slice(0, 5).join(" / ") : "";

  return [
    {
      type: "text",
      text:
        result.lineMessage ||
        `診断結果は「${result.name || diagnosis.result_type}」でした。`
    },
    {
      type: "text",
      text:
        `あなたに合う求人があります。\n` +
        `紹介可能求人 ${jobCount}件\n` +
        `マッチ度90%以上 ${highMatchCount}件\n` +
        (jobs ? `向いている仕事: ${jobs}` : "")
    }
  ];
}

export async function pushLineMessages(lineUserId: string, messages: unknown[]) {
  const channelAccessToken = Deno.env.get("LINE_CHANNEL_ACCESS_TOKEN");
  if (!channelAccessToken) {
    throw new Error("LINE_CHANNEL_ACCESS_TOKEN is required");
  }

  const response = await fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${channelAccessToken}`,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      to: lineUserId,
      messages
    })
  });

  if (!response.ok) {
    throw new Error(await response.text());
  }
}

export async function verifyLineSignature(body: string, signature: string | null) {
  const channelSecret = Deno.env.get("LINE_CHANNEL_SECRET");
  if (!channelSecret || !signature) return false;

  const encoder = new TextEncoder();
  const key = await crypto.subtle.importKey(
    "raw",
    encoder.encode(channelSecret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    ["sign"]
  );
  const digest = await crypto.subtle.sign("HMAC", key, encoder.encode(body));
  const expected = btoa(String.fromCharCode(...new Uint8Array(digest)));

  return expected === signature;
}
