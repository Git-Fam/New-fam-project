<?php
/*
Template Name: 小児科
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="page-pediatrics">
  <section class="C_kv">
    <div class="C_kv-board">
      <h2 class="TL">小児科</h2>
    </div>
    <div class="C_kv-char">
      <div class="char-02">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-02.webp" alt="">
      </div>
    </div>
  </section>

  <section class="pediatrics-contents">
    <div class="pediatrics-contents-ttl">
      <div class="C_front-ttl">
        <div class="wing left-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
        <h2 class="TL">診療について</h2>
        <div class="wing right-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
      </div>
    </div>
    <div class="pediatrics-contents-txt">
      <p class="TX">
        当院では、お子さまの発熱、せき、鼻水、のどの痛み、腹痛、下痢、嘔吐、発疹など、日常的によくみられる症状をはじめ、さまざまな小児疾患の診療を行っています。お子さま一人ひとりの成長や発達に配慮しながら、丁寧な診察とわかりやすい説明を心がけています。気になる症状や育児に関するご相談にも対応しておりますので、体調不良はもちろん、健康面でご心配なことがありましたらお気軽にご受診ください。保護者の皆さまとともに、お子さまの健やかな成長をサポートいたします。
      </p>
    </div>
  </section>

</div>

<?php get_template_part('./inc/footer'); ?>