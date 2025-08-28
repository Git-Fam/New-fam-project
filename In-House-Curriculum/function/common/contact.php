<?php

// Mailpit用のSMTP設定
add_action('phpmailer_init', function ($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'localhost';
  $phpmailer->Port = 1025;
  $phpmailer->SMTPSecure = false;
  $phpmailer->SMTPAuth = false;
  $phpmailer->SMTPAutoTLS = false;
});

// コンタクトフォーム７pタグ削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}

// リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
// function load_recaptcha_js()
// {
//   if (! is_page('contact') && ! is_page('page-contact-confirm') && ! is_page('contact-complete')) {
//     wp_deregister_script('google-recaptcha');
//   }
// }
// add_action('wp_enqueue_scripts', 'load_recaptcha_js', 100);
