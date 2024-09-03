<?php

// 欄追加
add_filter('user_contactmethods', 'add_user_info');
function add_user_info(){
  $user_info = array();
  // divパズル
  $user_info['div01'] = 'Div01';
  $user_info['div02'] = 'Div02';
  $user_info['div03'] = 'Div03';
  $user_info['div04'] = 'Div04';
  $user_info['div05'] = 'Div05';
  $user_info['div06'] = 'Div06';
  $user_info['div07'] = 'Div07';
  $user_info['responsive'] = 'responsive';
  // JQ
  $user_info['JQ01'] = 'JQ01';
  $user_info['JQ02'] = 'JQ02';
  $user_info['JQ03'] = 'JQ03';
  $user_info['JQ04'] = 'JQ04';
  $user_info['JQ05'] = 'JQ05';
  $user_info['JQ06'] = 'JQ06';
  $user_info['JQ07'] = 'JQ07';
  $user_info['JQ08'] = 'JQ08';
  $user_info['JQ09'] = 'JQ09';
  $user_info['JQ10'] = 'JQ10';
  $user_info['JQLast'] = 'JQLast';
  // LP
  $user_info['LP01'] = 'LP01';
  // Sass
  $user_info['Sass01'] = 'Sass01';
  // Form
  $user_info['Form01'] = 'Form01';
  // FAM
  $user_info['FAM01'] = 'FAM01';
  // test
  $user_info['test01'] = 'test01';
  // JS
  $user_info['JS01'] = 'JS01';
  // WP
  $user_info['WP01'] = 'WP01';
  // SEO
  $user_info['SEO01'] = 'SEO01';


  return $user_info;
}

// ツールバーデフォルト非表示
add_filter('show_admin_bar', '__return_false');

?>