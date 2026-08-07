/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    if (!body.resultType) {
      return jsonResponse({ error: "resultType is required" }, 400);
    }

    const supabase = getSupabaseClient();
    const expiresAt =
      body.expiresAt || new Date(Date.now() + 24 * 60 * 60 * 1000).toISOString();
    const answers = Array.isArray(body.answers) ? body.answers : [];

    const { data, error } = await supabase
      .from("diagnoses")
      .insert({
        answers,
        scores: body.scores || {},
        score_rates: body.scoreRates || {},
        primary_axis: body.primaryAxis,
        secondary_axis: body.secondaryAxis,
        result_type: body.resultType,
        result_payload: body.resultPayload || {},
        status: body.status || "waiting_for_line",
        expires_at: expiresAt
      })
      .select("id, created_at, expires_at")
      .single();

    if (error) throw error;

    if (body.funnelId) {
      const { error: progressDeleteError } = await supabase
        .from("diagnosis_progress_sessions")
        .delete()
        .eq("funnel_id", body.funnelId);

      if (progressDeleteError) {
        console.warn("diagnosis progress delete failed", progressDeleteError);
      }
    }

    try {
      await insertEvent(supabase, "diagnosis_complete", {
        diagnosisId: data.id,
        visitorId: body.visitorId || null,
        sessionId: body.sessionId || null,
        funnelId: body.funnelId || null,
        resultType: body.resultType || null,
        utmSource: body.utmSource || null,
        utmMedium: body.utmMedium || null,
        utmCampaign: body.utmCampaign || null,
        deviceType: body.deviceType || null,
        pagePath: body.pagePath || null,
        payload: {
          resultType: body.resultType,
          answeredCount: answers.length,
          totalResponseTime: answers.reduce(
            (sum: number, answer: { responseTime?: number }) => sum + Number(answer.responseTime || 0),
            0
          )
        },
        request
      });
    } catch (eventError) {
      console.warn("diagnosis_complete event insert failed", eventError);
    }

    return jsonResponse({
      diagnosisId: data.id,
      createdAt: data.created_at,
      expiresAt: data.expires_at
    });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
