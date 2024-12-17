<?php
/*
Template Name: contact
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="KV KV_contact"></div>

<!-- メイン -->
<main class="main">
  <div class="main__contact contact_form max-size-large">
    <div class="C_gra-vert-title">
      <h2 class="TL type-03">お問い合わせ</h2>
    </div>

    <div class="contact-wrap C_contact_form">
      <p class="contact-TL">
        ご質問やご相談がありましたら、<br class="sp">下のフォームからお気軽に<br class="sp">お問い合わせください。<br>
        数日中に担当者よりご連絡いたします。
      </p>
      <?php
        echo do_shortcode('[contact-form-7 id="07b0658" title="Contact form"]');
      ?>
    </div>
  </div>
</main>


<?php get_template_part('./inc/footer'); ?>