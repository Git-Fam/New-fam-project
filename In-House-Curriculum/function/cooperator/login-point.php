<?php

// $normal_day = DAY_IN_SECONDS; // 1日
// $normal_month = MONTH_IN_SECONDS; // 1ヶ月
// $continuous_days = 10; // 連続ログイン
// $after_day = 3; // 復活後連続ログイン

// テスト
$normal_day = 10; // 日にちテスト
$normal_month = 30; // 復活テスト
$continuous_days = 5; // 連続ログインテスト
$after_day = 3; // 復活後連続ログイン

// ユーザーがログインするたびにポイントを付与する
function add_login_points($user_login, $user)
{
    global $normal_day, $normal_month, $continuous_days, $after_day;

    $user_id = $user->ID;
    $points_to_add = 5; // 通常ログインポイント
    $bonus_points = 50; // 復活ボーナスのポイント
    $bonus_coins = 30; // 復活後連続ログインのコイン

    // 最後にポイントが付与された日付を取得
    $last_point_date = get_user_meta($user_id, 'last_point_date', true);

    // 現在のタイムスタンプを取得
    $current_timestamp = current_time('timestamp');

    // 1日経過しているか確認
    if (!$last_point_date || ($current_timestamp - $last_point_date) >= $normal_day) {
        // 現在のポイントを取得
        $current_points = get_user_meta($user_id, 'user_point', true) ?: 0;

        // 新しいポイント数を計算
        $new_points = $current_points + $points_to_add;

        // 連続ログイン日数を取得
        $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true) ?: 0;

        // 復活後連続ログイン日数を取得
        $comeback_login_days = get_user_meta($user_id, 'comeback_login_days', true) ?: 0;

        // 1ヶ月経過しているか確認して復活ボーナスポイントを追加
        if ($last_point_date && ($current_timestamp - $last_point_date) >= $normal_month) {
            $new_points += $bonus_points;

            // 連続ログイン日数をリセット
            $consecutive_login_days = 1;
            $comeback_login_days = 1; // 復活後連続ログイン日数をリセット
            update_user_meta($user_id, 'bonus_coins_given', false); // ボーナスコイン付与フラグをリセット
        } else {
            // 1日以上経過している場合、連続ログイン日数をリセットして1からスタート
            if ($last_point_date && ($current_timestamp - $last_point_date) >= $normal_day * 2) {
                $consecutive_login_days = 1;
                $comeback_login_days = 1; // 復活後連続ログイン日数をリセット
            } else {
                // 連続ログイン日数を更新
                $consecutive_login_days++;
                $comeback_login_days++; // 復活後連続ログイン日数を更新
            }
        }

        // 連続ログイン日数が $continuous_days の倍数であるか確認
        if ($consecutive_login_days % $continuous_days == 0) {
            $user_email = $user->user_email;
            $subject = '連続ログインおめでとうございます！';
            $message = $consecutive_login_days . '日連続でログインしていただきありがとうございます。特別ボーナスを付与しました。';
            wp_mail($user_email, $subject, $message);

            // 連続ログイン達成回数を更新
            $login_continuous_10days_count = get_user_meta($user_id, 'login_continuous_10days_count', true) ?: 0;
            $login_continuous_10days_count++;
            update_user_meta($user_id, 'login_continuous_10days_count', $login_continuous_10days_count);
        }

        // 復活後連続ログインを確認してボーナスコインを追加
        $bonus_coins_given = get_user_meta($user_id, 'bonus_coins_given', true);
        if ($comeback_login_days == $after_day && !$bonus_coins_given) {
            add_user_coins($user_id, $bonus_coins);
            // ボーナスコイン付与フラグを設定
            update_user_meta($user_id, 'bonus_coins_given', true);

            // 復活後連続ログイン達成回数を更新
            $comeback_login_count = get_user_meta($user_id, 'comeback_login_count', true) ?: 0;
            $comeback_login_count++;
            update_user_meta($user_id, 'comeback_login_count', $comeback_login_count);
        }

        // 連続ログイン日数を保存
        update_user_meta($user_id, 'consecutive_login_days', $consecutive_login_days);

        // 復活後連続ログイン日数を保存
        update_user_meta($user_id, 'comeback_login_days', $comeback_login_days);

        // 新しいポイント数を保存
        update_user_meta($user_id, 'user_point', $new_points);

        // 最後にポイントが付与されたタイムスタンプを更新
        update_user_meta($user_id, 'last_point_date', $current_timestamp);
    } else {
        // なにもしない
    }
}
add_action('wp_login', 'add_login_points', 10, 2);
