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
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1:wght@100..900&display=swap" rel="stylesheet">
    <script>
        (function(d) {
            var config = {
                    kitId: 'wxg1png',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement,
                t = setTimeout(function() {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout),
                tk = d.createElement("script"),
                f = false,
                s = d.getElementsByTagName("script")[0],
                a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function() {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded") return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {}
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>
    <script>
        (function(d) {
            var config = {
                    kitId: 'wxg1png',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement,
                t = setTimeout(function() {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout),
                tk = d.createElement("script"),
                f = false,
                s = d.getElementsByTagName("script")[0],
                a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function() {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded") return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {}
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>

    <?php wp_head(); ?>

</head>

<body>

    <?php if (is_user_logged_in()) : ?>
        <?php
        $recent_news_query = new WP_Query(array(
            'post_type' => 'news',
            'posts_per_page' => 1,
            'date_query' => array(
                array(
                    'after' => '7 days ago'
                )
            )
        ));
        $has_recent_news = $recent_news_query->have_posts() ? 'true' : 'false';
        wp_reset_postdata();
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var today = new Date().toISOString().slice(0, 10);
                var lastAlertDate = localStorage.getItem('newsAlertDate');

                if (window.hasRecentNews && lastAlertDate !== today) {
                    alert('新着のお知らせがあります！');
                    localStorage.setItem('newsAlertDate', today);
                }
            });
            window.hasRecentNews = <?php echo $has_recent_news; ?>;
        </script>
    <?php endif; ?>


    <?php if (is_home()) : ?>
        <div class="a">
        <?php elseif (is_page('user-control')) : ?>
            <div class="user-control">
            <?php else : ?>
                <div class="wappaer">
                <?php endif; ?>