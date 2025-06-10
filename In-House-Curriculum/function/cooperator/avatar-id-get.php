<?php

/**
 * アバター関連のメタデータを取得する関数
 * 
 * @param int $user_id ユーザーID
 * @return array アバター関連のメタデータ
 */
function get_avatar_meta_data($user_id)
{
    if (!is_numeric($user_id)) {
        return [];
    }

    try {
        // 基本メタデータの取得
        $meta_data = [
            'selected_character' => get_user_meta($user_id, 'selected_character', true),
            'selected_hat' => get_user_meta($user_id, 'selected_hat', true),
            'selected_glasses' => get_user_meta($user_id, 'selected_glasses', true),
            'selected_items' => json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [],
            'owned_characters' => json_decode(get_user_meta($user_id, 'owned_characters', true), true) ?: [],
            'owned_hats' => json_decode(get_user_meta($user_id, 'owned_hats', true), true) ?: [],
            'owned_glasses' => json_decode(get_user_meta($user_id, 'owned_glasses', true), true) ?: [],
            'owned_items' => json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: []
        ];

        // サムネイル画像の取得
        $meta_data['thumbnails'] = [
            'character' => get_avatar_thumbnail($meta_data['selected_character'], 'avatar01.png'),
            'hat' => get_avatar_thumbnail($meta_data['selected_hat']),
            'glasses' => get_avatar_thumbnail($meta_data['selected_glasses'])
        ];

        return $meta_data;
    } catch (Exception $e) {
        error_log('Avatar meta data error: ' . $e->getMessage());
        return [];
    }
}

/**
 * アバターアイテムのサムネイル画像を取得する関数
 * 
 * @param string $item_id アイテムID
 * @param string $default_image デフォルト画像名
 * @return string サムネイル画像のURL
 */
function get_avatar_thumbnail($item_id, $default_image = '')
{
    if (empty($item_id)) {
        return $default_image ? get_template_directory_uri() . '/img/avatar-img/' . $default_image : '';
    }

    $item_parts = explode('-', $item_id);
    $post_id = end($item_parts);

    $thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');
    return $thumbnail_url ?: ($default_image ? get_template_directory_uri() . '/img/avatar-img/' . $default_image : '');
}

// グローバル変数への代入
$user_id = get_current_user_id();
$avatar_meta = get_avatar_meta_data($user_id);

// 変数の展開
extract($avatar_meta);

// 選択されたキャラクターのIDを取得
$selected_character_thumbnail = get_template_directory_uri() . '/img/avatar-img/avatar01.webp'; // デフォルト画像
if (!empty($selected_character)) {
    $selected_character_parts = explode('-', $selected_character);
    $selected_character_id = end($selected_character_parts);
    $selected_character_thumbnail = get_the_post_thumbnail_url($selected_character_id, 'full') ?: $selected_character_thumbnail;
}

// 選択された帽子のIDを取得
$selected_hat_parts = explode('-', $selected_hat);
$selected_hat_id = end($selected_hat_parts);

// 選択されたメガネのIDを取得
$selected_glasses_parts = explode('-', $selected_glasses);
$selected_glasses_id = end($selected_glasses_parts);

// 選択された帽子のアイキャッチ画像を取得
$selected_hat_thumbnail = get_the_post_thumbnail_url($selected_hat_id, 'full');

// 選択されたメガネのアイキャッチ画像を取得
$selected_glasses_thumbnail = get_the_post_thumbnail_url($selected_glasses_id, 'full');
