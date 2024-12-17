<?php

  // コンタクトフォーム７pタグ削除
  add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
  function wpcf7_autop_return_false()
  {
    return false;
  }


//メアドの入力と確認が一致しているか
  function wpcf7_custom_email_validation_filter( $result, $tag ) {
    if ( 'your-email-confirm' == $tag->name ) {
      $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
      $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';
      if ( $your_email != $your_email_confirm ) {
        $result->invalidate( $tag, "メールアドレスが一致しません" );
      }
    }
    return $result;
  }
  add_filter( 'wpcf7_validate_email', 'wpcf7_custom_email_validation_filter', 20, 2 );
  add_filter( 'wpcf7_validate_email*', 'wpcf7_custom_email_validation_filter', 20, 2 );


  //リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
// function load_recaptcha_js() {
// 	if ( ! is_page('contact') && ! is_page('page-contact-confirm') && ! is_page('contact-complete')) {
// 		wp_deregister_script( 'google-recaptcha' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );

?>