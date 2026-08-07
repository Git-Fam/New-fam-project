const ADMIN_SESSION_TTL_SECONDS = 8 * 60 * 60;

function base64UrlEncodeBytes(bytes: ArrayBuffer | Uint8Array) {
  const array = bytes instanceof Uint8Array ? bytes : new Uint8Array(bytes);
  let binary = "";
  array.forEach((byte) => {
    binary += String.fromCharCode(byte);
  });
  return btoa(binary).replaceAll("+", "-").replaceAll("/", "_").replace(/=+$/, "");
}

function base64UrlEncodeText(value: string) {
  return base64UrlEncodeBytes(new TextEncoder().encode(value));
}

function base64UrlDecodeBytes(value: string) {
  const normalized = value.replaceAll("-", "+").replaceAll("_", "/");
  const padded = normalized.padEnd(Math.ceil(normalized.length / 4) * 4, "=");
  const binary = atob(padded);
  return Uint8Array.from(binary, (char) => char.charCodeAt(0));
}

function base64UrlDecodeText(value: string) {
  return new TextDecoder().decode(base64UrlDecodeBytes(value));
}

async function importSessionKey(secret: string, usage: KeyUsage[]) {
  return crypto.subtle.importKey(
    "raw",
    new TextEncoder().encode(secret),
    { name: "HMAC", hash: "SHA-256" },
    false,
    usage
  );
}

async function signPayload(payload: string, secret: string) {
  const key = await importSessionKey(secret, ["sign"]);
  const signature = await crypto.subtle.sign("HMAC", key, new TextEncoder().encode(payload));
  return base64UrlEncodeBytes(signature);
}

async function verifyPayloadSignature(payload: string, signature: string, secret: string) {
  const key = await importSessionKey(secret, ["verify"]);
  return crypto.subtle.verify(
    "HMAC",
    key,
    base64UrlDecodeBytes(signature),
    new TextEncoder().encode(payload)
  );
}

export async function createAdminSessionToken() {
  const secret = Deno.env.get("ADMIN_SESSION_SECRET");
  if (!secret) throw new Error("ADMIN_SESSION_SECRET is required");

  const now = Date.now();
  const payload = base64UrlEncodeText(
    JSON.stringify({
      purpose: "admin",
      iat: now,
      exp: now + ADMIN_SESSION_TTL_SECONDS * 1000,
      nonce: crypto.randomUUID()
    })
  );

  return {
    sessionToken: `${payload}.${await signPayload(payload, secret)}`,
    expiresInSeconds: ADMIN_SESSION_TTL_SECONDS
  };
}

export async function hasValidAdminSession(request: Request) {
  const secret = Deno.env.get("ADMIN_SESSION_SECRET");
  if (!secret) return false;

  const token = request.headers.get("x-admin-session") || "";
  const parts = token.split(".");
  if (parts.length !== 2 || !parts[0] || !parts[1]) return false;

  try {
    const verified = await verifyPayloadSignature(parts[0], parts[1], secret);
    if (!verified) return false;

    const payload = JSON.parse(base64UrlDecodeText(parts[0]));
    return payload?.purpose === "admin" && Number(payload.exp || 0) > Date.now();
  } catch {
    return false;
  }
}
