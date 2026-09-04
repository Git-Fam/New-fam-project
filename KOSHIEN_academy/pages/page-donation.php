<?php
/*
Template Name: donation
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自ページ --start -->
<div class="page-donation">
  <section class="donation_kv">
    <div class="inner--bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/donation/donation_kv-bg-pc.webp" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/donation/donation_kv-bg-sp.webp">
      </picture>
    </div>
    <div class="inner--ttl">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/donation/donation_kv-ttl-pc.svg" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/donation/donation_kv-ttl-sp.svg" alt="教育振興基金への寄付のお願い DONATION">
      </picture>
    </div>
  </section>

  <section class="donation_top-txt">
    <div class="ttl anime-fade">
      <div class="icon">
        <img src="<?php echo get_template_directory_uri(); ?>/img/icon/C_sec-ttl-type-02.svg">
      </div>
      <h3 class="TL"> 学ぶ心を支えるのは、<br class="sp">社会のあたたかい心です。</h3>
    </div>
    <div class="txt anime-fade">
      <p class="TX">
        創立５０周年の平成２年に、教育の充実、向上を図ることを目的に<br class="pc">
        「甲子園学院教育振興基金」を設立しました。<br class="pc">
        以来、各学校園の在学生の保護者、卒業生、教職員や企業の方々からその趣旨をご理解いただき、<br class="pc">
        各学校園において、教育環境、施設・設備の充実のために有効に活用させていただいております。<br class="pc">
        これからも、建学の精神に則り全教職員が一丸となって叡智を結集し、教育の内容、施設・設備の充実に一層努力し、<br class="pc">
        活力ある学園と有為な人材の育成を目指してまいりますので、<br class="pc">
        募金の趣旨をご理解いただき、ご支援、ご協力を賜りますようお願い申し上げます。
      </p>
      <p class="TX TX-s">
        ★ 本基金へのご寄付は、税制上の優遇措置を受けることができます。
      </p>
    </div>
  </section>

  <section class="donation_contents">
    <div class="ttl anime-fade">
      <h3 class="TL">寄付の活用内容</h3>
    </div>
    <ul class="content">
      <li class="item anime-fade">
        <div class="item--inner">
          <div class="item--num">
            <p class="TX">
              <img src="<?php echo get_template_directory_uri(); ?>/img/donation/donation_contents-item-num-01.svg" alt="1">
            </p>
          </div>
          <div class="item--ttl">
            <h4 class="TL">
              教育施設の整備・充実
            </h4>
          </div>
          <div class="item--txt">
            <p class="TX">
              （近年の活用例）<br class="sp">電子黒板・プロジェクター購入、<br class="sp">空調・衛生設備更新等
            </p>
          </div>
        </div>
      </li>
      <li class="item anime-fade">
        <div class="item--inner">
          <div class="item--num">
            <p class="TX">
              <img src="<?php echo get_template_directory_uri(); ?>/img/donation/donation_contents-item-num-02.svg" alt="2">
            </p>
          </div>
          <div class="item--ttl">
            <h4 class="TL">
              図書及び研究設備等の<br class="sp">整備・充実
            </h4>
          </div>
          <div class="item--txt">
            <p class="TX">
              （近年の活用例）<br class="sp">国語辞典・鉄琴・知育玩具等購入等
            </p>
          </div>
        </div>
      </li>
      <li class="item anime-fade">
        <div class="item--inner">
          <div class="item--num">
            <p class="TX">
              <img src="<?php echo get_template_directory_uri(); ?>/img/donation/donation_contents-item-num-03.svg" alt="3">
            </p>
          </div>
          <div class="item--ttl">
            <h4 class="TL">
              その他教育環境の充実に<br class="sp">必要と認められるもの
            </h4>
          </div>
          <div class="item--txt">
            <p class="TX">
              （近年の活用例）<br class="sp">自動体外式除細動器（AED）購入・設置等
            </p>
          </div>
        </div>
      </li>
    </ul>
  </section>

  <section class="donation_for-you">
    <div class="ttl anime-fade">
      <h3 class="TL">基金へのご寄付について</h3>
    </div>
    <ul class="lists anime-fade">
      <li class="item">
        <div class="item--ttl">
          <h4 class="TL">募集対象</h4>
        </div>
        <div class="item--txt">
          <p class="TX">
            本学院の在校生・卒業生・保護者・教職員・法人企業・各種団体及び本学院の教育に賛同いただける方
          </p>
        </div>
      </li>
      <li class="item">
        <div class="item--ttl">
          <h4 class="TL">寄付金額</h4>
        </div>
        <div class="item--txt">
          <p class="TX">
            個人寄附・法人寄附<br class="sp">：共に1口30,000円より<br>
            ※1口からご寄附頂けます。
          </p>
        </div>
      </li>
      <li class="item">
        <div class="item--ttl">
          <h4 class="TL">申込方法</h4>
        </div>
        <div class="item--txt">
          <p class="TX">
            法人事務局会計課 (0798-67-8922)までご連絡ください。<br>
            募金趣意書並びに振込用紙をお送りいたします。

          </p>
        </div>
      </li>
    </ul>
  </section>

</div>

<?php get_template_part('./inc/footer'); ?>