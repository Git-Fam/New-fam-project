<?php
/*
Template Name: 卒業生・進学実績
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-results">
    <div class="p-results__inner">


        <div class="p-results-mv">
            <div class="p-results-mv__inner">
                <div class="p-results-mv__textbox">
                    <h1 class="p-results-mv__title font-marumin-old"><span class="js-load-target a-fadeInUp">
                            未来と<br>
                            つながる
                        </span></h1>
                    <p class="p-results-mv__text font-marumin-old"><span class="js-load-target a-fadeInUp">
                            進学実績・卒業生紹介
                        </span></p>
                </div>
            </div>
        </div>

        <section class="p-results-ranking">
            <div class="p-results-ranking__inner">
                <div class="p-results-ranking__titlebox js-scroll-target a-fadeInUp">
                    <p class="p-results-ranking__title-top font-marumin-old">
                        過去5年間の主な中学校合格者数
                    </p>
                    <h2 class="p-results-ranking__title font-marumin-old">
                        西日本難関中学校<br class="sp">合格率ランキング
                    </h2>
                </div>

                <ul class="p-results-ranking__list">
                    <li class="p-results-ranking__item js-scroll-target a-fadeInUp">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/results_ranking_1.webp" alt="1位 2018・2019年度" loading="lazy" class="u-w100">
                    </li>
                    <li class="p-results-ranking__item js-scroll-target a-fadeInUp">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/results_ranking_2.webp" alt="2位 2020・2021年度" loading="lazy" class="u-w100">
                    </li>
                </ul>

                <?php $ranking_schools = koshien_results_get_ranking_schools(); ?>
                <ul class="p-results-ranking__bottom js-scroll-target a-fadeInUp">
                    <?php foreach ($ranking_schools as $school) : ?>
                        <li class="p-results-ranking__bottom-item">
                            <p class="name"><?php echo esc_html($school['name']); ?></p>
                            <span class="gap" aria-hidden="true"></span>
                            <div class="line"></div>
                            <p class="num"><?php echo esc_html($school['num']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

    </div>

    <section class="p-results-alumni">

        <h3 class="p-results-alumni__title font-marumin-old js-scroll-target a-fadeInUp">
            心と心がつながった<br class="sp">OB・OG紹介
        </h3>

        <div class="p-results-alumni__slide js-scroll-target a-fadeInUp">
            <div class="p-results-alumni-auto-slide">
                <div class="p-results-alumni-auto-slide__track">
                    <div class="p-results-alumni-auto-slide__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ogob_heart1_pc.webp" alt="" loading="lazy">
                    </div>
                    <!-- duplicate for seamless loop -->
                    <div class="p-results-alumni-auto-slide__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ogob_heart1_pc.webp" alt="" loading="lazy">
                    </div>
                </div>
            </div>

            <div class="p-results-alumni-auto-slide p-results-alumni-auto-slide--reverse js-scroll-target a-fadeInUp">
                <div class="p-results-alumni-auto-slide__track">
                    <div class="p-results-alumni-auto-slide__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ogob_heart2_pc.webp" alt="" loading="lazy">
                    </div>
                    <!-- duplicate for seamless loop -->
                    <div class="p-results-alumni-auto-slide__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ogob_heart2_pc.webp" alt="" loading="lazy">
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>

<?php get_template_part('./inc/footer'); ?>