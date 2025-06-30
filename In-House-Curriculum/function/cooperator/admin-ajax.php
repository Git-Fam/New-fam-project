<?php
// 共通の保存処理関数をインクルード
include_once get_template_directory() . '/function/cooperator/common-avatar-save.php';

add_action('wp_ajax_exchange_item', 'exchange_item');
add_action('wp_ajax_nopriv_exchange_item', 'exchange_item');

function exchange_item()
{
    // ユーザーがログインしているか確認
    if (!is_user_logged_in()) {
        wp_send_json_error('ログインが必要です。');
    }

    // リクエストデータを取得
    $user_id = intval($_POST['user_id']);
    $payment_type = sanitize_text_field($_POST['payment_type']);
    $cost = intval($_POST['cost']);
    $selected_item = sanitize_text_field($_POST['selected_item']);

    // ユーザーの現在のコインまたはポイントを取得
    if ($payment_type === 'coin') {
        $current_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
        if ($current_coins < $cost) {
            wp_send_json_error('コインが不足しています。');
        }
        $new_coins = $current_coins - $cost;
        update_user_meta($user_id, 'user_coins', $new_coins);
    } elseif ($payment_type === 'point') {
        $current_points = get_user_meta($user_id, 'user_point', true) ?: 0;
        if ($current_points < $cost) {
            wp_send_json_error('ポイントが不足しています。');
        }
        $new_points = $current_points - $cost;
        update_user_meta($user_id, 'user_point', $new_points);
    } else {
        wp_send_json_error('無効な支払いタイプです。');
    }

    // 選択されたアイテムを保存
    save_user_item($user_id, 'selected_items-' . $selected_item, $selected_item);

    wp_send_json_success();
}

// チケット・コイン・ポイント管理用のAJAXハンドラー

// チケット付与
add_action('wp_ajax_add_tickets', 'handle_add_tickets');
function handle_add_tickets()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_tickets = intval(get_user_meta($user_id, 'priority_ticket', true) ?: 0);
        $new_tickets = $current_tickets + $amount;
        if (update_user_meta($user_id, 'priority_ticket', $new_tickets)) {
            $success_count++;
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーにチケットを付与しました');
    } else {
        wp_send_json_error('チケットの付与に失敗しました');
    }
}

// チケット消費
add_action('wp_ajax_consume_tickets', 'handle_consume_tickets');
function handle_consume_tickets()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_tickets = intval(get_user_meta($user_id, 'priority_ticket', true) ?: 0);
        if ($current_tickets >= $amount) {
            $new_tickets = $current_tickets - $amount;
            if (update_user_meta($user_id, 'priority_ticket', $new_tickets)) {
                $success_count++;
            }
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーからチケットを消費しました');
    } else {
        wp_send_json_error('チケットの消費に失敗しました');
    }
}

// コイン付与
add_action('wp_ajax_add_coins', 'handle_add_coins');
function handle_add_coins()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_coins = intval(get_user_meta($user_id, 'user_coins', true) ?: 0);
        $new_coins = $current_coins + $amount;
        if (update_user_meta($user_id, 'user_coins', $new_coins)) {
            $success_count++;
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーにコインを付与しました');
    } else {
        wp_send_json_error('コインの付与に失敗しました');
    }
}

// コイン消費
add_action('wp_ajax_consume_coins', 'handle_consume_coins');
function handle_consume_coins()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_coins = intval(get_user_meta($user_id, 'user_coins', true) ?: 0);
        if ($current_coins >= $amount) {
            $new_coins = $current_coins - $amount;
            if (update_user_meta($user_id, 'user_coins', $new_coins)) {
                $success_count++;
            }
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーからコインを消費しました');
    } else {
        wp_send_json_error('コインの消費に失敗しました');
    }
}

// ポイント付与
add_action('wp_ajax_add_points', 'handle_add_points');
function handle_add_points()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_points = intval(get_user_meta($user_id, 'user_point', true) ?: 0);
        $new_points = $current_points + $amount;
        if (update_user_meta($user_id, 'user_point', $new_points)) {
            $success_count++;
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーにポイントを付与しました');
    } else {
        wp_send_json_error('ポイントの付与に失敗しました');
    }
}

// ポイント消費
add_action('wp_ajax_consume_points', 'handle_consume_points');
function handle_consume_points()
{
    // 一時的に権限チェックをコメントアウト（テスト用）
    // if (!current_user_can('manage_options')) {
    //     wp_die('権限がありません');
    // }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    $amount = intval($_POST['amount']);

    if (empty($user_ids) || $amount <= 0) {
        wp_send_json_error('無効なパラメータです');
    }

    $success_count = 0;
    foreach ($user_ids as $user_id) {
        $current_points = intval(get_user_meta($user_id, 'user_point', true) ?: 0);
        if ($current_points >= $amount) {
            $new_points = $current_points - $amount;
            if (update_user_meta($user_id, 'user_point', $new_points)) {
                $success_count++;
            }
        }
    }

    if ($success_count > 0) {
        wp_send_json_success($success_count . '人のユーザーからポイントを消費しました');
    } else {
        wp_send_json_error('ポイントの消費に失敗しました');
    }
}
