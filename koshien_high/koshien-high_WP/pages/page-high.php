<?php
/*
Template Name: 高等学校
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high">

  <section class="high-hiro">
    <div class="high-hiro-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-sp.webp" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-pc.webp" alt="">
      </picture>
    </div>
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-ttl-sp.svg" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-ttl-pc.svg" alt="あなたの好きを見つける高等学校 FIND LOVE!">
      </picture>
    </h2>
  </section>

  <div class="high-news_banner-wrap">
    <section class="high-news"></section>
    <section class="high-banner">
      <a class="high-banner-item hover-opa" href="#">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-01-pc.webp" alt="">
        </picture>
      </a>
      <a class="high-banner-item hover-opa" href="#">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-02-pc.webp" alt="">
        </picture>
      </a>
    </section>
  </div>

  <div class="high-news_banner-wrap high-banner-wrap">
    <div class="high-banner">
      <a class="high-banner-item hover-opa" href="#">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-03-pc.webp" alt="">
        </picture>
      </a>
      <a class="high-banner-item hover-opa" href="#">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-04-pc.webp" alt="">
        </picture>
      </a>
    </div>
  </div>

  <section class="high-change">
    <div class="ttl">
      <h2 class="TL">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-ttl-sp.svg" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-ttl-pc.svg" alt="LOVE CHANGE">
        </picture>
      </h2>
    </div>
    <div class="high-change-contents">
      <a href="#" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-pc.webp" alt="">
        </picture>
      </a>
      <a href="#" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-pc.webp" alt="">
        </picture>
      </a>
      <a href="#" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-pc.webp" alt="">
        </picture>
      </a>
    </div>
    <div class="high-change-pagination"></div>
  </section>

  <section class="high-info">
    <div class="high-info-inr">
      <a href="#" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-01-pc.webp" alt="">
        </picture>
      </a>
      <a href="#" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-02-pc.webp" alt="">
        </picture>
      </a>
      <a href="#" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-03-pc.webp" alt="">
        </picture>
      </a>
      <a href="#" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-04-pc.webp" alt="">
        </picture>
      </a>
    </div>
  </section>


</main>


<?php get_template_part('./inc/footer'); ?>