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
  $user_info['Sass02'] = 'Sass02';
  $user_info['Sass03'] = 'Sass03';
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
  $user_info['WP02'] = 'WP02';
  $user_info['WP03'] = 'WP03';
  // SEO
  $user_info['SEO01'] = 'SEO01';

  // React
  $user_info['React01'] = 'React01';
  $user_info['React01__5'] = 'React01__5';
  $user_info['React02_1'] = 'React02_1';
  $user_info['React02_2'] = 'React02_2';
  $user_info['React02_3'] = 'React02_3';
  $user_info['React02_4'] = 'React02_4';
  $user_info['React02_5'] = 'React02_5';
  $user_info['React02_6'] = 'React02_6';
  $user_info['React02_7'] = 'React02_7';
  $user_info['React02_8'] = 'React02_8';
  $user_info['React02_9'] = 'React02_9';
  $user_info['React03_1'] = 'React03_1';
  $user_info['React03_2'] = 'React03_2';
  $user_info['React03_3'] = 'React03_3';
  $user_info['React03_4'] = 'React03_4';
  $user_info['React03__5'] = 'React03__5';
  $user_info['React04'] = 'React04';
  $user_info['React04_1'] = 'React04_1';
  $user_info['React04_2'] = 'React04_2';
  $user_info['React04_3'] = 'React04_3';
  $user_info['React04_4'] = 'React04_4';
  $user_info['React04_5'] = 'React04_5';
  $user_info['React04_6'] = 'React04_6';
  $user_info['React05'] = 'React05';
  $user_info['React06'] = 'React06';
  $user_info['React06_1'] = 'React06_1';
  $user_info['React06_2'] = 'React06_2';
  $user_info['React06_3'] = 'React06_3';
  $user_info['React06_4'] = 'React06_4';
  $user_info['React06_5'] = 'React06_5';
  $user_info['React07'] = 'React07';
  $user_info['React08'] = 'React08';
  $user_info['React09'] = 'React09';
  $user_info['React09_1'] = 'React09_1';
  $user_info['React09_2'] = 'React09_2';
  $user_info['React09_3'] = 'React09_3';
  $user_info['React09_4'] = 'React09_4';
  $user_info['React09_5'] = 'React09_5';
  $user_info['React09_6'] = 'React09_6';
  $user_info['React10'] = 'React10';
  $user_info['React11'] = 'React11';


  // Java
  $user_info['Java01'] = 'Java01';
  $user_info['Java02'] = 'Java02';
  $user_info['Java03'] = 'Java03';
  $user_info['Java04'] = 'Java04';
  $user_info['Java05'] = 'Java05';
  $user_info['Java06'] = 'Java06';
  $user_info['Java07'] = 'Java07';
  $user_info['Java08'] = 'Java08';
  $user_info['Java09'] = 'Java09';
  $user_info['Java10'] = 'Java10';
  $user_info['Java11'] = 'Java11';
  $user_info['Java12'] = 'Java12';
  $user_info['Java_object_01'] = 'Java_object_01';
  $user_info['Java_object_02'] = 'Java_object_02';
  $user_info['Java_object_03'] = 'Java_object_03';
  $user_info['Java_object_04'] = 'Java_object_04';
  $user_info['Java_object_05'] = 'Java_object_05';
  $user_info['Java_app_01'] = 'Java_app_01';
  $user_info['Java_app_02'] = 'Java_app_02';
  $user_info['Java_app_03'] = 'Java_app_03';
  $user_info['Java_app_04'] = 'Java_app_04';
  $user_info['Java_app_05'] = 'Java_app_05';
  $user_info['Java_app_06'] = 'Java_app_06';
  $user_info['Java_springBoot_01'] = 'Java_springBoot_01';
  $user_info['Java_springBoot_02'] = 'Java_springBoot_02';
  $user_info['Java_springBoot_03'] = 'Java_springBoot_03';
  $user_info['Java_springBoot_04'] = 'Java_springBoot_04';
  $user_info['Java_springBoot_05'] = 'Java_springBoot_05';
  $user_info['Java_springBoot_06'] = 'Java_springBoot_06';
  $user_info['Java_springBoot_07'] = 'Java_springBoot_07';
  $user_info['Java_springBoot_08'] = 'Java_springBoot_08';
  $user_info['Java_springBoot_09'] = 'Java_springBoot_09';
  $user_info['Java_springBoot_10'] = 'Java_springBoot_10';
  $user_info['Java_springBoot_11'] = 'Java_springBoot_11';
  $user_info['Java_WebsoketSTOMP_01'] = 'Java_WebsoketSTOMP_01';
  $user_info['Java_WebsoketSTOMP_02'] = 'Java_WebsoketSTOMP_02';
  $user_info['Java_WebsoketSTOMP_03'] = 'Java_WebsoketSTOMP_03';
  $user_info['Java_WebsoketSTOMP_04'] = 'Java_WebsoketSTOMP_04';
  $user_info['Java_WebsoketSTOMP_05'] = 'Java_WebsoketSTOMP_05';
  $user_info['Java_WebsoketSTOMP_06'] = 'Java_WebsoketSTOMP_06';


  // Design
  $user_info['Design01'] = 'Design01';
  $user_info['Design01_2'] = 'Design01_2';
  $user_info['Design02'] = 'Design02';
  $user_info['Design02_2'] = 'Design02_2';
  $user_info['Design02_3'] = 'Design02_3';
  $user_info['Design02_4'] = 'Design02_4';
  $user_info['Design02_5'] = 'Design02_5';
  $user_info['Design02_6'] = 'Design02_6';
  $user_info['Design03'] = 'Design03';
  $user_info['Design03_2'] = 'Design03_2';
  $user_info['Design03_3'] = 'Design03_3';
  $user_info['Design03_4'] = 'Design03_4';
  $user_info['Design04'] = 'Design04';
  $user_info['Design04_2'] = 'Design04_2';
  $user_info['Design04_3'] = 'Design04_3';
  $user_info['Design04_4'] = 'Design04_4';
  $user_info['Design04_4_1'] = 'Design04_4_1';
  $user_info['Design04_4_2'] = 'Design04_4_2';
  $user_info['Design04_4_3'] = 'Design04_4_3';
  $user_info['Design05'] = 'Design05';
  $user_info['Design06'] = 'Design06';
  $user_info['Design06_2'] = 'Design06_2';
  $user_info['Design07'] = 'Design07';
  $user_info['Design07_2'] = 'Design07_2';
  $user_info['Design07_3'] = 'Design07_3';
  $user_info['Design07_4'] = 'Design07_4';
  $user_info['Design08'] = 'Design08';
  $user_info['Design08_2'] = 'Design08_2';
  $user_info['Design09'] = 'Design09';
  $user_info['Design09_2'] = 'Design09_2';
  $user_info['Design09_3'] = 'Design09_3';




  return $user_info;
}

// ツールバーデフォルト非表示
add_filter('show_admin_bar', '__return_false');

?>