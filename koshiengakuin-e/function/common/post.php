<?php

// 投稿
function post_has_archive($args, $post_type)
{ // 設定後に（パーマリンク更新すること）
	if ('post' == $post_type) {
		$args['rewrite'] = array('slug' => 'news', 'with_front' => false);
		$args['has_archive'] = 'news';
		$args['label'] = 'お知らせ';
	}
	return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

/**
 * Make single post URLs use /news/{postname} and add rewrite rule
 */
add_action('init', function(){
	// add rewrite rule to match /news/{postname}
	add_rewrite_rule('^news/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
});

// filter generated post links to include /news/ prefix
add_filter('post_link', function($permalink, $post){
	if ($post->post_type !== 'post') return $permalink;
	$slug = $post->post_name;
	if ( ! $slug ) return $permalink;
	return home_url( user_trailingslashit("news/" . $slug) );
}, 10, 2);


// カスタム投稿追加
/* ---------- カスタム投稿の追加 ---------- */
// add_action('init', 'create_post_type');
// function create_post_type()
// {
// 	register_post_type( // カスタム投稿タイプの追加関数
// 		'blog', //カスタム投稿タイプ名（半角英数字の小文字）
// 		array( //オプション（以下）
// 			'label' => 'ブログ', // 管理画面上の表示（日本語でもOK）
// 			'public' => true, // 管理画面に表示するかどうかの指定
// 			'has_archive' => true, // 投稿した記事の一覧ページを作成する
// 			'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
// 			'show_in_rest' => true, // Gutenbergの有効化
// 			'supports' => array( // サポートする機能（以下）
// 				'title',  // タイトル
// 				'editor', // エディター
// 				'thumbnail', // アイキャッチ画像
// 				'revisions' // リビジョンの保存
// 			),
// 		)
// 	);
// 	register_taxonomy(
// 		'blog-cat',
// 		'blog',
// 		array(
// 			'label' => 'カテゴリー',
// 			'hierarchical' => true,
// 			'public' => true,
// 			'show_in_rest' => true,
// 		)
// 	);
// 	register_taxonomy(
// 		'blog-tag',
// 		'blog',
// 		array(
// 			'label' => 'タグ',
// 			'hierarchical' => false,
// 			'public' => true,
// 			'show_in_rest' => true,
// 			'update_count_callback' => '_update_post_term_count',
// 		)
// 	);


// 	register_post_type( // カスタム投稿タイプの追加関数
// 		'column', //カスタム投稿タイプ名（半角英数字の小文字）
// 		array( //オプション（以下）
// 			'label' => 'コラム', // 管理画面上の表示（日本語でもOK）
// 			'public' => true, // 管理画面に表示するかどうかの指定
// 			'has_archive' => true, // 投稿した記事の一覧ページを作成する
// 			'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
// 			'show_in_rest' => true, // Gutenbergの有効化
// 			'supports' => array( // サポートする機能（以下）
// 				'title',  // タイトル
// 				'editor', // エディター
// 				'thumbnail', // アイキャッチ画像
// 				'revisions' // リビジョンの保存
// 			),
// 		)
// 	);
// 	register_taxonomy(
// 		'column-cat',
// 		'column',
// 		array(
// 			'label' => 'カテゴリー',
// 			'hierarchical' => true,
// 			'public' => true,
// 			'show_in_rest' => true,
// 		)
// 	);
// 	register_taxonomy(
// 		'column-tag',
// 		'column',
// 		array(
// 			'label' => 'タグ',
// 			'hierarchical' => false,
// 			'public' => true,
// 			'show_in_rest' => true,
// 			'update_count_callback' => '_update_post_term_count',
// 		)
// 	);
// }

add_theme_support('post-thumbnails');


