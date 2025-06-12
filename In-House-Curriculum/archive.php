<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();

if (!function_exists('to_safe_class')) {
    function to_safe_class($str) {
        return preg_replace('/[^a-zA-Z0-9_-]/', '_', $str);
    }
}


// 現在のユーザー情報を取得
$current_user = wp_get_current_user();
$current_username = $current_user->display_name; // 現在のログインユーザーの表示名
$current_user_id = $current_user->ID; // 元のユーザーIDを保持

// 全ユーザーの進捗データとキャラクターHTMLを格納する配列
$all_users_progress = [];
$all_users_characters = [];
$last_post_progress = []; // 最後の投稿が100%になってから1週間経過したかどうか

// 全ユーザーを取得
$users = get_users();



$user_id = get_current_user_id();
$last_progress_key = get_user_meta($user_id, 'last_progress_key', true);

$active_category_slug = '';
if ($last_progress_key) {
    $args = [
        'post_type'  => 'post',
        'meta_query' => [
            [
                'key'     => $last_progress_key,
                'compare' => 'EXISTS',
            ],
        ],
        'posts_per_page' => 1,
    ];
    $progress_post_query = new WP_Query($args);

    if ($progress_post_query->have_posts()) {
        $progress_post_query->the_post();
        $categories = get_the_category();
        if (!empty($categories)) {
            $active_category_slug = $categories[0]->slug;
        }
        wp_reset_postdata();
    }
    error_log($last_progress_key);
}


$last_post_progress = [];

// $users ループはこれだけでOK！
foreach ($users as $user) {
    $user_id = $user->ID;
    $user_meta = get_user_meta($user_id);

    // 進捗データ格納用
    $progress_data = [];

    foreach ($user_meta as $meta_key => $meta_value) {
        if (preg_match('/^(ENV|VAL|INIT|div|responsive|JQ|LP|MiniLP|Sass|React|Java|SQL|Design|SEO|Form|FAM|test|JS|wordpress|jstqb)/i', $meta_key)) {
            

            $progress = intval($meta_value[0]);
            $progress_data[$meta_key] = $progress;
            

            if ($progress === 100) {
                $completion_date_field = $meta_key . '_date';
                $progress_completion_date = get_user_meta($user_id, $completion_date_field, true);
            
                // 既にcompletion_dateが存在するか確認
                if (!metadata_exists('user', $user_id, $completion_date_field)) {
                    $progress_completion_date = current_time('mysql');
                    update_user_meta($user_id, $completion_date_field, $progress_completion_date);
                }   

                $one_week_later = strtotime($progress_completion_date) + (7 * 24 * 60 * 60);
                $current_time = current_time('timestamp');
                $is_expired = ($current_time >= $one_week_later);
            
                $last_post_progress[$user_id][$meta_key] = $is_expired;
            }
        }
    }

    // キャラクターHTML生成
    ob_start();
    wp_set_current_user($user_id);
    display_character();
    $character_html = ob_get_clean();

    $all_users_characters[] = array(
        'username' => $user->display_name,
        'character_html' => $character_html,
    );

    $all_users_progress[] = array(
        'user_id' => $user_id,
        'username' => $user->display_name,
        'progress' => $progress_data,
    );
}

// クエリパラメータからカスタムフィールド名を取得
$last_updated_field = isset($_GET['field']) ? sanitize_text_field($_GET['field']) : '';

// 投稿とカスタムフィールド名の紐付けからカテゴリーを取得
if ($last_updated_field) {
    // 投稿とカスタムフィールドの紐付け（例: メタ情報から取得）
    $args = [
        'meta_query' => [
            [
                'key' => $last_updated_field,
                'value' => '', // 任意の条件
                'compare' => 'EXISTS',
            ],
        ],
        'post_type' => 'post', // 投稿タイプを指定
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // 最初の関連カテゴリーを取得
            $categories = get_the_category();
            if (!empty($categories)) {
                $active_category = $categories[0]->slug; // カテゴリースラッグを取得
                break;
            }
        }
        wp_reset_postdata();
    }
}



// ユーザーIDを元に戻す
wp_set_current_user($current_user_id);

// JavaScriptに全ユーザーの進捗データとキャラクターHTML、そして最後の投稿の進捗情報を渡す
wp_enqueue_script('cooperator-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
wp_localize_script('cooperator-script', 'wpData', array(
    'allUsersProgress' => $all_users_progress,
    'allUsersCharacters' => $all_users_characters, // キャラクターHTMLをJavaScriptに渡す
    'lastPostProgress' => $last_post_progress, // 最後の投稿に紐付く進捗情報（1週間経過フラグ付き）
    'last_progress_key' => get_user_meta(get_current_user_id(), 'last_progress_key', true)
));
error_log('last_progress_key: ' . print_r($last_progress_key, true));
error_log('active_category_slug: ' . print_r($active_category_slug, true));




// URLのcategoryパラメータを取得
$active_category = isset($_GET['category']) ? urldecode($_GET['category']) : '';

?>



<div class="sp-wrap">
    <div class="road-wappaer">
        <div class="moon-deco"></div>
        <div class="action-modal">
            <div class="modal-content"></div>
            <div class="action-close"></div>
        </div>

        <div class="cloud-box">
            <div class="road-cloud flowing"></div>
            <div class="road-cloud cloudAnime"></div>
            <div class="road-cloud flowing02"></div>
            <div class="road-cloud flowing"></div>
            <div class="road-cloud flowing02"></div>
            <div class="road-cloud cloudAnime02"></div>
            <div class="road-cloud flowing03"></div>
            <div class="road-cloud flowing03"></div>
            <div class="road-cloud flowing04"></div>
            <div class="road-cloud flowing04"></div>
            <div class="road-cloud road-cloud02"></div>
            <div class="road-cloud road-cloud02"></div>
        </div>

        <div class="archive--contents--tab">
            <?php
            $categories = get_categories(array('parent' => 0));
            foreach ($categories as $category):
                $image_file_name = $category->slug . '.webp';
                $image_src = get_template_directory_uri() . '/img/' . $image_file_name;
                $noimg_src = get_template_directory_uri() . '/img/noimg.webp';
            ?>
                <div class="archive--item">
                    <img 
                        class="archive--item--img" 
                        src="<?php echo $image_src; ?>" 
                        alt=""
                        onerror="this.onerror=null;this.src='<?php echo $noimg_src; ?>';"
                    >
                    <div class="archive--item--title">
                        <p class="TX"><?php echo $category->name; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
        $firstCategory = true; // 最初のカテゴリーを識別するためのフラグ
        foreach ($categories as $category):
        $is_active = ($category->slug === $active_category_slug) ? 'active' : '';
        ?>

            <div class="archive--contents--items--wap<?php echo $is_active; ?> <?php echo esc_attr($category->name); ?>">
                <div class="road-header">
                    <p class="TL">カリキュラム選択　〉<?php echo esc_html($category->name); ?></p>
                    <div class="btn-box">



                        <div class="columns_search border">
                            <div class="search-item">
                                <?php get_template_part('searchform-map', 'post'); ?>
                            </div>
                        </div>





                        <div class="list-btn"></div>
                        <div class="road-menu-btn">
                            <?php get_template_part('inc/menu-btn'); ?>
                        </div>
                    </div>
                </div>



                <?php
                // カテゴリー内のすべての投稿を取得
                $args = array(
                    'category__in' => array($category->term_id),
                    'posts_per_page' => -1, // すべての投稿を取得
                );
                $query = new WP_Query($args);
                $total_posts = $query->found_posts;
                ?>
                <div class="post-list">
                    <div class="post-list-inner">
                        <ul>
                            <?php
                            if ($query->have_posts()):
                                while ($query->have_posts()): $query->the_post();
                            ?>
                                    <li>
                                        <!-- 記事ページに直接飛ぶ場合 -->
                                        <!-- <a href="<?php the_permalink(); ?>" class="post-link"> -->
                                        <a href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" class="post-link">
                                            <div class="items--img">
                                                <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.webp'; ?>" alt="">
                                            </div>
                                            <div class="items--title">
                                                <p class="TL"><?php the_title(); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                <?php
                                endwhile;
                            else:
                                ?>
                                <p>このカテゴリーには投稿がありません。</p>
                            <?php
                            endif;

                            wp_reset_postdata(); // クエリをリセット
                            ?>
                        </ul>
                    </div>
                </div>

                <?php
                // 投稿数が4つ以下の場合はセクション5のみ表示
                if ($total_posts <= 4) {
                    // クラス名を投稿数に応じて変更
                    $class_name = '';
                    if ($total_posts == 4) {
                        $class_name = 'four-posts';
                    } elseif ($total_posts == 3) {
                        $class_name = 'three-posts';
                    } elseif ($total_posts == 2) {
                        $class_name = 'two-posts';
                    } elseif ($total_posts == 1) {
                        $class_name = 'one-post';
                    }
                ?>

                    <!-- セクション5 (投稿数が4つ以下の場合のみ表示) -->
                    <section class="page-section page5 onepage <?php echo $class_name; ?>">
                        <div class="road"></div>
                        <div class="road-inner">
                            <div class="content">
                                <div class="tree tree-left"></div>
                                <div class="tree tree-right"></div>
                                <div class="castle">
                                    <div class="castle-animal">
                                        <iframe src="https://lottie.host/embed/b4994f66-3673-48c5-a9f8-a2dc72b38c6e/eWk4vLyDMj.json"></iframe>
                                    </div>
                                </div>
                                <div class="road-content">
                                    <?php
                                    if ($query->have_posts()):
                                        while ($query->have_posts()): $query->the_post();


                                        $post_id = get_the_ID();

                                            // 記事に付与されたタグを取得
                                            $post_tags = get_the_tags();
                                            $tag_classes = '';

                                            if ($post_tags && !is_wp_error($post_tags)) {
                                                // タグが存在する場合のみクラス名を追加
                                                $tag_names = array_map(function ($tag) {
                                                    // タグの名前を取得して、クラス名として使えるように変換
                                                    $tag_name = esc_attr($tag->name);
                                                    $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                    return $tag_name;
                                                }, $post_tags);
                                                $tag_classes = implode(' ', $tag_names);
                                            }

                                            // クラス名が空の場合の処理
                                            if (empty($tag_classes)) {
                                                $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                            }

                                    ?>
                                            <div class="destination <?php echo $tag_classes; ?>">
                                                <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                    <div class="goal hover-scale"></div>
                                                    <div class="goal-bg"></div>
                                                    <div class="title-board">
                                                        <?php
                                                        $slug = get_post_field('post_name', get_the_ID());
                                                        $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                        ?>
                                                        <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                    </div>

                                                </a>
                                            </div>

                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <p>このカテゴリーには投稿がありません。</p>
                                    <?php
                                    endif;

                                    wp_reset_postdata(); // クエリをリセット
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php
                } else {
                    // 投稿数が5つ以上の場合は通常のセクション表示ロジック
                ?>
                    <!-- セクション1 -->
                    <section class="page-section page1 show">
                        <div class="daytime-deco"></div>
                        <div class="road-inner">
                            <div class="content">
                                <div class="tree tree-anime"></div>
                                <div class="road-content">

                                    <?php
                                    // 全ての投稿数から最後の4つを引く
                                    $remaining_posts = $total_posts - 4;

                                    // 表示する投稿数をセクションごとに分割するロジック
                                    if ($total_posts > 55) {
                                        $num_sections = 6; // 55投稿以上の場合は、6つのセクションに分ける
                                    } elseif ($total_posts > 46) {
                                        $num_sections = 5; // 46投稿以上の場合は、5つのセクションに分ける
                                    } elseif ($total_posts > 36) {
                                        $num_sections = 4; // 36投稿以上の場合は、4つのセクションに分ける
                                    } elseif ($total_posts > 26) {
                                        $num_sections = 3; // 26投稿以上の場合は、3つのセクションに分ける
                                    } elseif ($total_posts > 16) {
                                        $num_sections = 2; // 16投稿以上の場合は、2つのセクションに分ける
                                    } else {
                                        $num_sections = 1; // 16投稿未満の場合は、1つのセクション
                                    }                        // セクションごとの平均投稿数
                                    $posts_per_section = floor($remaining_posts / $num_sections);

                                    // 余りの計算
                                    $remainder = $remaining_posts % $num_sections;

                                    // 投稿表示ロジック
                                    $post_index = 0;

                                    if ($query->have_posts()):
                                        while ($query->have_posts()): $query->the_post();

                                            // セクション1には余り分を加算
                                            if ($post_index >= $posts_per_section + ($num_sections == 1 ? $remainder : 0)) {
                                                break; // セクション1の投稿を表示するループを終了
                                            }

                                            // 記事に付与されたタグを取得
                                            $post_tags = get_the_tags();
                                            $tag_classes = '';

                                            if ($post_tags && !is_wp_error($post_tags)) {
                                                // タグが存在する場合のみクラス名を追加
                                                $tag_names = array_map(function ($tag) {
                                                    // タグの名前を取得して、クラス名として使えるように変換
                                                    $tag_name = esc_attr($tag->name);
                                                    $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                    return $tag_name;
                                                }, $post_tags);
                                                $tag_classes = implode(' ', $tag_names);
                                            }

                                            // クラス名が空の場合の処理
                                            if (empty($tag_classes)) {
                                                $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                            }
                                    ?>

                                            <div class="destination <?php echo $tag_classes; ?>">
                                                <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                    <div class="goal hover-scale">
                                                    </div>
                                                    <div class="goal-bg"></div>
                                                    <div class="title-board">
                                                        <?php
                                                        $slug = get_post_field('post_name', get_the_ID());
                                                        $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                        ?>
                                                        <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                    </div>
                                                </a>
                                            </div>


                                    <?php
                                            $post_index++;
                                        endwhile;
                                    endif;

                                    wp_reset_postdata(); // クエリをリセット
                                    ?>
                                </div>
                            </div>
                            <!-- 動的リンクの表示 -->
                            <div class="section-arrow next-section"></div>
                        </div>
                    </section>

                    <?php if ($total_posts > 16): // 投稿数が16以上の場合のみ中間セクションを表示 
                    ?>
                        <!-- セクション2 (中間セクション) -->
                        <section class="page-section page2">
                            <div class="road-inner">
                                <div class="content">
                                    <div class="tree tree-anime-animal">
                                        <div class="tree-animal">
                                        <iframe src="https://lottie.host/embed/8b84527e-a415-4e0b-a5cd-1de6cd3ffb1a/lxsh6nihf2.json" ></iframe>
                                        </div>
                                    </div>

                                    <div class="tree tree-anime-animal"></div>
                                    <div class="road-content">

                                        <?php
                                        // 中間の投稿を取得
                                        $args = array(
                                            'category__in' => array($category->term_id),
                                            'posts_per_page' => $posts_per_section,  // 次のセクションに表示する投稿数
                                            'offset' => ($posts_per_section + $remainder), // セクション1で表示した投稿数をスキップ
                                        );
                                        $query = new WP_Query($args);

                                        if ($query->have_posts()):
                                            while ($query->have_posts()): $query->the_post();

                                                // 記事に付与されたタグを取得
                                                $post_tags = get_the_tags();
                                                $tag_classes = '';

                                                if ($post_tags && !is_wp_error($post_tags)) {
                                                    // タグが存在する場合のみクラス名を追加
                                                    $tag_names = array_map(function ($tag) {
                                                        // タグの名前を取得して、クラス名として使えるように変換
                                                        $tag_name = esc_attr($tag->name);
                                                        $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                        return $tag_name;
                                                    }, $post_tags);
                                                    $tag_classes = implode(' ', $tag_names);
                                                }

                                                // クラス名が空の場合の処理
                                                if (empty($tag_classes)) {
                                                    $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                                }
                                        ?>

                                                <div class="destination <?php echo $tag_classes; ?>">
                                                    <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                        <div class="goal hover-scale">
                                                        </div>
                                                        <div class="goal-bg"></div>
                                                        <div class="title-board">
                                                            <?php
                                                            $slug = get_post_field('post_name', get_the_ID());
                                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                            ?>
                                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                        </div>

                                                    </a>
                                                </div>

                                            <?php
                                            endwhile;
                                        else:
                                            ?>
                                            <p>このカテゴリーには投稿がありません。</p>
                                        <?php
                                        endif;

                                        wp_reset_postdata(); // クエリをリセット
                                        ?>
                                    </div>
                                </div>
                                <!-- 動的リンクの表示 -->
                                <div class="section-arrow back-section"></div>
                                <div class="section-arrow next-section"></div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if ($total_posts > 26): // 投稿数が26以上の場合にさらに中間セクションを表示 
                    ?>
                        <!-- セクション3 -->
                        <section class="page-section page3">
                        <div class="sec3-anime-coaster">
                            <div class="sec3-anime-bird">
                                <iframe src="https://lottie.host/embed/421d3b3d-d381-49ba-b751-5d7dc96c02c8/XLrfuoTBb0.json"></iframe>
                            </div>
                        </div>
                            <div class="road-inner">
                                <div class="content">
                                    <div class="tree"></div>
                                    <div class="road-content">

                                        <?php
                                        // セクション3の投稿を取得
                                        $args = array(
                                            'category__in' => array($category->term_id),
                                            'posts_per_page' => $posts_per_section,  // 次のセクションに表示する投稿数
                                            'offset' => ($posts_per_section * 2 + $remainder), // セクション1と2で表示した投稿数をスキップ
                                        );
                                        $query = new WP_Query($args);

                                        if ($query->have_posts()):
                                            while ($query->have_posts()): $query->the_post();

                                                // 記事に付与されたタグを取得
                                                $post_tags = get_the_tags();
                                                $tag_classes = '';

                                                if ($post_tags && !is_wp_error($post_tags)) {
                                                    // タグが存在する場合のみクラス名を追加
                                                    $tag_names = array_map(function ($tag) {
                                                        // タグの名前を取得して、クラス名として使えるように変換
                                                        $tag_name = esc_attr($tag->name);
                                                        $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                        return $tag_name;
                                                    }, $post_tags);
                                                    $tag_classes = implode(' ', $tag_names);
                                                }

                                                // クラス名が空の場合の処理
                                                if (empty($tag_classes)) {
                                                    $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                                }
                                        ?>

                                                <div class="destination <?php echo $tag_classes; ?>">
                                                    <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                        <div class="goal">
                                                        </div>
                                                        <div class="goal-bg"></div>
                                                        <div class="title-board">
                                                            <?php
                                                            $slug = get_post_field('post_name', get_the_ID());
                                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                            ?>
                                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                        </div>

                                                    </a>
                                                </div>

                                            <?php
                                            endwhile;
                                        else:
                                            ?>
                                            <p>このカテゴリーには投稿がありません。</p>
                                        <?php
                                        endif;

                                        wp_reset_postdata(); // クエリをリセット
                                        ?>
                                    </div>
                                </div>
                                <!-- 動的リンクの表示 -->
                                <div class="section-arrow back-section"></div>
                                <div class="section-arrow next-section"></div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if ($total_posts > 36): // 投稿数が36以上の場合にさらに中間セクションを表示 
                    ?>
                        <!-- セクション4 -->

                        <section class="page-section page4">
                            <div class="road-action">
                                <div class="action-hover"></div>
                            </div>
                            <div class="road-inner">
                                <div class="content">
                                    <div class="tree"></div>
                                    <div class="road-content">

                                        <?php
                                        // セクション4の投稿を取得
                                        $args = array(
                                            'category__in' => array($category->term_id),
                                            'posts_per_page' => $posts_per_section,  // 次のセクションに表示する投稿数
                                            'offset' => ($posts_per_section * 3 + $remainder), // セクション1と2と3で表示した投稿数をスキップ
                                        );
                                        $query = new WP_Query($args);

                                        if ($query->have_posts()):
                                            while ($query->have_posts()): $query->the_post();

                                                // 記事に付与されたタグを取得
                                                $post_tags = get_the_tags();
                                                $tag_classes = '';

                                                if ($post_tags && !is_wp_error($post_tags)) {
                                                    // タグが存在する場合のみクラス名を追加
                                                    $tag_names = array_map(function ($tag) {
                                                        // タグの名前を取得して、クラス名として使えるように変換
                                                        $tag_name = esc_attr($tag->name);
                                                        $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                        return $tag_name;
                                                    }, $post_tags);
                                                    $tag_classes = implode(' ', $tag_names);
                                                }

                                                // クラス名が空の場合の処理
                                                if (empty($tag_classes)) {
                                                    $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                                }
                                        ?>

                                                <div class="destination <?php echo $tag_classes; ?>">
                                                    <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                        <div class="goal hover-scale">
                                                        </div>
                                                        <div class="goal-bg"></div>
                                                        <div class="title-board">
                                                            <?php
                                                            $slug = get_post_field('post_name', get_the_ID());
                                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                            ?>
                                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                        </div>

                                                    </a>
                                                </div>

                                            <?php
                                            endwhile;
                                        else:
                                            ?>
                                            <p>このカテゴリーには投稿がありません。</p>
                                        <?php
                                        endif;

                                        wp_reset_postdata(); // クエリをリセット
                                        ?>
                                    </div>
                                </div>
                                <!-- 動的リンクの表示 -->
                                <div class="section-arrow back-section"></div>
                                <div class="section-arrow next-section"></div>
                            </div>
                        </section>
                    <?php endif; ?>


                    <?php if ($total_posts > 46): // 投稿数が46以上の場合にセクション4.5を表示 
                    ?>
                        <!-- セクション4.5 -->
                        <section class="page-section page4-5">
                            <div class="road-inner">
                                <div class="content">
                                    <div class="tree"></div>
                                    <div class="road-content">
                                        <?php
                                        // セクション4.5の投稿を取得
                                        $args = array(
                                            'category__in' => array($category->term_id),
                                            'posts_per_page' => $posts_per_section,  // ここで表示する投稿数
                                            'offset' => ($posts_per_section * 4 + $remainder), // セクション1から4まで表示した投稿数をスキップ
                                        );
                                        $query = new WP_Query($args);

                                        if ($query->have_posts()):
                                            while ($query->have_posts()): $query->the_post();

                                                // 記事に付与されたタグを取得
                                                $post_tags = get_the_tags();
                                                $tag_classes = '';

                                                if ($post_tags && !is_wp_error($post_tags)) {
                                                    // タグが存在する場合のみクラス名を追加
                                                    $tag_names = array_map(function ($tag) {
                                                        // タグの名前を取得して、クラス名として使えるように変換
                                                        $tag_name = esc_attr($tag->name);
                                                        $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                        return $tag_name;
                                                    }, $post_tags);
                                                    $tag_classes = implode(' ', $tag_names);
                                                }

                                                // クラス名が空の場合の処理
                                                if (empty($tag_classes)) {
                                                    $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                                }
                                        ?>

                                                <div class="destination <?php echo $tag_classes; ?>">
                                                    <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                        <div class="goal hover-scale"></div>
                                                        <div class="goal-bg"></div>
                                                        <div class="title-board">
                                                            <?php
                                                            $slug = get_post_field('post_name', get_the_ID());
                                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                            ?>
                                                            <p class="board-TX"><?php echo esc_html($decoded_slug); ?></p>
                                                        </div>
                                                    </a>
                                                </div>

                                        <?php
                                            endwhile;
                                        endif;

                                        wp_reset_postdata(); // クエリをリセット
                                        ?>
                                    </div>
                                </div>
                                <!-- 動的リンクの表示 -->
                                <div class="section-arrow back-section"></div>
                                <div class="section-arrow next-section"></div>
                            </div>
                        </section>
                    <?php endif; ?>





                    <?php if ($total_posts > 55): // 投稿数が56以上の場合にセクション4.6を表示 
                    ?>
                        <!-- セクション4.6 -->
                        <section class="page-section page4-6">
                            <div class="road-inner">
                                <div class="content">
                                    <div class="tree"></div>
                                    <div class="road-content">
                                        <?php
                                        // セクション4.6の投稿を取得
                                        $args = array(
                                            'category__in' => array($category->term_id),
                                            'posts_per_page' => $posts_per_section,  // ここで表示する投稿数
                                            'offset' => ($posts_per_section * 5 + $remainder), // セクション1から4.5まで表示した投稿数をスキップ
                                        );
                                        $query = new WP_Query($args);

                                        if ($query->have_posts()):
                                            while ($query->have_posts()): $query->the_post();

                                                // 記事に付与されたタグを取得
                                                $post_tags = get_the_tags();
                                                $tag_classes = '';

                                                if ($post_tags && !is_wp_error($post_tags)) {
                                                    // タグが存在する場合のみクラス名を追加
                                                    $tag_names = array_map(function ($tag) {
                                                        // タグの名前を取得して、クラス名として使えるように変換
                                                        $tag_name = esc_attr($tag->name);
                                                        $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                        return $tag_name;
                                                    }, $post_tags);
                                                    $tag_classes = implode(' ', $tag_names);
                                                }

                                                // クラス名が空の場合の処理
                                                if (empty($tag_classes)) {
                                                    $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                                }

                                        ?>

                                                <div class="destination <?php echo $tag_classes; ?>">
                                                    <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                        <div class="goal hover-scale"></div>
                                                        <div class="goal-bg"></div>
                                                        <div class="title-board">
                                                            <?php
                                                            $slug = get_post_field('post_name', get_the_ID());
                                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                            ?>
                                                            <p class="board-TX"><?php echo esc_html($decoded_slug); ?></p>
                                                        </div>
                                                    </a>
                                                </div>

                                        <?php
                                            endwhile;
                                        endif;

                                        wp_reset_postdata(); // クエリをリセット
                                        ?>
                                    </div>
                                </div>
                                <!-- 動的リンクの表示 -->
                                <div class="section-arrow back-section"></div>
                                <div class="section-arrow next-section"></div>
                            </div>
                        </section>
                    <?php endif; ?>






                    <!-- セクション5 (最後の5つの投稿) -->
                    <section class="page-section page5">
                        <div class="load"></div>

                        <div class="road-inner">

                            <div class="content">
                                <div class="tree tree-left"></div>
                                <div class="tree tree-right"></div>
                                <div class="castle">
                                    <div class="castle-animal">
                                        <iframe src="https://lottie.host/embed/b4994f66-3673-48c5-a9f8-a2dc72b38c6e/eWk4vLyDMj.json"></iframe>
                                    </div>
                                </div>
                                <div class="road-content">
                                    <?php
                                    // 最後の4つの投稿を取得
                                    $args = array(
                                        'category__in' => array($category->term_id),
                                        'posts_per_page' => 4,  // 最後の4つのみ取得
                                        'offset' => $total_posts - 4, // 最後の4つを取得するためのオフセット
                                    );
                                    $query = new WP_Query($args);

                                    if ($query->have_posts()):
                                        while ($query->have_posts()): $query->the_post();

                                            // 記事に付与されたタグを取得
                                            $post_tags = get_the_tags();
                                            $tag_classes = '';

                                            if ($post_tags && !is_wp_error($post_tags)) {
                                                // タグが存在する場合のみクラス名を追加
                                                $tag_names = array_map(function ($tag) {
                                                    // タグの名前を取得して、クラス名として使えるように変換
                                                    $tag_name = esc_attr($tag->name);
                                                    $tag_name = preg_replace('/[^a-zA-Z0-9]/', '_', $tag_name); // 非アルファベット・非数字はアンダースコアに置換
                                                    return $tag_name;
                                                }, $post_tags);
                                                $tag_classes = implode(' ', $tag_names);
                                            }

                                            // クラス名が空の場合の処理
                                            if (empty($tag_classes)) {
                                                $tag_classes = 'no-tags'; // タグがない場合にデフォルトのクラスを設定
                                            }
                                    ?>

                                            <div class="destination <?php echo $tag_classes; ?>">
                                                <a class="goal-wrap" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                    <div class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>">
                                                    </div>
                                                    <div class="goal-bg"></div>
                                                    <div class="title-board">
                                                        <?php
                                                        $slug = get_post_field('post_name', get_the_ID());
                                                        $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                        ?>
                                                        <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                    </div>

                                                </a>
                                            </div>

                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <p>このカテゴリーには投稿がありません。</p>
                                    <?php
                                    endif;

                                    wp_reset_postdata(); // クエリをリセット
                                    ?>
                                </div>
                            </div>
                            <!-- 動的リンクの表示 -->
                            <div class="section-arrow back-section"></div>
                        </div>
                    </section>

                <?php
                }
                ?>
            </div>
        <?php
            $firstCategory = false; // 最初のカテゴリー後はフラグをfalseに設定
        endforeach;
        ?>

<div class="road-chat">
            <div class="C_chat-content">
                <?php if (function_exists('simple_ajax_chat')) simple_ajax_chat(); ?>

                <!-- この要素追加で新着メッセージ表示 -->
                <a href="<?php echo home_url(); ?>/chat" id="latest-messages"></a>

                <div class="timeline-wrap">
                    <div class="timeline">
                        <?php
                        // ログインしているユーザーのグループを取得
                        $current_user_id = get_current_user_id();
                        $user_group = $current_user_id ? get_user_meta($current_user_id, 'user_group', true) : null;

                        // JavaScriptのエンキューとデータのローカライズ
                        wp_enqueue_script('cooperator-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
                        wp_localize_script('cooperator-script', 'userGroupData', array(
                            'group' => $user_group,
                            'username' => wp_get_current_user()->user_login,
                            'ajaxurl' => admin_url('admin-ajax.php'),
                            'allUsersProgress' => $all_users_progress
                        ));

                        // 同じグループに所属するユーザーを取得
                        $args = array(
                            'meta_key'   => 'user_group',
                            'meta_value' => $user_group,
                        );

                        $group_users = get_users($args);

                        // 最新の完了項目を保持する変数
                        $latest_completion = null;
                        $latest_completion_date = null;

                        // グループユーザーの進捗をチェック
                        foreach ($group_users as $user) {
                            $user_id = $user->ID;
                            $user_name = $user->display_name;

                            // ユーザーの進捗を取得（各項目の100%チェック）
                            $progress_data = array();
                            $user_info = add_user_info(); // add_user_info 関数で追加したフィールドを取得

                            foreach ($user_info as $key => $label) {
                                $progress_data[$label] = get_user_meta($user_id, $key, true) ?: '0';
                            }

                            // 日時を保存するカスタムフィールド名の準備
                            $latest_completion_date = null;  // 最新の完了日時を初期化
                            $latest_completion = null;       // 最新の完了項目の情報を初期化

                            foreach ($progress_data as $key => $value) {
                                if ($value == '100') {
                                    // 日付フィールド名を動的に取得
                                    $date_field_key = $key . '_date';

                                    // // 日付が未設定の場合、現在の日時を設定
                                    // if (!get_user_meta($user_id, $date_field_key, true)) {
                                    //     $current_time = current_time('mysql');
                                    //     update_user_meta($user_id, $date_field_key, $current_time);
                                    // }

                                    // 完了日時を取得
                                    $completion_date = get_user_meta($user_id, $date_field_key, true);
                                    $formatted_date = date_i18n('n月j日 G:i', strtotime($completion_date));

                                    // 最新の完了項目かどうかをチェック
                                    if (is_null($latest_completion_date) || strtotime($completion_date) > strtotime($latest_completion_date)) {
                                        $latest_completion_date = $completion_date;
                                        $latest_completion = array(
                                            'user_name' => $user_name,
                                            'key' => $key,
                                            'date' => $formatted_date,
                                            'item_id' => $user_id . '_' . $key
                                        );
                                    }
                                }
                            }
                        }
                        // 最新の完了項目を表示
                        if ($latest_completion) {
                            $like_count = get_option('global_like_count_' . $latest_completion['item_id'], 0); // グローバルいいね数を取得
                            $liked_items = get_user_meta(get_current_user_id(), 'liked_items', true) ?: array();
                            $already_liked = in_array($latest_completion['item_id'], $liked_items);

                            echo '<div class="timeline-item">';
                            echo '<h3>' . esc_html($latest_completion['user_name']) . 'さんが<br>' . esc_html($latest_completion['key']) . 'を完了しました' . '</h3>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <a href="<?php echo home_url(); ?>/chat" class="C_reaction">
                    <p class="TX">5回リアクションを<br>送ろう！</p>
                    <div class="reaction-counter">0/5</div>
                    <div class="coin-counter">
                        <div class="icon"></div>
                        <div class="number">3</div>
                    </div>
                </a>

            </div>
        </div>

    </div>


</div>
<!-- データの受け渡し用スクリプト -->
<script>
    const allUsersProgress = <?php echo json_encode($all_users_progress); ?>;
    const currentUsername = <?php echo json_encode($current_username); ?>;
    const characterHtml = <?php echo json_encode($character_html); ?>;
    const lastPostProgress = <?php echo json_encode($last_post_progress); ?>; // 追加
</script>

<?php get_footer(); ?>


