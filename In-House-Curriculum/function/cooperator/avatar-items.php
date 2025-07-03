<?php
// ---キャラクターとアイテムの保存

add_action('show_user_profile', 'show_user_avatar_items_field');
add_action('edit_user_profile', 'show_user_avatar_items_field');

function show_user_avatar_items_field($user)
{
?>
    <h3>ユーザーのキャラクターとアイテム</h3>
    <table class="form-table">

        <!-- 選択中のアバター -->
        <tr>
            <th><label>選択中のアバター（カテゴリー別）</label></th>
            <td>
                <?php
                $avatar_categories = get_terms(array(
                    'taxonomy' => 'avatar-cat',
                    'hide_empty' => false,
                ));
                if (is_array($avatar_categories) && !empty($avatar_categories)) {
                    foreach ($avatar_categories as $category) {
                        // $categoryがオブジェクトか配列かを判定
                        $category_slug = '';
                        $category_name = '';
                        if (is_object($category)) {
                            $category_slug = isset($category->slug) ? $category->slug : '';
                            $category_name = isset($category->name) ? $category->name : '';
                        } elseif (is_array($category)) {
                            $category_slug = isset($category['slug']) ? $category['slug'] : '';
                            $category_name = isset($category['name']) ? $category['name'] : '';
                        }

                        if (!empty($category_slug)) {
                            $selected_avatar = get_user_meta($user->ID, 'selected_avatar_' . $category_slug, true);
                            echo '<p><strong>' . esc_html($category_name) . ':</strong> ' . esc_html($selected_avatar ?: '未選択') . '</p>';
                        }
                    }
                }
                ?>
            </td>
        </tr>

        <!-- 選択中のアイテム -->
        <tr>
            <th><label>選択中のアイテム（カテゴリー別）</label></th>
            <td>
                <?php
                $selected_items = json_decode(get_user_meta($user->ID, 'selected_items', true), true) ?: [];
                if (!empty($selected_items)) {
                    foreach ($selected_items as $category => $item) {
                        echo '<p><strong>' . esc_html($category) . ':</strong> ' . esc_html($item) . '</p>';
                    }
                } else {
                    echo '<p>選択中のアイテムはありません。</p>';
                }
                ?>
            </td>
        </tr>

        <!-- 所持アバター -->
        <tr>
            <th><label for="owned_avatars">所持アバター一覧</label></th>
            <td>
                <textarea name="owned_avatars" id="owned_avatars" class="regular-text" rows="5"><?php echo esc_textarea(get_user_meta($user->ID, 'owned_avatars', true)); ?></textarea>
                <p class="description">このユーザーが所持しているアバターのリスト（JSON形式）</p>
            </td>
        </tr>

        <!-- 所持アイテム -->
        <tr>
            <th><label for="owned_items">所持アイテム一覧（カテゴリー別）</label></th>
            <td>
                <textarea name="owned_items" id="owned_items" class="regular-text" rows="5"><?php echo esc_textarea(get_user_meta($user->ID, 'owned_items', true)); ?></textarea>
                <p class="description">このユーザーが所持しているアイテムのリスト（カテゴリー別、JSON形式）</p>
            </td>
        </tr>

    </table>
<?php
}

add_action('personal_options_update', 'save_user_avatar_items_field');
add_action('edit_user_profile_update', 'save_user_avatar_items_field');

function save_user_avatar_items_field($user_id)
{
    if (current_user_can('edit_user', $user_id)) {
        if (isset($_POST['owned_avatars'])) {
            update_user_meta($user_id, 'owned_avatars', sanitize_textarea_field($_POST['owned_avatars']));
        }
        if (isset($_POST['owned_items'])) {
            update_user_meta($user_id, 'owned_items', sanitize_textarea_field($_POST['owned_items']));
        }
    }
}

// 購入処理のJavaScript用nonce
add_action('wp_enqueue_scripts', 'add_exchange_nonce');
function add_exchange_nonce()
{
    wp_localize_script('jquery', 'exchange_ajax', array(
        'nonce' => wp_create_nonce('exchange_item_nonce')
    ));
}
?>