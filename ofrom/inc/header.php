    <!-- .def-colorなし：透明→色あり、.def-colorあり：色あり→色あり -->
    <header class="header <?php if (is_page("offroad") || is_page("message") || is_archive() || is_single() || is_page("english")): ?>def-color<?php endif; ?>">


      <div class="header_bg"></div>
      <div class="header_inner  <?php if (is_front_page()): ?>is-loading<?php endif; ?>">
        <h1 class="TL">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/header/logo-main.svg" alt="OFROM">
          </a>
        </h1>
        <div class="nav_wrap">
          <nav class="inner_nav pc">
            <ul>
              <li><a href="<?php echo home_url('/offroad'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-01.webp" alt="STATEMENT"></a></li>
              <li><a href="<?php echo home_url('/strength'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-02.webp" alt="OUR STRENGTH"></a></li>
              <li><a href="<?php echo home_url('/factory'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-03.webp" alt="FACTORY"></a></li>
              <li><a href="<?php echo home_url('/recruit-index'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-04.webp" alt="RECRUIT"></a></li>
              <li><a href="<?php echo home_url('/company'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-05.webp" alt="ABOUT US"></a></li>
              <li><a href="<?php echo home_url('/contact'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-06.webp" alt="CONTACT"></a></li>
              <li><a href="<?php echo home_url('/english'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-07.webp" alt="ENGLISH"></a></li>
            </ul>
          </nav>
          <div class="burger h-opa">
            <img src="<?php echo get_template_directory_uri(); ?>/img/header/burger.svg">
          </div>
        </div>
      </div>
      <div class="header_menu">
        <div class="header_menu_inner_wrap">
          <div class="header_menu_inner">
            <nav class="menu-nav">
              <ul class="menu-nav_list">
                <!-- 01 -->
                <li class="item">
                  <div class="ttl">
                    <a href="<?php echo home_url('/offroad'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-01.webp" alt="STATEMENT"></a>
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
                    <a href="<?php echo home_url('/strength'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-02.webp" alt="OUR STRENGTH"></a>
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
                    <a href="<?php echo home_url('/factory'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-03.webp" alt="FACTORY"></a>
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
                    <a href="<?php echo home_url('/recruit-index'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-04.webp" alt="RECRUIT"></a>
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
                    <a href="<?php echo home_url('/company'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-05.webp" alt="ABOUT US"></a>
                  </div>
                  <ul class="txt">
                    <li class="txt_item">
                      <a href="<?php echo home_url('/company'); ?>">会社概要・沿革</a>
                    </li>
                    <li class="txt_item">
                      <a href="<?php echo home_url('/company#company_sec_04'); ?>">アクセス</a>
                    </li>
                    <li class="txt_item">
                      <a href="<?php echo home_url('/security'); ?>">情報セキュリティー基本方針</a>
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
                    <a href="<?php echo home_url('/sdgs'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-08.webp" alt="SDGs"></a>
                  </div>
                  <ul class="txt">
                    <li class="txt_item">
                      <a href="<?php echo home_url('/sdgs'); ?>">SDGs宣言</a>
                    </li>
                  </ul>
                </li>
                <!-- 06 -->
                <li class="item">
                  <div class="ttl">
                    <a href="<?php echo home_url('/english'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/header/menu-txt-07.webp" alt="ENGLISH"></a>
                  </div>
                  <ul class="txt">
                    <li class="txt_item">
                      <a href="<?php echo home_url('/english'); ?>">ENGLISH PAGE</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <div class="menu-ad pc">
              <div class="sns_area">
                <a href="https://www.instagram.com/ofrom.official/" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/header/Instagram.svg" alt="Instagram">
                </a>
              </div>
              <div class="ad_area">
                <ul>
                  <li>
                    <a href="<?php echo get_template_directory_uri(); ?>/img/pdf/General-Employer-Action-Plan.pdf" target="_blank" rel="noopener noreferrer">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-01.webp" alt="一般事業主行動計画">
                    </a>
                  </li>
                  <li>
                    <a href="https://ryouritsu.mhlw.go.jp/" target="_blank" rel="noopener noreferrer">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/header/ad-02.webp" alt="仕事と家庭、両立しよう！両立支援のひろば">
                    </a>
                  </li>
                  <li>
                    <a href="https://joseikatuyaku.pref.fukui.lg.jp/" target="_blank" rel="noopener noreferrer">
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
          </div>
        </div>
      </div>
    </header>

    <div class="whopper">