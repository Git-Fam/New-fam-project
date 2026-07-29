/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { verifyLineSignature } from "../_shared/line.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const bodyText = await request.text();
    const signature = request.headers.get("x-line-signature");
    const valid = await verifyLineSignature(bodyText, signature);
    if (!valid) return jsonResponse({ error: "Invalid signature" }, 401);

    const body = JSON.parse(bodyText);
    const supabase = getSupabaseClient();

    for (const event of body.events || []) {
      if (event.type === "follow") {
        try {
          await insertEvent(supabase, "line_friend_added", {
            lineUserId: event.source?.userId || null,
            payload: event,
            request
          });
        } catch (eventError) {
          console.warn("line_friend_added event insert failed", eventError);
        }
      }
    }

    return jsonResponse({ ok: true });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
