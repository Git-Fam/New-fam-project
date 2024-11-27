<?php

// 投稿
function post_has_archive($args, $post_type)
{ // 設定後に（パーマリンク更新すること）
	if ('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'ranking';
		$args['label'] = 'ランキング';
	}
	return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);


// カスタム投稿追加
/* ---------- カスタム投稿の追加 ---------- */
add_action('init', 'create_post_type');
function create_post_type()
{
	register_post_type( // カスタム投稿タイプの追加関数
		'column', //カスタム投稿タイプ名（半角英数字の小文字）
		array( //オプション（以下）
			'label' => 'コラム', // 管理画面上の表示（日本語でもOK）
			'public' => true, // 管理画面に表示するかどうかの指定
			'has_archive' => true, // 投稿した記事の一覧ページを作成する
			'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
			'show_in_rest' => true, // Gutenbergの有効化
			'supports' => array( // サポートする機能（以下）
				'title',  // タイトル
				'editor', // エディター
				'thumbnail', // アイキャッチ画像
				'revisions' // リビジョンの保存
			),
		)
	);
	register_taxonomy(
		'column-cat',
		'column',
		array(
			'label' => 'カテゴリー',
			'hierarchical' => true,
			'public' => true,
			'show_in_rest' => true,
		)
	);
	register_taxonomy(
		'column-tag',
		'column',
		array(
			'label' => 'タグ',
			'hierarchical' => false,
			'public' => true,
			'show_in_rest' => true,
			'update_count_callback' => '_update_post_term_count',
		)
	);


}

add_theme_support('post-thumbnails');


