import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-admin-token",
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
  if (typeof error === "object" && error !== null) return JSON.stringify(error);
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

function hasValidAdminToken(request: Request) {
  const requiredToken = Deno.env.get("ADMIN_API_TOKEN");
  if (!requiredToken) return true;
  return request.headers.get("x-admin-token") === requiredToken;
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (!hasValidAdminToken(request)) {
    return jsonResponse({ error: "Unauthorized" }, 401);
  }

  if (request.method !== "GET") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  try {
    const requestUrl = new URL(request.url);
    const days = Math.max(1, Math.min(90, Number(requestUrl.searchParams.get("days") || 14)));
    const supabase = getSupabaseClient();

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

    return jsonResponse({
      daily: daily || [],
      weekly: weekly || [],
      monthly: monthly || [],
      resultTypes: resultTypes || []
    });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
