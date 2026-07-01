<?php get_template_part('global-parts/header'); ?>

<main class="contact">

  <div class="contact__bgbg01">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/contact-bgbg01.webp">
  </div>
  <div class="contact__bgbg02">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/contact-bgbg02.webp">
  </div>

  <!-- PAGE HEADER -->
  <section class="page-header contact__header">
    <div class="page-header__inner">
      <h1 class="page-header__title up">CONTACT</h1>
      <p class="page-header__sub up">お問い合わせ</p>
    </div>
  </section>

   <!-- リード文 -->
  <div class="contact__lead js-text-reveal">
    <p><span>弊社にご関心をお持ちいただき、ありがとうございます。<span>
    <span>制作・開発料金のお見積もり、サービスに関するご相談など、お気軽にお問い合わせください。<span>
    <span>お問い合わせ内容を確認後、担当者よりご連絡いたします。</span></p>
  </div>

  <!-- CF7フォーム -->
  <div class="contact__form">

    <!-- 入力画面 -->
    <div class="cf7-form-area">
      <?php echo do_shortcode('[contact-form-7 id="a3579ba" title="お問い合わせ"]'); ?>
      <div class="cf7-confirm-wrap">
        <button class="cf7-confirm-btn" type="button">確認画面へ</button>
      </div>
    </div>

    <!-- 確認画面（初期非表示） -->
    <div class="cf7-confirm-area" style="display:none;">
      <div class="wpcf7">
        <p class="cf7-confirm-lead">以下の内容で送信いたします。<br>お間違いがないかご確認ください。</p>
        <p class="cf7-confirm-lead">内容に修正がある場合は「戻る」ボタンより<br class="sp">ご修正ください。<br>問題がなければ「送信する」ボタンを押してください。</p>
        <table class="cf7-confirm-table">
          <tbody></tbody>
        </table>
        <div class="cf7-confirm-btns">
          <button class="cf7-back-btn" type="button">戻る</button>
          <button class="cf7-send-btn" type="button">送信する</button>
        </div>
      </div>
    </div>

  </div>

</main>

<?php get_template_part('global-parts/footer'); ?>