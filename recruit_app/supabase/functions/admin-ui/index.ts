/// <reference path="../_shared/edge-runtime.d.ts" />

import { corsHeaders, handleOptions, jsonResponse } from "../_shared/cors.ts";
import { insertAdminAuditLog } from "../_shared/admin-audit.ts";
import { hasValidAdminSession } from "../_shared/admin-session.ts";
import { getSupabaseClient } from "../_shared/supabase.ts";

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
  const options = handleOptions(request);
  if (options) return options;

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
