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
      <div class="header-menu">
        <div class="header-menu-inr">
          <nav class="header-menu-nav">
            <ul class="main-list">
              <li class="main-list-item">
                <a class="TX" href="<?php echo home_url(); ?>">TOP</a>
              </li>
              <li class="main-list-item main-list-item-accordion">
                <p class="TX">当院について</p>
                <ul class="main-list-inr">
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/about">見守りの森</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/about#about-greeting">あいさつ</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/about#about-features">当院の特徴</a>
                  </li>
                </ul>
              </li>
              <li class="main-list-item">
                <a class="TX" href="/about-surgery">手術について</a>
              </li>
              <li class="main-list-item">
                <a class="TX" href="<?php echo home_url(); ?>#front-schedule">診療日程</a>
              </li>
              <li class="main-list-item main-list-item-accordion">
                <p class="TX">診療案内</p>
                <ul class="main-list-inr">
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/pediatric-surgery">小児外科</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/pediatrics">小児科</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/constipation">便秘外来</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/nocturia">夜尿外来</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/prevention-screening">予防接種・検診</a>
                  </li>
                  <li class="main-list-item-inr">
                    <a class="TX-inr" href="/home-visit">訪問診療</a>
                  </li>
                </ul>
              </li>
              <li class="main-list-item">
                <a class="TX" href="<?php echo home_url(); ?>#front-first">初めての方へ</a>
              </li>
              <li class="main-list-item">
                <a class="TX" href="<?php echo home_url(); ?>#front-payment">お支払いについて</a>
              </li>
              <li class="main-list-item">
                <a class="TX" href="<?php echo home_url(); ?>#front-access">アクセス</a>
              </li>
              <!-- <li class="main-list-item">
                <a class="TX" href="#">サポート・取り組み</a>
              </li> -->
              <li class="main-list-item">
                <a class="TX" href="/contact">お問い合わせ</a>
              </li>
            </ul>
            <ul class="sub-list">
              <li class="sub-list-item">
                <a class="TX" href="/news">お知らせ</a>
              </li>
              <li class="sub-list-item">
                <a class="TX" href="/recruit">採用情報</a>
              </li>
              <li class="sub-list-item">
                <a class="TX" href="/faq">よくある質問</a>
              </li>
              <li class="sub-list-item">
                <a class="TX" href="/privacy-policy">プライバシーポリシー</a>
              </li>
              <li class="sub-list-item sp">
                <a class="IMG" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'instagram_url')); ?>" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/sub-list-item-sns-insta.svg" alt="Instagram">
                </a>
              </li>
            </ul>
          </nav>
          <div class="header-menu-icon">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/header/header-menu-icon-pc.svg" media="(min-width: 951px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-menu-icon-sp.svg" alt="">
            </picture>
          </div>
        </div>
      </div>
    </header>

    <div class="reserve-btn front-hidden <?php if (is_front_page()): ?>is-hidden<?php endif; ?>">
      <a class="reserve-btn-inr" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'web_reserve')); ?>" target="_blank" rel="noopener noreferrer">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/common/reserve-btn-pc.webp" media="(min-width: 951px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/reserve-btn-sp.webp" alt="ご予約はこちらから">
        </picture>
      </a>
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