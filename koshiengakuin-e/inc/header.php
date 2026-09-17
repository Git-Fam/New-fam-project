<header class="p-header <?php if (is_home() && ! is_archive()) {
                          echo 'p-header--front';
                        } ?>">

  <div class="p-header__inner">

    <div class="p-header__logo">
      <a href="<?php echo home_url(); ?>" class="fade"><img src="<?php echo get_template_directory_uri(); ?>/img/header_logo.webp" alt="甲子園学院小学校 KOSHIEN GAKUIN ELEMENTARY SCHOOL"></a>
    </div>

    <div class="p-header__content">
      <a href="<?php echo home_url(); ?>/contact/" class="p-header__btn"><span>お問い合わせ</span></a>

      <button type="button" class="p-header__menu-btn js-header-trg"><span></span><span></span><span></span></button>
    </div>


  </div>

  <div class="p-header-nav">

    <div class="p-header-nav__inner">
      <div class="p-header-nav__top">
        <a href="<?php echo home_url(); ?>/brand/" class="p-header-nav__top__link fade">
          <img src="<?php echo get_template_directory_uri(); ?>/img/header_nav_1.webp" alt="">
          <span class="p-header-icon-text">ブランドコンセプト</span>
        </a>
        <a href="<?php echo home_url(); ?>/connected-hearts/" class="p-header-nav__top__link fade">
          <img src="<?php echo get_template_directory_uri(); ?>/img/header_nav_2.webp" alt="">
          <span class="p-header-icon-text">心がつながった児童たち</span>
        </a>
      </div>

      <div class="p-header-nav__bottom">
        <div class="p-header-nav__bottom__inner">
          <ul>
            <li><a href="<?php echo home_url(); ?>/manabi/" class="p-header-icon-text">心がつながる学び</a></li>
            <li><a href="<?php echo home_url(); ?>/environment/" class="p-header-icon-text">心を磨く環境</a></li>
            <li><a href="<?php echo home_url(); ?>/results/" class="p-header-icon-text">進学実績・卒業生</a></li>
          </ul>
          <ul>
            <li><a href="<?php echo home_url(); ?>/admission/" class="p-header-icon-text">入試情報</a></li>
            <li><a href="<?php echo home_url(); ?>/schedule/" class="p-header-icon-text">心がつながる一年</a></li>
            <li><a href="<?php echo home_url(); ?>/news/" class="p-header-icon-text">ニュース&トピックス</a></li>
          </ul>
          <ul>
            <li><a href="<?php echo home_url(); ?>/access/" class="p-header-icon-text">アクセス</a></li>
            <li><a href="<?php echo home_url(); ?>/recruit/" class="p-header-icon-text">採用情報</a></li>
            <li><a href="<?php echo home_url(); ?>/contact/" class="p-header-icon-text">お問い合わせ</a></li>
          </ul>
        </div>

        <div class="p-header-nav__bottom__info">
          <ul class="p-header-nav__bottom__info__sns">
            <li><a href="https://line.me/R/ti/p/@971ursgn" target="_blank" class="is-line fade"></a></li>
            <li><a href="https://www.instagram.com/koshiengakuin_els?igsh=MTJ3cWNocDhteTFuZw==" target="_blank" class="is-instagram fade"></a></li>
            <li><a href="https://www.youtube.com/@koshiengakuin/shorts" target="_blank" class="is-youtube fade"></a></li>
          </ul>

          <ul class="p-header-nav__bottom__info__nav">
            <!-- <li><a href=""><span>緊急対応について</span></a></li> -->
            <li><a href="<?php echo home_url(); ?>/privacy-policy/"><span>個人情報保護方針</span></a></li>
          </ul>

          <p class="p-header-nav__bottom__info__copyright">Copyright © KOSHIEN GAKUIN. All Rights Reserved.</p>
        </div>
      </div>
    </div>



  </div>

</header>

<div class="p-header-overlay"></div>


<?php
// 入試情報のモーダル
?>
<div class="c-modal" id="modal-newinfo">
  <div class="c-modal__inner">
    <div class="c-modal__close js-modal-close"><span></span><span></span></div>
    <h3 class="c-modal__title font-marumin-old pc-mgb-30 sp-mgb-20">最新情報を受け取る</h3>
    <div class="pc-mgb-60 sp-mgb-30">
      <p class="c-modal__text u-ta-center">
        入試イベントや説明会、公開授業などの日程・詳細を、<br class="sp-none">LINEやメールでお知らせします。どなたでもご登録いただけます。<br class="sp-none">日常の学びの空気をそのまま感じていただけます。
      </p>
    </div>
    <div class="c-modal__btns">
      <a href="https://mirai-compass.net/usr/kosienge/event/evtIndex.jsf" target="_blank" class="c-btn c-btn--fill">
        <div class="c-btn__inner"><span>メールで受け取る</span></div>
      </a>
      <a href="https://line.me/R/ti/p/@971ursgn" target="_blank" class="c-btn c-btn--fill">
        <div class="c-btn__inner"><span>LINEで受け取る</span></div>
      </a>
    </div>
  </div>
  <div class="c-modal__bg js-modal-close"></div>
</div>

<?php
// 転入学のモーダル
?>
<div class="c-modal" id="modal-transfer">
  <div class="c-modal__inner">
    <div class="c-modal__close js-modal-close"><span></span><span></span></div>
    <h3 class="c-modal__title font-marumin-old pc-mgb-30 sp-mgb-20">転入学のご案内</h3>
    <div class="pc-mgb-60 sp-mgb-30">
      <p class="c-modal__text u-ta-center">
        <!-- 本校では一斉募集は行っておりませんが、<br class="pc-none">欠員状況やご事情に<br class="sp-none">合わせて、個別の<br class="pc-none">相談・受入を随時行っております。<br>
        まずはお気軽にお問い合わせください。 -->
        本校では、個別の相談・受け入れを随時行っています。<br>
        お気軽にお問い合わせください。
      </p>
    </div>

    <div class="c-modal__table">
      <ul class="">
        <li>
          <div>対象学年</div>
          <div>1年生～4年生</div>
        </li>
        <li>
          <div>選考日程</div>
          <div>ご相談の上、個別に試験・面接の日程を決定します。</div>
        </li>
      </ul>
    </div>

    <div class="pc-mgt-60 sp-mgt-30">
      <p class="c-modal__text u-ta-center pc-mgt-30 sp-mgt-20">
        お電話（<a href="tel:0798672366">0798-67-2366</a>）または<br>
        お問い合わせフォームより、<br class="pc-none">お気軽にご相談ください。
      </p>
    </div>
  </div>
  <div class="c-modal__bg js-modal-close"></div>
</div>



<div class="whopper">

  <?php get_template_part('./inc/kv'); ?>