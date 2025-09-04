<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = get_current_user_id();
  $user_meta = get_user_meta($user_id);
  $last_updated_key = null;

  // POSTデータをループして処理
  foreach ($_POST as $key => $value) {
    // 既存の値を取得
    $old_val = isset($user_meta[$key][0]) ? $user_meta[$key][0] : null;
    
    // 値が変更されている場合のみ更新
    if ($old_val !== $value) {
      update_user_meta($user_id, $key, $value);
      $last_updated_key = $key;
    }
  }

  // 最後に更新されたキーを保存
  if ($last_updated_key) {
    update_user_meta($user_id, 'last_progress_key', $last_updated_key);
  }

  wp_redirect(home_url('/my'));
  exit;
}


?>

<?php get_header(); ?>

<div class="registered">

  <div class="registered--wap">
    <div class="registered--wap--title">
      <p class="TX">更新完了</p>
    </div>
    <a class="registered--wap--back" href="<?php echo home_url('/my'); ?>">戻る</a>
  </div>

</div>


<?php get_footer(); ?>