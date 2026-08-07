import type { SupabaseClient } from "https://esm.sh/@supabase/supabase-js@2";

export function getAdminClientInfo(request: Request) {
  const forwardedFor = request.headers.get("x-forwarded-for") || "";
  const ipAddress =
    forwardedFor.split(",")[0]?.trim() ||
    request.headers.get("cf-connecting-ip") ||
    request.headers.get("x-real-ip") ||
    "unknown";
  const userAgent = request.headers.get("user-agent") || null;

  return {
    ipAddress,
    userAgent,
    attemptKey: ipAddress
  };
}

export async function insertAdminAuditLog(
  supabase: SupabaseClient,
  request: Request,
  eventName: string,
  options: {
    success?: boolean;
    metadata?: Record<string, unknown>;
  } = {}
) {
  const clientInfo = getAdminClientInfo(request);
  const { error } = await supabase.from("admin_audit_logs").insert({
    event_name: eventName,
    success: options.success !== false,
    metadata: options.metadata || {},
    ip_address: clientInfo.ipAddress,
    user_agent: clientInfo.userAgent
  });

  if (error) {
    console.warn("admin audit insert failed", error);
  }
}
