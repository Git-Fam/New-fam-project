<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.webp" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="<?php
                                            bloginfo('name');
                                            if (wp_title('', false)) {
                                                echo ' | ' . wp_title('', false);
                                            }
                                            ?>" />
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.webp" />

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css?ver=1.0.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=1.0.0">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="//webfonts.xserver.jp/js/xserver.js"></script>

    <script>
        if (sessionStorage.getItem('loading_shown')) {
            document.documentElement.classList.add('loading-done');
        }
    </script>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>