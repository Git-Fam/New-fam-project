<?php
add_action('wp_ajax_mark_lost_item_collected', 'mark_lost_item_collected');
function mark_lost_item_collected() {
  if (!is_user_logged_in()) {
    wp_send_json_error('ログインしてね');
  }

  $user_id = get_current_user_id();
  $item_type = sanitize_text_field($_POST['item_type'] ?? '');

  if (!$item_type) {
    wp_send_json_error('アイテムタイプ不正');
  }

  update_user_meta($user_id, 'lost_item_' . $item_type, 1);
  wp_send_json_success('登録完了');
}

function add_lost_item_trigger_meta() {
  add_meta_box('lost_item_trigger', '落とし物トリガー', function($post) {
    $value = get_post_meta($post->ID, '_is_lost_item_trigger', true);
    ?>
    <label>
      <input type="checkbox" name="is_lost_item_trigger" value="1" <?php checked($value, 1); ?> />
      この投稿を落とし物の表示トリガーにする
    </label>
    <?php
  }, 'post', 'side');
}
add_action('add_meta_boxes', 'add_lost_item_trigger_meta');

function save_lost_item_trigger_meta($post_id) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  $value = isset($_POST['is_lost_item_trigger']) ? 1 : 0;
  update_post_meta($post_id, '_is_lost_item_trigger', $value);
}
add_action('save_post', 'save_lost_item_trigger_meta');



// ユーザープロフィールページに「拾った落とし物」を追加
function add_custom_user_lost_checkbox_field($user) {
  $items = ['HTML', 'jQuery', 'LP', 'React']; // 落とし物リスト
  ?>
  <h3>拾った落とし物</h3>
  <table class="form-table">
      <?php foreach ($items as $item): 
          $meta_key = 'lost_item_' . $item;
          $has_item = get_user_meta($user->ID, $meta_key, true);
      ?>
      <tr>
          <th><label for="<?php echo esc_attr($meta_key); ?>"><?php echo esc_html($item); ?> 落とし物</label></th>
          <td>
              <label>
                  <input type="checkbox" name="<?php echo esc_attr($meta_key); ?>" id="<?php echo esc_attr($meta_key); ?>" value="1" <?php checked($has_item, 1); ?> />
                  所持中
              </label>
          </td>
      </tr>
      <?php endforeach; ?>
  </table>
  <?php
}
add_action('show_user_profile', 'add_custom_user_lost_checkbox_field');
add_action('edit_user_profile', 'add_custom_user_lost_checkbox_field');

// 保存処理
function save_custom_user_lost_checkbox_field($user_id) {
  if (!current_user_can('edit_user', $user_id)) {
    return false;
  }

  $items = ['HTML', 'jQuery', 'LP', 'React']; // 同じリストをここにも
  foreach ($items as $item) {
    $meta_key = 'lost_item_' . $item;
    $has_item = isset($_POST[$meta_key]) ? 1 : 0;
    update_user_meta($user_id, $meta_key, $has_item);
  }
}
add_action('personal_options_update', 'save_custom_user_lost_checkbox_field');
add_action('edit_user_profile_update', 'save_custom_user_lost_checkbox_field');

add_action('wp_enqueue_scripts', 'enqueue_road_random_script');
function enqueue_road_random_script() {
	wp_enqueue_script(
		'road-random',
		get_template_directory_uri() . '/js/road-random.js',
		['jquery'],
		null,
		true
	);

	// 必ずenqueueのあとに
	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$items = ['HTML', 'jQuery', 'LP', 'React'];
		$owned = [];

		foreach ($items as $item) {
			$meta_key = 'lost_item_' . $item;
			$owned[$item] = get_user_meta($user_id, $meta_key, true) == 1;
		}

		wp_add_inline_script(
			'road-random',
			'window.LOST_ITEMS = ' . json_encode(['owned' => $owned]) . ';',
			'before'
		);
	}

	wp_localize_script('road-random', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_ajax_unmark_lost_item_collected', 'unmark_lost_item_collected');
function unmark_lost_item_collected() {
	if (!is_user_logged_in()) {
		wp_send_json_error('ログインが必要です');
	}

	$user_id = get_current_user_id();
	$item_type = sanitize_text_field($_POST['item_type'] ?? '');

	if (!$item_type) {
		wp_send_json_error('アイテム種別が不明');
	}

	// カスタムフィールド（チェックボックス）の削除
	delete_user_meta($user_id, 'lost_item_' . $item_type);

	wp_send_json_success('チェックを外しました');
}
