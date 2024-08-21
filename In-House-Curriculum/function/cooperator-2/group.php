<?php

// ユーザープロフィールにカスタムフィールドを追加
function add_user_group_field($user) {
    ?>
    <h3>ユーザーグループ設定</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_group">グループ</label></th>
            <td>
                <select name="user_group" id="user_group">
                    <option value="group_a" <?php selected('group_a', get_the_author_meta('user_group', $user->ID)); ?>>グループA</option>
                    <option value="group_b" <?php selected('group_b', get_the_author_meta('user_group', $user->ID)); ?>>グループB</option>
                    <option value="group_c" <?php selected('group_c', get_the_author_meta('user_group', $user->ID)); ?>>グループC</option>

                </select>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_user_group_field');
add_action('edit_user_profile', 'add_user_group_field');


// カスタムフィールドの値を保存
function save_user_group_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'user_group', $_POST['user_group']);
}
add_action('personal_options_update', 'save_user_group_field');
add_action('edit_user_profile_update', 'save_user_group_field');




?>