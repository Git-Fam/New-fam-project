<?php

// 別サイト投稿用のURL（例: /news/kindergarten/）でクエリ変数を有効化
function archive_add_query_vars($vars)
{
	$vars[] = 'external_archive';
	$vars[] = 'front_news';
	return $vars;
}
add_filter('query_vars', 'archive_add_query_vars');

function archive_add_rewrite_rules()
{
	add_rewrite_rule('^news/kindergarten/?$', 'index.php?post_type=post&external_archive=kindergarten', 'top');
}
add_action('init', 'archive_add_rewrite_rules');

// パーマリンク保存時にフラッシュ（管理画面で一度「設定＞パーマリンク」を保存すると反映されます）
function archive_flush_on_activation()
{
	archive_add_rewrite_rules();
	flush_rewrite_rules();
}

// /news/ またはカテゴリアーカイブのページ送りでメインクエリが0件だと404になるため、200でアーカイブを表示する
function archive_prevent_404_on_paged()
{
	if (!is_404()) {
		return;
	}
	$paged = (int) get_query_var('paged');
	$post_type = get_query_var('post_type');
	$external = get_query_var('external_archive');
	$cat = get_query_var('cat');
	$category_name = get_query_var('category_name');
	$is_news_paged = ($paged >= 1 || $external) && ($post_type === 'post' || $external);
	$is_category_paged = $paged >= 1 && ($cat || $category_name);
	if (!$is_news_paged && !$is_category_paged) {
		return;
	}
	status_header(200);
}
add_action('template_redirect', 'archive_prevent_404_on_paged', 1);

function archive_serve_archive_template_on_paged($template)
{
	if (!is_404()) {
		return $template;
	}
	$paged = (int) get_query_var('paged');
	$post_type = get_query_var('post_type');
	$external = get_query_var('external_archive');
	$cat = get_query_var('cat');
	$category_name = get_query_var('category_name');
	$is_news_paged = ($paged >= 1 || $external) && ($post_type === 'post' || $external);
	$is_category_paged = $paged >= 1 && ($cat || $category_name);
	if (!$is_news_paged && !$is_category_paged) {
		return $template;
	}
	$archive_template = locate_template(array('archives/archive.php'));
	if ($archive_template) {
		return $archive_template;
	}
	return $template;
}
add_filter('template_include', 'archive_serve_archive_template_on_paged', 99);

// アーカイブのテンプレートを変更する

function custom_archive_template($template)
{
	$new_template = '';

	$archive_templates = array(
		// 'blog' => 'archives/archive-blog.php',
		// 'column' => 'archives/archive-column.php',
		// 他のカスタム投稿タイプやアーカイブタイプをここに追加
	);

	foreach ($archive_templates as $post_type => $template_path) {
		if (is_post_type_archive($post_type)) {
			$new_template = locate_template(array($template_path));
			break;
		}
	}

	if (empty($new_template) && is_archive()) {
		$new_template = locate_template(array('archives/archive.php'));
	}

	if (!empty($new_template)) {
		return $new_template;
	}

	return $template;
}
add_filter('archive_template', 'custom_archive_template');
