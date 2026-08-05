# AIキャリア診断Webアプリ MVP

PDF要件に沿った、バニラHTML/CSS/JavaScriptのAIキャリア診断MVPです。

## 構成

- `index.html` - LP、ルール、スワイプ、分析演出、結果、求人導線
- `admin/index.html` - 比較人数、求人件数、診断結果文章、スワイプ画像、KPIの管理画面
- `config.js` - 公開ページ用の接続設定。`adminApiToken` は空
- `admin/config.js` - 管理画面用の接続設定。`adminApiToken` あり
- `src/data.js` - 40問カード、6軸、15タイプ診断マスタ
- `src/app.js` - スワイプ操作、スコア計算、画面遷移、保存/LINE導線
- `supabase/functions/*` - 診断保存、イベントログ、LINE Login、Messaging API、Webhook
- `supabase/migrations/*` - PostgreSQLテーブル定義

## ローカル起動

```bash
python3 -m http.server 4173
```

ブラウザで `http://localhost:4173/` を開きます。

`config.js` が未設定の場合、診断結果とイベントは `localStorage` に保存され、LINEボタンはデモとして結果画面に戻ります。

## 管理画面

`http://localhost:4173/admin/`

以下を変更できます。

- 「18,542人の診断データと比較中」の人数
- 紹介可能求人数、マッチ度90%以上の件数
- LINE登録後に結果を表示するか
- 診断結果マスタPDF相当の項目
- ResultType（判定キー、読み取り専用）
- タイプ名、キャッチコピー、説明文、強み、向いている仕事、おすすめ業界、LINE送信文
- 同タイプ割合
- 各カードの質問文、画像、管理用ラベル

`admin/config.js` の `supabaseFunctionsBaseUrl` が未設定の場合、変更内容はブラウザの `localStorage` に保存されます。
Supabase接続後は、管理画面の保存ボタンまたは「Supabaseへ全データ保存」でDBへ同期されます。
既存の上書きを消してPDFベースの初期値に戻す場合は、管理画面の「リセット」を使います。

## 本番アップロード

公開ページとしてアップするもの:

- `index.html`
- `line-complete.html`
- `config.js`
- `css/`
- `src/app.js`
- `src/data.js`
- `assets/`

管理画面も使う場合に `/admin/` としてアップするもの:

- `admin/index.html`
- `admin/config.js`
- `src/admin.js`

アップしないもの:

- `supabase/`
- `README.md`
- `編集.txt`
- `.vscode/`
- `.DS_Store`
- `package-lock.json`

公開用 `config.js` は `adminApiToken: ""` にします。
管理用 `admin/config.js` だけ `adminApiToken` を入れます。

## Supabase設定

現在のプロジェクトでは、DBテーブル、Storage bucket、管理マスタ保存、診断データ保存、イベントログ保存は設定済みです。

Supabase CLIは使わず、DashboardのEdge Functions Codeタブへ貼り付けてDeployする運用です。
DB定義の控えは `supabase/migrations/*` に残しています。

CLIで再構築する場合は以下を使います。

```bash
supabase db push
supabase functions deploy save-diagnosis
supabase functions deploy event-log
supabase functions deploy admin-master
supabase functions deploy line-login-url
supabase functions deploy line-callback
supabase functions deploy send-line-result
supabase functions deploy line-webhook
```

必要なSecrets:

```bash
supabase secrets set SUPABASE_URL="https://YOUR_PROJECT_REF.supabase.co"
supabase secrets set SUPABASE_SERVICE_ROLE_KEY="YOUR_SERVICE_ROLE_KEY"
supabase secrets set APP_ORIGIN="https://YOUR_DOMAIN"
supabase secrets set LINE_LOGIN_CHANNEL_ID="YOUR_LINE_LOGIN_CHANNEL_ID"
supabase secrets set LINE_LOGIN_CHANNEL_SECRET="YOUR_LINE_LOGIN_CHANNEL_SECRET"
supabase secrets set LINE_REDIRECT_URI="https://plhfwtnkdnybswkgqugk.supabase.co/functions/v1/line-callback"
supabase secrets set LINE_CHANNEL_ACCESS_TOKEN="YOUR_LINE_CHANNEL_ACCESS_TOKEN"
supabase secrets set LINE_CHANNEL_SECRET="YOUR_LINE_CHANNEL_SECRET"
supabase secrets set LINE_BOT_PROMPT="aggressive"
supabase secrets set ADMIN_API_TOKEN="任意の長い管理用トークン"
```

## フロント接続設定

公開ページ用 `config.js`:

```js
window.CAREER_APP_CONFIG = {
  supabaseFunctionsBaseUrl: "https://YOUR_PROJECT_REF.supabase.co/functions/v1",
  lineLoginChannelId: "YOUR_LINE_LOGIN_CHANNEL_ID",
  lineRedirectUri: "https://YOUR_PROJECT_REF.supabase.co/functions/v1/line-callback",
  adminApiToken: "",
  requireLineBeforeResult: true
};
```

管理画面用 `admin/config.js`:

```js
window.CAREER_APP_CONFIG = {
  supabaseFunctionsBaseUrl: "https://YOUR_PROJECT_REF.supabase.co/functions/v1",
  lineLoginChannelId: "YOUR_LINE_LOGIN_CHANNEL_ID",
  lineRedirectUri: "https://YOUR_PROJECT_REF.supabase.co/functions/v1/line-callback",
  adminApiToken: "ADMIN_API_TOKENと同じ値",
  requireLineBeforeResult: true
};
```

`adminApiToken` は管理画面からDBへ保存する時だけ使います。公開ページ用 `config.js` には入れません。

## LINE本連携

LINE Login と Messaging API は、同じLINE Developers Provider内で作成します。LINE Loginで取得したユーザーIDへMessaging APIでpush送信するため、LINE Loginチャネルの「リンクされたLINE公式アカウント」にMessaging APIのLINE公式アカウントを設定してください。

Supabase Secretsに入れる値:

- `APP_ORIGIN`: 公開するWebアプリのURL。ローカル確認なら `http://localhost:4174` など
- `LINE_LOGIN_CHANNEL_ID`: LINE LoginチャネルのChannel ID
- `LINE_LOGIN_CHANNEL_SECRET`: LINE LoginチャネルのChannel secret
- `LINE_REDIRECT_URI`: `https://plhfwtnkdnybswkgqugk.supabase.co/functions/v1/line-callback`
- `LINE_CHANNEL_ACCESS_TOKEN`: Messaging APIチャネルのChannel access token
- `LINE_CHANNEL_SECRET`: Messaging APIチャネルのChannel secret
- `LINE_BOT_PROMPT`: `aggressive` 推奨。ログイン後に友だち追加確認を表示します

LINE Developers側に設定するURL:

- LINE Login Callback URL: `https://plhfwtnkdnybswkgqugk.supabase.co/functions/v1/line-callback`
- Messaging API Webhook URL: `https://plhfwtnkdnybswkgqugk.supabase.co/functions/v1/line-webhook`

Dashboardだけで設定する場合は、Edge Functionsで以下の4つを作成し、Codeタブへ対応ファイルの中身を貼ってDeployします。

- Function名: `line-login-url`
  - 貼り付けるファイル: `supabase/dashboard/line-login-url-index.ts`
- Function名: `line-callback`
  - 貼り付けるファイル: `supabase/dashboard/line-callback-index.ts`
- Function名: `send-line-result`
  - 貼り付けるファイル: `supabase/dashboard/send-line-result-index.ts`
- Function名: `line-webhook`
  - 貼り付けるファイル: `supabase/dashboard/line-webhook-index.ts`

4つとも Settings の `Verify JWT with legacy secret` はOFFにします。

## 初回マスタ登録

SupabaseのmigrationとEdge Functionsを反映した後、管理画面を開いて「Supabaseへ全データ保存」を押します。
これで `data.js` の40問カード、15タイプ診断結果、表示数値がSupabaseへ登録されます。
現在のプロジェクトでは登録済みです。

## 診断データ保存

40枚のスワイプ完了後、ブラウザで計算した以下の診断データを `save-diagnosis` Edge Function 経由でSupabaseへ保存します。

- `answers`
- `scores`
- `scoreRates`
- `primaryAxis`
- `secondaryAxis`
- `resultType`
- `status`
- `expiresAt`

保存先は `diagnoses` テーブルです。診断完了イベントは `diagnosis_events` に保存します。

診断データの保存期間は以下です。

- `diagnoses`: 24時間
- `line_states`: 10分
- `diagnosis_events`: 90日
- `line_connections`: 180日

Edge Functionsで以下の2つを作成し、Codeタブへ対応ファイルの中身を貼ってDeployします。

- Function名: `save-diagnosis`
  - 貼り付けるファイル: `supabase/dashboard/save-diagnosis-index.ts`
- Function名: `event-log`
  - 貼り付けるファイル: `supabase/dashboard/event-log-index.ts`

公開ページから呼び出すFunctionなので、両方とも Settings の `Verify JWT with legacy secret` はOFFにします。

期限切れデータの自動削除はSupabase Cronで行います。
DashboardのSQL Editorで以下を実行します。

- `supabase/migrations/20260731000000_cleanup_expired_data.sql`

このSQLは `cleanup_ai_career_expired_data()` 関数を作成し、毎日04:17 JSTに実行するCron Jobを登録します。
手動確認する場合はSQL Editorで以下を実行します。

```sql
select public.cleanup_ai_career_expired_data();
```

## スワイプ画像アップロード

管理画面のスワイプ画像/質問内容では、画像URLの直接入力に加えてドラッグ&ドロップで画像をアップロードできます。
画像はブラウザ側で横幅最大1200pxのWebPへ軽量化してから Supabase Storage の `swipe-images` bucket に保存します。
DBには画像本体を保存せず、表示用URLとStorage内パスだけを保存します。
既存画像が同じ `swipe-images` bucket 内の画像だった場合は、カード保存のDB更新成功後に古いStorageファイルを削除します。

Storage bucket `swipe-images` と `swipe_cards.image_storage_path` は設定済みです。
`admin-master` を更新する場合は、Codeタブへ以下を貼り直してDeployします。

- `supabase/dashboard/admin-master-index.ts`

## イベントログ

以下のイベントを保存します。

- `lp_view`
- `diagnosis_start`
- `diagnosis_complete`
- `line_button_click`
- `line_login_success`
- `line_friend_added`
- `result_sent`

KPI集計はSQL Viewで確認します。
DashboardのSQL Editorで以下を実行します。

- `supabase/migrations/20260731001000_create_kpi_views.sql`

管理画面で視覚的に見る場合は、Edge Functionを追加してDeployします。

- Function名: `kpi-summary`
  - 貼り付けるファイル: `supabase/dashboard/kpi-summary-index.ts`

管理画面から呼び出すFunctionなので、Settings の `Verify JWT with legacy secret` はOFFにします。
代わりに `ADMIN_API_TOKEN` を `x-admin-token` で送って保護します。

主に見るView:

- `daily_kpi_summary`: 日別KPI
- `daily_event_counts`: 日別イベント数
- `result_type_summary`: 診断タイプ別件数

確認SQL:

```sql
select * from public.daily_kpi_summary order by event_date desc limit 14;
select * from public.result_type_summary;
```
