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

    try {
        // 値のサニタイズ
        $sanitized_value = sanitize_text_field($value);
        $category = str_replace('selected_items-', '', $key);

        // アバターかアイテムかを判定
        if (is_avatar_category($category)) {
            // アバターの処理
            return save_avatar_selection($user_id, $category, $sanitized_value);
        } else {
            // アイテムの処理
            return save_item_selection($user_id, $category, $sanitized_value);
        }
    } catch (Exception $e) {
        error_log('Avatar save error: ' . $e->getMessage());
        return false;
    }
}

/**
 * アバターカテゴリーかどうかを判定
 */
function is_avatar_category($category)
{
    $avatar_categories = get_terms(array(
        'taxonomy' => 'avatar-cat',
        'hide_empty' => false,
        'fields' => 'slugs'
    ));
    if (!is_array($avatar_categories)) {
        $avatar_categories = [];
    }
    error_log('判定するカテゴリー: ' . $category);
    error_log('アバターカテゴリー一覧: ' . print_r($avatar_categories, true));
    return in_array($category, $avatar_categories);
}

/**
 * アバター選択の保存
 */
function save_avatar_selection($user_id, $category, $value)
{
    // 選択中のアバターを「1つだけ」保存
    update_user_meta($user_id, 'selected_avatar', $value);

    // 所持アバター一覧に追加
    $owned_avatars = json_decode(get_user_meta($user_id, 'owned_avatars', true), true) ?: [];
    if (!in_array($value, $owned_avatars)) {
        $owned_avatars[] = $value;
        update_user_meta($user_id, 'owned_avatars', json_encode($owned_avatars));
    }

    return true;
}

/**
 * アイテム選択の保存
 */
function save_item_selection($user_id, $category, $value)
{
    // アバターID形式（例: normal-xxxx）は保存しない
    if (preg_match('/^normal-\\d+$/', $value)) {
        return false;
    }
    // 選択中のアイテムを保存（カテゴリー別）
    $selected_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];
    $selected_items[$category] = $value;
    update_user_meta($user_id, 'selected_items', json_encode($selected_items));

    // 所持アイテム一覧に追加（カテゴリー別）
    $owned_items = json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: [];
    if (!isset($owned_items[$category])) {
        $owned_items[$category] = [];
    }
    if (!in_array($value, $owned_items[$category])) {
        $owned_items[$category][] = $value;
        update_user_meta($user_id, 'owned_items', json_encode($owned_items));
    }

    return true;
}

/**
 * 購入処理後の所持アイテム追加
 */
function add_purchased_item($user_id, $item_type, $item_value)
{
    error_log('--- add_purchased_item called ---');
    error_log('user_id: ' . $user_id);
    error_log('item_type: ' . $item_type);
    error_log('item_value: ' . $item_value);

    // $item_valueが「normal-xxxx」や「limited-xxxx」などの場合
    $parts = explode('-', $item_value);
    $category = $parts[0];
    error_log('category: ' . $category);

    // アバターカテゴリーなら必ずowned_avatarsに追加
    if (is_avatar_category($category)) {
        error_log('is_avatar_category: TRUE');
        $owned_avatars = json_decode(get_user_meta($user_id, 'owned_avatars', true), true) ?: [];
        if (!in_array($item_value, $owned_avatars)) {
            $owned_avatars[] = $item_value;
            update_user_meta($user_id, 'owned_avatars', json_encode($owned_avatars));
            error_log('added to owned_avatars: ' . print_r($owned_avatars, true));
        } else {
            error_log('already owned: ' . $item_value);
        }
        return true;
    } else {
        error_log('is_avatar_category: FALSE');
    }

    // それ以外はアイテムとして保存
    $owned_items = json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: [];
    if (!isset($owned_items[$category])) {
        $owned_items[$category] = [];
    }
    if (!in_array($item_value, $owned_items[$category])) {
        $owned_items[$category][] = $item_value;
        update_user_meta($user_id, 'owned_items', json_encode($owned_items));
        error_log('added to owned_items: ' . print_r($owned_items, true));
    } else {
        error_log('already owned item: ' . $item_value);
    }
    return true;
}
