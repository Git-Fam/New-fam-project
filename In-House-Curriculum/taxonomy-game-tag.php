<?php get_header(); ?>

<div class="game-main">
    <div class="game-wrap">
        <div class="inner">

            <!-- カテゴリー選択リンクを表示 -->
            <div class="category-list">
                <ul>
                    <li><a href="<?php echo esc_url(add_query_arg('game-cat', '', home_url($wp->request))); ?>">すべてのカテゴリー</a></li>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'game-cat',
                        'hide_empty' => false,
                    ));

                    foreach ($categories as $category) {
                        // 現在のページURLに「game-cat」パラメータを追加
                        $category_link = add_query_arg('game-cat', $category->slug, home_url($wp->request));
                        $current_class = (get_query_var('game-cat') == $category->slug) ? ' class="current-cat"' : '';
                        echo '<li' . $current_class . '><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <!-- 投稿の表示 -->
            <?php if (have_posts()) : ?>
                <div class="post-list">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <div class="entry-content">
                                <!-- サムネイル表示 -->
                                <div class="thumbnail">
                                    <?php
                                    $thumbnail_url = get_the_post_thumbnail_url();
                                    if ($thumbnail_url) {
                                        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                                    } else {
                                        echo '<img src="' . esc_url(get_template_directory_uri() . '/img/noimage.jpg') . '" alt="No image available">';
                                    }
                                    ?>
                                </div>
                            </div>

                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- ページネーション -->
                <div class="pagination">
                    <?php
                    if (function_exists('wp_pagenavi')) {
                        wp_pagenavi();
                    }
                    ?>
                </div>

            <?php else : ?>
                <p>該当する投稿がありません。</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>