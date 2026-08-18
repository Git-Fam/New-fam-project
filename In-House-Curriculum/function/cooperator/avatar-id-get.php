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
            'selected_items' => json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [],
            'owned_avatars' => json_decode(get_user_meta($user_id, 'owned_avatars', true), true) ?: [],
            'owned_items' => json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: []
        ];

        // 選択中のアバターを取得（カテゴリー別）
        $avatar_categories = get_terms(array(
            'taxonomy' => 'avatar-cat',
            'hide_empty' => false,
        ));

        if (is_array($avatar_categories) && !empty($avatar_categories)) {
            foreach ($avatar_categories as $category) {
                // $categoryがオブジェクトか配列かを判定
                $category_slug = '';
                if (is_object($category) && isset($category->slug)) {
                    $category_slug = $category->slug;
                } elseif (is_array($category) && isset($category['slug'])) {
                    $category_slug = $category['slug'];
                } else {
                    continue; // スラッグが取得できない場合はスキップ
                }

                $selected_avatar = get_user_meta($user_id, 'selected_avatar_' . $category_slug, true);
                if ($selected_avatar) {
                    // アバターはselected_itemsには保存しない（アイテム専用）
                    // $meta_data['selected_items'][$category_slug] = $selected_avatar;
                }
            }
        }

        // デフォルト値の設定
        // normal-7547をデフォルトで所持
        if (empty($meta_data['owned_avatars'])) {
            $meta_data['owned_avatars'] = ['normal-7547'];
        } else if (!in_array('normal-7547', $meta_data['owned_avatars'])) {
            $meta_data['owned_avatars'][] = 'normal-7547';
        }

        // normal-7547をデフォルトで選択（normalカテゴリー）
        if (empty($meta_data['selected_items']['normal'])) {
            $meta_data['selected_items']['normal'] = 'normal-7547';
        }

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

// 選択されたアイテムの配列を取得（archive-avatar.phpで使用）
$selected_items = $selected_items ?: [];

// 所持アイテムの配列を取得（archive-avatar.phpで使用）
$owned_avatars = $owned_avatars ?: ['normal-7547'];
$owned_items = $owned_items ?: [];

// 選択されたキャラクターのIDを取得
$selected_character = get_user_meta($user_id, 'selected_avatar_normal', true) ?: 'normal-7547';

// 選択されたアイテムの配列を取得（archive-avatar.phpで使用）
$selected_items_array = [];
if (!empty($selected_items)) {
    foreach ($selected_items as $category => $tags) {
        if (is_array($tags)) {
            foreach ($tags as $tag => $item) {
                $selected_items_array[] = $item;
            }
        }
    }
}

// 所持アイテムの配列を取得（archive-avatar.phpで使用）
$owned_characters = $owned_avatars ?: ['normal-7547'];
$owned_hats = [];
$owned_glasses = [];

// 選択されたキャラクターのIDを取得
// $selected_character_thumbnail = get_template_directory_uri() . '/img/avatar-img/avatar01.webp'; // デフォルト画像
if (!empty($selected_character)) {
    $selected_character_parts = explode('-', $selected_character);
    $selected_character_id = end($selected_character_parts);
    $selected_character_thumbnail = get_the_post_thumbnail_url($selected_character_id, 'full') ?: $selected_character_thumbnail;
}

// 選択された帽子のIDを取得
$selected_hat_parts = explode('-', $selected_items['hat'] ?? '');
$selected_hat_id = end($selected_hat_parts);

// 選択されたメガネのIDを取得
$selected_glasses_parts = explode('-', $selected_items['glasses'] ?? '');
$selected_glasses_id = end($selected_glasses_parts);

// 選択された帽子のアイキャッチ画像を取得
$selected_hat_thumbnail = get_the_post_thumbnail_url($selected_hat_id, 'full');

// 選択されたメガネのアイキャッチ画像を取得
$selected_glasses_thumbnail = get_the_post_thumbnail_url($selected_glasses_id, 'full');
