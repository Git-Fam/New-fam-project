import { createClient } from "npm:@supabase/supabase-js@2";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers":
    "authorization, x-client-info, apikey, content-type, x-line-signature, x-admin-token, x-admin-session",
  "Access-Control-Allow-Methods": "GET, OPTIONS"
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

function getAdminClientInfo(request: Request) {
  const forwardedFor = request.headers.get("x-forwarded-for") || "";
  const ipAddress =
    forwardedFor.split(",")[0]?.trim() ||
    request.headers.get("cf-connecting-ip") ||
    request.headers.get("x-real-ip") ||
    "unknown";

  return {
    ipAddress,
    userAgent: request.headers.get("user-agent") || null
  };
}

async function insertAdminAuditLog(
  supabase: ReturnType<typeof createClient>,
  request: Request,
  eventName: string,
  options: { success?: boolean; metadata?: Record<string, unknown> } = {}
) {
  const clientInfo = getAdminClientInfo(request);
  const { error } = await supabase.from("admin_audit_logs").insert({
    event_name: eventName,
    success: options.success !== false,
    metadata: options.metadata || {},
    ip_address: clientInfo.ipAddress,
    user_agent: clientInfo.userAgent
  });

  if (error) console.warn("admin audit insert failed", error);
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

async function verifyPayloadSignature(payload: string, signature: string, secret: string) {
  const key = await importSessionKey(secret, ["verify"]);
  return crypto.subtle.verify(
    "HMAC",
    key,
    base64UrlDecodeBytes(signature),
    new TextEncoder().encode(payload)
  );
}

async function hasValidAdminSession(request: Request) {
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

const adminAppHtml = String.raw`
<main class="admin-main" id="adminApp">
  <header class="admin-header">
    <div>
      <p class="eyebrow">Admin</p>
      <h1>管理画面</h1>
    </div>
    <div class="admin-header-actions">
      <a class="secondary-button" href="../index.html">アプリへ戻る</a>
      <button class="secondary-button" id="adminLogout" type="button">ログアウト</button>
    </div>
  </header>

  <section class="admin-section kpi-section">
    <div class="admin-section-head">
      <div>
        <h2>KPI集計</h2>
        <p>診断体験のどこで離脱しているかを、日別・週別・月別で確認します。</p>
      </div>
      <button class="secondary-button" id="refreshKpi" type="button">更新</button>
    </div>

    <div class="kpi-card-grid" id="kpiSummaryCards">
      <div class="kpi-card"><span>LP表示</span><strong>-</strong><small>診断ページを開いた数</small></div>
      <div class="kpi-card"><span>診断開始率</span><strong>-</strong><small>LP表示 → 診断開始</small></div>
      <div class="kpi-card"><span>診断完了率</span><strong>-</strong><small>診断開始 → 出題分すべて完了</small></div>
      <div class="kpi-card"><span>LINE送信率</span><strong>-</strong><small>診断完了 → LINE送信</small></div>
    </div>

    <details class="kpi-help">
      <summary>KPIの見方</summary>
      <div class="kpi-help-body">
        <p>各数字は、同じ診断で何度も表示・クリックされた場合でも1件として集計します。</p>
        <dl class="kpi-help-list">
          <div>
            <dt>LP</dt>
            <dd>診断ページを開いた数。SNSや広告からどれくらい流入したかを見る数字です。</dd>
          </div>
          <div>
            <dt>開始</dt>
            <dd>診断スタートを押してスワイプを始めた数です。</dd>
          </div>
          <div>
            <dt>完了</dt>
            <dd>出題対象のカードをすべてスワイプして診断が完了した数です。</dd>
          </div>
          <div>
            <dt>結果表示</dt>
            <dd>診断結果画面まで到達した数です。LINE登録前に結果を出す設定の時に増えます。</dd>
          </div>
          <div>
            <dt>LINE押下</dt>
            <dd>「LINEで詳細を見る」を押した数です。LINE登録意欲を見る数字です。</dd>
          </div>
          <div>
            <dt>送信</dt>
            <dd>LINE認証後、診断結果や求人情報をLINEへ送信できた数です。</dd>
          </div>
          <div>
            <dt>シェア</dt>
            <dd>XまたはLINEのシェアボタンを押した数です。</dd>
          </div>
        </dl>
        <dl class="kpi-help-list">
          <div>
            <dt>開始率</dt>
            <dd>LPを見た人のうち、診断を始めた割合です。</dd>
          </div>
          <div>
            <dt>完了率</dt>
            <dd>診断を始めた人のうち、出題分を最後までスワイプした割合です。</dd>
          </div>
          <div>
            <dt>結果到達率</dt>
            <dd>診断完了後、結果画面まで到達した割合です。</dd>
          </div>
          <div>
            <dt>送信率</dt>
            <dd>診断完了後、LINEで結果送信まで完了した割合です。</dd>
          </div>
          <div>
            <dt>シェア率</dt>
            <dd>結果を見た人のうち、シェアボタンを押した割合です。</dd>
          </div>
        </dl>
      </div>
    </details>

    <div class="kpi-range-tabs" aria-label="集計期間">
      <button class="is-active" type="button" data-kpi-range="daily">日別</button>
      <button type="button" data-kpi-range="weekly">週別</button>
      <button type="button" data-kpi-range="monthly">月別</button>
    </div>

    <div class="kpi-layout">
      <div class="kpi-panel">
        <h3 id="kpiTableTitle">日別KPI</h3>
        <div class="kpi-table-wrap" id="kpiDailyTable"></div>
      </div>
      <div class="kpi-panel">
        <h3>診断タイプ分布</h3>
        <div class="kpi-result-list" id="kpiResultTypes"></div>
      </div>
      <div class="kpi-panel">
        <h3>離脱が多い設問</h3>
        <p class="kpi-panel-note">診断開始後、30分以上進捗が止まったものを離脱として集計します。</p>
        <div class="kpi-result-list" id="kpiDropoffs"></div>
      </div>
      <div class="kpi-panel kpi-panel-wide">
        <h3>管理操作ログ</h3>
        <p class="kpi-panel-note">ログイン、管理画面表示、保存、画像アップロード、KPI閲覧の直近50件です。</p>
        <div class="kpi-table-wrap" id="adminAuditLogTable"></div>
      </div>
    </div>
  </section>

  <section class="admin-section admin-user-section">
    <div class="admin-section-head">
      <div>
        <h2>ユーザー情報</h2>
        <p>LINE連携済みユーザーごとに、診断結果・希望条件・会話履歴・AI状態・相談ステータスを確認します。</p>
      </div>
      <button class="secondary-button" id="refreshAdminUsers" type="button">更新</button>
    </div>

    <p class="admin-user-note">
      表示対象は直近のユーザー最大50件です。会話履歴は選択ユーザーの直近30件だけ表示します。
    </p>
    <p class="admin-status" id="adminUserStatus" role="status"></p>

    <div class="admin-user-layout">
      <aside class="admin-user-list-panel">
        <h3>ユーザー一覧</h3>
        <div class="admin-user-list" id="adminUserList"></div>
      </aside>

      <div class="admin-user-detail">
        <div class="admin-user-overview" id="adminUserOverview"></div>
        <div class="admin-user-tabs" aria-label="ユーザー情報カテゴリ">
          <button class="is-active" type="button" data-admin-user-tab="diagnoses">診断結果</button>
          <button type="button" data-admin-user-tab="preferences">LINE情報</button>
          <button type="button" data-admin-user-tab="ai">AI状態</button>
          <button type="button" data-admin-user-tab="handoffs">相談</button>
          <button type="button" data-admin-user-tab="conversations">会話履歴</button>
        </div>
        <div class="admin-user-tab-panels">
          <section class="admin-user-panel is-active" data-admin-user-panel="diagnoses">
            <h3>診断結果</h3>
            <div id="adminUserDiagnoses"></div>
          </section>
          <section class="admin-user-panel" data-admin-user-panel="preferences">
            <h3>LINE追加取得情報</h3>
            <div id="adminUserPreferences"></div>
            <div id="adminUserSurveyAnswers"></div>
          </section>
          <section class="admin-user-panel" data-admin-user-panel="ai">
            <h3>AI会話状態</h3>
            <div id="adminUserAiState"></div>
          </section>
          <section class="admin-user-panel" data-admin-user-panel="handoffs">
            <h3>相談ステータス</h3>
            <div id="adminUserHandoffs"></div>
          </section>
          <section class="admin-user-panel admin-user-panel-wide" data-admin-user-panel="conversations">
            <h3>LINE会話履歴</h3>
            <div id="adminUserConversations"></div>
          </section>
        </div>
      </div>
    </div>
  </section>

  <section class="admin-section line-survey-section">
    <div class="admin-section-head">
      <div>
        <h2>LINEアンケート設定</h2>
        <p>LINEで聞く4問の質問文・選択肢・表示順を変更します。保存キーはDB保存先に紐づくため固定です。</p>
      </div>
      <button class="secondary-button" id="saveLineSurvey" type="button">アンケート設定を保存</button>
    </div>

    <div class="line-survey-layout">
      <aside class="line-survey-list" id="lineSurveyQuestionList"></aside>
      <div class="line-survey-editor">
        <label>
          保存キー
          <input id="lineSurveyKeyInput" type="text" readonly />
        </label>
        <label>
          表示順
          <input id="lineSurveySortInput" type="number" min="1" step="1" />
        </label>
        <label>
          質問文
          <input id="lineSurveyLabelInput" type="text" maxlength="120" />
        </label>
        <label>
          選択肢（1行に1つ）
          <textarea id="lineSurveyOptionsInput" rows="6"></textarea>
          <small class="form-note">LINEの選択肢ラベルは20文字以内にしてください。保存時に内部valueは自動生成されます。</small>
        </label>
      </div>
    </div>
  </section>

  <section class="admin-section">
    <h2>表示数値</h2>
    <div class="form-grid">
      <label>
        現在の比較人数
        <input id="comparisonCountInput" type="number" min="0" step="1" />
      </label>
      <label>
        増える間隔（時間）
        <input id="comparisonIntervalInput" type="number" min="0" step="0.1" />
      </label>
      <label>
        増える人数
        <input id="comparisonIncrementInput" type="number" min="0" step="1" />
      </label>
      <label>
        診断で出題する質問数
        <input id="diagnosisQuestionCountInput" type="number" min="1" step="1" />
        <small class="form-note" id="diagnosisQuestionCountHelp">出題候補からランダムで出題します。</small>
      </label>
      <label>
        紹介可能求人数
        <input id="jobCountInput" type="number" min="0" step="1" />
      </label>
      <label>
        マッチ度90%以上
        <input id="highMatchCountInput" type="number" min="0" step="1" />
      </label>
      <label class="checkbox-label">
        <input id="requireLineInput" type="checkbox" />
        LINE登録後に結果を表示
      </label>
    </div>
    <button class="primary-button" id="saveGeneral" type="button">保存</button>
  </section>

  <section class="admin-section">
    <h2>診断結果文章</h2>
    <label>
      タイプ
      <select id="resultSelect"></select>
    </label>
    <div class="admin-type-list" id="resultTypeList" aria-label="診断結果タイプ一覧"></div>
    <label>
      ResultType（判定キー）
      <input id="resultTypeKeyInput" type="text" readonly />
    </label>
    <label>
      タイプ名
      <input id="resultNameInput" type="text" />
    </label>
    <label>
      キャッチコピー
      <input id="resultCatchInput" type="text" />
    </label>
    <label>
      説明文
      <textarea id="resultDescriptionInput" rows="5"></textarea>
    </label>
    <label>
      強み（1行に1つ）
      <textarea id="resultStrengthsInput" rows="5"></textarea>
    </label>
    <label>
      向いている仕事（1行に1つ）
      <textarea id="resultJobsInput" rows="5"></textarea>
    </label>
    <label>
      おすすめ業界（1行に1つ）
      <textarea id="resultIndustriesInput" rows="5"></textarea>
    </label>
    <label>
      LINE送信文
      <textarea id="resultLineInput" rows="3"></textarea>
    </label>
    <label>
      同タイプ割合（%）
      <input id="resultPercentInput" type="number" min="1" max="99" step="1" />
    </label>
    <button class="primary-button" id="saveResult" type="button">結果文章を保存</button>
  </section>

  <section class="admin-section">
    <h2>スワイプ画像/質問内容</h2>
    <label>
      カード
      <select id="cardSelect"></select>
    </label>
    <div class="admin-card-toolbar">
      <p>出題候補: <strong id="activeCardCount">40</strong>問</p>
      <div class="admin-card-toolbar-actions">
        <button class="secondary-button" id="addCard" type="button">新規質問を追加</button>
        <button class="secondary-button danger-button" id="deleteCard" type="button">選択中の質問を削除</button>
        <button class="secondary-button" id="saveCardActivation" type="button">出題設定を保存</button>
      </div>
    </div>
    <div class="admin-type-list admin-card-list" id="cardList" aria-label="スワイプカード一覧"></div>
    <label>
      質問文
      <textarea id="cardQuestionInput" rows="3"></textarea>
    </label>
    <label>
      画像URL
      <input id="cardImageInput" type="url" />
    </label>
    <input id="cardImageStoragePathInput" type="hidden" />
    <div class="image-dropzone" id="cardImageDropzone" role="button" tabindex="0">
      <strong>画像をドラッグ&ドロップ</strong>
      <span>またはクリックして画像を選択（JPG / PNG / WebP、自動でWebP軽量化）</span>
      <input id="cardImageFileInput" type="file" accept="image/jpeg,image/png,image/webp" />
    </div>
    <label>
      管理用ラベル
      <input id="cardVisualInput" type="text" />
    </label>
    <div class="admin-preview" id="cardPreview"></div>
    <button class="primary-button" id="saveCard" type="button">画像を保存</button>
  </section>

  <section class="admin-section">
    <h2>設定データ</h2>
    <div class="admin-actions">
      <button class="secondary-button" id="syncSupabase" type="button">Supabaseへ全データ保存</button>
      <button class="secondary-button" id="exportSettings" type="button">書き出し</button>
      <button class="secondary-button" id="importSettings" type="button">読み込み</button>
      <button class="text-button danger-text" id="resetSettings" type="button">リセット</button>
    </div>
    <textarea id="settingsJson" rows="8" spellcheck="false"></textarea>
    <p class="admin-status" id="adminStatus" role="status"></p>
  </section>
</main>
`;

Deno.serve(async (request: Request) => {
  if (request.method === "OPTIONS") {
    return new Response("ok", { headers: corsHeaders });
  }

  if (!(await hasValidAdminSession(request))) {
    return jsonResponse({ error: "Unauthorized" }, 401);
  }

  if (request.method !== "GET") {
    return jsonResponse({ error: "Method not allowed" }, 405);
  }

  await insertAdminAuditLog(getSupabaseClient(), request, "admin_ui_view");

  return new Response(adminAppHtml, {
    headers: {
      ...corsHeaders,
      "Content-Type": "text/html; charset=utf-8",
      "Cache-Control": "no-store",
      "X-Robots-Tag": "noindex, nofollow, noarchive"
    }
  });
});
