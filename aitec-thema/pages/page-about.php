<?php
/*
Template Name: 会社概要
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="about-page">

<section class="about-page__hero">
    <div class="C_page-hero">
        <div class="C_page-hero-inner">
            <p class="C_page-hero-eyebrow">ABOUT</p>

            <div class="C_page-hero-content">
                <p class="C_page-hero-label">ABOUT</p>
                <h2 class="C_page-hero-title">会社概要</h2>
                <p class="C_page-hero-lead">
                    株式会社アイテックの<br class="sp">会社概要をご紹介します
                </p>
            </div>
        </div>
    </div>
</section>

<section class="about-page__content">
    <div class="about-page__content-inr">

        <div class="about-page__content-info">
            <dl class="about-page__info-list">
                <div class="about-page__info-row">
                    <dt class="about-page__info-label">会社名</dt>
                    <dd class="about-page__info-value">株式会社アイテック</dd>
                </div>
                <div class="about-page__info-row">
                    <dt class="about-page__info-label">代表取締役</dt>
                    <dd class="about-page__info-value">星 文裕</dd>
                </div>
                <div class="about-page__info-row">
                    <dt class="about-page__info-label">所在地</dt>
                    <dd class="about-page__info-value">〒060-0032<br> 北海道札幌市中央区北2条東<br class="sp">1丁目2-5</dd>
                </div>
                <div class="about-page__info-row">
                    <dt class="about-page__info-label">設立</dt>
                    <dd class="about-page__info-value">令和2年9月9日</dd>
                </div>
                <div class="about-page__info-row">
                    <dt class="about-page__info-label">事業内容</dt>
                    <dd class="about-page__info-value">
                        営業支援システムの企画・開発・販売<br>
                        クラウドサービス（SaaS）の提供<br>
                        コールシステムの開発・販売<br>
                        AI ソリューションの企画・開発<br>
                        DX コンサルティング事業
                    </dd>
                </div>
            </dl>
        </div>

        <div class="about-page__content-img">
            <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about-img-pc.webp" media="(min-width: 768px)">
                <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-img-sp.webp" alt="">
            </picture>
        </div>
    </div>
</section>

<section class="about-page__philosophy" id="philosophy">
    <div class="about-page__philosophy-inr">
        <p class="about-page__philosophy-label">Philosophy</p>
        <h2 class="about-page__philosophy-title">企業理念</h2>
        <p class="about-page__philosophy-sub">Technology for Growth</p>
        <p class="about-page__philosophy-text">
            私たちは、テクノロジーの力で企業の成長を支え、<br class="pc">
            営業の可能性を広げる存在であり続けます。<br>
            現場の課題に真摯に向き合い、使いやすさと成果を追求したサービスを提供することで、<br class="pc">
            お客様とともに成長し続ける企業を目指します。<br>
            挑戦を恐れず、革新を続け、新しい価値を創造すること。<br>
            それが株式会社アイテックの使命です。
        </p>
    </div>
</section>


</div>

<?php get_template_part('./inc/footer'); ?>