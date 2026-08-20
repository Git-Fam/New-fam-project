/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { getSupabaseClient, insertEvent } from "../_shared/supabase.ts";
import { buildLineMessages, pushLineMessages } from "../_shared/line.ts";

const LINKED_DIAGNOSIS_RETENTION_DAYS = 180;

type LineConnection = {
  lineUserId: string;
  userId: string | null;
  lineConnectionId: string | null;
  source: "line_connection" | "diagnosis";
};

function createLinkedDiagnosisExpiresAt() {
  return new Date(
    Date.now() + LINKED_DIAGNOSIS_RETENTION_DAYS * 24 * 60 * 60 * 1000
  ).toISOString();
}

type AppUser = {
  id: string;
  internal_user_id: string | null;
};

async function ensureAppUserByLineId(
  supabase: ReturnType<typeof getSupabaseClient>,
  lineUserId: string,
  currentUserId: string | null = null
): Promise<AppUser> {
  const now = new Date().toISOString();

  if (currentUserId) {
    const { data, error } = await supabase
      .from("app_users")
      .update({
        last_seen_at: now,
        updated_at: now
      })
      .eq("id", currentUserId)
      .select("id, internal_user_id")
      .maybeSingle();

    if (error) throw error;
    if (data?.id) return data;
  }

  const { data: existing, error: lookupError } = await supabase
    .from("app_users")
    .select("id, internal_user_id")
    .eq("line_user_id", lineUserId)
    .maybeSingle();

  if (lookupError) throw lookupError;

  if (existing?.id) {
    const { data, error } = await supabase
      .from("app_users")
      .update({
        last_seen_at: now,
        updated_at: now
      })
      .eq("id", existing.id)
      .select("id, internal_user_id")
      .single();

    if (error) throw error;
    return data;
  }

  const { data, error } = await supabase
    .from("app_users")
    .insert({
      line_user_id: lineUserId,
      first_seen_at: now,
      last_seen_at: now,
      created_at: now,
      updated_at: now
    })
    .select("id, internal_user_id")
    .single();

  if (error) throw error;
  return data;
}

async function saveUserDiagnosisRecord(
  supabase: ReturnType<typeof getSupabaseClient>,
  params: {
    diagnosisId: string;
    userId: string;
    lineUserId: string;
    context: Record<string, string | null>;
  }
) {
  const { data, error } = await supabase.rpc("upsert_user_diagnosis_record", {
    p_diagnosis_id: params.diagnosisId,
    p_user_id: params.userId,
    p_line_user_id: params.lineUserId,
    p_visitor_id: params.context.visitorId || null,
    p_session_id: params.context.sessionId || null,
    p_funnel_id: params.context.funnelId || null,
    p_utm_source: params.context.utmSource || null,
    p_utm_medium: params.context.utmMedium || null,
    p_utm_campaign: params.context.utmCampaign || null,
    p_device_type: params.context.deviceType || null,
    p_page_path: params.context.pagePath || null
  });

  if (error) {
    console.warn("user diagnosis record upsert failed", error);
    return null;
  }

  return data as string | null;
}

async function resolveLineConnection(
  supabase: ReturnType<typeof getSupabaseClient>,
  body: Record<string, string | null>
): Promise<LineConnection | null> {
  if (body.lineConnectionId) {
    const { data, error } = await supabase
      .from("line_connections")
      .select("id, line_user_id, user_id")
      .eq("id", body.lineConnectionId)
      .maybeSingle();

    if (!error && data?.line_user_id) {
      return {
        lineUserId: data.line_user_id,
        userId: data.user_id || null,
        lineConnectionId: data.id,
        source: "line_connection"
      };
    }

    if (error) console.warn("line_connections lookup failed", error);
  }

  if (!body.linkedDiagnosisId) return null;

  const { data, error } = await supabase
    .from("diagnoses")
    .select("id, line_user_id, user_id, status")
    .eq("id", body.linkedDiagnosisId)
    .maybeSingle();

  if (error || !data?.line_user_id) return null;
  if (!["linked", "sent"].includes(String(data.status))) return null;

  return {
    lineUserId: data.line_user_id,
    userId: data.user_id || null,
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

    const appUser = await ensureAppUserByLineId(
      supabase,
      connection.lineUserId,
      connection.userId
    );

    await supabase
      .from("diagnoses")
      .update({
        user_id: appUser.id,
        line_user_id: connection.lineUserId,
        status: "linked",
        expires_at: createLinkedDiagnosisExpiresAt()
      })
      .eq("id", diagnosisId);

    const { data: diagnosis, error: diagnosisError } = await supabase
      .from("diagnoses")
      .select("*")
      .eq("id", diagnosisId)
      .single();
    if (diagnosisError || !diagnosis) throw diagnosisError;

    const userDiagnosisRecordId = await saveUserDiagnosisRecord(supabase, {
      diagnosisId,
      userId: appUser.id,
      lineUserId: connection.lineUserId,
      context: body
    });

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
        line_sent_at: new Date().toISOString(),
        expires_at: createLinkedDiagnosisExpiresAt()
      })
      .eq("id", diagnosisId);

    if (connection.lineConnectionId) {
      await supabase
        .from("line_connections")
        .update({
          user_id: appUser.id,
          last_used_at: new Date().toISOString()
        })
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
          internalUserId: appUser.internal_user_id || null,
          userDiagnosisRecordId,
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
      internalUserId: appUser.internal_user_id || null,
      userDiagnosisRecordId,
      source: connection.source
    });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
