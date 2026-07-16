<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="front_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-bg.webp">
    </picture>
  </div>
  <h2 class="TL is-loading">
    <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_kv-ttl.svg" alt="OFROM OFFROAD">
  </h2>
</div>
<main class="page_main_contents">
  <div class="page_front">

    <section class="front_news">
      <div class="all_sec_inner">
        <div class="front_news_inner s-pop">
          <div class="top_wrap">
            <div class="ttl">
              <h3 class="TL">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_news-ttl.svg" alt="NEWS">
              </h3>
              <p class="TX">お知らせ</p>
            </div>
            <div class="btn">
              <a class="C_more-btn" href="<?php echo home_url('/news'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type01.svg" alt="MORE">
              </a>
            </div>
          </div>
          <div class="news_lists">
            <?php
            $news_query = new WP_Query(array(
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'orderby'        => 'date',
              'order'          => 'DESC',
              'post_status'    => 'publish',
            ));
            $default_cat_id = get_option('default_category');
            if ($news_query->have_posts()) :
              while ($news_query->have_posts()) :
                $news_query->the_post();
                $cats    = get_the_category();
                $cat_name = '';
                if ($cats) {
                  foreach ($cats as $c) {
                    if ((int) $c->term_id !== (int) $default_cat_id) {
                      $cat_name = $c->name;
                      break;
                    }
                  }
                  if ($cat_name === '' && ! empty($cats)) {
                    $cat_name = $cats[0]->name;
                  }
                }
            ?>
                <article class="item">
                  <a href="<?php the_permalink(); ?>">
                    <div class="date_wrap">
                      <div class="date">
                        <p class="TX"><?php the_time('Y.m.d'); ?></p>
                      </div>
                      <?php if ($cat_name) : ?>
                        <div class="category">
                          <p class="TX"><?php echo esc_html($cat_name); ?></p>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="ttl">
                      <h4 class="TL"><?php the_title(); ?></h4>
                    </div>
                  </a>
                </article>
            <?php
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="front_about" id="front-statement">
      <div class="all_sec_inner">
        <div class="front_about_inner s-pop">
          <div class="ttl">
            <h3 class="TL">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_about-ttl.svg" alt="OFROM OFFROAD">
            </h3>
          </div>
          <div class="txt">
            <p class="TX">
              道なき道を駆けてゆく。<br>
              電子回路の独創技術で、まだ見ぬ領域を切り拓いてゆく。<br>
              オフロムがつくる、未知への道。<br>
              それが『OFROM OFFROAD』
            </p>
          </div>
          <div class="btn">
            <a class="C_more-btn" href="<?php echo home_url('/offroad'); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type02.svg" alt="MORE">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="front_strength" id="front-strength">
      <div class="all_sec_inner">
        <div class="front_strength_inner">
          <div class="inner_wrap s-pop">
            <div class="ttl_area">
              <h3 class="TL">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-ttl-sp.svg"
                    media="(max-width: 767px)"><img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-ttl.webp" alt="OUR STRENGTH">
                </picture>
              </h3>
              <p class="TX">
                6つの強みを軸に<br class="pc">
                お客様のニーズに応えるため、<br>
                技術とサービスを提供。
              </p>
              <div class="btn">
                <a class="C_more-btn" href="<?php echo home_url('/strength'); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type01.svg" alt="MORE">
                </a>
              </div>
            </div>
            <ul class="lists_area">
              <!-- 01 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-01.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-01.svg">
                  <p class="TX">EMS戦略サポート</p>
                </div>
              </li>
              <!-- 02 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-02.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-02.svg">
                  <p class="TX">品質第一</p>
                </div>
              </li>
              <!-- 03 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-03.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-03.svg">
                  <p class="TX">製造技術</p>
                </div>
              </li>
              <!-- 04 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-04.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-04.svg">
                  <p class="TX">設計から生産まで</p>
                </div>
              </li>
              <!-- 05 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-05.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-05.svg">
                  <p class="TX">柔軟な生産・納品</p>
                </div>
              </li>
              <!-- 06 -->
              <li class="item">
                <div class="bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-bg-06.webp">
                </div>
                <div class="txt">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_strength-item-icon-06.svg">
                  <p class="TX">部品購買・設計案件</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="front_message">
      <div class="all_sec_inner">
        <div class="front_message_inner s-pop">
          <h3 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_message-ttl.webp" alt="TOP MESSAGE">
          </h3>
          <p class="TX">
            ご要望を超えていくために、<br>
            まだ見ぬ領域へとお連れするために、<br>
            自らの限界をつくらない。<br>
            <span>オフロム株式会社 代表取締役社長　笈田 寿宏</span>
          </p>
          <div class="btn">
            <a class="C_more-btn" href="<?php echo home_url('/message'); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="front_contents">
      <div class="all_sec_inner">
        <div class="front_contents_inner">
          <div class="ttl_area s-pop">
            <h3 class="TL">
              <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-ttl-sp.svg" media="(max-width: 767px)">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-ttl.svg" alt="OTHER CONTENTS">
              </picture>
            </h3>
            <p class="TX">コンテンツ</p>
          </div>
          <ul class="lists_area">
            <!-- 01 -->
            <li class="item" s-pop>
              <div class="bg">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-sp-01.webp"
                    media="(max-width: 767px)">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-01.webp">
                </picture>
              </div>
              <div class="item_txt">
                <div class="ttl">
                  <h4 class="TL">
                    <picture>
                      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-sp-01.svg"
                        media="(max-width: 767px)">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-01.webp" alt="PRODUCT">
                    </picture>
                  </h4>
                  <p class="TX">
                    製品紹介
                  </p>
                </div>
                <div class="txt">
                  <p class="TX">
                    設計から製造・品質管理までをトータルで対応。<br>
                    世界基準のクオリティを約束します。
                  </p>
                </div>
                <div class="btn">
                  <a class="C_more-btn" href="<?php echo home_url('/product'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
                  </a>
                </div>
              </div>
            </li>
            <!-- 02 -->
            <li class="item s-pop" id="front-factory">
              <div class="bg">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-sp-02.webp"
                    media="(max-width: 767px)">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-02.webp">
                </picture>
              </div>
              <div class="item_txt TL-trans-02">
                <div class="ttl">
                  <h4 class="TL">
                    <picture>
                      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-sp-02.svg"
                        media="(max-width: 767px)">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-02.webp" alt="FACTORY">
                    </picture>
                  </h4>
                  <p class="TX">
                    工場・設備
                  </p>
                </div>
                <div class="txt">
                  <p class="TX">
                    経験・技そして先進設備との鮮やかな連携、<br>
                    高密度実装技術を軸としたトータルプロダクションを行います。
                  </p>
                </div>
                <div class="btn">
                  <a class="C_more-btn" href="<?php echo home_url('/factory'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
                  </a>
                </div>
              </div>
            </li>
            <!-- 03 -->
            <li class="item s-pop" id="front-company">
              <div class="bg">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-sp-03.webp"
                    media="(max-width: 767px)">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-03.webp">
                </picture>
              </div>
              <div class="item_txt">
                <div class="ttl">
                  <h4 class="TL TL-trans-03">
                    <picture>
                      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-sp-03.svg"
                        media="(max-width: 767px)">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-03.webp"
                        alt="COMPANY PROFILE">
                    </picture>
                  </h4>
                  <p class="TX">
                    会社概要・沿革
                  </p>
                </div>
                <div class="txt">
                  <p class="TX">
                    創業から40年の歴史をご覧ください。
                  </p>
                </div>
                <div class="btn">
                  <a class="C_more-btn" href="<?php echo home_url('/company'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
                  </a>
                </div>
              </div>
            </li>
            <!-- 04 -->
            <li class="item s-pop" id="front-english">
              <div class="bg">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-sp-04.webp"
                    media="(max-width: 767px)">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-bg-04.webp">
                </picture>
              </div>
              <div class="item_txt">
                <div class="ttl">
                  <h4 class="TL">
                    <picture>
                      <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-sp-04.svg"
                        media="(max-width: 767px)">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_contents-item-ttl-04.webp"
                        alt="ENGLISH PAGE">
                    </picture>
                  </h4>
                  <p class="TX">
                    海外の方へ
                  </p>
                </div>
                <div class="txt">
                  <p class="TX">
                    オフロムでは海外でのお客様からのご相談もお受けしています。<br>
                    試作製作・設計のご相談などお待ちしています。
                  </p>
                </div>
                <div class="btn">
                  <a class="C_more-btn" href="<?php echo home_url('/english'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="front_recruit" id="front-recruit">
      <div class="front_recruit_inner">
        <div class="ttl_area s-pop">
          <h3 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_recruit-ttl.svg" alt="RECRUIT">
          </h3>
          <p class="TX">採用情報</p>
        </div>
        <div class="item_area">
          <div class="bg">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front_recruit-item-bg-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front_recruit-item-bg.webp">
            </picture>
          </div>
          <div class="item_inner s-pop">
            <p class="TX">
              オフロムの若手社員にインタビュー。<br>
              技術部、製造部、管理部などのさまざまな社員に<br>
              現在の仕事内容や今後の目標や夢などの<br>
              「将来の道」について答えてもらいました。
            </p>
            <div class="btn">
              <a class="C_more-btn" href="<?php echo home_url('/recruit-index'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_more-btn-type03.svg" alt="MORE">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>