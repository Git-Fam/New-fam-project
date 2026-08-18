<?php
// ユーザー名に基づいてグループ情報を取得するAJAXハンドラー
function get_user_group_by_name() {
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = sanitize_text_field($_POST['username']);
        $user = get_user_by('login', $username);

        if (!$user) {
            $user_query = new WP_User_Query(array(
                'search' => '*' . esc_attr($username) . '*',
                'search_columns' => array('user_login', 'user_nicename', 'display_name'),
            ));
            $users = $user_query->get_results();
            $user = !empty($users) ? $users[0] : null;
        }

        if ($user) {
            $user_group = get_user_meta($user->ID, 'user_group', true);

            // より堅牢に：IDで判定
            $is_current_user = (get_current_user_id() === (int) $user->ID);

            // ★ 追加：キャラクターHTMLを取得
            $character_html = '';
            if (function_exists('display_character_for_user')) {
                ob_start();
                display_character_for_user($user->ID);
                $character_html = ob_get_clean();
            }

            // グループ未設定でも success で返すほうがフロント実装が楽
            wp_send_json_success(array(
                'group'           => $user_group ?: '',
                'is_current_user' => $is_current_user,
                'character_html'  => $character_html, // ← 追加
            ));
        } else {
            wp_send_json_error('User not found');
        }
    } else {
        wp_send_json_error('Invalid request');
    }
}
add_action('wp_ajax_get_user_group_by_name', 'get_user_group_by_name');
add_action('wp_ajax_nopriv_get_user_group_by_name', 'get_user_group_by_name');

// メッセージにユーザーグループのクラスを追加するフィルター（元のまま）
function add_user_group_class_to_chat($text) {
    if (preg_match('/^(.*?):/', $text, $matches)) {
        $username = trim($matches[1]);
        $user = get_user_by('login', $username);
        if ($user) {
            $user_group = get_user_meta($user->ID, 'user_group', true);
            if ($user_group) {
                $text = '<span class="' . esc_attr($user_group) . '">' . $text . '</span>';
            }
        }
    }
    return $text;
}
add_filter('sac_process_chat_text', 'add_user_group_class_to_chat');

// グループクラスに基づいて最新のメッセージを取得する関数（元のまま）
function get_latest_group_messages($group_class, $limit = 2) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ajax_chat';
    $query = $wpdb->prepare(
        "SELECT * FROM $table_name 
        WHERE class LIKE %s 
        ORDER BY time DESC 
        LIMIT %d",
        '%' . $wpdb->esc_like($group_class) . '%',
        $limit
    );
    return $wpdb->get_results($query);
}

// JSの読み込みとローカライズ（元のまま／二重呼び出しに注意）
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'cooperator-script',
        get_template_directory_uri() . '/js/cooperatorScript.js',
        array('jquery'),
        null,
        true
    );

    $uid   = get_current_user_id();
    $user  = wp_get_current_user();
    $group = $uid ? get_user_meta($uid, 'user_group', true) : '';

    wp_localize_script('cooperator-script', 'userGroupData', array(
        'group'    => $group ?: '',
        'username' => $user ? $user->user_login : '',
        'ajaxurl'  => admin_url('admin-ajax.php'),
        // 'nonce' => wp_create_nonce('get_user_group_by_name'),
    ));
});
