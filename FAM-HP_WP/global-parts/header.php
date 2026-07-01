<!DOCTYPE html>
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
    <title><?php bloginfo('name'); ?><?php if (wp_title('', false)) {
                                            echo ' | ' . wp_title('', false);
                                        } ?></title>
    <meta name="title" content="<?php bloginfo('name'); ?><?php if (wp_title('', false)) {
                                                                echo ' | ' . wp_title('', false);
                                                            } ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="<?php bloginfo('name'); ?><?php if (wp_title('', false)) {
                                                                        echo ' | ' . wp_title('', false);
                                                                    } ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="<?php bloginfo('name'); ?><?php if (wp_title('', false)) {
                                                                            echo ' | ' . wp_title('', false);
                                                                        } ?>" />
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" />

    <!-- ▼ファビコン -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"> -->


    <!-- ▼クロールして欲しくない -->
    <!-- <meta name="robots" content="noindex,nofollow"> -->

    <!-- ▼テーマカラー -->
    <!-- <meta name="theme-color" content="#e9c931"> -->

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>

</head>

<body>



        <header class="header header--dark">
            <div class="header__inner">
                <a href="<?php echo get_home_url(); ?>" class="header__logo">
                    <img class="header__logo-img" 
                        src="<?php echo get_template_directory_uri(); ?>/img/global/fam_tosyo_logo_w.png" 
                        alt="FAM">
                </a>

                <!-- PC nav -->
                <nav class="header__nav">
                    <div class="header__nav-item-wrap" data-menu="company">
                        <a href="<?php echo get_home_url(); ?>/company" class="header__nav-item">COMPANY</a>
                    </div>
                    <div class="header__nav-item-wrap" data-menu="business">
                        <a href="<?php echo get_home_url(); ?>/business" class="header__nav-item">BUSINESS</a>
                    </div>
                    <div class="header__nav-item-wrap" data-menu="careers">
                        <a href="<?php echo get_home_url(); ?>/careers" class="header__nav-item">CAREERS</a>
                    </div>
                    <div class="header__nav-item-wrap" data-menu="contact">
                        <a href="<?php echo get_home_url(); ?>/contact" class="header__nav-item">CONTACT</a>
                    </div>
                </nav>

                <!-- SP ハンバーガーボタン -->
                <button class="header__hamburger" id="js-hamburger" aria-label="メニュー">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- SP ドロワーメニュー -->
            <div class="header__drawer" id="js-drawer">
                <nav class="header__drawer-nav">
                    <a href="<?php echo get_home_url(); ?>" class="header__drawer-item">
                        <span class="header__drawer-num">00</span>TOP
                    </a>
                    <a href="<?php echo get_home_url(); ?>/company" class="header__drawer-item">
                        <span class="header__drawer-num">01</span>COMPANY
                    </a>
                    <a href="<?php echo get_home_url(); ?>/business" class="header__drawer-item">
                        <span class="header__drawer-num">02</span>BUSINESS
                    </a>
                    <a href="<?php echo get_home_url(); ?>/careers" class="header__drawer-item">
                        <span class="header__drawer-num">03</span>CAREERS
                    </a>
                    <a href="<?php echo get_home_url(); ?>/contact" class="header__drawer-item">
                        <span class="header__drawer-num">04</span>CONTACT
                    </a>
                </nav>
            </div>
        </header>

        <!-- メガメニューオーバーレイ -->
            <div class="header__overlay" id="js-mega-overlay"></div>
        <!-- ホバーメガメニュー -->
                <div class="header__mega" id="js-mega">
                    <a href="<?php echo get_home_url(); ?>/company" class="header__mega-panel" data-panel="company">
                    <div class="header__mega-left">
                        <p class="header__mega-en js-text-reveal"><span>COMPANY</span></p>
                        <p class="header__mega-ja">会社概要</p>
                    </div>
                    <div class="header__mega-right header__mega-right--company left">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/global/menu-company.png" alt="COMPANY">
                    </div>
                </a>
                <a href="<?php echo get_home_url(); ?>/business" class="header__mega-panel" data-panel="business">
                    <div class="header__mega-left">
                        <p class="header__mega-en js-text-reveal"><span>BUSINESS</span></p>
                        <p class="header__mega-ja">事業内容</p>
                    </div>
                    <div class="header__mega-right  header__mega-right--business left">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/global/menu-business.png" alt="BUSINESS">
                    </div>
                </a>
                <a href="<?php echo get_home_url(); ?>/careers" class="header__mega-panel" data-panel="careers">
                    <div class="header__mega-left">
                        <p class="header__mega-en js-text-reveal"><span>CAREERS</span></p>
                        <p class="header__mega-ja">採用情報</p>
                    </div>
                    <div class="header__mega-right header__mega-right--careers left">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/global/menu-careers.png" alt="CAREERS">
                    </div>
                </a>
                <a href="<?php echo get_home_url(); ?>/contact" class="header__mega-panel" data-panel="contact">
                    <div class="header__mega-left">
                        <p class="header__mega-en js-text-reveal"><span>CONTACT</span></p>
                        <p class="header__mega-ja">お問い合わせ</p>
                        <br>
                        <br>
                        <p class="header__mega-ja">ご依頼・ご相談などのお問い合わせはこちら。お気軽にお問い合わせください。</p>
                    </div>
                    <div class="header__mega-right">
                        
                    </div>
                </a>

                    <!-- CONTACT帯 -->
                <a href="<?php echo get_home_url(); ?>/contact" class="header__mega-contact">
                    <div class="header__mega-contact-left">
                        <span class="header__mega-contact-en">CONTACT</span>
                        <span class="header__mega-contact-ja">お問い合わせ</span>
                    </div>
                    <div class="header__mega-contact-marquee">
                        <div class="header__mega-contact-track">
                            <span>ご依頼・ご相談などのお問い合わせはこちら。お気軽にお問い合わせください。</span>
                            <span>ご依頼・ご相談などのお問い合わせはこちら。お気軽にお問い合わせください。</span>
                            <span>ご依頼・ご相談などのお問い合わせはこちら。お気軽にお問い合わせください。</span>
                        </div>
                    </div>
                   <div class="header__mega-contact-btn">
                        <!-- メールアイコン（通常時） -->
                        <svg class="icon-mail" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                            <path d="M20 4H4C2.9 4 2 4.9 2 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="white"/>
                        </svg>
                        <!-- 紙飛行機アイコン（ホバー時） -->
                        <svg class="icon-plane" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" fill="white"/>
                        </svg>
                    </div>
                </a>
                </div>

