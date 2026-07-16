<?php wp_footer(); ?>

<?php if (is_page("english")): ?>

  <footer class="footer english_footer">
    <p class="TX">Copyright(c) OFROM.co.ltd. All Right Reserved.</p>
  </footer>

<?php else: ?>

  <footer class="footer">

    <?php if (!is_page("policy") && !is_page("contact") && !is_page("security")): ?>
      <div class="contact_banner" id="contact-banner" <?php if (is_page("factory") || is_page("company")): ?> style="background-color: #FFF;" <?php endif; ?>>
        <div class="contact_banner_inner s-pop">
          <div class="txt_area">
            <div class="ttl">
              <h3 class="TL"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/contact-banner-ttl.svg" alt="CONTACT"></h3>
              <p class="TX">お問い合わせ</p>
            </div>
            <div class="txt">
              <p class="TX">
                当社にご興味をもっていただき<br class="sp">誠にありがとうございます。<br>
                設計・部品調達・実装から組立まで<br class="sp">お気軽にお問い合わせください。
              </p>
            </div>
          </div>
          <a href="<?php echo home_url('/contact'); ?>" class="btn">
            <img src="<?php echo get_template_directory_uri(); ?>/img/footer/contact-banner-btn.svg" alt="CONTACT FORM">
          </a>
        </div>
      </div>
    <?php endif; ?>

    <div class="footer_main">
      <div class="footer_main_inner">
        <div class="nav_area">
          <div class="info_item">
            <div class="logo">
              <p class="TX">
                <img src="<?php echo get_template_directory_uri(); ?>/img/header/logo-main.svg" alt="OFROM">
              </p>
            </div>
            <div class="txt">
              <p class="TX">
                オフロム株式会社<br>
                〒910-3608 福井県福井市三留町72字10番地<br>
                TEL .0776-98-3800　FAX 0776-98-3598<br>
                E-mail ofrom.co.ltd@ofrom.com
              </p>
            </div>
          </div>
          <nav class="nav_item pc">
            <ul class="menu-nav_list">
              <!-- 01 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/offroad'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-01.svg" alt="STATEMENT"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/offroad'); ?>">オフロム オフロード</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/message'); ?>">トップメッセージ</a>
                  </li>
                </ul>
              </li>
              <!-- 02 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/strength'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-02.svg" alt="OUR STRENGTH"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/strength'); ?>">オフロムの強み</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/product'); ?>">製品紹介</a>
                  </li>
                </ul>
              </li>
              <!-- 03 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/factory'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-03.svg" alt="FACTORY"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/factory'); ?>">工場・設備</a>
                  </li>
                </ul>
              </li>
              <!-- 04 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/recruit-index'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-04.svg" alt="RECRUIT"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/recruit-index'); ?>">リクルートインデックス</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/requirements'); ?>">募集要項・採用職種</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/entry-new'); ?>">新卒採用エントリー</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/entry-mid'); ?>">中途採用エントリー</a>
                  </li>
                </ul>
              </li>
              <!-- 05 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/company'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-05.svg" alt="ABOUT US"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/company'); ?>">会社概要・沿革</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/company#company_sec_04'); ?>">アクセス</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/security'); ?>">情報セキュリティー基本方針</a></a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/policy'); ?>">プライバシーポリシー</a>
                  </li>
                  <li class="txt_item">
                    <a href="<?php echo home_url('/contact'); ?>">お問い合わせ</a>
                  </li>
                </ul>
              </li>
              <!-- 05.5 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/sdgs'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-07.svg" alt="SDGs"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/sdgs'); ?>">SDGs宣言
                    </a>
                  </li>
                </ul>
              </li>
              <!-- 06 -->
              <li class="item">
                <div class="ttl">
                  <a href="<?php echo home_url('/english'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/nav-txt-06.svg" alt="ENGLISH"></a>
                </div>
                <ul class="txt">
                  <li class="txt_item">
                    <a href="<?php echo home_url('/english'); ?>">ENGLISH PAGE</a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <div class="ad_area pc">
          <div class="sns_item">
            <a href="https://www.instagram.com/ofrom.official/" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/img/header/Instagram.svg" alt="Instagram">
            </a>
          </div>
          <div class="ad_item">
            <ul>
              <li>
                <a href="<?php echo get_template_directory_uri(); ?>/img/pdf/General-Employer-Action-Plan.pdf" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-01.webp" alt="一般事業主行動計画">
                </a>
              </li>
              <li>
                <a href="https://ryouritsu.mhlw.go.jp/"" target=" _blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-02.webp" alt="仕事と家庭、両立しよう！両立支援のひろば">
                </a>
              </li>
              <li>
                <a href="https://joseikatuyaku.pref.fukui.lg.jp/"" target=" _blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-03.webp" alt="ふくい女性活躍net">
                </a>
              </li>
              <li class="f-size">
                <a href="" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-04.webp" alt="オフロム株式会社は、福井ブローウィンズを応援しています。">
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="copy_area">
          <p class="TX">
            Copyright © 2026 OFROM All Rights Reserved.
          </p>
        </div>
      </div>
    </div>
  </footer>

<?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php if (is_front_page()): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/front.js"></script>
<?php endif; ?>
<?php if (is_page("strength")): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/strength.js"></script>
<?php endif; ?>
<?php if (is_page("company")): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/company.js"></script>
<?php endif; ?>
<?php if (is_page("factory")): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/factory.js"></script>
<?php endif; ?>
<?php if (is_page("english")): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/english.js"></script>
<?php endif; ?>
<?php if (is_singular('recruit')): ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/single-recruit.js"></script>
<?php endif; ?>
</body>

</html>