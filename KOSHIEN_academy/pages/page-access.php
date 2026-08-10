<?php
/*
Template Name: access
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自ページ --start -->
<div class="page-access">
  <section class="access_kv">
    <div class="inner--bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_kv-bg-pc.webp" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_kv-bg-sp.webp">
      </picture>
    </div>
    <h2 class="inner--ttl">
      <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_kv-ttl.svg" alt="アクセス ACCESS">
    </h2>
  </section>

  <section class="access_contents">
    <div class="content--ttl anime-fade">
      <h3 class="TL">甲子園学院法人本部</h3>
    </div>
    <ul class="list">
      <!-- map -->
      <li class="item anime-fade">
        <div class="img">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d799.9772193057142!2d135.37011217309532!3d34.7432401814588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000f21c056d79fb%3A0x3eb65633af6b3d03!2z55Sy5a2Q5ZyS5a2m6ZmiIOilv-WuruWtpuiIjg!5e0!3m2!1sja!2sjp!4v1772081820120!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="txt">
          <p class="TX">
            〒663-8107　<br class="sp">兵庫県西宮市瓦林町4-25 Tel 0798-67-2100
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JＲ甲子園口駅から徒歩約7分<br>
            <span class="TX-col">■</span>阪急西宮北口駅から徒歩約15分 <br class="sp"> <span class="TX-col">■</span>阪急バス甲子園学院前下車すぐ
          </p>
        </div>
      </li>
      <!-- 01 -->
      <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-01-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-01-sp.webp" alt="甲子園大学">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">〒665-0006 <br class="sp">兵庫県宝塚市紅葉ガ丘10-1 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/11j1LP1r1gG4qyVSA"
              target="_blank" rel="noopener noreferrer">MAP</a> Tel 0797-87-5111</p>
          <p class="TX">
            <span class="TX-col">■</span>JR・阪急宝塚駅及び阪急宝塚南口駅から専用送迎バスで7分
          </p>
        </div>
      </li>
      <!-- 02 -->
      <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-02-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-02-sp.webp" alt="甲子園短期大学">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">
            〒663-8107 <br class="sp">兵庫県西宮市瓦林町4番25号 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/QLGSi7TVvQK73fPb8" target="_blank"
              rel="noopener noreferrer">MAP</a> Tel 0798-65-3300
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JR甲子園口駅から徒歩7分 <br class="sp"><span class="TX-col">■</span>阪急西宮北口駅から徒歩15分 <br class="sp"><span class="TX-col">■</span>阪急バス甲子園短期大学前下車
          </p>
        </div>
      </li>
      <!-- 03 -->
      <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-03-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-03-sp.webp" alt="甲子園学院中学校・高等学校">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">
            〒663-8107<br class="sp">兵庫県西宮市瓦林町4番25号 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/T3FrMZCdMuNPk56B9" target="_blank"
              rel="noopener noreferrer">MAP</a> Tel 0798-65-6100
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JR甲子園口駅から徒歩7分 <br class="sp"><span class="TX-col">■</span>阪急西宮北口駅から徒歩15分 <br class="sp">
            <span class="TX-col">■</span>阪急バス甲子園学院前下車
          </p>
        </div>
      </li>
      <!-- 04 -->
      <!-- <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-04-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-04-sp.webp" alt="甲子園学院中学校・高等学校">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">
            〒663-8107<br class="sp">兵庫県西宮市瓦林町4番25号 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/T3FrMZCdMuNPk56B9" target="_blank"
              rel="noopener noreferrer">MAP</a> Tel 0798-65-6100
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JR甲子園口駅から徒歩7分 <br class="sp"><span class="TX-col">■</span>阪急西宮北口駅から徒歩15分<br class="sp">
            <span class="TX-col">■</span>阪急バス甲子園学院前下車
          </p>
        </div>
      </li> -->
      <!-- 05 -->
      <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-05-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-05-sp.webp" alt="甲子園学院小学校">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">
            〒663－8104 <br class="sp">兵庫県西宮市天道町10-15 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/mo8SZHZVroQzW4m2A" target="_blank"
              rel="noopener noreferrer">MAP</a> Tel 0798-67-2366
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JR甲子園口駅から徒歩7分 <br class="sp"><span class="TX-col">■</span>阪急西宮北口駅から徒歩20分
          </p>
        </div>
      </li>
      <!-- 06 -->
      <li class="item anime-fade">
        <div class="img">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-06-pc.webp"
              media="(min-width: 768px)" type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/access/access_contents-item-img-06-sp.webp" alt="甲子園学院幼稚園">
          </picture>
        </div>
        <div class="txt">
          <p class="TX">
            〒663－8103 <br class="sp">兵庫県西宮市熊野町5番18号 <br class="sp"><a class="map-link hover-opa" href="https://maps.app.goo.gl/ZABFHCAZdeV772xf7" target="_blank"
              rel="noopener noreferrer">MAP</a> Tel 0798-67-7272
          </p>
          <p class="TX">
            <span class="TX-col">■</span>JR甲子園口駅から徒歩10分 <br class="sp"><span class="TX-col">■</span>阪急西宮北口駅から徒歩18分
          </p>
        </div>
      </li>
    </ul>
  </section>

</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>