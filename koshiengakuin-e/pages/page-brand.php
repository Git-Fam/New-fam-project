<?php
/*
Template Name: ブランドコンセプト
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="p-brand">

  <div class="p-brand__intro">
    <div class="p-brand-kv">
      <div class="p-brand-kv__title">
        <h1 class="p-brand-kv__title__catch js-load-target a-fadeInUp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/brand_kv.svg" alt="学ぶことは心を磨くこと">
        </h1>

        <span class="p-brand-kv__title__scroll updown">
          <img src="<?php echo get_template_directory_uri(); ?>/img/brand_scroll.webp" alt="SCROLL">
        </span>
      </div>

      <p class="p-brand-kv__desc js-scroll-target a-fadeInUp">
        <span class="u-sp-spacing"></span>あなたの人生をつくるのは、<br class="pc-none"><span class="u-sp-spacing"></span>あなた自身の心です。<br>
        <span class="u-sp-spacing"></span>わたしたちが生きる社会をつくるのは、<br class="pc-none"><span class="u-sp-spacing"></span>わたしたち自身の心です。<br>
        <span class="u-sp-spacing"></span>だから、わたしたちは、心を磨く。<br>
        <span class="u-sp-spacing"></span>学ぶこと、はたらくこと、<br class="pc-none"><span class="u-sp-spacing"></span>そして生きることの本質は、<br>
        <span class="u-sp-spacing"></span>自身の心を磨きつづけることです。<br>
        <span class="u-sp-spacing"></span>甲子園学院が<br class="pc-none"><span class="u-sp-spacing"></span>80年以上にわたって継承してきたのは、<br>
        <span class="u-sp-spacing"></span>心を真ん中に置いた教育。<br class="pc-none"><span class="u-sp-spacing"></span>時代が移ろい、社会が変わっても、<br>
        <span class="u-sp-spacing"></span>心を磨く学びは<br class="pc-none"><span class="u-sp-spacing"></span>変わらず普遍であり続けます。
      </p>

      <div class="p-brand-kv__img js-scroll-target a-fadeInUp">
        <picture>
          <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/brand_kv_2_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/brand_kv_2.webp" alt="甲子園学院 KOSHIEN GAKUIN" loading="lazy">
        </picture>
      </div>

    </div>
  </div>


  <div class="p-brand-founding js-scroll-target a-fadeInUp">
    <div class="p-brand-founding__inner">
      <div class="p-brand-founding__bg">
        <picture>
          <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/founding-bg-sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/founding-bg.webp" alt="" loading="lazy" aria-hidden="true">
        </picture>
      </div>

      <div class="p-brand-founding__content js-scroll-target a-fadeInUp">
        <div class="p-brand-founding__content__inner">
          <div class="p-brand-founding__intro">
            <p>
              甲子園学院小学校が<br class="pc-none">最も大切にしているのは、<br>
              「学ぶことは、心を磨くこと」です。<br>
              私たちは、開校以来受け継いだ<br>
              「建学の精神」を<br class="pc-none">単なる過去の訓示としてではなく、<br>
              子どもたちが予測不能な未来を<br class="pc-none">たくましく、<br class="sp-none">
              優しく生き抜くための<br class="pc-none">「一生モノの土台」として<br class="pc-none">位置づけています。</span>
            </p>
          </div>

          <div class="p-brand-founding__heading">
            <span class="p-brand-founding__mark" aria-hidden="true"></span>
            <p class="p-brand-founding__label">建学の精神</p>
          </div>

          <div class="p-brand-founding__items">
            <section class="p-brand-founding__item">
              <p class="p-brand-founding__kana">びんべんどりょく</p>
              <h2 class="p-brand-founding__title">黽勉努力</h2>
              <p class="p-brand-founding__lead">
                <span class="pc">〜「させられる学び」から、自ら世界を広げる喜びへ〜</span>
                <span class="sp p-brand-founding__lead-sp"><span>「させられる学び」から、<br>自ら世界を広げる喜びへ</span></span>
              </p>
              <p class="p-brand-founding__text">
                「黽勉」とは、自らの心に従い、自発的に励む姿勢を意味します。<br class="sp-none">本校ではこれを単なる猛勉強とは捉えません。子どもたちの中にある「好奇心」という原石を磨き、<br>
                「知りたい！やってみたい！」という内発的な意欲を育てること。<br class="sp-none">そして、身につけた確かな学力を「誰かの幸せ（社会貢献）」のために<br class="sp-none">役立てようとする志を育むこと。<br class="sp-none">この「自ら学ぶ姿勢」こそが、難関校への挑戦や、<br class="sp-none">その先の社会でリーダーとして活躍するための真の原動力となります。
              </p>
            </section>

            <section class="p-brand-founding__item">
              <p class="p-brand-founding__kana">わちゅうきょうどう</p>
              <h2 class="p-brand-founding__title">和衷協同</h2>
              <p class="p-brand-founding__lead">
                <span class="pc">〜「心の居場所」があるから、他者と深くつながる〜</span>
                <span class="sp p-brand-founding__lead-sp"><span>「心の居場所」があるから、<br>他者と深くつながる</span></span>
              </p>
              <p class="p-brand-founding__text">
                和やかに心をこめて力を合わせるこの精神は、<br class="sp-none">本校が理想とする温かな「ファミリー」のような校風そのものです。<br class="sp-none">全教職員が一人ひとりの個性や小さな変化に寄り添う「確かな心の居場所」があるからこそ、<br class="sp-none">子どもたちはありのままの自分を表現し、失敗を恐れずに挑戦できます。<br class="sp-none">自分らしくいられる安心感を知っている子どもは、他者の痛みにも自然と共感し、<br class="sp-none">手を取り合って課題を解決する「共創の力」を身につけていきます。
              </p>
            </section>

            <section class="p-brand-founding__item">
              <p class="p-brand-founding__kana">しせいいっかん</p>
              <h2 class="p-brand-founding__title">至誠一貫</h2>
              <p class="p-brand-founding__lead">
                <span class="pc">〜誠実な心が、先端教育を本物の力に変える〜</span>
                <span class="sp p-brand-founding__lead-sp"><span>誠実な心が、<br>先端教育を本物の力に変える</span></span>
              </p>
              <p class="p-brand-founding__text p-brand-founding__text--wide-sp">誠をもって人に接し、一筋に真心を貫き通すこと。<br class="sp-none">昨今、ICTやAIなどの先進的な教育が注目されていますが、<br class="sp-none">それらを使いこなすのはどこまでも「人間」です。<br class="sp-none">一人ひとりの根っこに、揺るぎない誠実さと自己肯定感という土台が育っていなければ<br class="sp-none">どんな高度なスキルも活きてきません。<br class="sp-none">本校は「基礎・基本の徹底」と「真心ある関わり」を貫くことで、どんな時代にあっても、<br class="sp-none">自分と社会に対して誠実に、堂々と歩んでいける人間としての「体幹」を鍛えます。
              </p>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="p-brand-voice js-scroll-target a-fadeInUp">

    <div class="p-brand-voice__inner">

      <div class="p-brand-voice__bg">
        <picture>
          <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/brand_voice_bg_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/brand_voice_bg.webp" alt="" loading="lazy" aria-hidden="true">
        </picture>
      </div>

      <div class="p-brand-voice__content js-scroll-target a-fadeInUp">
        <h2 class="p-brand-voice__title">
          ごあいさつ
        </h2>

        <p class="p-brand-voice__desc">
          本校は「学ぶ心を磨き、未来社会に<br class="pc">貢献できる子ども」の育成を目指しています。<br class="pc">子どもたちが自ら問いを立て、<br class="pc">夢中で知的好奇心を広げ、教職員は<br class="pc">「すべての学びは貢献につながる」という<br class="pc">信念のもと、これからの時代を<br class="pc">たくましく生き抜く児童を育みます。<br class="pc">その土台となるのは、一人ひとりの個性を<br class="pc">大切にする少人数教育と、教職員全員が<br class="pc">温かく寄り添う「あたたかい安心感」です。<br class="pc">日々の学習や豊かな行事を通じ、誰もが<br class="pc">主役として輝ける場面をたくさん用意し、<br class="pc">心の支えとなる自己肯定感を高めることが<br class="pc">できるように工夫をしています。<br class="pc">仲間と深く「心と心がつながる」体験は、<br class="pc">これからの時代に欠かせない共感力や<br class="pc">協働力を耕し、未知の課題に立ち向かう<br class="pc">「しなやかな思考力」へと繋がっていきます。<br class="pc">本校は、ありのままの個性を優しく受け入れ、<br class="pc">一人ひとりが輝ける温かな居場所です。<br class="pc">確かな学力と豊かな人間性をバランスよく育み、<br class="pc"> 輝く未来へ羽ばたくリーダーを育てます。<br class="pc">
        </p>

        <div class="p-brand-voice__profile">
          <p class="p-brand-voice__profile__position">校長</p>
          <p class="p-brand-voice__profile__name">中道 一夫</p>
        </div>

      </div>

      <div class="p-brand-voice__content__mask"></div>

    </div>

  </div>


</div>

<?php get_template_part('./inc/footer'); ?>