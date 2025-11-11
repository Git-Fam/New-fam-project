<?php
/*
Template Name: recruit
*/
get_header(); ?>
<html lang="ja">
    <head prefix="og: https://ogp.me/ns#">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ▼TELL&MAIL&ADDRESSの自動リンク機能を制御 -->
    <meta name="format-detection" content="email=no,telephone=no,address=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta property="og:locale" content="ja_JP" />

    <!-- ▼SEO -->
    <link rel="canonical" href="<?php echo get_home_url(); ?>" />
    <title><?php
    bloginfo('name');
    if (wp_title('', false)) {
        echo ' | ' . wp_title('', false);
    }
    ?></title>
    <meta name="title" content="<?php
    bloginfo('name');
    if (wp_title('', false)) {
        echo ' | ' . wp_title('', false);
    }
    ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="<?php
    bloginfo('name');
    if (wp_title('', false)) {
        echo ' | ' . wp_title('', false);
    }
    ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="<?php
    bloginfo('name');
    if (wp_title('', false)) {
        echo ' | ' . wp_title('', false);
    }
    ?>" />
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" />

    <!-- ▼ファビコン -->
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.svg" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/site.webmanifest" />

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">

    <script>
            (function(d) {
              var config = {
                kitId: 'iwo8ojf',
                scriptTimeout: 3000,
                async: true
              },
              h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
            })(document);
          </script>



    <?php wp_head(); ?>

</head>

    <body>
        <div class="whopper">
            <header class="header">
                <div class="header__inner">
                    <h1 class="TL">
                        <a class="hover-opa" href="#">
                            <img src="img/main-logo.svg" alt="つむぎクリニック" />
                        </a>
                    </h1>

                    <nav class="nav-display pc">
                        <ul>
                            <li>
                                <a class="hover-opa" href="#">
                                    <div class="icon"></div>
                                    <p class="TX">つむぎクリニックについて</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="#">
                                    <div class="icon"></div>
                                    <p class="TX">はじめての方</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="#">
                                    <div class="icon"></div>
                                    <p class="TX">診療案内</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="#">
                                    <div class="icon"></div>
                                    <p class="TX">採用情報</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="#">
                                    <div class="icon"></div>
                                    <p class="TX">お問い合わせ</p>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="burger-open hover-opa"></div>

                    <div class="nav-invisible">
                        <div class="burger-close hover-opa"></div>
                        <div class="nav-invisible-inner">
                            <nav class="nav-area">
                                <ul class="lists">
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">TOP</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">診察案内</p>
                                        </a>
                                        <ul class="lists-in-lists">
                                            <li class="lists-in-lists-item">
                                                <a class="hover-opa" href="#">
                                                    <p class="TX">産科</p>
                                                </a>
                                            </li>
                                            <li class="lists-in-lists-item">
                                                <a class="hover-opa" href="#">
                                                    <p class="TX">婦人科</p>
                                                </a>
                                            </li>
                                            <li class="lists-in-lists-item">
                                                <a class="hover-opa" href="#">
                                                    <p class="TX">無痛分娩について</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">つむぎクリニックについて</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">入院案内</p>
                                        </a>
                                    </li>
                                    <li class="lists-item pc">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">ご予約</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="lists">
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">採用情報</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">お知らせ</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">お問い合わせ</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">よくある質問</p>
                                        </a>
                                    </li>
                                    <li class="lists-item pc">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">施設基準</p>
                                        </a>
                                    </li>
                                    <li class="lists-item pc">
                                        <a class="hover-opa" href="#">
                                            <div class="icon"></div>
                                            <p class="TX">プライバシーポリシー</p>
                                        </a>
                                    </li>
                                    <li class="lists-item">
                                        <a
                                            class="hover-opa"
                                            href="https://www.instagram.com/tsumugi7810/"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            <img src="img/insta-icon.svg" alt="Instagram" />
                                        </a>
                                        <a class="hover-opa" href="http://" target="_blank" rel="noopener noreferrer">
                                            <img src="img/line-icon.svg" alt="LINE" />
                                        </a>

                                        <a
                                            class="hover-opa sp"
                                            href="https://yoyaku.atlink.jp/tsumugiclinic/login?t=1762677858"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            <img src="img/nav-reserve-sp.webp" alt="ご予約はこちら♩" />
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>

            <main>
                <div class="FV"></div>

                <div class="page recruit-page">
                    <div class="recruit-inner">
                        <div class="recruit-content">
                            <div class="TL-box">
                                <h3 class="TL"><?php echo nl2br(SCF::get('details-01')); ?></h3>
                            </div>


                            <ul class="recruit-item">
                            <?php
                            $fulltime = SCF::get('full-time');
                            foreach ($fulltime as $fields) { ?>

                                <li>
                                    <div class="item-box label">
                                        <h4><?php echo $fields['full-time-label']; ?></h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX"><?php echo nl2br($fields['full-time-content']); ?></p>
                                    </div>
                                </li>
                                <?php }
                            ?>                            

                                <!-- <li>
                                    <div class="item-box label">
                                        <h4>給与</h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX">基本給　230,000円～250,000円<br>
                                        資格手当　30,000円～100,000円<br>
                                        夜勤手当・拘束手当・呼び出し手当・日曜・祝日手当（日勤のみ）<br>
                                        その他手当あり</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-box label">
                                        <h4>休日</h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX">・年間118日<br>
                                        　9日/月・夏季休暇・冬期休暇・誕生日<br class="sp"><span class="sp">　</span>休暇あり<br>
                                         ・有給休暇<br>
                                         　入職6カ月経過後より10日付与<br>
                                        　（翌年11日、翌々年12日、最大20日）</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-box label">
                                        <h4>退職金制度</h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX">なし</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-box label">
                                        <h4>賞与</h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX">実績なし<br>
                                            ・実績に応じて12月、7月の年2回支給予<br class="sp"><span class="sp">　</span>定</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-box label">
                                        <h4>試用期間</h4>
                                    </div>
                                    <div class="item-box textbox">
                                        <p class="TX">１か月</p>
                                    </div>
                                </li> -->
                            </ul> 


                        </div>

                        <?php
                        $details02 = SCF::get('details-02');
                        $parttime = SCF::get('part-time');

                        // どちらも空なら出力しない
                        if (!empty($details02) || !empty($parttime)): ?>
                            <div class="recruit-content">
                                
                                <?php if (!empty($details02)): ?>
                                    <div class="TL-box">
                                        <h3 class="TL"><?php echo nl2br($details02); ?></h3>
                                    </div>
                                <?php endif; ?>

                                <ul class="recruit-item">
                                <?php if (!empty($parttime)): ?>
                                    <?php foreach ($parttime as $fields): ?>
                                        <?php if (!empty($fields['part-time-label']) || !empty($fields['part-time-content'])): ?>
                                            
                                                <li>
                                                    <div class="item-box label">
                                                        <h4><?php echo esc_html($fields['part-time-label']); ?></h4>
                                                    </div>
                                                    <div class="item-box textbox">
                                                        <p class="TX"><?php echo nl2br(esc_html($fields['part-time-content'])); ?></p>
                                                    </div>
                                                </li>
                                            
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif;
                        ?>

                        <div class="recruit-link">
                            <p class="TX">
                                エントリーをご希望の方はお問い合わせフォームの<br>
                                「お問い合わせ内容」欄にご記入ください。
                            </p>
                            <a class="link hover-opa" href="<?php echo esc_url(home_url('/contact')); ?>">
                                <p class="link-TX">お問い合わせフォーム</p>
                            </a>
                        </div>
                        <div class="recruit-img"></div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <div class="info">
                            <div class="logo">
                                <img src="img/main-logo.svg" alt="つむぎクリニック" />
                            </div>
                            <div class="address">
                                <p class="TX">〒921-8832　<br class="sp" />石川県野々市市藤平田1丁目265番</p>
                                <a class="TX hover-opa" href="tel:0762487810"> TEL：076-248-7810 </a>
                            </div>
                            <div class="working">
                                <img
                                    src="img/footer-working.webp"
                                    alt="8:45~12:00 (月,火,水,木,金) /14:00~17:15 (月,火,水,金) / 8:45~16:00 (土)"
                                />
                            </div>
                        </div>
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6412.872861325604!2d136.605966!3d36.519464!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff835f212a938d1%3A0xf4058abc225b53a7!2z44CSOTIxLTg4MzIg55-z5bed55yM6YeO44CF5biC5biC6Jek5bmz55Sw77yR5LiB55uu77yS77yW77yV!5e0!3m2!1sja!2sjp!4v1762693649892!5m2!1sja!2sjp"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>
                    <nav class="footer-nav">
                        <div class="footer-nav-menu">
                            <ul class="lists">
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">TOPページ</p>
                                    </a>
                                    <ul>
                                        <li>
                                            <a class="hover-opa" href="#">
                                                <p class="TX">診療案内</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="hover-opa" href="#">
                                                <p class="TX">診療日程</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="hover-opa" href="#">
                                                <p class="TX">ご予約</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="hover-opa" href="#">
                                                <p class="TX">はじめての方</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="hover-opa" href="#">
                                                <p class="TX">アクセス</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="lists">
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">つむぎクリニックについて</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">入院案内</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">よくある質問</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">お知らせ</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="lists">
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">採用情報</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">お問い合わせ</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">プライバシーポリシー</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="#">
                                        <div class="icon"></div>
                                        <p class="TX">施設基準</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-nav-sns">
                            <ul>
                                <li>
                                    <a
                                        class="hover-opa"
                                        href="https://www.instagram.com/tsumugi7810/"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <img src="img/insta-icon.svg" alt="Instagram" />
                                    </a>
                                </li>
                                <li>
                                    <a class="hover-opa" href="http://" target="_blank" rel="noopener noreferrer">
                                        <img src="img/line-icon.svg" alt="LINE" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="footer-txt">
                        <p class="TX">© TSUMUGI CLINIC Co. Ltd. All Rights Reserved.</p>
                        <div class="img"></div>
                    </div>
                </div>
                <a class="top-back-btn hover-opa" href="#"></a>
            </footer>
        </div>

        <script
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous"
        ></script>
        <script src="js/script.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/joint.js"></script>
    </body>
    </html>
<?php get_footer();
?>
