<?php

// ページのテンプレートを変更する
function custom_page_template($template)
{
	$new_template = '';

	// is_page() はパス指定（親/子）でもマッチするため、
	// 子ページは 'junior/admission' のように親付きパスで判定する。
	$page_templates = array(
		// 学校案内（共通）
		'about'               => 'pages/page-about',
		'about/concept'       => 'pages/page-concept',
		'about/history'       => 'pages/page-history',
		'about/facility'      => 'pages/page-facility',
		'about/uniform'       => 'pages/page-uniform',

		// 中学校
		'junior'              => 'pages/page-junior',
		'junior/declaration'  => 'pages/page-junior-declaration',
		'junior/students'     => 'pages/page-junior-students',
		'junior/admission'    => 'pages/page-junior-admission',
		'junior/life'         => 'pages/page-junior-life',
		'junior/club'         => 'pages/page-junior-club',
		'junior/feature'      => 'pages/page-junior-feature',
		'junior/openschool'   => 'pages/page-junior-openschool',

		// 高等学校
		'high'                => 'pages/page-high',
		'high/why'            => 'pages/page-high-why',
		'high/course'         => 'pages/page-high-course',
		'high/changed'        => 'pages/page-high-changed',
		'high/admission'      => 'pages/page-high-admission',
		'high/life'           => 'pages/page-high-life',
		'high/club'           => 'pages/page-high-club',
		'high/career'         => 'pages/page-high-career',
		'high/feature'        => 'pages/page-high-feature',
		'high/openschool'     => 'pages/page-high-openschool',

		// その他（共通）
		'recruit'             => 'pages/page-recruit',
		'alumni'              => 'pages/page-alumni',
		'request'             => 'pages/page-request',
		'contact'             => 'pages/page-contact',
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
