<?php
/*
Template Name: LOVE MY COURSE
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page-high-course page--high-all">

  <section class="high-course-kv">
    <div class="high-course-kv-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-kv-bg-sp.webp" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-kv-bg-pc.webp" alt="">
      </picture>
    </div>
    <div class="high-course-kv-inr">
      <div class="high-course-kv-ttl">
        <h2 class="TL js-fade">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-kv-ttl-sp.svg" media="(max-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-kv-ttl-pc.svg" alt="LOVE MY COURSE わたしのコースの好きなところ">
          </picture>
        </h2>
      </div>
      <div class="high-course-kv-txt">
        <p class="TX js-fade">
          あなたが見つけた「好き」や「得意」に<br class="sp">合わせて、<br class="pc">自分らしく学べる2つの<br class="sp">コースについて、<br class="pc">生徒が見つけた<br class="sp">「好きなところ」を聞いてみました。
        </p>
      </div>
    </div>
  </section>

  <section class="high-course-stage high-course-standard">
    <div class="high-course-stage-top">
      <div class="high-course-stage-top-bg">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-standard-top-bg-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-standard-top-bg-pc.webp" alt="">
        </picture>
      </div>
      <div class="high-course-stage-top-inr js-fade">
        <h2 class="TL">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-standard-top-ttl-sp.svg" media="(max-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-standard-top-ttl-pc.svg" alt="">
          </picture>
        </h2>
        <p class="TX">
          ダミースタンダードステージは、甲子園大学・甲子園短期大学や<br class="pc">
          その他の四年制大学・短期大学・専門学校・就職を目指すコースです。<br class="pc">
          ダミースタンダードステージは、甲子園大学・甲子園短期大学や<br class="pc">
          その他の四年制大学・短期大学・専門学校・就職を目指すコースです。
        </p>
      </div>
    </div>

    <div class="high-course-stage-contents">

      <div class="high-course-stage-contents-list">
        <div class="high-course-stage-contents-item">
          <div class="item-img">
            <div class="item-img-inr">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-premium-item-img-01.webp" alt="">
            </div>
            <div class="item-img-deco"></div>
          </div>
          <div class="item-sent"></div>
        </div>


      </div>










    </div>

  </section>

  <section class="high-course-stage high-course-premium">
    <div class="high-course-stage-top">
      <div class="high-course-stage-top-bg">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-premium-top-bg-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-premium-top-bg-pc.webp" alt="">
        </picture>
      </div>
      <div class="high-course-stage-top-inr js-fade">
        <h2 class="TL">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-premium-top-ttl-sp.svg" media="(max-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-course/high-course-premium-top-ttl-pc.svg" alt="">
          </picture>
        </h2>
        <p class="TX">

          ダミープレミアムステージは、国公立大学や難関私立大学、<br class="pc">
          看護系大学、専門学校への進学を目指すコースです。ダミープレミアムステージは、<br class="pc">
          国公立大学や難関私立大学、看護系大学、専門学校への進学を目指すコースです。
        </p>
      </div>
    </div>

    <div class="high-course-stage-contents"></div>

  </section>





</main>


<?php get_template_part('./inc/footer'); ?>