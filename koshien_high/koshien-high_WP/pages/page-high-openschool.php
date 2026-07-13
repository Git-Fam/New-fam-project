<?php
/*
Template Name: オープンスクール（高校）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high-openschool page--high-all">

  <div class="high-openschool-bg">
    <div class="high-openschool-bg-inr"></div>
    <picture>
      <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-bg-sp.webp" type="image/svg+xml">
      <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-bg-pc.webp" alt="">
    </picture>
  </div>

  <div class="high-openschool-inr">
    <section class="high-openschool-kv">
      <h2 class="TL">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-kv-ttl-sp.svg" type="image/svg+xml">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-kv-ttl-pc.svg" alt="好きを見つける 体験会 OPEN SCHOOL">
        </picture>
      </h2>
      <div class="high-openschool-kv-schedule">
        <!-- trueはis-endクラスはなし、falseはis-endクラスはあり -->
        <div class="kv-schedule-item">
          <p class="tg">説明会</p>
          <div class="TM-wrap">
            <p class="TM is-end">
              2026.6.13<span>SAT</span>
            </p>
          </div>
        </div>
        <div class="kv-schedule-item">
          <p class="tg">オープンスクール</p>
          <div class="TM-wrap">
            <p class="TM">
              8.22<span>SAT</span>
            </p>
            <p class="TM">
              9.13<span>SUN</span>
            </p>
            <p class="TM">
              10.13<span>SAT</span>
            </p>
          </div>
        </div>
      </div>
    </section>

    <div class="high-openschool-txt">
      <p class="TX">
        好きなことが<br class="sp">まだ見つかっていなくても大丈夫。<br>
        甲子園学院には、<br>
        一人ひとりの「やってみたい」を<br class="sp">応援する環境があります。<br>
        オープンスクールでは、<br>
        授業や部活動、<br class="sp">先生や先輩との交流を通して、<br>
        学校のリアルな魅力を体感できます。<br>
        新しい発見や出会いが、<br>
        あなたの「好き」を見つける<br class="sp">きっかけになるかもしれません。
      </p>
    </div>

    <section class="high-openschool-date">
      <h3 class="high-openschool-date-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-date-ttl.svg" alt="開催日程">
      </h3>
      <div class="high-openschool-date-items js-fade">
        <!-- trueはis-endクラスはなし、falseはis-endクラスはあり -->
        <div class="date-item is-end">
          <div class="date-item-inr">
            <p class="TG">説明会</p>
            <div class="DD-INFO-wrap">
              <p class="DD">6.13<span>（土）</span></p>
              <p class="INFO">10：00 開始&nbsp;&nbsp;/&nbsp;&nbsp;<br class="sp">会場：本校</p>
            </div>
          </div>
          <div class="date-item-end">
            <p class="TX">終了しました</p>
          </div>
        </div>
        <div class="date-item">
          <div class="date-item-inr">
            <p class="TG">オープンスクール</p>
            <div class="DD-INFO-wrap">
              <p class="DD">8.22<span>（土）</span></p>
              <p class="INFO">10：00 開始&nbsp;&nbsp;/&nbsp;&nbsp;<br class="sp">会場：本校</p>
            </div>
          </div>
          <div class="date-item-end">
            <p class="TX">終了しました</p>
          </div>
        </div>
        <div class="date-item">
          <div class="date-item-inr">
            <p class="TG">オープンスクール</p>
            <div class="DD-INFO-wrap">
              <p class="DD">9.13<span>（日）</span></p>
              <p class="INFO">10：00 開始&nbsp;&nbsp;/&nbsp;&nbsp;<br class="sp">会場：本校</p>
            </div>
          </div>
          <div class="date-item-end">
            <p class="TX">終了しました</p>
          </div>
        </div>
        <div class="date-item">
          <div class="date-item-inr">
            <p class="TG">オープンスクール</p>
            <div class="DD-INFO-wrap">
              <p class="DD">10.13<span>（土）</span></p>
              <p class="INFO">10：00 開始&nbsp;&nbsp;/&nbsp;&nbsp;<br class="sp">会場：本校</p>
            </div>
          </div>
          <div class="date-item-end">
            <p class="TX">終了しました</p>
          </div>
        </div>
      </div>
    </section>

    <section class="high-openschool-agenda">
      <h3 class="high-openschool-agenda-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-ttl.svg" alt="当日の内容">
      </h3>
      <div class="high-openschool-agenda-items">
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-01.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-01-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-01-pc.svg" alt="知れるコト01 教育方針やカリキュラム">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-02.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-02-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-02-pc.svg" alt="知れるコト02 コース制について">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-03.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-03-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-03-pc.svg" alt="知れるコト03 部活動 体験・見学">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-04.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-04-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-04-pc.svg" alt="知れるコト04 校舎見学">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-05.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-05-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-05-pc.svg" alt="知れるコト05 制服試着">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-bg-06.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-06-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-agenda-item-txt-06-pc.svg" alt="知れるコト06 食堂無料体験">
            </picture>
          </p>
        </div>
      </div>
    </section>

    <section class="high-openschool-form">
      <h3 class="high-openschool-form-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-form-ttl.svg" alt="応募フォーム">
      </h3>
      <div class="high-openschool-form-main js-fade"></div>

    </section>


  </div>

</main>


<?php get_template_part('./inc/footer'); ?>