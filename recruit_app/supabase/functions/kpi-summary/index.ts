/// <reference path="../_shared/edge-runtime.d.ts" />

import {
  corsHeaders,
  errorMessage,
  handleOptions,
  jsonResponse
} from "../_shared/cors.ts";
import { insertAdminAuditLog } from "../_shared/admin-audit.ts";
import { hasValidAdminSession } from "../_shared/admin-session.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

Deno.serve(async (request: Request) => {
  const options = handleOptions(request);
  if (options) return options;

  if (!(await hasValidAdminSession(request))) {
    return jsonResponse({ error: "Unauthorized" }, 401);
  }

  if (request.method !== "GET") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const requestUrl = new URL(request.url);
    const days = Math.max(1, Math.min(90, Number(requestUrl.searchParams.get("days") || 14)));
    const supabase = getSupabaseClient();

    await insertAdminAuditLog(supabase, request, "admin_kpi_view", {
      metadata: { days }
    });

    const { error: dropoffFinalizeError } = await supabase.rpc(
      "finalize_diagnosis_dropoffs",
      { abandoned_after: "00:30:00" }
    );
    if (dropoffFinalizeError) {
      console.warn("dropoff finalize failed", dropoffFinalizeError);
    }

    const { data: daily, error: dailyError } = await supabase
      .from("daily_kpi_summary")
      .select("*")
      .order("event_date", { ascending: false })
      .limit(days);
    if (dailyError) throw dailyError;

    const { data: weekly, error: weeklyError } = await supabase
      .from("weekly_kpi_summary")
      .select("*")
      .order("period_start", { ascending: false })
      .limit(12);
    if (weeklyError) throw weeklyError;

    const { data: monthly, error: monthlyError } = await supabase
      .from("monthly_kpi_summary")
      .select("*")
      .order("period_start", { ascending: false })
      .limit(13);
    if (monthlyError) throw monthlyError;

    const { data: resultTypes, error: resultTypesError } = await supabase
      .from("result_type_summary")
      .select("*")
      .limit(15);
    if (resultTypesError) throw resultTypesError;

    const { data: dropoffs, error: dropoffsError } = await supabase
      .from("dropoff_question_summary")
      .select("*")
      .limit(20);
    if (dropoffsError) throw dropoffsError;

    const { data: adminLogs, error: adminLogsError } = await supabase
      .from("admin_audit_logs")
      .select("event_name, success, metadata, ip_address, created_at")
      .order("created_at", { ascending: false })
      .limit(50);
    if (adminLogsError) {
      console.warn("admin audit logs select failed", adminLogsError);
    }

    return jsonResponse({
      daily: daily || [],
      weekly: weekly || [],
      monthly: monthly || [],
      resultTypes: resultTypes || [],
      dropoffs: dropoffs || [],
      adminLogs: adminLogsError ? [] : adminLogs || []
    });
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
