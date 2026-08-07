/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import {
  getAdminClientInfo,
  insertAdminAuditLog
} from "../_shared/admin-audit.ts";
import { createAdminSessionToken } from "../_shared/admin-session.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

const MAX_LOGIN_FAILURES = 5;
const LOGIN_WINDOW_MINUTES = 15;

function hasValidPassword(password: string) {
  const requiredPassword = Deno.env.get("ADMIN_LOGIN_PASSWORD");
  if (!requiredPassword) {
    throw new Error("ADMIN_LOGIN_PASSWORD is required");
  }
  return password === requiredPassword;
}

async function isLoginRateLimited(
  supabase: ReturnType<typeof getSupabaseClient>,
  attemptKey: string
) {
  const since = new Date(Date.now() - LOGIN_WINDOW_MINUTES * 60 * 1000).toISOString();
  const { count, error } = await supabase
    .from("admin_login_attempts")
    .select("id", { count: "exact", head: true })
    .eq("attempt_key", attemptKey)
    .eq("success", false)
    .gte("created_at", since);

  if (error) {
    console.warn("admin login rate limit check failed", error);
    return false;
  }

  return Number(count || 0) >= MAX_LOGIN_FAILURES;
}

async function recordLoginAttempt(
  supabase: ReturnType<typeof getSupabaseClient>,
  attemptKey: string,
  success: boolean
) {
  const { error } = await supabase.from("admin_login_attempts").insert({
    attempt_key: attemptKey,
    success
  });

  if (error) {
    console.warn("admin login attempt insert failed", error);
  }
}

async function clearFailedLoginAttempts(
  supabase: ReturnType<typeof getSupabaseClient>,
  attemptKey: string
) {
  const { error } = await supabase
    .from("admin_login_attempts")
    .delete()
    .eq("attempt_key", attemptKey)
    .eq("success", false);

  if (error) {
    console.warn("admin login attempts cleanup failed", error);
  }
}

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const supabase = getSupabaseClient();
    const { attemptKey } = getAdminClientInfo(request);
    const body = await request.json().catch(() => ({}));
    const password = String(body?.password || "");

    if (await isLoginRateLimited(supabase, attemptKey)) {
      await insertAdminAuditLog(supabase, request, "admin_login_rate_limited", {
        success: false,
        metadata: { windowMinutes: LOGIN_WINDOW_MINUTES, maxFailures: MAX_LOGIN_FAILURES }
      });
      return jsonResponse({ error: "Too many login attempts" }, 429);
    }

    if (!hasValidPassword(password)) {
      await recordLoginAttempt(supabase, attemptKey, false);
      await insertAdminAuditLog(supabase, request, "admin_login_failed", {
        success: false
      });
      return jsonResponse({ error: "Unauthorized" }, 401);
    }

    await recordLoginAttempt(supabase, attemptKey, true);
    await clearFailedLoginAttempts(supabase, attemptKey);
    await insertAdminAuditLog(supabase, request, "admin_login_success");

    return jsonResponse(await createAdminSessionToken());
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
