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


// コインを付与する

function add_user_coins($user_id, $amount) {
    $current_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
    $new_coins = $current_coins + $amount;
    update_user_meta($user_id, 'user_coins', $new_coins);
}

// add_user_coins($user_id, 付与するコインの数字);
// ３コイン付与する場合
// add_user_coins($user_id, 3);



// 投稿IDごとに1回だけコインを付与する処理（AJAX）
add_action('wp_ajax_add_random_coin', function () {
    $user_id = get_current_user_id();
    $post_id = intval($_POST['post_id'] ?? 0);

    if (!$post_id) {
        wp_send_json_error('投稿IDが不正です');
    }

    $history = get_user_meta($user_id, 'random_coin_history', true);
    if (!is_array($history)) $history = [];

    if (!in_array($post_id, $history, true)) {
        add_user_coins($user_id, 5);
        $history[] = $post_id;
        update_user_meta($user_id, 'random_coin_history', $history);
        wp_send_json_success(['coins' => 5]);
    } else {
        wp_send_json_error('すでに受け取っているよ！');
    }
});




?>