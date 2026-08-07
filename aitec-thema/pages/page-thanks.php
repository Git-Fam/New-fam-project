<?php
/*
Template Name: お問い合わせ完了
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="thanks-page">

  <section class="thanks-page__content">
    <div class="thanks-page__content-inr">

      <img class="thanks-page__icon" src="<?php echo get_template_directory_uri(); ?>/img/thanks/check-icon.svg" alt="">

      <h2 class="thanks-page__title">送信が完了しました</h2>

      <p class="thanks-page__desc">
        お問い合わせいただき、<br class="sp">誠にありがとうございます。<br>
        内容を確認のうえ、<br class="sp">担当者よりご連絡いたします。
      </p>

      <a href="<?php echo home_url(); ?>" class="thanks-page__link hover-opa">
        <span class="thanks-page__link-text">トップページに戻る</span>
        <span class="thanks-page__link-arrow">→</span>
      </a>

    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>