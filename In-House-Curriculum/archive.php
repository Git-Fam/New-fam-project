<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header(); 

// 現在のユーザー情報を取得
$current_user = wp_get_current_user();
$current_username = $current_user->display_name; // 現在のログインユーザーの表示名
$original_user_id = $current_user->ID; // 元のユーザーIDを保持

// 全ユーザーの進捗データとキャラクターHTMLを格納する配列
$all_users_progress = [];
$all_users_characters = [];
$last_post_progress = []; // 最後の投稿が100%になってから1週間経過したかどうか

// 全ユーザーを取得
$users = get_users();

function get_last_post_in_category($category_id) {
    // カテゴリーの最後の投稿を取得
    $args = array(
        'category__in' => array($category_id),
        'posts_per_page' => 1, // 最後の投稿を1つだけ取得
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        return get_the_ID(); // 投稿IDを返す
    }

    return null; // 投稿がない場合
}

function check_last_post_progress($user_id, $category_id) {
    // カテゴリーの最後の投稿IDを取得
    $last_post_id = get_last_post_in_category($category_id);

    if ($last_post_id) {
        // 最後の投稿に紐付く進捗フィールド
        $progress_field = 'progress_field_' . $last_post_id;
        $progress_value = get_user_meta($user_id, $progress_field, true);

        // 進捗が100%かどうか
        if (intval($progress_value) === 100) {
            // 進捗が100%になった日時を取得（ない場合は保存する）
            $completion_date_field = $progress_field . '_date'; // 日時を保存するカスタムフィールド
            $completion_date = get_user_meta($user_id, $completion_date_field, true);

            if (!$completion_date) {
                // 初めて100%になった場合、現在の日時を保存
                $completion_date = current_time('mysql');
                update_user_meta($user_id, $completion_date_field, $completion_date);
            }

            // 100%になってから1週間経過したかをチェック
            $one_week_later = strtotime($completion_date) + (7 * 24 * 60 * 60); // 1週間後
            $current_time = current_time('timestamp');

            if ($current_time >= $one_week_later) {
                return true; // 1週間経過したら非表示にする
            } else {
                return false; // 1週間経過していない場合は表示する
            }
        }
    }

    return false; // 進捗が100%でないか、投稿が見つからない場合
}

foreach ($users as $user) {
    $user_id = $user->ID;
    ob_start();
    wp_set_current_user($user_id); // ユーザーを一時的に切り替え
    display_character(); // ユーザーごとのキャラクターHTMLを取得
    $character_html = ob_get_clean();

    // ユーザーごとのキャラクターHTMLを保存
    $all_users_characters[] = array(
        'username' => $user->display_name,
        'character_html' => $character_html,
    );

    // 各ユーザーのメタデータ（進捗データ）を取得
    $user_meta = get_user_meta($user_id); 
    $progress_data = []; // 各ユーザーの進捗データを格納する配列
    
    // メタデータをループして進捗データのみを取得
    foreach ($user_meta as $meta_key => $meta_value) {
        // 特定の進捗に関連するキーのみをフィルタリング
        if (preg_match('/^(div|responsive|JQ|LP|Sass|React|Java|Design|SEO|Form|FAM|test|JS|WP)/', $meta_key)) {
            // 進捗データに追加（空白値の場合は '0' にする）
            $progress_data[$meta_key] = !empty($meta_value[0]) ? $meta_value[0] : '0';
        }
    }

    // ユーザーごとの進捗データを配列に追加
    $all_users_progress[] = array(
        'user_id' => $user_id,
        'username' => $user->display_name,
        'progress' => $progress_data,
    );

    // 各カテゴリーごとの最後の投稿に紐付く進捗をチェック
    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーを取得
    foreach ($categories as $category) {
        $category_id = $category->term_id;
        $last_post_progress[$category_id][$user_id] = check_last_post_progress($user_id, $category_id);
    }
}

// ユーザーIDを元に戻す
wp_set_current_user($original_user_id);

// JavaScriptに全ユーザーの進捗データとキャラクターHTML、そして最後の投稿の進捗情報を渡す
wp_enqueue_script('cooperator-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
wp_localize_script('cooperator-script', 'wpData', array(
    'allUsersProgress' => $all_users_progress,
    'allUsersCharacters' => $all_users_characters, // キャラクターHTMLをJavaScriptに渡す
    'lastPostProgress' => $last_post_progress, // 最後の投稿に紐付く進捗情報（1週間経過フラグ付き）
));



// URLのcategoryパラメータを取得
$active_category = isset($_GET['category']) ? urldecode($_GET['category']) : '';

?>
<script>
    var selectCategory = <?php echo json_encode($active_category); ?>;
</script>


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

                            if ($post_tags && !is_wp_error($post_tags)) {
                                // タグが存在する場合のみクラス名を追加
                                $tag_names = array_map(function($tag) {
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
                                <div class="goal-wrap">
                                    <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                    </a>
                                    <div class="goal-bg">
                                        <div class="title-board">
                                            <?php
                                            $slug = get_post_field('post_name', get_the_ID());
                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                            ?>
                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                        </div>
                                    </div>
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

                            if ($post_tags && !is_wp_error($post_tags)) {
                                // タグが存在する場合のみクラス名を追加
                                $tag_names = array_map(function($tag) {
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
                                <div class="goal-wrap">
                                    <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                    </a>
                                    <div class="goal-bg"></div>
                                        <div class="title-board">
                                            <?php
                                            $slug = get_post_field('post_name', get_the_ID());
                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                            ?>
                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                        </div>
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
            <div class="section-arrow next-section"></div>
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

                                if ($post_tags && !is_wp_error($post_tags)) {
                                    // タグが存在する場合のみクラス名を追加
                                    $tag_names = array_map(function($tag) {
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
                                <div class="goal-wrap">
                                    <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                    </a>
                                    <div class="goal-bg">
                                        <div class="title-board">
                                            <?php
                                            $slug = get_post_field('post_name', get_the_ID());
                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                            ?>
                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                        </div>
                                    <div class="title-board">
                                        <?php
                                        $slug = get_post_field('post_name', get_the_ID());
                                        $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                        ?>
                                        <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                    </div>
                                    </div>
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
                <div class="section-arrow back-section"></div>
                <div class="section-arrow next-section"></div>
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

                                if ($post_tags && !is_wp_error($post_tags)) {
                                    // タグが存在する場合のみクラス名を追加
                                    $tag_names = array_map(function($tag) {
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
                                <div class="goal-wrap">
                                    <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                    </a>
                                    <div class="goal-bg">
                                        <div class="title-board">
                                            <?php
                                            $slug = get_post_field('post_name', get_the_ID());
                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                            ?>
                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                        </div>
                                    </div>
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
                <div class="section-arrow back-section"></div>
                <div class="section-arrow next-section"></div>
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

                                if ($post_tags && !is_wp_error($post_tags)) {
                                    // タグが存在する場合のみクラス名を追加
                                    $tag_names = array_map(function($tag) {
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
                                <div class="goal-wrap">
                                    <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                    </a>
                                    <div class="goal-bg">
                                        <div class="title-board">
                                            <?php
                                            $slug = get_post_field('post_name', get_the_ID());
                                            $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                            ?>
                                            <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                        </div>
                                    </div>
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

                                    if ($post_tags && !is_wp_error($post_tags)) {
                                        // タグが存在する場合のみクラス名を追加
                                        $tag_names = array_map(function($tag) {
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
                                        <div class="goal-wrap">
                                            <a class="goal hover-scale" href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" >
                                            </a>
                                            <div class="goal-bg">
                                                <div class="title-board">
                                                    <?php
                                                    $slug = get_post_field('post_name', get_the_ID());
                                                    $decoded_slug = urldecode($slug); // URLエンコードされている場合にデコード
                                                    ?>
                                                    <p class="board-TX"> <?php echo esc_html($decoded_slug); ?></p>
                                                </div>
                                            </div>
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
                    
                                // 日付が未設定の場合、現在の日時を設定
                                if (!get_user_meta($user_id, $date_field_key, true)) {
                                    $current_time = current_time('mysql');
                                    update_user_meta($user_id, $date_field_key, $current_time);
                                }
                    
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

            <a href="<?php echo home_url();?>/chat" class="C_reaction">
                <p class="TX">5回リアクションを<br>送ろう！</p>
                <div class="reaction-counter">0/5</div>
                <div class="coin-counter">
                    <div class="icon"></div>
                    <div class="number">3</div>
                </div>
            </a>

        </div>
    </div>

    <div class="under-menu">
        <div class="menu-arrow"></div>
        <div class="menu-box">
            <a href="<?php echo home_url();?>/my" class="btn road-my-btn"></a>
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
    const characterHtml = <?php echo json_encode($character_html); ?>;
    const lastPostProgress = <?php echo json_encode($last_post_progress); ?>; // 追加
</script>

<?php get_footer(); ?>



