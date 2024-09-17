<?php
// ---ログイン履歴

add_action('show_user_profile', 'show_user_login_history_field');
add_action('edit_user_profile', 'show_user_login_history_field');

function show_user_login_history_field($user) {
    $login_history = get_user_meta($user->ID, 'login_history', true);
    if (!is_array($login_history)) {
        $login_history = [];
    }
    ?>
    <h3>ユーザーの最終ログイン履歴</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_login_history">ログイン履歴</label></th>
            <td>
                <textarea name="user_login_history" id="user_login_history" class="regular-text"><?php echo esc_textarea(implode("\n", $login_history)); ?></textarea>
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
    if (isset($_POST['user_login_history'])) {
        $login_history = array_map('trim', explode("\n", $_POST['user_login_history']));
        update_user_meta($user_id, 'login_history', $login_history);
    }
}
add_action('personal_options_update', 'save_user_login_history_field');
add_action('edit_user_profile_update', 'save_user_login_history_field');

// ユーザーがログインするたびにログイン履歴を更新する
function update_last_login($user_login, $user) {
    $current_time = current_time('mysql');
    $current_date = date('Y-m-d', strtotime($current_time));
    $login_history = get_user_meta($user->ID, 'login_history', true);
    if (!is_array($login_history)) {
        $login_history = [];
    }
    
    // 同じ日付のログインがない場合のみ追加
    if (!in_array($current_date, array_map(function($login_time) {
        return date('Y-m-d', strtotime($login_time));
    }, $login_history))) {
        $login_history[] = $current_time;
    }
    
    // 1ヶ月間のログイン履歴のみを保持
    $one_month_ago = strtotime('-1 month');
    $login_history = array_filter($login_history, function($login_time) use ($one_month_ago) {
        return strtotime($login_time) >= $one_month_ago;
    });

    update_user_meta($user->ID, 'login_history', $login_history);
}
add_action('wp_login', 'update_last_login', 10, 2);
?>