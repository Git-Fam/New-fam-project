<?php


// チャットボットの投稿内容を取得するためのAJAXハンドラー
function get_chatbot_content() {
    if (isset($_POST['post_id'])) {
        $post_id = intval($_POST['post_id']); // 投稿IDを整数に変換して取得

        // 投稿内容を取得
        $post = get_post($post_id);

        if ($post) {
            // 投稿内容を返す
            echo '<h2>' . esc_html(get_the_title($post)) . '</h2>';
            echo apply_filters('the_content', $post->post_content); // 投稿内容をフィルタリングして表示
        } else {
            echo '質問が見つかりませんでした。';
        }
    }
    wp_die(); // 終了させる
}

// チャットボット投稿の検索用AJAXハンドラー
function search_chatbot_posts() {
    $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type' => 'chatbot',
        's' => $search_term, // 検索キーワード
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul id="q-and-a-list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="#" class="chatbot-title" data-id="' . get_the_ID() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '一致する質問が見つかりませんでした。';
    }

    wp_reset_postdata();
    wp_die(); // 終了させる
}

// コメント検索用のAJAXハンドラー
function search_comments() {
    $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    // コメントを検索するクエリ
    $args = array(
        'search' => $search_term, // 検索キーワード
        'number' => 10, // 最大10件のコメントを取得
        'status' => 'approve', // 承認済みのコメントのみ取得
        'post_type' => 'question' // 投稿タイプ「question」のコメントを検索
    );

    $comments = get_comments($args);

    if (!empty($comments)) {
        echo '<div id="comments" class="comments-area"><ol class="comment-list">';
        
        // wp_list_commentsを使ってmytheme_commentコールバックでコメントを表示
        wp_list_comments(array(
            'style' => 'ol',
            'callback' => 'mytheme_comment',
            'reverse_top_level' => false // コメントの表示順序を逆転させない
        ), $comments);

        echo '</ol></div>';
    } else {
        echo '一致する質問が見つかりませんでした。';
    }

    wp_die(); // 終了させる
}

// すべてのコメントを取得するAJAXハンドラー
function get_all_comments() {
    // コメントを取得するクエリ
    $args = array(
        'number' => 10, // 必要に応じて取得するコメント数を変更
        'status' => 'approve', // 承認済みのコメントのみ取得
        'post_type' => 'question' // 投稿タイプ「question」のコメントを取得
    );

    $comments = get_comments($args);

    if (!empty($comments)) {
        echo '<div id="comments" class="comments-area"><ol class="comment-list">';
        
        // wp_list_commentsを使ってmytheme_commentコールバックでコメントを表示
        wp_list_comments(array(
            'style' => 'ol',
            'callback' => 'mytheme_comment',
            'reverse_top_level' => false // コメントの表示順序を逆転させない
        ), $comments);

        echo '</ol></div>';
    } else {
        echo '質問が見つかりませんでした。';
    }

    wp_die(); // 終了させる
}

// AJAXアクションフックを登録
add_action('wp_ajax_get_chatbot_content', 'get_chatbot_content'); 
add_action('wp_ajax_search_chatbot_posts', 'search_chatbot_posts'); 
add_action('wp_ajax_search_comments', 'search_comments'); 
add_action('wp_ajax_get_all_comments', 'get_all_comments'); 

// JavaScriptファイルの読み込みとデータの渡し
function enqueue_custom_scripts() {
    // JavaScriptファイルを登録（例：'cooperatorScript'というハンドル名で読み込む）
    wp_enqueue_script('cooperatorScript', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
    
    // JavaScriptファイルにデータを渡す（wp_enqueue_scriptの後に呼び出す）
    wp_localize_script('cooperatorScript', 'chatbot_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
?>
