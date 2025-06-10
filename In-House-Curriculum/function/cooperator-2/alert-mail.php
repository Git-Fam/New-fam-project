<?php


// 1日1回、最終ログインから7日経ったユーザー本人へメール通知
add_action('wp_loaded', function() {
  if (!wp_next_scheduled('remind_inactive_users_7days')) {
      wp_schedule_event(time(), 'daily', 'remind_inactive_users_7days');
  }
});

add_action('remind_inactive_users_7days', 'notify_inactive_users_7days_to_self');

function notify_inactive_users_7days_to_self() {
  $users = get_users();
  $now = time();
  $seven_days_ago = $now - (7 * 24 * 60 * 60);

  foreach ($users as $user) {
      $login_history = get_user_meta($user->ID, 'login_history', true);
      $last_name = get_user_meta($user->ID, 'last_name', true);
      $first_name = get_user_meta($user->ID, 'first_name', true);

      if (is_array($login_history) && count($login_history) > 0) {
          $last_login = end($login_history);
          $last_login_time = strtotime($last_login);

          // 7日以上経過していたら本人にメール
          if ($last_login_time < $seven_days_ago) {
              send_inactive_user_mail($user->user_email, $first_name, $last_name, $last_login);
          }
      } else {
          // 一度もログイン履歴がない場合も通知したい場合はこちらを使う
          // send_inactive_user_mail($user->user_email, $first_name, $last_name, '記録なし');
      }
  }
}

// メール送信処理（HTMLメールで装飾も可）
function send_inactive_user_mail($to, $first_name, $last_name, $last_login) {
  $subject = '【重要】最終ログインから7日が経過しました';

  $headers = array('Content-Type: text/html; charset=UTF-8');

  $message = '
  <html>
  <body>
    <div style="background:#f6f6f6; padding:20px; font-family:sans-serif;">
      <h2 style="color:#0073aa;">【重要】最終ログインから7日経過しています！</h2>
      <p>こんにちは、<strong>'.esc_html($last_name).' '.esc_html($first_name).'</strong>さん。</p>
      <p>あなたの最終ログイン日時は <span style="color:#d00;">'.esc_html($last_login).'</span> です。</p>
      
      <p>
        <a href="https://your-site.com/login" style="background:#0073aa; color:#fff; padding:10px 20px; border-radius:6px; text-decoration:none;">ログインはこちら</a>
      </p>
      <hr>
      <p style="font-size:12px; color:#888;">このメールは自動送信です。</p>
    </div>
  </body>
  </html>
  ';

  wp_mail($to, $subject, $message, $headers);
}







?>