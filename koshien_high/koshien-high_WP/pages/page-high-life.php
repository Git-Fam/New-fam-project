<?php
/*
Template Name: 学校生活（高校）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high-life  page--high-all">


  <section class="high-life-kv">
    <div class="high-life-kv-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-life/high-life-kv-bg-sp.webp" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-life/high-life-kv-bg-pc.webp" alt="好きを見つける毎日 学校生活">
      </picture>
    </div>
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-life/high-life-kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-life/high-life-kv-ttl-pc.svg" alt="好きを見つける毎日 学校生活">
      </picture>
    </h2>
  </section>


</main>


<?php get_template_part('./inc/footer'); ?>