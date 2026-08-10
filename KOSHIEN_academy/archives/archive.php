<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-archive">

    <section class="archive_kv">
        <div class="inner--bg">
            <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/img/archive/archive_kv-pc.webp" media="(min-width: 768px)" type="image/svg+xml">
                <img src="<?php echo get_template_directory_uri(); ?>/img/archive/archive_kv-sp.webp">
            </picture>
        </div>
        <h2 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/archive/archive_kv-ttl.svg" alt="お知らせ TOPIC">
        </h2>
    </section>

    <div class="page-archive--inner">

        <section class="archive_news">
            <?php
            $news_archive_url = home_url('/news');
            $this_site_category_slugs = get_news_this_site_category_slugs();
            $external_archive = get_query_var('external_archive');
            $external_site_config = get_news_external_site_config();
            $external_site_tabs = array();
            foreach ($external_site_config as $key => $config) {
                $external_site_tabs[$key] = array(
                    'label' => $config['label'],
                    'url'   => add_query_arg('external_archive', $key, home_url('/news/')),
                );
            }
            // ページネーション後（404復帰含む）もタブを正しくアクティブにするためクエリ変数から判定
            if (is_category()) {
                $current_cat_id = get_queried_object_id();
            } elseif (get_query_var('cat')) {
                $current_cat_id = (int) get_query_var('cat');
            } elseif (get_query_var('category_name')) {
                $cat_term = get_term_by('slug', get_query_var('category_name'), 'category');
                $current_cat_id = ($cat_term && !is_wp_error($cat_term)) ? $cat_term->term_id : 0;
            } else {
                $current_cat_id = 0;
            }
            $is_all_view = !$external_archive && !$current_cat_id;
            ?>
            <div class="news-container">
                <div class="filter-tabs-wrapper">
                    <div class="sp-opener-bg sp"></div>
                    <div class="filter-tab-ttl">
                        <p class="TX">CATEGORY</p>
                    </div>
                    <ul class="filter-tabs">
                        <li class="sp-opener sp"></li>
                        <li class="hover-opa filter-tab<?php echo $is_all_view ? ' is-active' : ''; ?>">
                            <a href="<?php echo esc_url($news_archive_url); ?>">
                                <p class="TX">ALL</p>
                            </a>
                        </li>
                        <?php foreach ($this_site_category_slugs as $slug => $label) :
                            $term = get_term_by('slug', $slug, 'category');
                            if (!$term || is_wp_error($term)) continue;
                            $term_link = get_term_link($term);
                            if (is_wp_error($term_link)) continue;
                            $active = (int) $current_cat_id === (int) $term->term_id;
                        ?>
                            <li class="hover-opa filter-tab<?php echo $active ? ' is-active' : ''; ?>">
                                <a href="<?php echo esc_url($term_link); ?>">
                                    <p class="TX"><?php echo esc_html($label); ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($external_site_tabs as $key => $tab) :
                            $is_external_active = ($external_archive === $key);
                        ?>
                            <li class="hover-opa filter-tab<?php echo $is_external_active ? ' is-active' : ''; ?>" data-external="<?php echo esc_attr($key); ?>">
                                <a href="<?php echo esc_url($tab['url']); ?>">
                                    <p class="TX"><?php echo esc_html($tab['label']); ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-list">
                    <?php
                    $fallback_thumb = get_template_directory_uri() . '/img/front/front-news-card-thumbnail.webp';
                    $posts_per_page = 12;
                    $current_page = max(1, (int) get_query_var('paged'));
                    $pagination_total_pages = 1;
                    $pagination_base_url = home_url('/news/');
                    $pagination_is_category = false;

                    if (isset($external_site_config[$external_archive]) && !empty($external_site_config[$external_archive]['api_base'])) :
                        $ext_label = $external_site_config[$external_archive]['label'];
                        $ext_api_base = $external_site_config[$external_archive]['api_base'];
                        $posts = array();
                        $page = 1;
                        $per_page = 100;
                        do {
                            $api_url = $ext_api_base . '/wp-json/wp/v2/posts?per_page=' . $per_page . '&page=' . $page . '&_embed';
                            $response = wp_remote_get($api_url, array('timeout' => 15));
                            $body = wp_remote_retrieve_body($response);
                            $chunk = $body ? json_decode($body, true) : null;
                            if (is_array($chunk) && !isset($chunk['code'])) {
                                $posts = array_merge($posts, $chunk);
                                $page++;
                            } else {
                                break;
                            }
                        } while (isset($chunk) && is_array($chunk) && count($chunk) >= $per_page);

                        $total_posts = count($posts);
                        $pagination_total_pages = max(1, (int) ceil($total_posts / $posts_per_page));
                        $pagination_base_url = add_query_arg('external_archive', $external_archive, home_url('/news/'));
                        $posts_page = array_slice($posts, ($current_page - 1) * $posts_per_page, $posts_per_page);

                        if (!empty($posts_page)) :
                            foreach ($posts_page as $post) :
                                $link = isset($post['link']) ? $post['link'] : '#';
                                $date = isset($post['date']) ? date('Y.m.d', strtotime($post['date'])) : '';
                                $title = isset($post['title']['rendered']) ? wp_strip_all_tags($post['title']['rendered']) : '';
                                $thumb = $fallback_thumb;
                                if (!empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                                    $thumb = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
                                }
                    ?>
                                <article class="card hover-opa" data-category="<?php echo esc_attr($ext_label); ?>">
                                    <a class="hover-opa" href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                                        <div class="thumbnail">
                                            <img src="<?php echo esc_url($thumb); ?>" alt="">
                                        </div>
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
                            <?php
                            endforeach;
                        else :
                            ?>
                            <p class="archive-no-posts">投稿がありません。</p>
                        <?php endif; ?>

                        <?php elseif (!is_category() && !$external_archive && !get_query_var('cat') && !get_query_var('category_name')) :
                        // ALL: 自サイトの投稿 + 全外部の投稿を日付でマージ（カテゴリのページ送り時は下の else へ）
                        $all_items = array();
                        $archive_query_all = new WP_Query(array(
                            'post_type'      => 'post',
                            'post_status'    => 'publish',
                            'posts_per_page' => -1,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ));
                        while ($archive_query_all->have_posts()) {
                            $archive_query_all->the_post();
                            $cats = get_the_category();
                            $all_items[] = array(
                                'date_ts'     => get_the_time('U'),
                                'date'        => get_the_time('Y.m.d'),
                                'title'       => get_the_title(),
                                'link'        => get_permalink(),
                                'thumb'       => get_the_post_thumbnail_url(null, 'full') ?: $fallback_thumb,
                                'category'    => !empty($cats) ? $cats[0]->name : '',
                                'is_external' => false,
                            );
                        }
                        wp_reset_postdata();

                        $per_page = 100;
                        foreach ($external_site_config as $key => $config) {
                            if (empty($config['api_base'])) continue;
                            $ext_api_base = $config['api_base'];
                            $ext_label = $config['label'];
                            $page = 1;
                            do {
                                $api_url = $ext_api_base . '/wp-json/wp/v2/posts?per_page=' . $per_page . '&page=' . $page . '&_embed';
                                $response = wp_remote_get($api_url, array('timeout' => 15));
                                $body = wp_remote_retrieve_body($response);
                                $chunk = $body ? json_decode($body, true) : null;
                                if (is_array($chunk) && !isset($chunk['code'])) {
                                    foreach ($chunk as $post) {
                                        $all_items[] = array(
                                            'date_ts'     => strtotime($post['date']),
                                            'date'        => date('Y.m.d', strtotime($post['date'])),
                                            'title'       => isset($post['title']['rendered']) ? wp_strip_all_tags($post['title']['rendered']) : '',
                                            'link'        => isset($post['link']) ? $post['link'] : '#',
                                            'thumb'       => !empty($post['_embedded']['wp:featuredmedia'][0]['source_url']) ? $post['_embedded']['wp:featuredmedia'][0]['source_url'] : $fallback_thumb,
                                            'category'    => $ext_label,
                                            'is_external' => true,
                                        );
                                    }
                                    $page++;
                                } else {
                                    break;
                                }
                            } while (isset($chunk) && is_array($chunk) && count($chunk) >= $per_page);
                        }

                        usort($all_items, function ($a, $b) {
                            return $b['date_ts'] - $a['date_ts'];
                        });

                        $total_all = count($all_items);
                        $pagination_total_pages = max(1, (int) ceil($total_all / $posts_per_page));
                        $pagination_base_url = home_url('/news/');
                        $all_items_page = array_slice($all_items, ($current_page - 1) * $posts_per_page, $posts_per_page);

                        if (!empty($all_items_page)) :
                            foreach ($all_items_page as $item) :
                                if ($item['is_external']) :
                        ?>
                                    <article class="card hover-opa" data-category="<?php echo esc_attr($item['category']); ?>">
                                        <a class="hover-opa" href="<?php echo esc_url($item['link']); ?>" target="_blank" rel="noopener noreferrer">
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
                                <?php else : ?>
                                    <article class="card hover-opa" data-category="<?php echo esc_attr($item['category']); ?>">
                                        <a class="hover-opa" href="<?php echo esc_url($item['link']); ?>">
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
                            <?php endif;
                            endforeach;
                        else : ?>
                            <p class="archive-no-posts">投稿がありません。</p>
                        <?php endif; ?>

                        <?php else :
                        $archive_args = array(
                            'post_type'      => 'post',
                            'post_status'    => 'publish',
                            'posts_per_page' => $posts_per_page,
                            'paged'          => $current_page,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        );
                        $category_term = null;
                        if (is_category()) {
                            $category_term = get_queried_object();
                            $archive_args['cat'] = $category_term->term_id;
                        } elseif (get_query_var('cat')) {
                            $category_term = get_category(get_query_var('cat'));
                            if ($category_term && !is_wp_error($category_term)) {
                                $archive_args['cat'] = $category_term->term_id;
                            }
                        } elseif (get_query_var('category_name')) {
                            $category_term = get_term_by('slug', get_query_var('category_name'), 'category');
                            if ($category_term && !is_wp_error($category_term)) {
                                $archive_args['cat'] = $category_term->term_id;
                            }
                        }
                        $archive_query = new WP_Query($archive_args);
                        $pagination_total_pages = max(1, (int) $archive_query->max_num_pages);
                        if ($category_term && !is_wp_error($category_term)) {
                            $pagination_base_url = get_term_link($category_term);
                            $pagination_is_category = true;
                        } else {
                            $pagination_base_url = home_url('/news/');
                        }
                        if ($archive_query->have_posts()) :
                            while ($archive_query->have_posts()) :
                                $archive_query->the_post();
                                $categories = get_the_category();
                                $cat_name = !empty($categories) ? $categories[0]->name : '';
                        ?>
                                <article class="card hover-opa" data-category="<?php echo esc_attr($cat_name); ?>">
                                    <a class="hover-opa" href="<?php the_permalink(); ?>">
                                        <div class="thumbnail">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail(); ?>
                                            <?php else : ?>
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
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p class="archive-no-posts">投稿がありません。</p>
                    <?php endif;
                    endif; ?>
                </div>


                <div class="pagination">
                    <div class="pagination--inner">
                        <?php if ($pagination_total_pages > 1) :
                            // カテゴリ時は必ずそのカテゴリのURLを基準にページ番号を付与（カテゴリ内で遷移）
                            if ($current_page > 1) :
                                $prev_url = $pagination_is_category
                                    ? (($current_page === 2) ? $pagination_base_url : add_query_arg('paged', $current_page - 1, $pagination_base_url))
                                    : ($current_page === 2 ? remove_query_arg('paged', $pagination_base_url) : add_query_arg('paged', $current_page - 1, $pagination_base_url));
                        ?>
                                <a class="hover-opa prev" href="<?php echo esc_url($prev_url); ?>">
                                    <p class="TX">前へ</p>
                                </a>
                                <?php endif;
                            $range = 2;
                            $pagination_pages = array();
                            if ($pagination_total_pages <= 7) {
                                $pagination_pages = range(1, $pagination_total_pages);
                            } else {
                                $pagination_pages[] = 1;
                                if ($current_page > $range + 2) {
                                    $pagination_pages[] = '...';
                                }
                                $start = max(2, $current_page - $range);
                                $end = min($pagination_total_pages - 1, $current_page + $range);
                                for ($i = $start; $i <= $end; $i++) {
                                    if (!in_array($i, $pagination_pages)) {
                                        $pagination_pages[] = $i;
                                    }
                                }
                                if ($current_page < $pagination_total_pages - $range - 1) {
                                    $pagination_pages[] = '...';
                                }
                                if ($pagination_total_pages > 1) {
                                    $pagination_pages[] = $pagination_total_pages;
                                }
                            }
                            foreach ($pagination_pages as $i) :
                                if ($i === '...') :
                                ?>
                                    <span class="pagination-ellipsis">
                                        <p class="TX">…</p>
                                    </span>
                                <?php else :
                                    $page_url = $pagination_is_category
                                        ? (($i === 1) ? $pagination_base_url : add_query_arg('paged', $i, $pagination_base_url))
                                        : ($i === 1 ? remove_query_arg('paged', $pagination_base_url) : add_query_arg('paged', $i, $pagination_base_url));
                                ?>
                                    <a class="hover-opa<?php echo (int) $current_page === (int) $i ? ' is-active' : ''; ?>" href="<?php echo esc_url($page_url); ?>">
                                        <p class="TX"><?php echo (int) $i; ?></p>
                                    </a>
                                <?php endif;
                            endforeach;
                            if ($current_page < $pagination_total_pages) :
                                $next_url = $pagination_is_category
                                    ? add_query_arg('paged', $current_page + 1, $pagination_base_url)
                                    : add_query_arg('paged', $current_page + 1, $pagination_base_url);
                                ?>
                                <a class="hover-opa next" href="<?php echo esc_url($next_url); ?>">
                                    <p class="TX">次へ</p>
                                </a>
                        <?php endif;
                        endif; ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<!-- 独自ページ --end -->


<?php get_template_part('./inc/footer'); ?>