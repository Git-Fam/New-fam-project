<?php
/*
Template Name: contact-confirm
Template Post Type: page
Template Path: pages/
*/

?>



<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="KV KV_contact"></div>

<!-- メイン -->
<main class="main">
  <div class="main__contact contact_confirm max-size-large">
    <div class="C_gra-vert-title">
      <h2 class="TL type-03">お問い合わせ</h2>
    </div>
    <div class="contact-wrap C_contact_confirm">
      <p class="contact-TL">
        ご入力いただいた内容に間違いがないか<br class="sp">確認をお願いいたします。
      </p>
      <?php
        echo do_shortcode('[contact-form-7 id="5475d1b" title="Contact-Confirm"]');
      ?>
    </div>
  </div>
</main>


<?php get_template_part('./inc/footer'); ?>