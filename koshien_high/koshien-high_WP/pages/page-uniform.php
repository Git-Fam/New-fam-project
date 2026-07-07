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

  <section class="pt-uniform" id="js-uniform">
    <div class="pt-uniform__sticky">

      <!-- 各制服（背景＋テキスト、丸ごと切替） -->
      <div class="pt-uniform__item is-active" data-index="0">
        <!-- 背景（色＋人物・1枚） -->
        <div class="pt-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-01_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-01_pc.webp" alt="">
          </picture>
        </div>
        <!-- テキスト（位置固定エリアに乗る） -->
        <div class="pt-uniform__text">
          <p class="pt-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="pt-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-01.webp" alt="私服 CASUAL CLOTHES">
            </picture>
          </div>
          <p class="pt-uniform__desc">生徒の自主性を高めるため、<br class="sp">TPOに応じて、<br class="pc">生徒が服装を<br class="sp">決める新校則を実施。<br>
            <span class="pt-uniform__note">※式典・考査は制服のみ</span>
          </p>
        </div>
      </div>

      <!-- 合服 -->
      <div class="pt-uniform__item" data-index="1">
        <div class="pt-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-02_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-02_pc.webp" alt="">
          </picture>
        </div>
        <div class="pt-uniform__text">
          <p class="pt-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="pt-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-02.webp" alt="合服 SPRING & AUTUMN">
            </picture>
          </div>
          <p class="pt-uniform__desc">春や秋にはブレザーの代わりに、<br>金の三つのボタンが素敵なベストで</p>
        </div>
      </div>

      <!-- 夏服 -->
      <div class="pt-uniform__item" data-index="2">
        <div class="pt-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-03_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-03_pc.webp" alt="">
          </picture>
        </div>
        <div class="pt-uniform__text">
          <p class="pt-uniform__label">
             <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="pt-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-03.webp" alt="夏服 SUMMER">
            </picture>
          </div>
          <p class="pt-uniform__desc">ブルーを基調にしたチェックの<br class="sp">スカートに、<br class="pc">白と青色のブラウスが<br class="sp">涼しげな雰囲気。</p>
        </div>
      </div>

      <!-- 冬服 -->
      <div class="pt-uniform__item" data-index="3">
        <div class="pt-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-04_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-04_pc.webp" alt="">
          </picture>
        </div>
        <div class="pt-uniform__text">
          <p class="pt-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="pt-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-04.webp" alt="冬服 WINTER">
            </picture>
          </div>
          <p class="pt-uniform__desc">ダブルのブレザーの胸にエンブレム、<br>基本型はキリッと知的。</p>
        </div>
      </div>

      <!-- セーター -->
      <div class="pt-uniform__item" data-index="4">
        <div class="pt-uniform__bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-05_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/bg-05_pc.webp" alt="">
          </picture>
        </div>
        <div class="pt-uniform__text">
          <p class="pt-uniform__label">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/label_pc.webp" alt="制服紹介">
            </picture>
          </p>
          <div class="pt-uniform__ttl">
            <picture>
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/uniform/ttl-05.webp" alt="セーター SWEATER">
            </picture>
          </div>
          <p class="pt-uniform__desc">濃紺に赤のワンポイントでアクセント。<br>ブレザーと重ね着ができるスッキリとしたデザイン。</p>
        </div>
      </div>

    </div>

    <!-- スクロール検出用 -->
    <div class="pt-uniform__triggers">
      <div class="pt-uniform__trigger" data-index="0"></div>
      <div class="pt-uniform__trigger" data-index="1"></div>
      <div class="pt-uniform__trigger" data-index="2"></div>
      <div class="pt-uniform__trigger" data-index="3"></div>
      <div class="pt-uniform__trigger" data-index="4"></div>
    </div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
