<?php

// シングルのテンプレートを変更する
function custom_single_template($template)
{
	$new_template = '';

	$single_templates = array(
		'column' => 'singles/single-column.php',
		// 他のカスタム投稿タイプをここに追加
	);

	foreach ($single_templates as $post_type => $template_path) {
		if (is_singular($post_type)) {
			$new_template = locate_template(array($template_path));
			break;
		}
	}

	if (empty($new_template) && is_single()) {
		$new_template = locate_template(array('singles/single.php'));
	}

	if (!empty($new_template)) {
		return $new_template;
	}

	return $template;
}
add_filter('single_template', 'custom_single_template');
