/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";
import { buildLineMessages, pushLineMessages } from "../_shared/line.ts";

type LineConnection = {
  lineUserId: string;
  lineConnectionId: string | null;
  source: "line_connection" | "diagnosis";
};

async function resolveLineConnection(
  supabase: ReturnType<typeof getSupabaseClient>,
  body: Record<string, string | null>
): Promise<LineConnection | null> {
  if (body.lineConnectionId) {
    const { data, error } = await supabase
      .from("line_connections")
      .select("id, line_user_id")
      .eq("id", body.lineConnectionId)
      .maybeSingle();

    if (!error && data?.line_user_id) {
      return {
        lineUserId: data.line_user_id,
        lineConnectionId: data.id,
        source: "line_connection"
      };
    }

    if (error) console.warn("line_connections lookup failed", error);
  }

  if (!body.linkedDiagnosisId) return null;

  const { data, error } = await supabase
    .from("diagnoses")
    .select("id, line_user_id, status")
    .eq("id", body.linkedDiagnosisId)
    .maybeSingle();

  if (error || !data?.line_user_id) return null;
  if (!["linked", "sent"].includes(String(data.status))) return null;

  return {
    lineUserId: data.line_user_id,
    lineConnectionId: null,
    source: "diagnosis"
  };
}

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  if (request.method !== "POST") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const body = await request.json();
    const diagnosisId = body.diagnosisId;
    if (!diagnosisId) return jsonResponse({ error: "diagnosisId is required" }, 400);

    const supabase = getSupabaseClient();
    const connection = await resolveLineConnection(supabase, {
      lineConnectionId: body.lineConnectionId || null,
      linkedDiagnosisId: body.linkedDiagnosisId || null
    });

    if (!connection) {
      return jsonResponse({ error: "Saved LINE connection was not found" }, 404);
    }

    await supabase
      .from("diagnoses")
      .update({
        line_user_id: connection.lineUserId,
        status: "linked"
      })
      .eq("id", diagnosisId);

    const { data: diagnosis, error: diagnosisError } = await supabase
      .from("diagnoses")
      .select("*")
      .eq("id", diagnosisId)
      .single();
    if (diagnosisError || !diagnosis) throw diagnosisError;

    const { data: appSettings } = await supabase
      .from("app_settings")
      .select("job_count, high_match_count")
      .eq("id", true)
      .maybeSingle();

    await pushLineMessages(connection.lineUserId, buildLineMessages(diagnosis, appSettings || {}));

    await supabase
      .from("diagnoses")
      .update({
        status: "sent",
        line_sent_at: new Date().toISOString()
      })
      .eq("id", diagnosisId);

    if (connection.lineConnectionId) {
      await supabase
        .from("line_connections")
        .update({ last_used_at: new Date().toISOString() })
        .eq("id", connection.lineConnectionId);
    }

    try {
      await insertEvent(supabase, "result_sent", {
        diagnosisId,
        lineUserId: connection.lineUserId,
        visitorId: body.visitorId || null,
        sessionId: body.sessionId || null,
        funnelId: body.funnelId || null,
        resultType: diagnosis.result_type || body.resultType || null,
        utmSource: body.utmSource || null,
        utmMedium: body.utmMedium || null,
        utmCampaign: body.utmCampaign || null,
        deviceType: body.deviceType || null,
        pagePath: body.pagePath || null,
        payload: {
          resultType: diagnosis.result_type,
          reusedLineConnection: true,
          source: connection.source
        },
        request
      });
    } catch (eventError) {
      console.warn("result_sent event insert failed", eventError);
    }

    return jsonResponse({
      status: "sent",
      diagnosisId,
      lineConnectionId: connection.lineConnectionId,
      source: connection.source
    });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
