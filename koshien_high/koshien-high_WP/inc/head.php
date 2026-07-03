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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css?ver=1.0.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=1.0.0">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Zen+Kaku+Gothic+New:wght@400;500;700;900&display=swap">
    <link rel="stylesheet" href="https://use.typekit.net/fwx3tcv.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://use.typekit.net/gde0eoy.css" rel="stylesheet">
    <script type="text/javascript" src="//webfonts.xserver.jp/js/xserver.js"></script>

    <!-- ▼Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>