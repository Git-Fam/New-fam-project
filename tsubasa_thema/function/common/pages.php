<?php

// ページのテンプレートを変更する
function custom_page_template($template)
{
	$new_template = '';

	$page_templates = array(
		'about' => 'pages/page-about',
		'about-surgery' => 'pages/page-about-surgery',
		'schedule' => 'pages/page-schedule',
		'pediatric-surgery' => 'pages/page-pediatric-surgery',
		'pediatrics' => 'pages/page-pediatrics',
		'constipation' => 'pages/page-constipation',
		'nocturia' => 'pages/page-nocturia',
		'prevention-screening' => 'pages/page-prevention-screening',
		'visit-clinic' => 'pages/page-visit-clinic',
		'contact' => 'pages/page-contact',
		'recruit' => 'pages/page-recruit',
		'faq' => 'pages/page-faq',
		'privacy-policy' => 'pages/page-privacy-policy',
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

