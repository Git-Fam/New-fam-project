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


    <!-- ▼クロールして欲しくない -->
    <!-- <meta name="robots" content="noindex,nofollow"> -->

    <!-- ▼テーマカラー -->
    <!-- <meta name="theme-color" content="#e9c931"> -->


    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&family=NTR&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=1.0.0" />

    <?php wp_head(); ?>

</head>

<body>

    <!-- header -->
    <header class="header">
        <a class="header__home" href="<?php echo get_home_url(); ?>">
            <h1 class="TL hover-blue">pequod</h1>
        </a>
        <div class="burger sp">
            <div class="burger--inner">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="header__nav">
            <ul>
                <li><a href="<?php bloginfo('url'); ?>/company">会社概要</a></li>
                <li><a href="<?php bloginfo('url'); ?>/topics">新着情報</a></li>
                <li><a href="<?php bloginfo('url'); ?>/service">事業内容</a></li>
                <li><a href="<?php bloginfo('url'); ?>/official-partner">代理店</a></li>
                <li><a href="<?php bloginfo('url'); ?>/recruit">採用</a></li>
                <li><a href="<?php bloginfo('url'); ?>/contact">お問い合わせ</a></li>
            </ul>
        </nav>
    </header>
    <?php if (is_front_page()) : ?>
        <!-- KV/front -->
        <section class="KV KV_front">
            <div class="img img-front loadSunnyFront delay-05 duration-10"></div>
            <div class="title__fixed">
                <h2 class="TL"><span>今</span>ここにない<span>未来</span>は<br class="sp">自分で<span>創</span>る</h2>
            </div>
            <div class="KV--title--front title-anime loadFlash duration-03">
                <h2 class="TL text-split">I WILL CREATE</h2>
                <h2 class="TL text-split pc">A FUTURE THAT CANNOT</h2>
                <h2 class="TL text-split sp">A FUTURE</h2>
                <h2 class="TL text-split sp">THAT CANNOT</h2>
                <h2 class="TL text-split">BE REALIZED NOW.</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_post_type_archive('post') || is_singular('post')) : ?>
        <!-- KV/topics -->
        <section class="KV">
            <div class="img img-topics loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime loadFlash duration-03">
                <h2 class="TL text-split">TOPICS</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_page('service')) : ?>
        <!-- KV/service -->
        <section class="KV">
            <div class="img img-service loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime loadFlash duration-03">
                <h2 class="TL text-split">SERVICE</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_page('company')) : ?>
        <!-- KV/company -->
        <section class="KV">
            <div class="img img-company loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime loadFlash duration-03">
                <h2 class="TL text-split">COMPANY</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_page('official-partner')) : ?>
        <!-- KV/official-partner -->
        <section class="KV">
            <div class="img img-officialPartner loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime KV--title title-anime--officialPartner loadFlash duration-03">
                <h2 class="TL text-split pc">OFFICIAL　PARTNER</h2>
                <h2 class="TL text-split sp">OFFICIAL</h2>
                <h2 class="TL text-split sp">PARTNER</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_page('recruit') || is_page('interview')) : ?>
        <!-- KV/recruit/interview -->
        <section class="KV">
            <div class="img img-recruit loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime loadFlash duration-03">
                <h2 class="TL text-split">RECRUIT</h2>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_page('contact') || is_page('contact-confirm') || is_page('contact-entry-confirm') || is_page('contact-complete')) : ?>
        <!-- KV/contact -->
        <section class="KV">
            <div class="img img-contact loadSunny delay-03 duration-13"></div>
            <div class="KV--title title-anime loadFlash duration-03">
                <h2 class="TL text-split">CONTACT</h2>
            </div>
        </section>
    <?php endif; ?>
    <div class="whopper">
        <main>