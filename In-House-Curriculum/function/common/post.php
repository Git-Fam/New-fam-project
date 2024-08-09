<?php

// 投稿
function post_has_archive($args, $post_type ) { // 設定後に（パーマリンク更新すること）
	if('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'curriculum';
		$args['label'] = 'カリキュラム';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10,2);

add_theme_support('post-thumbnails');

?>