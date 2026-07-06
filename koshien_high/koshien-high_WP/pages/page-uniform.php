<?php
/*
Template Name: 制服紹介
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--uniform">

  <section class="p-uniform" id="js-uniform">
    <div class="p-uniform__sticky">

      <!-- 各制服（背景＋テキスト、丸ごと切替） -->
      <div class="p-uniform__item is-active" data-index="0">
        <!-- 背景（色＋人物・1枚） -->
        <div class="p-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-01_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-01_pc.webp" alt="">
          </picture>
        </div>
        <!-- テキスト（位置固定エリアに乗る） -->
        <div class="p-uniform__text">
          <p class="p-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="p-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-01_pc.webp" alt="私服 CASUAL CLOTHES">
            </picture>
          </div>
          <p class="p-uniform__desc">生徒の自主性を高めるため、TPOに応じて、生徒が服装を決める新校則を実施。<span class="p-uniform__note">※式典・考査は制服のみ</span></p>
        </div>
      </div>

      <!-- 合服 -->
      <div class="p-uniform__item" data-index="1">
        <div class="p-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-02_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-02_pc.webp" alt="">
          </picture>
        </div>
        <div class="p-uniform__text">
          <p class="p-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="p-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-02_pc.webp" alt="合服 SPRING & AUTUMN">
            </picture>
          </div>
          <p class="p-uniform__desc">春や秋にはブレザーの代わりに、涼しげにコーデした装いをベースに。</p>
        </div>
      </div>

      <!-- 夏服 -->
      <div class="p-uniform__item" data-index="2">
        <div class="p-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-03_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-03_pc.webp" alt="">
          </picture>
        </div>
        <div class="p-uniform__text">
          <p class="p-uniform__label">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="p-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-03_pc.webp" alt="夏服 SUMMER">
            </picture>
          </div>
          <p class="p-uniform__desc">ブレザー基調にしたチェックスカートに、白と青色のアクセントを活かした装いに。</p>
        </div>
      </div>

      <!-- 冬服 -->
      <div class="p-uniform__item" data-index="3">
        <div class="p-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-04_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-04_pc.webp" alt="">
          </picture>
        </div>
        <div class="p-uniform__text">
          <p class="p-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="p-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-04_pc.webp" alt="冬服 WINTER">
            </picture>
          </div>
          <p class="p-uniform__desc">（冬服の本文）</p>
        </div>
      </div>

      <!-- セーター -->
      <div class="p-uniform__item" data-index="4">
        <div class="p-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-05_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-05_pc.webp" alt="">
          </picture>
        </div>
        <div class="p-uniform__text">
          <p class="p-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="p-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-05_pc.webp" alt="セーター SWEATER">
            </picture>
          </div>
          <p class="p-uniform__desc">（セーターの本文）</p>
        </div>
      </div>

    </div>

    <!-- スクロール検出用 -->
    <div class="p-uniform__triggers">
      <div class="p-uniform__trigger" data-index="0"></div>
      <div class="p-uniform__trigger" data-index="1"></div>
      <div class="p-uniform__trigger" data-index="2"></div>
      <div class="p-uniform__trigger" data-index="3"></div>
      <div class="p-uniform__trigger" data-index="4"></div>
    </div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
