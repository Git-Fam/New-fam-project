<?php
get_header(); 

// 現在のユーザー名を取得
$current_user = wp_get_current_user();
$current_username = $current_user->display_name; // 現在のログインユーザーの表示名

// 全ユーザーの進捗データを格納する配列
$all_users_progress = [];

// 全ユーザーを取得
$users = get_users();

foreach ($users as $user) {
    $user_id = $user->ID;
    $username = $user->display_name; // ユーザー名を取得

    // 各ユーザーの進捗データを取得
    $progress_data = [];

    // div01からdiv07のデータを取得
    for ($i = 1; $i <= 7; $i++) {
        $progress_data["div0{$i}"] = get_user_meta($user_id, "div0{$i}", true) ?: '0';
    }

    // responsiveのデータを取得
    $progress_data["responsive"] = get_user_meta($user_id, "responsive", true) ?: '0';

    $progress_data["JQ01"] = get_user_meta($user_id, "JQ01", true) ?: '0';

    // ユーザーごとの進捗データを配列に追加
    $all_users_progress[] = array(
        'user_id' => $user_id,
        'username' => $username,
        'progress' => $progress_data,
    );
}
?>

<div class="sp-wrap">
<div class="road-wappaer">
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
        $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
        foreach ($categories as $category):
            // カテゴリーに対応する画像ファイル名を想定しています。実際には適切に設定してください。
            $image_file_name = $category->slug . '.png';
            ?>
            <div class="archive--item">
                <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                <div class="archive--item--title">
                    <p class="TX"><?php echo $category->name; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="arrow"></div>

    <?php
        $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
        $firstCategory = true; // 最初のカテゴリーを識別するためのフラグ
        foreach ($categories as $category):
    ?>

    <div class="archive--contents--items--wap<?php if ($firstCategory) echo ' active'; ?> <?php echo esc_attr($category->name); ?>">
    <div class="road-header">
            <p class="TL">カリキュラム選択　〉<?php echo esc_html($category->name); ?></p>
    </div>

<?php
// カテゴリー内のすべての投稿を取得
$args = array(
    'category__in' => array($category->term_id),
    'posts_per_page' => -1, // すべての投稿を取得
);
$query = new WP_Query($args);
$total_posts = $query->found_posts;

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
                <div class="castle"></div>
                <div class="road-content">
                    <?php
                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post();

                            // 記事に付与されたタグを取得
                            $post_tags = get_the_tags();
                            $tag_classes = '';

                            if ($post_tags) {
                                foreach ($post_tags as $tag) {
                                    $tag_classes .= ' ' . esc_attr($tag->slug);
                                }
                            }
                            ?>

                            <div class="destination <?php echo $tag_classes; ?>">
                                <div class="goal-wrap">
                                    <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                    </a>
                                    <div class="goal-bg"></div>
                                </div>
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
        <div class="road-inner">
            <div class="content">
                <div class="tree"></div>
                <div class="road-content">

                    <?php
                    // 全ての投稿数から最後の4つを引く
                    $remaining_posts = $total_posts - 4;

                    // 表示する投稿数をセクションごとに分割するロジック
                    if ($total_posts > 36) {
                        $num_sections = 4; // 36投稿以上の場合は、4つのセクションに分ける
                    } elseif ($total_posts > 26) {
                        $num_sections = 3; // 26投稿以上の場合は、3つのセクションに分ける
                    } elseif ($total_posts > 16) {
                        $num_sections = 2; // 16投稿以上の場合は、2つのセクションに分ける
                    } else {
                        $num_sections = 1; // 16投稿未満の場合は、1つのセクション
                    }            
                    // セクションごとの平均投稿数
                    $posts_per_section = floor($remaining_posts / $num_sections);

                    // 余りの計算
                    $remainder = $remaining_posts % $num_sections;

                    // 投稿表示ロジック
                    $post_index = 0;

                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post();

                            // セクション1には余り分を加算
                            if ($post_index >= ($posts_per_section + $remainder)) {
                                break; // セクション1の投稿を表示するループを終了
                            }

                            // 記事に付与されたタグを取得
                            $post_tags = get_the_tags();
                            $tag_classes = '';

                            if ($post_tags) {
                                foreach ($post_tags as $tag) {
                                    $tag_classes .= ' ' . esc_attr($tag->slug);
                                }
                            }
                            ?>

                            <div class="destination <?php echo $tag_classes; ?>">
                                <div class="goal-wrap">
                                    <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                    </a>
                                    <div class="goal-bg"></div>
                                </div>
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
             <div class="arrow-box">
                <div class="section-arrow next-section"></div>
             </div>
        </div>
    </section>

        <?php if ($total_posts > 16): // 投稿数が16以上の場合のみ中間セクションを表示 ?>
        <!-- セクション2 (中間セクション) -->
        <section class="page-section page2">
            <div class="road-inner">
                <div class="content">
                    <div class="tree"></div>
                    <div class="road-content">
                
                        <?php
                        // 中間の投稿を取得
                        $args = array(
                            'category__in' => array($category->term_id),
                            'posts_per_page' =>$posts_per_section,  // 次のセクションに表示する投稿数
                            'offset' => ($posts_per_section + $remainder), // セクション1で表示した投稿数をスキップ
                        );
                        $query = new WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post();

                                // 記事に付与されたタグを取得
                                $post_tags = get_the_tags();
                                $tag_classes = '';

                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        $tag_classes .= ' ' . esc_attr($tag->slug);
                                    }
                                }
                                ?>

                                <div class="destination <?php echo $tag_classes; ?>">
                                <div class="goal-wrap">
                                    <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                    </a>
                                    <div class="goal-bg"></div>
                                </div>
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
                <div class="arrow-box">
                    <div class="section-arrow back-section"></div>
                    <div class="section-arrow next-section"></div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if ($total_posts > 26): // 投稿数が26以上の場合にさらに中間セクションを表示 ?>
        <!-- セクション3 -->
        <section class="page-section page3">
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

                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        $tag_classes .= ' ' . esc_attr($tag->slug);
                                    }
                                }
                                ?>

                                <div class="destination <?php echo $tag_classes; ?>">
                                <div class="goal-wrap">
                                    <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                    </a>
                                    <div class="goal-bg"></div>
                                </div>
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
                <div class="arrow-box">
                    <div class="section-arrow back-section"></div>
                    <div class="section-arrow next-section"></div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if ($total_posts > 36): // 投稿数が36以上の場合にさらに中間セクションを表示 ?>
        <!-- セクション4 -->
        <section class="page-section page4">
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

                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        $tag_classes .= ' ' . esc_attr($tag->slug);
                                    }
                                }
                                ?>

                                <div class="destination <?php echo $tag_classes; ?>">
                                <div class="goal-wrap">
                                    <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                    </a>
                                    <div class="goal-bg"></div>
                                </div>
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
                <div class="arrow-box">
                    <div class="section-arrow back-section"></div>
                    <div class="section-arrow next-section"></div>
                </div>
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
                        <div class="castle"></div>
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

                                    if ($post_tags) {
                                        foreach ($post_tags as $tag) {
                                            $tag_classes .= ' ' . esc_attr($tag->slug);
                                        }
                                    }
                                    ?>

                                    <div class="destination <?php echo $tag_classes; ?>">
                                        <div class="goal-wrap">
                                            <a class="goal" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" target="_blank" rel="noopener noreferrer">
                                            </a>
                                            <div class="goal-bg"></div>
                                        </div>
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
                    <div class="arrow-box">
                        <div class="section-arrow back-section"></div>
                    </div>
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
            <div id="latest-messages"></div>

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
                        'ajaxurl' => admin_url('admin-ajax.php')
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
                        $user_id = $user->ID;  // ループ内のユーザーID
                        $user_name = $user->display_name;

                        // ユーザーの進捗を取得（各項目の100%チェック）
                        $progress_data = array(
                            'div01パズル' => get_user_meta($user_id, 'div01', true) ?: '0',
                            'div02パズル' => get_user_meta($user_id, 'div02', true) ?: '0',
                            'div03パズル' => get_user_meta($user_id, 'div03', true) ?: '0',
                            'div04パズル' => get_user_meta($user_id, 'div04', true) ?: '0',
                            'div05パズル' => get_user_meta($user_id, 'div05', true) ?: '0',
                            'div06パズル' => get_user_meta($user_id, 'div06', true) ?: '0',
                            'div07パズル' => get_user_meta($user_id, 'div07', true) ?: '0',
                            'responsive' => get_user_meta($user_id, 'responsive', true) ?: '0',
                            'jQuery01' => get_user_meta($user_id, 'JQ01', true) ?: '0',
                            'jQuery02' => get_user_meta($user_id, 'JQ02', true) ?: '0',
                            'jQuery03' => get_user_meta($user_id, 'JQ03', true) ?: '0',
                            'jQuery04' => get_user_meta($user_id, 'JQ04', true) ?: '0',
                            'jQuery05' => get_user_meta($user_id, 'JQ05', true) ?: '0',
                            'jQuery06' => get_user_meta($user_id, 'JQ06', true) ?: '0',
                            'jQuery07' => get_user_meta($user_id, 'JQ07', true) ?: '0',
                            'jQuery08' => get_user_meta($user_id, 'JQ08', true) ?: '0',
                            'jQuery09' => get_user_meta($user_id, 'JQ09', true) ?: '0',
                            'jQuery10' => get_user_meta($user_id, 'JQ10', true) ?: '0',
                            'jQuery最終課題' => get_user_meta($user_id, 'JQLast', true) ?: '0',
                            'サイト制作' => get_user_meta($user_id, 'LP01', true) ?: '0',
                            'Sass01' => get_user_meta($user_id, 'Sass01', true) ?: '0',
                            'FAM01' => get_user_meta($user_id, 'FAM01', true) ?: '0',
                            'JS01' => get_user_meta($user_id, 'JS01', true) ?: '0',
                            'WP01' => get_user_meta($user_id, 'WP01', true) ?: '0',
                            'SEO01' => get_user_meta($user_id, 'SEO01', true) ?: '0',
                        );

                        // 日時を保存するカスタムフィールド名
                        $date_fields = array(
                            'div01_date', 'div02_date', 'div03_date', 'div04_date', 'div05_date',
                            'div06_date', 'div07_date', 'responsive_date', 'JQ01_date', 'JQ02_date',
                            'JQ03_date', 'JQ04_date', 'JQ05_date', 'JQ06_date', 'JQ07_date',
                            'JQ08_date', 'JQ09_date', 'JQ10_date', 'JQLast_date', 'LP01_date',
                            'Sass01_date', 'FAM01_date', 'JS01_date', 'WP01_date', 'SEO01_date'
                        );

                        // 100%の項目をタイムラインに表示
                        $i = 0;
                        foreach ($progress_data as $key => $value) {
                            if ($value == '100') {
                                if (!get_user_meta($user_id, $date_fields[$i], true)) {
                                    $current_time = current_time('mysql');
                                    update_user_meta($user_id, $date_fields[$i], $current_time);
                                }

                                $completion_date = get_user_meta($user_id, $date_fields[$i], true);
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
                            $i++;
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

            <div class="C_reaction">
                <p class="TX">5回リアクションを<br>送ろう！</p>
                <div class="reaction-counter">0/5</div>
                <div class="coin-counter">
                    <div class="icon"></div>
                    <div class="number">3</div>
                </div>
            </div>

        </div>
    </div>

    <div class="under-menu">
        <div class="menu-arrow"></div>
        <div class="menu-box">
            <a href="<?php echo home_url(); ?>/my" class="btn road-my-btn"></a>
            <a href="<?php echo home_url(); ?>/ranking" class="btn road-ranking-btn"></a>
            <a href="<?php echo home_url(); ?>/column" class="btn road-column-btn"></a>
            <a href="<?php echo home_url(); ?>/question" class="btn road-question-btn"></a>
            <a href="<?php echo home_url(); ?>/game" class="btn road-game-btn"></a>

        </div>
    </div>
</div>

</div>
<!-- データの受け渡し用スクリプト -->
<script>
    const allUsersProgress = <?php echo json_encode($all_users_progress); ?>;
    const currentUsername = <?php echo json_encode($current_username); ?>;
    const showJQSection = <?php echo is_page('road-jq') ? 'true' : 'false'; ?>; // ページによるJQ表示の切り替え
</script>

<?php get_footer(); ?>
