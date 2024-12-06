<?php

function display_character()
{

    // 保存された値を取得
    $user_id = get_current_user_id();
    $selected_character = get_user_meta($user_id, 'selected_character', true);
    $selected_hat = get_user_meta($user_id, 'selected_hat', true);
    $selected_glasses = get_user_meta($user_id, 'selected_glasses', true);
    $selected_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];


    // 選択されたキャラクターのIDを取得
    $selected_character_thumbnail = get_template_directory_uri() . '/img/avatar-img/avatar01.png'; // デフォルト画像
    if (!empty($selected_character)) {
        $selected_character_parts = explode('-', $selected_character);
        $selected_character_id = end($selected_character_parts);
        $selected_character_thumbnail = get_the_post_thumbnail_url($selected_character_id, 'full') ?: $selected_character_thumbnail;
    }

    // 選択された帽子のIDを取得
    $selected_hat_thumbnail = '';
    if (!empty($selected_hat)) {
        $selected_hat_parts = explode('-', $selected_hat);
        $selected_hat_id = end($selected_hat_parts);
        $selected_hat_thumbnail = get_the_post_thumbnail_url($selected_hat_id, 'full');
    }

    // 選択されたメガネのIDを取得
    $selected_glasses_thumbnail = '';
    if (!empty($selected_glasses)) {
        $selected_glasses_parts = explode('-', $selected_glasses);
        $selected_glasses_id = end($selected_glasses_parts);
        $selected_glasses_thumbnail = get_the_post_thumbnail_url($selected_glasses_id, 'full');
    }

?>


    <div class="display__character">
        <!-- キャラクター -->
        <img class="selected_items-character-character" src="<?php echo esc_url($selected_character_thumbnail); ?>">
        <!-- 帽子 -->
        <img class="selected_items-item-hat" src="<?php echo esc_url($selected_hat_thumbnail); ?>">
        <!-- メガネ -->
        <img class="selected_items-item-glasses" src="<?php echo esc_url($selected_glasses_thumbnail); ?>">
    </div>

<?php
}
?>