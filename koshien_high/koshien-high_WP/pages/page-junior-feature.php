<?php
/*
Template Name: 学びの特色（中学）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


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
    <div class="p-feature-fv__ttl js-fade">
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
            <h2 class="p-feature__ttl">生徒<span class="p-feature__num">7</span>名につき、<br>
            <span class="p-feature__num">1</span>人の教員！</h2>
        <p class="p-feature__desc">少人数教育のため、生徒と教師との距離が近<br class="pc">
        い！教員による日々の声かけや個別対応を通<br class="pc">
        して、一人ひとりの成長を支えます。</p>
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
        <p class="p-feature__desc">プログラミングや言語活動、体験活動などの主要<br class="pc">
        教科や副教科以外の学習を通して、社会で活かせ<br class="pc">
        る力を育みます。</p>
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
          <h2 class="p-feature__ttl">1年間で<br>学校行事が<span class="p-feature__num">7</span>回も！</h2>
        <p class="p-feature__desc">春の校外学習や、秋に実施する東京ディズニーリゾート<br class="pc">
        への旅行など行事がたくさん！体育大会や文化祭、コー<br class="pc">
        ラスコンクールは高校生と一緒に行います。</p>
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
        <p class="p-feature__desc">必修授業とは別にネイティブ講師による英会話の授業を導<br class="pc">
       入していますが、さらに1対1のオンライン英会話の授業を<br class="pc">
        加え、英語を話す力、聞く力をいっそう高め、グローバル<br class="pc">
        社会を生き抜く力を磨いていきます。</p>
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


  <section class="junior-declaration-next">
    <div class="junior-declaration-next-inr">
      <h3 class="junior-declaration-next-TL js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-pc.webp" media="(min-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-sp.webp" alt="こちらのコンテンツもチェック！">
        </picture>
      </h3>

      <div class="junior-declaration-next-bnr js-fade">
        <a href="<?php echo home_url('/junior/declaration/'); ?>" class="junior-declaration-next-bnr-link">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-dec-pc.webp" media="(min-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-dec-sp.webp" alt="全校生徒の好きを応援する宣言">
          </picture>
        </a>
      </div>


      <div class="junior-declaration-next-bnr js-fade">
        <a href="<?php echo home_url('junior/students'); ?>" class="junior-declaration-next-bnr-link">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-pc.webp" media="(min-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-sp.webp" alt="好きにまっすぐな夢中学生">
          </picture>
        </a>
      </div>
    </div>
      
  </section>



</main>



<?php get_template_part('./inc/footer'); ?>
