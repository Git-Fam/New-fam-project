<?php

// ログイン日数を記録する
function record_user_login_date() {
    // ユーザーがログインしているかを確認
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $today = date('Y-m-d');
        $login_dates = get_user_meta($current_user->ID, 'login_dates', true);

        if (!is_array($login_dates)) {
            $login_dates = [];
        }

        // 今日のログインが記録されていない場合に追加
        if (!in_array($today, $login_dates)) {
            $login_dates[] = $today;
            update_user_meta($current_user->ID, 'login_dates', $login_dates);
        }
    }
}

// WordPressの初期化後に実行
add_action('wp', 'record_user_login_date');
