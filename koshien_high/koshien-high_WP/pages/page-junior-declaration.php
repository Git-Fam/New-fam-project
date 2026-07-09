<?php
/*
Template Name: 全校生徒の好きを応援する宣言
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--junior-declaration">
  <div class="page--junior-declaration-inner">
  <section class="junior-declaration-hiro">
      <div class="TL-top">
       <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/junior-declaration-hiro-TL-top.svg" alt="甲子園学院中学校">
      </div>
      <h2 class="TL">
        全校生徒の<br>好きを<br>応援する宣言
      </h2>

  </section>

  <section class="junior-declaration-message">
    <div class="junior-declaration-message-inr">
      <p class="message-text">
      クラブ活動を減らす時代？<br>
      いいえ、私たちは、もっと応援します。<br>
      好きなことに、<br class="sp">もっと夢中になってほしい。<br>
      なぜなら、夢中になる経験は、<br class="sp">人を成長させるから。<br>
      努力すること。仲間と支え合うこと。<br class="sp">人と向き合うこと。<br>
      好きなことの先に、<br>
      人生で大切なことがあると、<br class="sp">私たちは信じています。<br>
      だから、宣言します。<br class="sp">甲子園学院中学校は、<br>
      全校生徒の「好き」を、<br class="sp">本気で応援します。<br>
      あなたの好きに飛び込もう。    
      </p>

      <div class="message-img">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/junior-declaration-message-pc.svg" media="(min-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/junior-declaration-message-sp.svg" alt="DIVE IN LOVE!">
        </picture>
      </div>
    </div>
  </section>


  <section class="junior-declaration-content">
    <div class="junior-declaration-content-inr">
      <h3 class="junior-declaration-content-TL">好きに夢中になると…</h3>
      <ul class="junior-declaration-content-list">
        <li class="junior-declaration-content-list-item">
          <div class="text-wrap">
            <div class="top-textbox">
              <p class="top-textbox-text">その<span class="top-textbox-number"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/top-textbox-number-01.webp" alt="1"></span></p>
            </div>
            <p class="TL">仲間ができる！</p>
            <p class="TX">
            同じ目標の仲間とつながる！同学年だけじゃなくて、<br>先輩・後輩との関係も自然に生まれる。
            </p>
          </div>
          <div class="img img01"></div>
        </li>

        <li class="junior-declaration-content-list-item">
          <div class="text-wrap">
            <div class="top-textbox">
              <p class="top-textbox-text">その<span class="top-textbox-number"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/top-textbox-number-02.webp" alt="2"></span></p>
            </div>
            <p class="TL">自分から動ける！</p>
            <p class="TX">
            自分が「こうしたい！」って思えるから、<br>
            誰かに言われる前に自分で動く。
            </p>
          </div>
          <div class="img img02"></div>
        </li>

        <li class="junior-declaration-content-list-item">
          <div class="text-wrap">
            <div class="top-textbox">
              <p class="top-textbox-text">その<span class="top-textbox-number"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/top-textbox-number-03.webp" alt="3"></span></p>
            </div>
            <p class="TL">前向きに明るくなる！</p>
            <p class="TX">
            好きなことに打ち込んで、ゴールに向っていくのが楽しい！
            </p>
          </div>
          <div class="img img03"></div>
        </li>

        <li class="junior-declaration-content-list-item">
          <div class="text-wrap">
            <div class="top-textbox">
              <p class="top-textbox-text">その<span class="top-textbox-number"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/top-textbox-number-04.webp" alt="4"></span></p>
            </div>
            <p class="TL">自分に自信が持てる！</p>
            <p class="TX">
            小さな成功体験が増え、自分の居場所がはっきりする。
            </p>
          </div>
          <div class="img img04"></div>
        </li>

      </ul>
    </div>
  </section>

  <section class="junior-declaration-next">
    <div class="junior-declaration-next-inr">
      <h3 class="junior-declaration-next-TL">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-pc.svg" media="(min-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-sp.svg" alt="こちらのコンテンツもチェック！">
        </picture>
      </h3>

      <div class="junior-declaration-next-bnr">
        <a href="<?php echo home_url('/'); ?>" class="junior-declaration-next-bnr-link">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-pc.webp" media="(min-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-declaration/next-content-check-img-sp.webp" alt="好きにまっすぐな夢中学生">
          </picture>
        </a>
      </div>
    </div>
      
  </section>



</div>

</main>


<?php get_template_part('./inc/footer'); ?>
