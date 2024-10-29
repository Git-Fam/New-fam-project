<?php get_header(); ?>

<div class="game-main">
    <div class="game-wrap">
        <div class="inner">
            <div class="game-container level-select game-tag">

                <!-- カテゴリー選択リンクを表示 -->
                <div class="category-list">
                    <ul>
                        <li class="cat-select<?php echo (empty($current_tag) && !isset($_GET['game-cat'])) ? ' active' : ''; ?>"><a href="<?php echo esc_url(add_query_arg('game-cat', '', home_url($wp->request))); ?>">すべてのゲーム</a></li>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'game-cat',
                            'hide_empty' => false,
                        ));

                        foreach ($categories as $category) {
                            // 現在のページURLに「game-cat」パラメータを追加
                            $category_link = add_query_arg('game-cat', $category->slug, home_url($wp->request));
                            // カテゴリー名と一致する場合にactiveクラスを追加
                            $active_class = (isset($_GET['game-cat']) && $_GET['game-cat'] === $category->slug) ? ' active' : '';
                            echo '<li class="cat-select' . $active_class . '"><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- 投稿の表示 -->
                <div class="game-post">
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
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="content">
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
                                        </div>

                                        <div class="post-TL">
                                            <p class="TL">
                                                <?php the_title(); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>
                        <p>該当する投稿がありません。</p>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="chara-box">
                <div class="game-character">
                    <div class="img"></div>
                </div>

                <div class="game-mob">
                    <div class="img delay-04"></div>
                    <div class="img"></div>
                    <div class="img delay-04"></div>
                </div>
            </div>
        </div>
        <div class="lever"></div>
        <div class="btn"></div>
    </div>
</div>

<?php get_footer(); ?>