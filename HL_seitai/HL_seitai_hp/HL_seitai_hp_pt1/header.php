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
    <title>HL_seitai_hp_1</title>
    <meta name="title" content="株式会社Intence" />
    <meta name="description" content="コメント" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="株式会社Intence" />
    <meta property="og:description" content="コメント" />
    <meta property="og:image" content="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/meta.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="株式会社Intence" />
    <meta property="twitter:description" content="コメント" />
    <meta property="twitter:image" content="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/meta.png" />

    <!-- ▼ファビコン -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/intense/img/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    

    <!-- ▼テーマカラー -->
    <!-- <meta name="theme-color" content="#e9c931"> -->

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?<?php echo md5_file(get_stylesheet_directory() . '/style.css'); ?>">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;200;300;400;500;600;700;800;900&family=Noto+Serif+JP:wght@200;300;400;500;600;700;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                
    
    
    <?php wp_head(); ?>

</head>
<body>



<div class="wapper">

    <!-- 共通header -->
    <header class="C_header">
        <div class="burger sp"></div>
        <nav class="menu">
            <a href="<?php echo get_home_url(); ?>" class="header--logo"></a>
            <ul>
                <li><a href="<?php bloginfo('url'); ?>/about">中部治療院について</a></li>
                <li><a href="<?php bloginfo('url'); ?>/menu">メニュー・施術の流れ</a></li>
                <li><a href="<?php bloginfo('url'); ?>/staff">スタッフ</a></li>
                <li><a href="<?php bloginfo('url'); ?>/qa">よくある質問</a></li>
                <li><a href="<?php bloginfo('url'); ?>/voice">お客様の声</a></li>
                <li><a href="<?php bloginfo('url'); ?>/blog">ブログ</a></li>
                <li><a href="<?php bloginfo('url'); ?>/access">アクセス・院案内</a></li>
                <li><a href="<?php bloginfo('url'); ?>/contact">ご予約・お問い合わせ</a></li>
            </ul>
            <div class="header--communication">
            <div class="header--communication--tel">
                    <a href="tel:000000000" class="header--communication--tel--no"><span></span>052-203-0701</a>
                    <div class="header--communication--tel--text">
                        電話受付時間：（平日）10:00〜18:00 完全予約制<br>
                        （土・日・祝）10:00〜17:00 休業日：不定休<br>
                        ※施術中は電話に出られないこともございます
                    </div>
            </div>
            <div class="header--communication--mail">
                    <a href="<?php bloginfo('url'); ?>/contact" class="header--communication--mail--to"><span></span>MAIL</a>
            </div>
            </div>
        </nav>
    </header>



    <!-- トップページ -->
    <?php if (is_home()): ?>
        <!-- top__FV -->
        <div class="top__fv slick__fv">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top_fv-1.jpg" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top_fv-2.jpg" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top_fv-3.jpg" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top_fv-4.jpg" alt="">
        </div>

    <?php else: ?>
    <?php endif;?>


    <!-- flow -->
    <?php if(is_page('flow')):?>
        <!-- flow__FV -->
        <div class="flow__fv other__fv">
            <div class="page__title">
                <h2>FLOW</h2>
                <p>メニュー・施術の流れ</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- about -->
    <?php if(is_page('about')):?>
    <!-- about__FV -->
    <div class="about__fv other__fv">
        <div class="page__title">
            <h2>ABOUT</h2>
            <p>中部治療院について</p>
        </div>
    </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- menu -->
    <?php if(is_page('menu')):?>
        <!-- menu__FV -->
        <div class="menu__fv other__fv">
            <div class="page__title">
                <h2>MENU</h2>
                <p>メニュー・施術の流れ</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- staff -->
    <?php if(is_page('staff')):?>
        <!-- staff__FV -->
        <div class="staff__fv other__fv">
            <div class="page__title">
                <h2>STAFF</h2>
                <p>スタッフ</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- Q&A -->
    <?php if(is_page('qa')):?>
        <!-- QA__FV -->
        <div class="QA__fv other__fv">
            <div class="page__title">
                <h2>Q&A</h2>
                <p>よくある質問</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- voice -->
    <?php if(is_page('voice')):?>
        <!-- voice__FV -->
        <div class="voice__fv other__fv">
            <div class="page__title">
                <h2>VOICE</h2>
                <p>お客様の声 </p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 

    <!-- blog -->
    <?php if(is_archive()): ?>
        <!-- blog__FV -->
        <div class="blog__fv other__fv">
            <div class="page__title">
                <h2>BLOG</h2>
                <p>ブログ</p>
            </div>
        </div>
    <?php endif; ?> 

    <!-- blog -->
    <?php if(is_single()): ?>
        <!-- blog__FV -->
        <div class="blog__fv other__fv">
            <div class="page__title">
                <h2>BLOG</h2>
                <p>ブログ</p>
            </div>
        </div>
    <?php endif; ?> 


    <!-- access -->
    <?php if(is_page('access')):?>
        <!-- access__FV -->
        <div class="access__fv other__fv">
            <div class="page__title">
                <h2>ACCESS</h2>
                <p>アクセス・院案内</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- contact -->
    <?php if(is_page('contact')):?>
        <!-- contact__FV -->
        <div class="contact__fv other__fv">
            <div class="page__title">
                <h2>CONTACT</h2>
                <p>ご予約・お問い合わせ</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- confirmation -->
    <?php if(is_page('confirmation')):?>
        <!-- contact__FV -->
        <div class="contact__fv other__fv">
            <div class="page__title">
                <h2>CONTACT</h2>
                <p>確認</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 


    <!-- complete -->
    <?php if(is_page('complete')):?>
        <!-- contact__FV -->
        <div class="contact__fv other__fv">
            <div class="page__title">
                <h2>CONTACT</h2>
                <p>完了</p>
            </div>
        </div>
    <?php else: ?>
    <?php endif;?> 

