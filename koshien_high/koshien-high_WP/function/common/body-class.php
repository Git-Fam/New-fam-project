<?php

// 固定ページの最上位の親スラッグに応じて body へクラスを付与する。
// 中学配下 → is-junior / 高校配下 → is-high（テーマカラー切り替え等に使用）
// ヘッダーを透明開始にするページに is-hero-top を付与
// （TOP / 中学TOP / 高校TOP）
function add_hero_top_body_class($classes)
{
	if (is_front_page()) {
		$classes[] = 'is-hero-top';
	} elseif (is_page(array('junior', 'high'))) {
		// 中学TOP・高校TOP（そのページ自体のみ。配下ページは含めない）
		$classes[] = 'is-hero-top';
	}
	return $classes;
}
add_filter('body_class', 'add_hero_top_body_class');



// フロントページに is-front を付与（ヘッダー透明制御用）
function add_front_body_class($classes)
{
	if (is_front_page()) {
		$classes[] = 'is-front';
	}
	return $classes;
}
add_filter('body_class', 'add_front_body_class');


function add_school_body_class($classes) {
	$post = get_queried_object();
	if ($post && isset($post->post_type) && $post->post_type === 'page') {
		$ancestors = get_post_ancestors($post->ID);
		$top_id = !empty($ancestors) ? end($ancestors) : $post->ID;
		$top_slug = get_post_field('post_name', $top_id);

		if ($top_slug === 'junior') {
			$classes[] = 'is-junior';
		} elseif ($top_slug === 'high') {
			$classes[] = 'is-high';
		}
	}
	return $classes;
}
add_filter('body_class', 'add_school_body_class');