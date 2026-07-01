<?php get_template_part('global-parts/header'); ?>

<script>
  document.querySelector('.header').classList.remove('header--dark');
  document.querySelector('.header').classList.add('header--light');
</script>

<main class="company" data-header="light">

  <!-- ページヘッダー -->
  <section class="page-header">
    <div class="page-header__inner">
      <h1 class="page-header__title js-mask-text">COMPANY</h1>
      <p class="page-header__ja">会社概要</p>
    </div>
  </section>

  <!-- CEO MESSAGE -->
  <section class="company__ceo ceo-sec" data-header="dark">
        <!-- 背景画像 -->
    <div class="ceo-sec__bg" data-parallax=".ceo-sec">
        <img src="<?php echo get_template_directory_uri(); ?>/img/company/ceo-bg.webp" alt="">
    </div>
    <div class="ceo-sec__inner">
      <div class="ceo-sec__left">
        <h2 class="ceo-sec__title js-text-reveal">
            <span>CEO</span>
            <span>MESSAGE</span>
        </h2>
        <div class="ceo-sec__text">
          <p>株式会社FAMは2012年に設立。<br>当社は営業販売からスタートし、自社サービスに注力してまいりました。</p>
          <p>近年は、インターネットの普及で日本経済は急速に変化し、<br class="pc">働き方の多様化や、人工知能、IoTと様々なテクノロジーが誕生しています。<br class="pc">めまぐるしいスピードで変わる世の中に驚く日々ですが、<br class="pc">一方で「一人ひとりの個性が活きる環境」が整ってきたようにも思います。</p>
          <p>だからこそ私たちも変化を恐れずに前進し、<br class="pc">変革や創造を起こさなければ発展はできないでしょう。</p>
          <p>株式会社FAMは「想いを形に世の中を豊かにする」をビジョンに掲げ、<br class="pc">一人ひとりの個性を活かし、ITとWebの力で社会が求めるサービスを世の中に提供します。<br class="pc">今まで培ってきたノウハウとアイデアを土台に、<br class="pc">社会の活性化に貢献することをお約束します。</p>
          <p class="ceo-sec__name">代表取締役　菅 浩徳</p>
        </div>
        </div>
        <div class="ceo-sec__right"></div>
        <!-- <div class="ceo-sec__bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/company/ceo-bg.jpg" alt="CEO">
        </div> -->
    </div>
  </section>

  <!-- CORPORATE INFO -->
  <section class="company__info info-sec">
    <div class="info-sec__inner">
      <div class="info-sec__left">
        <h2 class="info-sec__title js-text-reveal">
            <span>CORPORATE</span>
            <span>INFO</span>
        </h2>
      </div>
      <div class="info-sec__right">
        <table class="info-sec__table">
          <tr class="left">
            <th>社名</th>
            <td>株式会社FAM</td>
          </tr>
          <tr class="left">
            <th>代表者名</th>
            <td>菅 浩徳</td>
          </tr>
          <tr class="left">
            <th>設立日</th>
            <td>2012年 10月</td>
          </tr>
          <tr class="left">
            <th>所在地</th>
            <td>東京都新宿区新宿5-15-7 東晃ビル3・9F</td>
          </tr>
          <!-- <tr class="left">
            <th>資本金</th>
            <td>9,000,000円</td>
          </tr> -->
          <!-- <tr class="left">
            <th>事業概要</th>
            <td>インバウンド事業 / パートナー事業 / Web事業</td>
          </tr> -->
          <tr class="left">
            <th>派遣番号</th>
            <td>13-315654</td>
          </tr>
        </table>
      </div>
    </div>
  </section>

  <!-- 全幅画像 -->
<div class="company__fullimg-wrap">
  <div class="company__fullimg">
    <!-- <img src="<?php echo get_template_directory_uri(); ?>/img/company/company-wide.webp" alt=""> -->
    <img src="<?php echo get_template_directory_uri(); ?>/img/company/company-wide03.webp" alt="">
  </div>
</div>

  <!-- ACCESS -->
  <section class="company__access access-sec">
    <div class="access-sec__inner">
      <div class="access-sec__left up">
        <h2 class="access-sec__title">ACCESS</h2>
        <p class="access-sec__address">〒160-0022<br>東京都新宿区新宿5-15-7 東晃ビル3・9F</p>
      </div>
      <div class="access-sec__right up">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51876.71559156047!2d139.6573674975755!3d35.64510964898363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188cdc04a46871%3A0x9b14aeeed0768ce3!2z44ixRkFN!5e0!3m2!1sja!2sjp!4v1774419412498!5m2!1sja!2sjp" 
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          >
        </iframe>
      </div>
    </div>
  </section>

</main>

<?php get_template_part('global-parts/footer'); ?>