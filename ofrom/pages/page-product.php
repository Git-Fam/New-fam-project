<?php
/*
Template Name: product
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="product_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/product/product_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/product/product_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/product/product_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/product/product_kv-ttl.svg" alt="PRODUCT / 製品紹介">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_product">

    <section class="product_promise">
      <h3 class="TL s-pop">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/product/product_promise-ttl-sp.svg" media="(max-width: 767px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/product/product_promise-ttl.svg"
            alt="WORLD STANDARD / 設計・製造・品質管理まで世界基準のクオリティを約束します。">
        </picture>
      </h3>
    </section>

    <section id="product_sec_01" class="product_type-01_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-01.svg" alt="01"></p>
              <h3 class="TL">受託生産品／産業用センサ関連</h3>
            </div>
            <p class="TX">オフロムだから実現できる<br class="sp">センサ高精度を生み出す技術</p>
          </div>
        </div>
        <div class="contents_area">
          <ul class="lists_area s-pop">
            <!-- 01 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-01.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">変位センサ</p>
              </div>
            </li>
            <!-- 02 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-02.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">段差判別センサ</p>
              </div>
            </li>
            <!-- 03 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-03.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">画像センサ</p>
              </div>
            </li>
            <!-- 04 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-04.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">形状測定センサ</p>
              </div>
            </li>
            <!-- 05 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-05.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">光電センサ</p>
              </div>
            </li>
            <!-- 06 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-06.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">分離型 変位センサ</p>
              </div>
            </li>
            <!-- 07 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-07.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">LED RING 照明</p>
              </div>
            </li>
            <!-- 08 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-01-08.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">LED BAR 照明</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section id="product_sec_02" class="product_type-01_section product_type-color">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-02.svg" alt="02"></p>
              <h3 class="TL">受託生産品／セキュリティ関連</h3>
            </div>
            <p class="TX">暮らしの安心・安全を支える技術と製品</p>
          </div>
        </div>
        <div class="contents_area">
          <ul class="lists_area s-pop">
            <!-- 01 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-01.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">屋内用／天井取付<br>パッシブセンサ</p>
              </div>
            </li>
            <!-- 02 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-02.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">屋外用アクティブセンサ</p>
              </div>
            </li>
            <!-- 03 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-03.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">防犯受信器</p>
              </div>
            </li>
            <!-- 04 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-04.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">屋外用パッシブセンサ</p>
              </div>
            </li>
            <!-- 05 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-05.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">センサライト</p>
              </div>
            </li>
            <!-- 06 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-06.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">LED センサライト</p>
              </div>
            </li>
            <!-- 07 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-07.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">安全運転支援器</p>
              </div>
            </li>
            <!-- 08 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-02-08.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">3次元距離画像カメラ</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section id="product_sec_03" class="product_type-01_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-03.svg" alt="03"></p>
              <h3 class="TL">EMS機種群</h3>
            </div>
            <p class="TX">設計から製造までトータルサポート</p>
          </div>
        </div>
        <div class="contents_area">
          <ul class="lists_area s-pop">
            <!-- 01 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-03-01.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">PoE搭載インテリジェンス<br>LTEゲートウェイ</p>
              </div>
            </li>
            <!-- 02 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-03-02.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">屋外特化型PoE搭載<br>LTEゲートウェイ(Wifi対応)</p>
              </div>
            </li>
            <!-- 03 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-03-03.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">屋外特化型PoE搭載<br>LTEゲートウェイ(高出力仕様)</p>
              </div>
            </li>
            <!-- 04 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-03-04.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">リアルタイム画像鮮明化装置</p>
              </div>
            </li>
            <!-- 05 -->
            <li class="item">
              <div class="img_wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/img/product/strength_item-03-05.webp">
              </div>
              <div class="txt_wrap">
                <p class="TX">制御基板</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>