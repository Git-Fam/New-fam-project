<?php wp_footer(); ?>

<footer class="footer">
  <?php if (is_front_page() || is_404()): ?>
    <!-- フロントページだけ表示 --start -->
    <div class="footer--nav anime-fade">
      <nav>
        <ul>
          <li>
            <a class="hover-opa" href="<?php echo home_url('/info'); ?>">
              <div class="link--inner">
                <p class="TX">公開情報</p>
                <span class="en">INFO</span>
              </div>
            </a>
          </li>
          <li>
            <a class="hover-opa" href="<?php echo home_url('/donation'); ?>">
              <div class="link--inner">
                <p class="TX">教育振興基金への寄付のお願い</p>
                <span class="en">DONATION</span>
              </div>
            </a>
          </li>
          <li>
            <a class="hover-opa" href="<?php echo home_url('/art'); ?>">
              <div class="link--inner">
                <p class="TX">美術資料館<span class="TX-span">久米アートミュージアム</span></p>
                <span class="en">ART MUSEUM</span>
              </div>
            </a>
          </li>
          <li>
            <a class="hover-opa" href="<?php echo home_url('/access'); ?>">
              <div class="link--inner">
                <p class="TX">アクセス</p>
                <spa class="en">ACCESS</spa>
              </div>
            </a>
          </li>
          <li>
            <a class="hover-opa" href="<?php echo home_url('/contact'); ?>">
              <div class="link--inner">
                <p class="TX">お問い合わせ</p>
                <span class="en">CONTACT</span>
              </div>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- フロントページだけ表示 --end -->
  <?php endif; ?>

  <!-- フロントページ以外表示 --start -->
  <?php if (is_page('message') || is_page('special') || is_page('about') || is_page('recruit') || is_page('info')|| is_page('art') || is_page('access') || is_page('contact')): ?>
    <div class="footer--banner anime-fade footer--other--bg">
    <?php else: ?>
      <div class="footer--banner anime-fade">
      <?php endif; ?>

      <?php if (!is_front_page() && !is_404()): ?>
        <div class="ttl">
          <h3 class="TL">OTHER CONTENTS</h3>
        </div>
      <?php endif; ?>
      <div class="banners">
        <ul>
          <!-- インタビュー -->
          <!-- 表示：
                            お知らせ(1)、
                            99YEARS VISION(1)、
                            MESSAGE(1)、
                            甲子園学院について(1)、
                            採用(1)、
                            公開情報 (1) 、
                            教育振興基金への寄付のお願い(1)、
                            美術資料館(1)、
                            ACCESS(1)、
                            お問い合わせ(1)
                        -->

          <?php if (is_archive('news') || is_single() || is_page('vision') || is_page('message') || is_page('about') || is_page('recruit') || is_page('info') || is_page('donation') || is_page('art') || is_page('access') || is_page('contact') || is_page('policy')): ?>
            <li>
              <a class="hover-opa" href="<?php echo home_url('/special'); ?>">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-01-pc.webp" media="(min-width: 768px)"
                    type="image/svg+xml">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-01-sp.webp" alt="卒業生・教職員インタビュー">
                </picture>
                <p class="TX">卒業生・教職員インタビュー</p>
              </a>
            </li>
          <?php endif; ?>


          <!-- ビジョンプロジェクト -->
          <!-- 表示：
                            お知らせ(2)、
                            MESSAGE(2)、
                            SPECIAL(1)、
                            甲子園学院について(2)、
                            採用(2)、
                            公開情報 (2) 、
                            教育振興基金への寄付のお願い(2)、
                            美術資料館(2)、
                            ACCESS(2)、
                            お問い合わせ(2)
                        -->

          <?php if (is_archive('news') || is_single() || is_page('message') || is_page('special') || is_page('about') || is_page('info') || is_page('recruit') || is_page('info') || is_page('donation') || is_page('art') || is_page('access') || is_page('contact') || is_page('policy')): ?>
            <li>
              <a class="hover-opa" href="<?php echo home_url('/vision'); ?>">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-02-pc.webp" media="(min-width: 768px)"
                    type="image/svg+xml">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-02-sp.webp" alt="甲子園学院 99年ビジョンプロジェクト">
                </picture>
                <p class="TX">甲子園学院 99年ビジョンプロジェクト</p>
              </a>
            </li>
          <?php endif; ?>

          <!-- 理事長メッセージ -->
          <!-- 表示：
                            99YEARS VISION(2)、
                            SPECIAL(2)、
                            採用(3) 
                        -->

          <?php if (is_page('vision') || is_page('special') || is_page('recruit')): ?>
            <li>
              <a class="hover-opa" href="<?php echo home_url('/message'); ?>">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-03-pc.webp" media="(min-width: 768px)"
                    type="image/svg+xml">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-03-sp.webp" alt="理事長メッセージ">
                </picture>
                <p class="TX">理事長メッセージ</p>
              </a>
            </li>
          <?php endif; ?>
          <!-- 採用情報 -->
          <!-- 表示：
                            お知らせ(3)、
                            99YEARS VISION(3)、
                            MESSAGE(3)、
                            SPECIAL(3)、
                            甲子園学院について(3)、
                            公開情報 (3) 、
                            教育振興基金への寄付のお願い(3)、
                            美術資料館(3)、
                            ACCESS(3)、
                            お問い合わせ(3)
                        -->

          <?php if (is_archive('news') || is_single() || is_page('vision') || is_page('message') || is_page('special') || is_page('about') || is_page('info') || is_page('donation') || is_page('art') || is_page('access') || is_page('contact') || is_page('policy')): ?>
            <li>
              <a class="hover-opa" href="<?php echo home_url('/recruit'); ?>">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-04-pc.webp" media="(min-width: 768px)"
                    type="image/svg+xml">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-banner-04-sp.webp" alt="採用情報">
                </picture>
                <p class="TX">採用情報</p>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
      </div>
      <!-- フロントページ以外表示 --end -->

      <div class="footer--inner">
        <div class="logo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-logo.svg" alt="甲子園学院ロゴ / 学ぶことは、心を磨くこと / 甲子園学院 / KOSHIEN GAKUIN">
        </div>
        <div class="info">
          <p class="TX">
            〒663-8107 兵庫県西宮市瓦林町4-25<br>
            Tel 0798-67-2100
          </p>
        </div>
        <nav class="nav">
          <ul>
            <li>
              <a class="img-link-01 hover-opa" href="https://www.koshien.ac.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-01.webp" alt="甲子園大学">
              </a>
            </li>
            <li>
              <a class="img-link-02 hover-opa" href="https://www.koshien-c.ac.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-02.webp" alt="甲子園短期大学">
              </a>
            </li>
            <!-- <li>
              <a class="img-link-03 hover-opa" href="https://www.koshiengakuin-e.ed.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-03.webp" alt="甲子園学院高等学校">
              </a>
            </li> -->
            <li>
              <a class="img-link-04 hover-opa" href="https://www.koshiengakuin-h.ed.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-04.webp" alt="甲子園学院中学校・高等学校"> 
              </a>
            </li>
            <li>
              <a class="img-link-05 hover-opa" href="https://www.koshiengakuin-e.ed.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-05.webp" alt="甲子園学院小学校">
              </a>
            </li>
            <li>
              <a class="img-link-06 hover-opa" href="https://www.koshiengakuin-k.ed.jp/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-06.webp" alt="甲子園学院幼稚園">
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="copyright">
        <p class="TX">Copyright © Koshiengakuin. All Rights Reserved.</p>
      </div>
</footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>

<?php if (is_front_page()): ?>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/front.js"></script>
<?php endif; ?>

<?php if (is_archive('news')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/archive.js"></script>
<?php endif; ?>

<?php if (is_page('vision')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/vision.js"></script>
<?php endif; ?>

<?php if (is_page('about')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>
<?php endif; ?>

<?php if (is_page('special')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/special.js"></script>
<?php endif; ?>

<?php if (is_page('recruit')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/recruit.js"></script>
<?php endif; ?>


</body>

</html>