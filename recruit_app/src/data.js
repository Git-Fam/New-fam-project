export const AXIS_ORDER = [
  "people",
  "focus",
  "challenge",
  "stability",
  "creativity",
  "execution"
];

export const AXES = {
  people: { label: "People", short: "人との関わり", color: "#ff4d6d" },
  focus: { label: "Focus", short: "集中力", color: "#3a86ff" },
  challenge: { label: "Challenge", short: "挑戦", color: "#ff9f1c" },
  stability: { label: "Stability", short: "安定", color: "#2a9d8f" },
  creativity: { label: "Creativity", short: "発想力", color: "#8338ec" },
  execution: { label: "Execution", short: "実行力", color: "#111111" }
};

const image = (id) =>
  `https://images.unsplash.com/${id}?auto=format&fit=crop&w=900&q=82`;

export const DEFAULT_CARDS = [
  {
    id: "image-001",
    question: "初対面でも気軽に話しかけられる",
    visual: "初対面で会話する人",
    image: image("photo-1522202176988-66273c2fd55f"),
    yesScores: { people: 2 },
    noScores: { focus: 2 }
  },
  {
    id: "image-002",
    question: "新しい環境に入るとワクワクする",
    visual: "新しい扉を開ける人",
    image: image("photo-1500530855697-b586d89ba3ee"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 }
  },
  {
    id: "image-003",
    question: "一人で静かに作業する時間が好き",
    visual: "一人でPCに向かう人",
    image: image("photo-1486312338219-ce68d2c6f44d"),
    yesScores: { focus: 2 },
    noScores: { people: 2 }
  },
  {
    id: "image-004",
    question: "アイデアを考えている時間が楽しい",
    visual: "ブレインストーミング",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 }
  },
  {
    id: "image-005",
    question: "思いついたらすぐ行動する方だ",
    visual: "すぐ動き出す人",
    image: image("photo-1542744173-8e7e53415bb0"),
    yesScores: { execution: 2 },
    noScores: { focus: 1 }
  },
  {
    id: "image-006",
    question: "決まったスケジュールの方が安心する",
    visual: "手帳・スケジュール帳",
    image: image("photo-1506784983877-45594efa4cbe"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 }
  },
  {
    id: "image-007",
    question: "チームで協力する方が好き",
    visual: "グループワーク",
    image: image("photo-1517048676732-d65bc937f952"),
    yesScores: { people: 1 },
    noScores: { focus: 1 }
  },
  {
    id: "image-008",
    question: "未経験でも挑戦してみたい",
    visual: "初めての体験",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { challenge: 1 },
    noScores: { stability: 1 }
  },
  {
    id: "image-009",
    question: "細かいミスによく気付く",
    visual: "書類チェック",
    image: image("photo-1454165804606-c3d57bc86b40"),
    yesScores: { focus: 2 },
    noScores: { creativity: 1 }
  },
  {
    id: "image-010",
    question: "正解のない問題を考えるのが好き",
    visual: "アイデア会議",
    image: image("photo-1497366754035-f200968a6e72"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 }
  },
  {
    id: "image-011",
    question: "やることは先に終わらせたい",
    visual: "タスク完了",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { stability: 1 }
  },
  {
    id: "image-012",
    question: "ルールが明確な方が働きやすい",
    visual: "マニュアルを見る人",
    image: image("photo-1497215728101-856f4ea42174"),
    yesScores: { stability: 2 },
    noScores: { challenge: 1 }
  },
  {
    id: "image-013",
    question: "人の相談をじっくり聞くことが好き",
    visual: "相談を受ける場面",
    image: image("photo-1551836022-d5d88e9218df"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 }
  },
  {
    id: "image-014",
    question: "難しい目標ほど燃える",
    visual: "高い山を登る人",
    image: image("photo-1464822759023-fed622ff2c3b"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 }
  },
  {
    id: "image-015",
    question: "一つのことを深く学びたい",
    visual: "勉強・研究",
    image: image("photo-1524995997946-a1c2e315a42f"),
    yesScores: { focus: 2 },
    noScores: { challenge: 1 }
  },
  {
    id: "image-016",
    question: "自分らしい作品を作るのが好き",
    visual: "デザイン制作",
    image: image("photo-1523726491678-bf852e717f6a"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 }
  },
  {
    id: "image-017",
    question: "最後まで責任を持ってやり遂げたい",
    visual: "ゴールする人",
    image: image("photo-1517245386807-bb43f82c33c4"),
    yesScores: { execution: 2 },
    noScores: { people: 1 }
  },
  {
    id: "image-018",
    question: "安定した収入は大切だと思う",
    visual: "給与明細・家計",
    image: image("photo-1554224155-6726b3ff858f"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 }
  },
  {
    id: "image-019",
    question: "人前で話すことは苦ではない",
    visual: "プレゼン",
    image: image("photo-1557804506-669a67965ba0"),
    yesScores: { people: 2 },
    noScores: { focus: 1 }
  },
  {
    id: "image-020",
    question: "失敗してもまた挑戦したい",
    visual: "再チャレンジ",
    image: image("photo-1519389950473-47ba0277781c"),
    yesScores: { challenge: 2 },
    noScores: { stability: 1 }
  },
  {
    id: "image-021",
    question: "興味があることは徹底的に調べる",
    visual: "本・検索",
    image: image("photo-1516321497487-e288fb19713f"),
    yesScores: { focus: 2 },
    noScores: { execution: 1 }
  },
  {
    id: "image-022",
    question: "新しい企画を考えるのが好き",
    visual: "企画会議",
    image: image("photo-1553877522-43269d4ea984"),
    yesScores: { creativity: 2 },
    noScores: { stability: 1 }
  },
  {
    id: "image-023",
    question: "優先順位を付けて行動できる",
    visual: "タスク整理",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { creativity: 1 }
  },
  {
    id: "image-024",
    question: "慣れた環境の方が安心できる",
    visual: "落ち着いたオフィス",
    image: image("photo-1497366811353-6870744d04b2"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 }
  },
  {
    id: "image-025",
    question: "相手と丁寧に信頼関係を築きたい",
    visual: "握手・交流",
    image: image("photo-1521791136064-7986c2920216"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 }
  },
  {
    id: "image-026",
    question: "同じ毎日より変化が欲しい",
    visual: "分かれ道",
    image: image("photo-1500530855697-b586d89ba3ee"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 }
  },
  {
    id: "image-027",
    question: "集中すると時間を忘れる",
    visual: "作業に没頭",
    image: image("photo-1516321318423-f06f85e504b3"),
    yesScores: { focus: 2 },
    noScores: { people: 1 }
  },
  {
    id: "image-028",
    question: "人とは違う発想をすることが多い",
    visual: "電球・アイデア",
    image: image("photo-1497366216548-37526070297c"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 }
  },
  {
    id: "image-029",
    question: "考えるより先に動くことが多い",
    visual: "行動開始",
    image: image("photo-1504384308090-c894fdcc538d"),
    yesScores: { execution: 2 },
    noScores: { focus: 2 }
  },
  {
    id: "image-030",
    question: "リスクはできるだけ避けたい",
    visual: "安全な道を選ぶ",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 }
  },
  {
    id: "image-031",
    question: "初対面でも打ち解けるのが早い",
    visual: "笑顔で会話",
    image: image("photo-1521737604893-d14cc237f11d"),
    yesScores: { people: 2 },
    noScores: { focus: 1 }
  },
  {
    id: "image-032",
    question: "新しい仕事を任されると嬉しい",
    visual: "新しい案件",
    image: image("photo-1497366754035-f200968a6e72"),
    yesScores: { challenge: 2 },
    noScores: { stability: 1 }
  },
  {
    id: "image-033",
    question: "相手の役に立つ専門知識を磨きたい",
    visual: "専門職",
    image: image("photo-1518770660439-4636190af475"),
    yesScores: { focus: 2, people: 1 },
    noScores: { people: 1 }
  },
  {
    id: "image-034",
    question: "何もないところから作るのが好き",
    visual: "真っ白なキャンバス",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 }
  },
  {
    id: "image-035",
    question: "計画を立てて実行するのが得意",
    visual: "ガントチャート",
    image: image("photo-1551434678-e076c223a692"),
    yesScores: { execution: 2 },
    noScores: { creativity: 1 }
  },
  {
    id: "image-036",
    question: "長く安心して働ける職場を選びたい",
    visual: "オフィス",
    image: image("photo-1524758631624-e2822e304c36"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 }
  },
  {
    id: "image-037",
    question: "仲間の状況を見ながら成果を支えたい",
    visual: "チームで達成",
    image: image("photo-1556761175-b413da4baf72"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 }
  },
  {
    id: "image-038",
    question: "将来は自分で何か始めてみたい",
    visual: "起業・プロジェクト",
    image: image("photo-1556761175-129418cb2dfe"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 }
  },
  {
    id: "image-039",
    question: "一つの分野を極めたい",
    visual: "職人・研究者",
    image: image("photo-1532619675605-1ede6c2ed2b0"),
    yesScores: { focus: 2 },
    noScores: { creativity: 1 }
  },
  {
    id: "image-040",
    question: "面白いアイデアを形にしたい",
    visual: "試作品・デザイン",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 }
  }
];

export const DEFAULT_RESULTS = {
  people_challenge: {
    name: "巻き込みチャレンジャー",
    catchCopy: "人を巻き込み、新しい挑戦を楽しみながら道を切り拓くタイプ",
    description: [
      "あなたは、人とのつながりを大切にしながら、新しいことへ積極的に挑戦できるタイプです。",
      "目標が決まると自ら動き出し、周囲を巻き込みながら前へ進める力があります。変化の多い環境でも柔軟に対応でき、困難な状況でも成長のチャンスと捉えられるのが特徴です。",
      "一方で、勢いで行動してしまうこともあるため、計画性や振り返りを意識すると、さらに大きな成果につながります。"
    ].join("\n"),
    strengths: ["コミュニケーション力", "行動力", "挑戦心", "周囲を巻き込むリーダーシップ", "柔軟な対応力"],
    jobs: ["法人営業", "事業開発", "マーケティング", "キャリアアドバイザー", "コンサルタント"],
    industries: ["IT", "Web", "人材", "広告", "ベンチャー企業"],
    lineMessage: [
      "診断結果は**「巻き込みチャレンジャー」**でした！",
      "あなたは、人とのつながりを活かしながら新しい挑戦を楽しめるタイプです。変化の多い環境ほどあなたの強みが発揮されます。"
    ].join("\n"),
    percent: 8
  },
  people_focus: {
    name: "共感型スペシャリスト",
    catchCopy: "人への理解と専門性を兼ね備えた信頼されるタイプ",
    description: [
      "あなたは、人との信頼関係を大切にしながら、自分の専門性を磨き続けられるタイプです。",
      "相手の話を丁寧に聞き、本当に必要なことを見極めて行動できます。派手に目立つよりも、確かな知識や経験で周囲から信頼されることが多いでしょう。",
      "専門性を磨き続けることで、長く活躍できるキャリアを築きやすいタイプです。"
    ].join("\n"),
    strengths: ["共感力", "専門知識", "分析力", "丁寧なコミュニケーション", "信頼関係を築く力"],
    jobs: ["人事", "キャリアアドバイザー", "カスタマーサクセス", "エンジニア", "教育職"],
    industries: ["人材", "IT", "教育", "医療", "福祉"],
    lineMessage: [
      "診断結果は**「共感型スペシャリスト」**でした！",
      "相手を理解する力と専門性を活かして、周囲から信頼される存在になれるタイプです。"
    ].join("\n"),
    percent: 7
  },
  people_stability: {
    name: "安心サポーター",
    catchCopy: "周囲を支え、安心感を生み出す縁の下の力持ち",
    description: [
      "あなたは、人との調和を大切にしながら、安定した環境で着実に成果を積み重ねるタイプです。",
      "困っている人を自然にサポートできるため、チームでは欠かせない存在になります。目立つ役割よりも、組織全体を支えるポジションで本来の力を発揮します。",
      "誠実さと責任感があなたの大きな武器です。"
    ].join("\n"),
    strengths: ["協調性", "誠実さ", "継続力", "サポート力", "責任感"],
    jobs: ["総務", "一般事務", "カスタマーサポート", "医療事務", "人事"],
    industries: ["医療", "福祉", "教育", "インフラ", "公共"],
    lineMessage: [
      "診断結果は**「安心サポーター」**でした！",
      "あなたは、周囲から信頼され、組織を支えることで大きな価値を発揮するタイプです。"
    ].join("\n"),
    percent: 9
  },
  people_creativity: {
    name: "アイデアプロデューサー",
    catchCopy: "人との対話から新しい価値を生み出すタイプ",
    description: [
      "あなたは、人とのコミュニケーションを通して、新しいアイデアや企画を生み出すことが得意なタイプです。",
      "さまざまな価値観に触れることで発想が広がり、人と人、アイデアとアイデアをつなげる役割を自然と担います。",
      "自由に考え、企画し、形にしていける環境で能力を発揮します。"
    ].join("\n"),
    strengths: ["発想力", "企画力", "コミュニケーション力", "柔軟性", "プレゼンテーション力"],
    jobs: ["商品企画", "広報", "SNSマーケター", "ディレクター", "イベントプランナー"],
    industries: ["広告", "エンターテインメント", "Web", "出版", "IT"],
    lineMessage: [
      "診断結果は**「アイデアプロデューサー」**でした！",
      "人とのつながりから新しい価値を生み出せる、発想力豊かなタイプです。"
    ].join("\n"),
    percent: 6
  },
  people_execution: {
    name: "チームリーダー",
    catchCopy: "人をまとめ、最後までやり遂げる実行型タイプ",
    description: [
      "あなたは、人との協力を大切にしながら、目標達成まで責任を持って行動できるタイプです。",
      "アイデアを考えるだけではなく、周囲をまとめ、実際に成果へつなげる実行力があります。責任感が強く、自然とリーダー役を任されることも少なくありません。",
      "メンバーと協力しながら成果を出す環境で、あなたの魅力が最も発揮されます。"
    ].join("\n"),
    strengths: ["実行力", "リーダーシップ", "責任感", "チームマネジメント", "調整力"],
    jobs: ["プロジェクトマネージャー", "営業マネージャー", "店長", "人事", "コンサルタント"],
    industries: ["IT", "メーカー", "人材", "小売", "コンサルティング"],
    lineMessage: [
      "診断結果は**「チームリーダー」**でした！",
      "周囲と協力しながら、最後までやり遂げる力があなたの最大の強みです。"
    ].join("\n"),
    percent: 8
  },
  focus_challenge: {
    name: "探究チャレンジャー",
    catchCopy: "専門性を磨きながら、新しい挑戦を楽しむタイプ",
    description: [
      "あなたは、一つの分野を深く学びながら、その知識を新しい挑戦へ活かしていくタイプです。",
      "未知の分野にも興味を持ちますが、勢いだけではなく、自分で調べて理解してから行動する慎重さも兼ね備えています。",
      "学び続ける姿勢が強みであり、経験を積むほど市場価値が高まっていくでしょう。"
    ].join("\n"),
    strengths: ["探究心", "学習意欲", "分析力", "挑戦心", "問題解決力"],
    jobs: ["エンジニア", "データアナリスト", "コンサルタント", "研究開発", "UXリサーチャー"],
    industries: ["IT", "AI", "コンサルティング", "メーカー", "研究機関"],
    lineMessage: [
      "診断結果は**「探究チャレンジャー」**でした！",
      "学び続けることを楽しみ、その知識を新しい挑戦へ活かせるタイプです。"
    ].join("\n"),
    percent: 5
  },
  focus_stability: {
    name: "堅実スペシャリスト",
    catchCopy: "正確さと継続力で信頼を積み重ねるタイプ",
    description: [
      "あなたは、専門知識をコツコツ積み重ねながら、安定した成果を出すことが得意なタイプです。",
      "一度身につけた知識を着実に活かし、高い品質で仕事を進められるため、周囲から厚い信頼を得られます。",
      "派手さよりも、長く安定して活躍できる環境が向いています。"
    ].join("\n"),
    strengths: ["集中力", "継続力", "正確性", "専門知識", "誠実さ"],
    jobs: ["システムエンジニア", "経理", "品質管理", "研究職", "インフラエンジニア"],
    industries: ["IT", "金融", "メーカー", "インフラ", "医療"],
    lineMessage: [
      "診断結果は**「堅実スペシャリスト」**でした！",
      "正確さと継続力を武器に、着実な成果を積み重ねられるタイプです。"
    ].join("\n"),
    percent: 10
  },
  focus_creativity: {
    name: "クリエイティブスペシャリスト",
    catchCopy: "専門性と発想力で新しい価値を生み出すタイプ",
    description: [
      "あなたは、一つの分野を深く学びながら、新しいアイデアや表現へつなげることが得意なタイプです。",
      "知識を蓄えるだけではなく、それを独自の視点で組み合わせ、新しい価値として形にできます。",
      "自由な発想と専門性の両方が求められる仕事で能力を発揮します。"
    ].join("\n"),
    strengths: ["発想力", "専門性", "分析力", "探究心", "創造力"],
    jobs: ["UI/UXデザイナー", "Webデザイナー", "商品企画", "コンテンツクリエイター", "編集者"],
    industries: ["Web", "デザイン", "広告", "エンターテインメント", "IT"],
    lineMessage: [
      "診断結果は**「クリエイティブスペシャリスト」**でした！",
      "専門知識と発想力を掛け合わせ、新しい価値を生み出せるタイプです。"
    ].join("\n"),
    percent: 6
  },
  focus_execution: {
    name: "実行型スペシャリスト",
    catchCopy: "考えるだけで終わらず、成果まで形にするタイプ",
    description: [
      "あなたは、専門知識を身につけるだけでなく、それを確実に実行へ移せるタイプです。",
      "計画を立て、最後までやり遂げる力があり、難しい仕事でも粘り強く取り組めます。",
      "知識と実行力を兼ね備えているため、専門職として高い評価を得られるでしょう。"
    ].join("\n"),
    strengths: ["実行力", "集中力", "継続力", "問題解決力", "責任感"],
    jobs: ["システムエンジニア", "プロジェクトマネージャー", "機械設計", "データサイエンティスト", "品質保証"],
    industries: ["IT", "メーカー", "AI", "通信", "コンサルティング"],
    lineMessage: [
      "診断結果は**「実行型スペシャリスト」**でした！",
      "専門性を成果へ変える力が、あなたの最大の武器です。"
    ].join("\n"),
    percent: 7
  },
  challenge_stability: {
    name: "バランスチャレンジャー",
    catchCopy: "挑戦する勇気と冷静な判断力を兼ね備えたタイプ",
    description: [
      "あなたは、新しいことに挑戦したい気持ちと、リスクを見極める冷静さを兼ね備えています。",
      "勢いだけではなく、計画を立ててから行動できるため、大きな失敗を避けながら着実に成長していけます。",
      "変化のある環境でも、周囲から信頼される存在になれるでしょう。"
    ].join("\n"),
    strengths: ["判断力", "計画性", "挑戦心", "柔軟性", "バランス感覚"],
    jobs: ["プロジェクトマネージャー", "事業企画", "商品企画", "コンサルタント", "経営企画"],
    industries: ["IT", "メーカー", "コンサルティング", "人材", "金融"],
    lineMessage: [
      "診断結果は**「バランスチャレンジャー」**でした！",
      "挑戦する勇気と冷静な判断力を活かし、着実に成果を積み重ねられるタイプです。"
    ].join("\n"),
    percent: 8
  },
  challenge_creativity: {
    name: "イノベーター",
    catchCopy: "挑戦することで、新しい価値を生み出すタイプ",
    description: [
      "あなたは、未知のことへの好奇心が強く、新しいアイデアを形にすることにやりがいを感じるタイプです。",
      "既存のやり方にとらわれず、「もっと良い方法はないか」と考えることが自然にできます。失敗を恐れず挑戦する姿勢が、新しいサービスや仕組みを生み出す原動力になります。",
      "変化の速い環境や、自分のアイデアを活かせる仕事で大きく成長できるでしょう。"
    ].join("\n"),
    strengths: ["発想力", "挑戦心", "柔軟性", "好奇心", "企画力"],
    jobs: ["新規事業開発", "商品企画", "UXデザイナー", "起業家", "マーケター"],
    industries: ["IT", "Web", "広告", "スタートアップ", "エンターテインメント"],
    lineMessage: [
      "診断結果は**「イノベーター」**でした！",
      "あなたは、新しい価値を生み出し、変化を楽しみながら成長できるタイプです。"
    ].join("\n"),
    percent: 5
  },
  challenge_execution: {
    name: "行動派リーダー",
    catchCopy: "挑戦を行動に変え、周囲を引っ張るタイプ",
    description: [
      "あなたは、考えるだけで終わらず、まず行動して経験を積むことを大切にするタイプです。",
      "新しい環境にも積極的に飛び込み、失敗から学びながら前へ進むことができます。その姿勢が周囲にも良い影響を与え、自然とリーダー役を任されることも多いでしょう。",
      "スピード感のある環境や裁量の大きな仕事で力を発揮します。"
    ].join("\n"),
    strengths: ["行動力", "実行力", "リーダーシップ", "決断力", "挑戦心"],
    jobs: ["営業", "事業開発", "プロジェクトマネージャー", "店舗マネージャー", "起業家"],
    industries: ["IT", "人材", "Web", "コンサルティング", "ベンチャー企業"],
    lineMessage: [
      "診断結果は**「行動派リーダー」**でした！",
      "挑戦を恐れず、まず行動できることがあなたの大きな強みです。"
    ].join("\n"),
    percent: 7
  },
  stability_creativity: {
    name: "改善クリエイター",
    catchCopy: "安定した環境の中で、新しい工夫を生み出すタイプ",
    description: [
      "あなたは、基盤を大切にしながら、より良い仕組みやアイデアを考えることが得意なタイプです。",
      "ゼロから何かを作るだけでなく、「今あるものをもっと良くする」視点に優れています。小さな改善を積み重ねることで、大きな成果を生み出せるでしょう。",
      "品質向上や業務改善など、継続的な成長が求められる仕事に向いています。"
    ].join("\n"),
    strengths: ["改善力", "発想力", "計画性", "継続力", "問題発見力"],
    jobs: ["業務改善", "品質管理", "商品企画", "UI/UXデザイナー", "生産管理"],
    industries: ["メーカー", "IT", "インフラ", "医療", "Web"],
    lineMessage: [
      "診断結果は**「改善クリエイター」**でした！",
      "安定した基盤の上で、より良い仕組みや価値を生み出せるタイプです。"
    ].join("\n"),
    percent: 7
  },
  stability_execution: {
    name: "実務エキスパート",
    catchCopy: "着実な仕事で成果を積み重ねるタイプ",
    description: [
      "あなたは、責任感が強く、一つひとつの仕事を丁寧に最後までやり遂げるタイプです。",
      "決められたルールや手順を守りながら、高い品質で仕事を進めることができます。派手さはなくても、組織にとって欠かせない存在として信頼を集めるでしょう。",
      "長く働き続けられる環境で、本来の力を発揮します。"
    ].join("\n"),
    strengths: ["継続力", "責任感", "正確性", "実行力", "計画性"],
    jobs: ["経理", "総務", "品質保証", "生産管理", "インフラエンジニア"],
    industries: ["金融", "メーカー", "インフラ", "医療", "公共"],
    lineMessage: [
      "診断結果は**「実務エキスパート」**でした！",
      "着実に成果を積み重ね、周囲から厚い信頼を得られるタイプです。"
    ].join("\n"),
    percent: 9
  },
  creativity_execution: {
    name: "企画プロデューサー",
    catchCopy: "アイデアを形にし、成果まで導くタイプ",
    description: [
      "あなたは、自由な発想だけで終わらず、それを実際の成果へつなげることができるタイプです。",
      "新しい企画を考えるだけでなく、計画を立て、関係者を巻き込みながら実現までやり切る力があります。",
      "企画と実行の両方を担えるため、プロジェクト全体を動かす中心人物として活躍できるでしょう。"
    ].join("\n"),
    strengths: ["企画力", "実行力", "発想力", "調整力", "プロジェクト推進力"],
    jobs: ["プロデューサー", "プロジェクトマネージャー", "商品企画", "ディレクター", "マーケター"],
    industries: ["Web", "IT", "広告", "エンターテインメント", "メディア"],
    lineMessage: [
      "診断結果は**「企画プロデューサー」**でした！",
      "アイデアを形にし、最後までやり遂げる力があなたの最大の武器です。"
    ].join("\n"),
    percent: 6
  }
};

export const RESULT_PAIRS = {
  people_challenge: ["people", "challenge"],
  people_focus: ["people", "focus"],
  people_stability: ["people", "stability"],
  people_creativity: ["people", "creativity"],
  people_execution: ["people", "execution"],
  focus_challenge: ["focus", "challenge"],
  focus_stability: ["focus", "stability"],
  focus_creativity: ["focus", "creativity"],
  focus_execution: ["focus", "execution"],
  challenge_stability: ["challenge", "stability"],
  challenge_creativity: ["challenge", "creativity"],
  challenge_execution: ["challenge", "execution"],
  stability_creativity: ["stability", "creativity"],
  stability_execution: ["stability", "execution"],
  creativity_execution: ["creativity", "execution"]
};

export const DEFAULT_SETTINGS = {
  comparisonCount: 18542,
  jobCount: 12,
  highMatchCount: 4,
  requireLineBeforeResult: false,
  resultOverrides: {},
  cardOverrides: {}
};

export const STORAGE_KEYS = {
  adminSettings: "ai-career-admin-settings",
  diagnosisDraft: "ai-career-diagnosis-draft",
  lineConnection: "ai-career-line-connection",
  eventLog: "ai-career-event-log",
  visitorId: "ai-career-visitor-id",
  sessionId: "ai-career-session-id",
  funnelId: "ai-career-funnel-id",
  utm: "ai-career-utm"
};

export function getResultKey(primaryAxis, secondaryAxis) {
  return (
    Object.entries(RESULT_PAIRS).find(([, axes]) => {
      return axes.includes(primaryAxis) && axes.includes(secondaryAxis);
    })?.[0] ?? "people_challenge"
  );
}

export function loadAdminSettings() {
  try {
    const saved = JSON.parse(localStorage.getItem(STORAGE_KEYS.adminSettings) || "{}");
    return {
      ...DEFAULT_SETTINGS,
      ...saved,
      resultOverrides: saved.resultOverrides || {},
      cardOverrides: saved.cardOverrides || {}
    };
  } catch {
    return { ...DEFAULT_SETTINGS };
  }
}

export function saveAdminSettings(settings) {
  localStorage.setItem(
    STORAGE_KEYS.adminSettings,
    JSON.stringify({
      ...DEFAULT_SETTINGS,
      ...settings,
      resultOverrides: settings.resultOverrides || {},
      cardOverrides: settings.cardOverrides || {}
    })
  );
}

export function buildSettingsFromMaster(master = {}) {
  const remoteSettings = master.settings || {};
  const resultOverrides = {};
  const cardOverrides = {};

  (master.results || []).forEach((result) => {
    if (!result.resultType) return;
    resultOverrides[result.resultType] = {
      name: result.name || "",
      catchCopy: result.catchCopy || "",
      description: result.description || "",
      strengths: Array.isArray(result.strengths) ? result.strengths : [],
      jobs: Array.isArray(result.jobs) ? result.jobs : [],
      industries: Array.isArray(result.industries) ? result.industries : [],
      lineMessage: result.lineMessage || "",
      percent: Number(result.percent || 8)
    };
  });

  (master.cards || []).forEach((card) => {
    if (!card.id) return;
    cardOverrides[card.id] = {
      question: card.question || "",
      visual: card.visual || "",
      image: card.image || "",
      imageStoragePath: card.imageStoragePath || "",
      yesScores: card.yesScores || {},
      noScores: card.noScores || {}
    };
  });

  return {
    ...DEFAULT_SETTINGS,
    comparisonCount: Number(remoteSettings.comparisonCount ?? DEFAULT_SETTINGS.comparisonCount),
    jobCount: Number(remoteSettings.jobCount ?? DEFAULT_SETTINGS.jobCount),
    highMatchCount: Number(remoteSettings.highMatchCount ?? DEFAULT_SETTINGS.highMatchCount),
    requireLineBeforeResult: Boolean(
      remoteSettings.requireLineBeforeResult ?? DEFAULT_SETTINGS.requireLineBeforeResult
    ),
    resultOverrides,
    cardOverrides
  };
}

export function serializeSettingsForMaster(settings = loadAdminSettings()) {
  const mergedSettings = {
    ...DEFAULT_SETTINGS,
    ...settings,
    resultOverrides: settings.resultOverrides || {},
    cardOverrides: settings.cardOverrides || {}
  };

  return {
    settings: {
      comparisonCount: Number(mergedSettings.comparisonCount || 0),
      jobCount: Number(mergedSettings.jobCount || 0),
      highMatchCount: Number(mergedSettings.highMatchCount || 0),
      requireLineBeforeResult: Boolean(mergedSettings.requireLineBeforeResult)
    },
    results: Object.entries(getConfiguredResults(mergedSettings)).map(([key, result], index) => ({
      resultType: key,
      name: result.name,
      catchCopy: result.catchCopy,
      description: result.description,
      strengths: result.strengths,
      jobs: result.jobs,
      industries: result.industries,
      lineMessage: result.lineMessage,
      percent: result.percent,
      sortOrder: index + 1
    })),
    cards: getConfiguredCards(mergedSettings).map((card, index) => ({
      id: card.id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.imageStoragePath || "",
      yesScores: card.yesScores,
      noScores: card.noScores,
      sortOrder: index + 1
    }))
  };
}

export function getConfiguredCards(settings = loadAdminSettings()) {
  return DEFAULT_CARDS.map((card) => ({
    ...card,
    ...(settings.cardOverrides?.[card.id] || {})
  }));
}

export function getConfiguredResults(settings = loadAdminSettings()) {
  const overrides = settings.resultOverrides || {};
  return Object.fromEntries(
    Object.entries(DEFAULT_RESULTS).map(([key, result]) => [
      key,
      {
        ...result,
        ...(overrides[key] || {}),
        strengths: overrides[key]?.strengths || result.strengths,
        jobs: overrides[key]?.jobs || result.jobs,
        industries: overrides[key]?.industries || result.industries
      }
    ])
  );
}
