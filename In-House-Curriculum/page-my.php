<?php

// 現在ログインしているユーザーのIDを取得
$user_id = get_current_user_id();

// ユーザーのメタデータの値を取得。デフォルト値は0。
// Div
$ENV0_value = get_user_meta($user_id, 'ENV0', true) ?: '0';
$ENV01_value = get_user_meta($user_id, 'ENV01', true) ?: '0';
$ENV02_value = get_user_meta($user_id, 'ENV02', true) ?: '0';
$ENV03_value = get_user_meta($user_id, 'ENV03', true) ?: '0';
$VAL01_value = get_user_meta($user_id, 'VAL01', true) ?: '0';
$VAL02_value = get_user_meta($user_id, 'VAL02', true) ?: '0';
$VAL03_value = get_user_meta($user_id, 'VAL03', true) ?: '0';
$INIT01_value = get_user_meta($user_id, 'INIT01', true) ?: '0';
$INIT02_value = get_user_meta($user_id, 'INIT02', true) ?: '0';
$div01_value = get_user_meta($user_id, 'div01', true) ?: '0';
$div02_value = get_user_meta($user_id, 'div02', true) ?: '0';
$div03_value = get_user_meta($user_id, 'div03', true) ?: '0';
$div04_value = get_user_meta($user_id, 'div04', true) ?: '0';
$div05_value = get_user_meta($user_id, 'div05', true) ?: '0';
$div06_value = get_user_meta($user_id, 'div06', true) ?: '0';
$div07_value = get_user_meta($user_id, 'div07', true) ?: '0';
$responsive_value = get_user_meta($user_id, 'responsive', true) ?: '0';

// JQ
$JQ01_value = get_user_meta($user_id, 'JQ01', true) ?: '0';
$JQ02_value = get_user_meta($user_id, 'JQ02', true) ?: '0';
$JQ03_value = get_user_meta($user_id, 'JQ03', true) ?: '0';
$JQ04_value = get_user_meta($user_id, 'JQ04', true) ?: '0';
$JQ05_value = get_user_meta($user_id, 'JQ05', true) ?: '0';
$JQ06_value = get_user_meta($user_id, 'JQ06', true) ?: '0';

// LP
$MiniLP_value = get_user_meta($user_id, 'MiniLP', true) ?: '0';
$LP01_value = get_user_meta($user_id, 'LP01', true) ?: '0';


// Sass
$Sass01_value = get_user_meta($user_id, 'Sass01', true) ?: '0';
$Sass02_value = get_user_meta($user_id, 'Sass02', true) ?: '0';
$Sass03_value = get_user_meta($user_id, 'Sass03', true) ?: '0';

// Form
$Form01_value = get_user_meta($user_id, 'Form01', true) ?: '0';

// FAM
$FAM01_value = get_user_meta($user_id, 'FAM01', true) ?: '0';
$FAM02_value = get_user_meta($user_id, 'FAM02', true) ?: '0';
$FAM03_value = get_user_meta($user_id, 'FAM03', true) ?: '0';

// test
$test01_value = get_user_meta($user_id, 'test01', true) ?: '0';

// JS
$JS01_value = get_user_meta($user_id, 'JS01', true) ?: '0';

// SEO
$SEO01_value = get_user_meta($user_id, 'SEO01', true) ?: '0';

// React
$React01_value = get_user_meta($user_id, 'React01', true) ?: '0';
$React01__5_value = get_user_meta($user_id, 'React01__5', true) ?: '0';
$React02_1_value = get_user_meta($user_id, 'React02_1', true) ?: '0';
$React02_2_value = get_user_meta($user_id, 'React02_2', true) ?: '0';
$React02_3_value = get_user_meta($user_id, 'React02_3', true) ?: '0';
$React02_4_value = get_user_meta($user_id, 'React02_4', true) ?: '0';
$React02_5_value = get_user_meta($user_id, 'React02_5', true) ?: '0';
$React02_6_value = get_user_meta($user_id, 'React02_6', true) ?: '0';
$React02_7_value = get_user_meta($user_id, 'React02_7', true) ?: '0';
$React02_8_value = get_user_meta($user_id, 'React02_8', true) ?: '0';
$React02_9_value = get_user_meta($user_id, 'React02_9', true) ?: '0';
$React02__5_value = get_user_meta($user_id, 'React02__5', true) ?: '0';
$React03_1_value = get_user_meta($user_id, 'React03_1', true) ?: '0';
$React03_2_value = get_user_meta($user_id, 'React03_2', true) ?: '0';
$React03_3_value = get_user_meta($user_id, 'React03_3', true) ?: '0';
$React03_4_value = get_user_meta($user_id, 'React03_4', true) ?: '0';
$React03_5_value = get_user_meta($user_id, 'React03_5', true) ?: '0';
$React03__5_value = get_user_meta($user_id, 'React03__5', true) ?: '0';
$React04_value = get_user_meta($user_id, 'React04', true) ?: '0';
$React04_1_value = get_user_meta($user_id, 'React04_1', true) ?: '0';
$React04_2_value = get_user_meta($user_id, 'React04_2', true) ?: '0';
$React04_3_value = get_user_meta($user_id, 'React04_3', true) ?: '0';
$React04_4_value = get_user_meta($user_id, 'React04_4', true) ?: '0';
$React04_5_value = get_user_meta($user_id, 'React04_5', true) ?: '0';
$React04_6_value = get_user_meta($user_id, 'React04_6', true) ?: '0';
$React05_value = get_user_meta($user_id, 'React05', true) ?: '0';
$React06_value = get_user_meta($user_id, 'React06', true) ?: '0';
$React06_1_value = get_user_meta($user_id, 'React06_1', true) ?: '0';
$React06_2_value = get_user_meta($user_id, 'React06_2', true) ?: '0';
$React06_3_value = get_user_meta($user_id, 'React06_3', true) ?: '0';
$React06_4_value = get_user_meta($user_id, 'React06_4', true) ?: '0';
$React06_5_value = get_user_meta($user_id, 'React06_5', true) ?: '0';
$React07_value = get_user_meta($user_id, 'React07', true) ?: '0';
$React08_value = get_user_meta($user_id, 'React08', true) ?: '0';
$React09_value = get_user_meta($user_id, 'React09', true) ?: '0';
$React09_1_value = get_user_meta($user_id, 'React09_1', true) ?: '0';
$React09_2_value = get_user_meta($user_id, 'React09_2', true) ?: '0';
$React09_3_value = get_user_meta($user_id, 'React09_3', true) ?: '0';
$React09_4_value = get_user_meta($user_id, 'React09_4', true) ?: '0';
$React09_5_value = get_user_meta($user_id, 'React09_5', true) ?: '0';
$React09_6_value = get_user_meta($user_id, 'React09_6', true) ?: '0';
$React10_value = get_user_meta($user_id, 'React10', true) ?: '0';
$React11_value = get_user_meta($user_id, 'React11', true) ?: '0';

//TypeScript
$React12_value = get_user_meta($user_id, 'React12', true) ?: '0';
$React13_1_value = get_user_meta($user_id, 'React13_1', true) ?: '0';
$React13_2_value = get_user_meta($user_id, 'React13_2', true) ?: '0';
$React13_3_value = get_user_meta($user_id, 'React13_3', true) ?: '0';
$React14_1_value = get_user_meta($user_id, 'React14_1', true) ?: '0';
$React14_2_value = get_user_meta($user_id, 'React14_2', true) ?: '0';
$React15_value = get_user_meta($user_id, 'React15', true) ?: '0';
$React15__5_value = get_user_meta($user_id, 'React15__5', true) ?: '0';
$React16_value = get_user_meta($user_id, 'React16', true) ?: '0';
$React17_value = get_user_meta($user_id, 'React17', true) ?: '0';
$React18_1_value = get_user_meta($user_id, 'React18_1', true) ?: '0';
$React18_2_value = get_user_meta($user_id, 'React18_2', true) ?: '0';
$React18_3_value = get_user_meta($user_id, 'React18_3', true) ?: '0';
$React18_4_value = get_user_meta($user_id, 'React18_4', true) ?: '0';
$React19_value = get_user_meta($user_id, 'React19', true) ?: '0';


// Java
$Java0_value = get_user_meta($user_id, 'Java0', true) ?: '0';
$Java01_value = get_user_meta($user_id, 'Java01', true) ?: '0';
$Java02_value = get_user_meta($user_id, 'Java02', true) ?: '0';
$Java03_value = get_user_meta($user_id, 'Java03', true) ?: '0';
$Java04_value = get_user_meta($user_id, 'Java04', true) ?: '0';
$Java05_value = get_user_meta($user_id, 'Java05', true) ?: '0';
$Java06_value = get_user_meta($user_id, 'Java06', true) ?: '0';
$Java07_value = get_user_meta($user_id, 'Java07', true) ?: '0';
$Java08_value = get_user_meta($user_id, 'Java08', true) ?: '0';
$Java09_value = get_user_meta($user_id, 'Java09', true) ?: '0';
$Java10_value = get_user_meta($user_id, 'Java10', true) ?: '0';
$Java11_value = get_user_meta($user_id, 'Java11', true) ?: '0';
$Java12_value = get_user_meta($user_id, 'Java12', true) ?: '0';
$Java_object_01_value = get_user_meta($user_id, 'Java_object_01', true) ?: '0';
$Java_object_02_value = get_user_meta($user_id, 'Java_object_02', true) ?: '0';
$Java_object_03_value = get_user_meta($user_id, 'Java_object_03', true) ?: '0';
$Java_object_04_value = get_user_meta($user_id, 'Java_object_04', true) ?: '0';
$Java_object_05_value = get_user_meta($user_id, 'Java_object_05', true) ?: '0';
$Java_app_01_value = get_user_meta($user_id, 'Java_app_01', true) ?: '0';
$Java_app_02_value = get_user_meta($user_id, 'Java_app_02', true) ?: '0';
$Java_app_03_value = get_user_meta($user_id, 'Java_app_03', true) ?: '0';
$Java_app_04_value = get_user_meta($user_id, 'Java_app_04', true) ?: '0';
$Java_app_05_value = get_user_meta($user_id, 'Java_app_05', true) ?: '0';
$Java_app_06_value = get_user_meta($user_id, 'Java_app_06', true) ?: '0';
$Java_springBoot_01_value = get_user_meta($user_id, 'Java_springBoot_01', true) ?: '0';
$Java_springBoot_02_value = get_user_meta($user_id, 'Java_springBoot_02', true) ?: '0';
$Java_springBoot_03_value = get_user_meta($user_id, 'Java_springBoot_03', true) ?: '0';
$Java_springBoot_04_value = get_user_meta($user_id, 'Java_springBoot_04', true) ?: '0';
$Java_springBoot_05_value = get_user_meta($user_id, 'Java_springBoot_05', true) ?: '0';
$Java_springBoot_06_value = get_user_meta($user_id, 'Java_springBoot_06', true) ?: '0';
$Java_springBoot_07_value = get_user_meta($user_id, 'Java_springBoot_07', true) ?: '0';
$Java_springBoot_08_value = get_user_meta($user_id, 'Java_springBoot_08', true) ?: '0';
$Java_springBoot_09_value = get_user_meta($user_id, 'Java_springBoot_09', true) ?: '0';
$Java_springBoot_10_value = get_user_meta($user_id, 'Java_springBoot_10', true) ?: '0';
$Java_springBoot_11_value = get_user_meta($user_id, 'Java_springBoot_11', true) ?: '0';
$Java_springBoot_12_value = get_user_meta($user_id, 'Java_springBoot_12', true) ?: '0';
$Java_springBoot_13_value = get_user_meta($user_id, 'Java_springBoot_13', true) ?: '0';
$Java_WebsoketSTOMP_01_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_01', true) ?: '0';
$Java_WebsoketSTOMP_02_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_02', true) ?: '0';
$Java_WebsoketSTOMP_03_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_03', true) ?: '0';
$Java_WebsoketSTOMP_04_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_04', true) ?: '0';
$Java_WebsoketSTOMP_05_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_05', true) ?: '0';
$Java_WebsoketSTOMP_06_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_06', true) ?: '0';
$Java_SpringBatch_01_value =  get_user_meta($user_id, 'Java_SpringBatch_01', true) ?: '0';
$Java_SpringBatch_02_value =  get_user_meta($user_id, 'Java_SpringBatch_02', true) ?: '0';
$Java_SpringBatch_03_value =  get_user_meta($user_id, 'Java_SpringBatch_03', true) ?: '0';
$Java_SpringBatch_04_value =  get_user_meta($user_id, 'Java_SpringBatch_04', true) ?: '0';
$Java_SpringBatch_05_value =  get_user_meta($user_id, 'Java_SpringBatch_05', true) ?: '0';
$Java_Test_01_value =  get_user_meta($user_id, 'Java_Test_01', true) ?: '0';
$Java_Test_02_value =  get_user_meta($user_id, 'Java_Test_02', true) ?: '0';
$Java_Test_03_value =  get_user_meta($user_id, 'Java_Test_03', true) ?: '0';
$Java_Test_04_value =  get_user_meta($user_id, 'Java_Test_04', true) ?: '0';
$Java_Test_05_value =  get_user_meta($user_id, 'Java_Test_05', true) ?: '0';
$Java_Test_06_value =  get_user_meta($user_id, 'Java_Test_06', true) ?: '0';
$Java_Test_07_value =  get_user_meta($user_id, 'Java_Test_07', true) ?: '0';
$Java_Test_08_value =  get_user_meta($user_id, 'Java_Test_08', true) ?: '0';
$Java_Test_09_value =  get_user_meta($user_id, 'Java_Test_09', true) ?: '0';
$Java_Test_10_value =  get_user_meta($user_id, 'Java_Test_10', true) ?: '0';
$Java_Test_11_value =  get_user_meta($user_id, 'Java_Test_11', true) ?: '0';
$Java_Test_12_value =  get_user_meta($user_id, 'Java_Test_12', true) ?: '0';

//SQL
$SQL01_value = get_user_meta($user_id, 'SQL01', true) ?: '0';
$SQL02_value = get_user_meta($user_id, 'SQL02', true) ?: '0';
$SQL03_value = get_user_meta($user_id, 'SQL03', true) ?: '0';
$SQL04_value = get_user_meta($user_id, 'SQL04', true) ?: '0';
$SQL_ex01_value = get_user_meta($user_id, 'SQL_ex01', true) ?: '0';
$SQL05_value = get_user_meta($user_id, 'SQL05', true) ?: '0';
$SQL06_value = get_user_meta($user_id, 'SQL06', true) ?: '0';
$SQL07_value = get_user_meta($user_id, 'SQL07', true) ?: '0';
$SQL_ex02_value = get_user_meta($user_id, 'SQL_ex02', true) ?: '0';
$SQL08_1_value = get_user_meta($user_id, 'SQL08_1', true) ?: '0';
$SQL08_2_value = get_user_meta($user_id, 'SQL08_2', true) ?: '0';
$SQL09_1_value = get_user_meta($user_id, 'SQL09_1', true) ?: '0';
$SQL09_2_value = get_user_meta($user_id, 'SQL09_2', true) ?: '0';
$SQL09_3_value = get_user_meta($user_id, 'SQL09_3', true) ?: '0';
$SQL09_4_value = get_user_meta($user_id, 'SQL09_4', true) ?: '0';
$SQL_ex03_value = get_user_meta($user_id, 'SQL_ex03', true) ?: '0';
$SQL10_1_value = get_user_meta($user_id, 'SQL10_1', true) ?: '0';
$SQL10_2_value = get_user_meta($user_id, 'SQL10_2', true) ?: '0';
$SQL10_3_value = get_user_meta($user_id, 'SQL10_3', true) ?: '0';
$SQL11_1_value = get_user_meta($user_id, 'SQL11_1', true) ?: '0';
$SQL11_2_value = get_user_meta($user_id, 'SQL11_2', true) ?: '0';
$SQL11_3_value = get_user_meta($user_id, 'SQL11_3', true) ?: '0';
$SQL12_value = get_user_meta($user_id, 'SQL12', true) ?: '0';
$SQL_ex04_value = get_user_meta($user_id, 'SQL_ex04', true) ?: '0';
$SQL13_1_value = get_user_meta($user_id, 'SQL13_1', true) ?: '0';
$SQL13_2_value = get_user_meta($user_id, 'SQL13_2', true) ?: '0';
$SQL14_1_value = get_user_meta($user_id, 'SQL14_1', true) ?: '0';
$SQL14_2_value = get_user_meta($user_id, 'SQL14_2', true) ?: '0';
$SQL15_value = get_user_meta($user_id, 'SQL15', true) ?: '0';
$SQL_ex05_value = get_user_meta($user_id, 'SQL_ex05', true) ?: '0';
$SQL16_value = get_user_meta($user_id, 'SQL16', true) ?: '0';
$SQL_last_value = get_user_meta($user_id, 'SQL_last', true) ?: '0';


// Design
$Design01_value = get_user_meta($user_id, 'Design01', true) ?: '0';
$Design01_2_value = get_user_meta($user_id, 'Design01_2', true) ?: '0';
$Design02_value = get_user_meta($user_id, 'Design02', true) ?: '0';
$Design02_2_value = get_user_meta($user_id, 'Design02_2', true) ?: '0';
$Design02_3_value = get_user_meta($user_id, 'Design02_3', true) ?: '0';
$Design02_4_value = get_user_meta($user_id, 'Design02_4', true) ?: '0';
$Design02_5_value = get_user_meta($user_id, 'Design02_5', true) ?: '0';
$Design02_6_value = get_user_meta($user_id, 'Design02_6', true) ?: '0';
$Design03_value = get_user_meta($user_id, 'Design03', true) ?: '0';
$Design03_2_value = get_user_meta($user_id, 'Design03_2', true) ?: '0';
$Design03_3_value = get_user_meta($user_id, 'Design03_3', true) ?: '0';
$Design03_4_value = get_user_meta($user_id, 'Design03_4', true) ?: '0';
$Design04_value = get_user_meta($user_id, 'Design04', true) ?: '0';
$Design04_2_value = get_user_meta($user_id, 'Design04_2', true) ?: '0';
$Design04_3_value = get_user_meta($user_id, 'Design04_3', true) ?: '0';
$Design04_4_value = get_user_meta($user_id, 'Design04_4', true) ?: '0';
$Design04_4_1_value = get_user_meta($user_id, 'Design04_4_1', true) ?: '0';
$Design04_4_2_value = get_user_meta($user_id, 'Design04_4_2', true) ?: '0';
$Design04_4_3_value = get_user_meta($user_id, 'Design04_4_3', true) ?: '0';
$Design05_value = get_user_meta($user_id, 'Design05', true) ?: '0';
$Design06_value = get_user_meta($user_id, 'Design06', true) ?: '0';
$Design06_2_value = get_user_meta($user_id, 'Design06_2', true) ?: '0';
$Design07_value = get_user_meta($user_id, 'Design07', true) ?: '0';
$Design07_2_value = get_user_meta($user_id, 'Design07_2', true) ?: '0';
$Design07_3_value = get_user_meta($user_id, 'Design07_3', true) ?: '0';
$Design07_4_value = get_user_meta($user_id, 'Design07_4', true) ?: '0';
$Design08_value = get_user_meta($user_id, 'Design08', true) ?: '0';
$Design08_2_value = get_user_meta($user_id, 'Design08_2', true) ?: '0';
$Design09_value = get_user_meta($user_id, 'Design09', true) ?: '0';
$Design09_2_value = get_user_meta($user_id, 'Design09_2', true) ?: '0';
$Design09_3_value = get_user_meta($user_id, 'Design09_3', true) ?: '0';

// 設計書
$Spec01_value = get_user_meta($user_id, 'Spec01', true) ?: '0';

//ワードプレス
$wordpress01_value = get_user_meta($user_id, 'wordpress01', true) ?: '0';
$wordpress02_value = get_user_meta($user_id, 'wordpress02', true) ?: '0';
$wordpress03_value = get_user_meta($user_id, 'wordpress03', true) ?: '0';
$wordpress04_value = get_user_meta($user_id, 'wordpress04', true) ?: '0';
$wordpress05_value = get_user_meta($user_id, 'wordpress05', true) ?: '0';
$wordpress06_value = get_user_meta($user_id, 'wordpress06', true) ?: '0';
$wordpress07_value = get_user_meta($user_id, 'wordpress07', true) ?: '0';
$wordpress08_value = get_user_meta($user_id, 'wordpress08', true) ?: '0';
$wordpress09_value = get_user_meta($user_id, 'wordpress09', true) ?: '0';
$wordpress10_value = get_user_meta($user_id, 'wordpress10', true) ?: '0';

//JSTQB
$jstqb0_value = get_user_meta($user_id, 'jstqb0', true) ?: '0';
$jstqb01_1_value = get_user_meta($user_id, 'jstqb01_1', true) ?: '0';
$jstqb01_2_value = get_user_meta($user_id, 'jstqb01_2', true) ?: '0';
$jstqb01_3_value = get_user_meta($user_id, 'jstqb01_3', true) ?: '0';
$jstqb01_4_value = get_user_meta($user_id, 'jstqb01_4', true) ?: '0';
$jstqb01_5_value = get_user_meta($user_id, 'jstqb01_5', true) ?: '0';
$jstqb02_1_value = get_user_meta($user_id, 'jstqb02_1', true) ?: '0';
$jstqb02_2_value = get_user_meta($user_id, 'jstqb02_2', true) ?: '0';
$jstqb02_3_value = get_user_meta($user_id, 'jstqb02_3', true) ?: '0';
$jstqb03_1_value = get_user_meta($user_id, 'jstqb03_1', true) ?: '0';
$jstqb03_2_value = get_user_meta($user_id, 'jstqb03_2', true) ?: '0';
$jstqb04_1_value = get_user_meta($user_id, 'jstqb04_1', true) ?: '0';
$jstqb04_2_value = get_user_meta($user_id, 'jstqb04_2', true) ?: '0';
$jstqb04_3_value = get_user_meta($user_id, 'jstqb04_3', true) ?: '0';
$jstqb04_4_value = get_user_meta($user_id, 'jstqb04_4', true) ?: '0';
$jstqb04_5_value = get_user_meta($user_id, 'jstqb04_5', true) ?: '0';
$jstqb05_1_value = get_user_meta($user_id, 'jstqb05_1', true) ?: '0';
$jstqb05_2_value = get_user_meta($user_id, 'jstqb05_2', true) ?: '0';
$jstqb05_3_value = get_user_meta($user_id, 'jstqb05_3', true) ?: '0';
$jstqb05_4_value = get_user_meta($user_id, 'jstqb05_4', true) ?: '0';
$jstqb05_5_value = get_user_meta($user_id, 'jstqb05_5', true) ?: '0';
$jstqb06_1_value = get_user_meta($user_id, 'jstqb06_1', true) ?: '0';
$jstqb06_2_value = get_user_meta($user_id, 'jstqb06_2', true) ?: '0';

?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>
<!-- page-my -->

<div class="my">
    <div class="my--inner">
        <div class="my--title">
            <div class="my--title--title">
                <h2 class="TL">マイページ</h2>
            </div>
            <div class="my--title--name">
                <p class="TX">
                    <!-- ユーザーネーム -->
                    <?php
                    $current_user = wp_get_current_user();
                    echo $current_user->user_login;
                    ?>
                </p>

                <!-- バッジ -->
                <?php badge_display(); ?>

            </div>
            <div class="my--title--points">
                <div class="coin-point">
                    <p class="TX">現在の獲得コイン:
                        <span>
                            <?php
                            $user_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
                            echo esc_html($user_coins);
                            ?>&nbsp;coins
                        </span>
                    </p>
                </div>
                <div class="coin-point">
                    <p class="TX">現在の獲得ポイント:
                        <span>
                            <?php
                            $user_id = get_current_user_id();
                            $user_points = get_user_meta($user_id, 'user_point', true) ?: 0;
                            echo esc_html($user_points);
                            ?>&nbsp;points
                        </span>
                    </p>
                </div>

                <div class="coin-point">
                    <p class="TX">連続ログイン日数:
                        <span>
                            <?php
                            $user_id = get_current_user_id();
                            $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true) ?: 0;
                            echo esc_html($consecutive_login_days);
                            ?>&nbsp;日
                        </span>
                    </p>
                </div>

                <!-- 優先チケット -->
                <?php display_priority_ticket(); ?>

                <!-- 連続１０日ログインボーナス -->
                <?php display_login_bonus(); ?>

            </div>
            <div class="C_character js-character-edit">
                <?php display_character(); ?>
                <a class="clothes--change__button" href="<?php bloginfo('url'); ?>/avatar">編集する</a>
            </div>
        </div>

        <div class="my--info">
            <div class="bbs">
                <div class="chicken">
                    <div class="chicken--serif">
                        <?php
                        $recent_news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 1,
                            'date_query' => array(
                                array(
                                    // ３日間
                                    'after' => '72 hours ago'
                                )
                            )
                        ));
                        if ($recent_news_query->have_posts()) :
                        ?>
                            <p class="TX">新着のお知らせがあるよ！</p>
                        <?php else : ?>
                            <p class="TX">お知らせだよ！</p>
                        <?php endif; ?>
                    </div>
                    <div class="chicken--bird">
                        <iframe src="https://lottie.host/embed/421d3b3d-d381-49ba-b751-5d7dc96c02c8/XLrfuoTBb0.json"></iframe>
                    </div>
                </div>
                <div class="bbs--content">
                    <div class="title">
                        <h2 class="TL">お知らせ</h2>
                    </div>
                    <ul class="sentence">
                        <?php
                        $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 5, // 表示する投稿数
                        ));
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                        ?>
                                <li>
                                    <p class="time"><?php echo get_the_date('Y.m.d'); ?></p>
                                    <p class="text"><?php the_title(); ?></p>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <li>
                                <p class="text">お知らせはありません。</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="spy">
                <div class="mole">
                    <iframe src="https://lottie.host/embed/b4994f66-3673-48c5-a9f8-a2dc72b38c6e/eWk4vLyDMj.json"></iframe>
                </div>
                <div class="spy--text">
                    <div class="spy--text--serif">
                        <p class="TX">
                            <?php
                            $latest_post = new WP_Query(array(
                                'post_type' => 'column',
                                'posts_per_page' => 1,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            $nothing_echo = "コラムだよ！";

                            if ($latest_post->have_posts()) {
                                $latest_post->the_post();
                                $post_categories = get_the_terms(get_the_ID(), 'column-cat');
                                if ($post_categories && !is_wp_error($post_categories)) {
                                    $category = array_shift($post_categories);
                                    $category_description = $category->description;
                                    if (!empty($category_description)) {
                                        echo esc_html($category_description);
                                    } else {
                                        echo $nothing_echo;
                                    }
                                } else {
                                    echo $nothing_echo;
                                }
                                wp_reset_postdata();
                            } else {
                                echo $nothing_echo;
                            }
                            ?>
                        </p>
                    </div>
                    <div class="spy--text--column">
                        <a href="<?php bloginfo('url'); ?>/column">コラムを見に行く ▶</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="info_button sp">
            <p class="TX">
                お知らせ
            </p>
        </div>

        <div class="my--content">
            <div class="pageClip">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
            </div>
            <div class="my--content--container">
                <div class="my--content--page page--1"></div>
                <div class="my--content--page page--2"></div>
                <div class="my--content--page page--3"></div>
                <div class="tab tab--1 active">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">進</span>
                        <span class="TX-span">捗</span>
                        <span class="TX-span">更</span>
                        <span class="TX-span">新</span>
                    </p>
                </div>
                <div class="tab tab--2">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">会</span>
                        <span class="TX-span">員</span>
                        <span class="TX-span">情</span>
                        <span class="TX-span">報</span>
                    </p>
                </div>
                <div class="gorilla"></div>

                <div class="tab--content">
                    <!-- 進捗更新 -->
                    <div class="tab--content--progress active">
                        <!-- ログイン中のみ表示 -->
                        <?php if (is_user_logged_in()): ?>
                            <!-- <form class="progress" action="/test-hp-2/registered" method="post"> -->
                            <form class="progress" action="<?php echo home_url('/registered'); ?>" method="post">
                                <div class="progress--content">
                                    <!-- HTML -->
                                    <div class="item active">
                                        <div class="progress--title">
                                            <h3 class="TL">HTML</h3>
                                        </div>
                                        <div class="progress--update">
                                        <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築について</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($ENV0_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="ENV0" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($ENV0_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築①　GitとSourcetree</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($ENV01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="ENV01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($ENV01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築②　VSコード</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($ENV02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="ENV02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($ENV02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築③　ブラウザ</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($ENV03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="ENV03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($ENV03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証ツール（デベロッパーツール）の使い方</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($VAL01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="VAL01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($VAL01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証をしてみよう！</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($VAL02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="VAL02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($VAL02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証の重要性</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($VAL03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="VAL03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($VAL03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>HTML/CSSとは</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($INIT01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="INIT01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($INIT01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>学習をはじめる前に</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($INIT02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="INIT02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($INIT02_value); ?>" />
                                            </div>
                                        
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div04_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div05_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div06_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div07_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>responsive</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($responsive_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="responsive" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($responsive_value); ?>" />
                                            </div>

                                        </div>
                                    </div>

                                    <!-- JQuery -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">JQuery</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ04_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ05_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ06_value); ?>" />
                                            </div>

                                        </div>
                                    </div>

                                    <!-- LP -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">LP</h3>
                                        </div>

                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>ミニサイト制作</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($MiniLP_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="MiniLP" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($MiniLP_value); ?>" />
                                            </div>
                                        </div>

                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>LP</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($LP01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="LP01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($LP01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sass -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Sass</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Sass01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Sass01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Sass01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Sass02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Sass02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Sass02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Sass03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Sass03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Sass03_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Form</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Form</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Form01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Form01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Form01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAM -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">FAM</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM-クリニック</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($FAM01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="FAM01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($FAM01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM-占い</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($FAM02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="FAM02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($FAM02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM-さくらんぼ</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($FAM03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="FAM03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($FAM03_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- test -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">test</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>test</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($test01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="test01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($test01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- JavaScript -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">JavaScript</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JavaScript</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JS01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JS01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JS01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Word Press -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Word Press</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($wordpress10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="wordpress10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($wordpress10_value); ?>" />
                                            </div>

                                        </div>
                                    </div>

                                    <!-- SEO -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">SEO</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SEO</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SEO01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SEO01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SEO01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- React  -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">React</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React01.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React01__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React01__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React01__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02⑦</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_7_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_7" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_7_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02⑧</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_8_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_8" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_8_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React02⑨</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02_9_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02_9" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02_9_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React 2.5 基礎マスターガイド</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React02__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React02__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React02__5_value); ?>" />
                                            </div>


                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03_4_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03_5_value); ?>" />
                                            </div>
                                            
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React03.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React03__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React03__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React03__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React04⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React04_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React04_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React04_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React06⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React06_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React06_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React06_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React09⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React09_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React09_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React09_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React11_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TypeScript -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">TypeScript</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React13①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React13_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React13_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React13_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React13②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React13_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React13_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React13_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React13③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React13_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React13_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React13_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React14①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React14_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React14_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React14_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React14②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React14_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React14_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React14_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React15</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React15_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React15" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React15_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React15.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React15__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React15__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React15__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React16</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React16_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React16" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React16_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React17</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React17_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React17" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React17_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React18①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React18_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React18_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React18_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React18②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React18_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React18_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React18_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React18③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React18_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React18_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React18_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React18④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React18_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React18_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React18_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>React19</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($React19_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="React19" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($React19_value); ?>" />
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Java -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Java</h3>
                                        </div>
                                        <div class="progress--update">

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>はじめに</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java0_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java0" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java0_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java11_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java オブジェクト指向1</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_object_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_object_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_object_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java オブジェクト指向2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_object_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_object_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_object_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java オブジェクト指向3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_object_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_object_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_object_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java オブジェクト指向4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_object_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_object_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_object_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java オブジェクト指向5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_object_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_object_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_object_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java アプリ06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_app_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_app_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_app_06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_11_value); ?>" />
                                            </div>
                                            <!-- <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java SpringBoot13</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_springBoot_13_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_springBoot_13" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_springBoot_13_value); ?>" />
                                            </div> -->

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP1</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Websoket・STOMP6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_WebsoketSTOMP_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_WebsoketSTOMP_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_WebsoketSTOMP_06_value); ?>" />
                                            </div>
                                            <!-- <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Spring Batch01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_SpringBatch_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_SpringBatch_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_SpringBatch_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Spring Batch02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_SpringBatch_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_SpringBatch_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_SpringBatch_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Spring Batch03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_SpringBatch_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_SpringBatch_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_SpringBatch_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Spring Batch04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_SpringBatch_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_SpringBatch_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_SpringBatch_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Spring Batch05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_SpringBatch_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_SpringBatch_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_SpringBatch_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_04_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_05_value); ?>" />
                                            </div> 
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_06_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_07_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java Test08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_08_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_09_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_10_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_11_value); ?>" />
                                            </div>  

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Java  Test12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Java_Test_12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Java_Test_12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Java_Test_12_value); ?>" />
                                            </div>   -->
                                        </div>
                                    </div>

                                    <!-- SQL -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">SQL</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 演習問題①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_ex01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_ex01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_ex01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 演習問題②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_ex02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_ex02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_ex02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL08①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL08_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL08_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL08_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL08②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL08_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL08_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL08_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL09①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL09_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL09_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL09_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL09②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL09③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL09_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL09④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL09_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL09_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL09_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 演習問題③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_ex03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_ex03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_ex03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL10①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL10_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL10_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL10_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL10②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL10_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL10_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL10_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL10③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL10_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL10_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL10_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL11①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL11_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL11_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL11_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL11②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL11_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL11_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL11_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL11③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL11_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL11_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL11_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 演習問題④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_ex04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_ex04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_ex04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL13①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL13_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL13_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL13_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL13②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL13_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL13_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL13_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL14①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL14_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL14_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL14_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL14②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL14_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL14_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL14_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL15</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL15_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL15" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL15_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 演習問題⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_ex05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_ex05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_ex05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL16</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL16_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL16" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL16_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SQL 最終問題</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SQL_last_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SQL_last" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SQL_last_value); ?>" />
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Design -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Design</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design1</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design1-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design01_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design01_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design01_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2-5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design2-6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design02_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design02_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design02_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design3-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design03_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design03_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design03_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design3-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design03_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design03_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design03_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design3-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design03_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design03_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design03_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-4-①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_4_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_4_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_4_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-4-②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_4_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_4_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_4_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design4-4-③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design04_4_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design04_4_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design04_4_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design6-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design06_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design06_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design06_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design7</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design7-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design07_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design07_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design07_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design7-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design07_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design07_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design07_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design7-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design07_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design07_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design07_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design8</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design8-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design08_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design08_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design08_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design9</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design9-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Design9-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Design09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Design09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Design09_3_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 設計書 -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">設計書</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>設計書を作成しよう</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Spec01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Spec01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Spec01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="progress--TOC">
                                    <ul class="progress--TOC--ul">
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX active">・HTML</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・jQuery</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・LP</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Sass</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Form</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・FAM</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・test</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・JavaScript</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Word Press</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・SEO</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・React</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・TypeScript</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Java</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・SQL</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Design</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・設計書</p>
                                        </li>
                                    </ul>
                                </div>



                                <div class="progress--submit">
                                    <input type="submit" value="更新">
                                </div>

                            </form>
                        <?php endif; ?>
                        <!-- ログインしていないトップにリダイレクト -->
                        <?php if (!is_user_logged_in()): ?>
                            <p class="TX">ログインしていません。</p>
                        <?php endif; ?>
                    </div>
                    <!-- 会員情報 -->
                    <div class="tab--content--membership">
                        <?php echo do_shortcode('[swpm_profile_form]'); ?>
                    </div>
                </div>

            </div>
            <a class="logout--button" href="?swpm-logout=true">ログアウト</a>
        </div>

        <!-- ログイン中のみ表示 -->
        <?php if (is_user_logged_in()): ?>
            <a class="curriculum--btn" href="<?php bloginfo('url'); ?>/curriculum">
                <p class="TX">カリキュラム<br>一覧</p>
            </a>
        <?php endif; ?>

    </div>

    <div class="my--menu-btn">
        <?php get_template_part('inc/first-btn'); ?>
        <?php get_template_part('inc/menu-btn'); ?>
    </div>

    <!-- ログインボーナス -->
    <?php log_board(); ?>

    <!-- 連続ログインボーナス -->
    <?php continuous_board(); ?>

    <!-- カムバックボーナス -->
    <?php comeback_board(); ?>


</div>

<?php get_footer(); ?>