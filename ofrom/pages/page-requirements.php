<?php
/*
Template Name: requirements
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="requirements_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-ttl.svg" alt="RECRUIT / 採用情報">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_requirements">

    <section class="requirements_type-01_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <h3 class="TL">募集要項</h3>
        </div>
        <div class="requirements_sec_01">
          <div class="contents_area">
            <div class="table_area s-pop">
              <div class="C_table">
                <ul class="C_table_list">
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        勤務地
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        本社 <br class="sp">福井県福井市三留町72字10番地(みとめ工業団地)
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        勤務時間
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        8:00～17:00 （一部の部門は3交替制）
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        給与
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        固定給額は職種により異なります。<br>
                        経験・能力を考慮の上、当社規定により<br class="sp">優遇いたします。
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        給与改定
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        年1回
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        賞与
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        年2回
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        休日・休暇
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        週休2日制(土日)、祝日、年末年始、夏季休暇<br>
                        ※ただし週の途中に祝日のある週の土曜日は出勤
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        福利厚生
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        各種社会保険完備、退職金制度、<br class="sp">社内レクレーション
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        職種
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        設計、開発、生産技術、品質管理、<br class="sp">生産管理、資材管理、製造
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        応募
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        エントリーフォームよりご応募をお願いします。<br>
                        追って詳細をご連絡いたします。<br>
                        不明な点、気になる点などありましたら、<br class="sp">お気軽にお問い合わせください。
                      </p>
                    </div>
                  </li>
                  <li class="item">
                    <div class="ttl">
                      <h4 class="TL">
                        お問い合わせ
                      </h4>
                    </div>
                    <div class="txt">
                      <p class="TX">
                        オフロム株式会社 管理部 採用担当 <br class="sp">0776-98-3800
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <ul class="links">
              <li class="C_link_banner s-pop">
                <a href="<?php echo home_url('/entry-new'); ?>">
                  <div class="inner">新卒採用エントリー</div>
                </a>
              </li>
              <li class="C_link_banner s-pop">
                <a href="<?php echo home_url('/entry-mid'); ?>">
                  <div class="inner">中途採用エントリー</div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>