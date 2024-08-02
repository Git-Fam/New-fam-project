<?php


  // コンタクトフォーム７pタグ削除
  // add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
  // function wpcf7_autop_return_false()
  // {
  //   return false;
  // }

// 投稿
function post_has_archive($args, $post_type ) { 
	if('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'topics';
		$args['label'] = '新着情報';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10,2);
add_theme_support('post-thumbnails');



//リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
// function load_recaptcha_js() {
// 	if ( ! is_page('contact') && ! is_page('page-contact-confirm') && ! is_page('contact-complete')) {
// 		wp_deregister_script( 'google-recaptcha' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );

?>