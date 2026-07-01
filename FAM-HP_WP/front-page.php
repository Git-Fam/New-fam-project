
<?php get_template_part('global-parts/header'); ?>

<main class="top">
<div class="top__wrapper">
  <!-- FV -->
  <section class="top__fv fv">

    <!-- 背景動画 -->
    <video class="fv__video" style="backg" autoplay muted loop playsinline>
      <source src="<?php echo get_template_directory_uri(); ?>/img/top/fv/fv-02.mp4" type="video/mp4">
    </video>

    <div class="fv__inner">
      <div class="fv__text">
        <!-- <h1 class="fv__title">FROM VISION<br>TO<br>REALITY</h1> -->
         <!-- <h1 class="fv__title">TRUSTED PARTNER<br>FOR<br>DIGITAL<br>TRANSFORMATION</h1> -->
         <h1 class="fv__title">FROM <br>STRATEGY<br>TO REALITY</h1>
        <p class="fv__sub">信頼と実行力で、<br>企業の変革を加速する</p>
      </div>
    </div>

  </section>

  <!-- COMPANY -->

  <section class="top__company company-sec" data-header="light">

    <div class="company-sec__bgbg">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/top‐bgbg.webp">
    </div>

    <div class="company-sec__inner">
      <!-- SPでは右（画像）を先に表示 -->
      <div class="company-sec__right">
        <div class="company-sec__img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/company/company-main.webp" alt="COMPANY">
        </div>
        <p class="company-sec__catch js-text-reveal">
          <span>WHY WE ARE</span>
          <span>TRUSTED</span>
        </p>
      </div>
      <div class="company-sec__left">
        <div class="company-sec__label">
          <span class="company-sec__en up">COMPANY</span>
          <span class="company-sec__ja up">会社概要</span>
        </div>
        <h2 class="company-sec__title up">信頼と実行力で、<br>企業の変革を加速する</h2>
        <p class="company-sec__text up">私たちは、<br class="sp">企業の事業品質を変えるITパートナーです。<br>戦略策定からシステム実装、その後の運用・品質化までを一貫して担い、<br class="pc">変化の激しい市場環境において、<br class="pc">常に優位性を保ち続けるための「仕組み」を構築します。</p>
      </div>
    </div>
  </section>

    <!-- BUSINESS -->
    <section class="top__business business-sec"  data-header="light">
      <div class="business-sec__inner">
          <div class="business-sec__left">
              <div class="business-sec__video-wrap right">
                  <video class="business-sec__video is-active" data-video="01" autoplay muted loop playsinline>
                      <source src="<?php echo get_template_directory_uri(); ?>/img/top/business/biz-01.mp4" type="video/mp4">
                  </video>
                  <video class="business-sec__video" data-video="02" muted loop playsinline>
                      <source src="<?php echo get_template_directory_uri(); ?>/img/top/business/biz-02.mp4" type="video/mp4">
                  </video>
                  <video class="business-sec__video" data-video="03" muted loop playsinline>
                      <source src="<?php echo get_template_directory_uri(); ?>/img/top/business/biz-03.mp4" type="video/mp4">
                  </video>
                  <video class="business-sec__video" data-video="04" muted loop playsinline>
                      <source src="<?php echo get_template_directory_uri(); ?>/img/top/business/biz-04.mp4" type="video/mp4">
                  </video>
              </div>
          </div>
          <div class="business-sec__right">
          <div class="business-sec__label">
              <span class="business-sec__en up">BUSINESS</span>
              <span class="business-sec__ja up">事業内容</span>
          </div>
          <ul class="business-sec__list">
            <li class="business-sec__item" data-video="01">
                <a href="<?php echo get_home_url(); ?>/business/#biz-01" class="business-sec__item-link">
                    <span class="business-sec__num">01</span>
                    <div class="business-sec__item-text left">
                        <p class="business-sec__item-title">IT Consulting & Strategy</p>
                        <p class="business-sec__item-desc">現状課題を構造化し、<br>最適なテクノロジー戦略を設計。</p>
                    </div>
                </a>
            </li>
            <li class="business-sec__item" data-video="02">
                <a href="<?php echo get_home_url(); ?>/business/#biz-02" class="business-sec__item-link">
                    <span class="business-sec__num">02</span>
                    <div class="business-sec__item-text left">
                        <p class="business-sec__item-title">Digital & System Development</p>
                        <p class="business-sec__item-desc">WebアプリからAI活用まで、<br>AI・データ活用を起点としたシステム開発を一貫支援。</p>
                    </div>
                </a>
            </li>
            <li class="business-sec__item" data-video="03">
                <a href="<?php echo get_home_url(); ?>/business/#biz-03" class="business-sec__item-link">
                    <span class="business-sec__num">03</span>
                    <div class="business-sec__item-text left">
                        <p class="business-sec__item-title">Business Transformation</p>
                        <p class="business-sec__item-desc">既存の枠組みにとらわれない視点で、<br>業務プロセスや組織構造を再設計。</p>
                    </div>
                </a>
            </li>
            <li class="business-sec__item" data-video="04">
                <a href="<?php echo get_home_url(); ?>/business/#biz-04" class="business-sec__item-link">
                    <span class="business-sec__num">04</span>
                    <div class="business-sec__item-text left">
                        <p class="business-sec__item-title">Agency & Growth Strategy</p>
                        <p class="business-sec__item-desc">市場戦略の設計から実行支援まで、<br>組織の成長を加速。</p>
                    </div>
                </a>
            </li>
        </ul>
          </div>
      </div>
    </section>
</div>

<!-- CAREERS -->
<section class="top__careers careers-sec">

 <!-- 背景動画 -->
    <video class="careers-sec__video" autoplay muted loop playsinline>
        <source src="<?php echo get_template_directory_uri(); ?>/img/top/fv/fv-04.mp4" type="video/mp4">
    </video>
    <div class="careers-sec__video-grad"></div> 

  <!-- 背景画像（スクロールで流れる） -->
    <div class="careers-sec__bg">
        <div class="careers-sec__bg-img careers-sec__bg-img--01">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top/careers/careers-01.webp" alt="">
        </div>
        <div class="careers-sec__bg-img careers-sec__bg-img--02">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top/careers/careers-02.webp" alt="">
        </div>
        <div class="careers-sec__bg-img careers-sec__bg-img--03">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top/careers/careers-03.webp" alt="">
        </div>
        <div class="careers-sec__bg-img careers-sec__bg-img--04">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top/careers/careers-04.webp" alt="">
        </div>
        <div class="careers-sec__bg-img careers-sec__bg-img--05">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top/careers/careers-05.webp" alt="">
        </div>
    </div>

  <!-- テキスト（stickyで固定） -->
  <div class="careers-sec__content">
  <div class="careers-sec__left">
    <div class="careers-sec__label">
      <span class="careers-sec__en">CAREERS</span>
      <span class="careers-sec__ja">採用情報</span>
    </div>
    <h2 class="careers-sec__title">
      <span class="js-mask-text">BE THE</span>
      <span class="js-mask-text">NEXT</span>
      <span class="js-mask-text">STANDARD</span>
    </h2>
    <p class="careers-sec__sub">市場価値を、その手に</p>
  </div>
  <div class="careers-sec__right up">
    <p class="careers-sec__text">今の自分から、もう一歩先へ。<br>その技術に、早いも遅いもありません。</p>
    <p class="careers-sec__text">最先端技術に触れながら、試行錯誤を重ねていく日々。<br>意見を交わし、支え合える環境があるからこそ、<br>安心して挑戦できる。</p>
    <p class="careers-sec__text">安定した経営基盤のもと、長く成長できる土台があります。<br>ここでの経験は、あなた自身の市場価値を確かなものにしていきます。</p>
  </div>
</div>

</section>

</main>

<?php get_template_part('global-parts/footer'); ?>