<?php


  // コンタクトフォーム７pタグ削除
  add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
  function wpcf7_autop_return_false()
  {
    return false;
  }

// 投稿
function post_has_archive($args, $post_type ) { // 設定後に（パーマリンク更新すること）
	if('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'works';
		$args['label'] = '施工事例';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10,2);
add_theme_support('post-thumbnails');


// テキストエディタ非表示
function remove_post_editor() {
  remove_post_type_support('post', 'editor');
}
add_action('admin_init', 'remove_post_editor');

// リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
function load_recaptcha_js() {
	if ( ! is_page('contact') && ! is_page('contact-confirm') && ! is_page('contact-complete')) {
		wp_deregister_script( 'google-recaptcha' );
	}
}
add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );


?>