<?php get_header(); ?>

<div class="game-main">
    <div class="game-wrap">
        <div class="inner">
            <div class="game-container level-select game-tag">
                <!-- カテゴリー選択リンクを表示 -->
                <div class="category-list">
                    <ul>
                        <li  class="cat-select active"><a href="<?php echo esc_url(add_query_arg('game-cat', '', home_url($wp->request))); ?>">すべてのゲーム</a></li>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'game-cat',
                            'hide_empty' => false,
                        ));

                        foreach ($categories as $category) {
                            // 現在のページURLに「game-cat」パラメータを追加
                            $category_link = add_query_arg('game-cat', $category->slug, home_url($wp->request));
                            $current_class = (get_query_var('game-cat') == $category->slug) ? ' class="current-cat"' : '';
                            echo '<li class="cat-select"' . $current_class . '><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- 投稿の表示 -->
                <div class="game-post">
                    <?php
                    // クエリパラメータから選択されたカテゴリーを取得
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $selected_cat = get_query_var('game-cat'); // クエリパラメータからカテゴリーを取得
                    $current_tag = get_queried_object()->slug; // 現在のタグスラッグを取得

                    // クエリの基本設定
                    $args = array(
                        'posts_per_page' => 8,
                        'paged' => $paged,
                        'post_type' => 'game',  // カスタム投稿タイプ "game" を指定
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'game-tag',  // タクソノミー game-tag を指定
                                'field' => 'slug',
                                'terms' => $current_tag,  // 現在のタグを使用
                            )
                        ),
                    );
                    // カテゴリーが選択されている場合のフィルタリング
                    if (!empty($selected_cat)) {
                        $args['tax_query'][] = array(
                            'taxonomy' => 'game-cat',
                            'field'    => 'slug',
                            'terms'    => $selected_cat,
                        );
                    }
                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) : ?>
                        <div class="post-list">
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                    <div class="content">
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

                                    <div class="post-TL">
                                        <p class="TL">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </p>
                                    </div>

                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>
                        <p>該当する投稿がありません。</p>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="game-character">
                <div class="img"></div>
            </div>

            <div class="game-mob">
                <div class="img"></div>
                <div class="img"></div>
                <div class="img"></div>
            </div>
        </div>
        <div class="lever"></div>
        <div class="btn"></div>
    </div>
</div>

<?php get_footer(); ?>
