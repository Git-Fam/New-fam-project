/// <reference path="./edge-runtime.d.ts" />

import {
  createClient,
  type SupabaseClient
} from "https://esm.sh/@supabase/supabase-js@2";

export function getSupabaseClient() {
  const supabaseUrl = Deno.env.get("SUPABASE_URL");
  const secretKeys = Deno.env.get("SUPABASE_SECRET_KEYS");
  const legacyServiceRoleKey = Deno.env.get("SUPABASE_SERVICE_ROLE_KEY");
  const serviceRoleKey = secretKeys ? JSON.parse(secretKeys).default : legacyServiceRoleKey;

  if (!supabaseUrl || !serviceRoleKey) {
    throw new Error("SUPABASE_URL and service role key are required");
  }

  return createClient(supabaseUrl, serviceRoleKey, {
    auth: {
      persistSession: false
    }
  });
}

export async function insertEvent(
  supabase: SupabaseClient,
  eventName: string,
  options: {
    diagnosisId?: string | null;
    lineUserId?: string | null;
    visitorId?: string | null;
    sessionId?: string | null;
    funnelId?: string | null;
    resultType?: string | null;
    utmSource?: string | null;
    utmMedium?: string | null;
    utmCampaign?: string | null;
    deviceType?: string | null;
    pagePath?: string | null;
    payload?: Record<string, unknown>;
    request?: Request;
  } = {}
) {
  const userAgent = options.request?.headers.get("user-agent") || null;

  const { error } = await supabase.from("diagnosis_events").insert({
    event_name: eventName,
    diagnosis_id: options.diagnosisId || null,
    line_user_id: options.lineUserId || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (error) throw error;

  const { error: analyticsError } = await supabase.from("analytics_events").insert({
    event_name: eventName,
    diagnosis_id: options.diagnosisId || null,
    line_user_id: options.lineUserId || null,
    visitor_id: options.visitorId || null,
    session_id: options.sessionId || null,
    funnel_id: options.funnelId || null,
    result_type: options.resultType || options.payload?.resultType || null,
    utm_source: options.utmSource || null,
    utm_medium: options.utmMedium || null,
    utm_campaign: options.utmCampaign || null,
    device_type: options.deviceType || null,
    page_path: options.pagePath || null,
    payload: options.payload || {},
    user_agent: userAgent
  });

  if (analyticsError) {
    console.warn("analytics_events insert failed", analyticsError);
  }
}
