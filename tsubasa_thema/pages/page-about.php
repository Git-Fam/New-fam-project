<?php
/*
Template Name: 当院について
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="page-about">
  <div class="about-kv_greeting">
    <section class="about-kv">
      <div class="about-kv-char-01">
        <div class="char char-boss">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-boss.webp" alt="">
        </div>
        <div class="char char-01">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-01.webp" alt="">
        </div>
        <div class="char char-02">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-02.webp" alt="">
        </div>
        <div class="char char-03">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-03.webp" alt="">
        </div>
        <div class="char char-04">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-04.webp" alt="">
        </div>
      </div>
      <div class="about-kv-txt">
        <h2 class="TL">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-abput-ttl.svg" alt="見守りの森">
        </h2>
        <p class="TX">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-txt-TX.svg" alt="">
        </p>
      </div>
      <div class="about-kv-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-l-logo.svg" alt="つばさこども医院 小児外科/小児科">
      </div>
      <div class="about-kv-char-02">
        <div class="char char-01">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-05.webp" alt="">
        </div>
        <div class="char char-02">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-kv-char-06.webp" alt="">
        </div>
      </div>
    </section>
    <section class="about-greeting">
      <div class="about-greeting-ttl">
        <div class="C_front-ttl">
          <div class="wing left-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
          <h2 class="TL">ごあいさつ</h2>
          <div class="wing right-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
        </div>
      </div>
      <div class="about-greeting-img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-greeting-img.webp" alt="">
      </div>
      <div class="about-greeting-txt">
        <p class="TX">
          ホームページをご覧いただき、ありがとうございます。<br>
          つばさこども医院は、「子ども達には無限の可能性があり、未来に羽ばたく翼（つばさ）を持っている」という思いを胸に、このたび開院いたしました。子どもたちは一人ひとりがかけがえのない存在であり、その成長の先には大きな可能性が広がっています。私たちは、病気の治療だけでなく、日々の健康を見守り、安心して受診できる環境づくりを大切にしてまいります。すべての子どもたちが健やかに成長し、自分らしく未来へ羽ばたけるよう、安心できる医療と温かなサポートを提供いたします。<br>
          15年以上にわたる金沢大学附属病院での小児外科医としての経験を礎として、お子さまとご家族に真摯に寄り添いながら、地域に根ざしたクリニックを目指してまいります。どうぞよろしくお願い申し上げます。
        </p>
        <p class="TX NM">
          <span>院長</span>酒井 清祥
        </p>
      </div>
      <div class="about-greeting-prof">
        <div class="prof-item">
          <h3 class="prof-item-TL">略歴</h3>
          <ul class="prof-item-txt">
            <li class="TX">
              金沢大学医学部卒　H14
            </li>
            <li class="TX">
              金沢大学第二外科学教室
            </li>
            <li class="TX">
              金沢大学肝胆膵・移植外科／小児外科教室
            </li>
            <li class="TX">
              金沢大学附属病院　小児外科診療科長
            </li>
            <li class="TX">
              金沢大学附属病院　臨床准教授
            </li>
          </ul>
        </div>
        <div class="prof-item">
          <h3 class="prof-item-TL">資格</h3>
          <ul class="prof-item-txt">
            <li class="TX">
              医学博士（金沢大学）
            </li>
            <li class="TX">
              日本小児外科学会 小児外科専門医
            </li>
            <li class="TX">
              日本外科学会 外科専門医
            </li>
            <li class="TX">
              日本周産期・新生児学会 新生児認定外科医
            </li>
            <li class="TX">
              日本小児血液・がん学会 小児がん認定外科医
            </li>
            <li class="TX">
              食育インストラクター
            </li>
          </ul>
        </div>
      </div>
    </section>
  </div>
  <section class="about-features">
    <div class="about-features-ttl">
      <div class="C_front-ttl">
        <div class="wing left-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
        <h2 class="TL">当院の特徴</h2>
        <div class="wing right-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
      </div>
    </div>
    <div class="about-features-slider swiper">
      <div class="swiper-wrapper">
        <div class="slider-item swiper-slide">
          <div class="slider-item-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-slider-img-01.webp" alt="">
          </div>
          <div class="slider-item-txt">
            <h3 class="TL">
              小児科＋小児外科の診療
            </h3>
            <p class="TX">
              小児科と小児外科の両方に対応するクリニックです。発熱や感染症などの一般小児科診療に加え、けがや外傷、鼠径ヘルニア（脱腸）、臍ヘルニア、包茎、皮膚のできものなど小児外科的疾患も一貫して診療可能です。<br>
              ※骨折や脱臼などの整形外科疾患は対応していません。
            </p>
          </div>
        </div>
        <div class="slider-item swiper-slide">
          <div class="slider-item-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-slider-img-02.webp" alt="">
          </div>
          <div class="slider-item-txt">
            <h3 class="TL TL-line-height-2">
              食育×<span>腸内微生物叢<p class="TL s-TL">（腸内マイクロバイオーム）</p></span>に<br>
              着目した小児医療
            </h3>
            <p class="TX">
              離乳食や偏食、便秘など日常の悩みに対し、栄養と腸内環境の両面からサポートし、子どもの健やかな成長と免疫力の向上を目指します。ご家族とともに学びながら、未来の健康づくりを支えます。
            </p>
          </div>
        </div>
        <div class="slider-item swiper-slide">
          <div class="slider-item-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-slider-img-03.webp" alt="">
          </div>
          <div class="slider-item-txt">
            <h3 class="TL">
              便秘・夜尿症の専門外来
            </h3>
            <p class="TX">
              便秘症と夜尿症に対する専門的な診療を行っています。生活習慣や排便・排尿のリズムを丁寧に評価し、お子さま一人ひとりに合わせた治療を提案します。薬物療法だけでなく、食事や生活指導も含めた総合的なサポートで、安心して通える環境を整えています。
            </p>
          </div>
        </div>
        <div class="slider-item swiper-slide">
          <div class="slider-item-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-slider-img-04.webp" alt="">
          </div>
          <div class="slider-item-txt">
            <h3 class="TL">
              医療的ケア児の<br>
              デバイス管理・往診対応
            </h3>
            <p class="TX">
              医療的ケア児の気管切開チューブ、胃瘻、尿バルーン（膀胱瘻）の交換やトラブルの対応が可能です。ご要望に応じ、在宅、施設への往診も行なっています。
            </p>
          </div>
        </div>
      </div>

      <div class="about-features-slider-prev slider-arrow" aria-label="前へ">
        <span class="slider-arrow-icon"></span>
      </div>
      <div class="about-features-slider-next slider-arrow" aria-label="次へ">
        <span class="slider-arrow-icon"></span>
      </div>

      <div class="about-features-slider-pagination"></div>
    </div>
    <div class="about-features-char">
      <div class="char char-01">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-char-01.webp" alt="">
      </div>
      <div class="char char-02">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about-features-char-02.webp" alt="">
      </div>
    </div>
  </section>

  <section class="about-overview">
    <div class="about-overview-ttl">
      <div class="C_front-ttl">
        <div class="wing left-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
        <h2 class="TL">当院の概要</h2>
        <div class="wing right-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
      </div>
    </div>

    <ul class="about-overview-lists">
      <li class="list-item">
        <h3 class="TL">医院名</h3>
        <p class="TX">つばさこども医院</p>
      </li>
      <li class="list-item">
        <h3 class="TL">住所</h3>
        <p class="TX">
          ダミー〒921-8832<br>
          石川県野々市市<br>
          藤平田1丁目269番地
        </p>
      </li>
      <li class="list-item">
        <h3 class="TL">院長</h3>
        <p class="TX">酒井 清祥</p>
      </li>
      <li class="list-item">
        <h3 class="TL">開院</h3>
        <p class="TX">2026年10月1日</p>
      </li>
      <li class="list-item">
        <h3 class="TL">TEL</h3>
        <p class="TX">000-000-0000</p>
      </li>
      <li class="list-item">
        <h3 class="TL">診療内容</h3>
        <p class="TX">小児外科 / 小児科</p>
      </li>
      <li class="list-item">
        <h3 class="TL">休診日</h3>
        <p class="TX">水曜 / 土曜午後 / 日・祝</p>
      </li>
    </ul>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>