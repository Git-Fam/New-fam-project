    <!-- frontのみ is-hidden -->
    <header class="header front-hidden  <?php if (is_front_page()): ?>is-hidden<?php endif; ?>">
      <div class="header-inr">
        <h1 class="header-logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-logo.svg" alt="つばさこども医院 小児外科/小児科">
          </a>
        </h1>
      </div>
      <div class="header-btn">
        <img class="open" src="<?php echo get_template_directory_uri(); ?>/img/header/header-btn-open.svg" alt="opne">
        <img class="close" src="<?php echo get_template_directory_uri(); ?>/img/header/header-btn-close.svg" alt="close">
      </div>
      <div class="header-menu pc-nav">
        <?php get_template_part('inc/header-menu-inr'); ?>
      </div>
    </header>

    <div class="reserve-btn front-hidden <?php if (is_front_page()): ?>is-hidden<?php endif; ?>">
      <!-- <a class="reserve-btn-inr" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'web_reserve')); ?>" target="_blank" rel="noopener noreferrer">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/common/reserve-btn-pc.webp" media="(min-width: 951px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/reserve-btn-sp.webp" alt="ご予約はこちらから">
        </picture>
      </a> -->
      <?php if (is_front_page()): ?>
        <a class="tel-btn" href="tel:076-282-7272">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/tel-btn.webp" alt="076-282-7272">
        </a>
      <?php endif; ?>
    </div>

    <div class="whopper">

      <?php get_template_part('inc/side-l'); ?>

      <div class="screen">
        <main class="main">
          <!-- 共有 これ以上  -->