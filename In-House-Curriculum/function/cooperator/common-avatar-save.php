<?php

/**
 * アバターアイテムの保存処理を行う関数
 * 
 * @param int $user_id ユーザーID
 * @param string $key 保存するキー
 * @param string $value 保存する値
 * @return bool 保存が成功したかどうか
 */
function save_user_item($user_id, $key, $value)
{
    if (!is_numeric($user_id) || empty($key) || empty($value)) {
        return false;
    }

    // アイテムタイプの定義
    $item_types = [
        'selected_items-character-character' => [
            'meta_key' => 'selected_character',
            'owned_key' => 'owned_characters'
        ],
        'selected_items-item-hat' => [
            'meta_key' => 'selected_hat',
            'owned_key' => 'owned_hats'
        ],
        'selected_items-item-glasses' => [
            'meta_key' => 'selected_glasses',
            'owned_key' => 'owned_glasses'
        ]
    ];

    // アイテムタイプの判定
    $item_type = null;
    foreach ($item_types as $prefix => $config) {
        if (strpos($key, $prefix) === 0) {
            $item_type = $config;
            break;
        }
    }

    if (!$item_type) {
        return false;
    }

    try {
        // 値のサニタイズ
        $sanitized_value = sanitize_text_field($value);

        // 選択アイテムの保存
        update_user_meta($user_id, $item_type['meta_key'], $sanitized_value);

        // 所持アイテムの更新
        $existing_owned_items = json_decode(get_user_meta($user_id, $item_type['owned_key'], true), true) ?: [];
        if (!in_array($sanitized_value, $existing_owned_items)) {
            $existing_owned_items[] = $sanitized_value;
            update_user_meta($user_id, $item_type['owned_key'], json_encode($existing_owned_items));
        }

        return true;
    } catch (Exception $e) {
        error_log('Avatar save error: ' . $e->getMessage());
        return false;
    }
}
