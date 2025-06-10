<?php

// 欄追加
add_filter('user_contactmethods', 'add_user_info');
function add_user_info(){
  $user_info = array();
  // divパズル
  $user_info['ENV0'] = 'ENV0';
  $user_info['ENV01'] = 'ENV01';
  $user_info['ENV02'] = 'ENV02';
  $user_info['ENV03'] = 'ENV03';
  $user_info['VAL01'] = 'VAL01';
  $user_info['VAL02'] = 'VAL02';
  $user_info['VAL03'] = 'VAL03';
  $user_info['INIT01'] = 'INIT01';
  $user_info['INIT02'] = 'INIT02';
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
  // LP
  $user_info['MiniLP01'] = 'MiniLP01';
  $user_info['LP01'] = 'LP01';

  // Sass
  $user_info['Sass01'] = 'Sass01';
  $user_info['Sass02'] = 'Sass02';
  $user_info['Sass03'] = 'Sass03';
  // Form
  $user_info['Form01'] = 'Form01';
  // FAM
  $user_info['FAM01'] = 'FAM01';
  $user_info['FAM02'] = 'FAM02';
  $user_info['FAM03'] = 'FAM03';
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
  $user_info['React02__5'] = 'React02__5';
  $user_info['React03_1'] = 'React03_1';
  $user_info['React03_2'] = 'React03_2';
  $user_info['React03_3'] = 'React03_3';
  $user_info['React03_4'] = 'React03_4';
  $user_info['React03_5'] = 'React03_5';
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

  //TypeScript
  $user_info['React12'] = 'React12';
  $user_info['React13_1'] = 'React13_1';
  $user_info['React13_2'] = 'React13_2';
  $user_info['React13_3'] = 'React13_3';
  $user_info['React14_1'] = 'React14_1';
  $user_info['React14_2'] = 'React14_2';
  $user_info['React15'] = 'React15';
  $user_info['React15__5'] = 'React15__5';
  $user_info['React16'] = 'React16';
  $user_info['React17'] = 'React17';
  $user_info['React18_1'] = 'React18_1';
  $user_info['React18_2'] = 'React18_2';
  $user_info['React18_3'] = 'React18_3';
  $user_info['React18_4'] = 'React18_4';
  $user_info['React19'] = 'React19';

  // Java
  $user_info['Java0'] = 'Java0';
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
  $user_info['Java_springBoot_12'] = 'Java_springBoot_12';
  $user_info['Java_springBoot_13'] = 'Java_springBoot_13';
  $user_info['Java_WebsoketSTOMP_01'] = 'Java_WebsoketSTOMP_01';
  $user_info['Java_WebsoketSTOMP_02'] = 'Java_WebsoketSTOMP_02';
  $user_info['Java_WebsoketSTOMP_03'] = 'Java_WebsoketSTOMP_03';
  $user_info['Java_WebsoketSTOMP_04'] = 'Java_WebsoketSTOMP_04';
  $user_info['Java_WebsoketSTOMP_05'] = 'Java_WebsoketSTOMP_05';
  $user_info['Java_WebsoketSTOMP_06'] = 'Java_WebsoketSTOMP_06';

  //SQL
  $user_info['SQL01'] = 'SQL01';
  $user_info['SQL02'] = 'SQL02';
  $user_info['SQL03'] = 'SQL03';
  $user_info['SQL04'] = 'SQL04';
  $user_info['SQL_ex01'] = 'SQL_ex01';
  $user_info['SQL05'] = 'SQL05';
  $user_info['SQL06'] = 'SQL06';
  $user_info['SQL07'] = 'SQL07';
  $user_info['SQL_ex02'] = 'SQL_ex02';
  $user_info['SQL08_1'] = 'SQL08_1';
  $user_info['SQL08_2'] = 'SQL08_2';
  $user_info['SQL09_1'] = 'SQL09_1';
  $user_info['SQL09_2'] = 'SQL09_2';
  $user_info['SQL09_3'] = 'SQL09_3';
  $user_info['SQL09_4'] = 'SQL09_4';
  $user_info['SQL_ex03'] = 'SQL_ex03';
  $user_info['SQL10_1'] = 'SQL10_1';
  $user_info['SQL10_2'] = 'SQL10_2';
  $user_info['SQL10_3'] = 'SQL10_3';
  $user_info['SQL11_1'] = 'SQL11_1';
  $user_info['SQL11_2'] = 'SQL11_2';
  $user_info['SQL11_3'] = 'SQL11_3';
  $user_info['SQL12'] = 'SQL12';
  $user_info['SQL_ex04'] = 'SQL_ex04';
  $user_info['SQL13_1'] = 'SQL13_1';
  $user_info['SQL13_2'] = 'SQL13_2';
  $user_info['SQL14_1'] = 'SQL14_1';
  $user_info['SQL14_2'] = 'SQL14_2';
  $user_info['SQL15'] = 'SQL15';
  $user_info['SQL_ex05'] = 'SQL_ex05';
  $user_info['SQL16'] = 'SQL16';
  $user_info['SQL_last'] = 'SQL_last';
            



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

  //設計書
  $user_info['Spec01'] = 'Spec01';

  //WordPress
  $user_info['wordpress01'] = 'wordpress01';
  $user_info['wordpress02'] = 'wordpress02';
  $user_info['wordpress03'] = 'wordpress03';
  $user_info['wordpress04'] = 'wordpress04';
  $user_info['wordpress05'] = 'wordpress05';
  $user_info['wordpress06'] = 'wordpress06';
  $user_info['wordpress07'] = 'wordpress07';
  $user_info['wordpress08'] = 'wordpress08';
  $user_info['wordpress09'] = 'wordpress09';
  $user_info['wordpress10'] = 'wordpress10';

  return $user_info;
}

// ツールバーデフォルト非表示
add_filter('show_admin_bar', '__return_false');

?>