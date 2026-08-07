<?php wp_footer(); ?>

<footer class="footer">
  <div class="footer__inner">
    <div class="footer__top">
      <div class="footer__top-inner">
        <a href="<?php echo home_url(); ?>" class="footer__logo hover-opa">aitec</a>

        <nav class="footer__nav">
          <ul class="footer__list">
            <li class="footer__item"><a href="/service" class="footer__link hover-opa">サービス</a></li>
            <li class="footer__item"><a href="/about" class="footer__link hover-opa">会社概要</a></li>
            <li class="footer__item"><a href="/contact" class="footer__link hover-opa">お問い合わせ</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="footer__bottom">
      <div class="footer__bottom-inner">
        <p class="footer__copyright">©aitec.inc</p>
      </div>
    </div>
  </div>
</footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
</body>

</html>