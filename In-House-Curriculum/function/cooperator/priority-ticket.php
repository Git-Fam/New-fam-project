<?php
// ---優先チケット管理

add_action('show_user_profile', 'show_user_priority_ticket_field');
add_action('edit_user_profile', 'show_user_priority_ticket_field');

function show_user_priority_ticket_field($user) {
    ?>
    <h3>ユーザーの優先チケット管理</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_priority_ticket">優先チケット枚数</label></th>
            <td>
                <input type="number" name="user_priority_ticket" id="user_priority_ticket" value="<?php echo esc_attr(get_user_meta($user->ID, 'priority_ticket', true)); ?>" class="regular-text" />
                <p class="description">このユーザーが現在持っている優先チケットの枚数</p>
            </td>
        </tr>
    </table>
    <?php
}

function save_user_priority_ticket_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'priority_ticket', intval($_POST['user_priority_ticket']));
}
add_action('personal_options_update', 'save_user_priority_ticket_field');
add_action('edit_user_profile_update', 'save_user_priority_ticket_field');

// 優先チケットを追加する関数
function add_priority_ticket($user_id, $amount) {
    $current_tickets = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
    $new_tickets = $current_tickets + $amount;
    update_user_meta($user_id, 'priority_ticket', $new_tickets);
}

// 優先チケットを減らす関数
function remove_priority_ticket($user_id, $amount) {
    $current_tickets = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
    $new_tickets = max(0, $current_tickets - $amount); // チケット枚数が負の値にならないようにする
    update_user_meta($user_id, 'priority_ticket', $new_tickets);
}



// 優先チケットを消費する関数
function consume_tickets() {
    if (!isset($_POST['user_ids'])) {
        wp_send_json_error('ユーザーIDが指定されていません。');
    }

    $user_ids = json_decode(stripslashes($_POST['user_ids']), true);
    if (!is_array($user_ids)) {
        wp_send_json_error('ユーザーIDの形式が不正です。');
    }

    foreach ($user_ids as $user_id) {
        $priority_ticket = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
        $new_ticket_count = max(0, $priority_ticket - 1); // チケット枚数が負の値にならないようにする
        update_user_meta($user_id, 'priority_ticket', $new_ticket_count);
    }

    wp_send_json_success('チケットが消費されました。');
}

add_action('wp_ajax_consume_tickets', 'consume_tickets');
add_action('wp_ajax_nopriv_consume_tickets', 'consume_tickets');
?>