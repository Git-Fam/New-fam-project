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
  "result_sent"
]);

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
    await insertEvent(supabase, body.eventName, {
      diagnosisId: body.diagnosisId || null,
      lineUserId: body.lineUserId || null,
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
