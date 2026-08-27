<div class="header-menu-inr">
  <nav class="header-menu-nav">
    <ul class="main-list">
      <li class="main-list-item">
        <a class="TX" href="<?php echo home_url(); ?>">TOP</a>
      </li>
      <li class="main-list-item main-list-item-accordion <?php if (is_page('about')): ?>is-active<?php endif; ?>">
        <a class="TX" href="/about">当院について</a>
        <ul class="main-list-inr">
          <li class="main-list-item-inr">
            <a class="TX-inr" href="/about#about-kv-txt">見守りの森</a>
          </li>
          <li class="main-list-item-inr">
            <a class="TX-inr" href="/about#about-greeting">あいさつ</a>
          </li>
          <li class="main-list-item-inr">
            <a class="TX-inr" href="/about#about-features">当院の特徴</a>
          </li>
          <!-- <li class="main-list-item-inr">
            <a class="TX-inr" href="/about#about-introduction">院内紹介</a>
          </li> -->
        </ul>
      </li>
      <li class="main-list-item main-list-item-accordion <?php if (is_page('pediatric-surgery') || is_page('pediatrics') || is_page('constipation') || is_page('nocturia') || is_page('prevention-screening') || is_page('home-visit')): ?>is-active<?php endif; ?>">
        <a class="TX" href="<?php echo home_url(); ?>#front-services">診療案内</a>
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
          <!-- <li class="main-list-item-inr">
            <a class="TX-inr" href="#">頭のかたち外来</a>
          </li> -->
          <li class="main-list-item-inr">
            <a class="TX-inr" href="/prevention-screening">予防接種・検診</a>
          </li>
          <li class="main-list-item-inr">
            <a class="TX-inr" href="/home-visit">訪問診療</a>
          </li>
        </ul>
      </li>
      <li class="main-list-item">
        <a class="TX" href="/about-surgery">手術について</a>
      </li>
      <li class="main-list-item">
        <a class="TX" href="<?php echo home_url(); ?>#front-schedule">診療日程</a>
      </li>
      <li class="main-list-item">
        <a class="TX" href="<?php echo home_url(); ?>#front-access">アクセス</a>
      </li>
      <!-- <li class="main-list-item">
        <a class="TX" href="<?php echo home_url(); ?>#front-first">初めての方へ</a>
      </li> -->
      <!-- <li class="main-list-item">
        <a class="TX" href="<?php echo home_url(); ?>#front-payment">お支払いについて</a>
      </li> -->
      <li class="main-list-item">
        <a class="TX" href="/contact">お問い合わせ</a>
      </li>
    </ul>
    <ul class="sub-list">
      <li class="sub-list-item">
        <a class="TX" href="/news">お知らせ</a>
      </li>
      <!-- <li class="sub-list-item">
        <a class="TX" href="/recruit">採用情報</a>
      </li> -->
      <!-- <li class="sub-list-item">
        <a class="TX" href="/faq">よくある質問</a>
      </li> -->
      <li class="sub-list-item">
        <a class="TX" href="/privacy-policy">プライバシーポリシー</a>
      </li>
      <!-- <li class="sub-list-item pc-nav">
        <a class="IMG" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'instagram_url')); ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo get_template_directory_uri(); ?>/img/header/sub-list-item-sns-insta.svg" alt="Instagram">
        </a>
      </li> -->
    </ul>
  </nav>
  <div class="header-menu-icon">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/header/header-menu-icon-pc.svg" media="(min-width: 1051px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-menu-icon-sp.svg" alt="">
    </picture>
  </div>
</div>