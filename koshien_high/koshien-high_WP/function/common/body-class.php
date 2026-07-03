<?php

// 固定ページの最上位の親スラッグに応じて body へクラスを付与する。
// 中学配下 → is-junior / 高校配下 → is-high（テーマカラー切り替え等に使用）
function add_school_body_class($classes)
{
	if (is_page()) {
		$ancestors = get_post_ancestors(get_the_ID());
		$top_id    = $ancestors ? end($ancestors) : get_the_ID();
		$top_slug  = get_post_field('post_name', $top_id);

		if ($top_slug === 'junior') {
			$classes[] = 'is-junior';
		} elseif ($top_slug === 'high') {
			$classes[] = 'is-high';
		}
	}
	return $classes;
}
add_filter('body_class', 'add_school_body_class');



// フロントページに is-front を付与（ヘッダー透明制御用）
function add_front_body_class($classes)
{
	if (is_front_page()) {
		$classes[] = 'is-front';
	}
	return $classes;
}
add_filter('body_class', 'add_front_body_class');