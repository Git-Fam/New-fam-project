<?php
// ---強制ログアウトロジック

global $normal_day; // グローバル変数を参照

// ユーザーがログインするたびに最終ログイン日を保存する
function update_last_login_date($user_login, $user)
{
    $user_id = $user->ID;
    $current_timestamp = current_time('timestamp');
    update_user_meta($user_id, 'last_login_timestamp', $current_timestamp);
}
add_action('wp_login', 'update_last_login_date', 10, 2);

// 日付が変わったら強制ログアウトする
function force_logout_if_date_changed()
{
    global $normal_day; // グローバル変数を参照

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $last_login_timestamp = get_user_meta($user_id, 'last_login_timestamp', true);
        $current_timestamp = current_time('timestamp');

        if ($last_login_timestamp && ($current_timestamp - $last_login_timestamp) >= $normal_day) {
            // 20秒経過していたら強制ログアウト
            wp_logout();
            wp_redirect(home_url('/login')); // ログアウト後にリダイレクトするURL
            exit;
        }
    }
}
add_action('init', 'force_logout_if_date_changed');
