<?php
/*
Template Name: offroad
Template Post Type: page
Template Path: pages/
*/

?>
<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自 -->
<div class="offroad_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/offroad/offroad_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/offroad/offroad_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <div class="ttl">
      <h2 class="TL">
        <img src="<?php echo get_template_directory_uri(); ?>/img/offroad/offroad_kv-ttl.svg" alt="OFROM OFFROAD / OFROM MAKES OFFROAD TO FRONTIER">
      </h2>
    </div>
    <div class="txt s-pop">
      <p class="TX">
        道なき道を駆けてゆく。<br>
        電子回路の独創技術で、<br class="sp">まだ見ぬ領域を切り拓いてゆく。<br>
        オフロムがつくる、未知への道。<br class="sp">それが『OFROM OFFROAD』。<br>
        わたしたちは40年以上の歴史のなかで<br class="sp">技術革新をくりかえし、<br>
        事業・製品・技術領域を次々と広げてきました。<br>
        自らの限界をつくることはしません。<br>
        お客様の要望をつねに超えていくために。<br>
        お客様をまだ見ぬ領域へとお連れするために。<br>
        フロンティアスピリッツを抱えて<br>
        未知へとつづく道＝OFFROAD/オフロードを<br class="sp">拓きつづけます。
      </p>
    </div>
  </div>
</div>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>