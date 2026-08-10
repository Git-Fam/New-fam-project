<?php
/*
Template Name: art
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自ページ --start -->
<div class="page-art">
  <div class="inner--bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/art/art-inner-bg-pc.webp" media="(min-width: 768px)" type="image/svg+xml">
      <img src="<?php echo get_template_directory_uri(); ?>/img/art/art-inner-bg-sp.webp">
    </picture>
  </div>

  <div class="art_sec-wrap">
    <section class="art_kv">
      <h2 class="inner--ttl">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/art/art_kv-ttl-pc.svg" media="(min-width: 768px)" type="image/svg+xml">
          <img src="<?php echo get_template_directory_uri(); ?>/img/art/art_kv-ttl-sp.svg" alt="  心を磨く、感性の源泉。 美術資料館">
        </picture>
      </h2>
    </section>

    <div class="art_top-txt anime-fade">
      <div class="inner--contents">
        <p class="TX">
          絵巻物のコレクション、<br class="sp">東西の画家による絵画、彫刻、<br>
          ガラス工芸品、掛け軸、<br class="sp">屏風などの名品を収蔵し、<br class="sp">定期的に展覧会を開催。<br>
          学生・生徒には「本物」の芸術作品に触れる<br class="sp">良い機会となっています。
        </p>
        <p class="box">現在は休館中です。</p>
      </div>
    </div>

    <section class="art_past anime-fade">
      <div class="inner--contents">
        <div class="ttl">
          <h3 class="TL">過去の展覧会</h3>
        </div>
        <ul class="lists">
          <li class="item">
            <p class="time">2018/11/10~11/25</p>
            <p class="TX">「阪神ゆかりの作家たち展」</p>
          </li>
          <li class="item">
            <p class="time">2016/10/29~11/13</p>
            <p class="TX">「ガラス工芸の美術展」</p>
          </li>
          <li class="item">
            <p class="time">2016/05/28~06/12</p>
            <p class="TX">「師弟関係作品展」</p>
          </li>
          <li class="item">
            <p class="time">2015/10/31~11/15</p>
            <p class="TX">「奈良絵巻VS白描絵巻展」</p>
          </li>
          <li class="item">
            <p class="time">2015/05/30~06/14</p>
            <p class="TX">「彫刻に見る造形の美展」</p>
          </li>
        </ul>
        <div class="pictures anime-fade">
          <div class="img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/art/art_past-img-01.webp">
          </div>
          <div class="img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/art/art_past-img-02.webp">
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>