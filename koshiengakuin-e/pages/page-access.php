<?php
/*
Template Name: アクセス
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-access">
  <section class="p-access__inner">
    <div class="p-access__card">
      <div class="c-title-3 c-title-3--md pc-mgb-70 sp-mgb-40">
        <p class="c-title-3__en font-avenir">Location</p>
        <h1 class="c-title-3__ja">小学校所在地</h1>
      </div>

      <p class="p-access__address pc-mgb-15 sp-mgb-10">〒663-8104 兵庫県西宮市天道町10-15　<br class="pc-none">TEL 0798-67-2366</p>

      <div class="p-access-map pc-mgb-90 sp-mgb-100">
        <iframe
          title="甲子園学院小学校へのアクセスマップ"
          src="https://maps.google.com/maps?q=%E7%94%B2%E5%AD%90%E5%9C%92%E5%AD%A6%E9%99%A2%E5%B0%8F%E5%AD%A6%E6%A0%A1&t=&z=15&ie=UTF8&iwloc=&output=embed"
          loading="lazy"
          allowfullscreen
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <section class="p-access-route">
        <div class="c-title-3 c-title-3--md pc-mgb-30 sp-mgb-20">
          <p class="c-title-3__en font-avenir">Route Map</p>
          <h2 class="c-title-3__ja">路線図</h2>
        </div>

        <div class="p-access-route__scroll sp-mgb-20 a-">
          <img src="<?php echo get_template_directory_uri(); ?>/img/access_scroll.webp" alt="scroll" class="left-right">
        </div>

        <div class="p-access-route__content">
          <div class="p-access-route__inner">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access_map.webp" alt="路線図" />
          </div>
        </div>

      </section>
    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>