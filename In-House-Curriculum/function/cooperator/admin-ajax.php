<?php
// 共通の保存処理関数をインクルード
include_once get_template_directory() . '/function/cooperator/common-avatar-save.php';

add_action('wp_ajax_exchange_item', 'exchange_item');
add_action('wp_ajax_nopriv_exchange_item', 'exchange_item');

function exchange_item() {
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
?>