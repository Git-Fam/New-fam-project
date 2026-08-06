# Figma フォント・カラー仕様抽出（HPページ / PC版）

対象: Figmaファイル「HP」ページ内の TOP／CONTACT／THANKS／ABOUT／SERVICE（PC版のみ。SPは今回対象外）
取得方法: `get_design_context` によるノード単位の実測値（Figma参照コードから抽出）

---

## 0. 全体まとめ

### フォントファミリー（3系統）

| ファミリー | 主な用途 | 使用ウェイト |
|---|---|---|
| **A P-OTF A1Gothic StdN** | 大見出し・リード文・本文（和文メイン） | Medium / Bold / Regular |
| **Noto Sans JP** | ラベル・キャプション・カード見出し・補足文・本文サブ | Light / Regular / Medium / Bold / Black |
| **Inter** | 英字ロゴ「aitec」・矢印記号「→」・数字番号 | Medium / Bold |

### 文字色（3色のみ・全ページ共通）

| 色 | 用途 |
|---|---|
| `#1a1a1a` | 見出し・本文・ロゴ・ナビなど主要テキスト |
| `#6b6b6b` | ラベル（英字小見出し）・補足文・サブテキスト |
| `#ffffff` | ボタン内テキスト（濃色背景ボタン用） |

> 変数（Figma Variables）は未使用。すべて色・タイポグラフィともにハードコード値。

---

## 1. 共通パーツ（ヘッダー・フッター）

TOP／CONTACT／THANKS／ABOUT／SERVICEの全ページで共通。

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| ヘッダーロゴ「aitec」 | Inter | 23.994px | Bold (700) | 45px | 0.48px | #1a1a1a |
| ヘッダーナビ「サービス」「会社概要」 | A P-OTF A1Gothic StdN (B) | 14.089px | Bold相当 | 26px | 0.84px | #1a1a1a |
| ヘッダーCTAボタン「お問い合わせ」 | A P-OTF A1Gothic StdN (B) | 13.039px | Bold相当 | 24px | 1.04px | #ffffff |
| フッターロゴ「aitec」 | Inter | 21.503px | Bold (700) | 41px | 不明（指定なし） | #1a1a1a |
| フッターナビ「サービス」「会社概要」「採用情報」 | A P-OTF A1Gothic StdN (B) | 14.089px | Bold相当 | 26px | 0.84px | #1a1a1a |
| フッターコピーライト「©aitec.inc」 | Noto Sans JP (Regular) | 12.983px | Regular (400) | 24px | 1.2983px | #6b6b6b |

---

## 2. TOPページ

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| ヒーロー見出し「営業の未来を、テクノロジーで…」 | A P-OTF A1Gothic StdN (M) | 64px | Medium相当 | 85px | 1.04px | #1a1a1a |
| ヒーロー本文 | A P-OTF A1Gothic StdN (M) | 18px | Medium相当 | 30px | 1.8px | #1a1a1a |
| ヒーローリンク「私たちについて見る」 | Noto Sans JP (Black) | 13.102px | Black (900) | 24px | 1.3102px | #1a1a1a |
| ヒーローリンク矢印「→」 | Inter (Medium) | 14px | Medium (500) | 26px | 1.04px | #1a1a1a |
| ヒーロー下部注記文 | A P-OTF A1Gothic StdN (Regular) | 10px | Regular (400) | 不明（normal） | 2.36px | #6b6b6b |
| OUR BUSINESSラベル | Noto Sans JP (Medium) | 16px | Medium (500) | 22px | 1.6px | #6b6b6b |
| 事業内容見出し「事業内容」 | A P-OTF A1Gothic StdN (Bold) | 36px | Bold (700) | 64px | 2.36px | #1a1a1a |
| 事業内容 番号「01〜04」 | A P-OTF A1Gothic StdN (Bold) | 32px | Bold (700) | 53px | 0.56px | #1a1a1a |
| 事業内容 各項目タイトル | Noto Sans JP (Black) | 20px | Black (900) | 32px | 0.6px | #1a1a1a |
| 事業内容 各項目本文 | Noto Sans JP (Regular) | 16px | Regular (400) | 26px | 1.6px | #6b6b6b |
| 事業内容リンク「サービス詳細を見る」＋矢印 | 不明（クラス指定なし） | 13.039px／14px | 不明 | 24px／26px | 不明 | #1a1a1a |
| WHO WE AREラベル | Noto Sans JP (Medium) | 16px | Medium (500) | 22px | 1.6px | #6b6b6b |
| WHO WE ARE見出し「Technology for Business Growth.」 | A P-OTF A1Gothic StdN (Bold) | 48px | Bold (700) | 74px | 1.36px | #1a1a1a |
| WHO WE ARE本文 | A P-OTF A1Gothic StdN (M) | 24px | Medium相当 | 40px | 2.4px | #1a1a1a |
| WHO WE AREリンク「企業理念を見る」 | Noto Sans JP (Medium) | 13.037px | 不明 | 24px | 1.3037px | #1a1a1a |
| WHO WE AREリンク矢印「→」 | Inter (Medium) | 14px | 不明 | 26px | 1.04px | #1a1a1a |
| OUR STRENGTHラベル | Noto Sans JP (Medium) | 16px | Medium (500) | 22px | 1.6px | #6b6b6b |
| 見出し「aitecの強み」 | A P-OTF A1Gothic StdN (Bold) | 36px | Bold (700) | 64px | 2.36px | #1a1a1a |
| 強み4項目タイトル（完全自社開発／現場目線のUI・UX 等） | Noto Sans JP (Black) | 20px | Black (900) | 32px | 2px | #1a1a1a |
| 強み4項目本文 | Noto Sans JP (Regular) | 16px | Regular (400) | 26px | 1.6px | #6b6b6b |
| CTA見出し「営業DXを、もっとシンプルに。」 | A P-OTF A1Gothic StdN (M) | 36px | Medium相当 | 53px | 1.12px | #1a1a1a |
| CTA本文 | Noto Sans JP (Regular) | 16px | Regular (400) | 30px | 1.6px | #6b6b6b |
| CTAボタン「お問い合わせはこちら」＋矢印 | A P-OTF A1Gothic StdN (M) ／ Inter (Medium) | 13.039px／14px | Medium相当 | 24px／26px | 不明 | #ffffff |
| ミニCONTACTラベル | Noto Sans JP (Medium) | 16px | Medium (500) | 22px | 1.6px | #6b6b6b |
| ミニCONTACT本文 | A P-OTF A1Gothic StdN (Bold) | 16px | Bold (700) | 30px | 1.6px | #1a1a1a |
| ミニCONTACT見出し「お問い合わせ」 | A P-OTF A1Gothic StdN (Bold) | 48px | Bold (700) | 76px | 1.6px | #1a1a1a |
| フォームラベル（会社名／氏名／メールアドレス／お問い合わせ内容） | Noto Sans JP (Medium) | 14px | Medium (500) | 26px | 1.4px | #1a1a1a |
| フォーム同意文「プライバシーポリシーに同意する」 | Noto Sans JP (Regular) | 12.983px | Regular (400) | 24px | 1.2983px | #6b6b6b |
| フォーム送信ボタン「送信する」 | A P-OTF A1Gothic StdN (M) | 13.04px | Medium相当 | 19px | 1.04px | #ffffff |

---

## 3. CONTACTページ

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| ラベル「CONTACT」 | Noto Sans JP (Bold) | 20px | Bold (700) | 40.723px | 2px | #6b6b6b |
| 見出し「お問い合わせ」 | A P-OTF A1Gothic StdN (M) | 64px | Medium相当 | 74px | 1.36px | #1a1a1a |
| リード文「サービスに関するご質問…」 | A P-OTF A1Gothic StdN (M) | 20px | Medium相当 | 40px | 2px | #1a1a1a |
| フォームラベル（会社名／氏名／メールアドレス／お問い合わせ内容） | Noto Sans JP (Medium) | 14px | Medium (500) | 26px | 1.4px | #1a1a1a |
| チェックボックス補足「プライバシーポリシーに同意する」 | Noto Sans JP (Regular) | 12.983px | Regular (400) | 24px | 1.2983px | #6b6b6b |
| 送信ボタン「送信する」 | A P-OTF A1Gothic StdN (M) | 13.04px | Medium相当 | 19px | 1.04px | #ffffff |

---

## 4. THANKSページ

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| 見出し「送信が完了しました」 | A P-OTF A1Gothic StdN (M) | 32px | Medium (500) | 74px | 1.36px | #1a1a1a |
| 本文「お問い合わせいただき…ご連絡いたします。」 | Noto Sans JP (Regular) | 16px | Regular (400) | 30px | 1.6px | #6b6b6b |
| リンク「トップページに戻る」 | Noto Sans JP (Medium) | 13.037px | Medium (500) | 24px | 1.3037px | #1a1a1a |
| リンク矢印「→」 | Inter (Medium) | 14px | Medium (500) | 26px | 1.04px | #1a1a1a |

---

## 5. ABOUTページ

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| ページ上部ラベル「ABOUT」 | Noto Sans JP (Light) | 13px | Light (300) | 40.723px | 2.6px | #6b6b6b |
| セクション見出し上ラベル「ABOUT」 | Noto Sans JP (Bold) | 20px | Bold (700) | 40.723px | 2px | #6b6b6b |
| 見出し「会社概要」 | A P-OTF A1Gothic StdN (M) | 64px | Medium相当 | 74px | 1.36px | #1a1a1a |
| リード文「株式会社アイテックの会社概要をご紹介します。」 | A P-OTF A1Gothic StdN (M) | 20px | Medium相当 | 40px | 2px | #1a1a1a |
| 会社概要テーブル ラベル（会社名／代表取締役／所在地／設立／事業内容） | Noto Sans JP (Bold) | 16px | Bold (700) | 32px | 1.6px | #6b6b6b |
| 会社概要テーブル 値（各項目の内容） | Noto Sans JP (Regular) | 16px | Regular (400) | 26px | 1.6px | #1a1a1a |
| ラベル「Philosophy」 | Noto Sans JP (Medium) | 10px | Medium (500) | 22px | 1px | #6b6b6b |
| 見出し「企業理念」 | A P-OTF A1Gothic StdN (M) | 48px | Medium相当 | 74px | 1.36px | #1a1a1a |
| 見出し「Technology for Growth」 | A P-OTF A1Gothic StdN (M) | 64px | Medium相当 | 94px | 1.36px | #1a1a1a |
| 本文（企業理念テキスト） | A P-OTF A1Gothic StdN (M) | 16px | Medium相当 | 30px | 1.6px | #1a1a1a |

---

## 6. SERVICEページ

| 要素 | font-family | font-size | font-weight | line-height | letter-spacing | 文字色 |
|---|---|---|---|---|---|---|
| ラベル「SERVICE」 | Noto Sans JP (Light) | 13px | Light (300) | 40.723px | 2.6px | #6b6b6b |
| サブ見出し「グロースコア」 | Noto Sans JP (Bold) | 20px | Bold (700) | 40.723px | 2px | #6b6b6b |
| メイン見出し「Growth Core」 | A P-OTF A1Gothic StdN (M) | 64px | Medium相当 | 74px | 1.36px | #1a1a1a |
| 本文（ヒーロー紹介文／各機能説明文 01〜04共通） | A P-OTF A1Gothic StdN (M) | 20px | Medium相当 | 40px | 2px | #1a1a1a |
| 機能番号「01／02／03／04」 | Inter (Bold) | 48px | Bold (700) | 53px | 0.56px | #1a1a1a |
| 機能見出し（Zoom Phone連携／直感的な操作性／リアルタイム管理／継続的なアップデート） | Noto Sans JP (Bold) | 36px | Bold (700) | 32px | 3.6px | #1a1a1a |
| CTA見出し「営業DXを、もっとシンプルに。」 | A P-OTF A1Gothic StdN (M) | 36px | Medium相当 | 53px | 1.12px | #1a1a1a |
| CTA本文 | Noto Sans JP (Regular) | 16px | Regular (400) | 30px | 1.6px | #6b6b6b |
| CTAボタン「お問い合わせはこちら」＋矢印 | A P-OTF A1Gothic StdN (M) ／ Inter (Medium) | 13.039px／14px | Medium相当 | 24px／26px | 不明 | #ffffff |

---

## 未確認事項

- `A P-OTF A1Gothic StdN` はFigma側でウェイト別に `:B`（≒Bold）／`:M`（≒Medium）という名前付きスタイルで分かれており、CSSの数値`font-weight`が明記されていない箇所がある（「〜相当」と記載した項目）。実装時は実フォントファイルの提供ウェイトとの対応を確認する必要あり。
- letter-spacingが「不明」の項目（CTAボタン内文字・矢印、フッターロゴなど）は、参照コード上に明示的なクラス／値が出力されておらず、Figma側で未設定（初期値扱い）と判断。
- SPUP（スマートフォン）版は今回の調査対象外（ユーザー指示によりスキップ）。PC版と比べてフォントサイズ・行送りが変わる可能性があるため、SP実装時は別途Figmaで確認が必要。
- コード上の現状（`sass/functions/_variables.scss` 等）では `font-family` が未設定、フォントカラー変数（`$F-*`）5色も未使用のままです。今回抜き出したFigma仕様と、実際にSCSSへ反映するかどうかは別途判断が必要です。
