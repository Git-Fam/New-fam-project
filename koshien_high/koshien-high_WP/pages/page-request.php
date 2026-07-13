<?php
/*
Template Name: 資料請求
Template Post Type: page
Template Path: pages/
*/
?>

<!-- CSSはcontactと共通 -->

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--request">
  <section class="p-contact">
    <div class="p-request__head js-fade">
      <picture>
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/contact/request-ttl.webp" alt="request　資料請求フォーム">
      </picture>
    </div>

    <div class="p-contact__body js-fade">
      <?php the_content(); // 入力フォームのショートコード ?>
    </div>

  <!-- お電話・FAX -->
   <div class="p-contact-tel js-fade">
        <p class="p-contact-tel__ttl">お電話・FAXはこちら</p>
        <div class="p-alumni__info-row">
          <a href="tel:0798-65-6100" class="p-alumni__info-tel">
            <span class="p-alumni__info-icon p-alumni__info-icon--tel" aria-hidden="true"></span>
           0798-65-6100
          </a>
          <p class="p-alumni__info-mail">
            <span class="p-alumni__info-icon p-alumni__info-icon--fax" aria-hidden="true"></span>
            0798-67-8157
          </p>
        </div>
      </div>

  </section>
</main>


<?php get_template_part('./inc/footer'); ?>
