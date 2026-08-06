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
    <!-- <link rel="canonical" href="<?php echo get_home_url(); ?>" />
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
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.wenp" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="<?php
                                            bloginfo('name');
                                            if (wp_title('', false)) {
                                                echo ' | ' . wp_title('', false);
                                            }
                                            ?>" />
    <meta property="twitter:description" content="<?php bloginfo('description'); ?>" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/meta.jpg" /> -->

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css?ver=1.0.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=1.0.0">


    <!-- ▼フォント -->

    <?php wp_head(); ?>


</head>

<body>