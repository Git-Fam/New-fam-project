<?php
// 取得（拾う）処理
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

  // 「渡した」履歴があれば再取得禁止
  if (get_user_meta($user_id, 'lost_item_' . $item_type . '_history', true) == 1) {
    wp_send_json_error('この落とし物はもう拾えません');
  }

  update_user_meta($user_id, 'lost_item_' . $item_type, 1);
  wp_send_json_success('登録完了');
}

// 落とし物の「渡した」処理
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

  // チェック外し（＝渡す）
  delete_user_meta($user_id, 'lost_item_' . $item_type);

  // 履歴を記録（渡したことがあるフラグ）
  update_user_meta($user_id, 'lost_item_' . $item_type . '_history', 1);

  wp_send_json_success('チェックを外しました');
}

// 管理画面：落とし物一覧
function add_custom_user_lost_checkbox_field($user) {
  $items = ['HTML', 'jQuery', 'LP', 'React'];
  ?>
  <h3>拾った落とし物</h3>
  <table class="form-table">
      <?php foreach ($items as $item): 
          $meta_key = 'lost_item_' . $item;
          $history_key = $meta_key . '_history';
          $has_item = get_user_meta($user->ID, $meta_key, true);
          $has_history = get_user_meta($user->ID, $history_key, true);
      ?>
      <tr>
          <th><label for="<?php echo esc_attr($meta_key); ?>"><?php echo esc_html($item); ?> 落とし物</label></th>
          <td>
              <label>
                  <input type="checkbox"
                      name="<?php echo esc_attr($meta_key); ?>"
                      id="<?php echo esc_attr($meta_key); ?>"
                      value="1"
                      <?php checked($has_item, 1); ?>
                      <?php if ($has_history == 1) echo ' disabled'; ?> />
                  所持中
                  <?php if ($has_history == 1): ?>
                      <span style="color:#888;">（渡したため再取得不可）</span>
                  <?php endif; ?>
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

  $items = ['HTML', 'jQuery', 'LP', 'React'];
  foreach ($items as $item) {
    $meta_key = 'lost_item_' . $item;
    $history_key = $meta_key . '_history';
    // 既に履歴があれば、何も変更させない
    if (get_user_meta($user_id, $history_key, true) == 1) {
      continue;
    }
    $has_item = isset($_POST[$meta_key]) ? 1 : 0;
    update_user_meta($user_id, $meta_key, $has_item);
  }
}
add_action('personal_options_update', 'save_custom_user_lost_checkbox_field');
add_action('edit_user_profile_update', 'save_custom_user_lost_checkbox_field');

// 落とし物リストをJSへ渡す
add_action('wp_enqueue_scripts', 'enqueue_road_random_script');
function enqueue_road_random_script() {
	wp_enqueue_script(
		'road-random',
		get_template_directory_uri() . '/js/road-random.js',
		['jquery'],
		null,
		true
	);

	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$items = ['HTML', 'jQuery', 'LP', 'React'];
		$owned = [];
		$history = [];
		foreach ($items as $item) {
			$meta_key = 'lost_item_' . $item;
			$history_key = $meta_key . '_history';
			$owned[$item] = get_user_meta($user_id, $meta_key, true) == 1;
			$history[$item] = get_user_meta($user_id, $history_key, true) == 1;
		}
		wp_add_inline_script(
			'road-random',
			'window.LOST_ITEMS = ' . json_encode(['owned' => $owned, 'history' => $history]) . ';',
			'before'
		);
	}

	wp_localize_script('road-random', 'ajaxurl', admin_url('admin-ajax.php'));
}
?>
