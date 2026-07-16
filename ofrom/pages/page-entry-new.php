<?php
/*
Template Name: entry-new
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="requirements_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-ttl.svg" alt="RECRUIT / 採用情報">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_form">

    <section class="entry-new_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <h3 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/form/entry-new-ttl.svg" alt="ENTRY / 新卒採用エントリー">
          </h3>
        </div>
        <div class="form_area s-pop">

          <?php echo do_shortcode('[contact-form-7 id="527c8c2" title="entry-new"]'); ?>

        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>