<?php
// シングルのテンプレートを変更する（お知らせ = singles/single.php）
function custom_single_template($template)
{
	if (is_single()) {
		$new_template = locate_template(array('singles/single.php'));
		if (!empty($new_template)) {
			return $new_template;
		}
	}
	return $template;
}
add_filter('single_template', 'custom_single_template');