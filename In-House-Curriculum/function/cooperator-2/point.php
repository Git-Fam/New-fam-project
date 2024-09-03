<?php
// 管理画面のユーザー編集ページにポイントフィールドを追加
add_action('show_user_profile', 'show_user_point_field');
add_action('edit_user_profile', 'show_user_point_field');

function show_user_point_field($user) {
    ?>
    <h3>ユーザーのポイント管理</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_point">ポイント数</label></th>
            <td>
                <input type="number" name="user_point" id="user_point" value="<?php echo esc_attr(get_user_meta($user->ID, 'user_point', true)); ?>" class="regular-text" />
                <p class="description">このユーザーが現在持っているポイント数</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'show_user_point_field');
add_action('edit_user_profile', 'show_user_point_field');

// ポイント数を保存する処理
function save_user_point_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'user_point', sanitize_text_field($_POST['user_point']));
}
add_action('personal_options_update', 'save_user_point_field');
add_action('edit_user_profile_update', 'save_user_point_field');


// ポイントを付与する

// function add_user_point($user_id, $amount) {
//     $current_point = get_user_meta($user_id, 'user_point', true) ?: 0;
//     $new_point = $current_point + $amount;
//     update_user_meta($user_id, 'user_point', $new_point);
// }

// add_user_point($user_id, 付与するポイントの数字);
// ３ポイント付与する場合
// add_user_point($user_id, 3);

?>



