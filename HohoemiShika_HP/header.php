<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="email=no,telephone=no,address=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta property="og:locale" content="ja_JP" />

    <!-- ▼SEO -->
    <link rel="”canonical”" href="<?php echo get_home_url(); ?>" />
    <title>ほほえみ歯科｜名古屋市名東区の歯医者</title>
    <meta name="title" content="タイトルタイトルタイトル" />
    <meta name="description" content="名古屋市名東区社台の「ほほえみ歯科」です。一般歯科・小児歯科・矯正歯科・口腔外科・審美歯科・インプラント・入れ歯などを診療します。通院が難しい方へ訪問診療も行っています。歯列矯正・インプラントは相談無料。東山線「上社」駅より徒歩10分。" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_home_url(); ?>" />
    <meta property="og:title" content="ほほえみ歯科｜名古屋市名東区の歯医者" />
    <meta property="og:description" content="名古屋市名東区社台の「ほほえみ歯科」です。一般歯科・小児歯科・矯正歯科・口腔外科・審美歯科・インプラント・入れ歯などを診療します。通院が難しい方へ訪問診療も行っています。歯列矯正・インプラントは相談無料。東山線「上社」駅より徒歩10分。" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/ima/meta.png" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo get_home_url(); ?>" />
    <meta property="twitter:title" content="ほほえみ歯科｜名古屋市名東区の歯医者" />
    <meta property="twitter:description" content="名古屋市名東区社台の「ほほえみ歯科」です。一般歯科・小児歯科・矯正歯科・口腔外科・審美歯科・インプラント・入れ歯などを診療します。通院が難しい方へ訪問診療も行っています。歯列矯正・インプラントは相談無料。東山線「上社」駅より徒歩10分。" />
    <meta property="twitter:image" content="<?php echo get_template_directory_uri(); ?>/ima/meta.png" />

    <!-- <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"> -->


    <!-- ▼CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

    <!-- ▼フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Contrail+One&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

</head>

<body>

    <div class="whopper">
        <!-- header -->
        <header class="header">
            <div class="burger"></div>
            <div class="menu">
                <div class="backText">
                    <p class="TX">
                        Hohoemi<br>
                        Dental<br>
                        Clinic
                    </p>
                </div>
                <nav class="nav">
                    <ul class="nav__main">
                        <li>
                            <a href="<?php echo get_home_url(); ?>">
                                <p>トップ</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/doctor">
                                <p>ドクター紹介</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/clinic">
                                <p>クリニック紹介</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/medicalexamination">
                                <p>受診される方へ</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/accessreceptiontime">
                                <p>受付時間/アクセス</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/blog">
                                <p>ブログ</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav__sub">
                        <li>
                            <a href="<?php bloginfo('url'); ?>/orthodontics">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>矯正歯科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/implant">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>インプラント</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/aestheticdentistry">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>審美歯科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/oralsurgery">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>口腔外科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/dentures">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>入れ歯</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/prevention">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>予防歯科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/general">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>一般歯科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/pediatricdentistry">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>小児歯科</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php bloginfo('url'); ?>/homevisit">
                                <div class="icon"></div>
                                <div class="cover">
                                    <p>訪問診療</p>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <a href="#footer" class="Tel_icon">
                    <div class="icon"></div>
                </a>
            </div>
            <div class="menu__back"></div>
        </header>

        <?php if (is_front_page()) : ?>

            <!-- KV__front -->
            <div class="KV__front">
                <div class="KV__front--text">
                    <div class="KV__front--text--top">
                        <h2 class="TL">
                            世界水準の<br>
                            インプラント治療<span class="pc">、</span><br class="sp">矯正治療が<br>
                            受けれる歯科医院です
                        </h2>
                    </div>
                    <div class="KV__front--text--middle">
                        <div class="KV__front--text--middle--heading">
                            <p class="TX">
                                自由診療に特化した歯科医院
                            </p>
                        </div>
                        <div class="KV__front--text--middle--container">
                            <div class="item loadRight speed-05 delay-05">
                                <p class="TX">
                                    負担の少ない<span>インプラント治療</span>
                                </p>
                            </div>
                            <div class="item loadRight speed-05 delay-06">
                                <p class="TX">
                                    <span>年間</span>100症例<span>以上の矯正治療</span>実績
                                </p>
                            </div>
                            <div class="item loadRight speed-05 delay-07">
                                <p class="TX space">
                                    難症例<span>でお困りの方も</span>お任せ<span>ください</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="KV__front--text--bottom">
                        <p class="TX">
                            インプラントが初めての方や、<br class="sp">他院で断られた方もお気軽にご相談ください
                        </p>
                    </div>
                </div>
                <div class="KV__front--title">
                    <h1 class="TL">
                        <span class="rollAnimeLoad">Hohoemi</span>
                        <span class="rollAnimeLoad">Dental</span>
                        <span class="rollAnimeLoad">Clinic</span>
                    </h1>
                </div>
                <div class="KV__front--smoke"></div>
            </div>

        <?php else : ?>

            <!-- KV -->
            <div class="KV">
                <div class="KV--img"></div>
                <div class="KV--tag loadRight speed-05 decay05">

                    <?php if (is_page('orthodontics')) : ?>
                        <!-- 矯正歯科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">矯正歯科</h2>
                            <p class="TX">−Orthodontics−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('implant')) : ?>
                        <!-- インプラント -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">インプラント</h2>
                            <p class="TX">−Implant−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('aestheticdentistry')) : ?>
                        <!-- 審美歯科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">審美歯科</h2>
                            <p class="TX">−Aesthetic Dentistry−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('oralsurgery')) : ?>
                        <!-- 口腔外科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">口腔外科</h2>
                            <p class="TX">−Oral Surgery−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('dentures')) : ?>
                        <!-- 入れ歯 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">入れ歯</h2>
                            <p class="TX">−Dentures−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('prevention')) : ?>
                        <!-- 予防歯科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">予防歯科</h2>
                            <p class="TX">−Prevention−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('general')) : ?>
                        <!-- 一般歯科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">一般歯科</h2>
                            <p class="TX">−General−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('pediatricdentistry')) : ?>
                        <!-- 小児歯科 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">小児歯科</h2>
                            <p class="TX">-Pediatric dentistry-</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('homevisit')) : ?>
                        <!-- 訪問診療 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">訪問診療</h2>
                            <p class="TX">−Home visit−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('doctor')) : ?>
                        <!-- ドクター紹介 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">ドクター紹介</h2>
                            <p class="TX">−Doctor−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('clinic')) : ?>
                        <!-- クリニック紹介 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">クリニック紹介</h2>
                            <p class="TX">−Clinic−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('medicalexamination')) : ?>
                        <!-- 受診される方へ -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">受診される方へ</h2>
                            <p class="TX">−Medical Examination−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_page('accessreceptiontime')) : ?>
                        <!-- アクセス/診療時間 -->
                        <div class="KV--tag--inner">
                            <h2 class="TL size">アクセス/診療時間</h2>
                            <p class="TX">−Access/Reception time−</p>
                        </div>
                    <?php endif; ?>

                    <?php if (is_post_type_archive('post') || is_singular('post')) : ?>
                        <!-- ブログ -->
                        <div class="KV--tag--inner">
                            <h2 class="TL">ブログ</h2>
                            <p class="TX">−Blog−</p>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="KV--title">
                    <h1 class="TL">
                        <span class="rollAnimeLoad">Hohoemi</span>
                        <span class="rollAnimeLoad">Dental</span>
                        <span class="rollAnimeLoad">Clinic</span>
                    </h1>
                </div>
                <?php if (is_page('doctor')) : ?>
                    <div class="KV--smoke smoke__black"></div>
                <?php else : ?>
                    <div class="KV--smoke"></div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <?php if (is_front_page()) : ?>
            <div class="C_TitleBack C_TitleBack--KV--front"></div>
        <?php endif; ?>

        <?php if (
            is_page('orthodontics') ||
            is_page('implant') ||
            is_page('aestheticdentistry') ||
            is_page('dentures') ||
            is_page('general') ||
            is_page('clinic')
        ) : ?>
            <div class="C_TitleBack C_TitleBack--KV"></div>
        <?php endif; ?>

        <!-- <?php if (is_page('doctor')) : ?>
            <div class="C_TitleBack  black__back">
                <div class="smoke__black"></div>
            </div>
        <?php endif; ?> -->