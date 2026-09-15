<?php get_template_part('./inc/head'); ?>

<?php get_template_part('./inc/header'); ?>

<div class="p-front">

  <a href="<?php echo home_url(); ?>/admission/" class="p-front__fixed-banner fade">
    <img src="<?php echo get_template_directory_uri(); ?>/img/front_admission_banner.png" alt="受験をお考えの方" class="u-w100" loading="lazy">
  </a>

  <?php
  /*--------------------------------------------------------
   * MARK: コンセプト
  --------------------------------------------------------*/
  ?>
  <section class="p-front-concept">
    
    <div class="p-front-concept__link">
      <a href="<?php echo home_url(); ?>/brand/" class="c-btn">
        <div class="c-btn__inner"><span class="font-avenir">BRAND CONCEPT</span></div>
      </a>
    </div>

    <div class="p-front-concept__bg">
      <picture>
        <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_concept_bg_sp.png">
        <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_concept_bg.png" alt="心と心がつながる小学校" loading="lazy">
      </picture>
    </div>

    <div class="p-front-concept__movie">
      <div class="pc-none">
        <!-- video -->
        <video class="p-front-concept__video" autoplay muted loop playsinline poster="<?php echo get_template_directory_uri(); ?>/img/front_concept.jpg">
          <source src="<?php echo get_template_directory_uri(); ?>/movie/front_concept_sp.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      
      <div class="sp-none">
        <video class="p-front-concept__video" autoplay muted loop playsinline poster="<?php echo get_template_directory_uri(); ?>/img/front_concept.jpg">
          <source src="<?php echo get_template_directory_uri(); ?>/movie/front_concept.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>

    <!-- <picture>
      <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_concept_sp.jpg">
      <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_concept.jpg" alt="心と心がつながる小学校">
    </picture> -->
  </section>


  <?php
  /*--------------------------------------------------------
   * MARK: NEWS
  --------------------------------------------------------*/
  ?>
  <section class="p-front-news">

    <div class="p-front-news__inner">

      <div class="p-front-news__title c-title">
        <p class="c-title__label font-jost">NEWS</p>
        <h2 class="c-title__text">新着情報</h2>
      </div>

      <?php
      // ニュースカテゴリ一覧: 'term' はスラッグ / 名前 / ID のいずれかを指定できます。
      $news_categories = array(
          array( 'term' => '', 'label' => 'すべて' ),
          array( 'term' => 'お知らせ', 'label' => 'お知らせ' ),
          array( 'term' => 'event', 'label' => 'イベント' ),
          array( 'term' => 'action', 'label' => '活動記録' ),
          array( 'term' => 'admissions-information', 'label' => '入試情報' ),
      );
      $first_term = $news_categories[0]['term'];
      ?>

      <div class="p-front-news-list js-scroll-target a-fadeInUp">

        <div class="p-front-news-list__category pc-mgb-60">
          <div class="p-front-news-list__category__inner">
            <?php foreach ( $news_categories as $entry ) : $term = $entry['term']; $label = $entry['label']; ?>
              <a href="#" class="c-label <?php echo ( $term === $first_term ) ? 'is-current' : ''; ?>" data-cat="<?php echo esc_attr( $term ); ?>"><?php echo esc_html( $label ); ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <?php foreach ( $news_categories as $entry ) : $term = $entry['term']; ?>
          <div class="p-archive sp-mgt-20 js-news-list" data-cat="<?php echo esc_attr( $term ); ?>" <?php if ( $term !== $first_term ) echo 'style="display:none"'; ?> >
              <?php
              if ( function_exists( 'koshien_render_news_items' ) ) {
                koshien_render_news_items( $term );
              } else {
                // Fallback: output latest 6 posts if helper missing
                $fallback_args = array(
                  'posts_per_page' => 6,
                  'post_status'    => 'publish',
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                );
                if ( ! empty( $term ) ) {
                  // try resolving term as name/slug
                  $resolved = get_term_by( 'slug', $term, 'category' );
                  if ( ! $resolved ) {
                    $resolved = get_term_by( 'name', $term, 'category' );
                  }
                  if ( $resolved ) {
                    $fallback_args['category__in'] = array( intval( $resolved->term_id ) );
                  }
                }
                $fallback_posts = get_posts( $fallback_args );
                if ( $fallback_posts ) {
                  foreach ( $fallback_posts as $post ) {
                    setup_postdata( $post );
                    $thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
                    if ( ! $thumb ) { $thumb = get_template_directory_uri() . '/img/no-image.jpg'; }
                    ?>
                    <a class="p-archive__item" href="<?php echo esc_url( get_permalink( $post ) ); ?>">
                      <div class="p-archive__image pc-mgb-10"><img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy"></div>
                      <div class="p-archive__content">
                        <div class="p-archive__head pc-mgb-5">
                          <span class="p-archive__date font-avenir"><?php echo esc_html( get_the_date( 'Y.m.d', $post ) ); ?></span>
                          <div><span class="c-label"><?php $cats = get_the_category( $post ); echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : ''; ?></span></div>
                        </div>
                        <span class="p-archive__title"><?php echo esc_html( get_the_title( $post ) ); ?></span>
                      </div>
                    </a>
                    <?php
                  }
                  wp_reset_postdata();
                } else {
                  echo '<p class="p-archive__none">記事はありません。</p>';
                }
              }
              ?>
          </div>
        <?php endforeach; ?>

        <script>
        (function(){
          var tabs = document.querySelectorAll('.p-front-news-list__category__inner .c-label');
          var lists = document.querySelectorAll('.js-news-list');
          tabs.forEach(function(tab){
            tab.addEventListener('click', function(e){
              e.preventDefault();
              var cat = tab.getAttribute('data-cat');
              tabs.forEach(function(t){ t.classList.remove('is-current'); });
              tab.classList.add('is-current');
              lists.forEach(function(list){
                if(list.getAttribute('data-cat') === cat){
                  list.style.display = '';
                } else {
                  list.style.display = 'none';
                }
              });
            });
          });
        })();
        </script>

      </div>
      
      <div class="p-front-news__btn pc-mgt-0 sp-mgt-50">
        <a href="<?php echo home_url(); ?>/news/" class="c-btn c-btn--fill">
          <div class="c-btn__inner"><span>新着情報一覧へ</span></div>
        </a>
      </div>

    </div>



  </section>


  <?php
  /*--------------------------------------------------------
   * MARK: 心がつながった児童たち
  --------------------------------------------------------*/
  ?>
  <section class="p-front-appeal">
    <h2 class="p-front-appeal__title pc-mgb-60 sp-mgb-50 font-marumin-old js-scroll-target a-fadeInUp">
      心が<br class="pc-none">つながった<br class="pc-none">児童たち
    </h2>

    <div class="p-front-appeal__icon pc-mgb-30 sp-mgb-60 js-scroll-target a-fadeInUp">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front_appeal.png" alt="心と心がつながったらどうなるの？" loading="lazy" class="u-w100">
    </div>

    <div class="p-front-appeal__list js-scroll-target a-fadeInUp">
      <div class="p-front-appeal__swiper swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">児童×教員</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_1_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_1.webp" alt="児童×教員" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec01" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">教員と心がつながると？</span></div>
              </a>
            </div>
          </div>
          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">児童×児童</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_2_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_2.jpg" alt="児童×児童" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec02" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">児童同士で心がつながると？</span></div>
              </a>
            </div>
          </div>
          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">下級生×上級生</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_3_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_3.webp" alt="下級生×上級生" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec03" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">学年を超えて心がつながると？</span></div>
              </a>
            </div>
          </div>
          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">児童×教員</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_1_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_1.jpg" alt="児童×教員" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec01" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">教員と心がつながると？</span></div>
              </a>
            </div>
          </div>
          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">児童×児童</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_2_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_2.jpg" alt="児童×児童" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec02" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">児童同士で心がつながると？</span></div>
              </a>
            </div>
          </div>
          <div class="swiper-slide p-front-appeal-item">
            <p class="p-front-appeal-item__text font-avenir-thin">下級生×上級生</p>
            <picture>
              <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_appeal_3_sp.jpg">
              <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_appeal_3.jpg" alt="下級生×上級生" loading="lazy">
            </picture>
            <div class="p-front-appeal-item__btn">
              <a href="<?php echo home_url(); ?>/connected-hearts/#sec03" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span class="font-avenir">学年を超えて心がつながると？</span></div>
              </a>
            </div>
          </div>

        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

  </section>


  <section class="p-front-banners">
    <a class="p-front-banner fade" href="<?php echo home_url(); ?>/manabi/">
      <div class="js-scroll-target a-fadeInUp">
        <div class="p-front-banner-info"> 
          <span class="p-front-banner-info__top font-avenir-bold">Learning</span>
          <span class="p-front-banner-info__bottom">心がつながる学び</span>
        </div>
        <picture class="p-front-banner-image">
          <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_banner_1_sp.jpg">
          <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_banner_1.jpg" alt="心と心がつながる小学校">
        </picture>
      </div>
    </a>

    <a class="p-front-banner fade" href="<?php echo home_url(); ?>/environment/">
      <div class="js-scroll-target a-fadeInUp">
        <div class="p-front-banner-info"> 
          <span class="p-front-banner-info__top font-avenir-bold">Environment</span>
          <span class="p-front-banner-info__bottom">心を磨く環境</span>
        </div>
        <picture class="p-front-banner-image">
          <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_banner_2_sp.jpg">
          <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_banner_2.jpg" alt="心を磨く環境">
        </picture>
      </div>
    </a>

    <div class="p-front-banners__flex">
      <a class="p-front-banner fade" href="<?php echo home_url(); ?>/result/">
        <div class="js-scroll-target a-fadeInUp">
          <div class="p-front-banner-info"> 
            <span class="p-front-banner-info__top font-avenir-bold">Achievment</span>
            <span class="p-front-banner-info__bottom">進学実績・卒業生</span>
          </div>
          <picture class="p-front-banner-image">
            <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_banner_3_sp.jpg">
            <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_banner_3.jpg" alt="進学実績・卒業生">
          </picture>
        </div>
      </a>
      <a class="p-front-banner fade" href="<?php echo home_url(); ?>/schedule/">
        <div class="js-scroll-target a-fadeInUp">
          <div class="p-front-banner-info"> 
            <span class="p-front-banner-info__top font-avenir-bold">Schedule</span>
            <span class="p-front-banner-info__bottom">年間スケジュール</span>
          </div>
          <picture class="p-front-banner-image">
            <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_banner_4_sp.jpg">
            <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_banner_4.jpg" alt="年間スケジュール">
          </picture>
        </div>
      </a>
    </div>

    <a class="p-front-banner fade" href="<?php echo home_url(); ?>/admission/">
      <div class="js-scroll-target a-fadeInUp">
        <div class="p-front-banner-info"> 
          <span class="p-front-banner-info__top font-avenir-bold">Admission Guide</span>
          <span class="p-front-banner-info__bottom">入試情報</span>
        </div>
        <picture class="p-front-banner-image">
          <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_banner_5_sp.jpg">
          <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/front_banner_5.jpg" alt="入試情報">
        </picture>
      </div>
    </a>

  </section>


  <section class="js-scroll-target a-fadeInUp">  
    <div class="p-endress-auto-slide">
      <div class="p-endress-auto-slide__track">
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_1.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_2.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_3.png" alt=""></div>
        <!-- duplicate for seamless loop -->
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_1.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_2.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_3.png" alt=""></div>
      </div>
    </div>

    <!-- 逆向き -->
    <div class="p-endress-auto-slide p-endress-auto-slide--reverse">
      <div class="p-endress-auto-slide__track">
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_4.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_5.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_6.png" alt=""></div>
        <!-- duplicate for seamless loop -->
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_4.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_5.png" alt=""></div>
        <div class="p-endress-auto-slide__item"><img src="<?php echo get_template_directory_uri(); ?>/img/front-endress_6.png" alt=""></div>
      </div>
    </div>
  </section>

  <section class="p-front-links">
    <a class="p-front-links__item fade" href="<?php echo home_url(); ?>/recruit/">
      <picture>
        <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_link_1_sp.png">
        <img class="u-w100 js-scroll-target a-fadeInUp" src="<?php echo get_template_directory_uri(); ?>/img/front_link_1.png" alt="  子どもたちの心をつくる仕事。自分自身の心をみがく仕事。">
      </picture>
    </a>
    <a class="p-front-links__item fade" href="<?php echo home_url(); ?>/contact/">
      <picture>
        <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_link_2_sp.png">
        <img class="u-w100 js-scroll-target a-fadeInUp" src="<?php echo get_template_directory_uri(); ?>/img/front_link_2.png" alt="資料請求をする">
      </picture>
    </a>
    <a class="p-front-links__item fade" href="https://koshiengakuin.voiceados02.com/vision/" target="_blank">
      <picture>
        <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/front_link_3_sp.png">
        <img class="u-w100 js-scroll-target a-fadeInUp" src="<?php echo get_template_directory_uri(); ?>/img/front_link_3.png" alt="99 years vision">
      </picture>
    </a>
  </section>

</div>

<?php get_template_part('./inc/footer'); ?>
