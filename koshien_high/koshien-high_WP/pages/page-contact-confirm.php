<?php
/*
Template Name: 資料請求・お問い合わせ 確認
Template Post Type: page
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="page page--contact">
  <section class="p-contact p-contact--confirm">

    <div class="p-contact__body">

    <p class="p-contact__lead">入力内容にお間違いがないかご確認ください。</p>
      <?php the_content(); // 確認フォームのショートコード ?>
    </div>
  </section>

 
</main>

<?php get_template_part('./inc/footer'); ?>