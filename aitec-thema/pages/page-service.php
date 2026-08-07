<?php
/*
Template Name: Growth Core
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="service-page">

<section class="service-page__hero">
    <div class="C_page-hero">
        <div class="C_page-hero-inner">
            <p class="C_page-hero-eyebrow loadDown">SERVICE</p>

            <div class="C_page-hero-content">
                <p class="C_page-hero-label loadDown">グロースコア</p>
                <h2 class="C_page-hero-title loadDown">Growth Core</h2>
                <p class="C_page-hero-lead loadDown">
                    グロースコアは、Zoom Phone 対応の次世代クラウド型コールシステムです。<br class="pc">
                    使いやすさ・高機能・低コストを兼ね備え、<br class="pc">
                    営業活動をより効率的で成果につながるものへ進化させます。
                </p>
            </div>
        </div>
    </div>
</section>

<section class="service-page__content">
    <div class="service-page__content-inr">

        <div class="service-page__content-item">
            <div class="service-page__content-item-text up">
                <p class="service-page__content-item-number">01</p>
                <h3 class="service-page__content-item-title">Zoom Phone 連携</h3>
                <p class="service-page__content-item-desc">
                    Zoom Phone とシームレスに連携し、<br>
                    スムーズな架電環境を実現。<br>
                    クラウドならではの柔軟な運用が可能です。
                </p>
            </div>

            <picture class="service-page__content-item-image right">
                <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-01-pc.webp">
                <img src="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-01-sp.webp" alt="">
            </picture>
        </div>

        <div class="service-page__content-item">
            <div class="service-page__content-item-text up">
                <p class="service-page__content-item-number">02</p>
                <h3 class="service-page__content-item-title">直感的な操作性</h3>
                <p class="service-page__content-item-desc">
                    誰でも迷わず使えるシンプルな UI 設計。<br>
                    営業担当者が本来の業務に集中できる環境を<br>
                    提供します。
                </p>
            </div>

            <picture class="service-page__content-item-image left">
                <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-02-pc.webp">
                <img src="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-02-sp.webp" alt="">
            </picture>
        </div>

        <div class="service-page__content-item">
            <div class="service-page__content-item-text up">
                <p class="service-page__content-item-number">03</p>
                <h3 class="service-page__content-item-title">リアルタイム管理</h3>
                <p class="service-page__content-item-desc">
                    架電状況や稼働状況をリアルタイムで可視化。<br>
                    マネジメントの効率化とチーム全体の成果<br>
                    向上を支援します。
                </p>
            </div>

            <picture class="service-page__content-item-image right">
                <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-03-pc.webp">
                <img src="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-03-sp.webp" alt="">
            </picture>
        </div>

        <div class="service-page__content-item">
            <div class="service-page__content-item-text up">
                <p class="service-page__content-item-number">04</p>
                <h3 class="service-page__content-item-title">継続的な<br class="sp">アップデート</h3>
                <p class="service-page__content-item-desc">
                    お客様の声をもとに機能改善を継続。<br>
                    常に進化し続ける営業支援プラットフォーム<br>
                    として価値を提供します。
                </p>
            </div>

            <picture class="service-page__content-item-image left">
                <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-04-pc.webp">
                <img src="<?php echo get_template_directory_uri(); ?>/img/service/service-page__content-item-04-sp.webp" alt="">
            </picture>
        </div>
    </div>
</section>

<section class="service-page__banner">
    <div class="C_contact-banner up">
        <div class="C_contact-banner-inner">
            <h2 class="C_contact-banner-title">営業 DX を、<br class="sp">もっとシンプルに。</h2>
            <p class="C_contact-banner-text">
                営業活動を変える第一歩は、<br class="sp">最適なシステム選びから。<br>
                グロースコアに関するご相談やデモのご依頼は、お気軽にお問い合わせください。
            </p>
            <a href="/contact" class="C_contact-banner-button hover-opa">
                <span class="C_contact-banner-button-text">お問い合わせはこちら</span>
                <span class="C_contact-banner-button-arrow">→</span>
            </a>
        </div>
    </div>
</section>
</div>

<?php get_template_part('./inc/footer'); ?>