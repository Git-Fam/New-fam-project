<?php
/*
Template Name: terms
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>
<?php get_template_part('./inc/kv'); ?>

<main class="main">
  <div class="main__inner">

    <section class="C_other-contents">
      <div class="title">
        <h1 class="TL">利用規約</h1>
      </div>
      <div class="C_other-contents--container container__archive">
        <div class="C_other-contents--container--inner">

          <div class="custom_text">
            <p><?php echo post_custom('terms_text'); ?></p>
          </div>
          
        </div>
      </div>
    </section>


    <?php get_template_part('./inc/banner'); ?>
  </div>
</main>

<?php get_template_part('./inc/footer'); ?>