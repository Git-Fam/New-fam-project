<header class="l-header" id="js-header">
  <div class="l-header__inner">
    <a href="<?php echo home_url('/'); ?>" class="l-header__logo">
      <img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.webp"
        alt="甲子園学院中学校・高等学校" class="l-header__logo-img">
    </a>
    <button class="l-header__toggle" id="js-drawer-toggle" type="button" aria-label="メニューを開く" aria-expanded="false">
      <span class="l-header__toggle-bar"></span>
      <span class="l-header__toggle-bar"></span>
      <span class="l-header__toggle-bar"></span>
    </button>
  </div>

  <div class="l-drawer" id="js-drawer">
    <div class="l-drawer__inner">

      <!-- 左：フォトメッセージ（装飾） -->
      <div class="l-drawer__photo">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/common/drawer_photo_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/drawer_photo_pc.webp" alt="" class="l-drawer__photo-img">
        </picture>
      </div>

      <!-- 中央：メインナビ -->
      <nav class="l-drawer__nav">
        <ul class="l-drawer__menu">
          <li class="l-drawer__item">
            <a href="<?php echo home_url('/about/'); ?>" class="l-drawer__link">学校案内</a>
            <ul class="l-drawer__sub">
              <li><a href="<?php echo home_url('/about/concept/'); ?>">ごあいさつ</a></li>
              <li><a href="<?php echo home_url('/about/history/'); ?>">建学の精神</a></li>
              <li><a href="<?php echo home_url('/about/history/#enkaku'); ?>">沿革</a></li>
              <li><a href="<?php echo home_url('/about/facility/'); ?>">設備・施設</a></li>
              <li><a href="<?php echo home_url('/about/facility/#access'); ?>">アクセス</a></li>
            </ul>
          </li>
          <li class="l-drawer__item">
            <a href="<?php echo home_url('/news/'); ?>" class="l-drawer__link">お知らせ</a>
          </li>
          <li class="l-drawer__item">
            <a href="<?php echo home_url('/about/uniform/'); ?>" class="l-drawer__link">制服紹介</a>
          </li>
          <li class="l-drawer__item">
            <a href="<?php echo home_url('/recruit/'); ?>" class="l-drawer__link">採用情報</a>
          </li>
          <li class="l-drawer__item">
            <a href="<?php echo home_url('/alumni/'); ?>" class="l-drawer__link">卒業生の方</a>
          </li>
        </ul>

        <div class="l-drawer__btns">
          <a href="<?php echo home_url('/contact/'); ?>" class="l-drawer__btn l-drawer__btn--contact">
            <span>お問い合わせフォーム</span>
            <span class="l-drawer__btn-icon" aria-hidden="true"></span>
          </a>
          <a href="<?php echo home_url('/request/'); ?>" class="l-drawer__btn l-drawer__btn--request">
            <span>資料請求</span>
            <span class="l-drawer__btn-icon" aria-hidden="true"></span>
          </a>
        </div>
      </nav>

    </div>
     <!-- 下段：中高バナー -->
      <div class="l-drawer__banners">
        <div class="l-drawer__banner l-drawer__banner--junior">
          <div class="l-drawer__banner-topimg">
            <a href="<?php echo home_url('/junior/'); ?>" class="l-drawer__banner-head">甲子園学院中学校TOP</a>
            <a href="<?php echo home_url('/junior/'); ?>" class="l-drawer__banner-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/banner_junior.webp" alt="DIVE IN LOVE!">
            </a>
          </div>
          <ul class="l-drawer__banner-links">
            <li><a href="<?php echo home_url('/junior/declaration/'); ?>">全校生徒の好きを応援する宣言</a></li>
            <li><a href="<?php echo home_url('/junior/life/'); ?>">学校生活</a></li>
            <li><a href="<?php echo home_url('/junior/feature/'); ?>">学びの特色</a></li>
            <li><a href="<?php echo home_url('/junior/club/'); ?>">クラブ活動</a></li>
            <li><a href="<?php echo home_url('/junior/admission/'); ?>">入試情報</a></li>
            <li><a href="<?php echo home_url('/junior/openschool/'); ?>">オープンスクール</a></li>
          </ul>
        </div>

        <div class="l-drawer__banner l-drawer__banner--high">
          <div class="l-drawer__banner-topimg">
            <a href="<?php echo home_url('/high/'); ?>" class="l-drawer__banner-head">甲子園学院高等学校TOP</a>
            <a href="<?php echo home_url('/high/'); ?>" class="l-drawer__banner-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/banner_high.webp" alt="FIND LOVE!">
            </a>
          </div>
          <ul class="l-drawer__banner-links">
            <li><a href="<?php echo home_url('/high/why/'); ?>">なんで好きが見つかるの？</a></li>
            <li><a href="<?php echo home_url('/high/life/'); ?>">学校生活</a></li>
            <li><a href="<?php echo home_url('/high/feature/'); ?>">学びの特色</a></li>
            <li><a href="<?php echo home_url('/high/course/'); ?>">コース紹介</a></li>
            <li><a href="<?php echo home_url('/high/club/'); ?>">クラブ活動</a></li>
            <li><a href="<?php echo home_url('/high/admission/'); ?>">入試情報</a></li>
            <li><a href="<?php echo home_url('/high/openschool/'); ?>">オープンスクール</a></li>
          </ul>
        </div>
      </div>
  </div>
</header>


<div class="whopper">
  <?php get_template_part('./inc/kv'); ?>