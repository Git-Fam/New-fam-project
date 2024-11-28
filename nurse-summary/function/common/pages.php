<?php

// ページのテンプレートを変更する
function custom_page_template($template)
{
	$new_template = '';

	$page_templates = array(
		'comparison' => 'pages/page-comparison',
		'terms' => 'pages/page-terms',
		'privacy-policy' => 'pages/page-privacy-policy',
		'company' => 'pages/page-company',
		'survey' => 'pages/page-survey',
		'edit' => 'pages/page-edit',
		// 複数ある場合は以下に追加していく
	);

	foreach ($page_templates as $page_slug => $template_path) {
		if (is_page($page_slug)) {
			$new_template = locate_template(array($template_path));
			break;
		}
	}

	if (!empty($new_template)) {
		return $new_template;
	}

	return $template;
}
add_filter('page_template', 'custom_page_template');

