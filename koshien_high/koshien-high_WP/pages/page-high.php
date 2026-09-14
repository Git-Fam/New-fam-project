<?php
/*
Template Name: 高等学校
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high page--high-all">

  <section class="high-hiro">
    <div class="high-hiro-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-sp.webp" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-pc.webp" alt="">
      </picture>
    </div>
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-ttl-sp.svg" media="(max-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-hiro-ttl-pc.svg" alt="あなたの好きを見つける高等学校 FIND LOVE!">
      </picture>
    </h2>
  </section>

  <div class="high-news_banner-wrap">

    <section class="high-news js-fade">
      <div class="ttl">
        <h2 class="TL">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-news-ttl-sp.svg" media="(max-width: 768px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-ttl-pc.svg" alt="NEWS 新着情報">
          </picture>
        </h2>
      </div>
      <div class="news-contents">
        <div class="news-category">
          <div class="news-category-item-wrap">
            <a href="#" class="news-category-item hover-opa is-active" data-filter="all">すべて</a>
            <a href="#" class="news-category-item hover-opa" data-filter="info">お知らせ</a>
            <a href="#" class="news-category-item hover-opa" data-filter="exam">入試情報</a>
            <a href="#" class="news-category-item hover-opa" data-filter="event">イベント</a>
            <a href="#" class="news-category-item hover-opa" data-filter="club">部活動</a>
          </div>
        </div>
        <div class="news-list">
          <div class="news-list-iner">
            <?php
            $high_query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'news_school',
                        'field'    => 'slug',
                        'terms'    => array('high'), // ← 高校のスラッグ。違えば差し替え
                    ),
                ),
            ));
            if ($high_query->have_posts()):
                while ($high_query->have_posts()): $high_query->the_post();

                $news_date = get_field('news_date');
                if (!$news_date) {
                    $news_date = get_the_date('Y.m.d');
                }

                $cats = get_the_terms(get_the_ID(), 'news_category');
                $cat_slug = ($cats && !is_wp_error($cats)) ? $cats[0]->slug : '';
                $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';

                $schools = get_the_terms(get_the_ID(), 'news_school');
                $school_slug = ($schools && !is_wp_error($schools)) ? $schools[0]->slug : '';
                $school_name = ($schools && !is_wp_error($schools)) ? $schools[0]->name : '';

                $thumb = '';
                if (function_exists('get_field')) {
                    $thumb_raw = get_field('news_thumb');
                    if (is_array($thumb_raw)) {
                        $thumb = !empty($thumb_raw['url']) ? $thumb_raw['url'] : '';
                    } elseif (is_string($thumb_raw)) {
                        $thumb = $thumb_raw;
                    }
                }
                if (!$thumb) {
                    $thumb = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'medium')
                        : get_template_directory_uri() . '/img/common/noimage.webp';
                }
            ?>
            <a class="news-list-item hover-opa" href="<?php the_permalink(); ?>"
               data-category="<?php echo esc_attr($cat_slug); ?>"
               data-school="<?php echo esc_attr($school_slug); ?>">
              <div class="img-wrap">
                <?php if ($school_name): ?>
                <div class="school-name"><?php echo esc_html($school_name); ?></div>
                <?php endif; ?>
                <img src="<?php echo esc_url($thumb); ?>" alt="">
              </div>
              <div class="contents">
                <div class="date-wrap">
                  <p class="date"><?php echo esc_html($news_date); ?></p>
                  <?php if ($cat_name): ?>
                  <div class="tag"><?php echo esc_html($cat_name); ?></div>
                  <?php endif; ?>
                </div>
                <h3 class="TL"><?php echo esc_html(get_the_title()); ?></h3>
              </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
            <p class="news-list-empty">現在お知らせはありません。</p>
            <?php endif; ?>
          </div>
        </div>
        <a href="<?php echo home_url('/news/'); ?>" class="news-btn">
          <div class="pc hover-opa">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-pc.svg" alt="NEWS 新着情報">
          </div>
          <div class="sp">
            <img class="normal" src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-sp.svg" alt="NEWS 新着情報">
            <img class="hover" src="<?php echo get_template_directory_uri(); ?>/img/high/high-news-btn-sp-hov.svg" alt="NEWS 新着情報">
          </div>
        </a>
      </div>
    </section>

    <section class="high-banner js-fade">
      <a class="high-banner-item hover-opa" href="<?php echo home_url('/high/why/'); ?>">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-01-pc.webp" alt="">
        </picture>
      </a>
      <a class="high-banner-item hover-opa" href="<?php echo home_url('/high/course/'); ?>">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-02-pc.webp" alt="">
        </picture>
      </a>
    </section>
  </div>

  <section class="high-change js-fade">
    <div class="ttl">
      <h2 class="TL">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-ttl-sp.svg" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-ttl-pc.svg" alt="LOVE CHANGE">
        </picture>
      </h2>
    </div>
    <div class="high-change-contents">
      <a href="<?php echo home_url('/high/changed/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed2/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed3/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed4/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-04-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed5/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-05-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-05-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed6/'); ?>" class="high-change-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-06-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-06-pc.webp" alt="">
        </picture>
      </a>
    </div>
    <div class="high-change-pagination"></div>
  </section>

  <div class="high-news_banner-wrap high-banner-wrap">
    <div class="high-banner js-fade">
      <a class="high-banner-item hover-opa" href="<?php echo home_url('/high/feature/'); ?>">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-03-pc.webp" alt="">
        </picture>
      </a>
      <a class="high-banner-item hover-opa" href="<?php echo home_url('/high/openschool/'); ?>">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-banner-04-pc.webp" alt="">
        </picture>
      </a>
    </div>
  </div>

  <section class="high-info js-fade">
    <div class="high-info-inr">
      <a href="<?php echo home_url('/high/admission/'); ?>" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-01-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/life/'); ?>" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-02-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/club/'); ?>" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-03-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/career/'); ?>" class="high-info-item">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-info-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-info-04-pc.webp" alt="">
        </picture>
      </a>
    </div>
  </section>


</main>

<div class="high-float-banner" id="js-float-banner">
  <a href="<?php echo home_url('/high/admission/'); ?>" class="high-float-banner-link">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/common/high-float-banner-pc.webp" media="(max-width: 768px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/common/high-float-banner-pc.webp" alt="入試情報はこちら">
    </picture>
  </a>
</div>


<?php get_template_part('./inc/footer'); ?>