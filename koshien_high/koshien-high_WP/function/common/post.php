<?php

// ============================================================
// お知らせ（標準投稿 post を「お知らせ」として使用）
// 内容カテゴリ=news_category / 学校区分=news_school の2軸に一本化。
// 標準の category / post_tag は投稿から外す。
// ※変更後は「設定 > パーマリンク > 変更を保存」
// ============================================================

// 標準投稿を「お知らせ」化（アーカイブ /news/）
function post_has_archive($args, $post_type)
{
	if ('post' == $post_type) {
		$args['rewrite']     = true;
		$args['has_archive'] = 'news';
		$args['label']       = 'お知らせ';
	}
	return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);


// カスタムタクソノミー登録
add_action('init', 'koshien_register_taxonomies');
function koshien_register_taxonomies()
{
	// 軸1: 内容カテゴリ（お知らせ info / 入試情報 exam / イベント event / 部活動 club）
	register_taxonomy(
		'news_category',
		'post',
		array(
			'label'        => 'お知らせカテゴリ',
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => array('slug' => 'news-category'),
		)
	);

	// 軸2: 学校区分（中学校 junior / 高等学校 high）
	register_taxonomy(
		'news_school',
		'post',
		array(
			'label'        => '学校区分',
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => array('slug' => 'news-school'),
		)
	);
}

// 標準の「カテゴリー」「タグ」を投稿から外す
add_action('init', 'koshien_unregister_default_taxonomies');
function koshien_unregister_default_taxonomies()
{
	unregister_taxonomy_for_object_type('category', 'post');
	unregister_taxonomy_for_object_type('post_tag', 'post');
}

add_theme_support('post-thumbnails');