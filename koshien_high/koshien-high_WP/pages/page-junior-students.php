<?php
/*
Template Name: 夢中学生
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--junior-students page--junior page--high page--high-all">
  
  <section class="junior-students-hiro">
    <div class="junior-students-hiro-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-hiro-bg-sp.webp" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-hiro-bg-pc.webp" alt="">
      </picture>
    </div>
    <div class="junior-students-hiro-inr">
      <h2 class="TL">
        わたしの人生は<br>
        吹奏楽に出会って<br>
        変わったかも。
      </h2>

      <div class="TX">
        <p class="label"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-hiro-bottom.svg" alt="夢中学生.1"></p>
        <p class="name">田中 愛香</p>
      </div>
    </div>
  </section>

  <section class="junior-students-contents">
      <div class="junior-students-contents-item js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item01-pc.webp" alt="">
        </picture>
      </div>

      <div class="junior-students-contents-item js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item02-pc.webp" alt="">
        </picture>

        <div class="junior-students-contents-item-inr">
          <div class="icon-box">
            <p class="icon-box-text">目標に</p>
            <div class="icon-box-img"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-icon.webp" alt="夢中"></div>
          </div>
          <h3 class="TL">全国という舞台を<br>本気でめざす環境。</h3>
          <p class="TX">ダミー、好きなことに夢中になる時間は、子どもたちの心を大きく育てます。仲間と出会い、互いに高め合いながら、自ら考え行動する力が育まれていく。</p>
      </div>

      <div class="junior-students-contents-item js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item03-pc.webp" alt="">
        </picture>
      </div>

      <div class="junior-students-contents-item item-left js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item04-pc.webp" alt="">
        </picture>

        <div class="junior-students-contents-item-inr">
          <div class="icon-box">
            <p class="icon-box-text">仲間と</p>
            <div class="icon-box-img"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-icon.webp" alt="夢中"></div>
          </div>
          <h3 class="TL">楽しいときも、<br>辛いときも一緒。</h3>
          <p class="TX">ダミー、好きなことに夢中になる時間は、子どもたちの心を大きく育てます。仲間と出会い、互いに高め合いながら、自ら考え行動する力が育まれていく。</p>
      </div>

  </section>

  <section class="high-change">
    <div class="ttl">
      <h2 class="TL">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/slider-ttl.svg" alt="その他の夢中学生">
      </h2>
    </div>
    <div class="high-change-contents">
      <a href="<?php echo home_url('/junior/students/'); ?>" class="high-change-contents-item hover-opa">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-01.webp" alt="">
      </a>
      <a href="<?php echo home_url('/junior/students/'); ?>" class="high-change-contents-item hover-opa">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-02.webp" alt="">
      </a>
      <a href="<?php echo home_url('/junior/students/'); ?>" class="high-change-contents-item hover-opa">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-03.webp" alt="">
      </a>
    </div>
    <div class="high-change-pagination"></div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>  

