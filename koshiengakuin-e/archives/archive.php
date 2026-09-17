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
            $posts_per_page = 12;
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
    <?php endif; ?>

        <script>
            (function() {
                var STORAGE_KEY = 'koshienNewsArchive';
                var btn = document.getElementById('load-more-btn');
                var target = document.getElementById('archive-posts');
                if (!target) return;

                function currentPath() {
                    return location.pathname.replace(/\/+$/, '') || '/';
                }

                function archiveUrl() {
                    var url = new URL(location.href);
                    url.searchParams.delete('paged');
                    return url.pathname + url.search;
                }

                function getState() {
                    try {
                        return JSON.parse(sessionStorage.getItem(STORAGE_KEY) || 'null');
                    } catch (e) {
                        return null;
                    }
                }

                function saveState(extra) {
                    var prev = getState() || {};
                    var next = {
                        path: currentPath(),
                        url: archiveUrl(),
                        pages: prev.pages || 1,
                        scrollY: window.scrollY,
                        restore: !!prev.restore
                    };
                    if (btn) {
                        next.pages = parseInt(btn.getAttribute('data-current-page') || String(next.pages), 10);
                    }
                    if (extra) {
                        Object.keys(extra).forEach(function(key) {
                            next[key] = extra[key];
                        });
                    }
                    sessionStorage.setItem(STORAGE_KEY, JSON.stringify(next));
                }

                function appendFromHtml(html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newContainer = doc.getElementById('archive-posts');
                    if (!newContainer) return;
                    Array.prototype.slice.call(newContainer.children).forEach(function(node) {
                        target.appendChild(node);
                    });
                }

                function pageUrl(page) {
                    var url = new URL(location.href);
                    url.searchParams.set('paged', page);
                    return url.toString();
                }

                function fetchPage(url) {
                    return fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(function(res) {
                        return res.text();
                    });
                }

                function updateButton(current, total) {
                    if (!btn) return;
                    btn.setAttribute('data-current-page', current);
                    if (current >= total) {
                        var wrap = btn.closest('.p-post__btn');
                        if (wrap) wrap.parentNode.removeChild(wrap);
                    } else {
                        btn.setAttribute('href', pageUrl(current + 1));
                    }
                }

                document.querySelectorAll('.p-post__category a').forEach(function(link) {
                    link.addEventListener('click', function() {
                        sessionStorage.removeItem(STORAGE_KEY);
                    });
                });

                target.addEventListener('click', function(e) {
                    var item = e.target.closest('.p-archive-2__item');
                    if (!item) return;
                    saveState({
                        restore: true,
                        scrollY: window.scrollY
                    });
                });

                function restoreIfNeeded() {
                    var state = getState();
                    if (!state || !state.restore || state.path !== currentPath()) return;

                    var savedPages = parseInt(state.pages || '1', 10);
                    var existing = target.querySelectorAll('.p-archive-2__item').length;
                    if (existing > 12 || !btn || savedPages <= 1) {
                        state.restore = false;
                        sessionStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                        if (state.scrollY) window.scrollTo(0, state.scrollY);
                        return;
                    }

                    var total = parseInt(btn.getAttribute('data-total-pages') || '1', 10);
                    savedPages = Math.min(savedPages, total);
                    btn.classList.add('is-loading');

                    var chain = Promise.resolve();
                    for (var page = 2; page <= savedPages; page++) {
                        (function(nextPage) {
                            chain = chain.then(function() {
                                return fetchPage(pageUrl(nextPage)).then(appendFromHtml);
                            });
                        })(page);
                    }

                    chain.then(function() {
                        updateButton(savedPages, total);
                        if (state.scrollY) window.scrollTo(0, state.scrollY);
                    }).catch(function() {
                        console.error('一覧の復元に失敗しました');
                    }).finally(function() {
                        if (btn) btn.classList.remove('is-loading');
                        var latest = getState() || state;
                        latest.restore = false;
                        latest.pages = savedPages;
                        sessionStorage.setItem(STORAGE_KEY, JSON.stringify(latest));
                    });
                }

                if (btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var current = parseInt(btn.getAttribute('data-current-page') || '1', 10);
                        var total = parseInt(btn.getAttribute('data-total-pages') || '1', 10);
                        var nextUrl = btn.getAttribute('href');
                        if (!nextUrl) return;
                        btn.classList.add('is-loading');
                        fetchPage(nextUrl)
                            .then(appendFromHtml)
                            .then(function() {
                                current = current + 1;
                                updateButton(current, total);
                                saveState({
                                    pages: current,
                                    restore: false
                                });
                            })
                            .catch(function() {
                                console.error('ロードに失敗しました');
                            })
                            .finally(function() {
                                btn.classList.remove('is-loading');
                            });
                    });
                }

                restoreIfNeeded();
            })();
        </script>


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