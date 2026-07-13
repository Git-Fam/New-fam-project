<?php
/*
Template Name: 資料請求・お問い合わせ
Template Post Type: page
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="page page--contact">
  <section class="p-contact">
    <div class="p-contact__head js-fade">
      <picture>
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/contact/contact-ttl.webp" alt="contact　お問い合わせフォーム">
      </picture>
    </div>

    <div class="p-contact__body js-fade">
      <?php the_content();
// 入力フォームのショートコード
?>
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

      <!-- パンフレット -->
      <div class="p-contact-pamphlet js-form-pamphlet" style="display:none;">
      <div class="p-contact-pamphlet__img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/contact/digital-p.webp" alt="2025年度デジタルパンフレット">
      </div>
      <div class="p-contact-pamphlet__body js-fade">
        <p class="p-contact-pamphlet__ttl">2025年度<br>デジタルパンフレット<br>はこちら！</p>
        <a href="https://www.koshiengakuin-h.ed.jp/document/pamphlet/pamphlet.pdf" class="p-contact-pamphlet__btn" target="_blank" rel="noopener noreferrer">
          <span>PDFを開く</span>
          <span class="p-contact-pamphlet__btn-icon" aria-hidden="true"></span>
        </a>
      </div>
    </div>
     </section>
</main>

<?php get_template_part('./inc/footer'); ?>
