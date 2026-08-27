<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="page-front">

  <section class="front-kv">
    <div class="front-kv-branch-l">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-branch-l.webp" alt="">
    </div>
    <div class="front-kv-branch-r">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-branch-r.webp" alt="">
    </div>
    <div class="front-kv-lawn-l">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-lawn-l.webp" alt="">
    </div>
    <div class="front-kv-lawn-r">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-lawn-r.webp" alt="">
    </div>
    <div class="front-news-banner">
      <div class="front-news-banner-inr">
        <?php
        $latest_news = new WP_Query([
          'post_type'      => 'post',
          'posts_per_page' => 1,
          'no_found_rows'  => true,
        ]);
        if ($latest_news->have_posts()):
          while ($latest_news->have_posts()): $latest_news->the_post(); ?>
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
              $selected_cat = $categories[0];
              foreach ($categories as $cat) {
                if ($cat->slug === 'news') {
                  $selected_cat = $cat;
                  break;
                }
              }
              echo '<h2 class="TL">' . esc_html($selected_cat->name) . '</h2>';
            }
            ?>
            <a class="front-news-banner-link" href="<?php the_permalink(); ?>">
              <p class="TM"><?php the_time('Y.n.j'); ?></p>
              <h3 class="TX"><?php the_title(); ?></h3>
            </a>
        <?php endwhile;
          wp_reset_postdata();
        else: ?>
          <p class="nothing-TX">新着情報はありません</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="front-kv-contents">
      <div class="front-kv-contents-tree">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-tree.webp" alt="">
      </div>
      <div class="front-kv-contents-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-l-logo.svg" alt="つばさこども医院 小児外科/小児科">
      </div>
      <div class="front-kv-contents-char-01 fuwafuwa delay-02">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-char-01.webp" alt="">
      </div>
      <div class="front-kv-contents-char-02 fuwafuwa duration-12 delay-04">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-char-02.webp" alt="">
      </div>
      <div class="front-kv-contents-char-03 fuwafuwa delay-04">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-char-03.webp" alt="">
      </div>
      <div class="front-kv-contents-char-04 fuwafuwa duration-11 delay-06">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-char-04.webp" alt="">
      </div>
      <div class="front-kv-contents-char-05 fuwafuwa delay-01">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-contents-char-05.webp" alt="">
      </div>
    </div>
    <div class="front-kv-bg">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-bg.webp" alt="">
    </div>
    <div class="front-kv-white-bg"></div>
  </section>

  <div class="dummy-kv"></div>

  <div class="front-inr">
    <div class="front-abput_schedule">
      <section class="front-abput">
        <div class="front-abput-char">
          <div class="front-abput-char-img char-01 fuwafuwa delay-04">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-abput-char-01.webp" alt="">
          </div>
          <div class="front-abput-char-img char-02 fuwafuwa delay-08">
            <img class="front-abput-char-img char-02"
              src="<?php echo get_template_directory_uri(); ?>/img/front/front-abput-char-02.webp" alt="">
          </div>
        </div>
        <h2 class="TL">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-abput-ttl.svg" alt="見守りの森。">
        </h2>
        <div class="txt">
          <p class="TX">
            わたしたちは子どもたちが<br>
            未来へ羽ばたく“つばさ”を育むため、<br>
            “見守りの森”としてご家族とともに<br>
            一人ひとりの成長に寄り添います。
          </p>
        </div>
        <div class="btn">
          <a class="C_btn C_btn-pd-50" href="/about/">
            <p class="TX">当院について</p>
          </a>
        </div>
        <!-- <div class="front-abput-char-under">
          <div class="front-abput-char-under-img fuwafuwa duration-11 delay-03">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-abput-char-03.webp" alt="">
          </div>
        </div> -->
      </section>
    </div>
    <div class="front-services_about" id="front-services">
      <div class="front-services_about-char">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services_about-char.webp" alt="">
      </div>
      <section class="front-services">
        <div class="front-services-ttl">
          <div class="front-services-ttl-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-ttl-bg.webp" alt="">
          </div>
          <h2 class="TL">診療案内</h2>
        </div>
        <div class="front-services-txt">
          <p class="TX">
            当院は一般小児科診療に加え、小児外科診療も行っています。発熱や咳、腹痛だけでなく、けがの処置や小児外科疾患まで幅広く対応いたします。便秘、夜尿の治療には特に力を入れています。
          </p>
        </div>
        <ul class="front-services-links">
          <li class="link-item">
            <a class="link-item-inr" href="/pediatric-surgery">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX">小児外科</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
          <li class="link-item">
            <a class="link-item-inr" href="/pediatrics">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX">小児科</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
          <li class="link-item">
            <a class="link-item-inr" href="/constipation">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX">便秘外来</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
          <li class="link-item">
            <a class="link-item-inr" href="/nocturia">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX">夜尿外来</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
          <!-- <li class="link-item">
            <a class="link-item-inr" href="#">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX TX-mini">頭のかたち<br>外来</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li> -->
          <li class="link-item">
            <a class="link-item-inr" href="/prevention-screening">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX TX-mini">予防接種<br>・検診</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
          <li class="link-item">
            <a class="link-item-inr" href="/home-visit">
              <div class="link-item-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-bg.svg" alt="">
              </div>
              <div class="link-item-inr-txt">
                <p class="TX">訪問診療</p>
                <div class="arrow">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-link-arrow.svg" alt="">
                </div>
              </div>
            </a>
          </li>
        </ul>
        <div class="front-services-char">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-services-char.webp" alt="">
        </div>
      </section>
      <section class="front-about">
        <div class="front-about-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">手術について</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <div class="front-about-txt">
          <p class="TX">
            手術までの流れや対応疾患など詳しくご説明しています。患者様に安心して手術を受けていただけるよう、心をこめてサポートさせて頂きます。
          </p>
        </div>
        <div class="front-about-btn">
          <a class="C_btn C_btn-pd-55" href="about-surgery">
            <p class="TX">MORE</p>
          </a>
        </div>
      </section>
    </div>
    <div class="front-first_reserve_payment_news_access_recruit">
      <div class="front-first_reserve_payment_news_access_recruit-char fuwafuwa duration-11 delay-03">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first_reserve_payment_news_access_recruit-char.webp" alt="">
      </div>
      <section class="front-schedule" id="front-schedule">
        <div class="front-schedule-signboard">
          <div class="front-schedule-signboard-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-schedule-signboard-bg.webp" alt="">
          </div>
          <div class="front-schedule-signboard-inr">
            <div class="C_front-ttl">
              <div class="wing left-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
              <h2 class="TL">診療日程</h2>
              <div class="wing right-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
            </div>
            <div class="signboard-schedule">
              <?php get_template_part('inc/schedule-board'); ?>
            </div>
          </div>
          <!-- <div class="front-schedule-signboard-char fuwafuwa delay-05">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-schedule-signboard-char.webp" alt="">
          </div> -->
        </div>
      </section>
      <section class="front-access" id="front-access">
        <div class="front-access-char">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-access-char.webp" alt="">
        </div>
        <div class="front-access-bg">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-access-bg.webp" alt="">
        </div>
        <div class="front-access-inr">
          <div class="front-access-ttl">
            <div class="C_front-ttl">
              <div class="wing left-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
              <h2 class="TL">アクセス</h2>
              <div class="wing right-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
            </div>
          </div>
          <div class="front-access-txt">
            <p class="TX">
              〒921-8832 石川県野々市市藤平田1丁目269番地<br>
              TEL/076-282-7272
            </p>
          </div>
          <div class="front-access-map">
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.4201613315972!2d136.6061646!3d36.5198566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff835f275d80cf1%3A0xcdff084256c8c0fd!2z44CSOTIxLTg4MzIg55-z5bed55yM6YeO44CF5biC5biC6Jek5bmz55Sw77yR5LiB55uu77yS77yW77yZ!5e0!3m2!1sja!2sjp!4v1784271817826!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
            <a class="map-link" href="https://maps.app.goo.gl/qNZQryFcQEpv929n8"
              target="_blank" rel="noopener noreferrer">
              Google map を開く
              <img src="<?php echo get_template_directory_uri(); ?>/img/header/arrow-sp.svg" alt="">
            </a>
          </div>
        </div>
      </section>
      <!-- <section class="front-first" id="front-first">
        <div class="front-first-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">初めての方へ</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <div class="front-first-txt">
          <p class="TX">
            当院を初めて受診される方へのご案内をしております。当日のお持ち物や注意事項について、事前にご確認いただけますと幸いです。
          </p>
        </div>
        <div class="front-first-btn-area">
          <div class="front-first-btn-area-txt">
            <p class="TX">
              初めてのご来院の際は問診票の<br>ご入力をお願いいたします。
            </p>
          </div>
          <div class="front-first-btn-area-btn">
            <a class="C_btn C_btn-pd-45" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'questionnaire')); ?>" target="_blank" rel="noopener noreferrer">
              <p class="TX">問診票はこちら</p>
            </a>
          </div>
        </div>
        <div class="front-first-items_sec">
          <div class="items-main">
            <div class="items-main-char">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first-items_sec-main-char.webp" alt="">
            </div>
            <div class="items-main-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first-items_sec-main-bg.webp" alt="">
            </div>
            <div class="items-main-inr">
              <div class="C_front-inr-ttl">
                <div class="C_front-inr-ttl-icon">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-inr-ttl-icon.svg" alt="">
                </div>
                <h3 class="TL">来院時のお持ちもの</h3>
              </div>
              <ul class="items-main-inr-lists">
                <li class="TX">マイナ保険証もしくは資格確認書</li>
                <li class="TX">乳幼児医療証</li>
                <li class="TX">母子手帳</li>
                <li class="TX">紹介状（お持ちの方）</li>
                <li class="TX">お薬手帳(お持ちの場合)</li>
                <li class="TX">おむつの予備</li>
              </ul>
            </div>
          </div>
          <div class="items-point">
            <p class="TX">
              ※保険証をお持ちでない場合、自費での診療となりますのでご注意ください。
            </p>
          </div>
        </div>
        <div class="front-first-please_sec">
          <div class="please-main">
            <div class="please-main-char">
              <div class="char-01">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first-please_sec-main-char-01.webp" alt="">
              </div>
              <div class="char-02">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first-please_sec-main-char-02.webp" alt="">
              </div>
            </div>
            <div class="please-main-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-first-please_sec-main-bg.webp" alt="">
            </div>
            <div class="please-main-inr">
              <div class="C_front-inr-ttl">
                <div class="C_front-inr-ttl-icon">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-inr-ttl-icon.svg" alt="">
                </div>
                <h3 class="TL">ご理解・ご協力のお願い</h3>
              </div>
              <ul class="please-main-inr-lists">
                <li class="TX">
                  ダミー初診の方は、カルテの登録があるため予約時間の10分前にご来院ください。
                </li>
                <li class="TX">
                  お子様の症状、月齢によって診察の順番が前後する場合や、急な処置・検査により診察に時間がかかる場合があります。
                </li>
                <li class="TX">
                  発熱含む感染症の疑いのある方は必ず予約を取った上で、当院の駐車場へお越しいただき、駐車場係員の指示に従ってください。
                </li>
                <li class="TX">
                  初診の場合は必ず保護者同伴でご受診をお願いします。
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section> -->
      <!-- <section class="front-payment" id="front-payment">
        <div class="front-payment-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">お支払いについて</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <div class="front-payment-txt">
          <p class="TX">
            ダミー予防接種や健康診断などすべての診療で、現金または、下記のクレジットカードや電子決済をご利用可能です。
          </p>
        </div>
        <div class="front-payment-logo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-payment-logo.webp"
            alt="VISA/MASTER/JCB/AMEX/PayPay/楽天ペイ">
        </div>
      </section> -->
      <section class="front-contact">
        <div class="front-contact-char">
          <div class="char-01 fuwafuwa delay-06">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-contact-char-01.webp" alt="">
          </div>
          <div class="char-02">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-contact-char-02.webp" alt="">
          </div>
        </div>
        <div class="front-contact-bg">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-contact-bg.webp" alt="">
        </div>
        <div class="front-contact-inr">
          <div class="front-contact-ttl">
            <div class="C_front-ttl">
              <div class="wing left-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
              <h2 class="TL">お問い合わせ</h2>
              <div class="wing right-wing">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
              </div>
            </div>
          </div>
          <div class="front-contact-txt">
            <p class="TX">
              当院にご質問のある方はお気軽にお問い合わせください。
            </p>
          </div>
          <div class="front-contact-btn">
            <a class="C_btn C_btn-pd-45" href="/contact">
              <p class="TX">お問い合わせフォーム</p>
            </a>
          </div>
        </div>
      </section>
      <!-- <section class="front-reserve">
        <div class="front-reserve-char">
          <div class="char-01 fuwafuwa delay-06">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-reserve-char-01.webp" alt="">
          </div>
          <div class="char-02">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-reserve-char-02.webp" alt="">
          </div>
        </div>
        <div class="front-reserve-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">ご予約について</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <div class="front-reserve-txt">
          <p class="TX">
            ダミーWEBにてご予約を受け付けております。フォームよりご予約が可能です。24時間受付ておりますので、お気軽にご利用ください。
          </p>
        </div>
        <div class="front-reserve-btn">
          <a class="C_btn C_btn-pd-55" href="<?php echo esc_url(SCF::get_option_meta('site-settings', 'web_reserve')); ?>" target="_blank" rel="noopener noreferrer">
            <p class="TX">WEB予約</p>
          </a>
        </div>
      </section> -->
      <!-- <section class="front-news">
        <div class="front-news-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">新着情報</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <ul class="front-news-posts">
          <?php
          $front_news = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 2,
            'no_found_rows'  => true,
          ]);
          if ($front_news->have_posts()):
            while ($front_news->have_posts()): $front_news->the_post(); ?>
              <li class="news-post">
                <a class="news-post-inr" href="<?php the_permalink(); ?>">
                  <div class="info-wrap">
                    <div class="icon">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-inr-ttl-icon.svg" alt="">
                    </div>
                    <p class="TM"><?php the_time('Y.m.d'); ?></p>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                      $selected_cat = $categories[0];
                      foreach ($categories as $cat) {
                        if ($cat->slug === 'news') {
                          $selected_cat = $cat;
                          break;
                        }
                      }
                      echo '<p class="TG">' . esc_html($selected_cat->name) . '</p>';
                    }
                    ?>
                  </div>
                  <div class="ttl-wrap">
                    <h3 class="TL"><?php the_title(); ?></h3>
                  </div>
                </a>
              </li>
          <?php endwhile;
            wp_reset_postdata();
          endif; ?>
        </ul>
      </section> -->
      <!-- <section class="front-recruit">
        <div class="front-recruit-ttl">
          <div class="C_front-ttl">
            <div class="wing left-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
            <h2 class="TL">採用情報</h2>
            <div class="wing right-wing">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
            </div>
          </div>
        </div>
        <div class="front-recruit-txt">
          <p class="TX">
            当院で一緒に働く方を募集しております。たくさんのご応募心よりお待ちしております。
          </p>
        </div>
        <div class="front-recruit-btn">
          <a class="C_btn C_btn-pd-50" href="/recruit">
            <p class="TX">募集要項</p>
          </a>
        </div>
        <div class="front-recruit-char">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-contact-char.webp" alt="">
        </div>
      </section> -->
      <div class="front-tug_of_war-char">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-tug_of_war-char.webp" alt="">
      </div>
    </div>

    <div class="front-tug_of_war"></div>

  </div>

</div>

<?php get_template_part('./inc/footer'); ?>