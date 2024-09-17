<?php
// ---ログイン連続履歴

add_action('show_user_profile', 'show_user_login_continuous_field');
add_action('edit_user_profile', 'show_user_login_continuous_field');

function show_user_login_continuous_field($user) {
    ?>
    <h3>ユーザーの連続ログイン履歴</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_login_continuous">連続ログイン日数</label></th>
            <td>
                <input type="number" name="user_login_continuous" id="user_login_continuous" value="<?php echo esc_attr(get_user_meta($user->ID, 'consecutive_login_days', true)); ?>" class="regular-text" />
                <p class="description">このユーザーの連続ログイン日数</p>
            </td>
        </tr>
        <tr>
            <th><label for="user_login_continuous_10days">10日連続ログイン達成日</label></th>
            <td>
                <input type="text" name="user_login_continuous_10days" id="user_login_continuous_10days" value="<?php echo esc_attr(get_user_meta($user->ID, 'login_continuous_10days', true)); ?>" class="regular-text" />
                <p class="description">このユーザーが10日連続ログインを達成した日</p>
            </td>
        </tr>
        <tr>
            <th><label for="user_login_continuous_10days_count">10日連続ログイン達成回数</label></th>
            <td>
                <input type="number" name="user_login_continuous_10days_count" id="user_login_continuous_10days_count" value="<?php echo esc_attr(get_user_meta($user->ID, 'login_continuous_10days_count', true)); ?>" class="regular-text" />
                <p class="description">このユーザーが10日連続ログインを達成した回数</p>
            </td>
        </tr>
    </table>
    <?php
}

function save_user_login_continuous_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    // 連続ログイン日数を保存
    if (isset($_POST['user_login_continuous'])) {
        update_user_meta($user_id, 'consecutive_login_days', intval($_POST['user_login_continuous']));
    }
    // 10日連続ログイン達成回数を保存
    if (isset($_POST['user_login_continuous_10days_count'])) {
        update_user_meta($user_id, 'login_continuous_10days_count', intval($_POST['user_login_continuous_10days_count']));
    }
    // 10日連続ログイン達成日を保存
    if (isset($_POST['user_login_continuous_10days'])) {
        update_user_meta($user_id, 'login_continuous_10days', sanitize_text_field($_POST['user_login_continuous_10days']));
    }
}
add_action('personal_options_update', 'save_user_login_continuous_field');
add_action('edit_user_profile_update', 'save_user_login_continuous_field');

?>