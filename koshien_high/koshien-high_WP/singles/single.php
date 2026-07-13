<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="page page--news-single">

  <?php if (have_posts()) : while (have_posts()) : the_post();

    // 日付（ACF優先）
    $news_date = function_exists('get_field') ? get_field('news_date') : '';
    if (!$news_date) $news_date = get_the_date('Y.m.d');

    // カテゴリ・学校区分
    $cats = get_the_terms(get_the_ID(), 'news_category');
    $cat_slug = ($cats && !is_wp_error($cats)) ? $cats[0]->slug : '';
    $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
    $schools = get_the_terms(get_the_ID(), 'news_school');
    $school_slug = ($schools && !is_wp_error($schools)) ? $schools[0]->slug : '';
    $school_name = ($schools && !is_wp_error($schools)) ? $schools[0]->name : '';

    // メイン画像（ACF）
    $main = '';
    if (function_exists('get_field')) {
      $m = get_field('news_main');
      if (is_array($m)) $main = !empty($m['url']) ? $m['url'] : '';
      elseif (is_string($m)) $main = $m;
    }

    // 本文（ACF）
    $body = function_exists('get_field') ? get_field('news_body') : '';
  ?>

  <article class="p-news-single">
    <div class="p-news-single__inner">

      <div class="p-news-single__meta js-fade">
        <time class="p-news-single__date"><?php echo esc_html($news_date); ?></time>
        <?php if ($cat_name) : ?>
        <span class="p-news-single__cat p-news-single__cat--<?php echo esc_attr($cat_slug); ?>"><?php echo esc_html($cat_name); ?></span>
        <?php endif; ?>
        <?php if ($school_name) : ?>
        <span class="p-news-single__school p-news-single__school--<?php echo esc_attr($school_slug); ?>"><?php echo esc_html($school_name); ?></span>
        <?php endif; ?>
      </div>

      <h1 class="p-news-single__ttl js-fade"><?php the_title(); ?></h1>

      <?php if ($main) : ?>
      <div class="p-news-single__img js-fade">
        <img src="<?php echo esc_url($main); ?>" alt="<?php the_title_attribute(); ?>">
      </div>
      <?php endif; ?>

      <div class="p-news-single__body js-fade">
        <?php echo $body; ?>
      </div>

      <div class="p-news-single__back js-fade">
        <a href="<?php echo home_url('/news/'); ?>" class="p-news-single__back-btn">
          <span>一覧に戻る</span>
          <span class="p-news-single__back-icon" aria-hidden="true"></span>
        </a>
      </div>

    </div>

    <!-- 関連記事 -->
    <section class="p-news-related js-fade">
      <h2 class="p-news-related__ttl">関連記事</h2>
      <ul class="p-news-related__list">
        <?php
        $related = new WP_Query(array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'post__not_in'   => array(get_the_ID()),
          'orderby'        => 'date',
          'order'          => 'DESC',
          'tax_query'      => $cat_slug ? array(array(
            'taxonomy' => 'news_category',
            'field'    => 'slug',
            'terms'    => $cat_slug,
          )) : array(),
        ));
        if ($related->have_posts()) : while ($related->have_posts()) : $related->the_post();
          $r_date = function_exists('get_field') ? get_field('news_date') : '';
          if (!$r_date) $r_date = get_the_date('Y.m.d');
          $r_cats = get_the_terms(get_the_ID(), 'news_category');
          $r_cat_name = ($r_cats && !is_wp_error($r_cats)) ? $r_cats[0]->name : '';
          $r_thumb = '';
          if (function_exists('get_field')) {
            $rt = get_field('news_thumb');
            if (is_array($rt)) $r_thumb = !empty($rt['url']) ? $rt['url'] : '';
            elseif (is_string($rt)) $r_thumb = $rt;
          }
          if (!$r_thumb) $r_thumb = get_template_directory_uri() . '/img/common/noimage.svg';
        ?>
        <li class="p-news-related__item">
          <a href="<?php the_permalink(); ?>" class="p-news-related__card">
            <div class="p-news-related__thumb">
              <img src="<?php echo esc_url($r_thumb); ?>" alt="">
            </div>
            <div class="p-news-related__meta">
              <time class="p-news-related__date"><?php echo esc_html($r_date); ?></time>
              <?php if ($r_cat_name) : ?>
              <span class="p-news-related__cat"><?php echo esc_html($r_cat_name); ?></span>
              <?php endif; ?>
            </div>
            <p class="p-news-related__text"><?php echo esc_html(get_the_title()); ?></p>
          </a>
        </li>
        <?php endwhile; wp_reset_postdata(); endif; ?>
      </ul>
    </section>

  </article>

  <?php endwhile; endif; ?>

</main>

<?php get_template_part('./inc/footer'); ?>