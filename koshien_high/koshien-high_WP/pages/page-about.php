<?php
/*
Template Name: 学校案内
Template Post Type: page
Template Path: pages/
*/

// /about/ にアクセスされたら /about/facility/ へリダイレクト
// wp_redirect(home_url('/about/facility/'), 301);
// exit;
?>


<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 一旦、中学の「学びの特色」ここで作成 -->
<main class="page page--feature">

 <!-- ===== FV ===== -->
  <section class="p-feature-fv">
    <!-- 背景画像 -->
    <div class="p-feature-fv__bg">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/fv-bg_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/fv-bg_pc.webp" alt="">
      </picture>
    </div>
    <!-- タイトル画像 -->
    <div class="p-feature-fv__ttl">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/fv-ttl_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/fv-ttl_pc.webp" alt="夢中になれる学び 学びの特色">
      </picture>
    </div>
  </section>
  
  <!-- ===== 特色ブロック ===== -->
  <section class="p-feature">

    <!-- 01：テキスト（左）＋画像（右） -->
    <div class="p-feature__row">
      <div class="p-feature__text js-fade">
        <div class="p-feature__label">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-01_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-01_pc.webp" alt="DIVE IN 少人数">
          </picture>
        </div>
            <h2 class="p-feature__ttl">生徒<br><span class="p-feature__num">3~4</span>名につき、<br>
            <span class="p-feature__num">1</span>人の教員！</h2>
        <p class="p-feature__desc">ダミー少人数教育のため、生徒と教師との距<br class="pc">
        離が近く、日々の声かけや個別対応を通して、<br class="pc">
        一人ひとりの成長を支えます。</p>
      </div>
      <div class="p-feature__img js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/img-01.webp" alt="">
      </div>
    </div>

    <!-- 02：画像（左）＋テキスト（右） -->
    <div class="p-feature__row p-feature__row--reverse">
      <div class="p-feature__img js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/img-02.webp" alt="">
      </div>
      <div class="p-feature__text js-fade">
        <div class="p-feature__label">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-02_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-02_pc.webp" alt="DIVE IN プログラミング">
          </picture>
        </div>
          <h2 class="p-feature__ttl">プログラミング<br>など教科を超えた<br>学びも充実！</h2>
        <p class="p-feature__desc">ダミープログラミングや言語活動、体験活動など<br class="pc">
        の主要教科や副教科以外の学習を通して、社会で<br class="pc">
        活かせる力を育みます。</p>
      </div>
    </div>

    <!-- 03：テキスト（左）＋画像（右） -->
    <div class="p-feature__row">
      <div class="p-feature__text js-fade">
        <div class="p-feature__label">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-03_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-03_pc.webp" alt="DIVE IN 学校行事">
          </picture>
        </div>
          <h2 class="p-feature__ttl">ダミー1年間で<br>学校行事が<span class="p-feature__num">7</span>回も！</h2>
        <p class="p-feature__desc">ダミー春の校外学習や、秋に実施する東京ディズニーリ<br class="pc">
        ゾートへの旅行、体育大会、文化祭、コーラスコンクー<br class="pc">
        ルなど、さまざまなイベントがたくさん！</p>
      </div>
      <div class="p-feature__img js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/img-03.webp" alt="">
      </div>
    </div>

    <!-- 04：画像（左）＋テキスト（右） -->
    <div class="p-feature__row p-feature__row--reverse">
      <div class="p-feature__img js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/img-04.webp" alt="">
      </div>
      <div class="p-feature__text js-fade">
        <div class="p-feature__label">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-04_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/label-04_pc.webp" alt="DIVE IN 英会話">
          </picture>
        </div>
          <h2 class="p-feature__ttl"><span class="p-feature__num">1</span>対<span class="p-feature__num">1</span>の<br>オンライン英会話！</h2>
        <p class="p-feature__desc">ダミー必修の英語の授業とは別にネイティブの講師による<br class="pc">
        英会話の授業を導入していますが、今年度より新たにオン<br class="pc">
        ライン英会話の授業を加え、英語を話す力、聞く力をさら<br class="pc">
        に高め、グローバル社会を生き抜く力を磨いていきます。</p>
      </div>
    </div>

    <!-- ===== 夢中NUMBER ===== -->
  <section class="p-number">
    <!-- タイトル -->
    <div class="p-number__ttl js-fade">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/number-ttl_pc.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/number-ttl_pc.webp" alt="夢中NUMBER 夢中から生まれた数字">
      </picture>
    </div>

    <!-- ハート＋人物 -->
    <div class="p-number__body">
      <!-- ハート6枚（1枚画像） -->
      <div class="p-number__hearts js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/number-hearts_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/number-hearts_pc.webp" alt="全校生徒の90%が部活に加入！ 1年間の大会出場回数10回 クラス平均人数25人">
        </picture>
      </div>

      <!-- 人物1 -->
      <div class="p-number__person p-number__person--01 js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-01_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-01_pc.webp" alt="">
        </picture>
      </div>

      <!-- 人物2 -->
      <div class="p-number__person p-number__person--02 js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-02_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-02_pc.webp" alt="">
        </picture>
      </div>

      <!-- 人物3 -->
      <div class="p-number__person p-number__person--03 js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-03_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-feature/person-03_pc.webp" alt="">
        </picture>
      </div>
    </div>
  </section>

  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
