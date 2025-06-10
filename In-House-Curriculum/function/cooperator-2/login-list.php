<?php
function swpm_admin_member_login_history_list_shortcode() {
  $admin_level_id = 3; // ←「管理者会員レベル」のIDに変更

  // SWPM「管理者会員レベル」判定
  if (function_exists('SwpmMemberUtils')) {
      $member_id = SwpmMemberUtils::get_logged_in_members_id();
      if (!$member_id) {
          return 'このページは管理者会員レベルのみ閲覧できます。';
      }
      $member = SwpmMemberUtils::get_user_by_id($member_id);
      if ($member->membership_level != $admin_level_id) {
          return 'このページは管理者会員レベルのみ閲覧できます。';
      }
  }

  // ユーザー一覧
  $users = get_users();
  $output = '<table border="1" cellpadding="5"><tr><th>姓</th><th>名</th><th>メール</th><th>ログイン履歴（過去1ヶ月）</th></tr>';
  foreach ($users as $user) {
      $last_name = get_user_meta($user->ID, 'last_name', true);
      $first_name = get_user_meta($user->ID, 'first_name', true);

      $login_history = get_user_meta($user->ID, 'login_history', true);
      if (is_array($login_history) && count($login_history) > 0) {
          // 新しい順に並べる
          usort($login_history, function($a, $b) {
              return strtotime($b) - strtotime($a);
          });
          $history_list = implode('<br>', array_map('esc_html', $login_history));
      } else {
          $history_list = '記録なし';
      }
      $output .= "<tr>
          <td>".esc_html($last_name)."</td>
          <td>".esc_html($first_name)."</td>
          <td>{$user->user_email}</td>
          <td>{$history_list}</td>
      </tr>";
  }
  $output .= '</table>';
  return $output;
}
add_shortcode('swpm_admin_login_history_list', 'swpm_admin_member_login_history_list_shortcode');
?>  