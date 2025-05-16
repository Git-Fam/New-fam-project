<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<div class="page-viewing-limit">
  <div class="page-viewing-limit--content">
      <p class="TX">閲覧権限がありません。</p>
      <a href="javascript:window.history.go(-2);">戻る</a>
  </div>
</div>

<?php get_footer(); ?>