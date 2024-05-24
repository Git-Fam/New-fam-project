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
    <link rel="”canonical”" href="<?php echo get_home_url(); ?>" />
    <!-- Primary Meta Tags -->
    <!-- <title>タイトルタイトルタイトル</title>
    <meta name="title" content="タイトルタイトルタイトル" />
    <meta name="description" content="テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト" /> -->

    <!-- Open Graph / Facebook -->
    <!-- <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="タイトルタイトルタイトル" />
    <meta property="og:description" content="テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" /> -->

    <!-- Twitter -->
    <!-- <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="タイトルタイトルタイトル" />
    <meta property="twitter:description" content="テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" /> -->

    <!-- ▼ファビコン -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"> -->

    <!-- ▼テーマカラー -->
    <!-- <meta name="theme-color" content="#e9c931"> -->

    <!-- ▼CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Zen+Old+Mincho:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

</head>
<body>

    <div class="whopper">

        <!-- FV -->
        <?php if (is_home() || is_front_page()): ?>
            <div class="C_FV">
                <div class="top_TL bgextend bgLRextendTrigger">
                    <p class="top_TL_TX bgappear bgappearTrigger">新しい暮らしをつくる</p>
                </div>
                <h1 class="TL">
                    <span class="randomAnime">DAIWA</span><br>
                    <span class="randomAnime">HOUSING</span>
                </h1>
                <p class="under_TX">
                    Reforme<br class="sp">&<br class="sp">Renovation
                </p>
            </div>
        

        <?php elseif (is_page('service')): ?>
            <div class="C_FVSub">
                <div class="C_FVSub--inner img--service"></div>
                <div class="C_FVSub--title">
                    <h1 class="TL">
                        <span class="randomAnime">SERVICE</span>
                    </h1>
                </div>
            </div>

        <?php elseif (is_post_type_archive('post')): ?>
            <div class="C_FVSub">
                <div class="C_FVSub--inner img--works"></div>
                <div class="C_FVSub--title">
                    <h1 class="TL">
                        <span class="randomAnime">WORKS</span>
                    </h1>
                </div>
            </div>

        <?php elseif (is_page('contact') || is_page('contact-confirm') || is_page('contact-complate') ) : ?>
            <div class="C_FVSub">
                <div class="C_FVSub--inner img--contact"></div>
                <div class="C_FVSub--title">
                    <h1 class="TL">
                        <span class="randomAnime">CONTACT</span>
                    </h1>
                </div>
            </div>
        <?php endif; ?>

            
        <!-- header -->
        <?php if (is_home() || is_front_page()): ?>

            <header class="header header--front">


        <?php elseif (is_page('service') || is_post_type_archive('post')) : ?>

            <header class="header header--another">
                

        <?php elseif (is_page('contact') || is_page('contact-confirm') || is_page('contact-complate') ) : ?>

            <header class="header sp">

        <?php endif; ?>


                <div class="C_nav">
                    <div class="C_nav--inner">
                        <div class="C_nav--title sp">
                            <p class="TX">
                                DAIWA<br>HOUSING
                            </p>
                        </div>

                        <ul class="C_nav--list">
                            <li>
                                <a href="<?php echo get_home_url(); ?>">
                                    <div class="icon icon--1"></div>
                                    <p class="TX EN">HOME</p>
                                    <p class="TX JP">ホーム</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php bloginfo('url'); ?>/service">
                                    <div class="icon icon--2"></div>
                                    <p class="TX EN">SERVICE</p>
                                    <p class="TX JP">事業内容</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php bloginfo('url'); ?>/works">
                                    <div class="icon icon--3"></div>
                                    <p class="TX EN">WORKS</p>
                                    <p class="TX JP">実績紹介</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php bloginfo('url'); ?>/contact">
                                    <div class="icon icon--4"></div>
                                    <p class="TX EN">CONTACT</p>
                                    <p class="TX JP">お問い合わせ</p>
                                </a>
                            </li>
                        </ul>

                        <div class="C_nav--close sp">
                            <p class="TX">close</p>
                        </div>
                    </div>
                </div>
                <div class="burger sp">
                    <span></span>
                    <span></span>
                </div>
            </header>

<div class="main">
