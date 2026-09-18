<?php
/*
Template Name: 採用情報
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-recruit">

  <div class="p-recruit__inner">
    <div class="p-recruit__kv js-load-target a-fadeInUp">
      <h1 class="font-a-otf-a1-mincho-std-bold">子どもたちの<br class="pc-none">心をつくる仕事。<br>自分自身の心を<br class="pc-none">みがく仕事。</h1>
    </div>


    <div class="p-recruit__text pc-pdt-80 pc-pdb-130 sp-pdt-50 sp-pdb-55 js-scroll-target a-fadeInUp">
      <p class="pc-mgb-90 sp-mgb-80">
        子どもたちと関わると、<br class="pc-none">自分の在り方がいつも試されます。<br>
        なにを伝えるか。どう寄り添うか。<br>
        その在り方の積み重ねが、<br>
        ここではたらく職員を成長させてくれます。<br>
        知識だけでは心は動きません。<br>
        正解や不正解を教えるだけでなく、<br>
        “こんな大人でありたい”と<br class="pc-none">思ってもらえる姿を示すことを、<br>
        わたしたちは大切にしています。<br>
        つまり、自分自身の心をみがく姿勢が、<br>
        子どもたちの未来をつくっていく。<br>
        それが、甲子園学院で<br class="pc-none">はたらくということです。
      </p>

      <p class="p-recruit__text__name font-jost">KOSHIEN GAKUIN RECRUIT</p>
    </div>


    <div class="p-recruit-guideline js-scroll-target a-fadeInUp">
      <div class="c-title-3 c-title-3--white pc-mgb-55 sp-mgb-30">
        <p class="c-title-3__en font-avenir">GUIDELINE</p>
        <h1 class="c-title-3__ja">応募について</h1>
      </div>

      <div class="p-recruit-guideline__inner">
        <p class="p-recruit-guideline__text">教職員採用に関するお問い合わせは、<br class="pc-none">本校教頭・澤井までお電話ください。</p>
        <p class="p-recruit-guideline__tel pc-mgt-20 sp-mgt-30">
        <div class="p-recruit-guideline__tel__inner">
          <img src="<?php echo get_template_directory_uri(); ?>/img/icon_tel.webp" alt="TEL">
          <a href="tel:0798-67-2366" class="font-avenir-demibold" style="font-weight: 600;" >0798-67-2366</a>
        </div>
        </p>
      </div>
    </div>

  </div>
</div>

<div class="p-recruit-bg">
  <div class="p-recruit-bg__item">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_1_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_1.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">
    </picture>
  </div>
  <div class="p-recruit-bg__item">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_2_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_2.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">
    </picture>
  </div>
  <div class="p-recruit-bg__item">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_3_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_3.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">
    </picture>
  </div>
  <div class="p-recruit-bg__item">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_4_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_4.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">
    </picture>
  </div>
  <div class="p-recruit-bg__item">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_5_sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit_bg_5.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">
    </picture>
  </div>

</div>

<?php get_template_part('./inc/footer'); ?>