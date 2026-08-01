import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token",
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

async function verifyLineSignature(body: string, signature: string | null) {
  const channelSecret = Deno.env.get("LINE_CHANNEL_SECRET");
  if (!channelSecret || !signature) return false;

  const encoder = new TextEncoder();
  const key = await crypto.subtle.importKey(
    "raw",
    encoder.encode(channelSecret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    ["sign"]
  );
  const digest = await crypto.subtle.sign("HMAC", key, encoder.encode(body));
  const expected = btoa(String.fromCharCode(...new Uint8Array(digest)));

  return expected === signature;
}

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

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
    const userAgent = request.headers.get("user-agent") || null;

    for (const event of body.events || []) {
      if (event.type === "follow") {
        const { error } = await supabase.from("diagnosis_events").insert({
          event_name: "line_friend_added",
          diagnosis_id: null,
          line_user_id: event.source?.userId || null,
          payload: event,
          user_agent: userAgent
        });

        if (error) console.warn("line_friend_added event insert failed", error);

        const { error: analyticsError } = await supabase.from("analytics_events").insert({
          event_name: "line_friend_added",
          line_user_id: event.source?.userId || null,
          payload: event,
          user_agent: userAgent
        });

        if (analyticsError) {
          console.warn("analytics_events insert failed", analyticsError);
        }
      }
    }

    return jsonResponse({ ok: true });
  } catch (error) {
    return jsonResponse({ error: errorMessage(error) }, 500);
  }
});
