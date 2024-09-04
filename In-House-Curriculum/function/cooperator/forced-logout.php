<?php
// ---強制ログアウトロジック

// ユーザーがログインするたびに最終ログイン日を保存する
function update_last_login_date($user_login, $user)
{
    $user_id = $user->ID;
    $current_date = current_time('Y-m-d');
    update_user_meta($user_id, 'last_login_date', $current_date);
}
add_action('wp_login', 'update_last_login_date', 10, 2);

// 日付が変わったら強制ログアウトする
function force_logout_if_date_changed()
{
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $last_login_date = get_user_meta($user_id, 'last_login_date', true);
        $current_date = current_time('Y-m-d');

        if ($last_login_date && $last_login_date !== $current_date) {
            // 日付が変わっていたら強制ログアウト
            wp_logout();
            wp_redirect(home_url('/login')); // ログアウト後にリダイレクトするURL
            exit;
        }
    }
}
add_action('init', 'force_logout_if_date_changed');
