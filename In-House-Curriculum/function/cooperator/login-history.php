<?php
// ---ログイン履歴

add_action('show_user_profile', 'show_user_login_history_field');
add_action('edit_user_profile', 'show_user_login_history_field');

function show_user_login_history_field($user) {
    ?>
    <h3>ユーザーの最終ログイン履歴</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_login_history">ログイン履歴</label></th>
            <td>
                <input type="text" name="user_login_history" id="user_login_history" value="<?php echo esc_attr(get_user_meta($user->ID, 'last_login', true)); ?>" class="regular-text" readonly />
                <p class="description">このユーザーの最終ログイン日時</p>
            </td>
        </tr>
    </table>
    <?php
}

function save_user_login_history_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    // 最終ログイン日時は手動で更新しないため、ここでは何もしません
}
add_action('personal_options_update', 'save_user_login_history_field');
add_action('edit_user_profile_update', 'save_user_login_history_field');

// ユーザーがログインするたびに最終ログイン日時を更新する
function update_last_login($user_login, $user) {
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}
add_action('wp_login', 'update_last_login', 10, 2);
?>