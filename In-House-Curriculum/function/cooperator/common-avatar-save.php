<?php
function save_user_item($user_id, $key, $value) {
    if (strpos($key, 'selected_items-character-character') === 0) {
        $selected_character = sanitize_text_field($value);
        update_user_meta($user_id, 'selected_character', $selected_character);
        $existing_owned_characters = json_decode(get_user_meta($user_id, 'owned_characters', true), true) ?: [];
        if (!in_array($selected_character, $existing_owned_characters)) {
            $existing_owned_characters[] = $selected_character;
        }
        update_user_meta($user_id, 'owned_characters', json_encode($existing_owned_characters));
    }

    if (strpos($key, 'selected_items-item-hat') === 0) {
        $selected_hat = sanitize_text_field($value);
        update_user_meta($user_id, 'selected_hat', $selected_hat);
        $existing_owned_hats = json_decode(get_user_meta($user_id, 'owned_hats', true), true) ?: [];
        if (!in_array($selected_hat, $existing_owned_hats)) {
            $existing_owned_hats[] = $selected_hat;
        }
        update_user_meta($user_id, 'owned_hats', json_encode($existing_owned_hats));
    }

    if (strpos($key, 'selected_items-item-glasses') === 0) {
        $selected_glasses = sanitize_text_field($value);
        update_user_meta($user_id, 'selected_glasses', $selected_glasses);
        $existing_owned_glasses = json_decode(get_user_meta($user_id, 'owned_glasses', true), true) ?: [];
        if (!in_array($selected_glasses, $existing_owned_glasses)) {
            $existing_owned_glasses[] = $selected_glasses;
        }
        update_user_meta($user_id, 'owned_glasses', json_encode($existing_owned_glasses));
    }
}
?>