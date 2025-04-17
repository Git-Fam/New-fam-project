<?php

// ページのテンプレートを変更する
function custom_page_template($template)
{
	$new_template = '';

	$page_templates = array(
		// 複数ある場合は以下に追加していく
		'service' => 'pages/page-service',
		'contact' => 'pages/page-contact',
		'contact-confirm' => 'pages/page-contact-confirm',
		'contact-complete' => 'pages/page-contact-complete',
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

