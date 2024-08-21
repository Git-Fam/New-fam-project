<?php
// ログインしているユーザーのグループを取得する関数
function get_current_user_group() {
    $user_id = get_current_user_id();
    return $user_id ? get_user_meta($user_id, 'user_group', true) : null;
}

// グループ名をJavaScriptに渡すためのスクリプトをエンキューする
function enqueue_user_group_script() {
    $user_group = get_current_user_group();
    $current_user = wp_get_current_user();
    $username = $current_user->exists() ? $current_user->user_login : '';

    wp_enqueue_script('cooperator-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
    
    wp_localize_script('cooperator-script', 'userGroupData', array(
        'group' => $user_group,
        'username' => $username,
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_user_group_script');

// チャットシステムでログインユーザー名を自動設定するフィルター
function sac_set_logged_in_username($username) {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        return $current_user->user_login; // または $current_user->display_name;
    }
    return $username;
}
add_filter('sac_user_name', 'sac_set_logged_in_username');

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
            $user_group ? wp_send_json_success(array('group' => $user_group)) : wp_send_json_error('User group not found');
        } else {
            wp_send_json_error('User not found');
        }
    } else {
        wp_send_json_error('Invalid request');
    }
}
add_action('wp_ajax_get_user_group_by_name', 'get_user_group_by_name');
add_action('wp_ajax_nopriv_get_user_group_by_name', 'get_user_group_by_name');

// メッセージにユーザーグループのクラスを追加するフィルター
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

// グループクラスに基づいて最新のメッセージを取得する関数
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
