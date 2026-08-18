<?php

$continuous_days = 10; // 連続ログイン（この倍数でボーナスメール）
$after_day = 3;        // 復活後連続ログイン
$comeback_threshold_days = 30; // これ以上ログインが空くと「復活」扱い（日数）

/**
 * ログインポイント付与のメイン処理（暦日ベース）
 * wp_login と init（ログイン中）の両方から呼ばれるが、
 * 同日ガードにより1日1回しか実行されない。
 */
function process_login_points($user_id)
{
    global $continuous_days, $after_day, $comeback_threshold_days;

    if (!$user_id) {
        return;
    }

    $points_to_add = 5;   // 通常ログインポイント
    $bonus_points  = 50;  // 復活ボーナスのポイント
    $bonus_coins   = 30;  // 復活後連続ログインのコイン

    $today = current_time('Y-m-d');
    $last_date = get_user_meta($user_id, 'last_point_date', true); // 'Y-m-d' を想定

    // すでに今日付与済みなら何もしない（同日再ログイン）
    if ($last_date === $today) {
        return;
    }

    // --- 連続ログイン日数の計算（暦日ベース） ---
    $consecutive_login_days = (int) (get_user_meta($user_id, 'consecutive_login_days', true) ?: 0);
    $comeback_login_days    = (int) (get_user_meta($user_id, 'comeback_login_days', true) ?: 0);

    $new_points = (int) (get_user_meta($user_id, 'user_point', true) ?: 0);
    $new_points += $points_to_add;

    $is_comeback = false;

    if (!$last_date) {
        // 初回ログイン
        $consecutive_login_days = 1;
        $comeback_login_days    = 1;
    } else {
        // 前回ログイン日から今日までの経過日数を暦日で計算
        $last_ts  = strtotime($last_date);
        $today_ts = strtotime($today);
        $diff_days = (int) floor(($today_ts - $last_ts) / DAY_IN_SECONDS);

        if ($diff_days >= $comeback_threshold_days) {
            // 復活ボーナス
            $new_points += $bonus_points;
            $consecutive_login_days = 1;
            $comeback_login_days    = 1;
            update_user_meta($user_id, 'bonus_coins_given', false);
            $is_comeback = true;
        } elseif ($diff_days === 1) {
            // 昨日ログイン → 継続
            $consecutive_login_days++;
            $comeback_login_days++;
        } else {
            // 2日以上空いた（＝連続が途切れた）→ リセット
            $consecutive_login_days = 1;
            $comeback_login_days    = 1;
        }
    }

    // --- 連続ログインボーナス（メール通知＋達成回数カウント） ---
    if ($consecutive_login_days % $continuous_days == 0) {
        $user = get_user_by('id', $user_id);
        if ($user) {
            $subject = '連続ログインおめでとうございます！';
            $message = $consecutive_login_days . '日連続でログインしていただきありがとうございます。特別ボーナスを付与しました。';
            wp_mail($user->user_email, $subject, $message);
        }
        $cnt = (int) (get_user_meta($user_id, 'login_continuous_10days_count', true) ?: 0);
        update_user_meta($user_id, 'login_continuous_10days_count', $cnt + 1);
    }

    // --- 復活後連続ログインのコインボーナス ---
    $bonus_coins_given = get_user_meta($user_id, 'bonus_coins_given', true);
    if ($comeback_login_days == $after_day && !$bonus_coins_given) {
        add_user_coins($user_id, $bonus_coins);
        update_user_meta($user_id, 'bonus_coins_given', true);
        $cb = (int) (get_user_meta($user_id, 'comeback_login_count', true) ?: 0);
        update_user_meta($user_id, 'comeback_login_count', $cb + 1);
    }

    // --- ログイン履歴に今日を追記（log_board のカレンダー用） ---
    $login_history = get_user_meta($user_id, 'login_history', true);
    if (!is_array($login_history)) {
        $login_history = [];
    }
    // 同月管理のため Y-m-d で保存。重複は入らない（同日ガード済みだが念のため）
    if (!in_array($today, $login_history, true)) {
        $login_history[] = $today;
    }
    update_user_meta($user_id, 'login_history', $login_history);

    // --- 保存 ---
    update_user_meta($user_id, 'consecutive_login_days', $consecutive_login_days);
    update_user_meta($user_id, 'comeback_login_days', $comeback_login_days);
    update_user_meta($user_id, 'user_point', $new_points);
    update_user_meta($user_id, 'last_point_date', $today); // 'Y-m-d' で保存
}

// wp_login フック（標準ログイン用）
function add_login_points($user_login, $user)
{
    process_login_points($user->ID);
}
add_action('wp_login', 'add_login_points', 10, 2);

// init フック（ログイン中なら毎リクエストで確認、同日ガードで1日1回のみ実行）
// → SWPM ログインで wp_login が発火しないケースでも確実に付与される
function process_login_points_on_init()
{
    if (is_user_logged_in()) {
        process_login_points(get_current_user_id());
    }
}
add_action('init', 'process_login_points_on_init');