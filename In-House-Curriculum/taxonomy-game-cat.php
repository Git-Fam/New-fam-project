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
            <?php
            // 現在のタクソノミーのタームを取得
            $term = get_queried_object();  // 現在のターム（カテゴリー）情報
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            // タグのスラッグを取得（「初級」「中級」「上級」など）
            $current_tag = get_query_var('game-tag');  // クエリパラメータのタグ

            // クエリの設定
            $args = array(
                'post_type' => 'game',  // カスタム投稿タイプ "game" を指定
                'posts_per_page' => 8,
                'paged' => $paged,
                'tax_query' => array(
                    'relation' => 'AND',  // タグとカテゴリーの両方でフィルタリング
                    array(
                        'taxonomy' => 'game-cat',  // カテゴリー "game-cat" を指定
                        'field' => 'slug',
                        'terms' => $term->slug,  // 現在のカテゴリーを使用
                    ),
                    array(
                        'taxonomy' => 'game-tag',  // タグ "game-tag" を指定
                        'field' => 'slug',
                        'terms' => $current_tag,  // 現在のタグ（初級、中級、上級）を使用
                    ),
                ),
            );

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) : ?>
                <div class="post-list">
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        echo '<img src="' . esc_url(get_template_directory_uri() . '/img/noimage.jpg') . '" alt="No image available">';
                                    }
                                    ?>
                                </div>

                                <!-- 投稿の概要（任意） -->
                                <div class="excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- ページネーション -->
                <div class="pagination">
                    <?php
                    if (function_exists('wp_pagenavi')) {
                        wp_pagenavi(array('query' => $the_query));
                    }
                    ?>
                </div>

            <?php else : ?>
                <p>該当する投稿がありません。</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
