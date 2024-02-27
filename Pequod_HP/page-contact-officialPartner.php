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
    <link rel="”canonical”" href="”URL”" />
    <!-- ジェネレーターURL→ https://metatags.io/ -->

    <!-- ▼ファビコン -->
    <!-- ジェネレーターURL→ https://realfavicongenerator.net/ -->

    <!-- ▼クロールして欲しくない -->
    <!-- <meta name="robots" content="noindex,nofollow"> -->

    <!-- ▼テーマカラー -->
    <!-- <meta name="theme-color" content="#e9c931"> -->

    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

    <!-- ▼フォント -->
    <link href="https://fonts.cdnfonts.com/css/ntr" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Julius+Sans+One&family=Nanum+Myeongjo:wght@400;700;800&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
                
</head>
<body>

    <div class="wapper">
        <header></header>

        <div class="fv"></div>

        <!-- ページ名 -->
        <div class="contact">
            <div class="contact--inner">
                <div class="C_title">
                    <p>contact form</p>
                    <h2>お問合せフォーム</h2>
                </div>
                <div class="contact--inner--text">
                    <p>
                        ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ
                    </p>
                </div>
                <div class="form--wap">
                    <div class="contact--form">
                        <?php
                            echo do_shortcode('[contact-form-7 id="bbc0bce" title="contact-officialPartner"]');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer></footer>
    </div>

    <?php wp_footer() ?>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>