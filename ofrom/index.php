<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="front_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-bg.webp">
    </picture>
  </div>
  <h2 class="TL">
    <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-ttl.svg" alt="OFROM OFFROAD">
  </h2>
</div>

<main class="page_main_contents">
  <div class="page_front">
    <div class="not-found-txt">
      <p class="TX">404 Not Found</p>
    </div>
  </div>
</main>


<?php get_template_part('./inc/footer'); ?>