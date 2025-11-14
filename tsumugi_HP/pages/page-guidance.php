<?php
/*
Template Name: guidance
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="guidance-page">
    <section class="sec_guidance-contents">
        <div class="C_guidance-contents">
            <div class="C_guidance-contents-inner">
                <!-- メニュー -->
                <div class="sticky-menu">
                    <div class="ttl sp">
                        <p class="TX">MENU</p>
                        <div class="icon"></div>
                    </div>
                    <div class="nav">
                        <ul class="nav-lists">
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-01">
                                    <div class="icon"></div>
                                    <p class="TX">入院前の準備</p>
                                </a>
                                <ul>
                                    <li>
                                        <a class="hover-opa" href="#guidance-contents-01-01">
                                            <p class="tx">−持ち物チェックリスト</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="hover-opa" href="#guidance-contents-01-02">
                                            <p class="tx">−入院に関するお願い</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-02">
                                    <div class="icon"></div>
                                    <p class="TX">入院に関する書類</p>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-03">
                                    <div class="icon"></div>
                                    <p class="TX">面会・立会いについて</p>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-04">
                                    <div class="icon"></div>
                                    <p class="TX">入院環境</p>
                                </a>
                                <ul>
                                    <li>
                                        <a class="hover-opa" href="#guidance-contents-04-01">
                                            <p class="tx">−病室紹介</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-05">
                                    <div class="icon"></div>
                                    <p class="TX">食事について</p>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a class="hover-opa" href="#guidance-contents-06">
                                    <div class="icon"></div>
                                    <p class="TX">費用について</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- コンテンツ -->
                <div class="contents-area">
                    <!-- 01 -->
                    <div class="contents-area-item" id="guidance-contents-01">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-01-pc.svg"
                                        alt="入院前の準備"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-01-sp.svg"
                                        alt="入院前の準備"
                                    />
                                </h3>
                            </div>
                            <div class="item-txt">
                                <p class="TX">
                                    入院に向けて、以下のご準備をお願いします。急な入院にも対応できるように30週くらいから準備を整えてください。
                                </p>
                            </div>
                        </div>
                        <div class="item-contents contents-01">
                            <div class="item contents-01-01" id="guidance-contents-01-01">
                                <!-- 01-01-01 -->
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-01-pc.svg"
                                                alt="書類・手帳・証明書など"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-01-sp.svg"
                                                alt="書類・手帳・証明書など"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-01-01-01">
                                        <div class="check-list">
                                            <ul>
                                                <li>母子健康手帳</li>
                                                <li>マイナンバーカード(保険証)</li>
                                                <li>内服薬</li>
                                                <li>筆記用具</li>
                                                <li>
                                                    入院に必要な書類<br class="sp" /><a
                                                        href="#"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        >書類の確認・ダウンロードはこちら</a
                                                    >
                                                </li>
                                                <li>同意書(お持ちの方)</li>
                                            </ul>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">
                                                ※なお、セキュリティーボックスなどはありません。
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- 01-01-02 -->
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-02-pc.svg"
                                                alt="入院中に使用するもの"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-02-sp.svg"
                                                alt="入院中に使用するもの"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-01-01-02">
                                        <div class="check-list">
                                            <ul>
                                                <li>パジャマ</li>
                                                <li>下着類</li>
                                                <li>歯ブラシ</li>
                                                <li>マスク</li>
                                                <li>リラックスグッズ</li>
                                                <li>洗剤等（洗濯機を使用される場合）</li>
                                            </ul>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">
                                                ※入院中は、1日にタオル・バスタオル各1枚をご利用いただけます。
                                            </p>
                                            <p class="TX">
                                                ※シャンプー・トリートメント・ボディーソープは院内に準備があります。
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- 01-01-03 -->
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-03-pc.svg"
                                                alt="退院時に必要なもの"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-03-sp.svg"
                                                alt="退院時に必要なもの"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-01-01-03">
                                        <div class="check-list">
                                            <ul>
                                                <li>ベビー服・肌着</li>
                                            </ul>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">※午前中の退院にご協力をお願いいたします。</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item contents-01-02" id="guidance-contents-01-02">
                                <!-- 01-02-01 -->
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-04-pc.svg"
                                                alt="入院に関するお願い"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-04-sp.svg"
                                                alt="入院に関するお願い"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-01-02-01">
                                        <div class="request-list">
                                            <ul>
                                                <li>
                                                    可能な限り、入院前に爪を切り化粧を落としてくださると助かります。
                                                </li>
                                                <li>
                                                    緊急場面に備えて、指輪やピアスなどは外しておくことをお勧めしています。
                                                </li>
                                                <li>
                                                    入院中、健康保険証に変更があった場合はご提示ください。
                                                </li>
                                                <li>
                                                    空き状況によってはご希望のお部屋をご案内できない場合があります。
                                                </li>
                                                <li>お部屋の事前予約は承っておりません。</li>
                                                <li>
                                                    入院中は基本的に外出ができません。医師の許可が必要です。
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="decoration">
                            <div class="char char-01 pc"></div>
                            <div class="char char-02 pc"></div>
                            <div class="char char-03">
                                <div class="note"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 02 -->
                    <div class="contents-area-item" id="guidance-contents-02">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-02-pc.svg"
                                        alt="入院に関する書類"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-02-sp.svg"
                                        alt="入院に関する書類"
                                    />
                                </h3>
                            </div>
                            <div class="item-txt">
                                <p class="TX">
                                    入院までに下記書類をご記入いただき、入院時にお持ちください。
                                </p>
                            </div>
                        </div>
                        <div class="item-02-btn">
                            <a class="hover-opa" href="#" target="_blank" rel="noopener noreferrer">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-btn-01.svg"
                                    alt="入院申込書兼誓約書（PDF）"
                                />
                            </a>
                        </div>
                        <div class="decoration">
                            <div class="char char-04">
                                <div class="note"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 03 -->
                    <div class="contents-area-item" id="guidance-contents-03">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-03-pc.svg"
                                        alt="面会・立会について"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-03-sp.svg"
                                        alt="面会・立会について"
                                    />
                                </h3>
                            </div>
                        </div>
                        <div class="item-contents contents-03">
                            <!-- 03-01 -->
                            <div class="item contents-03-01">
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-05-pc.svg"
                                                alt="立会い分娩について"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-05-sp.svg"
                                                alt="立会い分娩について"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-03-01-01">
                                        <div class="txt">
                                            <p class="TX">
                                                つむぎクリニックでは、無制限です。こちらから制限をすることはないということです。ただ、私たちが大切にしている分娩の時間は、自身の身体と心の声を聞きながら、分娩に集中できる環境で、リラックスして過ごすことができる時間であってほしいと願っています。そのために、誰に立ち会って欲しいか、誰とどのように過ごしたいか、妊娠中から家族で話す機会をたくさん持っていただきたいのです。立ち会う家族の気持ちや思いも大切にして、お部屋は決して広くなく、分娩が長時間になるかもしれませんが、立ち会いをする時間も一緒に考えていきたいと考えています。
                                            </p>
                                        </div>
                                        <div class="hr"></div>
                                        <div class="visitation-list">
                                            <ul>
                                                <li>
                                                    帝王切開時の立ち合いは、ご主人またはーパートナの方のみ可能です。当日に注意事項などをお伝えしています。
                                                </li>
                                                <li>※病棟に入る際は、検温をお願いします。</li>
                                                <li>
                                                    ※体調が悪い場合や風邪症状がある場合はお控え願います。
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 03-02 -->
                            <div class="item contents-03-02">
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-06-pc.svg"
                                                alt="面会について"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-06-sp.svg"
                                                alt="面会について"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-03-02-01">
                                        <div class="txt">
                                            <p class="TX">
                                                入院中は、お母さんの静養や育児に集中できる環境を大切にしています。分娩や昼夜問わない赤ちゃんのお世話で、とても疲れているかもしれません。そんなときに、どんな支援が必要になりそうか、面会に来てほしい方を思い浮かべて考えてみていただけたらと思います。面会に来られる方にも、産後の入院中は休息が取れるよう、ご配慮をお願いたします。
                                            </p>
                                        </div>
                                        <div class="hr"></div>

                                        <div class="time">
                                            <p class="TX">面会時間：13:00~21:00</p>
                                        </div>
                                        <div class="visitation-list point">
                                            <ul>
                                                <li>面会時は患者様に事前にご連絡ください。</li>
                                                <li>
                                                    可能な限り日中の面会、周りの患者様にご配慮ください。
                                                </li>
                                                <li>
                                                    患者様へのケアを優先させていただくこともありますので、ご了承ください。
                                                </li>
                                                <li>
                                                    外来診療時間内は、受付にお声がけください。診療時間外の場合は、正面玄関のインターホンでお知らせください。
                                                </li>
                                                <li>
                                                    病棟内(2階)に入る際は、「入院患者様のお名前」、「お部屋番号」、「ご関係」を職員に伝えてください。
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="decoration">
                            <div class="char char-05"></div>
                        </div>
                    </div>

                    <!-- 04 -->
                    <div class="contents-area-item" id="guidance-contents-04">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-04-pc.svg"
                                        alt="入院環境"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-04-sp.svg"
                                        alt="入院環境"
                                    />
                                </h3>
                            </div>
                            <div class="item-txt">
                                <p class="TX">
                                    出産という大きな節目を安心して迎えられるよう、清潔で落ち着いた入院環境を整えています。快適な空間ときめ細やかなサポートで、お母さんと赤ちゃんがゆったりと過ごせるよう配慮しています。
                                </p>
                            </div>
                        </div>
                        <div class="item-contents contents-04" id="guidance-contents-04-01">
                            <nav class="contents-04-menu">
                                <div class="ttl">
                                    <img
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-07.svg"
                                        alt="病室紹介"
                                    />
                                </div>
                                <ul>
                                    <li>
                                        <a class="hover-opa" href="#contents-04-01">個室A</a>
                                    </li>
                                    <li>
                                        <a class="hover-opa" href="#contents-04-02">個室B</a>
                                    </li>
                                    <li>
                                        <a class="hover-opa" href="#contents-04-03">２人部屋</a>
                                    </li>
                                    <li>
                                        <a class="hover-opa" href="#contents-04-04">シャワー室</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="contents-04-content">
                                <div class="contents-04-content-inner">
                                    <div class="room-item" id="contents-04-01">
                                        <div class="ttl">
                                            <h4 class="TL">
                                                <img
                                                    class="pc"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-01-pc.svg"
                                                    alt="個室A （和室：トイレ・シャワー付き）"
                                                />
                                                <img
                                                    class="sp"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-01-sp.svg"
                                                    alt="個室A （和室：トイレ・シャワー付き）"
                                                />
                                            </h4>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">シャワー、トイレ付きの完全個室です。</p>
                                        </div>
                                        <div class="img">
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-01.webp"
                                                alt="個室A （和室：トイレ・シャワー付き）"
                                            />
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-02.webp"
                                                alt="個室A （和室：トイレ・シャワー付き）"
                                            />
                                        </div>
                                    </div>
                                    <div class="room-item" id="contents-04-02">
                                        <div class="ttl">
                                            <h4 class="TL">
                                                <img
                                                    class="pc"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-02-pc.svg"
                                                    alt="個室B （洋室：トイレ付き）"
                                                />
                                                <img
                                                    class="sp"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-02-sp.svg"
                                                    alt="個室B （洋室：トイレ付き）"
                                                />
                                            </h4>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">トイレ付きです。</p>
                                        </div>
                                        <div class="img">
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-03.webp"
                                                alt="個室B （洋室：トイレ付き）"
                                            />
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-04.webp"
                                                alt="個室B （洋室：トイレ付き）"
                                            />
                                        </div>
                                    </div>
                                    <div class="room-item" id="contents-04-03">
                                        <div class="ttl">
                                            <h4 class="TL">
                                                <img
                                                    class="pc"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-03-pc.svg"
                                                    alt="２人部屋"
                                                />
                                                <img
                                                    class="sp"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-03-sp.svg"
                                                    alt="２人部屋"
                                                />
                                            </h4>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">
                                                カーテンの仕切りでプライベート空間を確保できます。
                                            </p>
                                        </div>
                                        <div class="img">
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-05.webp"
                                                alt="２人部屋"
                                            />
                                        </div>
                                    </div>
                                    <div class="room-item" id="contents-04-04">
                                        <div class="ttl">
                                            <h4 class="TL">
                                                <img
                                                    class="pc"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-04-pc.svg"
                                                    alt="シャワー室（共有）"
                                                />
                                                <img
                                                    class="sp"
                                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-ttl-04-sp.svg"
                                                    alt="シャワー室（共有）"
                                                />
                                            </h4>
                                        </div>
                                        <div class="txt">
                                            <p class="TX">
                                                2部屋あります。洗濯機、乾燥機を準備してあります。
                                            </p>
                                        </div>
                                        <div class="img">
                                            <img
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-room-06.webp"
                                                alt="シャワー室（共有）"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-04-btn">
                            <a class="hover-opa" href="<?php echo home_url(); ?>/about#about_introduction" >
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-btn-02.svg"
                                    alt="施設全体の紹介はこちら"
                                />
                            </a>
                        </div>
                    </div>

                    <!-- 05 -->
                    <div class="contents-area-item" id="guidance-contents-05">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-05-pc.svg"
                                        alt="入院中のお食事について"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-05-sp.svg"
                                        alt="入院中のお食事について"
                                    />
                                </h3>
                            </div>
                            <div class="item-txt">
                                <h4 class="TL">
                                    ママの体と心がじんわり整う<br class="sp" />「いたわりごはん」
                                </h4>
                                <p class="TX">
                                    「食べるもので身体は作られる」という理念のもと、私たちは献立を立てるときに、まず腸内環境を良好にすることを意識しています。減農薬、地元の食材、発酵食品を取り入れた家庭料理をめざしています。妊娠は食事についてもう一度考えるきっかけになります。「食べる」を大切にすることは自分自身を大切にすること、その食習慣は子どもの食事につながっていきます。<br />
                                    妊娠に伴い貧血になりやすいなど週数によって食事で工夫が必要なこともあります。また、食事についての様々な情報が溢れている今、頭で考えすぎてかえってうまくいかなくなってしまうこともあります。私たちが目指すのは身体だけでなく心もホッとするお食事です。つむぎクリニックでは食べることの大切さをお産を通じて、伝えていきたいと思っています。
                                </p>
                            </div>
                        </div>

                        <div class="item-food-img">
                            <div class="food-img">
                                <div class="img img-01"></div>
                                <div class="img img-02"></div>
                            </div>
                            <div class="food-img">
                                <div class="img img-03"></div>
                                <div class="img img-04"></div>
                            </div>
                        </div>

                        <div class="item-contents contents-05">
                            <div class="item contents-05-01">
                                <!-- 05-01 -->
                                <div class="item-inner">
                                    <div class="item-ttl">
                                        <h5 class="TL">
                                            <img
                                                class="pc"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-08-pc.svg"
                                                alt="1日の献立例"
                                            />
                                            <img
                                                class="sp"
                                                src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-inr-08-sp.svg"
                                                alt="1日の献立例"
                                            />
                                        </h5>
                                    </div>
                                    <div class="item-05-01">
                                        <div class="food-list">
                                            <ul>
                                                <li>
                                                    <h5 class="TL">朝食</h5>
                                                    <p class="TX">
                                                        鮭焼魚 / 蟹玉子焼き / ひじき煮 / 生野菜 /
                                                        大根の味噌汁 / 白御飯 /<br class="pc" />
                                                        香の物 / 焼海苔 / 煮豆
                                                    </p>
                                                </li>
                                                <li>
                                                    <h5 class="TL">昼食</h5>
                                                    <p class="TX">
                                                        海老と帆立 / 春野菜の葛煮 / 煮穴子と筍
                                                        新牛蒡の卯の花炒め /<br class="pc" />
                                                        黒海苔 / とろろ椀 / 白御飯 / りんご / 牛乳
                                                    </p>
                                                </li>
                                                <li>
                                                    <h5 class="TL">おやつ</h5>
                                                    <p class="TX">林檎のムースケーキ＆アールグレイ</p>
                                                </li>
                                                <li>
                                                    <h5 class="TL">夕食</h5>
                                                    <p class="TX">
                                                        アンディーブのサラダ / オニオングラタンスープ /
                                                        牛肉のトマト煮 /<br class="pc" />
                                                        自家製キッシュ / ライス / パパイヤ
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="decoration">
                            <div class="char char-07 pc"></div>
                        </div>
                    </div>

                    <!-- 06 -->
                    <div class="contents-area-item" id="guidance-contents-06">
                        <div class="item-common">
                            <div class="item-ttl">
                                <h3 class="TL">
                                    <img
                                        class="pc"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-06-pc.svg"
                                        alt="費用について"
                                    />
                                    <img
                                        class="sp"
                                        src="<?php echo get_template_directory_uri(); ?>/img/guidance/guidance-contents-ttl-06-sp.svg"
                                        alt="費用について"
                                    />
                                </h3>
                            </div>
                            <div class="item-txt">
                                <p class="TX">
                                    出産という大きな節目を安心して迎えられるよう、清潔で落ち着いた入院環境を整えています。快適な空間ときめ細やかなサポートで、お母さんと赤ちゃんがゆったりと過ごせるよう配慮しています。
                                </p>
                            </div>
                        </div>
                        <div class="decoration">
                            <div class="char char-08 sp"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_template_part('./inc/footer'); ?>
