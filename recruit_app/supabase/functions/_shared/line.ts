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

export const CAREER_SURVEY_KEY = "career_preferences";

export type CareerSurveyOption = {
  value: string;
  label: string;
};

export type CareerSurveyQuestion = {
  key: string;
  label: string;
  options: CareerSurveyOption[];
};

export const CAREER_SURVEY_QUESTIONS: CareerSurveyQuestion[] = [
  {
    key: "desired_location",
    label: "希望勤務地は？",
    options: [
      { value: "tokyo", label: "東京" },
      { value: "osaka", label: "大阪" },
      { value: "hokkaido", label: "北海道" },
      { value: "other", label: "その他" }
    ]
  },
  {
    key: "job_change_timing",
    label: "転職時期は？",
    options: [
      { value: "soon", label: "すぐ" },
      { value: "within_3_months", label: "3ヶ月以内" },
      { value: "within_6_months", label: "半年以内" },
      { value: "undecided", label: "まだ未定" }
    ]
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
    ]
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
    ]
  }
] as CareerSurveyQuestion[];

export function normalizeCareerSurveyQuestions(value: unknown): CareerSurveyQuestion[] {
  if (!Array.isArray(value)) return CAREER_SURVEY_QUESTIONS;

  const questions = value
    .map((item) => {
      if (typeof item !== "object" || item === null) return null;
      const record = item as Record<string, unknown>;
      const key = typeof record.key === "string" ? record.key.trim() : "";
      const label = typeof record.label === "string" ? record.label.trim() : "";
      const options = Array.isArray(record.options)
        ? record.options
            .map((option) => {
              if (typeof option !== "object" || option === null) return null;
              const optionRecord = option as Record<string, unknown>;
              const optionValue =
                typeof optionRecord.value === "string" ? optionRecord.value.trim() : "";
              const optionLabel =
                typeof optionRecord.label === "string" ? optionRecord.label.trim() : "";
              if (!optionValue || !optionLabel) return null;
              return { value: optionValue, label: optionLabel };
            })
            .filter((option): option is CareerSurveyOption => Boolean(option))
        : [];
      if (!key || !label || options.length === 0) return null;
      return { key, label, options };
    })
    .filter((question): question is CareerSurveyQuestion => Boolean(question));

  return questions.length > 0 ? questions : CAREER_SURVEY_QUESTIONS;
}

export function buildCareerSurveyQuestionMessage(
  question: CareerSurveyQuestion = CAREER_SURVEY_QUESTIONS[0],
  intro = ""
) {
  return {
    type: "text",
    text: `${intro ? `${intro}\n\n` : ""}${question.label}`,
    quickReply: {
      items: question.options.map((option) => ({
        type: "action",
        action: {
          type: "postback",
          label: option.label,
          data: `survey=${CAREER_SURVEY_KEY}&question=${question.key}&answer=${option.value}`,
          displayText: option.label
        }
      }))
    }
  };
}

export function buildLineMessages(diagnosis: Record<string, any>, appSettings: Record<string, any> = {}) {
  const result = diagnosis.result_payload || {};
  const jobCount = appSettings.job_count || Deno.env.get("DEFAULT_JOB_COUNT") || "12";
  const highMatchCount =
    appSettings.high_match_count || Deno.env.get("DEFAULT_HIGH_MATCH_COUNT") || "4";
  const jobs = Array.isArray(result.jobs) ? result.jobs.slice(0, 5).join(" / ") : "";
  const surveyQuestions = normalizeCareerSurveyQuestions(appSettings.surveyQuestions);

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
    },
    buildCareerSurveyQuestionMessage(
      surveyQuestions[0],
      `続けて、希望条件を${surveyQuestions.length}つだけ教えてください。`
    )
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

export async function replyLineMessages(replyToken: string, messages: unknown[]) {
  const channelAccessToken = Deno.env.get("LINE_CHANNEL_ACCESS_TOKEN");
  if (!channelAccessToken) {
    throw new Error("LINE_CHANNEL_ACCESS_TOKEN is required");
  }

  const response = await fetch("https://api.line.me/v2/bot/message/reply", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${channelAccessToken}`,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      replyToken,
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
