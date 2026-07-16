<?php

// ページのテンプレートを変更する
function custom_page_template($template)
{
	$new_template = '';

	$page_templates = array(
		'offroad' => 'pages/page-offroad',
		'message' => 'pages/page-message',
		'strength' => 'pages/page-strength',
		'product' => 'pages/page-product',
		'factory' => 'pages/page-factory',
		'recruit-index' => 'pages/page-recruit-index',
		'requirements' => 'pages/page-requirements',
		'entry-mid' => 'pages/page-entry-mid',
		'entry-new' => 'pages/page-entry-new',
		'company' => 'pages/page-company',
		'contact' => 'pages/page-contact',
		'sdgs' => 'pages/page-sdgs',
		'policy' => 'pages/page-policy',
		'security' => 'pages/page-security',
		'english' => 'pages/page-english',
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

