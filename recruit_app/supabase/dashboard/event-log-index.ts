import { createClient } from "npm:@supabase/supabase-js@2";

const allowedEvents = new Set([
  "lp_view",
  "diagnosis_start",
  "diagnosis_complete",
  "line_button_click",
  "line_login_success",
  "line_friend_added",
  "result_sent",
  "result_view",
  "diagnosis_progress",
  "jobs_view",
  "share_click",
  "retry_click"
]);

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS"
};

function jsonResponse(body: unknown, status = 200) {
  return new Response(JSON.stringify(body), {
    status,
    headers: {
      ...corsHeaders,
      "Content-Type": "application/json"
    }
  });
}

function errorMessage(error: unknown) {
  if (error instanceof Error) return error.message;
  if (typeof error === "object" && error !== null) {
    return JSON.stringify(error);
  }
  return String(error);
}

function getSupabaseClient() {
  const secretKeys = Deno.env.get("SUPABASE_SECRET_KEYS");
  const legacyServiceRoleKey = Deno.env.get("SUPABASE_SERVICE_ROLE_KEY");
  const serviceRoleKey = secretKeys ? JSON.parse(secretKeys).default : legacyServiceRoleKey;
  const supabaseUrl = Deno.env.get("SUPABASE_URL");

  if (!supabaseUrl || !serviceRoleKey) {
    throw new Error("SUPABASE_URL and service role key are required");
  }

  return createClient(supabaseUrl, serviceRoleKey, {
    auth: { persistSession: false }
  });
}

function numberOrNull(value: unknown) {
  const numberValue = Number(value);
  return Number.isFinite(numberValue) ? numberValue : null;
}

async function syncDiagnosisProgress(
  supabase: ReturnType<typeof getSupabaseClient>,
  eventName: string,
  body: Record<string, unknown>
) {
  const payload = (body.payload || {}) as Record<string, unknown>;
  const funnelId = String(body.funnelId || payload.funnelId || "");
  if (!funnelId) return;

  if (eventName === "diagnosis_complete") {
    const { error } = await supabase
      .from("diagnosis_progress_sessions")
      .delete()
      .eq("funnel_id", funnelId);
    if (error) throw error;
    return;
  }

  if (eventName !== "diagnosis_start" && eventName !== "diagnosis_progress") return;

  const totalQuestions =
    numberOrNull(payload.totalQuestions) || numberOrNull(payload.cardCount) || 1;
  const currentOrder =
    numberOrNull(payload.currentOrder) || (eventName === "diagnosis_start" ? 1 : null);
  const lastAnsweredOrder =
    numberOrNull(payload.lastAnsweredOrder) || (eventName === "diagnosis_start" ? 0 : null);

  const row: Record<string, unknown> = {
    funnel_id: funnelId,
    visitor_id: body.visitorId || null,
    session_id: body.sessionId || null,
    diagnosis_id: body.diagnosisId || null,
    status: "in_progress",
    total_questions: Math.max(1, totalQuestions),
    result_type: body.resultType || payload.resultType || null,
    device_type: body.deviceType || null,
    updated_at: new Date().toISOString()
  };

  if (currentOrder !== null) {
    row.current_order = Math.max(1, currentOrder);
  }
  if (lastAnsweredOrder !== null) {
    row.last_answered_order = Math.max(0, lastAnsweredOrder);
  }
  if ("currentImageId" in payload) {
    row.current_image_id = payload.currentImageId || null;
  }
  if ("lastAnsweredImageId" in payload) {
    row.last_answered_image_id = payload.lastAnsweredImageId || null;
  }

  const { error } = await supabase
    .from("diagnosis_progress_sessions")
    .upsert(row, { onConflict: "funnel_id" });
  if (error) throw error;
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    if (!allowedEvents.has(body.eventName)) {
      return jsonResponse({ error: "Unknown event" }, 400);
    }

    const supabase = getSupabaseClient();
    try {
      await syncDiagnosisProgress(supabase, body.eventName, body);
    } catch (progressError) {
      console.warn("diagnosis progress sync failed", progressError);
    }

    if (body.eventName === "diagnosis_progress") {
      return jsonResponse({ ok: true });
    }

    const userAgent = request.headers.get("user-agent") || null;
    const { error } = await supabase.from("diagnosis_events").insert({
      event_name: body.eventName,
      diagnosis_id: body.diagnosisId || null,
      line_user_id: body.lineUserId || null,
      payload: body.payload || {},
      user_agent: userAgent
    });

    if (error) throw error;

    const { error: analyticsError } = await supabase.from("analytics_events").insert({
      event_name: body.eventName,
      diagnosis_id: body.diagnosisId || null,
      line_user_id: body.lineUserId || null,
      visitor_id: body.visitorId || null,
      session_id: body.sessionId || null,
      funnel_id: body.funnelId || null,
      result_type: body.resultType || body.payload?.resultType || null,
      utm_source: body.utmSource || null,
      utm_medium: body.utmMedium || null,
      utm_campaign: body.utmCampaign || null,
      device_type: body.deviceType || null,
      page_path: body.pagePath || null,
      payload: body.payload || {},
      user_agent: userAgent
    });

    if (analyticsError) {
      console.warn("analytics_events insert failed", analyticsError);
    }

    return jsonResponse({ ok: true });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
