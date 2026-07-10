<?php
/*
Template Name: お問い合わせ完了
Template Post Type: page
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="page page--contact-thanks">
  <section class="p-thanks">
    <div class="p-thanks__card">
      <h1 class="p-thanks__ttl">THANK YOU!</h1>
      <p class="p-thanks__text">
        送信が完了しました。<br>
        お問い合わせありがとうございます。<br>
        内容を確認のうえ、<br class="sp">担当者より改めてご連絡します。
      </p>
      <a href="<?php echo home_url('/'); ?>" class="p-thanks__btn">
        <span class="p-thanks__btn-txt">TOPへ</span>
        <span class="p-thanks__btn-icon" aria-hidden="true"></span>
      </a>
    </div>
  </section>
</main>

<?php get_template_part('./inc/footer'); ?>
