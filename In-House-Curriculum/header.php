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
    <!-- <title>株式会社Intence</title>
    <meta name="title" content="株式会社Intence" />
    <meta name="description" content="株式会社Intenceは人材サービス業を中心に、セールスコンサルティング・キャリアラボ事業・Tech事業に従事しています。人々が笑顔で満足のいく形で仕事や社会と関われる、そんな企業を目指しています。" /> -->

    <!-- Open Graph / Facebook -->
    <!-- <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="株式会社Intence" />
    <meta property="og:description" content="株式会社Intenceは人材サービス業を中心に、セールスコンサルティング・キャリアラボ事業・Tech事業に従事しています。人々が笑顔で満足のいく形で仕事や社会と関われる、そんな企業を目指しています。" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.png" /> -->

    <!-- Twitter -->
    <!-- <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="株式会社Intence" />
    <meta property="twitter:description" content="株式会社Intenceは人材サービス業を中心に、セールスコンサルティング・キャリアラボ事業・Tech事業に従事しています。人々が笑顔で満足のいく形で仕事や社会と関われる、そんな企業を目指しています。" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.png" /> -->

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
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1:wght@100..900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

</head>
<body>
 
    
    <?php if (is_home()) : ?>
        <div class="a">
    <?php else : ?>
        <div class="wappaer">
    <?php endif; ?>