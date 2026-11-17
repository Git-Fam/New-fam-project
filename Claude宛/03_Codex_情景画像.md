Higgsfield 残クレジット：開始時 111.38 → 終了時 111.38（差 0.00）。日英プロンプトを作成済み、画像は未生成。
費用見積り操作が環境の承認ポリシーで拒否されたため、生成・画像保存は行わず、プロンプトのみを納品する。
結果の掲載項目は既存コードで確認できたが、公開中の結果画面・現在の設定値・実際の表示内容は未確認。

## 制作状況とクレジット

プラン：starter。無料生成の残りは、開始・終了とも動画系の対象枠が1回、人物シートの対象枠が15回。今回の情景写真に使える無料枠とは確認できていない。試用状態は pending、無制限生成は利用不可との応答。これらの数値は運用記録であり、LPに掲載するコピーではない。

共通ルールは `../しごピタPR/Codex共通ルール.md` を参照。残高は作業開始・終了に読み取り専用ツールで取得した。画像生成の費用見積りツールに、モデル `gpt_image_2_6`、正方形、単独画像の条件を渡したところ、次の応答で拒否された。

> MCP tool call requires approval, but approval policy is never

承認ポリシーによる拒否で、見積額は取得できなかった。生成ジョブは送信していない。別サービス・別手段による生成は試していない。クレジット消費0。

## 保存先

- 今回の納品：`Claude宛/03_Codex_情景画像.md`（本ファイル）。
- 画像の保存先：`Claude宛/images/` を予定していたが、画像未生成につき保存ファイルはない。フォルダも新設していない。
- 生成できる環境で使用する予定名：`scene-fv.png`、`scene-signboard.png`、`verb-tsukuru.png`、`verb-tsutaeru.png`、`verb-sasaeru.png`。実際の出力形式に合わせて拡張子を決め、既存ファイルには上書きしない。

## 共通仕様と使い方

素材案の出典は `Claude宛/02_Codex_案A批評とコピー強化.md` の「情景カードの素材案」。以下はLPの展示用イメージであり、診断の設問画像や公式結果画像として扱わない。

各画像は「共通プロンプト＋個別プロンプト」を同じ言語で結合して使用する。日本語版と英語版は同じ内容の代替入力で、画像内に描く文言ではない。日英を同時に入力する必要はない。

元画像は正方形を想定。手元・相手の姿勢・机の空間を中央に近接させ、外周に切り抜き用の余白を設ける。PCの横長、SPの縦長の切り抜きで各対象を残すことを狙うが、生成後の実画像と実装枠で確認する必要がある。任意の縦横比で残ることを保証する指定ではない。

場所・光・服装の一致は文章だけでは未検証。生成時は最初の採用画像を共通の見た目の参照にし、後続では場所・机・窓・人物・服装を保って行為とカメラ位置だけを変える。参照入力の可否は使用ツールで確認する。今回、参照用画像は未生成。

### 共通プロンプト／日本語

用途：仕事選びを考えるLPの情景写真。写実的で自然な日常の写真。全画像を同じ共有スペースの同じ時間の場面としてそろえる。背景は装飾の少ない明るい壁、明るい木の共有机、横の窓から入る柔らかく拡散した昼光。机上は無地の白や生成りの紙片、無地の浅いトレー。人物は同じ対等な成人たちで、片方は無地の生成りの長袖、もう片方は無地のくすんだ灰青の長袖、どちらも普段着。同じ人の服装を画像間で変えない。性別・年齢を行為や役割の記号にせず、誰かを上司・部下・専門家として演出しない。顔を主役にせず、表情は目立たせない。笑顔、感謝、困惑、達成感、承認の身振りによって好ましい回答を誘導しない。明暗や色、ピントで人物や対象に価値の序列を付けず、手元と相手の姿勢と机の周辺を読み取れる被写界深度にする。正方形の画面で、行為に必要な手・紙・相手の姿勢・空いた机面を中央のまとまりとして収め、上下左右に余白を残す。横長と縦長の中央寄りの切り抜きでも対象が残るようにする。自然な手指と無理のない距離感。文字、数字、字幕、ラベル、透かし、ロゴを一切描かない。制服、名札、身分証、肩書の掲示、読める書類や画面、職業を特定する専門道具は置かない。問いとタブ名は画像外で扱う。

### Shared prompt / English

Use case: photorealistic-natural. Asset: an illustrative scene for a landing page about reflecting on work choices. Create a natural, candid photograph. Keep every image in the same shared space at the same time of day: a simple light wall, a light wooden communal table, and soft diffused daylight from a side window. Use blank white and unbleached paper pieces and a plain shallow tray. Keep the same adult peers throughout: one in a plain unbleached long-sleeved casual top, the other in a plain muted blue-gray long-sleeved casual top. Preserve each person's clothing between images. Do not encode an action or role through gender or age, or present anyone as a supervisor, subordinate, or expert. Faces are secondary and expressions unobtrusive. No smiles, gratitude, distress, triumph, approval gestures, or other emotional cues suggesting a preferred answer. Avoid value hierarchies through contrast, color, or selective focus; keep the hands, the other person's posture, and the surrounding table area legible. Use a square composition with the essential hands, paper, other person's posture, and open tabletop grouped near the center, with generous margins on every side for both landscape desktop and portrait mobile center crops. Use anatomically plausible hands and natural interpersonal distance. No text, numbers, captions, labels, watermarks, logos, uniforms, name badges, identity cards, job-title signs, readable documents or screens, or occupation-specific equipment. Questions and tab labels will be added outside the image.

## 個別プロンプト一覧

### 情景①／FV

**日本語（共通プロンプトに続ける）**

木の机で、生成りの長袖の人物が無地の紙片を動かして配置を試している途中。灰青の長袖の人物が隣で少し距離を置き、その紙を眺めている。斜め上から手元を中心に写し、隣の人物の肩から腕と姿勢、机の周りの空間も見せる。顔は画面の主役にしない。紙を動かす手元、隣の人物、空いた机面を画面中央付近にまとめ、どれも切り抜きで失わない配置にする。完成品や成果を示す演出は加えない。

**English (append to the shared prompt)**

At the wooden table, the person in the unbleached top is moving blank paper pieces, midway through trying an arrangement. The person in the blue-gray top sits beside them at a small, natural distance, looking at the paper. Photograph from an elevated oblique angle centered on the hands, while including the neighboring person's shoulder, arms and posture, and the open table area. Faces remain secondary. Group the moving hands, the neighboring person and the open tabletop near the center so each survives the intended crops. Do not introduce a finished product or cues of achievement.

**切り抜きで残したい対象**：紙を動かす手元／隣で見る人の姿勢／机の余白。

### 情景②／看板

**日本語（共通プロンプトに続ける）**

同じ共有机を肩越しに眺める場面。手前の肩は画面端で小さく扱い、中央に紙片を並べ替える手元、そのすぐ隣に紙を見ている人物の姿勢、その奥に空いた机面と周辺の空間が同時に見える。手元・人物・空間を奥行き方向にも近接してまとめ、横に広げすぎない。どこかだけを照らしたり、顔だけを鮮明にしたりせず、各部分の明暗差を抑える。隣の人物は評価・指導・承認の身振りをしない。看板や文字そのものは描かない。

**English (append to the shared prompt)**

Look over a shoulder toward the same communal table. Keep the foreground shoulder small at the edge. Simultaneously show the hands rearranging blank paper near the center, the neighboring person's posture as they look at the paper, and an open stretch of tabletop with surrounding space just beyond. Group these elements compactly in depth rather than spreading them across the width. Keep tonal contrast balanced; do not spotlight one area or isolate the face with sharp focus. The neighboring person makes no evaluative, instructional, or approving gesture. Do not depict a signboard or any lettering.

**切り抜きで残したい対象**：手元／隣の人／机の周りの空間。採用済み選択肢と照合する。

### 動詞タブ／つくる

**日本語（共通プロンプトに続ける）**

同じ共有机で、生成りの長袖の人物が無地の紙を折り、形や位置を変えて試している途中の手元。肩越しの斜め横から写す。折りかけの紙と動かしている指を中央に収め、隣の灰青の長袖の人物の腕や控えめな姿勢、空いた机面も残す。完成品ではなく試している途中を見せる。専門道具や華やかな作品、成功を喜ぶ反応は加えない。他のタブと同じ光量・色調・人物の扱いにする。

**English (append to the shared prompt)**

At the same communal table, show the hands of the person in the unbleached top midway through folding blank paper and trying different shapes and positions. Use an oblique over-the-shoulder view from the side. Center the partly folded paper and moving fingers, retaining the neighboring blue-gray sleeve and unobtrusive posture, plus an open area of tabletop. Show an unfinished experiment. No specialist tools, elaborate finished creations, or celebratory reactions. Match the other tabs in lighting, color treatment, and emphasis on people.

**切り抜きで残したい対象**：折りかけの紙／動かす指／机面。

### 動詞タブ／伝える

**日本語（共通プロンプトに続ける）**

同じ共有机で、生成りの長袖の人物が並べた無地の紙片を指で示し、斜め向かいの灰青の長袖の人物と言葉を交わしている途中。斜め横から、指先と紙、相手の腕と上体の向きが同時に見えるように写す。相手は紙へ自然に視線を向けるが、笑顔や大きなうなずきで同意を強調しない。手元と相手を中央に寄せ、机の余白を残す。登壇設備、営業資料、説明用の文字や図表、専門家と聞き手の上下関係は加えない。

**English (append to the shared prompt)**

At the same communal table, the person in the unbleached top points toward arranged blank paper pieces during an exchange with the person in the blue-gray top seated diagonally opposite. Photograph obliquely from the side so the fingertip, paper, and the other person's arms and torso orientation are visible together. The other person looks naturally toward the paper, without smiling or emphatic nodding to signal agreement. Keep the hands and the other person near the center with open tabletop around them. No presentation equipment, sales materials, explanatory text or charts, or expert-and-audience hierarchy.

**切り抜きで残したい対象**：指先／紙／相手の姿勢。

### 動詞タブ／支える

**日本語（共通プロンプトに続ける）**

同じ共有机で、生成りの長袖の人物が紙を広げているそばへ、灰青の長袖の人物が無地の紙材料を載せた浅いトレーを、机の空いた場所に静かに寄せている途中。横から、トレーを動かす手、トレー、紙を広げる手、人物間の自然な距離を見せる。動きに必要な対象を中央にまとめ、空いた机面も残す。受け取る人物は感謝や安心の表情を示さず、困って救われる場面にしない。世話役・補助役を性別や年齢に結び付けず、対等な共同作業として写す。

**English (append to the shared prompt)**

At the same communal table, the person in the unbleached top is spreading out paper while the person in the blue-gray top quietly slides a plain shallow tray of blank paper materials into an open area beside them. Photograph from the side, showing the hand moving the tray, the tray itself, the hands spreading paper, and natural distance between the people. Group the essential action near the center and retain open tabletop. The recipient shows no gratitude or relief; do not stage distress followed by rescue. Avoid associating assistance with gender or age. Depict an activity between peers.

**切り抜きで残したい対象**：トレーを寄せる手／トレー／紙を広げる手と距離感。

## 結果画面の内容：既存資料で確認できた範囲

確認元は作業ディレクトリ内のコード。公開サイトやFigmaは開いていない。ローカルの実装が現在公開中の版と一致するかは未確認。

- `shigopita/src/app.js` の結果描画処理には、タイプ名、キャッチコピー、説明、キャラクター画像、強みの一覧、弱みを捉え直す説明、環境の説明、職種の一覧、業界の一覧、傾向を表すバーを表示する処理がある。画像や説明の一部には設定値による条件分岐がある。
- 同処理では職種データを「職種名」と「説明文」に分けて表示できる。業界データはリスト表示する構造。これは掲載の仕組みとして確認できたことで、すべてのタイプで説明が埋まっていることや、現行画面で必ず表示されることまでは確認していない。
- `shigopita/src/data.js` のタイプ定義には、たとえば `FRONTIER｜開拓者`、`CREATOR｜創造者`、`EMPOWERER｜伴走者` という既定のタイプ名がある。別方式の結果定義や設定による上書き処理もあるため、これらを公開中の確定名称とは扱わない。全16タイプの名称と現在の対応関係は、実画面または承認済み原稿での確認が必要。
- `shigopita/index.html` にも、タイプ名、説明、強み、環境、職種、業界などに対応する表示要素がある。ただしHTMLの初期表示用文言だけでは実際の結果内容を確認したことにはならない。
- 統計を示すような表示処理もあるが、根拠・意味は未確認。禁止事項に従い、数値や信頼性の主張をLPへ転載する根拠にはしない。

**未確認**：公開中の実際の結果画面、現在有効な設定値、最終的なタイプ名と結果文、掲載項目の表示状態、仕事紹介の対象範囲、個別求人との連動、利用条件。仕事が適していることや採用につながることは断定しない。

## 未実施の確認

画像未生成のため、文字・ロゴなどの混入、手指の自然さ、表情による誘導、画像間の場所・光・服装の一致、PC・SPの実際の切り抜きは未確認。プロンプトで指定したことを、生成画像で確認できたこととして扱わない。切り抜きで問いの対象が消えた場合は、画像か問いを調整する。
