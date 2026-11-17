export const AXIS_ORDER = [
  "people",
  "focus",
  "challenge",
  "stability",
  "creativity",
  "execution",
];

export const AXES = {
  people: { label: "People", short: "人との関わり", color: "#ff4d6d" },
  focus: { label: "Focus", short: "集中力", color: "#3a86ff" },
  challenge: { label: "Challenge", short: "挑戦", color: "#ff9f1c" },
  stability: { label: "Stability", short: "安定", color: "#2a9d8f" },
  creativity: { label: "Creativity", short: "発想力", color: "#8338ec" },
  execution: { label: "Execution", short: "実行力", color: "#111111" },
};

// 80問QUESTION BANK対応：5つのWORK DNA（新エンジン用のメーター表示に使う）
export const DNA_AXES = {
  challenge: { label: "挑戦", color: "#ff9f1c" },
  people: { label: "対人", color: "#ff4d6d" },
  creativity: { label: "創造", color: "#8338ec" },
  analysis: { label: "分析", color: "#3a86ff" },
  stability: { label: "安定", color: "#2a9d8f" },
};

// 16タイプが属する8系統ごとのテーマカラー（結果カードのグラデーションに使用）
export const TYPE_CATEGORY_COLOR = {
  FRONTIER: "#E94B35",
  EXPLORER: "#E94B35",
  CREATOR: "#9B59B6",
  VISIONARY: "#9B59B6",
  SEEKER: "#3F6FB6",
  STRATEGIST: "#3F6FB6",
  DRIVER: "#F28C28",
  COMMANDER: "#F28C28",
  CONNECTOR: "#E96F8C",
  CATALYST: "#E96F8C",
  GUARDIAN: "#D6A62E",
  STEWARD: "#D6A62E",
  ARCHITECT: "#2FA7A0",
  BUILDER: "#2FA7A0",
  MENTOR: "#69A84F",
  EMPOWERER: "#69A84F",
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
    noScores: { focus: 2 },
  },
  {
    id: "image-002",
    question: "新しい環境に入るとワクワクする",
    visual: "新しい扉を開ける人",
    image: image("photo-1500530855697-b586d89ba3ee"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-003",
    question: "一人で静かに作業する時間が好き",
    visual: "一人でPCに向かう人",
    image: image("photo-1486312338219-ce68d2c6f44d"),
    yesScores: { focus: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-004",
    question: "アイデアを考えている時間が楽しい",
    visual: "ブレインストーミング",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-005",
    question: "思いついたらすぐ行動する方だ",
    visual: "すぐ動き出す人",
    image: image("photo-1542744173-8e7e53415bb0"),
    yesScores: { execution: 2 },
    noScores: { focus: 1 },
  },
  {
    id: "image-006",
    question: "決まったスケジュールの方が安心する",
    visual: "手帳・スケジュール帳",
    image: image("photo-1506784983877-45594efa4cbe"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-007",
    question: "チームで協力する方が好き",
    visual: "グループワーク",
    image: image("photo-1517048676732-d65bc937f952"),
    yesScores: { people: 1 },
    noScores: { focus: 1 },
  },
  {
    id: "image-008",
    question: "未経験でも挑戦してみたい",
    visual: "初めての体験",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { challenge: 1 },
    noScores: { stability: 1 },
  },
  {
    id: "image-009",
    question: "細かいミスによく気付く",
    visual: "書類チェック",
    image: image("photo-1454165804606-c3d57bc86b40"),
    yesScores: { focus: 2 },
    noScores: { creativity: 1 },
  },
  {
    id: "image-010",
    question: "正解のない問題を考えるのが好き",
    visual: "アイデア会議",
    image: image("photo-1497366754035-f200968a6e72"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 },
  },
  {
    id: "image-011",
    question: "やることは先に終わらせたい",
    visual: "タスク完了",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { stability: 1 },
  },
  {
    id: "image-012",
    question: "ルールが明確な方が働きやすい",
    visual: "マニュアルを見る人",
    image: image("photo-1497215728101-856f4ea42174"),
    yesScores: { stability: 2 },
    noScores: { challenge: 1 },
  },
  {
    id: "image-013",
    question: "人の相談をじっくり聞くことが好き",
    visual: "相談を受ける場面",
    image: image("photo-1551836022-d5d88e9218df"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 },
  },
  {
    id: "image-014",
    question: "難しい目標ほど燃える",
    visual: "高い山を登る人",
    image: image("photo-1464822759023-fed622ff2c3b"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-015",
    question: "一つのことを深く学びたい",
    visual: "勉強・研究",
    image: image("photo-1524995997946-a1c2e315a42f"),
    yesScores: { focus: 2 },
    noScores: { challenge: 1 },
  },
  {
    id: "image-016",
    question: "自分らしい作品を作るのが好き",
    visual: "デザイン制作",
    image: image("photo-1523726491678-bf852e717f6a"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 },
  },
  {
    id: "image-017",
    question: "最後まで責任を持ってやり遂げたい",
    visual: "ゴールする人",
    image: image("photo-1517245386807-bb43f82c33c4"),
    yesScores: { execution: 2 },
    noScores: { people: 1 },
  },
  {
    id: "image-018",
    question: "安定した収入は大切だと思う",
    visual: "給与明細・家計",
    image: image("photo-1554224155-6726b3ff858f"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-019",
    question: "人前で話すことは苦ではない",
    visual: "プレゼン",
    image: image("photo-1557804506-669a67965ba0"),
    yesScores: { people: 2 },
    noScores: { focus: 1 },
  },
  {
    id: "image-020",
    question: "失敗してもまた挑戦したい",
    visual: "再チャレンジ",
    image: image("photo-1519389950473-47ba0277781c"),
    yesScores: { challenge: 2 },
    noScores: { stability: 1 },
  },
  {
    id: "image-021",
    question: "興味があることは徹底的に調べる",
    visual: "本・検索",
    image: image("photo-1516321497487-e288fb19713f"),
    yesScores: { focus: 2 },
    noScores: { execution: 1 },
  },
  {
    id: "image-022",
    question: "新しい企画を考えるのが好き",
    visual: "企画会議",
    image: image("photo-1553877522-43269d4ea984"),
    yesScores: { creativity: 2 },
    noScores: { stability: 1 },
  },
  {
    id: "image-023",
    question: "優先順位を付けて行動できる",
    visual: "タスク整理",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { creativity: 1 },
  },
  {
    id: "image-024",
    question: "慣れた環境の方が安心できる",
    visual: "落ち着いたオフィス",
    image: image("photo-1497366811353-6870744d04b2"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-025",
    question: "相手と丁寧に信頼関係を築きたい",
    visual: "握手・交流",
    image: image("photo-1521791136064-7986c2920216"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 },
  },
  {
    id: "image-026",
    question: "同じ毎日より変化が欲しい",
    visual: "分かれ道",
    image: image("photo-1500530855697-b586d89ba3ee"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-027",
    question: "集中すると時間を忘れる",
    visual: "作業に没頭",
    image: image("photo-1516321318423-f06f85e504b3"),
    yesScores: { focus: 2 },
    noScores: { people: 1 },
  },
  {
    id: "image-028",
    question: "人とは違う発想をすることが多い",
    visual: "電球・アイデア",
    image: image("photo-1497366216548-37526070297c"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 },
  },
  {
    id: "image-029",
    question: "考えるより先に動くことが多い",
    visual: "行動開始",
    image: image("photo-1504384308090-c894fdcc538d"),
    yesScores: { execution: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-030",
    question: "リスクはできるだけ避けたい",
    visual: "安全な道を選ぶ",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-031",
    question: "初対面でも打ち解けるのが早い",
    visual: "笑顔で会話",
    image: image("photo-1521737604893-d14cc237f11d"),
    yesScores: { people: 2 },
    noScores: { focus: 1 },
  },
  {
    id: "image-032",
    question: "新しい仕事を任されると嬉しい",
    visual: "新しい案件",
    image: image("photo-1497366754035-f200968a6e72"),
    yesScores: { challenge: 2 },
    noScores: { stability: 1 },
  },
  {
    id: "image-033",
    question: "相手の役に立つ専門知識を磨きたい",
    visual: "専門職",
    image: image("photo-1518770660439-4636190af475"),
    yesScores: { focus: 2, people: 1 },
    noScores: { people: 1 },
  },
  {
    id: "image-034",
    question: "何もないところから作るのが好き",
    visual: "真っ白なキャンバス",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { creativity: 2 },
    noScores: { execution: 1 },
  },
  {
    id: "image-035",
    question: "計画を立てて実行するのが得意",
    visual: "ガントチャート",
    image: image("photo-1551434678-e076c223a692"),
    yesScores: { execution: 2 },
    noScores: { creativity: 1 },
  },
  {
    id: "image-036",
    question: "長く安心して働ける職場を選びたい",
    visual: "オフィス",
    image: image("photo-1524758631624-e2822e304c36"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-037",
    question: "仲間の状況を見ながら成果を支えたい",
    visual: "チームで達成",
    image: image("photo-1556761175-b413da4baf72"),
    yesScores: { people: 2, focus: 1 },
    noScores: { focus: 1 },
  },
  {
    id: "image-038",
    question: "将来は自分で何か始めてみたい",
    visual: "起業・プロジェクト",
    image: image("photo-1556761175-129418cb2dfe"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-039",
    question: "一つの分野を極めたい",
    visual: "職人・研究者",
    image: image("photo-1532619675605-1ede6c2ed2b0"),
    yesScores: { focus: 2 },
    noScores: { creativity: 1 },
  },
  {
    id: "image-040",
    question: "面白いアイデアを形にしたい",
    visual: "試作品・デザイン",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-041",
    question: "新しいことも、仲間を巻き込みながら進めたい",
    visual: "仲間と新しい挑戦",
    image: image("photo-1517048676732-d65bc937f952"),
    yesScores: { people: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-042",
    question: "周りが迷っていても、まず自分で試してみたい",
    visual: "一歩踏み出す人",
    image: image("photo-1500530855697-b586d89ba3ee"),
    yesScores: { challenge: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-043",
    question: "初めての場所でも人とのつながりを作るのが得意",
    visual: "新しい場で交流",
    image: image("photo-1521737604893-d14cc237f11d"),
    yesScores: { people: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-044",
    question: "変化のある環境に飛び込む方が成長できる",
    visual: "変化のある道",
    image: image("photo-1464822759023-fed622ff2c3b"),
    yesScores: { challenge: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-045",
    question: "相手の気持ちを汲み取りながら専門性を活かしたい",
    visual: "相手に寄り添う専門家",
    image: image("photo-1551836022-d5d88e9218df"),
    yesScores: { people: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-046",
    question: "誰にも邪魔されず一つのテーマを深く考えたい",
    visual: "静かな探究時間",
    image: image("photo-1486312338219-ce68d2c6f44d"),
    yesScores: { focus: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-047",
    question: "困っている人に寄り添って解決策を探したい",
    visual: "相談と解決",
    image: image("photo-1521791136064-7986c2920216"),
    yesScores: { people: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-048",
    question: "感覚よりも、根拠を集めて判断したい",
    visual: "資料を読み込む人",
    image: image("photo-1516321497487-e288fb19713f"),
    yesScores: { focus: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-049",
    question: "周囲が安心できるように場を整えたい",
    visual: "安心できるチーム",
    image: image("photo-1556761175-b413da4baf72"),
    yesScores: { people: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-050",
    question: "人間関係よりも、安定した仕組みがある方が落ち着く",
    visual: "整った仕組み",
    image: image("photo-1497215728101-856f4ea42174"),
    yesScores: { stability: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-051",
    question: "チームの空気が良いと自分の力も出しやすい",
    visual: "雰囲気の良い職場",
    image: image("photo-1517048676732-d65bc937f952"),
    yesScores: { people: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-052",
    question: "予定通りに進む環境の方が力を発揮できる",
    visual: "予定を確認する人",
    image: image("photo-1506784983877-45594efa4cbe"),
    yesScores: { stability: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-053",
    question: "人と話す中でアイデアが広がることが多い",
    visual: "対話から生まれる発想",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { people: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-054",
    question: "一人で考えた独自のアイデアを形にしたい",
    visual: "独自アイデアの制作",
    image: image("photo-1523726491678-bf852e717f6a"),
    yesScores: { creativity: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-055",
    question: "相手の反応を見ながら提案を磨きたい",
    visual: "提案を磨く会話",
    image: image("photo-1557804506-669a67965ba0"),
    yesScores: { people: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-056",
    question: "常識にとらわれない発想を大切にしたい",
    visual: "自由な発想",
    image: image("photo-1497366216548-37526070297c"),
    yesScores: { creativity: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-057",
    question: "チームで目標を決めて一緒にやり切りたい",
    visual: "チームで目標達成",
    image: image("photo-1556761175-b413da4baf72"),
    yesScores: { people: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-058",
    question: "まずタスクを片づけて成果を出したい",
    visual: "タスクを完了する人",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-059",
    question: "周りの力を引き出す役割が好き",
    visual: "力を引き出すリーダー",
    image: image("photo-1522202176988-66273c2fd55f"),
    yesScores: { people: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-060",
    question: "決めたことを最後まで進める自信がある",
    visual: "最後まで進める人",
    image: image("photo-1542744173-8e7e53415bb0"),
    yesScores: { execution: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-061",
    question: "新しい挑戦も、まず周りの意見を聞いて進めたい",
    visual: "意見を聞いて挑戦",
    image: image("photo-1517048676732-d65bc937f952"),
    yesScores: { people: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-062",
    question: "考えすぎる前に未知の環境へ飛び込みたい",
    visual: "未知へ飛び込む",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { challenge: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-063",
    question: "難しい課題ほど、一人で分析して攻略したい",
    visual: "一人で課題を分析",
    image: image("photo-1454165804606-c3d57bc86b40"),
    yesScores: { focus: 2 },
    noScores: { people: 2 },
  },
  {
    id: "image-064",
    question: "未経験のことでも、やりながら覚える方が早い",
    visual: "実践で学ぶ",
    image: image("photo-1519389950473-47ba0277781c"),
    yesScores: { challenge: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-065",
    question: "正確さを守りながら、見せ方にも工夫を入れたい",
    visual: "正確さと見せ方の工夫",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { focus: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-066",
    question: "安定したペースでコツコツ続けたい",
    visual: "落ち着いた作業",
    image: image("photo-1506784983877-45594efa4cbe"),
    yesScores: { stability: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-067",
    question: "細部まで確認して品質を高めたい",
    visual: "細部のチェック",
    image: image("photo-1454165804606-c3d57bc86b40"),
    yesScores: { focus: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-068",
    question: "急な変更が少ない職場だと安心して働ける",
    visual: "安定した職場",
    image: image("photo-1524758631624-e2822e304c36"),
    yesScores: { stability: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-069",
    question: "知識を組み合わせて新しい表現を作りたい",
    visual: "知識と表現",
    image: image("photo-1523726491678-bf852e717f6a"),
    yesScores: { focus: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-070",
    question: "正解を探すより、自分なりの発想を試したい",
    visual: "発想を試す",
    image: image("photo-1497366216548-37526070297c"),
    yesScores: { creativity: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-071",
    question: "専門知識を深めるほどアイデアが出やすい",
    visual: "専門知識と発想",
    image: image("photo-1518770660439-4636190af475"),
    yesScores: { focus: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-072",
    question: "まだ誰も見たことがない形を考えるのが楽しい",
    visual: "新しい形を考える",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { creativity: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-073",
    question: "考えたことを、具体的な手順に落とし込むのが得意",
    visual: "考えを手順にする",
    image: image("photo-1551434678-e076c223a692"),
    yesScores: { focus: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-074",
    question: "細かく考えるより、まず完了まで進めたい",
    visual: "完了まで進める",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-075",
    question: "複雑なことを整理してから動きたい",
    visual: "複雑さを整理",
    image: image("photo-1516321318423-f06f85e504b3"),
    yesScores: { focus: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-076",
    question: "小さくても毎日進めることが成果につながると思う",
    visual: "毎日の積み上げ",
    image: image("photo-1542744173-8e7e53415bb0"),
    yesScores: { execution: 2 },
    noScores: { focus: 2 },
  },
  {
    id: "image-077",
    question: "挑戦するときは、今までにない工夫も試したい",
    visual: "挑戦と新しい工夫",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { challenge: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-078",
    question: "変化よりも、先が読める安心感を大切にしたい",
    visual: "安心できる道",
    image: image("photo-1497366811353-6870744d04b2"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-079",
    question: "慣れない役割でもチャンスなら受けてみたい",
    visual: "新しい役割",
    image: image("photo-1497366754035-f200968a6e72"),
    yesScores: { challenge: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-080",
    question: "長く続けられる環境かどうかを重視したい",
    visual: "長く続く環境",
    image: image("photo-1524758631624-e2822e304c36"),
    yesScores: { stability: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-081",
    question: "新しい挑戦の中でアイデアを試したい",
    visual: "挑戦とアイデア",
    image: image("photo-1500534314209-a25ddb2bd429"),
    yesScores: { challenge: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-082",
    question: "自由に発想できるなら、道が決まっていなくても平気",
    visual: "自由な発想の道",
    image: image("photo-1523726491678-bf852e717f6a"),
    yesScores: { creativity: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-083",
    question: "未知のテーマほどワクワクして企画したくなる",
    visual: "未知のテーマを企画",
    image: image("photo-1553877522-43269d4ea984"),
    yesScores: { challenge: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-084",
    question: "制約があるほど、新しい工夫を考えたくなる",
    visual: "制約から生まれる工夫",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { creativity: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-085",
    question: "新しい目標があると、すぐ行動計画を立てたい",
    visual: "挑戦の行動計画",
    image: image("photo-1551434678-e076c223a692"),
    yesScores: { challenge: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-086",
    question: "迷うより、まず手を動かして前に進めたい",
    visual: "まず手を動かす",
    image: image("photo-1504384308090-c894fdcc538d"),
    yesScores: { execution: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-087",
    question: "難しい目標でも、挑戦する価値があるなら燃える",
    visual: "難しい目標へ挑戦",
    image: image("photo-1464822759023-fed622ff2c3b"),
    yesScores: { challenge: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-088",
    question: "やると決めたら途中で止めずに進めたい",
    visual: "決めたことを進める",
    image: image("photo-1517245386807-bb43f82c33c4"),
    yesScores: { execution: 2 },
    noScores: { challenge: 2 },
  },
  {
    id: "image-089",
    question: "今ある仕組みを少しずつ良くするのが好き",
    visual: "仕組みを改善",
    image: image("photo-1497215728101-856f4ea42174"),
    yesScores: { stability: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-090",
    question: "安定した土台があるほど、新しいアイデアを出しやすい",
    visual: "土台のある発想",
    image: image("photo-1497366811353-6870744d04b2"),
    yesScores: { creativity: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-091",
    question: "大きく変えるより、無理なく改善する方が得意",
    visual: "無理なく改善",
    image: image("photo-1506784983877-45594efa4cbe"),
    yesScores: { stability: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-092",
    question: "決まった枠の中でも面白い工夫はできると思う",
    visual: "枠の中の工夫",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { creativity: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-093",
    question: "安定した手順で確実に成果を出したい",
    visual: "確実に成果を出す",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { stability: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-094",
    question: "細かな準備より、動きながら形にしたい",
    visual: "動きながら形にする",
    image: image("photo-1542744173-8e7e53415bb0"),
    yesScores: { execution: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-095",
    question: "締切やルールがある方が集中して進められる",
    visual: "締切とルール",
    image: image("photo-1554224155-6726b3ff858f"),
    yesScores: { stability: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-096",
    question: "任されたことはスピード感を持って終わらせたい",
    visual: "スピード感のある実行",
    image: image("photo-1504384308090-c894fdcc538d"),
    yesScores: { execution: 2 },
    noScores: { stability: 2 },
  },
  {
    id: "image-097",
    question: "アイデアを出すだけでなく、形にするところまでやりたい",
    visual: "アイデアを形にする",
    image: image("photo-1552664730-d307ca884978"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-098",
    question: "発想よりも、まず実際に使える形へ進めたい",
    visual: "使える形にする",
    image: image("photo-1484480974693-6ca0a78fb36b"),
    yesScores: { execution: 2 },
    noScores: { creativity: 2 },
  },
  {
    id: "image-099",
    question: "新しい企画を考えると、実現方法まで想像してしまう",
    visual: "企画と実現方法",
    image: image("photo-1553877522-43269d4ea984"),
    yesScores: { creativity: 2 },
    noScores: { execution: 2 },
  },
  {
    id: "image-100",
    question: "思いついたことは、まず試作品にして確かめたい",
    visual: "試作品で確かめる",
    image: image("photo-1518005020951-eccb494ad742"),
    yesScores: { execution: 2 },
    noScores: { creativity: 2 },
  },
];

export const DEFAULT_RESULTS = {
  people_challenge: {
    name: "巻き込みチャレンジャー",
    catchCopy: "人を巻き込み、新しい挑戦を楽しみながら道を切り拓くタイプ",
    description: [
      "あなたは、人とのつながりを大切にしながら、新しいことへ積極的に挑戦できるタイプです。",
      "目標が決まると自ら動き出し、周囲を巻き込みながら前へ進める力があります。変化の多い環境でも柔軟に対応でき、困難な状況でも成長のチャンスと捉えられるのが特徴です。",
      "一方で、勢いで行動してしまうこともあるため、計画性や振り返りを意識すると、さらに大きな成果につながります。",
    ].join("\n"),
    strengths: [
      "コミュニケーション力",
      "行動力",
      "挑戦心",
      "周囲を巻き込むリーダーシップ",
      "柔軟な対応力",
    ],
    jobs: [
      "法人営業",
      "事業開発",
      "マーケティング",
      "キャリアアドバイザー",
      "コンサルタント",
    ],
    industries: ["IT", "Web", "人材", "広告", "ベンチャー企業"],
    lineMessage: [
      "診断結果は**「巻き込みチャレンジャー」**でした！",
      "あなたは、人とのつながりを活かしながら新しい挑戦を楽しめるタイプです。変化の多い環境ほどあなたの強みが発揮されます。",
    ].join("\n"),
    percent: 8,
  },
  people_focus: {
    name: "共感型スペシャリスト",
    catchCopy: "人への理解と専門性を兼ね備えた信頼されるタイプ",
    description: [
      "あなたは、人との信頼関係を大切にしながら、自分の専門性を磨き続けられるタイプです。",
      "相手の話を丁寧に聞き、本当に必要なことを見極めて行動できます。派手に目立つよりも、確かな知識や経験で周囲から信頼されることが多いでしょう。",
      "専門性を磨き続けることで、長く活躍できるキャリアを築きやすいタイプです。",
    ].join("\n"),
    strengths: [
      "共感力",
      "専門知識",
      "分析力",
      "丁寧なコミュニケーション",
      "信頼関係を築く力",
    ],
    jobs: [
      "人事",
      "キャリアアドバイザー",
      "カスタマーサクセス",
      "エンジニア",
      "教育職",
    ],
    industries: ["人材", "IT", "教育", "医療", "福祉"],
    lineMessage: [
      "診断結果は**「共感型スペシャリスト」**でした！",
      "相手を理解する力と専門性を活かして、周囲から信頼される存在になれるタイプです。",
    ].join("\n"),
    percent: 7,
  },
  people_stability: {
    name: "安心サポーター",
    catchCopy: "周囲を支え、安心感を生み出す縁の下の力持ち",
    description: [
      "あなたは、人との調和を大切にしながら、安定した環境で着実に成果を積み重ねるタイプです。",
      "困っている人を自然にサポートできるため、チームでは欠かせない存在になります。目立つ役割よりも、組織全体を支えるポジションで本来の力を発揮します。",
      "誠実さと責任感があなたの大きな武器です。",
    ].join("\n"),
    strengths: ["協調性", "誠実さ", "継続力", "サポート力", "責任感"],
    jobs: ["総務", "一般事務", "カスタマーサポート", "医療事務", "人事"],
    industries: ["医療", "福祉", "教育", "インフラ", "公共"],
    lineMessage: [
      "診断結果は**「安心サポーター」**でした！",
      "あなたは、周囲から信頼され、組織を支えることで大きな価値を発揮するタイプです。",
    ].join("\n"),
    percent: 9,
  },
  people_creativity: {
    name: "アイデアプロデューサー",
    catchCopy: "人との対話から新しい価値を生み出すタイプ",
    description: [
      "あなたは、人とのコミュニケーションを通して、新しいアイデアや企画を生み出すことが得意なタイプです。",
      "さまざまな価値観に触れることで発想が広がり、人と人、アイデアとアイデアをつなげる役割を自然と担います。",
      "自由に考え、企画し、形にしていける環境で能力を発揮します。",
    ].join("\n"),
    strengths: [
      "発想力",
      "企画力",
      "コミュニケーション力",
      "柔軟性",
      "プレゼンテーション力",
    ],
    jobs: [
      "商品企画",
      "広報",
      "SNSマーケター",
      "ディレクター",
      "イベントプランナー",
    ],
    industries: ["広告", "エンターテインメント", "Web", "出版", "IT"],
    lineMessage: [
      "診断結果は**「アイデアプロデューサー」**でした！",
      "人とのつながりから新しい価値を生み出せる、発想力豊かなタイプです。",
    ].join("\n"),
    percent: 6,
  },
  people_execution: {
    name: "チームリーダー",
    catchCopy: "人をまとめ、最後までやり遂げる実行型タイプ",
    description: [
      "あなたは、人との協力を大切にしながら、目標達成まで責任を持って行動できるタイプです。",
      "アイデアを考えるだけではなく、周囲をまとめ、実際に成果へつなげる実行力があります。責任感が強く、自然とリーダー役を任されることも少なくありません。",
      "メンバーと協力しながら成果を出す環境で、あなたの魅力が最も発揮されます。",
    ].join("\n"),
    strengths: [
      "実行力",
      "リーダーシップ",
      "責任感",
      "チームマネジメント",
      "調整力",
    ],
    jobs: [
      "プロジェクトマネージャー",
      "営業マネージャー",
      "店長",
      "人事",
      "コンサルタント",
    ],
    industries: ["IT", "メーカー", "人材", "小売", "コンサルティング"],
    lineMessage: [
      "診断結果は**「チームリーダー」**でした！",
      "周囲と協力しながら、最後までやり遂げる力があなたの最大の強みです。",
    ].join("\n"),
    percent: 8,
  },
  focus_challenge: {
    name: "探究チャレンジャー",
    catchCopy: "専門性を磨きながら、新しい挑戦を楽しむタイプ",
    description: [
      "あなたは、一つの分野を深く学びながら、その知識を新しい挑戦へ活かしていくタイプです。",
      "未知の分野にも興味を持ちますが、勢いだけではなく、自分で調べて理解してから行動する慎重さも兼ね備えています。",
      "学び続ける姿勢が強みであり、経験を積むほど市場価値が高まっていくでしょう。",
    ].join("\n"),
    strengths: ["探究心", "学習意欲", "分析力", "挑戦心", "問題解決力"],
    jobs: [
      "エンジニア",
      "データアナリスト",
      "コンサルタント",
      "研究開発",
      "UXリサーチャー",
    ],
    industries: ["IT", "AI", "コンサルティング", "メーカー", "研究機関"],
    lineMessage: [
      "診断結果は**「探究チャレンジャー」**でした！",
      "学び続けることを楽しみ、その知識を新しい挑戦へ活かせるタイプです。",
    ].join("\n"),
    percent: 5,
  },
  focus_stability: {
    name: "堅実スペシャリスト",
    catchCopy: "正確さと継続力で信頼を積み重ねるタイプ",
    description: [
      "あなたは、専門知識をコツコツ積み重ねながら、安定した成果を出すことが得意なタイプです。",
      "一度身につけた知識を着実に活かし、高い品質で仕事を進められるため、周囲から厚い信頼を得られます。",
      "派手さよりも、長く安定して活躍できる環境が向いています。",
    ].join("\n"),
    strengths: ["集中力", "継続力", "正確性", "専門知識", "誠実さ"],
    jobs: [
      "システムエンジニア",
      "経理",
      "品質管理",
      "研究職",
      "インフラエンジニア",
    ],
    industries: ["IT", "金融", "メーカー", "インフラ", "医療"],
    lineMessage: [
      "診断結果は**「堅実スペシャリスト」**でした！",
      "正確さと継続力を武器に、着実な成果を積み重ねられるタイプです。",
    ].join("\n"),
    percent: 10,
  },
  focus_creativity: {
    name: "クリエイティブスペシャリスト",
    catchCopy: "専門性と発想力で新しい価値を生み出すタイプ",
    description: [
      "あなたは、一つの分野を深く学びながら、新しいアイデアや表現へつなげることが得意なタイプです。",
      "知識を蓄えるだけではなく、それを独自の視点で組み合わせ、新しい価値として形にできます。",
      "自由な発想と専門性の両方が求められる仕事で能力を発揮します。",
    ].join("\n"),
    strengths: ["発想力", "専門性", "分析力", "探究心", "創造力"],
    jobs: [
      "UI/UXデザイナー",
      "Webデザイナー",
      "商品企画",
      "コンテンツクリエイター",
      "編集者",
    ],
    industries: ["Web", "デザイン", "広告", "エンターテインメント", "IT"],
    lineMessage: [
      "診断結果は**「クリエイティブスペシャリスト」**でした！",
      "専門知識と発想力を掛け合わせ、新しい価値を生み出せるタイプです。",
    ].join("\n"),
    percent: 6,
  },
  focus_execution: {
    name: "実行型スペシャリスト",
    catchCopy: "考えるだけで終わらず、成果まで形にするタイプ",
    description: [
      "あなたは、専門知識を身につけるだけでなく、それを確実に実行へ移せるタイプです。",
      "計画を立て、最後までやり遂げる力があり、難しい仕事でも粘り強く取り組めます。",
      "知識と実行力を兼ね備えているため、専門職として高い評価を得られるでしょう。",
    ].join("\n"),
    strengths: ["実行力", "集中力", "継続力", "問題解決力", "責任感"],
    jobs: [
      "システムエンジニア",
      "プロジェクトマネージャー",
      "機械設計",
      "データサイエンティスト",
      "品質保証",
    ],
    industries: ["IT", "メーカー", "AI", "通信", "コンサルティング"],
    lineMessage: [
      "診断結果は**「実行型スペシャリスト」**でした！",
      "専門性を成果へ変える力が、あなたの最大の武器です。",
    ].join("\n"),
    percent: 7,
  },
  challenge_stability: {
    name: "バランスチャレンジャー",
    catchCopy: "挑戦する勇気と冷静な判断力を兼ね備えたタイプ",
    description: [
      "あなたは、新しいことに挑戦したい気持ちと、リスクを見極める冷静さを兼ね備えています。",
      "勢いだけではなく、計画を立ててから行動できるため、大きな失敗を避けながら着実に成長していけます。",
      "変化のある環境でも、周囲から信頼される存在になれるでしょう。",
    ].join("\n"),
    strengths: ["判断力", "計画性", "挑戦心", "柔軟性", "バランス感覚"],
    jobs: [
      "プロジェクトマネージャー",
      "事業企画",
      "商品企画",
      "コンサルタント",
      "経営企画",
    ],
    industries: ["IT", "メーカー", "コンサルティング", "人材", "金融"],
    lineMessage: [
      "診断結果は**「バランスチャレンジャー」**でした！",
      "挑戦する勇気と冷静な判断力を活かし、着実に成果を積み重ねられるタイプです。",
    ].join("\n"),
    percent: 8,
  },
  challenge_creativity: {
    name: "イノベーター",
    catchCopy: "挑戦することで、新しい価値を生み出すタイプ",
    description: [
      "あなたは、未知のことへの好奇心が強く、新しいアイデアを形にすることにやりがいを感じるタイプです。",
      "既存のやり方にとらわれず、「もっと良い方法はないか」と考えることが自然にできます。失敗を恐れず挑戦する姿勢が、新しいサービスや仕組みを生み出す原動力になります。",
      "変化の速い環境や、自分のアイデアを活かせる仕事で大きく成長できるでしょう。",
    ].join("\n"),
    strengths: ["発想力", "挑戦心", "柔軟性", "好奇心", "企画力"],
    jobs: ["新規事業開発", "商品企画", "UXデザイナー", "起業家", "マーケター"],
    industries: ["IT", "Web", "広告", "スタートアップ", "エンターテインメント"],
    lineMessage: [
      "診断結果は**「イノベーター」**でした！",
      "あなたは、新しい価値を生み出し、変化を楽しみながら成長できるタイプです。",
    ].join("\n"),
    percent: 5,
  },
  challenge_execution: {
    name: "行動派リーダー",
    catchCopy: "挑戦を行動に変え、周囲を引っ張るタイプ",
    description: [
      "あなたは、考えるだけで終わらず、まず行動して経験を積むことを大切にするタイプです。",
      "新しい環境にも積極的に飛び込み、失敗から学びながら前へ進むことができます。その姿勢が周囲にも良い影響を与え、自然とリーダー役を任されることも多いでしょう。",
      "スピード感のある環境や裁量の大きな仕事で力を発揮します。",
    ].join("\n"),
    strengths: ["行動力", "実行力", "リーダーシップ", "決断力", "挑戦心"],
    jobs: [
      "営業",
      "事業開発",
      "プロジェクトマネージャー",
      "店舗マネージャー",
      "起業家",
    ],
    industries: ["IT", "人材", "Web", "コンサルティング", "ベンチャー企業"],
    lineMessage: [
      "診断結果は**「行動派リーダー」**でした！",
      "挑戦を恐れず、まず行動できることがあなたの大きな強みです。",
    ].join("\n"),
    percent: 7,
  },
  stability_creativity: {
    name: "改善クリエイター",
    catchCopy: "安定した環境の中で、新しい工夫を生み出すタイプ",
    description: [
      "あなたは、基盤を大切にしながら、より良い仕組みやアイデアを考えることが得意なタイプです。",
      "ゼロから何かを作るだけでなく、「今あるものをもっと良くする」視点に優れています。小さな改善を積み重ねることで、大きな成果を生み出せるでしょう。",
      "品質向上や業務改善など、継続的な成長が求められる仕事に向いています。",
    ].join("\n"),
    strengths: ["改善力", "発想力", "計画性", "継続力", "問題発見力"],
    jobs: ["業務改善", "品質管理", "商品企画", "UI/UXデザイナー", "生産管理"],
    industries: ["メーカー", "IT", "インフラ", "医療", "Web"],
    lineMessage: [
      "診断結果は**「改善クリエイター」**でした！",
      "安定した基盤の上で、より良い仕組みや価値を生み出せるタイプです。",
    ].join("\n"),
    percent: 7,
  },
  stability_execution: {
    name: "実務エキスパート",
    catchCopy: "着実な仕事で成果を積み重ねるタイプ",
    description: [
      "あなたは、責任感が強く、一つひとつの仕事を丁寧に最後までやり遂げるタイプです。",
      "決められたルールや手順を守りながら、高い品質で仕事を進めることができます。派手さはなくても、組織にとって欠かせない存在として信頼を集めるでしょう。",
      "長く働き続けられる環境で、本来の力を発揮します。",
    ].join("\n"),
    strengths: ["継続力", "責任感", "正確性", "実行力", "計画性"],
    jobs: ["経理", "総務", "品質保証", "生産管理", "インフラエンジニア"],
    industries: ["金融", "メーカー", "インフラ", "医療", "公共"],
    lineMessage: [
      "診断結果は**「実務エキスパート」**でした！",
      "着実に成果を積み重ね、周囲から厚い信頼を得られるタイプです。",
    ].join("\n"),
    percent: 9,
  },
  creativity_execution: {
    name: "企画プロデューサー",
    catchCopy: "アイデアを形にし、成果まで導くタイプ",
    description: [
      "あなたは、自由な発想だけで終わらず、それを実際の成果へつなげることができるタイプです。",
      "新しい企画を考えるだけでなく、計画を立て、関係者を巻き込みながら実現までやり切る力があります。",
      "企画と実行の両方を担えるため、プロジェクト全体を動かす中心人物として活躍できるでしょう。",
    ].join("\n"),
    strengths: ["企画力", "実行力", "発想力", "調整力", "プロジェクト推進力"],
    jobs: [
      "プロデューサー",
      "プロジェクトマネージャー",
      "商品企画",
      "ディレクター",
      "マーケター",
    ],
    industries: ["Web", "IT", "広告", "エンターテインメント", "メディア"],
    lineMessage: [
      "診断結果は**「企画プロデューサー」**でした！",
      "アイデアを形にし、最後までやり遂げる力があなたの最大の武器です。",
    ].join("\n"),
    percent: 6,
  },
};

// ============================================================
// 80問QUESTION BANK対応：16TYPE診断（新しい判定エンジン用データ）
// ============================================================

export const TYPE_CODES = [
  "FRONTIER",
  "EXPLORER",
  "CREATOR",
  "VISIONARY",
  "SEEKER",
  "STRATEGIST",
  "DRIVER",
  "COMMANDER",
  "CONNECTOR",
  "CATALYST",
  "GUARDIAN",
  "STEWARD",
  "ARCHITECT",
  "BUILDER",
  "MENTOR",
  "EMPOWERER",
];

// 16TYPEのDNA基準値（初期仮説値。実装後のシミュレーション・実データで調整可能）
export const TYPE_DNA_BASELINE = {
  FRONTIER: {
    challenge: 92,
    people: 72,
    creativity: 78,
    analysis: 55,
    stability: 35,
  },
  EXPLORER: {
    challenge: 90,
    people: 68,
    creativity: 72,
    analysis: 45,
    stability: 30,
  },
  CREATOR: {
    challenge: 72,
    people: 55,
    creativity: 94,
    analysis: 52,
    stability: 38,
  },
  VISIONARY: {
    challenge: 76,
    people: 55,
    creativity: 88,
    analysis: 74,
    stability: 35,
  },
  SEEKER: {
    challenge: 42,
    people: 38,
    creativity: 61,
    analysis: 94,
    stability: 66,
  },
  STRATEGIST: {
    challenge: 58,
    people: 48,
    creativity: 62,
    analysis: 92,
    stability: 72,
  },
  DRIVER: {
    challenge: 88,
    people: 65,
    creativity: 52,
    analysis: 55,
    stability: 42,
  },
  COMMANDER: {
    challenge: 82,
    people: 88,
    creativity: 50,
    analysis: 68,
    stability: 55,
  },
  CONNECTOR: {
    challenge: 65,
    people: 94,
    creativity: 67,
    analysis: 45,
    stability: 62,
  },
  CATALYST: {
    challenge: 84,
    people: 90,
    creativity: 76,
    analysis: 42,
    stability: 32,
  },
  GUARDIAN: {
    challenge: 32,
    people: 72,
    creativity: 38,
    analysis: 68,
    stability: 94,
  },
  STEWARD: {
    challenge: 30,
    people: 58,
    creativity: 35,
    analysis: 72,
    stability: 96,
  },
  ARCHITECT: {
    challenge: 48,
    people: 42,
    creativity: 68,
    analysis: 91,
    stability: 82,
  },
  BUILDER: {
    challenge: 42,
    people: 40,
    creativity: 55,
    analysis: 78,
    stability: 88,
  },
  MENTOR: {
    challenge: 55,
    people: 91,
    creativity: 58,
    analysis: 64,
    stability: 72,
  },
  EMPOWERER: {
    challenge: 38,
    people: 94,
    creativity: 48,
    analysis: 55,
    stability: 84,
  },
};

// SPECIALペア（8ペア）：どのTYPE同士を比較するか
export const SPECIAL_PAIRS = {
  SP01: ["FRONTIER", "EXPLORER"],
  SP02: ["CREATOR", "VISIONARY"],
  SP03: ["SEEKER", "STRATEGIST"],
  SP04: ["DRIVER", "COMMANDER"],
  SP05: ["CONNECTOR", "CATALYST"],
  SP06: ["GUARDIAN", "STEWARD"],
  SP07: ["ARCHITECT", "BUILDER"],
  SP08: ["MENTOR", "EMPOWERER"],
};

export const DEFAULT_RESULTS_16 = {
  FRONTIER: {
    name: "FRONTIER｜開拓者",
    catchCopy: "道がないなら、自分でつくる。",
    description:
      "面白そうと思ったら、まずやってみたくなる人。考えてから動くより、動きながら答えを見つける方が得意です。新しい環境では強い反面、やり方が決まりきった瞬間に急に熱が冷めることも。「飽きっぽい」と思われることがありますが、実は誰より早く「次」を見つけている人です。",
    strengths: [
      "最初の一歩を踏み出せる — 誰もやっていないことでも、自分から始められる",
      "ゼロから道をつくれる — 正解がなくても、試しながら前へ進める",
      "変化をチャンスにできる — 環境が変わっても、面白さを見つけて動ける",
    ],
    weapon:
      "同じことに慣れるのが早いのは、次の変化を察知する感度が高いから。新しい企画や立ち上げなど、変化が続く場所ではその性質が武器になる。",
    bestEnvironment:
      "まだ正解が決まっていない場所。新規事業・立ち上げ・新しい挑戦など、自分で考えて動ける環境ほど力が出る。細かいルールより、裁量と挑戦の余白がある場所。",
    jobs: [
      "新規事業・事業開発 — 正解のない状態から事業をつくれる",
      "新規営業 — 自分で市場や顧客を切り拓ける",
      "起業・プロジェクト立ち上げ — ゼロから形にする力がそのまま武器になる",
    ],
    percent: 6,
  },
  EXPLORER: {
    name: "EXPLORER｜冒険者",
    catchCopy: "知らない世界ほど、行ってみたくなる。",
    description:
      "知らない場所、知らない人、やったことのないことに自然と惹かれる人。ずっと同じ環境にいると、理由もなくモヤモヤし始めます。計画通りに進むことより、「この先どうなるんだろう？」がある方が楽しい。興味の移り変わりは早めですが、その分、新しい環境への順応も早い人です。",
    strengths: [
      "未知に飛び込める — 初めての環境や経験を必要以上に怖がらない",
      "新しいものを吸収できる — 経験から学び、自分の世界を広げられる",
      "変化に順応できる — 想定外の状況でも柔軟にやり方を変えられる",
    ],
    weapon:
      "「落ち着きがない」 → 一つの場所に留まりにくいのは、未知への好奇心が強いから。新しい環境・人・経験が次々に入ってくる場所では、誰より早く世界を広げられる。",
    bestEnvironment:
      "新しい刺激に出会い続けられる場所。人・仕事・テーマが変化し、新しい経験が増えていく環境ほど成長する。毎日同じことを繰り返すより、変化のある場所。",
    jobs: [
      "企画営業 — 人・業界・課題との新しい出会いが多いフィールド",
      "マーケティング — 現場を動きながら新しい情報や反応に触れられる",
      "イベント・旅行企画 — 新しい場所や体験を仕事に取り込める",
    ],
    percent: 6,
  },
  CREATOR: {
    name: "CREATOR｜創造者",
    catchCopy: "まだないものを、思いつける。",
    description:
      "「普通はこうする」に少し違和感を持ちやすい人。完成されたものを見るより、自分ならこうするのにと考えている時間が好きです。細かく指示されすぎると急にやる気を失うことも。頭の中にはアイデアがたくさんあるのに、形にする前に次のアイデアが浮かんでしまうことがあります。",
    strengths: [
      "ないものを思いつける — 既存の正解に縛られず、新しい発想を生み出せる",
      "自分らしく表現できる — 感覚やアイデアを独自の形に変えられる",
      "当たり前を疑える — 「もっと面白くできない？」から新しい可能性を見つけられる",
    ],
    weapon:
      "当たり前に違和感を持つのは、別の可能性を想像できるから。新しい企画や表現が必要な場面では、その「ズレ」がオリジナリティになる。",
    bestEnvironment:
      "「自分ならこうしたい」を形にできる場所。正解をなぞるより、アイデアや個性が歓迎される環境。やり方まで細かく決められるより、自由に考えられる余白がある場所。",
    jobs: [
      "Webデザイナー — アイデアや感性を目に見える形にできる",
      "動画クリエイター — 表現方法そのものに自分らしさを出せる",
      "広告・コンテンツ企画 — 「どう見せる？」を考える力が価値になる",
    ],
    percent: 6,
  },
  VISIONARY: {
    name: "VISIONARY｜先見者",
    catchCopy: "みんなが今を見るとき、あなたはその先を見ている。",
    description:
      "今あるものより、「これからどうなるか」を考えるのが好きな人。周囲がまだ気にしていない変化にも早めに気づきます。一方で、頭の中では話がかなり先まで進んでいるので、周りから「話が飛んだ」と思われることも。現在より未来にワクワクするタイプです。",
    strengths: [
      "まだ見えない可能性を見つける — 今ではなく、その先にある変化を想像できる",
      "未来から逆算できる — 目の前だけでなく、これから必要になるものを考えられる",
      "新しい方向を示せる — 周囲が気づいていない選択肢を提示できる",
    ],
    weapon:
      "周囲より先の未来まで考えているから、現在との間が飛んで見えることがある。つまり裏側にあるのは、まだ起きていない変化を想像する力。未来を考える仕事では大きな武器になる。",
    bestEnvironment:
      "未来について考えることが価値になる場所。新しい市場・サービス・技術など、まだ答えのないテーマに関われる環境。目の前の作業だけでなく、その先を考えることを求められる場所。",
    jobs: [
      "商品・サービス企画 — これから求められるものを考えられる",
      "マーケティング — 市場や人の変化から次の需要を見つけられる",
      "事業企画 — 現在だけでなく未来から事業を考えられる",
    ],
    percent: 6,
  },
  SEEKER: {
    name: "SEEKER｜探究者",
    catchCopy: "わかったつもりで、終わらせない。",
    description:
      "一度気になったことは、納得するまで調べたくなる人。「みんなそう言ってるから」では、あまり納得できません。興味のない話には驚くほど集中できないのに、好きなことなら時間を忘れて深掘りできる。広く浅くより、狭くても誰より詳しくなる方が向いています。",
    strengths: [
      "誰より深く掘れる — 気になったことを表面だけで終わらせない",
      "本質まで理解できる — 「なぜ？」を重ね、物事の仕組みを理解できる",
      "好きを専門性に変えられる — 一つの分野を長く追い、他の人にはない知識を蓄積できる",
    ],
    weapon:
      "一度気になると簡単に終われないのは、表面だけで納得できない深さがあるから。そのこだわりは、専門性が価値になる世界では「この人にしか分からない」に変わる。",
    bestEnvironment:
      "一つのことを深く追いかけられる場所。専門性・知識・技術そのものが評価され、集中できる時間が確保される環境。広く浅く何でもやるより、「これなら任せたい」と言われる場所。",
    jobs: [
      "エンジニア — 技術を深く理解し、専門性を積み上げられる",
      "研究・開発 — 一つのテーマを深く追究できる",
      "データアナリスト — 情報を掘り下げ、表面では見えない事実を発見できる",
    ],
    percent: 6,
  },
  STRATEGIST: {
    name: "STRATEGIST｜戦略家",
    catchCopy: "動く前に、勝ち筋が見えている。",
    description:
      "いきなり動くより、まず状況を見て「どう動けば一番うまくいくか」を考える人。失敗しそうなポイントにも比較的早く気づきます。そのため周囲が勢いで進んでいると「ちょっと待って」と言いたくなることも。考えすぎて初動が遅くなる反面、無駄な一手を減らすのが得意です。",
    strengths: [
      "勝ち筋を見つけられる — 情報を整理して、成功確率の高い方法を考えられる",
      "一手先を読める — 行動した先に何が起こるかを予測できる",
      "無駄を減らせる — がむしゃらに動くより、効果の高い一手を選べる",
    ],
    weapon:
      "すぐ動けないのは、失敗する可能性やその先まで自然と考えているから。つまり、人が見落とすリスクと選択肢を先に読める。大きな判断ほど、その慎重さが強みになる。",
    bestEnvironment:
      "考えることそのものが成果につながる場所。データや情報を集め、比較し、仮説を立てて最適な方法を選べる環境。勢いだけではなく、戦略や判断の質が評価される場所。",
    jobs: [
      "経営企画 — 情報から会社の次の一手を考えられる",
      "マーケティング戦略 — データや市場から勝ち筋を組み立てられる",
      "コンサルタント — 複雑な課題を整理して最適解を考えられる",
    ],
    percent: 6,
  },
  DRIVER: {
    name: "DRIVER｜推進者",
    catchCopy: "止まっているなら、自分が動かす。",
    description:
      "やると決まったのに話が進まない状態が苦手な人。会議が長いと、心の中で「で、結局いつやるの？」と思っています。目標が決まると強く、多少の問題なら走りながら解決できます。ただ、自分のスピードを基準にしてしまい、動きが遅い人に少しイライラすることもあります。",
    strengths: [
      "物事を前に進められる — 止まっている状況でも、自分から動き出せる",
      "決めたことを実行できる — 考えるだけで終わらず、行動に変えられる",
      "壁を突破できる — 問題が起きても、止まるより解決策を探して進める",
    ],
    weapon:
      "待っていることにストレスを感じるのは、前に進めたいエネルギーが強いから。スピードが求められる場所では、周囲が止まっている間に最初の一歩をつくれる。",
    bestEnvironment:
      "スピードと実行が評価される場所。目標が明確で、決めたらすぐ動ける環境ほど力を発揮する。承認待ちが多い組織より、自分の判断で前へ進められる場所。",
    jobs: [
      "法人営業 — 目標に向かって自ら動き、結果をつくれる",
      "プロジェクトマネージャー — 停滞している仕事を前へ進められる",
      "事業推進 — アイデアを「実際に動いている状態」まで持っていける",
    ],
    percent: 6,
  },
  COMMANDER: {
    name: "COMMANDER｜指揮者",
    catchCopy: "一人の力を、チームの力に変える。",
    description:
      "自分一人で頑張るより、「誰が何をすれば一番うまくいくか」を考える人。役割が曖昧だったり、誰も決めない状況では自然と仕切る側になりがちです。責任を背負える反面、「自分でやった方が早い」と抱え込むことも。人が動き、チームで結果が出ると一番燃えます。",
    strengths: [
      "人の力を束ねられる — それぞれの強みを見ながらチームを動かせる",
      "決断を引き受けられる — 誰かが決めなければならない場面で判断できる",
      "ゴールへ導ける — 全体を見ながら、人と仕事を前へ進められる",
    ],
    weapon:
      "誰も決めない状態が気になるのは、全体を見て責任を引き受ける意識が強いから。混乱しているチームほど、その性質はリーダーシップに変わる。",
    bestEnvironment:
      "人と目標を任せてもらえる場所。チームで成果を追い、役割を決め、意思決定できる環境。自分だけの成果より、「みんなで大きな結果を出す」ことが求められる場所。",
    jobs: [
      "マネージャー — 人の強みを組み合わせてチーム成果をつくれる",
      "営業マネージャー — 目標・人・戦略をまとめて動かせる",
      "プロジェクトマネージャー — 多くの人を一つのゴールへ導ける",
    ],
    percent: 6,
  },
  CONNECTOR: {
    name: "CONNECTOR｜共創者",
    catchCopy: "人と人の間に、可能性をつくる。",
    description:
      "一人で完結するより、誰かと話しながらアイデアを広げる人。「この人とこの人をつないだら面白そう」と、人同士の相性にもよく気づきます。人間関係が悪い環境では能力以上に消耗しやすい一方、信頼できる仲間がいると力が一気に伸びます。",
    strengths: [
      "人と人をつなげられる — 相性や強みに気づき、新しい関係を生み出せる",
      "一人では出ない答えを生み出せる — 会話や協力からアイデアを広げられる",
      "信頼を力に変えられる — 良い関係をつくり、チームの力を大きくできる",
    ],
    weapon:
      "人との関わりを必要とするのは、依存ではなく、人との掛け算で能力が伸びるタイプだから。仲間・顧客・チームとの関係が成果につながる場所では強い。",
    bestEnvironment:
      "人とのつながりが成果になる場所。部署・顧客・仲間など、多様な人と関わりながら一緒に何かをつくる環境。個人戦より、コミュニケーションと信頼が価値になる場所。",
    jobs: [
      "人材コーディネーター — 人と企業をつなぎ、双方の可能性を広げられる",
      "カスタマーサクセス — 顧客との関係を築きながら成果を一緒につくれる",
      "広報・PR — 社内外の人をつなぎ、関係性から価値を生み出せる",
    ],
    percent: 6,
  },
  CATALYST: {
    name: "CATALYST｜触媒者",
    catchCopy: "あなたがいると、何かが動き出す。",
    description:
      "あなたが入ると、止まっていた会話や企画がなぜか動き始めるタイプ。面白そうな話には自然と反応し、周囲にもその熱が伝わります。ただし刺激が少ない環境では急速に元気を失うことも。自分では普通にしているつもりでも、周りの温度を変えやすい人です。",
    strengths: [
      "周囲のスイッチを入れられる — あなたの言葉や行動が、人が動くきっかけになる",
      "場の温度を上げられる — 停滞した空気にエネルギーを生み出せる",
      "変化のきっかけをつくれる — 人や組織に新しい動きを起こせる",
    ],
    weapon:
      "変化のない環境でエネルギーが落ちるのは、新しい刺激から周囲を動かす力を生み出すから。停滞した組織や新しいプロジェクトでは、空気を変える存在になれる。",
    bestEnvironment:
      "まだ熱が足りない場所。新しいプロジェクトや変革期など、人や組織を動かすきっかけが必要な環境。完成された場所より、「これから変わる」場所で存在感が出る。",
    jobs: [
      "コミュニティマネージャー — 人を巻き込み、場を活性化できる",
      "イベントプロデューサー — 多くの人を動かして熱量を生み出せる",
      "組織開発・採用 — 人や組織に新しい変化を起こすきっかけをつくれる",
    ],
    percent: 6,
  },
  GUARDIAN: {
    name: "GUARDIAN｜守護者",
    catchCopy: "変えないことで、守れるものがある。",
    description:
      "何かを始めるとき、楽しさより先に「これ大丈夫かな？」が浮かびやすい人。勢いだけで進むのは少し苦手ですが、周囲が見落としているリスクにはよく気づきます。変化に慎重なので自分を消極的だと思うこともありますが、実際は失敗を未然に防いでいることが多い人です。",
    strengths: [
      "危険を先に見つけられる — 他の人が見落とすリスクや違和感に気づける",
      "安心できる環境をつくれる — 丁寧さと責任感で、周囲から信頼される",
      "大切なものを守り抜ける — 勢いに流されず、本当に必要なものを守れる",
    ],
    weapon:
      "「大丈夫かな？」が先に浮かぶのは、他の人よりリスクに早く気づけるから。正確さ・安全・信頼が重要な場所では、その心配性が大きな事故を防ぐ力になる。",
    bestEnvironment:
      "正確さと安心が価値になる場所。ミスやリスクを減らすことが重要で、丁寧さ・責任感・信頼が評価される環境。速さだけを競うより、「任せて安心」が強みになる場所。",
    jobs: [
      "品質管理・品質保証 — 小さな違和感から問題を未然に防げる",
      "労務・総務 — 人や組織が安心して働ける状態を守れる",
      "ITサポート・運用保守 — 安定稼働を支え、トラブルを防ぐ力が活きる",
    ],
    percent: 6,
  },
  STEWARD: {
    name: "STEWARD｜継承者",
    catchCopy: "大切なものを、次へつないでいく。",
    description:
      "一度任されたことは、途中で投げ出さずきちんと続けたい人。派手な変化より、昨日より今日を少し良くすることに強さがあります。急な方針変更が続くとストレスを感じやすい一方、周囲が飽きたあとも淡々と続けられる。気づけば「この人に任せれば安心」と思われているタイプです。",
    strengths: [
      "続ける力がある — 周囲が飽きても、必要なことを積み重ねられる",
      "品質を守れる — 小さな違和感や乱れに気づき、良い状態を維持できる",
      "信頼を積み上げられる — 派手さではなく、毎日の確実さで「任せたい人」になれる",
    ],
    weapon:
      "簡単にやり方を変えないのは、今あるものの価値を理解し、守り続けられるから。継続や品質が重要な場所では、周囲が変わっても安定をつくれる存在になる。",
    bestEnvironment:
      "積み重ねがきちんと評価される場所。長期的に品質や信頼を守り、少しずつ改善していける環境。方針が毎日のように変わる場所より、腰を据えて育てられる場所。",
    jobs: [
      "経理 — 正確さと継続的な管理が信頼につながる",
      "運用管理 — 良い状態を長く維持し、少しずつ改善できる",
      "生産・店舗オペレーション管理 — 日々の積み重ねから安定した品質をつくれる",
    ],
    percent: 6,
  },
  ARCHITECT: {
    name: "ARCHITECT｜設計者",
    catchCopy: "複雑なことほど、シンプルに組み立てる。",
    description:
      "ごちゃごちゃした状態を見ると、頭の中で勝手に整理を始める人。いきなり始めるより、順番・役割・全体像が見えてから動きたいタイプです。曖昧な指示が続くとかなり疲れます。一方、一度構造が見えると「こうすればもっと楽なのに」と仕組みそのものを改善できます。",
    strengths: [
      "複雑なものを整理できる — バラバラな情報から全体像をつかめる",
      "仕組みに変えられる — 個人の頑張りではなく、再現できる方法を考えられる",
      "先回りして設計できる — 問題が起きてからではなく、起きにくい構造をつくれる",
    ],
    weapon:
      "曖昧さや抜けが気になるのは、全体の構造や矛盾が見えてしまうから。その細かさは、仕組み・計画・業務設計では「問題が起きる前に直せる力」になる。",
    bestEnvironment:
      "複雑なものを整理する必要がある場所。ルール・業務・情報・人の動きを整理し、「もっと良い仕組み」を考えられる環境。場当たり的に動くより、構造から改善できる場所。",
    jobs: [
      "業務改善・DX推進 — 複雑な業務を整理して仕組みに変えられる",
      "システムエンジニア — 要件を整理し、全体構造を設計できる",
      "プロジェクト企画・PMO — 人・情報・工程を整理して進め方を設計できる",
    ],
    percent: 6,
  },
  BUILDER: {
    name: "BUILDER｜構築者",
    catchCopy: "小さな積み重ねを、確かな形にする。",
    description:
      "アイデアだけで終わるより、ちゃんと使える形まで完成させたい人。派手なスタートより、細かいところを一つずつ積み上げることに強いです。途中で何度も方針を変えられるとストレスを感じやすい反面、他の人が面倒になったところからでも完成まで持っていけます。",
    strengths: [
      "アイデアを形にできる — 「こうしたい」を実際に使える状態まで持っていける",
      "積み上げを続けられる — 地味な工程でも、一つずつ完成へ近づけられる",
      "最後まで仕上げられる — 他の人が面倒に感じる部分まで丁寧に完成させられる",
    ],
    weapon:
      "決めたことを簡単に変えたくないのは、完成まで責任を持って積み上げたいから。正確さや完成度が求められる場所では、「最後まで形にできる人」になる。",
    bestEnvironment:
      "完成まで任せてもらえる場所。アイデアを具体化し、一つずつ積み上げて成果物にできる環境。次々と新しいことへ移るより、品質を高めながら最後まで仕上げられる場所。",
    jobs: [
      "Webエンジニア — 設計されたものを実際に動く形へ作り上げられる",
      "制作・Web制作 — 一つずつ工程を積み上げ、成果物を完成させられる",
      "施工管理 — 多くの工程を管理しながら完成まで持っていける",
    ],
    percent: 6,
  },
  MENTOR: {
    name: "MENTOR｜導き手",
    catchCopy: "人の可能性を、本人より先に信じられる。",
    description:
      "人の話を聞いていると、本人が気づいていない長所や可能性に気づくことがある人。つい「こうしたらもっと良くなるのに」と考えてしまいます。自分が評価されること以上に、教えた相手が成長すると嬉しい。ただ、頼られると必要以上に背負ってしまうことがあります。",
    strengths: [
      "人の可能性を見つけられる — 本人が気づいていない強みに気づける",
      "成長のきっかけをつくれる — 相手に合った言葉やヒントを渡せる",
      "人を一段上へ導ける — 答えを与えるだけでなく、自分で進める状態へ育てられる",
    ],
    weapon:
      "人のことまで考えてしまうのは、相手の可能性や改善点が見えてしまうから。育成や教育の場では、そのおせっかいが誰かの成長を早める力になる。",
    bestEnvironment:
      "人の成長が成果になる場所。教える・育てる・フィードバックする機会があり、誰かが成長することで自分の価値も発揮される環境。人の可能性に長く関われる場所。",
    jobs: [
      "人材育成・研修担当 — 人の強みを見つけて成長を支援できる",
      "キャリアアドバイザー — 相手の可能性を整理し、次の方向を示せる",
      "教育・インストラクター — 教えることで人の成長を生み出せる",
    ],
    percent: 6,
  },
  EMPOWERER: {
    name: "EMPOWERER｜伴走者",
    catchCopy: "前に出なくても、誰かを前に進ませられる。",
    description:
      "誰かが困っていると、放っておけない人。すぐ答えを押しつけるより、まず相手の話を聞いて「この人は本当はどうしたいんだろう」と考えます。人に合わせすぎて自分の希望を後回しにすることもありますが、あなたがいることで安心して力を出せる人がいます。",
    strengths: [
      "人の本音を引き出せる — 安心して話せる空気をつくり、相手の気持ちを理解できる",
      "人の力を引き出せる — 前に出なくても、相手が本来の力を発揮できる状態をつくれる",
      "支え続けられる — 一時的に励ますだけでなく、相手のペースに合わせて寄り添える",
    ],
    weapon:
      "相手を気にしすぎるのは、人の感情や変化を細かく感じ取れるから。人を支える環境では、「この人がいるから頑張れる」と思われる存在になれる。",
    bestEnvironment:
      "人を支えることがきちんと価値になる場所。相手の話を聞き、不安を減らし、その人らしく力を出せるよう支援できる環境。競争だけではなく、信頼や貢献も評価される場所。",
    jobs: [
      "カスタマーサクセス — 相手の課題を聞きながら成功まで寄り添える",
      "キャリアアドバイザー — 相手の気持ちを整理しながら一緒に方向を考えられる",
      "コーチ・カウンセラー — 相手のペースに合わせて支え続けられる",
    ],
    percent: 6,
  },
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
  creativity_execution: ["creativity", "execution"],
};

export const DEFAULT_SETTINGS = {
  comparisonCount: 18542,
  comparisonIncrementIntervalHours: 2,
  comparisonIncrementCount: 13,
  comparisonCountUpdatedAt: null,
  diagnosisQuestionCount: 40,
  jobCount: 12,
  highMatchCount: 4,
  lineAiMaxReplies: 4,
  lineAiCtaMessage:
    "お話を聞く限り、\n" +
    "年収面と今後のキャリアについて\n" +
    "一度担当者と整理してみても良さそうです。\n\n" +
    "担当者と一度相談してみますか？",
  lineAiCtaPrimaryLabel: "相談してみる",
  lineAiCtaPrimaryText: "相談してみる",
  lineAiCtaSecondaryLabel: "もう少しAIに聞く",
  lineAiCtaSecondaryText: "もう少しAIに聞く",
  specialQuestions: [],
  resultOverrides: {},
  cardOverrides: {},
  deletedCardIds: [],
  useMasterCardsOnly: false,
};

export const STORAGE_KEYS = {
  adminSettings: "ai-career-admin-settings",
  diagnosisDraft: "ai-career-diagnosis-draft",
  lineConnection: "ai-career-line-connection",
  eventLog: "ai-career-event-log",
  visitorId: "ai-career-visitor-id",
  sessionId: "ai-career-session-id",
  funnelId: "ai-career-funnel-id",
  utm: "ai-career-utm",
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
    const saved = JSON.parse(
      localStorage.getItem(STORAGE_KEYS.adminSettings) || "{}",
    );
    return {
      ...DEFAULT_SETTINGS,
      ...saved,
      specialQuestions: Array.isArray(saved.specialQuestions)
        ? saved.specialQuestions
        : [],
      resultOverrides: saved.resultOverrides || {},
      cardOverrides: saved.cardOverrides || {},
      deletedCardIds: Array.isArray(saved.deletedCardIds)
        ? saved.deletedCardIds
        : [],
      useMasterCardsOnly: Boolean(saved.useMasterCardsOnly),
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
      specialQuestions: Array.isArray(settings.specialQuestions)
        ? settings.specialQuestions
        : [],
      resultOverrides: settings.resultOverrides || {},
      cardOverrides: settings.cardOverrides || {},
      deletedCardIds: Array.isArray(settings.deletedCardIds)
        ? settings.deletedCardIds
        : [],
      useMasterCardsOnly: Boolean(settings.useMasterCardsOnly),
    }),
  );
}

export function getCurrentComparisonCount(
  settings = loadAdminSettings(),
  now = new Date(),
) {
  const baseCount = Number(settings.comparisonCount || 0);
  const intervalHours = Number(settings.comparisonIncrementIntervalHours || 0);
  const incrementCount = Number(settings.comparisonIncrementCount || 0);
  const updatedAt = settings.comparisonCountUpdatedAt
    ? new Date(settings.comparisonCountUpdatedAt)
    : null;

  if (
    !updatedAt ||
    Number.isNaN(updatedAt.getTime()) ||
    intervalHours <= 0 ||
    incrementCount <= 0
  ) {
    return Math.max(0, Math.floor(baseCount));
  }

  const elapsedMs = now.getTime() - updatedAt.getTime();
  if (elapsedMs <= 0) return Math.max(0, Math.floor(baseCount));

  const intervalMs = intervalHours * 60 * 60 * 1000;
  const elapsedIntervals = Math.floor(elapsedMs / intervalMs);
  return Math.max(0, Math.floor(baseCount + elapsedIntervals * incrementCount));
}

function getDefaultCardNumber(cardId) {
  const match = String(cardId || "").match(/^image-(\d+)$/);
  return match ? Number(match[1]) : 0;
}

function getCardOverrideFromCard(card, sortOrder) {
  return {
    question: card.question || "",
    visual: card.visual || "",
    image: card.image || "",
    imageStoragePath: card.imageStoragePath || "",
    yesScores: card.yesScores || {},
    noScores: card.noScores || {},
    enabled: card.enabled !== false,
    sortOrder,
    // 80問QUESTION BANK対応：DNA/TYPEタグ（admin-masterのレスポンス形に合わせ、
    // camelCase / snake_case どちらで来ても拾えるようにしておく）
    questionType: card.questionType || card.question_type || "",
    dnaCategory: card.dnaCategory || card.dna_category || "",
    typeCode: card.typeCode || card.type_code || "",
  };
}

export function buildSettingsFromMaster(master = {}) {
  const remoteSettings = master.settings || {};
  const resultOverrides = {};
  const cardOverrides = {};
  const remoteCards = Array.isArray(master.cards) ? master.cards : [];
  const maxRemoteDefaultCardNumber = remoteCards.reduce((max, card) => {
    return Math.max(max, getDefaultCardNumber(card.id));
  }, 0);

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
      percent: Number(result.percent || 8),
      // 80問QUESTION BANK対応：16タイプ用の項目も読み込む
      characterImage: result.characterImage || "",
      weapon: result.weapon || "",
      bestEnvironment: result.bestEnvironment || "",
    };
  });

  remoteCards.forEach((card, index) => {
    if (!card.id) return;
    cardOverrides[card.id] = getCardOverrideFromCard(
      card,
      Number(card.sortOrder || index + 1),
    );
  });

  if (remoteCards.length > 0 && maxRemoteDefaultCardNumber > 0) {
    DEFAULT_CARDS.forEach((card, index) => {
      const cardNumber = getDefaultCardNumber(card.id);
      if (cardOverrides[card.id] || cardNumber <= maxRemoteDefaultCardNumber)
        return;
      cardOverrides[card.id] = getCardOverrideFromCard(card, index + 1);
    });
  }

  return {
    ...DEFAULT_SETTINGS,
    comparisonCount: Number(
      remoteSettings.comparisonCount ?? DEFAULT_SETTINGS.comparisonCount,
    ),
    comparisonIncrementIntervalHours: Number(
      remoteSettings.comparisonIncrementIntervalHours ??
        DEFAULT_SETTINGS.comparisonIncrementIntervalHours,
    ),
    comparisonIncrementCount: Number(
      remoteSettings.comparisonIncrementCount ??
        DEFAULT_SETTINGS.comparisonIncrementCount,
    ),
    comparisonCountUpdatedAt:
      remoteSettings.comparisonCountUpdatedAt ??
      DEFAULT_SETTINGS.comparisonCountUpdatedAt,
    diagnosisQuestionCount: Number(
      remoteSettings.diagnosisQuestionCount ??
        DEFAULT_SETTINGS.diagnosisQuestionCount,
    ),
    jobCount: Number(remoteSettings.jobCount ?? DEFAULT_SETTINGS.jobCount),
    highMatchCount: Number(
      remoteSettings.highMatchCount ?? DEFAULT_SETTINGS.highMatchCount,
    ),
    lineAiMaxReplies: Number(
      remoteSettings.lineAiMaxReplies ?? DEFAULT_SETTINGS.lineAiMaxReplies,
    ),
    lineAiCtaMessage: String(
      remoteSettings.lineAiCtaMessage ?? DEFAULT_SETTINGS.lineAiCtaMessage,
    ),
    lineAiCtaPrimaryLabel: String(
      remoteSettings.lineAiCtaPrimaryLabel ??
        DEFAULT_SETTINGS.lineAiCtaPrimaryLabel,
    ),
    lineAiCtaPrimaryText: String(
      remoteSettings.lineAiCtaPrimaryText ??
        DEFAULT_SETTINGS.lineAiCtaPrimaryText,
    ),
    lineAiCtaSecondaryLabel: String(
      remoteSettings.lineAiCtaSecondaryLabel ??
        DEFAULT_SETTINGS.lineAiCtaSecondaryLabel,
    ),
    lineAiCtaSecondaryText: String(
      remoteSettings.lineAiCtaSecondaryText ??
        DEFAULT_SETTINGS.lineAiCtaSecondaryText,
    ),
    specialQuestions: normalizeSpecialQuestions(master.specialQuestions),
    resultOverrides,
    cardOverrides,
    deletedCardIds: [],
    useMasterCardsOnly: remoteCards.length > 0,
  };
}

export function serializeSettingsForMaster(settings = loadAdminSettings()) {
  const mergedSettings = {
    ...DEFAULT_SETTINGS,
    ...settings,
    resultOverrides: settings.resultOverrides || {},
    cardOverrides: settings.cardOverrides || {},
    specialQuestions: Array.isArray(settings.specialQuestions)
      ? settings.specialQuestions
      : [],
    deletedCardIds: Array.isArray(settings.deletedCardIds)
      ? settings.deletedCardIds
      : [],
    useMasterCardsOnly: Boolean(settings.useMasterCardsOnly),
  };

  return {
    settings: {
      comparisonCount: Number(mergedSettings.comparisonCount || 0),
      comparisonIncrementIntervalHours: Number(
        mergedSettings.comparisonIncrementIntervalHours || 0,
      ),
      comparisonIncrementCount: Number(
        mergedSettings.comparisonIncrementCount || 0,
      ),
      comparisonCountUpdatedAt:
        mergedSettings.comparisonCountUpdatedAt || new Date().toISOString(),
      diagnosisQuestionCount: Math.max(
        1,
        Math.floor(
          Number(
            mergedSettings.diagnosisQuestionCount ||
              DEFAULT_SETTINGS.diagnosisQuestionCount,
          ),
        ),
      ),
      jobCount: Number(mergedSettings.jobCount || 0),
      highMatchCount: Number(mergedSettings.highMatchCount || 0),
      lineAiMaxReplies: Math.max(
        1,
        Math.min(10, Math.floor(Number(mergedSettings.lineAiMaxReplies || 4))),
      ),
      lineAiCtaMessage: String(mergedSettings.lineAiCtaMessage || ""),
      lineAiCtaPrimaryLabel: String(
        mergedSettings.lineAiCtaPrimaryLabel || "相談してみる",
      ),
      lineAiCtaPrimaryText: String(
        mergedSettings.lineAiCtaPrimaryText || "相談してみる",
      ),
      lineAiCtaSecondaryLabel: String(
        mergedSettings.lineAiCtaSecondaryLabel || "もう少しAIに聞く",
      ),
      lineAiCtaSecondaryText: String(
        mergedSettings.lineAiCtaSecondaryText || "もう少しAIに聞く",
      ),
    },
    // 80問QUESTION BANK対応：16タイプのみ送る（旧15タイプは廃止済み）
    results: Object.entries(getConfiguredResults16(mergedSettings)).map(
      ([key, result], index) => ({
        resultType: key,
        name: result.name,
        catchCopy: result.catchCopy,
        description: result.description,
        strengths: result.strengths,
        jobs: result.jobs,
        industries: result.industries || [],
        lineMessage: result.lineMessage || "",
        percent: result.percent,
        sortOrder: index + 1,
        characterImage: result.characterImage || "",
        weapon: result.weapon || "",
        bestEnvironment: result.bestEnvironment || "",
      }),
    ),
    cards: getConfiguredCards(mergedSettings).map((card, index) => ({
      id: card.id,
      question: card.question,
      visual: card.visual,
      image: card.image,
      imageStoragePath: card.imageStoragePath || "",
      yesScores: card.yesScores,
      noScores: card.noScores,
      enabled: card.enabled !== false,
      sortOrder: index + 1,
    })),
    specialQuestions: getConfiguredSpecialQuestions(mergedSettings),
    deletedCardIds: mergedSettings.deletedCardIds,
  };
}

function buildCardFromOverride(id, card, fallbackSortOrder) {
  return {
    id,
    question: card.question || "新しい質問",
    visual: card.visual || "新規カード",
    image: card.image || DEFAULT_CARDS[0].image,
    imageStoragePath: card.imageStoragePath || "",
    yesScores: card.yesScores || { people: 1 },
    noScores: card.noScores || { focus: 1 },
    enabled: card.enabled ?? true,
    sortOrder: Number(card.sortOrder || fallbackSortOrder),
    questionType: card.questionType || "",
    dnaCategory: card.dnaCategory || "",
    typeCode: card.typeCode || "",
  };
}

function sortCards(cards) {
  return cards.sort((a, b) => {
    if (a.sortOrder !== b.sortOrder) return a.sortOrder - b.sortOrder;
    return a.id.localeCompare(b.id);
  });
}

function normalizeSpecialQuestionKey(value, fallback = "") {
  const normalized = String(value || "")
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9_-]/g, "-")
    .replace(/-+/g, "-")
    .replace(/^-+|-+$/g, "");
  return normalized || fallback;
}

export function normalizeSpecialQuestions(value = []) {
  const source = Array.isArray(value) ? value : [];

  return source
    .map((question, index) => {
      const key = normalizeSpecialQuestionKey(
        question?.key || question?.questionKey,
        `special-${String(index + 1).padStart(3, "0")}`,
      );
      const questionText = String(question?.questionText || "").trim();
      const optionALabel = String(question?.optionALabel || "").trim();
      const optionBLabel = String(question?.optionBLabel || "").trim();
      if (!key || !questionText || !optionALabel || !optionBLabel) return null;

      return {
        kind: "special",
        id: `special:${key}`,
        key,
        questionKey: key,
        question: questionText,
        questionText,
        optionALabel,
        optionBLabel,
        category:
          String(question?.category || "preference").trim() || "preference",
        enabled: question?.enabled !== false,
        insertAfterOrder: Math.max(
          1,
          Math.floor(Number(question?.insertAfterOrder || 1)),
        ),
        displayOrder: Math.max(
          1,
          Math.floor(Number(question?.displayOrder || index + 1)),
        ),
        backgroundImageUrl: String(question?.backgroundImageUrl || "").trim(),
        backgroundStoragePath: String(
          question?.backgroundStoragePath || "",
        ).trim(),
        // 80問QUESTION BANK対応：SPECIALペア・比較対象TYPE
        specialPairId: String(question?.specialPairId || "").trim(),
        typeCodeA: String(question?.typeCodeA || "").trim(),
        typeCodeB: String(question?.typeCodeB || "").trim(),
        payload:
          question?.payload &&
          typeof question.payload === "object" &&
          !Array.isArray(question.payload)
            ? question.payload
            : {},
      };
    })
    .filter(Boolean)
    .sort((a, b) => {
      if (a.insertAfterOrder !== b.insertAfterOrder)
        return a.insertAfterOrder - b.insertAfterOrder;
      if (a.displayOrder !== b.displayOrder)
        return a.displayOrder - b.displayOrder;
      return a.key.localeCompare(b.key);
    });
}

export function getConfiguredSpecialQuestions(settings = loadAdminSettings()) {
  return normalizeSpecialQuestions(settings.specialQuestions || []);
}

function insertSpecialQuestions(normalCards, specialQuestions) {
  if (!specialQuestions.length) return normalCards;

  const grouped = new Map();
  const totalSlots = normalCards.length + specialQuestions.length;
  specialQuestions.forEach((question) => {
    const displayPosition = Math.min(
      Math.max(1, Math.floor(Number(question.insertAfterOrder || 1))),
      Math.max(1, totalSlots),
    );
    grouped.set(displayPosition, [
      ...(grouped.get(displayPosition) || []),
      question,
    ]);
  });

  const output = [];
  let normalIndex = 0;

  for (let position = 1; position <= totalSlots; position += 1) {
    const group = grouped.get(position) || [];
    if (group.length) output.push(...group);
    if (output.length < position && normalIndex < normalCards.length) {
      output.push({ ...normalCards[normalIndex], kind: "normal" });
      normalIndex += 1;
    }
  }

  while (normalIndex < normalCards.length) {
    output.push({ ...normalCards[normalIndex], kind: "normal" });
    normalIndex += 1;
  }

  return output;
}

function shuffleCards(cards) {
  const shuffled = [...cards];
  for (let index = shuffled.length - 1; index > 0; index -= 1) {
    const randomIndex = Math.floor(Math.random() * (index + 1));
    [shuffled[index], shuffled[randomIndex]] = [
      shuffled[randomIndex],
      shuffled[index],
    ];
  }
  return shuffled;
}

function getSafeDiagnosisQuestionCount(settings, poolCount) {
  const requestedCount = Math.floor(
    Number(
      settings.diagnosisQuestionCount ||
        poolCount ||
        DEFAULT_SETTINGS.diagnosisQuestionCount,
    ),
  );
  return Math.max(1, Math.min(Math.max(poolCount, 1), requestedCount));
}

export function getDiagnosisQuestionError(settings = loadAdminSettings()) {
  const specialCount = getConfiguredSpecialQuestions(settings).filter(
    (question) => question.enabled !== false,
  ).length;
  const requestedCount = Math.max(
    1,
    Math.floor(
      Number(
        settings.diagnosisQuestionCount ||
          DEFAULT_SETTINGS.diagnosisQuestionCount,
      ),
    ),
  );

  if (specialCount > requestedCount) {
    return `出題ONのスペシャルクエスチョンが${specialCount}問あります。診断に使う質問数を${specialCount}問以上にしてください。`;
  }

  return "";
}

function getCardAxisPotential(card) {
  return Object.fromEntries(
    AXIS_ORDER.map((axis) => [
      axis,
      Math.max(
        Number(card.yesScores?.[axis] || 0),
        Number(card.noScores?.[axis] || 0),
      ),
    ]),
  );
}

function addAxisPotential(totals, potential) {
  return Object.fromEntries(
    AXIS_ORDER.map((axis) => [
      axis,
      Number(totals[axis] || 0) + Number(potential[axis] || 0),
    ]),
  );
}

function getAxisBalanceScore(totals) {
  const values = AXIS_ORDER.map((axis) => Number(totals[axis] || 0));
  const mean =
    values.reduce((sum, value) => sum + value, 0) / AXIS_ORDER.length;
  const variance = values.reduce((sum, value) => sum + (value - mean) ** 2, 0);
  const spread = Math.max(...values) - Math.min(...values);
  return variance + spread * 0.2;
}

function selectBalancedCards(questionPool, safeCount) {
  const remaining = shuffleCards(questionPool).map((card) => ({
    card,
    potential: getCardAxisPotential(card),
  }));
  const selected = [];
  let totals = Object.fromEntries(AXIS_ORDER.map((axis) => [axis, 0]));

  while (selected.length < safeCount && remaining.length > 0) {
    const scored = remaining
      .map((item, index) => ({
        index,
        score: getAxisBalanceScore(addAxisPotential(totals, item.potential)),
      }))
      .sort((a, b) => a.score - b.score);
    const pickRange = scored.slice(0, Math.min(4, scored.length));
    const picked = pickRange[Math.floor(Math.random() * pickRange.length)];
    const [item] = remaining.splice(picked.index, 1);
    selected.push(item.card);
    totals = addAxisPotential(totals, item.potential);
  }

  return shuffleCards(selected);
}

export function getConfiguredCards(settings = loadAdminSettings()) {
  const overrides = settings.cardOverrides || {};
  const deletedIds = new Set(settings.deletedCardIds || []);

  if (settings.useMasterCardsOnly) {
    const defaultOverrideNumbers = Object.keys(overrides)
      .map(getDefaultCardNumber)
      .filter((cardNumber) => cardNumber > 0);
    const maxOverrideDefaultCardNumber = Math.max(0, ...defaultOverrideNumbers);
    const supplementedOverrides = { ...overrides };

    if (maxOverrideDefaultCardNumber > 0) {
      DEFAULT_CARDS.forEach((card, index) => {
        const cardNumber = getDefaultCardNumber(card.id);
        if (
          supplementedOverrides[card.id] ||
          cardNumber <= maxOverrideDefaultCardNumber
        )
          return;
        supplementedOverrides[card.id] = getCardOverrideFromCard(
          card,
          index + 1,
        );
      });
    }

    return sortCards(
      Object.entries(supplementedOverrides)
        .filter(([id]) => !deletedIds.has(id))
        .map(([id, card], index) => buildCardFromOverride(id, card, index + 1)),
    );
  }

  const defaultIds = new Set(DEFAULT_CARDS.map((card) => card.id));
  const baseCards = DEFAULT_CARDS.filter(
    (card) => !deletedIds.has(card.id),
  ).map((card, index) => {
    const override = overrides[card.id] || {};
    return {
      ...card,
      ...override,
      id: card.id,
      enabled: override.enabled ?? true,
      sortOrder: Number(override.sortOrder || index + 1),
    };
  });
  const customCards = Object.entries(overrides)
    .filter(([id]) => !defaultIds.has(id) && !deletedIds.has(id))
    .map(([id, card], index) =>
      buildCardFromOverride(id, card, DEFAULT_CARDS.length + index + 1),
    );

  return sortCards([...baseCards, ...customCards]);
}

// ============================================================
// 80問QUESTION BANK対応：新しい抽選エンジン
// DNA(5×4) + TYPE(16+2) + SPECIAL(2) を優先順位付きで選び、
// 制約付きシャッフルで並び順を決める。
// ============================================================

const DNA_CATEGORIES = [
  "challenge",
  "people",
  "creativity",
  "analysis",
  "stability",
];
const QUESTION_HISTORY_STORAGE_KEY = "career_diagnosis_question_history_v2";

// 出題履歴：質問ごとの累計出題回数・最終出題日時・前回診断で出たかどうかを保持する。
// 匿名IDやサーバー保存は使わず、同一ブラウザのlocalStorageだけで完結させる。
function loadQuestionHistory() {
  try {
    const raw = JSON.parse(
      localStorage.getItem(QUESTION_HISTORY_STORAGE_KEY) || "{}",
    );
    return {
      counts: raw.counts && typeof raw.counts === "object" ? raw.counts : {},
      lastShownAt:
        raw.lastShownAt && typeof raw.lastShownAt === "object"
          ? raw.lastShownAt
          : {},
      lastDiagnosisIds: Array.isArray(raw.lastDiagnosisIds)
        ? raw.lastDiagnosisIds
        : [],
      // TYPEの「追加2枠」に選ばれた回数（16タイプの追加出題を長期的に均等にするため）
      extraTypeCounts:
        raw.extraTypeCounts && typeof raw.extraTypeCounts === "object"
          ? raw.extraTypeCounts
          : {},
      lastExtraTypeCodes: Array.isArray(raw.lastExtraTypeCodes)
        ? raw.lastExtraTypeCodes
        : [],
    };
  } catch (error) {
    console.warn(
      "[出題履歴] 読み込みに失敗したため、履歴なしで抽選します",
      error,
    );
    return {
      counts: {},
      lastShownAt: {},
      lastDiagnosisIds: [],
      extraTypeCounts: {},
      lastExtraTypeCodes: [],
    };
  }
}

function saveQuestionHistory(history) {
  try {
    localStorage.setItem(QUESTION_HISTORY_STORAGE_KEY, JSON.stringify(history));
  } catch (error) {
    // localStorageが使えない環境（プライベートモード等）では履歴機能を諦めて動作は継続する
    console.warn(
      "[出題履歴] 保存に失敗しました（再診断で同じ質問が出やすくなります）",
      error,
    );
  }
}

// 優先度：① 未出題 → ② 前回では出ていない過去出題 → ③ 前回出題、の3段階。
// 同じ段階内では「最後に出てからの経過時間が長い順」→ 同条件ならランダムで並べる。
function priorityTier(questionId, history) {
  const count = Number(history.counts[questionId] || 0);
  if (count === 0) return 0; // 未出題
  if (history.lastDiagnosisIds.includes(questionId)) return 2; // 前回出題
  return 1; // 過去出題だが前回は出ていない
}

function sortByPriority(questionIds, history) {
  const withMeta = questionIds.map((id) => ({
    id,
    tier: priorityTier(id, history),
    lastShownAt: history.lastShownAt[id]
      ? new Date(history.lastShownAt[id]).getTime()
      : 0,
    jitter: Math.random(),
  }));
  withMeta.sort((a, b) => {
    if (a.tier !== b.tier) return a.tier - b.tier;
    if (a.lastShownAt !== b.lastShownAt) return a.lastShownAt - b.lastShownAt; // 古い順（=長く出ていない順）
    return a.jitter - b.jitter;
  });
  return withMeta.map((item) => item.id);
}

// DNA：各カテゴリ8問から4問。カテゴリごとに優先順位ソートして先頭4つを取る。
function selectDnaCards(pool, history, perCategory = 4) {
  const byCategory = new Map(DNA_CATEGORIES.map((category) => [category, []]));
  pool.forEach((card) => {
    if (card.questionType === "dna" && byCategory.has(card.dnaCategory)) {
      byCategory.get(card.dnaCategory).push(card);
    }
  });

  const selected = [];
  DNA_CATEGORIES.forEach((category) => {
    const candidates = byCategory.get(category) || [];
    const orderedIds = sortByPriority(
      candidates.map((card) => card.id),
      history,
    );
    const cardById = new Map(candidates.map((card) => [card.id, card]));
    orderedIds
      .slice(0, perCategory)
      .forEach((id) => selected.push(cardById.get(id)));
  });

  return selected;
}

// TYPE：16タイプ最低1問＋公平性を考慮した追加2問。
function selectTypeCards(pool, history, extraCount = 2) {
  const byType = new Map();
  pool.forEach((card) => {
    if (card.questionType !== "type" || !card.typeCode) return;
    if (!byType.has(card.typeCode)) byType.set(card.typeCode, []);
    byType.get(card.typeCode).push(card);
  });

  const typeCodes = [...byType.keys()];
  const primaryPick = new Map(); // typeCode -> 選ばれたカード
  const leftover = []; // 各タイプの残り1問（追加枠の候補）

  typeCodes.forEach((typeCode) => {
    const candidates = byType.get(typeCode);
    const orderedIds = sortByPriority(
      candidates.map((card) => card.id),
      history,
    );
    const cardById = new Map(candidates.map((card) => [card.id, card]));
    const [firstId, ...restIds] = orderedIds;
    primaryPick.set(typeCode, cardById.get(firstId));
    restIds.forEach((id) =>
      leftover.push({ typeCode, card: cardById.get(id) }),
    );
  });

  // 追加枠：①追加枠に選ばれた回数が少ないTYPE ②直近診断で追加枠になっていないTYPE ③ランダム
  const extraTypeCounts = history.extraTypeCounts || {};
  const lastExtraTypeCodes = history.lastExtraTypeCodes || [];
  const scoredLeftover = leftover.map((item) => ({
    ...item,
    extraCount: Number(extraTypeCounts[item.typeCode] || 0),
    wasLastExtra: lastExtraTypeCodes.includes(item.typeCode) ? 1 : 0,
    jitter: Math.random(),
  }));
  scoredLeftover.sort((a, b) => {
    if (a.extraCount !== b.extraCount) return a.extraCount - b.extraCount;
    if (a.wasLastExtra !== b.wasLastExtra)
      return a.wasLastExtra - b.wasLastExtra;
    return a.jitter - b.jitter;
  });

  const extraPicks = scoredLeftover.slice(0, extraCount);

  return {
    cards: [...primaryPick.values(), ...extraPicks.map((item) => item.card)],
    extraTypeCodesChosen: extraPicks.map((item) => item.typeCode),
  };
}

// SPECIAL：8ペアから2ペア。優先順位は通常質問と同じ「未出題 > 過去出題(前回以外) > 前回出題」。
function selectSpecialCards(specialQuestions, history, count = 2) {
  const orderedKeys = sortByPriority(
    specialQuestions.map((question) => question.id),
    history,
  );
  const byId = new Map(
    specialQuestions.map((question) => [question.id, question]),
  );
  return orderedKeys.slice(0, count).map((id) => byId.get(id));
}

// 制約付きシャッフル：
// ・同じDNAカテゴリを原則2問連続させない
// ・同じTYPEの質問を連続させない
// ・SPECIALはQ15前後・Q30前後に配置する
function arrangeDiagnosisSequence(
  dnaCards,
  typeCards,
  specialCards,
  totalSlots,
) {
  const normalCards = shuffleCards([...dnaCards, ...typeCards]);

  const getGroupKey = (card) =>
    card.questionType === "dna"
      ? `dna:${card.dnaCategory}`
      : `type:${card.typeCode}`;

  // 貪欲法：直前・直後と同じグループが連続しないよう、後方のカードと入れ替えながら並べる
  // （1回だけだと稀に1箇所だけ残ることがあるため、往復2パスにして精度を上げる）
  const arranged = [...normalCards];
  const fixPass = (direction) => {
    const range =
      direction === "forward"
        ? Array.from({ length: arranged.length - 1 }, (_, i) => i + 1)
        : Array.from(
            { length: arranged.length - 1 },
            (_, i) => arranged.length - 1 - i,
          );
    range.forEach((i) => {
      if (getGroupKey(arranged[i]) !== getGroupKey(arranged[i - 1])) return;
      let swapIndex = -1;
      for (let j = 0; j < arranged.length; j += 1) {
        if (j === i || j === i - 1) continue;
        const key = getGroupKey(arranged[j]);
        const prevOk = key !== getGroupKey(arranged[i - 1]);
        const nextOk =
          i + 1 >= arranged.length || key !== getGroupKey(arranged[i + 1]);
        const jPrevOk =
          j === 0 || getGroupKey(arranged[i]) !== getGroupKey(arranged[j - 1]);
        const jNextOk =
          j + 1 >= arranged.length ||
          getGroupKey(arranged[i]) !== getGroupKey(arranged[j + 1]);
        if (prevOk && nextOk && jPrevOk && jNextOk) {
          swapIndex = j;
          break;
        }
      }
      if (swapIndex > -1) {
        [arranged[i], arranged[swapIndex]] = [arranged[swapIndex], arranged[i]];
      }
      // 交換先が見つからなくても、致命的ではないのでそのまま進める（完全制約は求めない）
    });
  };
  fixPass("forward");
  fixPass("backward");

  // SPECIALの挿入位置（40問構成なら15・30。表示数が違う場合は比率で計算）
  const ratio1 = 15 / 40;
  const ratio2 = 30 / 40;
  const positions = specialCards
    .map((card, index) => ({
      card,
      position: Math.min(
        totalSlots,
        Math.max(1, Math.round(totalSlots * (index === 0 ? ratio1 : ratio2))),
      ),
    }))
    .sort((a, b) => a.position - b.position);

  const output = [];
  let normalIndex = 0;
  let specialIndex = 0;
  for (let slot = 1; slot <= totalSlots; slot += 1) {
    if (
      specialIndex < positions.length &&
      positions[specialIndex].position === slot
    ) {
      output.push({ ...positions[specialIndex].card, kind: "special" });
      specialIndex += 1;
      continue;
    }
    if (normalIndex < arranged.length) {
      output.push({ ...arranged[normalIndex], kind: "normal" });
      normalIndex += 1;
    }
  }
  // 端数が出た場合の保険
  while (normalIndex < arranged.length) {
    output.push({ ...arranged[normalIndex], kind: "normal" });
    normalIndex += 1;
  }
  while (specialIndex < positions.length) {
    output.push({ ...positions[specialIndex].card, kind: "special" });
    specialIndex += 1;
  }

  return output;
}

// 新エンジンが使えるか判定：DNA/TYPEタグが十分に揃っているか
export function canUseTaggedEngine(questionPool) {
  const dnaCounts = new Map();
  const typeCounts = new Map();
  questionPool.forEach((card) => {
    if (card.questionType === "dna" && card.dnaCategory) {
      dnaCounts.set(
        card.dnaCategory,
        (dnaCounts.get(card.dnaCategory) || 0) + 1,
      );
    }
    if (card.questionType === "type" && card.typeCode) {
      typeCounts.set(card.typeCode, (typeCounts.get(card.typeCode) || 0) + 1);
    }
  });
  const hasAllDna = DNA_CATEGORIES.every(
    (category) => (dnaCounts.get(category) || 0) >= 4,
  );
  const hasEnoughTypes = typeCounts.size >= 16;
  return hasAllDna && hasEnoughTypes;
}

// 出題履歴を更新する（今回選ばれた通常質問ID・追加TYPE枠・SPECIALのIDを記録）
function recordQuestionExposure(selectedCards, extraTypeCodesChosen) {
  const history = loadQuestionHistory();
  const now = new Date().toISOString();
  const shownIds = [];

  selectedCards.forEach((card) => {
    const id = card.kind === "special" ? card.id : card.id;
    if (!id) return;
    shownIds.push(id);
    history.counts[id] = Number(history.counts[id] || 0) + 1;
    history.lastShownAt[id] = now;
  });

  history.lastDiagnosisIds = shownIds;

  (extraTypeCodesChosen || []).forEach((typeCode) => {
    history.extraTypeCounts[typeCode] =
      Number(history.extraTypeCounts[typeCode] || 0) + 1;
  });
  history.lastExtraTypeCodes = extraTypeCodesChosen || [];

  saveQuestionHistory(history);
}

// 新エンジン本体：DNA20 + TYPE18 + SPECIAL2 の比率を守りつつ、指定の合計数(safeCount)にスケールする。
// 標準の40問なら DNA20/TYPE18/SPECIAL2 のまま。異なる問題数が設定されていても比率を保つ。
function selectTaggedDiagnosisCards(
  questionPool,
  specialQuestions,
  safeCount,
  recordExposure = false,
) {
  const history = loadQuestionHistory();

  const specialTarget = Math.max(
    0,
    Math.min(2, Math.round((safeCount / 40) * 2)),
  );
  const remainingAfterSpecial = safeCount - specialTarget;
  const dnaTarget = Math.round((remainingAfterSpecial * 20) / 38);
  const dnaPerCategory = Math.max(
    1,
    Math.round(dnaTarget / DNA_CATEGORIES.length),
  );
  const typeTarget = Math.max(
    0,
    remainingAfterSpecial - dnaPerCategory * DNA_CATEGORIES.length,
  );

  const dnaCards = selectDnaCards(questionPool, history, dnaPerCategory);
  const { cards: typeCards, extraTypeCodesChosen } = selectTypeCards(
    questionPool,
    history,
    Math.max(0, typeTarget - 16),
  );
  const specialCards = selectSpecialCards(
    specialQuestions,
    history,
    specialTarget,
  );

  const sequence = arrangeDiagnosisSequence(
    dnaCards,
    typeCards,
    specialCards,
    safeCount,
  );

  // 出題履歴に記録するのは「実際に診断を開始して表示する抽選」の時だけ。
  // ページ読み込み時の下準備の抽選まで記録すると、表示されていない質問が
  // 「出題済み」扱いになり、再診断で同じ質問が出続けてしまうため。
  if (recordExposure) {
    // 調査用：履歴が効いているか確認したい時だけ、下の3行のコメントを外す
    // console.info(
    //   `[出題履歴] 抽選前に履歴にあった質問数: ${Object.keys(history.counts).length} / 前回の質問数: ${history.lastDiagnosisIds.length}`,
    // );
    recordQuestionExposure(sequence, extraTypeCodesChosen);
  }

  return sequence;
}

export function getDiagnosisCards(
  settings = loadAdminSettings(),
  { recordExposure = false } = {},
) {
  const configuredCards = getConfiguredCards(settings);
  const enabledCards = configuredCards.filter((card) => card.enabled !== false);
  const questionPool = enabledCards.length
    ? enabledCards
    : configuredCards.slice(0, 1);
  const specialQuestions = getConfiguredSpecialQuestions(settings).filter(
    (question) => question.enabled !== false,
  );
  const totalPoolCount = questionPool.length + specialQuestions.length;
  const safeCount = getSafeDiagnosisQuestionCount(settings, totalPoolCount);

  // 80問QUESTION BANK（DNA/TYPEタグ付き）が十分に揃っていれば新しい抽選エンジンを使う。
  // 揃っていない場合（旧6軸カードのまま等）は、これまで通りのバランス抽選にフォールバックする。
  if (canUseTaggedEngine(questionPool) && specialQuestions.length > 0) {
    return selectTaggedDiagnosisCards(
      questionPool,
      specialQuestions,
      safeCount,
      recordExposure,
    );
  }

  const specialCount = Math.min(specialQuestions.length, safeCount);
  const normalCount = Math.max(0, safeCount - specialCount);
  const selectedNormalCards =
    normalCount > 0 ? selectBalancedCards(questionPool, normalCount) : [];
  return insertSpecialQuestions(
    selectedNormalCards,
    specialQuestions.slice(0, specialCount),
  );
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
        industries: overrides[key]?.industries || result.industries,
      },
    ]),
  );
}

// 16TYPE版：admin-masterの diagnosis_results に同名キー(TYPE_CODE)の上書きがあれば反映する。
// weapon/bestEnvironmentは今のadmin側スキーマにまだ無いので、上書きが無ければ既定値のまま使う。
export function getConfiguredResults16(settings = loadAdminSettings()) {
  const overrides = settings.resultOverrides || {};
  return Object.fromEntries(
    Object.entries(DEFAULT_RESULTS_16).map(([key, result]) => [
      key,
      {
        ...result,
        ...(overrides[key] || {}),
        strengths: overrides[key]?.strengths || result.strengths,
        jobs: overrides[key]?.jobs || result.jobs,
        weapon: overrides[key]?.weapon || result.weapon,
        bestEnvironment:
          overrides[key]?.bestEnvironment || result.bestEnvironment,
      },
    ]),
  );
}

// ============================================================
// 16TYPE 判定エンジン（FINAL SCORE計算）
// TYPE直接適合度70% + DNA適合度20% + SPECIAL適合度10%
// SPECIAL未出題のTYPEは、残り90%を100%に再正規化する。
// ============================================================

const DNA_FIT_WEIGHT_WITH_SPECIAL = { direct: 0.7, dnaFit: 0.2, special: 0.1 };
const DNA_FIT_WEIGHT_WITHOUT_SPECIAL = { direct: 0.7778, dnaFit: 0.2222 };

// answers: state.answers 形式 [{imageId, answer:'yes'|'no'}, ...]
// specialAnswers: state.specialAnswers 形式（typeCodeA/typeCodeB/selectedTypeCodeを含む想定）
// cardList: 実際に出題された40枚（dnaCategory/typeCode付き）
export function calculateTypeDiagnosis(answers, specialAnswers, cardList) {
  const cardById = new Map(cardList.map((card) => [card.id, card]));

  // --- ① DNA SCORE（5軸） ---
  const dnaYesCount = Object.fromEntries(DNA_CATEGORIES.map((c) => [c, 0]));
  const dnaAnsweredCount = Object.fromEntries(
    DNA_CATEGORIES.map((c) => [c, 0]),
  );

  answers.forEach((answerData) => {
    const card = cardById.get(answerData.imageId);
    if (
      !card ||
      card.questionType !== "dna" ||
      !DNA_CATEGORIES.includes(card.dnaCategory)
    )
      return;
    dnaAnsweredCount[card.dnaCategory] += 1;
    if (answerData.answer === "yes") dnaYesCount[card.dnaCategory] += 1;
  });

  const dnaScores = Object.fromEntries(
    DNA_CATEGORIES.map((category) => {
      const answered = dnaAnsweredCount[category] || 0;
      const score =
        answered > 0
          ? Math.round((dnaYesCount[category] / answered) * 100)
          : 50;
      return [category, score];
    }),
  );

  // --- ② TYPE直接適合度 ---
  const typeYesTotal = Object.fromEntries(TYPE_CODES.map((t) => [t, 0]));
  const typeAnsweredCount = Object.fromEntries(TYPE_CODES.map((t) => [t, 0]));

  answers.forEach((answerData) => {
    const card = cardById.get(answerData.imageId);
    if (
      !card ||
      card.questionType !== "type" ||
      !TYPE_CODES.includes(card.typeCode)
    )
      return;
    typeAnsweredCount[card.typeCode] += 1;
    typeYesTotal[card.typeCode] += answerData.answer === "yes" ? 100 : 0;
  });

  const typeDirect = Object.fromEntries(
    TYPE_CODES.map((type) => {
      const answered = typeAnsweredCount[type] || 0;
      return [type, answered > 0 ? typeYesTotal[type] / answered : 0];
    }),
  );

  // --- ③ SPECIAL適合度（出題された2ペアのみ値を持つ） ---
  const specialByType = {};
  (specialAnswers || []).forEach((special) => {
    const typeCodeA = special.typeCodeA;
    const typeCodeB = special.typeCodeB;
    const selected =
      special.selectedTypeCode ||
      (special.selectedOption === "B" ? typeCodeB : typeCodeA);
    if (typeCodeA) specialByType[typeCodeA] = selected === typeCodeA ? 100 : 0;
    if (typeCodeB) specialByType[typeCodeB] = selected === typeCodeB ? 100 : 0;
  });

  // --- ④ DNA適合度（ユーザーの5DNA と TYPE基準DNAとの近さ） ---
  const dnaFit = Object.fromEntries(
    TYPE_CODES.map((type) => {
      const baseline = TYPE_DNA_BASELINE[type];
      const diffs = DNA_CATEGORIES.map((category) =>
        Math.abs((dnaScores[category] || 0) - (baseline[category] || 0)),
      );
      const avgDiff =
        diffs.reduce((sum, value) => sum + value, 0) / diffs.length;
      return [type, Math.max(0, 100 - avgDiff)];
    }),
  );

  // --- ⑤ FINAL SCORE ---
  const finalScores = Object.fromEntries(
    TYPE_CODES.map((type) => {
      const hasSpecial = Object.prototype.hasOwnProperty.call(
        specialByType,
        type,
      );
      const score = hasSpecial
        ? typeDirect[type] * DNA_FIT_WEIGHT_WITH_SPECIAL.direct +
          dnaFit[type] * DNA_FIT_WEIGHT_WITH_SPECIAL.dnaFit +
          specialByType[type] * DNA_FIT_WEIGHT_WITH_SPECIAL.special
        : typeDirect[type] * DNA_FIT_WEIGHT_WITHOUT_SPECIAL.direct +
          dnaFit[type] * DNA_FIT_WEIGHT_WITHOUT_SPECIAL.dnaFit;
      return [type, score];
    }),
  );

  // --- ⑥ 順位決定（同点は 直接適合度 → SPECIAL選択 → DNA適合度 → 固定順 で決める） ---
  const ranked = [...TYPE_CODES].sort((a, b) => {
    if (finalScores[b] !== finalScores[a])
      return finalScores[b] - finalScores[a];
    if (typeDirect[b] !== typeDirect[a]) return typeDirect[b] - typeDirect[a];
    const aSpecial = specialByType[a] || 0;
    const bSpecial = specialByType[b] || 0;
    if (bSpecial !== aSpecial) return bSpecial - aSpecial;
    if (dnaFit[b] !== dnaFit[a]) return dnaFit[b] - dnaFit[a];
    return TYPE_CODES.indexOf(a) - TYPE_CODES.indexOf(b);
  });

  return {
    dnaScores,
    typeDirect,
    dnaFit,
    specialByType,
    finalScores,
    ranked,
    primaryType: ranked[0],
    secondaryType: ranked[1],
  };
}
