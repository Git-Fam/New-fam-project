<?php wp_footer(); ?>

<?php
// 現在ページの最上位の親slug（junior/high 配下判定用）
$top_slug = '';
if (is_page()) {
    $ancestors = get_post_ancestors(get_the_ID());
    $top_id    = $ancestors ? end($ancestors) : get_the_ID();
    $top_slug  = get_post_field('post_name', $top_id);
}

// CONTACTを非表示にする条件
$hide_contact =
    is_page(array('contact', 'contact/confirm', 'contact/thanks'))
    || is_404()
    || (is_home() && !is_front_page()) || is_singular('post') || is_post_type_archive('post')
    || $top_slug === 'junior'
    || $top_slug === 'high';
?>

<footer class="footer">

  <?php if (!$hide_contact) : ?>
  <!-- ============ CONTACT ============ -->
  <section class="l-contact js-fade">
    <picture class="l-contact__bg">
      <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/footer/contact_sp.webp">
      <img src="<?php echo get_template_directory_uri(); ?>/img/footer/contact_pc.webp" alt="CONTACT お問い合わせ" class="l-contact__bg-img">
    </picture>
    <div class="l-contact__btns">
      <a href="<?php echo home_url('/contact/'); ?>" class="l-contact__btn l-contact__btn--form">
        <span>お問い合わせフォーム</span>
        <span class="l-contact__btn-icon" aria-hidden="true"></span>
      </a>
      <a href="<?php echo home_url('/request/'); ?>" class="l-contact__btn l-contact__btn--request">
        <span>資料請求</span>
        <span class="l-contact__btn-icon" aria-hidden="true"></span>
      </a>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============ footer 本体 ============ -->
  <div class="l-footer">
    <div class="l-footer__inner js-fade">
      <a href="<?php echo home_url('/'); ?>" class="l-footer__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-logo.webp" alt="甲子園学院中学校・高等学校 / 学ぶことは、心を磨くこと" class="l-footer__logo-img">
      </a>

      <p class="l-footer__address">
        〒663-8107 兵庫県西宮市瓦林町4番25号　TEL 0798-65-6100
      </p>

      <nav class="l-footer__group">
        <ul>
          <li style="justify-self: end;">
            <a href="https://www.koshien.ac.jp/" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-01.webp" alt="甲子園大学">
            </a>
          </li>
          <li>
            <a href="https://www.koshien-c.ac.jp/" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-02.webp" alt="甲子園短期大学">
            </a>
          </li>
          <li>
            <a href="https://www.koshiengakuin-e.ed.jp/" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-05.webp" alt="甲子園学院小学校">
            </a>
          </li>
          <li>
            <a href="https://www.koshiengakuin-k.ed.jp/" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-06.webp" alt="甲子園学院幼稚園">
            </a>
          </li>
        </ul>
      </nav>

      <p class="l-footer__copy">Copyright © Koshiengakuin. All Rights Reserved.</p>
    </div>
  </div>

</footer>

</div>
<!-- ▼Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>

<?php if (is_page('high')) : ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/high.js"></script>
<?php endif; ?>


</body>

</html>