<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="p-post">

    <div class="p-post__title">
        <div class="c-title-2">
            <p class="c-title-2__label font-jost">NEWS</p>
            <h1 class="c-title-2__text fw-b">新着情報</h1>
        </div>
    </div>


    <div class="p-post__category">
        <?php
        $current_term = get_queried_object();
        $is_all_current = (is_home() || is_post_type_archive('post') || (is_category() && empty($current_term)));
        ?>
        <a href="<?php echo home_url(); ?>/news/" class="c-label <?php echo $is_all_current ? 'is-current' : ''; ?>">すべて</a>
        <?php
        $terms = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $is_current = (is_category($term->term_id)) ? 'is-current' : '';
                echo '<a href="' . esc_url(get_term_link($term)) . '" class="c-label ' . $is_current . '">' . esc_html($term->name) . '</a>';
            }
        }
        ?>
    </div>

    <div class="p-post__content">
        <div class="p-archive-2" id="archive-posts">
            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $posts_per_page = 6;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            if (is_category()) {
                $args['cat'] = get_queried_object_id();
            }
            $posts_query = new WP_Query($args);

            if ($posts_query->have_posts()) {
                while ($posts_query->have_posts()) {
                    $posts_query->the_post();
                    $post_id = get_the_ID();
                    $thumb_id = get_post_thumbnail_id($post_id);
                    $thumb_url = $thumb_id ? wp_get_attachment_url($thumb_id) : get_template_directory_uri() . '/img/no-image.webp';
                    $post_date = get_the_date('Y.m.d');
                    $categories = get_the_category($post_id);
                    $category_name = !empty($categories) ? $categories[0]->name : 'お知らせ';
            ?>
                    <a class="p-archive-2__item" href="<?php the_permalink(); ?>">
                        <div class="p-archive-2__image pc-mgb-10"><img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"></div>
                        <div class="p-archive-2__content">
                            <div class="p-archive-2__head pc-mgb-5">
                                <span class="p-archive-2__date font-avenir"><?php echo esc_html($post_date); ?></span>
                                <div>
                                    <span class="c-label"><?php echo esc_html($category_name); ?></span>
                                </div>
                            </div>
                            <span class="p-archive-2__title"><?php the_title(); ?></span>
                        </div>
                    </a>
            <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p class="p-archive__none">記事はありません。</p>';
            }
            ?>
        </div>
    </div>

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $total_pages = isset($posts_query) ? (int) $posts_query->max_num_pages : 0;
    $show_button = ($paged < $total_pages);
    $archive_base = is_category() ? get_term_link(get_queried_object()) : home_url('/news/');
    if (is_wp_error($archive_base) || empty($archive_base)) {
        $archive_base = home_url('/news/');
    }
    ?>

    <?php if ($show_button): ?>
        <div class="p-post__btn">
            <a id="load-more-btn" href="<?php echo esc_url(add_query_arg('paged', $paged + 1, $archive_base)); ?>" class="c-btn c-btn--fill" data-current-page="<?php echo esc_attr($paged); ?>" data-total-pages="<?php echo esc_attr($total_pages); ?>">
                <div class="c-btn__inner"><span>さらに読み込む</span></div>
            </a>
        </div>


        <script>
            (function() {
                var btn = document.getElementById('load-more-btn');
                if (!btn) return;
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var current = parseInt(btn.getAttribute('data-current-page') || '1', 10);
                    var total = parseInt(btn.getAttribute('data-total-pages') || '1', 10);
                    var nextUrl = btn.getAttribute('href');
                    if (!nextUrl) return;
                    btn.classList.add('is-loading');
                    fetch(nextUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(function(res) {
                            return res.text();
                        })
                        .then(function(html) {
                            var parser = new DOMParser();
                            var doc = parser.parseFromString(html, 'text/html');
                            var newContainer = doc.getElementById('archive-posts');
                            var target = document.getElementById('archive-posts');
                            if (newContainer && target) {
                                // append child nodes
                                var nodes = Array.prototype.slice.call(newContainer.children);
                                nodes.forEach(function(node) {
                                    target.appendChild(node);
                                });
                            }
                            current = current + 1;
                            btn.setAttribute('data-current-page', current);
                            if (current >= total) {
                                // remove button
                                var wrap = btn.closest('.p-post__btn');
                                if (wrap) wrap.parentNode.removeChild(wrap);
                            } else {
                                // update href to next page
                                var url = new URL(nextUrl, window.location.origin);
                                url.searchParams.set('paged', current + 1);
                                btn.setAttribute('href', url.toString());
                            }
                        })
                        .catch(function() {
                            console.error('ロードに失敗しました');
                        })
                        .finally(function() {
                            btn.classList.remove('is-loading');
                        });
                });
            })();
        </script>
    <?php endif; ?>


    <?php /*
        <?php if (have_posts()): ?>
            <div class="post-list">
                <?php while (have_posts()):
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php
                endwhile; ?>
            </div>
        <?php else: ?>
            <p>投稿はありません</p>
        <?php endif; ?>

        */ ?>

</div>

<?php get_template_part('./inc/footer'); ?>