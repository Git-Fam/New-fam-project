<?php
// AJAXハンドラを追加（ログインユーザー用）
add_action('wp_ajax_handle_like', 'handle_like');

function handle_like() {
    $user_id = get_current_user_id();
    $item_id = sanitize_text_field($_POST['item_id']);
    $like_count = get_option('global_like_count_' . $item_id, 0);
    $like_count_today = get_user_meta($user_id, 'like_count_today', true) ?: 0;

    $liked_items = get_user_meta($user_id, 'liked_items', true) ?: array();
    if (in_array($item_id, $liked_items)) {
        wp_send_json_error(array('message' => 'このタイムラインには既に「いいね」しています。'));
    }

    if ($like_count_today + 1 == 5) {
        wp_send_json_error(array('message' => '5回いいねしました。3コイン獲得です'));
    }

    if ($like_count_today >= 5) {
        wp_send_json_error(array('message' => '今日はこれ以上「いいね」できません。'));
    }

    $like_count += 1;
    update_option('global_like_count_' . $item_id, $like_count);
    update_user_meta($user_id, 'like_count_today', $like_count_today + 1);

    $liked_items[] = $item_id;
    update_user_meta($user_id, 'liked_items', $liked_items);

    wp_send_json_success(array('new_count' => $like_count, 'message' => '「いいね」が成功しました。'));
}

// スクリプトの登録とajaxurlの設定
function my_enqueue_scripts() {
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
    wp_localize_script('my-script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

