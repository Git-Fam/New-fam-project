/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";

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
  const options = handleOptions(request);
  if (options) return options;

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

    await insertEvent(supabase, body.eventName, {
      diagnosisId: body.diagnosisId || null,
      lineUserId: body.lineUserId || null,
      visitorId: body.visitorId || null,
      sessionId: body.sessionId || null,
      funnelId: body.funnelId || null,
      resultType: body.resultType || body.payload?.resultType || null,
      utmSource: body.utmSource || null,
      utmMedium: body.utmMedium || null,
      utmCampaign: body.utmCampaign || null,
      deviceType: body.deviceType || null,
      pagePath: body.pagePath || null,
      payload: body.payload || {},
      request
    });

    return jsonResponse({ ok: true });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
