<?php
// 管理画面のユーザー編集ページにコインフィールドを追加
add_action('show_user_profile', 'show_user_coins_field');
add_action('edit_user_profile', 'show_user_coins_field');

function show_user_coins_field($user) {
    ?>
    <h3>ユーザーのコイン管理</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_coins">コイン数</label></th>
            <td>
                <input type="number" name="user_coins" id="user_coins" value="<?php echo esc_attr(get_user_meta($user->ID, 'user_coins', true)); ?>" class="regular-text" />
                <p class="description">このユーザーが現在持っているコイン数</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'show_user_coins_field');
add_action('edit_user_profile', 'show_user_coins_field');

// コイン数を保存する処理
function save_user_coins_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'user_coins', sanitize_text_field($_POST['user_coins']));
}
add_action('personal_options_update', 'save_user_coins_field');
add_action('edit_user_profile_update', 'save_user_coins_field');
?>