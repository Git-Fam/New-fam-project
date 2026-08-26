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

function toPositiveCount(value: unknown) {
  const number = Number(value || 0);
  return Number.isFinite(number) && number > 0 ? number : 0;
}

function latestDateValue(current: unknown, next: unknown) {
  const currentDate = current ? new Date(String(current)).getTime() : 0;
  const nextDate = next ? new Date(String(next)).getTime() : 0;
  return nextDate > currentDate ? next : current;
}

function summarizeDropoffPositions(rows: any[]) {
  const map = new Map<number, Record<string, unknown>>();

  for (const row of rows) {
    const questionOrder = Math.floor(Number(row.question_order || 0));
    if (!questionOrder) continue;
    const current = map.get(questionOrder) || {
      question_order: questionOrder,
      total_questions: Number(row.total_questions || 0),
      dropoff_count: 0,
      last_counted_at: null
    };
    current.total_questions = Math.max(
      Number(current.total_questions || 0),
      Number(row.total_questions || 0)
    );
    current.dropoff_count = toPositiveCount(current.dropoff_count) + toPositiveCount(row.dropoff_count);
    current.last_counted_at = latestDateValue(current.last_counted_at, row.last_counted_at);
    map.set(questionOrder, current);
  }

  return Array.from(map.values())
    .sort(
      (a, b) =>
        toPositiveCount(b.dropoff_count) - toPositiveCount(a.dropoff_count) ||
        Number(a.question_order || 0) - Number(b.question_order || 0)
    )
    .slice(0, 20);
}

function summarizeDropoffQuestions(rows: any[]) {
  const map = new Map<string, Record<string, unknown>>();

  for (const row of rows) {
    const imageId = String(row.image_id || "").trim();
    if (!imageId) continue;
    const current = map.get(imageId) || {
      image_id: imageId,
      dropoff_count: 0,
      position_count: 0,
      first_question_order: null,
      last_question_order: null,
      last_counted_at: null
    };
    const questionOrder = Math.floor(Number(row.question_order || 0));
    current.dropoff_count = toPositiveCount(current.dropoff_count) + toPositiveCount(row.dropoff_count);
    current.position_count = toPositiveCount(current.position_count) + 1;
    if (questionOrder) {
      current.first_question_order = current.first_question_order
        ? Math.min(Number(current.first_question_order), questionOrder)
        : questionOrder;
      current.last_question_order = current.last_question_order
        ? Math.max(Number(current.last_question_order), questionOrder)
        : questionOrder;
    }
    current.last_counted_at = latestDateValue(current.last_counted_at, row.last_counted_at);
    map.set(imageId, current);
  }

  return Array.from(map.values())
    .sort(
      (a, b) =>
        toPositiveCount(b.dropoff_count) - toPositiveCount(a.dropoff_count) ||
        String(a.image_id || "").localeCompare(String(b.image_id || ""))
    )
    .slice(0, 20);
}

async function loadDropoffSummaries(supabase: ReturnType<typeof getSupabaseClient>) {
  const [positionsResult, questionsResult] = await Promise.all([
    supabase
      .from("dropoff_position_summary")
      .select("*")
      .order("dropoff_count", { ascending: false })
      .order("question_order", { ascending: true })
      .limit(20),
    supabase
      .from("dropoff_card_summary")
      .select("*")
      .order("dropoff_count", { ascending: false })
      .order("image_id", { ascending: true })
      .limit(20)
  ]);

  if (!positionsResult.error && !questionsResult.error) {
    return {
      dropoffPositions: positionsResult.data || [],
      dropoffQuestions: questionsResult.data || []
    };
  }

  console.warn("split dropoff summary lookup failed; falling back to legacy view", {
    positionError: positionsResult.error,
    questionError: questionsResult.error
  });

  const { data: legacyDropoffs, error: legacyError } = await supabase
    .from("dropoff_question_summary")
    .select("*")
    .range(0, 4999);
  if (legacyError) throw legacyError;

  const rows = legacyDropoffs || [];
  return {
    dropoffPositions: summarizeDropoffPositions(rows),
    dropoffQuestions: summarizeDropoffQuestions(rows)
  };
}

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
    const includeAdminLogs = requestUrl.searchParams.get("includeAdminLogs") === "1";
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

    const { dropoffPositions, dropoffQuestions } = await loadDropoffSummaries(supabase);

    const responseBody: Record<string, unknown> = {
      daily: daily || [],
      weekly: weekly || [],
      monthly: monthly || [],
      resultTypes: resultTypes || [],
      dropoffPositions,
      dropoffQuestions,
      dropoffs: dropoffPositions
    };

    if (includeAdminLogs) {
      const { data: adminLogs, error: adminLogsError } = await supabase
        .from("admin_audit_logs")
        .select("event_name, success, metadata, ip_address, created_at")
        .order("created_at", { ascending: false })
        .limit(50);
      if (adminLogsError) {
        console.warn("admin audit logs select failed", adminLogsError);
      } else {
        responseBody.adminLogs = adminLogs || [];
      }
    }

    return jsonResponse(responseBody);
  } catch (error) {
    return new Response(JSON.stringify({ error: errorMessage(error) }), {
      status: 500,
      headers: { ...corsHeaders, "Content-Type": "application/json" }
    });
  }
});
