<?php wp_footer(); ?>

<!-- 共有 これ以下 -->
</main>
<footer class="footer <?php if (is_front_page()): ?> is-front-footer<?php endif; ?> <?php if (is_page('about')): ?> is-about-footer<?php endif; ?>">
  <!--
      下の場合は『is-under』
      上の場合は『is-above』
  -->
  <div class="footer_char_by_page is-under">
    <div class="img">
      <!-- <?php if (is_front_page()): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_front.webp" alt="">
      <?php endif; ?> -->
      <!-- <?php if (is_page('about')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_about.webp" alt="">
      <?php endif; ?> -->
      <?php if (is_page('nocturia')): ?>
        <img class="fuwafuwa duration-11 delay-03" src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_night-urine.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('about-surgery')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_operation.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('constipation')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_constipation.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('pediatrics')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_pediatrics.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('home-visit')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_home-visit.webp" alt="">
      <?php endif; ?>
      <?php if (is_archive('news')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_news.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('faq')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_faq.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('recruit')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_recruitment.webp" alt="">
      <?php endif; ?>
      <?php if (is_page('contact')): ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/page_by_contact.webp" alt="">
      <?php endif; ?>
    </div>
  </div>
  <div class="footer-main">
    <div class="footer-bg">
      <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-bg.webp" alt="">
    </div>
    <div class="footer-inr">
      <div class="footer-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-l-logo.svg" alt="つばさこども医院 小児外科/小児科">
      </div>
      <div class="footer-schedule">
        <?php get_template_part('inc/schedule-board'); ?>
      </div>
      <div class="footer-scroll-char">
        <div class="scroll-char-wrap">
          <div class="scroll-char-inr">
            <div class="scroll-char-group">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-01.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-02.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-03.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-04.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-05.png" alt="">
            </div>
            <div class="scroll-char-group" aria-hidden="true">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-01.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-02.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-03.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-04.png" alt="">
              <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-scroll-char-05.png" alt="">
            </div>
          </div>

        </div>
      </div>
      <div class="footer-footer-copyright-bg">
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-footer-copyright-bg.webp" alt="">
      </div>
      <div class="footer-copyright">
        <p class="TX">
          © TSUBASA KODOMO CLINIC Co. Ltd. All Rights Reserved.
        </p>
      </div>
    </div>
  </div>
</footer>
</div>

<?php get_template_part('inc/side-r'); ?>

</div>



<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>

<?php if (is_front_page()): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/front.js"></script>
<?php endif; ?>
<?php if (is_page('about')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>
<?php endif; ?>
<?php if (is_page('nocturia')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/nocturia.js"></script>
<?php endif; ?>
<?php if (is_page('constipation')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/constipation.js"></script>
<?php endif; ?>
<?php if (is_page('pediatric-surgery')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/pediatric-surgery.js"></script>
<?php endif; ?>
<?php if (is_page('pediatrics')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/pediatrics.js"></script>
<?php endif; ?>
<?php if (is_page('prevention-screening')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/prevention-screening.js"></script>
<?php endif; ?>
<?php if (is_page('home-visit')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/home-visit.js"></script>
<?php endif; ?>
<?php if (is_page('about-surgery')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/about-surgery.js"></script>
<?php endif; ?>
<?php if (is_archive('news')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/news.js"></script>
<?php endif; ?>
<?php if (is_page('faq')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/faq.js"></script>
<?php endif; ?>
<?php if (is_page('recruit')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/recruit.js"></script>
<?php endif; ?>
<?php if (is_page('contact')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/contact.js"></script>
<?php endif; ?>
<?php if (is_page('privacy-policy')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/privacy-policy.js"></script>
<?php endif; ?>

</body>

</html>