<?php

// アーカイブのテンプレートを変更する

function custom_archive_template($template)
{
	$new_template = '';

	$archive_templates = array(
		'column' => 'archives/archive-column.php',
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