<?php
// ---キャラクターとアイテムの保存

add_action('show_user_profile', 'show_user_avatar_items_field');
add_action('edit_user_profile', 'show_user_avatar_items_field');

function show_user_avatar_items_field($user)
{
?>
    <h3>ユーザーのキャラクターとアイテム</h3>
    <table class="form-table">

        <!-- キャラクター -->
        <tr>
            <th><label for="selected_items-character-character">選択されたキャラクター</label></th>
            <td>
                <textarea name="selected_items-character-character" id="selected_items-character-character" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'selected_character', true)); ?></textarea>
                <p class="description">このユーザーが選択したキャラクターのデータ</p>
            </td>
        </tr>
        <tr>
            <th><label for="owned_characters">持っているキャラクター</label></th>
            <td>
                <textarea name="owned_characters" id="owned_characters" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'owned_characters', true)); ?></textarea>
                <p class="description">このユーザーが持っているキャラクターのデータ</p>
            </td>
        </tr>

        <!-- 帽子 -->
        <tr>
            <th><label for="selected_items-hat-hat">選択された帽子</label></th>
            <td>
                <textarea name="selected_items-hat-hat" id="selected_items-hat-hat" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'selected_hat', true)); ?></textarea>
                <p class="description">このユーザーが選択した帽子のデータ</p>
            </td>
        </tr>
        <tr>
            <th><label for="owned_hats">持っている帽子</label></th>
            <td>
                <textarea name="owned_hats" id="owned_hats" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'owned_hats', true)); ?></textarea>
                <p class="description">このユーザーが持っている帽子のデータ</p>
            </td>
        </tr>

        <!-- メガネ -->
        <tr>
            <th><label for="selected_items-glasses-glasses">選択されたメガネ</label></th>
            <td>
                <textarea name="selected_items-glasses-glasses" id="selected_items-glasses-glasses" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'selected_glasses', true)); ?></textarea>
                <p class="description">このユーザーが選択したメガネのデータ</p>
            </td>
        </tr>
        <tr>
            <th><label for="owned_glasses">持っているメガネ</label></th>
            <td>
                <textarea name="owned_glasses" id="owned_glasses" class="regular-text"><?php echo esc_textarea(get_user_meta($user->ID, 'owned_glasses', true)); ?></textarea>
                <p class="description">このユーザーが持っているメガネのデータ</p>
            </td>
        </tr>

    </table>
<?php
}

function save_user_avatar_items_field($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    // 選択されたキャラクターを保存
    if (isset($_POST['selected_items-character-character'])) {
        $selected_character = sanitize_textarea_field($_POST['selected_items-character-character']);
        update_user_meta($user_id, 'selected_character', $selected_character);
    }
    // 持っているキャラクターを蓄積保存
    if (isset($_POST['owned_characters'])) {
        $new_owned_character = sanitize_textarea_field($_POST['owned_characters']);
        $existing_owned_characters = get_user_meta($user_id, 'owned_characters', true);
        if ($existing_owned_characters) {
            $existing_owned_characters = json_decode($existing_owned_characters, true);
        } else {
            $existing_owned_characters = [];
        }
        if (!is_array($existing_owned_characters)) {
            $existing_owned_characters = [];
        }
        if (!in_array($new_owned_character, $existing_owned_characters)) {
            $existing_owned_characters[] = $new_owned_character;
        }
        update_user_meta($user_id, 'owned_characters', json_encode($existing_owned_characters));
    }
    // 選択されたアイテムを保存
    if (isset($_POST['user_selected_items'])) {
        $new_items = json_decode(sanitize_textarea_field($_POST['user_selected_items']), true);
        $existing_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];

        // 同じタグのアイテムを上書き、違うタグのアイテムを追加
        foreach ($new_items as $category => $tags) {
            if (!isset($existing_items[$category])) {
                $existing_items[$category] = [];
            }
            foreach ($tags as $tag => $items) {
                $existing_items[$category][$tag] = $items;
            }
        }

        update_user_meta($user_id, 'selected_items', json_encode($existing_items));
    }
    // 持っているアイテムを蓄積保存
    if (isset($_POST['owned_items'])) {
        $new_owned_item = sanitize_textarea_field($_POST['owned_items']);
        $existing_owned_items = get_user_meta($user_id, 'owned_items', true);
        if ($existing_owned_items) {
            $existing_owned_items = json_decode($existing_owned_items, true);
        } else {
            $existing_owned_items = [];
        }
        if (!is_array($existing_owned_items)) {
            $existing_owned_items = [];
        }
        if (!in_array($new_owned_item, $existing_owned_items)) {
            $existing_owned_items[] = $new_owned_item;
        }
        update_user_meta($user_id, 'owned_items', json_encode($existing_owned_items));
    }
}
add_action('personal_options_update', 'save_user_avatar_items_field');
add_action('edit_user_profile_update', 'save_user_avatar_items_field');
?>