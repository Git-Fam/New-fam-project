<?php
/*
Template Name: factory
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="factory_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/factory/factory_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/factory/factory_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_kv-ttl.svg" alt="FACTORY / 工場・設備">
      </picture>

    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_factory">

    <section id="factory_sec_01" class="factory_type-01_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-01.svg" alt="01"></p>
              <h3 class="TL">SMT実装</h3>
            </div>
            <p class="TX">オフロムの面実装技術</p>
          </div>
        </div>
        <div class="factory_sec_01">
          <div class="txt_area s-pop">
            <p class="TX">
              SMT実装ラインを4ライン有し、高密度実装技術を軸としたトータルプロダクションを行います。<br class="pc">
              また、BGA/LGA、フリップチップなど高密度実装は印刷検査装置をはじめ、<br class="pc">
              Ｘ線検査装置や外観検査装置と熟練した作業者で品質保証を確保し、<br class="pc">
              多機種少ロット生産から大量生産まで可能です。全てのラインは鉛フリー/窒素リフロー対応で、<br class="pc">
              環境に配慮した設備です。
            </p>
          </div>
          <div class="contents_area s-pop">
            <div class="img chart_img">
              <img class="contents-chart-img" src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_sec_01-img.svg">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="factory_sec_02" class="factory_type-01_section factory_type-color">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-02.svg" alt="02"></p>
              <h3 class="TL">SMT設備構成</h3>
            </div>
            <p class="TX">経験・技そして先進設備との鮮やかな連携</p>
          </div>
        </div>
        <div class="factory_sec_02">
          <div class="contents_area s-pop">
            <div class="img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_sec_02-img.svg">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="factory_sec_03" class="factory_type-01_section">
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
        <div class="factory_sec_03">
          <div class="contents_area s-pop">
            <div class="img chart_img">
              <img class="contents-chart-img" src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_sec_03-img.svg">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="factory_sec_04" class="factory_type-01_section factory_type-color">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-04.svg" alt="04"></p>
              <h3 class="TL">はんだ付け周辺設備</h3>
            </div>
            <p class="TX">30年以上培った確かな技術の安定性と自動化</p>
          </div>
        </div>
        <div class="factory_sec_04">
          <div class="contents_area s-pop">
            <div class="img">
              <img src="<?php echo get_template_directory_uri(); ?>/img/factory/factory_sec_04-img.svg">
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>