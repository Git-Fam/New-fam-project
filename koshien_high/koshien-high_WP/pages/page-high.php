<?php
/*
Template Name: 高等学校
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high page--high-all">

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

    <section class="high-news js-fade">
      <div class="ttl">
        <h2 class="TL">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-news-ttl-sp.svg" media="(max-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-ttl-pc.svg" alt="NEWS 新着情報">
          </picture>
        </h2>
      </div>
      <div class="news-contents">
        <div class="news-category">
          <div class="news-category-item-wrap">
            <a href="#" class="news-category-item hover-opa is-active">すべて</a>
            <a href="#" class="news-category-item hover-opa">お知らせ</a>
            <a href="#" class="news-category-item hover-opa">入試情報</a>
            <a href="#" class="news-category-item hover-opa">イベント</a>
            <a href="#" class="news-category-item hover-opa">部活動</a>
          </div>
        </div>
        <div class="news-list">
          <div class="news-list-iner">

            <a class="news-list-item hover-opa" href="#">
              <div class="img-wrap">
                <div class="school-name">高等学校</div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-defo.webp" alt="">
              </div>
              <div class="contents">
                <div class="date-wrap">
                  <p class="date">2026.07.03</p>
                  <div class="tag">お知らせ</div>
                </div>
                <h3 class="TL">2026 中学校・高等学校入学試験説明会・入試対策講座のご案内</h3>
              </div>
            </a>

            <a class="news-list-item hover-opa" href="#">
              <div class="img-wrap">
                <div class="school-name">高等学校</div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-defo.webp" alt="">
              </div>
              <div class="contents">
                <div class="date-wrap">
                  <p class="date">2026.07.03</p>
                  <div class="tag">お知らせ</div>
                </div>
                <h3 class="TL">2026 中学校・高等学校入学試験説明会・入試対策講座のご案内</h3>
              </div>
            </a>

            <a class="news-list-item hover-opa" href="#">
              <div class="img-wrap">
                <div class="school-name">高等学校</div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-defo.webp" alt="">
              </div>
              <div class="contents">
                <div class="date-wrap">
                  <p class="date">2026.07.03</p>
                  <div class="tag">お知らせ</div>
                </div>
                <h3 class="TL">2026 中学校・高等学校入学試験説明会・入試対策講座のご案内</h3>
              </div>
            </a>

          </div>
        </div>
        <a href="#" class="news-btn">
          <div class="pc hover-opa">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-pc.svg" alt="NEWS 新着情報">
          </div>
          <div class="sp">
            <img class="normal" src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-sp.svg" alt="NEWS 新着情報">
            <img class="hover" src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-sp-hov.svg" alt="NEWS 新着情報">
          </div>
        </a>
      </div>
    </section>

    <section class="high-banner js-fade">
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

  <section class="high-change js-fade">
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

  <div class="high-news_banner-wrap high-banner-wrap">
    <div class="high-banner js-fade">
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

  <section class="high-info js-fade">
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