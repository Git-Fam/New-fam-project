<?php
/*
Template Name: 入試情報
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-admission">

  <div class="p-admission-kv">
    <div class="p-admission-kv__inner">

      <div class="p-admission-kv-nav">
        <h1 class="p-admission-kv__title font-marumin-old"><span class="js-load-target a-fadeInUp">入試情報</span></h1>
        <p class="p-admission-kv__subtitle font-avenir-demibold pc-mgb-60 sp-mgb-0">Admissions Guide</p>

        <ul class="p-admission-kv-nav__list pc-mgb-44 sp-mgb-30">
          <li><a href="#" class="fade js-modal-openner" data-target="modal-newinfo">最新情報を受け取る</a></li>
          <li><a href="<?php echo home_url(); ?>/admission/open-class/" class="fade">公開授業・募集説明会</a></li>
          <li><a href="<?php echo home_url(); ?>/admission/school-information-session/" class="fade">体験イベント</a></li>
          <li><a href="<?php echo home_url(); ?>/admission/guide/" class="fade">入学試験・募集要項</a></li>
          <li><a href="#" class="fade js-modal-openner" data-target="modal-transfer">転入学のご案内</a></li>
          <li><a href="<?php echo home_url(); ?>/admission/koshien-family-scholarship/" class="fade">奨学金について</a></li>
        </ul>

        <div class="p-admission-kv-nav__btns">
          <div>
            <a href="<?php echo home_url(); ?>/contact/" class="c-btn c-btn--fill">
              <div class="c-btn__inner"><span>お問い合わせフォーム</span></div>
            </a>
          </div>
        </div>

      </div>
    </div>

    <div class="p-admission-kv__bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/admission_kv_sp.webp" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/admission_kv.webp" alt="" aria-hidden="true" class="u-w100">
      </picture>
    </div>

  </div>




  <div class="p-admission-content">

    <?php get_template_part('./inc/admission-sidebar'); ?>

    <main class="p-admission-content-main">
      <div class="p-admission-index">
        <ul class="p-admission-index__inner">
          <li>
            <a href="<?php echo home_url(); ?>/open-class/" class="p-admission-index__link fade">
              <img src="<?php echo get_template_directory_uri(); ?>/img/admission_menu_1.webp" alt="リンクイメージ" aria-hidden="true" loading="lazy" class="u-w100">
              <div class="p-admission-index__info">
                <span class="p-front-banner-info__top font-avenir-bold">Open Class</span>
                <span class="p-front-banner-info__bottom">公開授業・募集説明会</span>
              </div>
            </a>
          </li>

          <li>
            <a href="<?php echo home_url(); ?>/admission/school-information-session/" class="p-admission-index__link fade">
              <img src="<?php echo get_template_directory_uri(); ?>/img/admission_menu_2.webp" alt="リンクイメージ" aria-hidden="true" loading="lazy" class="u-w100">
              <div class="p-admission-index__info">
                <span class="p-front-banner-info__top font-avenir-bold">Experience Event</span>
                <span class="p-front-banner-info__bottom">体験イベント</span>
              </div>
            </a>
          </li>

          <?php /*
            <li>
              <a href="<?php echo home_url(); ?>/admission/guide/" class="p-admission-index__link fade">
                <img src="<?php echo get_template_directory_uri(); ?>/img/admission_menu_3.webp" alt="リンクイメージ" aria-hidden="true" loading="lazy" class="u-w100">
                <div class="p-admission-index__info"> 
                  <span class="p-front-banner-info__top font-avenir-bold">Admissions Guide</span>
                  <span class="p-front-banner-info__bottom">募集要項</span>
                </div>
              </a>
            </li>
            */ ?>

          <li>
            <a href="<?php echo home_url(); ?>/admission/guide/" class="p-admission-index__link fade">
              <img src="<?php echo get_template_directory_uri(); ?>/img/admission_menu_4.webp" alt="リンクイメージ" aria-hidden="true" loading="lazy" class="u-w100">
              <div class="p-admission-index__info">
                <span class="p-front-banner-info__top font-avenir-bold">Admissions</span>
                <span class="p-front-banner-info__bottom">入学試験・募集要項</span>
              </div>
            </a>
          </li>

          <li>
            <a href="<?php echo home_url(); ?>/admission/koshien-family-scholarship/" class="p-admission-index__link fade">
              <img src="<?php echo get_template_directory_uri(); ?>/img/admission_menu_5.webp" alt="リンクイメージ" aria-hidden="true" loading="lazy" class="u-w100">
              <div class="p-admission-index__info">
                <span class="p-front-banner-info__top font-avenir-bold">Koshien Family Scholarship</span>
                <span class="p-front-banner-info__bottom">奨学金制度</span>
              </div>
            </a>
          </li>

        </ul>
      </div>


      <?php get_template_part('./inc/footer'); ?>

    </main>
  </div>


</div>