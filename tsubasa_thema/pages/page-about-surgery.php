<?php
/*
Template Name: 手術について
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="page-about-surgery">
  <section class="C_kv">
    <div class="C_kv-board">
      <h2 class="TL">手術について</h2>
    </div>
    <div class="C_kv-char">
      <div class="char-04 fuwafuwa duration-11 delay-03">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-04.webp" alt="">
      </div>
    </div>
  </section>

  <section class="about-surgery-contents">
    <div class="about-surgery-contents-ttl">
      <h2 class="TL">
        小児外科専門医による<br>
        安心の手術サポート
      </h2>
    </div>
    <div class="about-surgery-contents-txt">
      <p class="TX">
        院長の酒井（日本小児外科学会小児外科専門医）は金沢大学附属病院で15年以上にわたり、チーフ・診療科長としてお子様の手術をさせて頂きました。手術が必要なお子様には、当院から車で10分の距離にある松任石川中央病院と連携し、手術をさせて頂きます。<br>
        手術の適応、手術、術後のフォローアップに至るまで、患者様に安心して手術を受けていただけるよう、心をこめてサポートさせて頂きます。手術には院長の酒井が立ち合います。
      </p>
    </div>
  </section>

  <section class="C_under-point">
    <div class="C_under-point-char">
      <div class="char-04 fuwafuwa duration-12 delay-05">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_under-point-char-04.webp" alt="">
      </div>
    </div>
    <div class="C_front-ttl">
      <div class="wing left-wing">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
      </div>
      <h3 class="TL">手術までの流れ</h3>
      <div class="wing right-wing">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
      </div>
    </div>
    <div class="C_under-point-contents">
      <div class="contents-item type-swiper swiper">
        <div class="swiper-wrapper">
          <div class="type-swiper-item swiper-slide">
            <div class="contents-item-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/about-surgery/home-visit-contents-swiper-img-01.webp" alt="">
            </div>
            <div class="contents-item-ttl">
              <h3 class="TL">
                1.当院で手術のお話<br>
                日程の調整
              </h3>
            </div>
          </div>
          <div class="type-swiper-item swiper-slide">
            <div class="contents-item-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/about-surgery/home-visit-contents-swiper-img-02.webp" alt="">
            </div>
            <div class="contents-item-ttl">
              <h3 class="TL">
                2.松任石川中央病院受診<br>
                術前検査・麻酔科受診
              </h3>
            </div>
          </div>
          <div class="type-swiper-item swiper-slide">
            <div class="contents-item-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/about-surgery/home-visit-contents-swiper-img-03.webp" alt="">
            </div>
            <div class="contents-item-ttl">
              <h3 class="TL">
                3.手術・入院
              </h3>
            </div>
          </div>
          <div class="type-swiper-item swiper-slide">
            <div class="contents-item-img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/about-surgery/home-visit-contents-swiper-img-04.webp" alt="">
            </div>
            <div class="contents-item-ttl">
              <h3 class="TL">
                4.当院での術後フォロー
              </h3>
            </div>
          </div>
        </div>

        <div class="type-swiper-prev slider-arrow" aria-label="前へ">
          <span class="slider-arrow-icon"></span>
        </div>
        <div class="type-swiper-next slider-arrow" aria-label="次へ">
          <span class="slider-arrow-icon"></span>
        </div>

        <div class="type-swiper-pagination"></div>
      </div>
      <div class="contents-item type-change">
        <div class="contents-item-ttl">
          <h3 class="TL">対象疾患</h3>
        </div>
        <div class="contents-item-txt">
          <p class="TX">
            鼠径ヘルニア、陰嚢水腫、停留精巣、<br>
            臍ヘルニア、包茎、舌小帯短縮症　など
          </p>
        </div>
      </div>
      <div class="contents-item type-change">
        <div class="contents-item-ttl">
          <h3 class="TL">入院期間</h3>
        </div>
        <div class="contents-item-txt">
          <p class="TX">
            １泊2日　程度
          </p>
        </div>
      </div>
    </div>
    <div class="C_under-point-txt">
      <p class="TX">
        ※緊急手術、高難度手術につきましては金沢大学附属病院、金沢医科大学病院、石川県立中央病院にご案内させて頂きます。
      </p>
    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>