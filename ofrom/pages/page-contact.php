<?php
/*
Template Name: contact
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="contact_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/contact/contact_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/contact/contact_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/contact/contact_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/contact/contact_kv-ttl.svg" alt="CONTACT / お問い合わせ">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_form">

    <section class="contact_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <h3 class="TL">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/form/contact-ttl-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/form/contact-ttl.svg" alt="CONTACT FORM / お問い合わせフォーム">
            </picture>
          </h3>
        </div>
        <div class="txt_area s-pop">
          <p class="TX">
            当社にご興味をもっていただき<br class="sp">誠にありがとうございます。<br>
            設計・部品調達・実装から組立まで<br class="sp">お気軽にお問い合わせください。
          </p>
        </div>
        <div class="form_area s-pop">

          <?php echo do_shortcode('[contact-form-7 id="c6e7c65" title="contact"]'); ?>

        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>