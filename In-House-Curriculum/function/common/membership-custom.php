<?php

// [swpm_registration_form]の登録フォームに都道府県の入力欄を追加
add_action('swpm_registration_form', function () {
?>
  <div class="swpm-form-row aaaaa">
    <label for="address_state">都道府県</label>
    <input type="text" id="address_state" name="address_state" value="<?php echo isset($_POST['address_state']) ? esc_attr($_POST['address_state']) : ''; ?>" />
  </div>
<?php
});

// 入力値を保存（user_metaに保存）
add_action('swpm_after_registration', function ($member_id, $member_data, $form_data) {
  if (!empty($_POST['address_state'])) {
    update_user_meta($member_id, 'address_state', sanitize_text_field($_POST['address_state']));
  }
}, 10, 3);

// 必須バリデーション（必要なら）
add_filter('swpm_registration_form_validation', function ($errors, $form_data) {
  if (empty($_POST['address_state'])) {
    $errors[] = '都道府県は必須です。';
  }
  return $errors;
}, 10, 2);
