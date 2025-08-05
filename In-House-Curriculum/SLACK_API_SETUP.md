# Slack API 連携セットアップ

この機能は、Slack の全てのチャンネル名とそれぞれのメッセージ数を表示する WordPress ページです。**パブリックチャンネルとプライベートチャンネル（鍵付き）の両方を取得できます。**

## セットアップ手順

### 1. Slack App の作成

1. [Slack API Apps](https://api.slack.com/apps) にアクセス
2. "Create New App" をクリック
3. "From scratch" を選択
4. アプリ名を入力（例: "Channel Analytics"）
5. ワークスペースを選択

### 2. Bot Token Scopes の設定

1. 左メニューから "OAuth & Permissions" を選択
2. "Scopes" セクションの "Bot Token Scopes" に以下を追加：
   - `channels:read` - パブリックチャンネル一覧の取得
   - `groups:read` - **プライベートチャンネル（鍵付き）の取得**
   - `channels:history` - チャンネルのメッセージ履歴取得
   - `users:read` - ユーザー情報の取得

### 3. アプリをワークスペースにインストール

1. "OAuth & Permissions" ページで "Install to Workspace" をクリック
2. 権限を確認して "Allow" をクリック
3. "Bot User OAuth Token" をコピー（`xoxb-` で始まる）

### 4. Bot 名の確認

**Bot 名は、Slack App の設定で決まります。**

#### Bot 名の確認方法:

1. Slack App の管理画面で "Basic Information" を選択
2. "Display Name" または "Bot User Display Name" を確認
3. 通常は App Name と同じ名前になります

#### 例:

- App Name: "Channel Analytics"
- Bot 名: "Channel Analytics" または "channel-analytics"

### 5. プライベートチャンネル（鍵付き）へのアクセス設定

**重要:** プライベートチャンネルを取得するには、Bot を各プライベートチャンネルに招待する必要があります。

#### 手順:

1. 各プライベートチャンネルで `/invite @Bot名` を実行
   - 例: `/invite @Channel Analytics`
   - または: `/invite @channel-analytics`
2. Bot がチャンネルのメンバーになっていることを確認
3. ワークスペースの設定で Bot の権限が制限されていないことを確認

#### Bot 名がわからない場合:

1. Slack App の管理画面で "OAuth & Permissions" を選択
2. "Bot User OAuth Token" の下に "Bot User ID" が表示されます
3. または、ワークスペース内で `@` を入力して Bot 名を確認

### 6. WordPress での設定

#### 方法 1: 管理画面から設定（推奨）

1. WordPress 管理画面にログイン
2. "設定" → "Slack API 設定" をクリック
3. "Slack Bot Token" に先ほどコピーしたトークンを入力
4. "変更を保存" をクリック
5. "接続テスト" で成功することを確認
6. "プライベートチャンネルアクセス成功" のメッセージを確認

#### 方法 2: 定数で設定

`wp-config.php` に以下を追加：

```php
define('SLACK_BOT_TOKEN', 'xoxb-your-bot-token-here');
```

### 7. ページの確認

1. WordPress サイトで `/page-dummy/` にアクセス
2. Slack チャンネル一覧が表示されることを確認
3. プライベートチャンネル（🔒 マーク付き）も表示されることを確認

## 機能

- **チャンネル一覧表示**: 全てのパブリック・プライベートチャンネルを表示
- **メッセージ数**: 各チャンネルのメッセージ数を表示
- **メンバー数**: 各チャンネルのメンバー数を表示
- **チャンネルタイプ**: パブリック/プライベートの区別（🔒 マーク付き）
- **アーカイブ状態**: アーカイブ済みチャンネルの表示
- **統計情報**: 総チャンネル数、パブリック/プライベート別の統計
- **プライベートチャンネル**: 鍵付きチャンネルの詳細表示

## プライベートチャンネル（鍵付き）について

### 表示される情報

- 🔒 アイコンでプライベートチャンネルを識別
- チャンネル名、メッセージ数、メンバー数
- アーカイブ状態の表示

### アクセス権限

- Bot がチャンネルのメンバーである必要があります
- `/invite @Bot名` で Bot を招待してください
- ワークスペースの設定で Bot の権限が制限されていないことを確認

## Bot 名について

### Bot 名の決まり方

- **App Name**: Slack App を作成時に設定した名前
- **Bot 名**: 通常は App Name と同じ（ハイフン区切りになる場合もある）
- **表示名**: Slack App の "Basic Information" で設定可能

### Bot 名の確認方法

1. **Slack App 管理画面**: "Basic Information" → "Display Name"
2. **ワークスペース内**: `@` を入力して Bot 名を検索
3. **OAuth 設定**: "Bot User OAuth Token" の下に Bot User ID が表示

### 招待コマンドの例

```
/invite @Channel Analytics
/invite @channel-analytics
/invite @your-bot-name
```

## 注意事項

- Bot Token は機密情報です。GitHub などに公開しないよう注意してください
- **プライベートチャンネルにアクセスするには、Bot がそのチャンネルに招待されている必要があります**
- メッセージ数の取得には制限があります（1000 件以上は "1000+" と表示）
- API レート制限に注意してください
- プライベートチャンネルの情報は、Bot がメンバーになっているチャンネルのみ表示されます

## トラブルシューティング

### 接続エラーが発生する場合

1. Bot Token が正しく設定されているか確認
2. 必要な Scopes が設定されているか確認
3. アプリがワークスペースにインストールされているか確認
4. Bot がチャンネルにアクセス権限を持っているか確認

### プライベートチャンネルが表示されない場合

**最もよくある原因と解決方法:**

#### 1. Bot がプライベートチャンネルに招待されていない

**解決方法:**

- 各プライベートチャンネルで `/invite @Bot名` を実行
- Bot 名が正しいか確認（App Name と同じ場合が多い）

#### 2. Bot Token Scopes に `groups:read` が含まれていない

**解決方法:**

- Slack App の "OAuth & Permissions" で `groups:read` スコープを追加
- アプリを再インストール

#### 3. Bot 名が間違っている

**解決方法:**

- Slack App の "Basic Information" で "Display Name" を確認
- ワークスペース内で `@` を入力して Bot 名を検索
- App Name をそのまま使用してみる

#### 4. ワークスペースの設定で Bot の権限が制限されている

**解決方法:**

- ワークスペースの管理者に確認
- Bot の権限設定を確認

### デバッグ方法

#### WordPress 管理画面での確認

1. "設定" → "Slack API 設定" にアクセス
2. "デバッグ情報" セクションを確認
3. エラーメッセージを確認

#### よくあるエラーメッセージ

- **"missing_scope"** → 必要なスコープが不足
- **"channel_not_found"** → Bot がチャンネルに招待されていない
- **"access_denied"** → Bot の権限が制限されている

### 段階的な確認手順

1. **基本接続確認**

   - Bot Token が正しく設定されているか
   - 基本接続テストが成功するか

2. **Bot 権限確認**

   - Bot が正しく認識されているか
   - Bot の権限情報が取得できるか

3. **プライベートチャンネルアクセス確認**

   - `groups:read` スコープが設定されているか
   - プライベートチャンネルアクセステストが成功するか

4. **Bot 招待確認**
   - 各プライベートチャンネルで Bot が招待されているか
   - Bot がチャンネルのメンバーリストに表示されるか

### Bot 名がわからない場合

1. Slack App の管理画面で "Basic Information" を確認
2. "Display Name" または "Bot User Display Name" を確認
3. ワークスペース内で `@` を入力して Bot 名を検索
4. または、App Name をそのまま使用してみる

### よくある問題

- **"プライベートチャンネルへのアクセス権限がありません"** → Bot を各プライベートチャンネルに招待
- **"groups:read scope が必要です"** → Slack App の設定でスコープを追加
- **一部のプライベートチャンネルしか表示されない** → 表示されないチャンネルで Bot を招待
- **Bot 名が見つからない** → App Name をそのまま使用するか、ワークスペース内で確認

## ファイル構成

- `function/common/slack-api.php` - Slack API 連携機能
- `function/common/slack-config.php` - 設定管理機能
- `page-dummy.php` - 表示ページ

## カスタマイズ

### 表示項目の追加

`get_slack_channels_with_message_count()` 関数を編集して、追加の情報を取得できます。

### スタイルの変更

`page-dummy.php` 内の `<style>` タグを編集してデザインをカスタマイズできます。

### ページテンプレートの変更

`page-dummy.php` を別のページテンプレートとして使用する場合は、ファイル名を変更してください。

## セキュリティ

- Bot Token は機密情報です
- プライベートチャンネルの情報は適切に管理してください
- 必要に応じてアクセス権限を制限してください
