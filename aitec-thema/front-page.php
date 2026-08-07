<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="front-page">

  <section class="front-page__hero">
    <picture class="front-page__hero-image">
      <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front/hero-pc.webp">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/hero-sp.webp" alt="">
    </picture>
    <div class="front-page__hero-inner">
      <h2 class="front-page__hero-title loadDown">
        営業の未来を、<br>
        テクノロジーで<br>
        アップデートする。
      </h2>

      <p class="front-page__hero-text loadDown">
        株式会社アイテックは、営業活動をもっと<br class="sp">スマートに、<br class="pc">
        もっと成果につながるものへ<br class="sp">進化させる営業 DX 企業です。<br class="pc">
        自社開発 <br class="sp">SaaS を通じて、企業の成長を加速させる<br>
        新しい営業インフラを提供します。
      </p>

      <a href="/about" class="front-page__hero-link hover-opa loadDown">
        <span class="front-page__hero-link-text">私たちについて見る</span>
        <span class="front-page__hero-link-arrow">→</span>
      </a>

      <p class="front-page__hero-note loadDown">
        私たちは、営業現場が抱える「非効率」をテクノロジーで解決する会社です。自社開発による高品質なシステムを提供し、<br>
        企業の生産性向上と売上最大化を支援します。常に現場目線を大切にしながら、誰でも使いやすいサービスを追求し続けています。
      </p>
    </div>
  </section>

  <section class="front-page__about">
    <div class="front-page__about-inner">
      <p class="front-page__about-label up">WHO WE ARE</p>

      <h2 class="front-page__about-title up">
        Technology for <br>
        Business Growth.
      </h2>

      <p class="front-page__about-text left">
        株式会社アイテックは、<br>
        「テクノロジーで営業をもっとシンプルに。」をテーマに、<br class="pc">
        自社開発の営業支援システムを提供する IT 企業です。<br>
        現場で本当に必要とされる機能だけを追求し、<br class="pc">
        使いやすさ・導入しやすさ・成果につながることを第一に<br class="pc">
        開発を行っています。<br>
        私たちは単なるシステム会社ではなく、お客様の売上と成長に貢献するビジネスパートナーとして、新しい営業 DX を創造していきます。
      </p>

      <a href="/about#philosophy" class="front-page__about-link hover-opa up">
        <span class="front-page__about-link-text">企業理念を見る</span>
        <span class="front-page__about-link-arrow">→</span>
      </a>
    </div>
  </section>

  <section class="front-page__service">
    <div class="front-page__service-inner">
      <p class="front-page__service-label up">OUR BUSINESS</p>
      <h2 class="front-page__service-title up">事業内容</h2>

      <ul class="front-page__service-list">
        <li class="front-page__service-item left">
          <p class="front-page__service-item-number">01</p>
          <h3 class="front-page__service-item-title">営業 DXシステム開発</h3>
          <p class="front-page__service-item-text">
            営業活動を効率化するクラウドサービスを自社開発。現場の課題を解決し、売上向上につながる営業支援システムを提供しています。
          </p>
        </li>
        <li class="front-page__service-item left">
          <p class="front-page__service-item-number">02</p>
          <h3 class="front-page__service-item-title">コールシステム事業</h3>
          <p class="front-page__service-item-text">
            Zoom Phone と連携した次世代コールシステム「グロースコア」を提供。高機能・低コスト・優れた操作性を実現し、企業の営業活動を支援します。
          </p>
        </li>
        <li class="front-page__service-item left">
          <p class="front-page__service-item-number">03</p>
          <h3 class="front-page__service-item-title">AI・業務効率化ソリューション</h3>
          <p class="front-page__service-item-text">
            AI を活用した営業支援や業務自動化サービスを開発。企業の生産性向上と人手不足の課題解決をサポートします。
          </p>
        </li>
        <li class="front-page__service-item left">
          <p class="front-page__service-item-number">04</p>
          <h3 class="front-page__service-item-title">システムコンサルティング</h3>
          <p class="front-page__service-item-text">
            営業フローや業務課題を分析し、企業ごとに最適な DX 戦略をご提案。導入から運用まで一貫して支援します。
          </p>
        </li>
      </ul>

      <a href="/service" class="front-page__service-link hover-opa up">
        <span class="front-page__service-link-text">サービス詳細を見る</span>
        <span class="front-page__service-link-arrow">→</span>
      </a>
    </div>
  </section>

  <section class="front-page__strength">
    <div class="front-page__strength-inner">
      <p class="front-page__strength-label up">OUR STRENGTH</p>
      <h2 class="front-page__strength-title up">aitecの強み</h2>

      <ul class="front-page__strength-list">
        <li class="front-page__strength-item left">
          <div class="front-page__strength-item-icon-wrap">
            <img class="front-page__strength-item-icon"
              src="<?php echo get_template_directory_uri(); ?>/img/front/front-page__strength-item-icon-01.webp" alt="">
          </div>
          <h3 class="front-page__strength-item-title">完全自社開発</h3>
          <p class="front-page__strength-item-text">
            企画・設計・開発・改善までをすべて自社で行うことで、スピーディーなアップデートと柔軟な機能追加を実現しています。
          </p>
        </li>
        <li class="front-page__strength-item left">
          <div class="front-page__strength-item-icon-wrap">
            <img class="front-page__strength-item-icon"
              src="<?php echo get_template_directory_uri(); ?>/img/front/front-page__strength-item-icon-02.webp" alt="">
          </div>
          <h3 class="front-page__strength-item-title">現場目線の UI・UX</h3>
          <p class="front-page__strength-item-text">
            営業現場の声を反映した、誰でも直感的に使えるシンプルな操作性を追求しています。
          </p>
        </li>
        <li class="front-page__strength-item left">
          <div class="front-page__strength-item-icon-wrap">
            <img class="front-page__strength-item-icon"
              src="<?php echo get_template_directory_uri(); ?>/img/front/front-page__strength-item-icon-03.webp" alt="">
          </div>
          <h3 class="front-page__strength-item-title">圧倒的な<br class="pc">コストパフォーマンス</h3>
          <p class="front-page__strength-item-text">
            クラウドサービスを活用した独自設計により、高品質でありながら導入しやすい価格を実現しています。
          </p>
        </li>
        <li class="front-page__strength-item left">
          <div class="front-page__strength-item-icon-wrap">
            <img class="front-page__strength-item-icon"
              src="<?php echo get_template_directory_uri(); ?>/img/front/front-page__strength-item-icon-04.webp" alt="">
          </div>
          <h3 class="front-page__strength-item-title">成長し続けるプロダクト</h3>
          <p class="front-page__strength-item-text">
            市場やお客様のニーズに合わせて継続的に機能改善を実施。常に進化し続けるサービスを提供します。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <section class="front-page__banner">
    <div class="C_contact-banner up">
      <div class="C_contact-banner-inner">
        <h2 class="C_contact-banner-title">営業 DX を、<br class="sp">もっとシンプルに。</h2>
        <p class="C_contact-banner-text">
          営業活動を変える第一歩は、<br class="sp">最適なシステム選びから。<br>
          グロースコアに関するご相談やデモのご依頼は、お気軽にお問い合わせください。
        </p>
        <a href="#" class="C_contact-banner-button hover-opa">
          <span class="C_contact-banner-button-text">お問い合わせはこちら</span>
          <span class="C_contact-banner-button-arrow">→</span>
        </a>
      </div>
    </div>
  </section>

  <section class="front-page__contct">
    <div class="front-page__contct-inner">
      <div class="front-page__contct-text">
        <p class="front-page__contct-label up">CONTACT</p>
        <h2 class="front-page__contct-title up">お問い合わせ</h2>
        <p class="front-page__contct-desc up">
          サービスに関するご質問やご相談など、<br>
          お気軽にお問い合わせください。
        </p>
      </div>

      <div class="C_form down">

        <?php echo do_shortcode('[contact-form-7 id="ee99720" title="contact"]'); ?>
        
      </div>
    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>