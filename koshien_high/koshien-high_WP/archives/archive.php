<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="page page--news-archive">

  <!-- FV（NEWS 新着情報） -->
  <section class="p-news-archive-fv js-fade">
    <div class="p-news-archive-fv__bg">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/news/news-kv_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/news/news-kv_pc.webp" alt="">
      </picture>
    </div>
    <div class="p-news-archive-fv__ttl">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/news/news-ttl_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/news/news-ttl_pc.webp" alt="NEWS　新着情報">
      </picture>
    </div>
  </section>

  <section class="p-news-archive">
    <div class="p-news-archive__inner">

      <!-- タブ絞り込み -->
      <div class="p-news-archive__tabs js-fade" role="tablist">
        <button class="p-news-archive__tab is-active" data-filter="all" type="button">すべて</button>
        <button class="p-news-archive__tab" data-filter="info" type="button">お知らせ</button>
        <button class="p-news-archive__tab" data-filter="exam" type="button">入試情報</button>
        <button class="p-news-archive__tab" data-filter="event" type="button">イベント</button>
        <button class="p-news-archive__tab" data-filter="club" type="button">部活動</button>
      </div>

      <!-- 記事一覧 -->
      <ul class="p-news-archive__list" id="js-news-list">
        <?php if (have_posts()) : while (have_posts()) : the_post();

          $news_date = function_exists('get_field') ? get_field('news_date') : '';
          if (!$news_date) $news_date = get_the_date('Y.m.d');

          $cats = get_the_terms(get_the_ID(), 'news_category');
          $cat_slug = ($cats && !is_wp_error($cats)) ? $cats[0]->slug : '';
          $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
          $schools = get_the_terms(get_the_ID(), 'news_school');
          $school_slug = ($schools && !is_wp_error($schools)) ? $schools[0]->slug : '';
          $school_name = ($schools && !is_wp_error($schools)) ? $schools[0]->name : '';

          $thumb = '';
          if (function_exists('get_field')) {
            $t = get_field('news_thumb');
            if (is_array($t)) $thumb = !empty($t['url']) ? $t['url'] : '';
            elseif (is_string($t)) $thumb = $t;
          }
          if (!$thumb) $thumb = get_template_directory_uri() . '/img/common/noimage.svg';
        ?>
        <li class="p-news-archive__item js-fade" data-category="<?php echo esc_attr($cat_slug); ?>">
          <a href="<?php the_permalink(); ?>" class="p-news-archive__card">
            <div class="p-news-archive__thumb">
              <?php if ($school_name) : ?>
              <span class="p-news-archive__school p-news-archive__school--<?php echo esc_attr($school_slug); ?>"><?php echo esc_html($school_name); ?></span>
              <?php endif; ?>
              <img src="<?php echo esc_url($thumb); ?>" alt="">
            </div>
            <div class="p-news-archive__meta">
              <time class="p-news-archive__date"><?php echo esc_html($news_date); ?></time>
              <?php if ($cat_name) : ?>
              <span class="p-news-archive__cat p-news-archive__cat--<?php echo esc_attr($cat_slug); ?>"><?php echo esc_html($cat_name); ?></span>
              <?php endif; ?>
            </div>
            <p class="p-news-archive__text"><?php the_title(); ?></p>
          </a>
        </li>
        <?php endwhile; else : ?>
        <li class="p-news-archive__empty">お知らせはまだありません。</li>
        <?php endif; ?>
      </ul>

      <!-- さらに読み込む -->
      <div class="p-news-archive__more">
        <button class="p-news-archive__more-btn" id="js-news-more" type="button">
          <span>さらに読み込む</span>
          <span class="p-news-archive__more-icon" aria-hidden="true"></span>
        </button>
      </div>

    </div>
  </section>

</main>

<?php get_template_part('./inc/footer'); ?>