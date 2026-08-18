<?php get_template_part('./inc/head'); ?>

<!-- ローディング -->
<!-- <div class="loading">
  <div class="loading-inner loading-end">
    <div class="logo">
      <img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/img/loading/loding-logo-w.svg" alt="甲子園学院ロゴ">
      <img class="logo-name" src="<?php echo get_template_directory_uri(); ?>/img/loading/loding-logo-w-txt.svg" alt="学ぶことは、心を磨くこと / 甲子園学院 / KOSHIEN GAKUIN">
    </div>
    <div class="school-names">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/loading/loding-school-names-pc.svg" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/loading/loding-school-names-sp.svg"
          alt="甲子園大学 / 甲子園短期大学 / 甲子園学院小学校 / 甲子園学院中学校・高等学校 / 甲子園学院幼稚園">
      </picture>
    </div>
  </div>
</div> -->

<div class="loading">
  <div class="loading-inner">
    <div class="logo">
      <img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/img/loading/loding-logo-w.svg" alt="甲子園学院ロゴ">
      <img class="logo-name" src="<?php echo get_template_directory_uri(); ?>/img/loading/loding-logo-w-txt.svg" alt="甲子園学院">
    </div>
  </div>
</div>

<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->

<div class="page-front">

  <section class="front_kv">
    <div class="front_kv--logo">
      <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-fv-logo.webp" alt="">
    </div>
    <h2 class="TL">
      <picture class="front_kv--slide slide-01">
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-pc01.webp" media="(min-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-sp01.webp" alt="学ぶことは、心を磨くこと">
      </picture>
      <picture class="front_kv--slide slide-02">
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-pc02.webp" media="(min-width: 768px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-kv-sp02.webp" alt="学ぶことは、心を磨くこと">
      </picture>
    </h2>
  </section>

  <div class="page-front--inner">

    <section class="front_top-txt">
      <div class="txt">
        <p class="TX anime-fade">
          あなたの人生をつくるのは、<br class="sp">あなた自身の心です。<br>
          わたしたちが生きる社会をつくるのは、<br class="sp">わたしたち自身の心です。<br>
          だから、わたしたちは、心を磨く。<br>
          学ぶこと、はたらくこと、<br class="sp">そして生きることの本質は、<br class="sp">自身の心を磨きつづけることです。<br>
          甲子園学院が<br class="sp">80年以上にわたって継承してきたのは、<br class="sp">心を真ん中に置いた教育。<br>
          時代が移ろい、社会が変わっても、<br class="sp">心を磨く学びは<br class="sp">変わらず普遍であり続けます。
        </p>
      </div>
      <div class="logo anime-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/footer/footer-logo.svg" alt="甲子園学院ロゴ / 甲子園学院 / KOSHIEN GAKUIN">
      </div>
    </section>

    <section class="front_news" id="front_news">
      <?php
      $front_news_filter = get_query_var('front_news') ? get_query_var('front_news') : (isset($_GET['front_news']) ? sanitize_text_field(wp_unslash($_GET['front_news'])) : 'all');
      $this_site_category_slugs = get_news_this_site_category_slugs();
      $external_site_config = get_news_external_site_config();
      $front_max = 4;
      $fallback_thumb = get_template_directory_uri() . '/img/front/front-news-card-thumbnail.webp';
      ?>
      <div class="front_news--ttl anime-fade">
        <h3 class="TL">お知らせ</h3>
      </div>
      <div class="news-container anime-fade">
        <div class="filter-tabs-wrapper">
          <div class="sp-opener-bg sp"></div>
          <ul class="filter-tabs">
            <li class="sp-opener sp"></li>
            <li class="hover-opa filter-tab<?php echo ($front_news_filter === 'all' || $front_news_filter === '') ? ' is-active' : ''; ?>">
              <a href="<?php echo esc_url(home_url('/')); ?>#front_news">
                <p class="TX">ALL</p>
              </a>
            </li>
            <?php foreach ($this_site_category_slugs as $slug => $label) :
              $term = get_term_by('slug', $slug, 'category');
              if (!$term || is_wp_error($term)) continue;
              $term_link = get_term_link($term);
              if (is_wp_error($term_link)) continue;
              $active = $front_news_filter === $slug;
            ?>
              <li class="hover-opa filter-tab<?php echo $active ? ' is-active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('front_news', $slug, home_url('/')) . '#front_news'); ?>">
                  <p class="TX"><?php echo esc_html($label); ?></p>
                </a>
              </li>
            <?php endforeach; ?>
            <?php foreach ($external_site_config as $key => $config) :
              $active = $front_news_filter === $key;
              $tab_url = add_query_arg('front_news', $key, home_url('/')) . '#front_news';
            ?>
              <li class="hover-opa filter-tab<?php echo $active ? ' is-active' : ''; ?>">
                <a href="<?php echo esc_url($tab_url); ?>">
                  <p class="TX"><?php echo esc_html($config['label']); ?></p>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="card-list anime-fade">
          <?php
          if (isset($external_site_config[$front_news_filter]) && !empty($external_site_config[$front_news_filter]['api_base'])) :
            $ext_label = $external_site_config[$front_news_filter]['label'];
            $api_url = $external_site_config[$front_news_filter]['api_base'] . '/wp-json/wp/v2/posts?per_page=' . $front_max . '&_embed';
            $response = wp_remote_get($api_url, array('timeout' => 15));
            $body = wp_remote_retrieve_body($response);
            $posts = $body ? json_decode($body, true) : null;
            if (!empty($posts) && is_array($posts) && !isset($posts['code'])) :
              foreach ($posts as $post) :
                $link = isset($post['link']) ? $post['link'] : '#';
                $date = isset($post['date']) ? date('Y.m.d', strtotime($post['date'])) : '';
                $title = isset($post['title']['rendered']) ? wp_strip_all_tags($post['title']['rendered']) : '';
                $thumb = !empty($post['_embedded']['wp:featuredmedia'][0]['source_url']) ? $post['_embedded']['wp:featuredmedia'][0]['source_url'] : $fallback_thumb;
          ?>
                <article class="card hover-opa">
                  <a class="hover-opa" href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                    <div class="thumbnail"><img src="<?php echo esc_url($thumb); ?>" alt=""></div>
                    <div class="card--inner">
                      <div class="info">
                        <p class="time"><?php echo esc_html($date); ?></p>
                        <p class="category"><?php echo esc_html($ext_label); ?></p>
                      </div>
                      <div class="ttl">
                        <h4 class="TL"><?php echo esc_html($title); ?></h4>
                      </div>
                    </div>
                  </a>
                </article>
                <?php endforeach;
            endif;

          elseif (isset($this_site_category_slugs[$front_news_filter])) :
            $term = get_term_by('slug', $front_news_filter, 'category');
            if ($term && !is_wp_error($term)) :
              $q = new WP_Query(array('cat' => $term->term_id, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $front_max, 'orderby' => 'date', 'order' => 'DESC'));
              if ($q->have_posts()) :
                while ($q->have_posts()) : $q->the_post();
                  $cats = get_the_category();
                  $cat_name = !empty($cats) ? $cats[0]->name : '';
                ?>
                  <article class="card hover-opa">
                    <a class="hover-opa" href="<?php the_permalink(); ?>">
                      <div class="thumbnail">
                        <?php if (has_post_thumbnail()) : the_post_thumbnail();
                        else : ?>
                          <img src="<?php echo esc_url($fallback_thumb); ?>" alt="サムネイル">
                        <?php endif; ?>
                      </div>
                      <div class="card--inner">
                        <div class="info">
                          <p class="time"><?php the_time('Y.m.d'); ?></p>
                          <p class="category"><?php echo esc_html($cat_name); ?></p>
                        </div>
                        <div class="ttl">
                          <h4 class="TL"><?php the_title(); ?></h4>
                        </div>
                      </div>
                    </a>
                  </article>
                <?php endwhile;
                wp_reset_postdata();
              endif;
            endif;

          else :
            $all_items = array();
            $q = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC'));
            while ($q->have_posts()) {
              $q->the_post();
              $cats = get_the_category();
              $all_items[] = array('date_ts' => get_the_time('U'), 'date' => get_the_time('Y.m.d'), 'title' => get_the_title(), 'link' => get_permalink(), 'thumb' => get_the_post_thumbnail_url(null, 'full') ?: $fallback_thumb, 'category' => !empty($cats) ? $cats[0]->name : '', 'is_external' => false);
            }
            wp_reset_postdata();
            foreach ($external_site_config as $key => $config) {
              if (empty($config['api_base'])) continue;
              $api_url = $config['api_base'] . '/wp-json/wp/v2/posts?per_page=' . $front_max . '&_embed';
              $response = wp_remote_get($api_url, array('timeout' => 15));
              $body = wp_remote_retrieve_body($response);
              $chunk = $body ? json_decode($body, true) : null;
              if (is_array($chunk) && !isset($chunk['code'])) {
                foreach ($chunk as $post) {
                  $all_items[] = array('date_ts' => strtotime($post['date']), 'date' => date('Y.m.d', strtotime($post['date'])), 'title' => isset($post['title']['rendered']) ? wp_strip_all_tags($post['title']['rendered']) : '', 'link' => isset($post['link']) ? $post['link'] : '#', 'thumb' => !empty($post['_embedded']['wp:featuredmedia'][0]['source_url']) ? $post['_embedded']['wp:featuredmedia'][0]['source_url'] : $fallback_thumb, 'category' => $config['label'], 'is_external' => true);
                }
              }
            }
            usort($all_items, function ($a, $b) {
              return $b['date_ts'] - $a['date_ts'];
            });
            $all_items = array_slice($all_items, 0, $front_max);
            if (!empty($all_items)) :
              foreach ($all_items as $item) :
                ?>
                <article class="card hover-opa">
                  <a class="hover-opa" href="<?php echo esc_url($item['link']); ?>" <?php echo $item['is_external'] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <div class="thumbnail"><img src="<?php echo esc_url($item['thumb']); ?>" alt=""></div>
                    <div class="card--inner">
                      <div class="info">
                        <p class="time"><?php echo esc_html($item['date']); ?></p>
                        <p class="category"><?php echo esc_html($item['category']); ?></p>
                      </div>
                      <div class="ttl">
                        <h4 class="TL"><?php echo esc_html($item['title']); ?></h4>
                      </div>
                    </div>
                  </a>
                </article>
              <?php endforeach;
            else : ?>
              <p class="archive-no-posts">投稿がありません。</p>
          <?php endif;
          endif; ?>
        </div>

        <a class="btn-more anime-fade hover-opa" href="<?php echo home_url('/news'); ?>">
          <p class="TX">お知らせ一覧へ</p>
        </a>
      </div>
    </section>

    <section class="front_links">
      <a class="link_vision anime-fade" href="<?php echo home_url('/vision'); ?>">
        <div class="inner--bg">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_vision-bg-pc.webp" media="(min-width: 768px)"
              type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_vision-bg-sp.webp">
          </picture>
        </div>
        <div class="ttl">
          <h3 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_vision-ttl.svg" alt="99 YEARS VISION PROJECT">
          </h3>
        </div>
        <div class="btn hover-opa">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-links-more-btn.svg" alt="READ MORE">
        </div>
      </a>
      <div class="link_about anime-fade">
        <div class="inner--bg">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_about-bg-pc.webp" media="(min-width: 768px)"
              type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_about-bg-sp.webp">
          </picture>
        </div>
        <div class="link--inner">
          <div class="ttl">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_about-ttl-pc.svg" media="(min-width: 768px)"
                type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_about-ttl-sp.svg" alt="甲子園学院 / 百人百景">
            </picture>
          </div>
          <div class="txt">
            <a class="hover-opa" href="<?php echo home_url('/about/#sec-spirit'); ?>">
              <p class="TX">建学の精神</p>
            </a>
            <a class="hover-opa" href="<?php echo home_url('/about/#sec-history'); ?>">
              <p class="TX">沿革</p>
            </a>
            <!-- <a class="hover-opa" href="<?php echo home_url('/about/#sec-members'); ?>">
              <p class="TX">役員・評議員</p>
            </a> -->
            <a class="hover-opa" href="<?php echo home_url('/about/#sec-circle'); ?>">
              <p class="TX">機関誌「園の輪」</p>
            </a>
          </div>
        </div>
      </div>
      <a class="link_special anime-fade" href="<?php echo home_url('/special'); ?>">
        <div class="inner--bg">
          <?php
          $link_special_imgs = [
            get_template_directory_uri() . '/img/front/front-link_special-img-01.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-02.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-03.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-04.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-05.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-06.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-07.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-08.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-09.webp',
            get_template_directory_uri() . '/img/front/front-link_special-img-10.webp',
          ];
          shuffle($link_special_imgs);
          $link_special_imgs_doubled = array_merge($link_special_imgs, $link_special_imgs);
          ?>
          <div class="link_special--img-wrap">
            <ul class="link_special--img">
              <?php foreach ($link_special_imgs_doubled as $src) : ?>
                <li class="item">
                  <img src="<?php echo esc_url($src); ?>" alt="">
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="link--inner">
          <div class="ttl">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_special-ttl.svg" alt="甲子園学院 / 百人百景">
          </div>
          <div class="txt">
            <p class="TX">
              卒業生と教職員。甲子園学院に関わる人々の<br class="sp">心象風景をのぞきました。<br>
              「あなたはどんな心を磨いていますか？」
            </p>
          </div>
          <div class="btn hover-opa">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_special-btn.svg" media="(min-width: 768px)"
                type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-links-more-btn.svg" alt="READ MORE">
            </picture>
          </div>
        </div>
      </a>
      <a class="link_message anime-fade" href="<?php echo home_url('/message'); ?>">
        <div class="inner--bg">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-bg-pc.webp" media="(min-width: 768px)"
              type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-bg-sp.webp">
          </picture>
        </div>
        <div class="link--inner">
          <div class="ttl">
            <h3 class="TL">
              <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-ttl.svg" media="(min-width: 768px)" type="image/svg+xml">
                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-ttl-sp.svg" alt="学院ファミリーとともに心を磨く普遍の学びを">
              </picture>
            </h3>
          </div>
          <div class="btn hover-opa">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-btn-pc.svg" media="(min-width: 768px)"
                type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_message-btn-sp.svg" alt="理事長メッセージ">
            </picture>
          </div>
        </div>
      </a>

      <div class="link_school anime-fade">
        <?php
        // 名前の画像
        // 甲子園学院幼稚園
        $link_school_name_01 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-01.svg" alt="甲子園学院幼稚園">';
        // 甲子園学院小学校
        $link_school_name_02 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-02.svg" alt="甲子園学院小学校">';
        // 甲子園学院中学校
        $link_school_name_03 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-03.svg" alt="甲子園学院中学校・高等学校">';
        // 甲子園学院高等学校
        // $link_school_name_04 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-04.svg" alt="甲子園学院高等学校">';
        // 甲子園学院短期大学
        $link_school_name_05 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-05.svg" alt="甲子園学院短期大学">';
        // 甲子園学院大学
        $link_school_name_06 = '<img src="' . get_template_directory_uri() . '/img/front/front-link_school-txt-06.svg" alt="甲子園学院大学">';

        // 学校のURL
        // 甲子園学院幼稚園
        $link_school_url_01 = 'https://www.koshiengakuin-k.ed.jp/';
        // 甲子園学院小学校
        $link_school_url_02 = 'https://www.koshiengakuin-e.ed.jp/';
        // 甲子園学院中学校
        $link_school_url_03 = 'https://www.koshiengakuin-h.ed.jp/';
        // 甲子園学院高等学校
        // $link_school_url_04 = 'https://www.koshiengakuin-h.ed.jp/';
        // 甲子園学院短期大学
        $link_school_url_05 = 'https://www.koshien-c.ac.jp/';
        // 甲子園学院大学
        $link_school_url_06 = 'https://www.koshien.ac.jp/';
        ?>
        <div class="link--ttl">
          <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-ttl.webp" alt="">
        </div>
        <div class="link--inner">
          <div class="img--area">
            <ul class="img--area--list js-slick">
              <li class="item is-active">
                <a class="hover-opa" href="<?php echo $link_school_url_01; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-01.webp">
                  <p class="TX sp">
                    <?php echo $link_school_name_01; ?>
                  </p>
                </a>
              </li>
              <li class="item">
                <a class="hover-opa" href="<?php echo $link_school_url_02; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-02.webp">
                  <p class="TX sp">
                    <?php echo $link_school_name_02; ?>
                  </p>
                </a>
              </li>
              <li class="item">
                <a class="hover-opa" href="<?php echo $link_school_url_03; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-04.webp">
                  <p class="TX sp name-03">
                    <?php echo $link_school_name_03; ?>
                  </p>
                </a>
              </li>
              <!-- <li class="item">
                <a class="hover-opa" href="<?php echo $link_school_url_04; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-04.webp">
                  <p class="TX sp">
                    <?php echo $link_school_name_04; ?>
                  </p>
                </a>
              </li> -->
              <li class="item">
                <a class="hover-opa" href="<?php echo $link_school_url_05; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-05.webp">
                  <p class="TX sp">
                    <?php echo $link_school_name_05; ?>
                  </p>
                </a>
              </li>
              <li class="item">
                <a class="hover-opa" href="<?php echo $link_school_url_06; ?>" target="_blank" rel="noopener noreferrer">
                  <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_school-img-06.webp">
                  <p class="TX sp">
                    <?php echo $link_school_name_06; ?>
                  </p>
                </a>
              </li>
            </ul>
          </div>
          <div class="link--area pc">
            <ul>
              <li>
                <a class="hover-opa" href="<?php echo $link_school_url_01; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX">
                    <?php echo $link_school_name_01; ?>
                  </p>
                </a>
              </li>
              <li>
                <a class="hover-opa" href="<?php echo $link_school_url_02; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX">
                    <?php echo $link_school_name_02; ?>
                  </p>
                </a>
              </li>
              <li>
                <a class="hover-opa" href="<?php echo $link_school_url_03; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX" style="width:33.6vw!important; max-width:430px!important;">
                    <?php echo $link_school_name_03; ?>
                  </p>
                </a>
              </li>
              <!-- <li>
                <a class="hover-opa" href="<?php echo $link_school_url_04; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX">
                    <?php echo $link_school_name_04; ?>
                  </p>
                </a>
              </li> -->
              <li>
                <a class="hover-opa" href="<?php echo $link_school_url_05; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX">
                    <?php echo $link_school_name_05; ?>
                  </p>
                </a>
              </li>
              <li>
                <a class="hover-opa" href="<?php echo $link_school_url_06; ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX">
                    <?php echo $link_school_name_06; ?>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <a class="link_recruit anime-fade" href="<?php echo home_url('/recruit'); ?>">
        <div class="inner--bg">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/front/front-link_recruit-bg-pc.webp" media="(min-width: 768px)"
              type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-link_recruit-bg-sp.webp">
          </picture>
        </div>
      </a>
    </section>

  </div>
</div>
<!-- 独自ページ --end -->



<?php get_template_part('./inc/footer'); ?>