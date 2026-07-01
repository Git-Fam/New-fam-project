<?php get_template_part('global-parts/header'); ?>

<main class="business">

  <div class="business__bgbg">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/business-bgbg.webp">
  </div>

  <!-- PAGE HEADER -->
  <section class="page-header">
    <div class="page-header__inner">
      <h1 class="page-header__title up">BUSINESS</h1>
      <p class="page-header__sub up">事業内容</p>
    </div>
  </section>

    <!-- 全幅メイン動画 -->
    <div class="company__fullimg-wrap">
    <div class="company__fullimg">
        <video autoplay muted loop playsinline>
        <source src="<?php echo get_template_directory_uri(); ?>/img/business/business-main01.mp4" type="video/mp4">
        </video>
    </div>
    </div>

  <!-- BUSINESS セクション（1つのstickyコンテナ） -->
  <div class="biz-wrap" id="biz-01">

    <!-- 背景動画 -->
    <video class="biz-wrap__bg-video" autoplay muted loop playsinline>
      <source src="<?php echo get_template_directory_uri(); ?>/img/top/fv/fv-04.mp4" type="video/mp4">
    </video>
    
    <section class="biz-sec">
      <div class="biz-sec__inner">

        <!-- テキスト側（4つ重ねる） -->
        <div class="biz-sec__left">
          <div class="biz-sec__text-item" data-index="0">
            <span class="biz-sec__num">01</span>
            <h2 class="biz-sec__title js-text-reveal">
                <span>IT CONSULTING &amp;</span>
                <span>STRATEGY</span>
            </h2>
            <p class="biz-sec__label">ITコンサルティング事業</p>
            <div class="biz-sec__desc">
              <p>経営課題を構造的に整理し、<br class="pc">
                テクノロジーの視点から最適な解決策を描きます。<br class="pc">
                短期的な成果だけでなく、中長期の成長を見据えた戦略設計を重視。<br><br>

                構想策定から実行フェーズまで一貫して伴走し、<br class="pc">
                企業の変革を着実に支えています。<br class="pc">
                確かな分析力と実行力で、持続可能な価値創出を実現します。</p>
            </div>
          </div>
          <div class="biz-sec__text-item" data-index="1">
            <span class="biz-sec__num">02</span>
            <h2 class="biz-sec__title js-text-reveal">
                <span>DIGITAL &amp; SYSTEM</span>
                <span>DEVELOPMENT</span>
            </h2>
            <p class="biz-sec__label">システム開発事業</p>
            <div class="biz-sec__desc">
              <p>Webアプリケーションから基幹システムまで、幅広い領域の開発に対応。<br class="pc">
                AI・データ活用を前提とした設計思想のもと、拡張性と安定性を両立。<br class="pc">
                企画・要件定義・開発・運用保守までをワンストップで提供し、<br class="pc">
                変化に強いシステム基盤を構築しています。<br><br>

                技術力と実装力で、ビジネスの推進を支えます。</p>
            </div>
          </div>
          <div class="biz-sec__text-item" data-index="2">
            <span class="biz-sec__num">03</span>
            <h2 class="biz-sec__title js-text-reveal">
                <span>BUSINESS</span>
                <span>TRANSFORMATION</span>
            </h2>
            <p class="biz-sec__label">デジタル変革支援事業</p>
            <div class="biz-sec__desc">
              <p>既存の枠組みにとらわれない視点で、<br class="pc">
                業務・顧客接点・価値提供の在り方を再構築。<br>
                テクノロジーを基盤に、事業の進化を加速します。<br><br>

                継続的に成果を生み出す変革を支援します。</p>
            </div>
          </div>
          <div class="biz-sec__text-item" data-index="3">
            <span class="biz-sec__num">04</span>
            <h2 class="biz-sec__title js-text-reveal">
                <span>AGENCY &amp; GROWTH</span>
                <span>STRATEGY</span>
            </h2>
            <p class="biz-sec__label">代理店事業</p>
            <div class="biz-sec__desc">
              <p>市場環境や顧客ニーズを分析し、最適な販売戦略を構築。<br>
                実行支援から組織体制の整備、人材育成まで包括的にサポートします。<br class="pc"><br class="pc">

                蓄積されたノウハウを活かし、再現性のある仕組みづくりを推進。<br><br>

                短期成果と中長期成長の両立を目指し、事業拡大を力強く後押しします。</p>
            </div>
          </div>
        </div>

        <!-- 画像側（4つ重ねる） -->
        <div class="biz-sec__right">
          <div class="biz-sec__img-item" data-index="0">
            <img src="<?php echo get_template_directory_uri(); ?>/img/business/biz-01.webp" alt="">
          </div>
          <div class="biz-sec__img-item" data-index="1">
            <img src="<?php echo get_template_directory_uri(); ?>/img/business/biz-02.webp" alt="">
          </div>
          <div class="biz-sec__img-item" data-index="2">
            <img src="<?php echo get_template_directory_uri(); ?>/img/business/biz-03.webp" alt="">
          </div>
          <div class="biz-sec__img-item" data-index="3">
            <img src="<?php echo get_template_directory_uri(); ?>/img/business/biz-04.webp" alt="">
          </div>
        </div>

      </div>
    </section>
  </div>

</main>

<?php get_template_part('global-parts/footer'); ?>