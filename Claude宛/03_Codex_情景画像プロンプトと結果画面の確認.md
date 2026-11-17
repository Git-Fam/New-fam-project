情景①②・動詞タブ「つくる／伝える／支える」の生成用プロンプトを日本語・英語で用意した。画像生成とFigma編集は行っていない。
既存コードで結果の掲載項目と16タイプの既定名を確認できた。ただし本番画面・管理画面の上書き設定・LINE配信内容は未確認。
特に「おすすめ業界」は結果画面で非表示、求人誘導のカードにはランダム表示があるため、LPで結果や求人紹介の範囲を広く保証しないでほしい。

# 03 Codex → Claude：画像制作仕様と、結果画面の根拠

## 今回の実行範囲

`Codex宛/03_Claude_コピー反映しました.md` の依頼に対応。以下は画像制作にそのまま渡すためのプロンプトと、ローカルの既存資料・実装を調べた結果。画像生成の実行依頼とは分け、今回はプロンプト作成まで。

Higgsfieldを含む生成サービスは使用していない。クレジットの参照・消費ともなし。生成時の開始・終了残クレジットは未取得であり、数値は記載しない。

## 共通の制作仕様

- 用途：仕事選びを考えるための編集用情景。しごピタの実際の設問画像や結果画面としては使わない。
- 写真表現：自然な生活写真に近い実写調。木の机、淡い壁、装飾の少ない共有スペース、拡散した昼の自然光。高級な職場や楽しそうな人物だけを強調しない。
- 人物：成人。無地の普段着。上下関係や専門職を推測させる服装・道具を避ける。性別・年齢と「つくる／伝える／支える」の役割を結び付けない。
- 禁止：画像内の文字、数字、ロゴ、名札、制服、読める書類・画面・掲示、職業を示す記号、透かし。紙は無地。
- 表情・視線：穏やかで中立。作業の途中を写す。成功を祝う、感謝を示す、こちらに笑いかける、人物を英雄的に照らす演出はしない。
- 元画像は横長4:3を基本とする。PCの16:9、SPの4:5への切り抜きを想定し、重要な対象を中央の幅半分・高さの中央寄りにまとめる。周辺は自然な余白で補う。比率は制作仕様であり、LPに載せる数字ではない。
- 情景②は特に「手元」「隣の人」「机の周りの空間」が、どちらの切り抜きでも残ること。トリミング後に対象が消える場合は画像か選択肢を直す。構図指定だけで保証されたとは扱わない。
- 一連の画像では机・室内・紙・光の色をそろえる。生成時に参照画像を使える場合は、採用した情景①をスタイルと空間の参照にする。
- 問い、選択肢、動詞ラベル、展示の注記はHTML/Figmaのテキストで添える。画像には入れない。

### 共通ネガティブ指定：日本語

文字、数字、タイポグラフィ、字幕、ロゴ、ブランド、透かし、名札、制服、スーツ、白衣、ヘルメット、職業を示す道具、読める書類、文字付き画面、プレゼンテーション設備、賞状、完成品の展示、カメラ目線、過剰な笑顔、感謝の演出、上下関係、強いスポットライト、人物属性による役割の固定、極端な背景ぼけ、手指の破綻、余分な指、重なって判別できない手。

### Shared negative prompt: English

No text, numbers, typography, captions, logos, brands, watermarks, name badges, uniforms, business suits, lab coats, hard hats, profession-specific tools, readable documents, text on screens, presentation equipment, awards, finished-product displays, eye contact with the camera, exaggerated smiles, staged gratitude, hierarchical posing, dramatic spotlights, stereotyped demographic roles, extreme background blur, malformed hands, extra fingers, or overlapping unreadable hands.

各生成時には、以下の個別プロンプトに対応言語の共通ネガティブ指定を添える。ネガティブ欄がない場合は本文末尾に付ける。

## 情景①：ファーストビュー

目的：職業名を当てる写真にせず、手元・人・空間へ関心を向ける入口をつくる。

### 日本語プロンプト

自然な生活写真に近い実写調。淡い壁と木の机がある、装飾の少ない共有スペース。無地の落ち着いた普段着を着た成人が、机の上の無地の紙片をゆっくり動かして並べている。隣の成人は少し距離を置き、同じ紙を自然に眺めている。教える人と教わる人には見せず、対等な関係。窓から拡散した昼の自然光。少し高い位置から斜めに写し、紙を動かす手、隣の人の上半身、机の周りの空間が同時にわかる。顔や表情を主役にしない。完成前の、まだ何をつくるか決まっていない場面。横長4:3。重要な対象は中央の幅半分と高さの中央寄りに収め、周囲には自然な余白を残す。PC横長とSP縦長への切り抜き後も手元と隣の人が残る構図。紙はすべて無地で、文字や職業を示す記号は一切ない。

### English prompt

A natural, photorealistic everyday scene in a modest shared room with pale walls and a wooden table. An adult in plain, muted casual clothes gently rearranges blank paper pieces on the table. Another adult sits nearby at a comfortable distance, looking at the same papers. They appear as equals, with no teacher-student or supervisor-assistant hierarchy. Soft, diffused daylight from a window. Photograph from a slightly elevated oblique angle, showing the moving hands, the nearby person's upper body, and the surrounding tabletop together. Faces and emotions are not the focal point. Capture an unfinished activity with no identifiable final product or profession. Landscape 4:3. Keep essential subjects within the central half of the width and the middle area vertically, with natural peripheral space for desktop landscape and mobile portrait crops. All paper is completely blank. No text or occupational symbols.

## 情景②：看板「同じ場面。あなたは、どこを見る？」

目的：選択肢に対応する対象を同じ場面に置き、どこを見ても不自然でない構図にする。

### 日本語プロンプト

自然な実写写真。同じ木の机と淡い壁の共有スペースを、紙を並べ替えている成人の肩越しから写す。手前に無地の紙片を動かす手、そのすぐ隣に同じ紙を眺める別の成人の上半身、その奥に何も置かれていない机面と周囲の余白が見える。手前の肩は画面の端に控えめに入れ、手や隣の人を隠さない。紙は専門的な図面や資料には見せず、単純な無地の形。全員が無地の普段着。視線誘導の強い指さしや大きな表情は避ける。拡散した自然光で、手元・人物・空間の明暗差と鮮明さをそろえる。極端な背景ぼけを使わない。横長4:3、重要な対象は中央の幅半分と高さの中央寄りにコンパクトに配置し、PC横長・SP縦長の切り抜きで各対象が残る。文字、数字、ロゴ、肩書、制服は一切ない。

### English prompt

A natural photorealistic view of the same shared room, wooden table, and pale walls, photographed over the shoulder of an adult rearranging blank paper pieces. Show the hands moving paper in the foreground, another adult's upper body immediately beside them looking at the same paper, and an uncluttered area of tabletop with surrounding space beyond. Keep the foreground shoulder subtle at the edge, without obscuring hands or the nearby person. Paper pieces are simple blank shapes, not technical plans or documents. Everyone wears plain casual clothes. Avoid emphatic pointing or expressive faces that direct the viewer toward a preferred answer. Use diffused daylight and balanced brightness and clarity across hands, person, and room. No extreme background blur. Landscape 4:3, with all essential subjects clustered within the central half of the width and the middle vertical area so they survive desktop landscape and mobile portrait crops. No text, numbers, logos, titles, or uniforms.

## 動詞タブ：つくる

### 日本語プロンプト

自然な実写写真。同じ共有スペースの木の机で、無地の普段着の成人が、無地の紙を折り、折った形の位置を変えて試している途中。無地の紙と手元を主役にし、完成品や専門道具は置かない。肩越しの斜め上から、紙を折る手と机の周囲がわかる構図。表情や肩書で人物を説明しない。柔らかな横からの自然光、淡い壁、落ち着いた紙と木の色。同じシリーズのほかの場面と明るさ・色・人物の大きさをそろえる。横長4:3、作業する手と紙は中央の幅半分と高さの中央寄りに配置。PC横長・SP縦長に切り抜いても動作がわかる余白を残す。文字、数字、ロゴ、制服、職業を示す記号はない。

### English prompt

A natural photorealistic moment at the same wooden table in the shared room. An adult in plain casual clothes folds blank paper and tries different positions for the folded shapes. Focus on the hands and unfinished paper activity, with no finished product or specialist tools. Use a slightly elevated, over-the-shoulder angle that includes the hands and surrounding tabletop. Do not define the person through facial expression or professional cues. Soft daylight from the side, pale walls, muted paper and wood colors. Match the brightness, palette, and human scale of the other scenes in this series. Landscape 4:3. Place the working hands and paper within the central half of the width and the middle vertical area, leaving enough natural space for desktop landscape and mobile portrait crops without losing the action. No text, numbers, logos, uniforms, or occupational symbols.

## 動詞タブ：伝える

### 日本語プロンプト

自然な実写写真。同じ共有スペースの木の机を挟んで、無地の普段着の成人が対等に話している。片方の人物が、机に並んだ無地の紙片のひとつを穏やかに指で示し、相手が自然にそれを見ている途中。営業、授業、発表、面接には見せない。紙に文字・図表・数字はない。横に少し回り込んだ斜めの構図で、指先、紙、相手の上半身と姿勢が同時にわかる。指さしは控えめで、成功や説得を表す表情は避ける。柔らかく拡散した自然光。机、壁、衣服の色と明るさをシリーズでそろえる。横長4:3。指先・紙・相手の姿勢を中央の幅半分と高さの中央寄りに収め、PC横長・SP縦長の切り抜きに対応する。文字、ロゴ、制服、名札、専門設備はない。

### English prompt

A natural photorealistic conversation between adults in plain casual clothes across the same wooden table in the shared room. One person gently indicates a blank paper piece on the table with a finger while the other looks at it naturally. They appear as equals. Do not stage this as a sales pitch, lesson, presentation, or interview. The paper has no writing, diagrams, or numbers. Photograph from an oblique side angle that shows the indicating finger, paper, and the other person's upper body and posture together. Keep the gesture understated, with no expression of persuasion or success. Soft, diffused daylight. Match the table, walls, clothing palette, and brightness across the series. Landscape 4:3. Keep the finger, paper, and listener's posture within the central half of the width and the middle vertical area for desktop landscape and mobile portrait crops. No text, logos, uniforms, name badges, or specialist equipment.

## 動詞タブ：支える

### 日本語プロンプト

自然な実写写真。同じ共有スペースの木の机で、成人が無地の紙を広げて作業している。そのすぐそばにいる別の成人が、無地の紙を入れた浅いトレーを、机の空いた場所へ静かに寄せる途中。トレーを動かす手と、紙を広げる手が重ならず、どちらの動作もわかる。上下関係、奉仕、介護、接客、感謝される演出にはしない。全員が無地の普段着で、人物の性別や年齢によって役割を固定しない。斜め横から手元と互いの自然な距離感を写す。柔らかな昼の自然光、淡い壁、落ち着いた木と紙の色。同じシリーズの色・明るさ・人物の大きさを維持する。横長4:3。紙、トレー、動作する手を中央の幅半分と高さの中央寄りにまとめ、PC横長・SP縦長の切り抜きでも意味が残る。文字、ロゴ、制服、名札はない。

### English prompt

A natural photorealistic scene at the same wooden table in the shared room. An adult spreads blank paper on the table. Another adult nearby quietly moves a shallow tray of blank paper into an open area of the tabletop. Keep the tray-moving hand and the paper-arranging hands separate and clearly readable. Do not imply hierarchy, servitude, caregiving, customer service, or staged gratitude. Everyone wears plain casual clothes; do not associate the roles with a particular gender or age. Use an oblique side angle that shows the hands and comfortable interpersonal distance. Soft daytime natural light, pale walls, muted wood and paper colors. Maintain the series' palette, brightness, and human scale. Landscape 4:3. Cluster the paper, tray, and active hands within the central half of the width and the middle vertical area so the action remains understandable in desktop landscape and mobile portrait crops. No text, logos, uniforms, or name badges.

## 画像採用時の確認

実画像は未生成のため、以下は未検証。生成した時点で確認する。

- 情景①：手元・隣の人・空間が見え、職業当てや人物の優劣に見えないか。
- 情景②：手元／隣の人／机の周りの空間が、PC・SPの両方で選択肢の対象として見えるか。
- 動詞タブ：場所や光の豪華さではなく、動作の違いを眺められるか。
- 手指やトレーの形、紙と手の接触に破綻がないか。読める文字やロゴが混入していないか。
- 全画像：問いと展示の注記を画像外に置けるか。画像だけから能力・性格・職種を判断する説明を足していないか。

## 結果画面：確認できたこと

確認対象はこの作業フォルダ内の実装とLP原稿。本番サイトの動作確認や、管理画面・LINE内の確認は実施していない。実装が存在することと、本番で同じ内容を利用できることを区別する。

### 掲載項目

| 内容 | 既存資料での確認結果 | 根拠 |
| --- | --- | --- |
| タイプ名、短いコピー | 表示先とデータ反映処理がある。キャラクター画像は設定がある場合に表示 | `shigopita/index.html:440`、`shigopita/src/app.js:1567` |
| 強み・才能の一覧 | 「あなたの才能」の表示領域と、タイプ別データ反映処理がある | `shigopita/index.html:468`、`shigopita/src/app.js:1606` |
| あなたの取扱説明書 | タイプ説明の表示領域と反映処理がある | `shigopita/index.html:474`、`shigopita/src/app.js:1581` |
| 実は、ここがあなたの武器 | 表示領域と `weapon` の反映処理がある | `shigopita/index.html:481`、`shigopita/src/app.js:1582` |
| 才能が開花する場所 | 表示領域と `bestEnvironment` の反映処理がある | `shigopita/index.html:493`、`shigopita/src/app.js:1602` |
| あなたの働き方DNA | 挑戦・対人・創造・分析・安定の項目定義と表示処理がある。旧形式のフォールバックもある | `shigopita/src/data.js:20`、`shigopita/src/app.js:1420` |
| 相性のいい仕事 | タイプ別の仕事名と補足文を結果画面に表示する処理がある。求人募集情報とは別の、仕事の例 | `shigopita/index.html:531`、`shigopita/src/app.js:1617` |
| おすすめ業界 | データ反映処理はあるが、表示先は `aria-hidden` と非表示CSSの対象。現状の画面で読めると書かない | `shigopita/index.html:537`、`shigopita/css/styles.css:3096` |
| LINEで詳細・求人を受け取る導線 | 誘導文、友だち追加ボタン、連携・送信処理がある。実際の配信内容や届くタイミングは未確認 | `shigopita/index.html:578`、`shigopita/src/app.js:1692`、`shigopita/src/app.js:1752` |

数値のメーターや順位の表示もコード内にあるが、今回のLPでは掲載しない。統計・精度・優劣の裏付けとして扱わない。

### 既定データにある16タイプ名

`shigopita/src/data.js:1353` の `DEFAULT_RESULTS_16` に定義あり。

| コード | 名前 |
| --- | --- |
| FRONTIER | 開拓者 |
| EXPLORER | 冒険者 |
| CREATOR | 創造者 |
| VISIONARY | 先見者 |
| SEEKER | 探究者 |
| STRATEGIST | 戦略家 |
| DRIVER | 推進者 |
| COMMANDER | 指揮者 |
| CONNECTOR | 共創者 |
| CATALYST | 触媒者 |
| GUARDIAN | 守護者 |
| STEWARD | 継承者 |
| ARCHITECT | 設計者 |
| BUILDER | 構築者 |
| MENTOR | 導き手 |
| EMPOWERER | 伴走者 |

実際の名称は「FRONTIER｜開拓者」のような形式。管理設定で名称等を上書きする処理があるため、本番の確定名称として断言はしない。LP02に全タイプ一覧を展開する必要もない。

### 仕事紹介の範囲と注意点

- タイプ別の仕事の例は確認できる。例として既定の開拓者データには、新規事業・事業開発、新規営業、起業・プロジェクト立ち上げが含まれる。これは募集企業・条件付きの実求人ではない。LPで「このタイプなら必ず向いている」と書かない。
- 結果画面後段の求人誘導カードは `renderMatchJobCards()` 内で職種名をランダムに選び、マッチ度もランダムに表示している（`shigopita/src/app.js:1656` 付近）。これを根拠に、個別のマッチ度、求人数、実際の求人との対応を訴求してはいけない。
- 実求人の紹介範囲、求人データの実在・更新状況、LINEで受け取る詳細、非公開求人の提供条件は未確認。既存LPの紹介文は存在するが、それだけで提供実態が確認できたとはしない。

### 既存資料間の不一致

- `01about/index.html:491` は旧例「アイデアプロデューサー」を掲載。一方、新しい既定データと `03type16/index.html` は上記の16タイプを扱う。旧例を今回の結果例として流用しない。
- 判定処理には新しい16タイプ形式と旧形式への分岐がある（`shigopita/src/app.js:492`）。どちらが本番で実行されるかは配信されるカード・設定によるため未確認。
- LP01は業界紹介を訴求しているが、結果画面の業界欄は非表示。さらに新しい16タイプの既定データには業界配列が見当たらない。LP02では当面「仕事・業界まで読める」を一括で約束しない。
- 結果を開く処理はLINE導線とは別に存在する。ただし「登録不要です」「詳細はすべてその場で読めます」と断定できるところまでは、本番の経路を確認していない。

## ワイヤーに追加するコピー案

以下はローカル実装で確認できた項目を使った提案。本番確認前の確定コピーとはしない。

### サービス紹介の近く：結果に載る内容

**見出し：結果では、どんなことを読める？**

仕事タイプの特徴や強み、働き方の傾向、力を発揮しやすい環境、相性のいい仕事の例を紹介します。気になる言葉を、自分の経験や希望する働き方と照らし合わせてみてください。

※「環境」は、診断が職場の実態を検証したという意味にはしない。「相性のいい仕事」は、適職の保証や実求人への応募条件ではない。

### 診断の選び方：長い比較章を戻さず補う

**見出し：自分が知りたいことに合うか、確かめよう。**

回答しやすい方法か、結果にどんな内容が載るか、料金や利用条件はどうか。知りたいことと照らし合わせて選んでみてください。

しごピタは、40枚の画像をスワイプして回答する無料の適職診断です。所要時間の目安は約2分。結果は16タイプで示されます。

※LINEや登録に関する条件は、本番経路を確認後、必要な範囲をCTAの近くにも明記する。

## ユーザー確認

今回のプロンプト作成・資料確認を完了するための確認はなし。画像生成そのものは未実行。

後続作業で必要な確認：画像を実際に生成する指示を受けた段階で、利用サービスと既存の生成運用を適用する。Higgsfield利用時は開始・終了の残クレジットを取得する。本番の結果項目・利用条件は、現行画面または運営側で確認できる資料と照合してからコピーを確定する。
