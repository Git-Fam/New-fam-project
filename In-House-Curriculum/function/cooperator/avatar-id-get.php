<?php
// 保存された値を取得
$user_id = get_current_user_id();
$selected_character = get_user_meta($user_id, 'selected_character', true);
$selected_hat = get_user_meta($user_id, 'selected_hat', true);
$selected_glasses = get_user_meta($user_id, 'selected_glasses', true);
$selected_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];
// キャラクター
$owned_characters = json_decode(get_user_meta($user_id, 'owned_characters', true), true) ?: [];
// 帽子
$owned_hats = json_decode(get_user_meta($user_id, 'owned_hats', true), true) ?: [];
// メガネ
$owned_glasses = json_decode(get_user_meta($user_id, 'owned_glasses', true), true) ?: [];
$owned_items = json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: [];

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
