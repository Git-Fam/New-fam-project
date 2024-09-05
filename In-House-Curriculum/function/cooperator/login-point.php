<?php

// ユーザーがログインするたびにポイントを付与する
function add_login_points($user_login, $user)
{
    $user_id = $user->ID;
    $points_to_add = 5; // 通常ログインポイント
    $bonus_points = 10; // 復活ボーナスのポイント
    $bonus_coins = 10; // 3日連続ログインのコイン
    $normal_day = DAY_IN_SECONDS; // 1日
    $normal_month = 30 * DAY_IN_SECONDS; // 1ヶ月
    $continuous_days = 10; // 10日
    $after_day = 3; // 3日

    // $normal_day = 20; //テスト
    // $normal_month = 30 * DAY_IN_SECONDS; //テスト
    // $continuous_days = 10; //テスト 
    // $after_day = 3; //テスト 

    // 最後にポイントが付与された日付を取得
    $last_point_date = get_user_meta($user_id, 'last_point_date', true);

    // 現在の日付を取得
    $current_date = current_time('Y-m-d');

    // 1日経過しているか確認
    if (!$last_point_date || (strtotime($current_date) - strtotime($last_point_date)) >= $normal_day) {
        // 現在のポイントを取得
        $current_points = get_user_meta($user_id, 'user_point', true) ?: 0;

        // 新しいポイント数を計算
        $new_points = $current_points + $points_to_add;

        // 連続ログイン日数を取得
        $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true) ?: 0;

        // 1ヶ月（30日）経過しているか確認してボーナスポイントを追加
        if ($last_point_date && (strtotime($current_date) - strtotime($last_point_date)) >= $normal_month) {
            $new_points += $bonus_points;

            // 連続ログイン日数をリセット
            $consecutive_login_days = 1;
            update_user_meta($user_id, 'bonus_coins_given', false); // ボーナスコイン付与フラグをリセット
        } else {
            // 連続ログイン日数を更新
            $consecutive_login_days++;
        }

        // 10回連続ログイン
        if ($consecutive_login_days == $continuous_days) {
            $user_email = $user->user_email;
            $subject = '10回連続ログインおめでとうございます！';
            $message = '10回連続でログインしていただきありがとうございます。これからもよろしくお願いします。';
            wp_mail($user_email, $subject, $message);
        }

        // 1ヶ月ぶりにログインしてから3回連続ログインを確認してボーナスコインを追加
        $bonus_coins_given = get_user_meta($user_id, 'bonus_coins_given', true);
        if ($consecutive_login_days == $after_day && !$bonus_coins_given) {
            add_user_coins($user_id, $bonus_coins);
            // ボーナスコイン付与フラグを設定
            update_user_meta($user_id, 'bonus_coins_given', true);
        }

        // 連続ログイン日数を保存
        update_user_meta($user_id, 'consecutive_login_days', $consecutive_login_days);

        // 新しいポイント数を保存
        update_user_meta($user_id, 'user_point', $new_points);

        // 最後にポイントが付与された日付を更新
        update_user_meta($user_id, 'last_point_date', $current_date);
    }
}
add_action('wp_login', 'add_login_points', 10, 2);
