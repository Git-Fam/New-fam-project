<?php
// ---復活後連続ログイン履歴

add_action('show_user_profile', 'show_user_comeback_login_history_field');
add_action('edit_user_profile', 'show_user_comeback_login_history_field');

function show_user_comeback_login_history_field($user) {
    $comeback_login_history = get_user_meta($user->ID, 'comeback_login_history', true);
    if (!is_array($comeback_login_history)) {
        $comeback_login_history = [];
    }
    $comeback_login_days = get_user_meta($user->ID, 'comeback_login_days', true) ?: 0;
    $comeback_login_count = get_user_meta($user->ID, 'comeback_login_count', true) ?: 0;
    ?>
    <h3>ユーザーの復活後連続ログイン履歴</h3>
    <table class="form-table">
        <tr>
            <th><label for="comeback_login_history">復活後連続ログイン履歴</label></th>
            <td>
                <textarea name="comeback_login_history" id="comeback_login_history" class="regular-text"><?php echo esc_textarea(implode("\n", $comeback_login_history)); ?></textarea>
                <p class="description">このユーザーの復活後連続ログイン日時</p>
            </td>
        </tr>
        <tr>
            <th><label for="comeback_login_days">復活後連続ログイン日数</label></th>
            <td>
                <input type="number" name="comeback_login_days" id="comeback_login_days" value="<?php echo esc_attr($comeback_login_days); ?>" class="regular-text" />
                <p class="description">このユーザーの復活後連続ログイン日数</p>
            </td>
        </tr>
        <tr>
            <th><label for="comeback_login_count">復活後連続ログイン達成回数</label></th>
            <td>
                <input type="number" name="comeback_login_count" id="comeback_login_count" value="<?php echo esc_attr($comeback_login_count); ?>" class="regular-text" />
                <p class="description">このユーザーの復活後連続ログイン達成回数</p>
            </td>
        </tr>
    </table>
    <?php
}

function save_user_comeback_login_history_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    if (isset($_POST['comeback_login_history'])) {
        $comeback_login_history = array_map('trim', explode("\n", $_POST['comeback_login_history']));
        update_user_meta($user_id, 'comeback_login_history', $comeback_login_history);
    }
    if (isset($_POST['comeback_login_days'])) {
        update_user_meta($user_id, 'comeback_login_days', intval($_POST['comeback_login_days']));
    }
    if (isset($_POST['comeback_login_count'])) {
        update_user_meta($user_id, 'comeback_login_count', intval($_POST['comeback_login_count']));
    }
}
add_action('personal_options_update', 'save_user_comeback_login_history_field');
add_action('edit_user_profile_update', 'save_user_comeback_login_history_field');

// ユーザーがログインするたびに復活後連続ログイン履歴を更新する
function update_comeback_last_login($user_login, $user) {
    $current_time = current_time('mysql');
    $current_date = date('Y-m-d', strtotime($current_time));
    $comeback_login_history = get_user_meta($user->ID, 'comeback_login_history', true);
    if (!is_array($comeback_login_history)) {
        $comeback_login_history = [];
    }

    // 同じ日付のログインがない場合のみ追加
    if (!in_array($current_date, array_map(function($login_time) {
        return date('Y-m-d', strtotime($login_time));
    }, $comeback_login_history))) {
        $comeback_login_history[] = $current_time;
    }

    // 1ヶ月間の復活後連続ログイン履歴のみを保持
    $one_month_ago = strtotime('-1 month');
    $comeback_login_history = array_filter($comeback_login_history, function($login_time) use ($one_month_ago) {
        return strtotime($login_time) >= $one_month_ago;
    });

    update_user_meta($user->ID, 'comeback_login_history', $comeback_login_history);

    // 復活後連続ログイン日数を更新
    $last_comeback_login_date = get_user_meta($user->ID, 'last_comeback_login_date', true);
    $comeback_login_days = get_user_meta($user->ID, 'comeback_login_days', true) ?: 0;

    if (!$last_comeback_login_date || (strtotime($current_date) - strtotime($last_comeback_login_date)) >= DAY_IN_SECONDS) {
        if (!$last_comeback_login_date || (strtotime($current_date) - strtotime($last_comeback_login_date)) >= 2 * DAY_IN_SECONDS) {
            $comeback_login_days = 1; // 2日以上経過している場合、リセット
        } else {
            $comeback_login_days++; // 連続ログイン日数を更新
        }
        update_user_meta($user->ID, 'last_comeback_login_date', $current_date);
    }

    update_user_meta($user->ID, 'comeback_login_days', $comeback_login_days);
}
add_action('wp_login', 'update_comeback_last_login', 10, 2);
?>