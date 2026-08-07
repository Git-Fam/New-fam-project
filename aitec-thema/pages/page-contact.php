<?php
/*
Template Name: お問い合わせ
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="contact-page">


  <section class="contact-page__content">
    <div class="contact-page__content-inr">

      <div class="contact-page__text">
        <p class="contact-page__label loadDown">CONTACT</p>
        <h2 class="contact-page__title loadDown">お問い合わせ</h2>
        <p class="contact-page__desc loadDown">
          サービスに関するご質問やご相談など、<br>
          お気軽にお問い合わせください。
        </p>
      </div>

      <div class="C_form loadUp">
        <?php echo do_shortcode('[contact-form-7 id="ee99720" title="contact"]'); ?>


<!-- <form action="" method="post">

<div class="C_form-row-wrap">
<div class="C_form-row">
<label class="C_form-label" for="company">会社名</label>
<input class="C_form-input" type="text" id="company" name="company">
</div>

<div class="C_form-row">
<label class="C_form-label" for="name">氏名</label>
<input class="C_form-input" type="text" id="name" name="name">
</div>

<div class="C_form-row">
<label class="C_form-label" for="email">メールアドレス</label>
<input class="C_form-input" type="email" id="email" name="email">
</div>

<div class="C_form-row C_form-row--textarea">
<label class="C_form-label" for="message">お問い合わせ内容</label>
<textarea class="C_form-textarea" id="message" name="message"></textarea>
</div>

<div class="C_form-agree">
<input class="C_form-checkbox" type="checkbox" id="agree" name="agree">
<label class="C_form-agree-label" for="agree">プライバシーポリシーに同意する</label>
</div>

<button type="submit" class="C_form-submit hover-opa">送信する</button>

</div>
</form> -->


      </div>

    </div>
  </section>

</div>

<?php get_template_part('./inc/footer'); ?>