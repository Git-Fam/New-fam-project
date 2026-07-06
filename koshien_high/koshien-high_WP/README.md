# Template_WP 仕様


## セットアップ

依存関係のインストール:

```bash
npm install
```

Sassの監視コンパイル:

```bash
npm run sass
```



## テーマ構成

`style.css` にWordPressテーマ情報を定義しています。

PHPの追加処理は `functions.php` から読み込まれます。読み込み対象は以下です。

- `function/common/*.php`

ディレクトリが存在する場合のみ、直下のPHPファイルを `require_once` します。WordPress側の追加処理は `function/common` に分割して配置します。

## 共通レイアウト

各テンプレートは、基本的に以下の共通パーツを読み込みます。

- `inc/head.php`
- `inc/header.php`
- `inc/footer.php`

`inc/header.php` はヘッダー出力後に `.whopper` を開始し、`inc/kv.php` を読み込みます。`inc/footer.php` は `.whopper` を閉じ、jQueryと `js/script.js` を読み込みます。

この構造に依存するため、新規テンプレートを追加する場合は `inc/header.php` と `inc/footer.php` の対応関係を崩さないようにしてください。

## SEO / メタ情報

`inc/head.php` でtitle、description、OGP、Twitter Card、CSS読み込み、`wp_head()` を定義しています。

現状のcanonical、OGP URL、Twitter URLは `get_home_url()` を参照します。詳細ページやアーカイブ単位で正規URLを出し分ける案件では、ページ種別に応じて動的化してください。

OGP画像は `img/meta.jpg` を参照します。案件投入時に画像の有無とパスを確認してください。

## テンプレート解決

### 固定ページ

`function/common/pages.php` の `page_template` フィルタで、ページスラッグとテンプレートを対応付けています。

| スラッグ | テンプレート |
| --- | --- |
| `voi` | `pages/page-voi.php` |
| `ggg` | `pages/page-ggg.php` |

固定ページを追加する場合は、`pages/page-{slug}.php` を作成し、`$page_templates` に対応を追加してください。KVが必要な場合は `inc/kv.php` に条件分岐を追加します。

### 通常投稿

`function/common/post.php` で通常投稿のアーカイブを有効化しています。

| 項目 | 値 |
| --- | --- |
| 投稿タイプ | `post` |
| アーカイブスラッグ | `news` |
| 管理画面ラベル | `お知らせ` |

投稿タイプ設定を変更した場合は、WordPress管理画面でパーマリンク設定を保存し、リライトルールを更新してください。

### カスタム投稿

`function/common/post.php` で以下のカスタム投稿を登録しています。

| 投稿タイプ | ラベル | アーカイブ | REST API | 対応機能 |
| --- | --- | --- | --- | --- |
| `blog` | ブログ | 有効 | 有効 | `title`, `editor`, `thumbnail`, `revisions` |
| `column` | コラム | 有効 | 有効 | `title`, `editor`, `thumbnail`, `revisions` |

タクソノミー:

| 投稿タイプ | カテゴリー | タグ |
| --- | --- | --- |
| `blog` | `blog-cat` | `blog-tag` |
| `column` | `column-cat` | `column-tag` |

テーマ全体で `post-thumbnails` を有効化しています。

### アーカイブ

`function/common/archives.php` の `archive_template` フィルタで切り替えます。

| 条件 | テンプレート |
| --- | --- |
| `is_post_type_archive('blog')` | `archives/archive-blog.php` |
| `is_post_type_archive('column')` | `archives/archive-column.php` |
| その他の `is_archive()` | `archives/archive.php` |

通常投稿の `news` アーカイブは `archives/archive.php` を使用します。

### 詳細ページ

`function/common/singles.php` の `single_template` フィルタで切り替えます。

| 条件 | テンプレート |
| --- | --- |
| `is_singular('blog')` | `singles/single-blog.php` |
| `is_singular('column')` | `singles/single-column.php` |
| その他の `is_single()` | `singles/single.php` |

## KV

`inc/kv.php` にページ種別ごとのKV分岐を集約しています。現状は以下を対象にしています。

- フロントページ
- 固定ページ `voi`
- 固定ページ `ggg`
- 通常投稿アーカイブ / 通常投稿詳細
- `blog` アーカイブ / `blog` 詳細
- `column` アーカイブ / `column` 詳細

新しいページ種別を追加する場合は、テンプレート追加とあわせてKV条件を更新してください。

## Sass

Sassは `sass/main.scss` と `sass/reset.scss` を起点にコンパイルします。

```text
sass/main.scss  -> css/main.css
sass/reset.scss -> css/reset.css
```

`inc/head.php` は `css/reset.css` と `css/main.css` を読み込みます。CSSを直接編集せず、原則として `sass/` 配下を編集してください。

Sassの主な役割:

| パス | 役割 |
| --- | --- |
| `sass/functions` | 変数、mixin、関数、SVG |
| `sass/commons` | 全体共通 |
| `sass/global` | header/footer |
| `sass/components` | 再利用コンポーネント |
| `sass/page` | ページ固有 |
| `sass/anime` | アニメーション |

新規Sassファイルを追加した場合は、同階層の `_index.scss` から `@forward` してください。

レスポンシブ基準:

| 用途 | 値 |
| --- | --- |
| PC | `min-width: 768px` |
| SP | `max-width: 767px` |
| PC基準幅 | `1366px` |
| SP基準幅 | `390px` |

色は `sass/functions/_variables.scss` に集約します。命名は `$F-*`、`$B-*`、`$P-*` を使用しています。

## JavaScript

`inc/footer.php` で以下の順に読み込みます。

1. jQuery 3.7.0
2. `js/script.js`


`js/script.js` には、ハンバーガーメニュー、スクロール制御、`.show` 付与によるアニメーション制御の実装例をコメントで残しています。

## Contact Form 7

`function/common/contact.php` にContact Form 7向けの処理例をコメントで残しています。

- 自動挿入される `p` タグの削除
- reCAPTCHAスクリプトの読み込みページ制限

使用する場合はコメントアウトを解除し、対象ページスラッグを案件に合わせて変更してください。

## 追加実装時の更新箇所

### 固定ページを追加する場合

1. WordPress管理画面で固定ページを作成する
2. `pages/page-{slug}.php` を作成する
3. `function/common/pages.php` の `$page_templates` に追加する
4. 必要に応じて `inc/kv.php` を更新する
5. 必要に応じて `sass/page` にページ用Sassを追加する

### カスタム投稿を追加する場合

1. `function/common/post.php` に `register_post_type()` を追加する
2. 必要に応じて `register_taxonomy()` を追加する
3. `function/common/archives.php` の `$archive_templates` に追加する
4. `function/common/singles.php` の `$single_templates` に追加する
5. `archives/archive-{post_type}.php` を作成する
6. `singles/single-{post_type}.php` を作成する
7. 必要に応じて `inc/kv.php` を更新する
8. 管理画面でパーマリンク設定を保存する

## 確認事項

- `css/reset.css` と `css/main.css` が生成されていること
- `img/meta.jpg` など、参照される画像が存在すること
- canonical、OGP、descriptionが案件要件に合っていること
- 投稿タイプ変更後にパーマリンク設定を保存していること

## 既知の注意点

- `inc/kv.php` と各テンプレート本文はプレースホルダーです。
- `css/` 配下のコンパイル済みCSSは、初期状態では存在しない場合があります。
