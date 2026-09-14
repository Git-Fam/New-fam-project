<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ▼TELL&MAIL&ADDRESSの自動リンク機能を制御 -->
    <meta name="format-detection" content="email=no,telephone=no,address=no" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta property="og:locale" content="ja_JP" />

  

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


    <!-- ▼slick（高等学校ページのみ） -->
   <?php if (is_page('high') || is_page('junior') || is_page_template('pages/page-junior-students.php') || is_page_template('pages/page-high-changed.php')) : ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <?php endif; ?>

    <!-- ▼slick（TOPページのみ・NEWSスライダー用） -->
    <?php if (is_front_page()) : ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <?php endif; ?>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>