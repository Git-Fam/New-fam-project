<?php

// 現在ログインしているユーザーのIDを取得
$user_id = get_current_user_id();


// ユーザーのメタデータの値を取得。デフォルト値は0。
// カテゴリーを取得（並び替え順に従う）
$categories = get_categories(array(
    'orderby' => 'term_order',
    'order' => 'ASC',
    'hide_empty' => false
));

// 各カテゴリーごとにタグの値を取得
foreach ($categories as $category) {
    // カテゴリー内の投稿を取得（menu_order順）
    $posts = get_posts(array(
        'post_type' => 'post',
        'category_name' => $category->slug,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    // 投稿ごとにタグを取得して値を取得
    foreach ($posts as $post) {
        $post_tags = wp_get_object_terms($post->ID, 'post_tag', array(
            'orderby' => 'term_order',
            'order' => 'ASC'
        ));

        if (!is_wp_error($post_tags) && !empty($post_tags)) {
            foreach ($post_tags as $tag) {
                // タグのスラッグ名を変数名として使用（小文字に統一）
                $var_name = $tag->slug . '_value';
                // ユーザーメタデータから値を取得（デフォルトは'0'）
                $$var_name = get_user_meta($user_id, $tag->slug, true) ?: '0';
            }
        }
    }
}

// // Div
// $ENV0_value = get_user_meta($user_id, 'ENV0', true) ?: '0';
// $ENV01_value = get_user_meta($user_id, 'ENV01', true) ?: '0';
// $ENV02_value = get_user_meta($user_id, 'ENV02', true) ?: '0';
// $ENV03_value = get_user_meta($user_id, 'ENV03', true) ?: '0';
// $VAL01_value = get_user_meta($user_id, 'VAL01', true) ?: '0';
// $VAL02_value = get_user_meta($user_id, 'VAL02', true) ?: '0';
// $VAL03_value = get_user_meta($user_id, 'VAL03', true) ?: '0';
// $INIT01_value = get_user_meta($user_id, 'INIT01', true) ?: '0';
// $INIT02_value = get_user_meta($user_id, 'INIT02', true) ?: '0';
// $div01_value = get_user_meta($user_id, 'div01', true) ?: '0';
// $div02_value = get_user_meta($user_id, 'div02', true) ?: '0';
// $div03_value = get_user_meta($user_id, 'div03', true) ?: '0';
// $div04_value = get_user_meta($user_id, 'div04', true) ?: '0';
// $div05_value = get_user_meta($user_id, 'div05', true) ?: '0';
// $div06_value = get_user_meta($user_id, 'div06', true) ?: '0';
// $div07_value = get_user_meta($user_id, 'div07', true) ?: '0';
// $responsive_value = get_user_meta($user_id, 'responsive', true) ?: '0';

// // JQ
// $JQ01_value = get_user_meta($user_id, 'JQ01', true) ?: '0';
// $JQ02_value = get_user_meta($user_id, 'JQ02', true) ?: '0';
// $JQ03_value = get_user_meta($user_id, 'JQ03', true) ?: '0';
// $JQ04_value = get_user_meta($user_id, 'JQ04', true) ?: '0';
// $JQ05_value = get_user_meta($user_id, 'JQ05', true) ?: '0';
// $JQ06_value = get_user_meta($user_id, 'JQ06', true) ?: '0';

// // LP
// $MiniLP_value = get_user_meta($user_id, 'MiniLP', true) ?: '0';
// $LP01_value = get_user_meta($user_id, 'LP01', true) ?: '0';


// // Sass
// $Sass01_value = get_user_meta($user_id, 'Sass01', true) ?: '0';
// $Sass02_value = get_user_meta($user_id, 'Sass02', true) ?: '0';
// $Sass03_value = get_user_meta($user_id, 'Sass03', true) ?: '0';

// // Form
// $Form01_value = get_user_meta($user_id, 'Form01', true) ?: '0';

// // FAM
// $fam01_value = get_user_meta($user_id, 'fam01', true) ?: '0';
// $fam02_value = get_user_meta($user_id, 'fam02', true) ?: '0';
// $fam03_value = get_user_meta($user_id, 'fam03', true) ?: '0';

// // test
// $test01_value = get_user_meta($user_id, 'test01', true) ?: '0';

// // JS
// $JS01_value = get_user_meta($user_id, 'JS01', true) ?: '0';

// // SEO
// $SEO01_value = get_user_meta($user_id, 'SEO01', true) ?: '0';

// // React
// $React01_value = get_user_meta($user_id, 'React01', true) ?: '0';
// $React01__5_value = get_user_meta($user_id, 'React01__5', true) ?: '0';
// $React02_1_value = get_user_meta($user_id, 'React02_1', true) ?: '0';
// $React02_2_value = get_user_meta($user_id, 'React02_2', true) ?: '0';
// $React02_3_value = get_user_meta($user_id, 'React02_3', true) ?: '0';
// $React02_4_value = get_user_meta($user_id, 'React02_4', true) ?: '0';
// $React02_5_value = get_user_meta($user_id, 'React02_5', true) ?: '0';
// $React02_6_value = get_user_meta($user_id, 'React02_6', true) ?: '0';
// $React02_7_value = get_user_meta($user_id, 'React02_7', true) ?: '0';
// $React02_8_value = get_user_meta($user_id, 'React02_8', true) ?: '0';
// $React02_9_value = get_user_meta($user_id, 'React02_9', true) ?: '0';
// $React02__5_value = get_user_meta($user_id, 'React02__5', true) ?: '0';
// $React03_1_value = get_user_meta($user_id, 'React03_1', true) ?: '0';
// $React03_2_value = get_user_meta($user_id, 'React03_2', true) ?: '0';
// $React03_3_value = get_user_meta($user_id, 'React03_3', true) ?: '0';
// $React03_4_value = get_user_meta($user_id, 'React03_4', true) ?: '0';
// $React03_5_value = get_user_meta($user_id, 'React03_5', true) ?: '0';
// $React03__5_value = get_user_meta($user_id, 'React03__5', true) ?: '0';
// $React04_value = get_user_meta($user_id, 'React04', true) ?: '0';
// $React04_1_value = get_user_meta($user_id, 'React04_1', true) ?: '0';
// $React04_2_value = get_user_meta($user_id, 'React04_2', true) ?: '0';
// $React04_3_value = get_user_meta($user_id, 'React04_3', true) ?: '0';
// $React04_4_value = get_user_meta($user_id, 'React04_4', true) ?: '0';
// $React04_5_value = get_user_meta($user_id, 'React04_5', true) ?: '0';
// $React04_6_value = get_user_meta($user_id, 'React04_6', true) ?: '0';
// $React05_value = get_user_meta($user_id, 'React05', true) ?: '0';
// $React06_value = get_user_meta($user_id, 'React06', true) ?: '0';
// $React06_1_value = get_user_meta($user_id, 'React06_1', true) ?: '0';
// $React06_2_value = get_user_meta($user_id, 'React06_2', true) ?: '0';
// $React06_3_value = get_user_meta($user_id, 'React06_3', true) ?: '0';
// $React06_4_value = get_user_meta($user_id, 'React06_4', true) ?: '0';
// $React06_5_value = get_user_meta($user_id, 'React06_5', true) ?: '0';
// $React07_value = get_user_meta($user_id, 'React07', true) ?: '0';
// $React08_value = get_user_meta($user_id, 'React08', true) ?: '0';
// $React09_value = get_user_meta($user_id, 'React09', true) ?: '0';
// $React09_1_value = get_user_meta($user_id, 'React09_1', true) ?: '0';
// $React09_2_value = get_user_meta($user_id, 'React09_2', true) ?: '0';
// $React09_3_value = get_user_meta($user_id, 'React09_3', true) ?: '0';
// $React09_4_value = get_user_meta($user_id, 'React09_4', true) ?: '0';
// $React09_5_value = get_user_meta($user_id, 'React09_5', true) ?: '0';
// $React09_6_value = get_user_meta($user_id, 'React09_6', true) ?: '0';
// $React10_value = get_user_meta($user_id, 'React10', true) ?: '0';
// $React11_value = get_user_meta($user_id, 'React11', true) ?: '0';

// //TypeScript
// $React12_value = get_user_meta($user_id, 'React12', true) ?: '0';
// $React13_1_value = get_user_meta($user_id, 'React13_1', true) ?: '0';
// $React13_2_value = get_user_meta($user_id, 'React13_2', true) ?: '0';
// $React13_3_value = get_user_meta($user_id, 'React13_3', true) ?: '0';
// $React14_1_value = get_user_meta($user_id, 'React14_1', true) ?: '0';
// $React14_2_value = get_user_meta($user_id, 'React14_2', true) ?: '0';
// $React15_value = get_user_meta($user_id, 'React15', true) ?: '0';
// $React15__5_value = get_user_meta($user_id, 'React15__5', true) ?: '0';
// $React16_value = get_user_meta($user_id, 'React16', true) ?: '0';
// $React17_value = get_user_meta($user_id, 'React17', true) ?: '0';
// $React18_1_value = get_user_meta($user_id, 'React18_1', true) ?: '0';
// $React18_2_value = get_user_meta($user_id, 'React18_2', true) ?: '0';
// $React18_3_value = get_user_meta($user_id, 'React18_3', true) ?: '0';
// $React18_4_value = get_user_meta($user_id, 'React18_4', true) ?: '0';
// $React19_value = get_user_meta($user_id, 'React19', true) ?: '0';


// // Java
// $Java0_value = get_user_meta($user_id, 'Java0', true) ?: '0';
// $Java01_value = get_user_meta($user_id, 'Java01', true) ?: '0';
// $Java02_value = get_user_meta($user_id, 'Java02', true) ?: '0';
// $Java03_value = get_user_meta($user_id, 'Java03', true) ?: '0';
// $Java04_value = get_user_meta($user_id, 'Java04', true) ?: '0';
// $Java05_value = get_user_meta($user_id, 'Java05', true) ?: '0';
// $Java06_value = get_user_meta($user_id, 'Java06', true) ?: '0';
// $Java07_value = get_user_meta($user_id, 'Java07', true) ?: '0';
// $Java08_value = get_user_meta($user_id, 'Java08', true) ?: '0';
// $Java09_value = get_user_meta($user_id, 'Java09', true) ?: '0';
// $Java10_value = get_user_meta($user_id, 'Java10', true) ?: '0';
// $Java11_value = get_user_meta($user_id, 'Java11', true) ?: '0';
// $Java12_value = get_user_meta($user_id, 'Java12', true) ?: '0';
// $Java_object_01_value = get_user_meta($user_id, 'Java_object_01', true) ?: '0';
// $Java_object_02_value = get_user_meta($user_id, 'Java_object_02', true) ?: '0';
// $Java_object_03_value = get_user_meta($user_id, 'Java_object_03', true) ?: '0';
// $Java_object_04_value = get_user_meta($user_id, 'Java_object_04', true) ?: '0';
// $Java_object_05_value = get_user_meta($user_id, 'Java_object_05', true) ?: '0';
// $Java_app_01_value = get_user_meta($user_id, 'Java_app_01', true) ?: '0';
// $Java_app_02_value = get_user_meta($user_id, 'Java_app_02', true) ?: '0';
// $Java_app_03_value = get_user_meta($user_id, 'Java_app_03', true) ?: '0';
// $Java_app_04_value = get_user_meta($user_id, 'Java_app_04', true) ?: '0';
// $Java_app_05_value = get_user_meta($user_id, 'Java_app_05', true) ?: '0';
// $Java_app_06_value = get_user_meta($user_id, 'Java_app_06', true) ?: '0';
// $Java_springBoot_01_value = get_user_meta($user_id, 'Java_springBoot_01', true) ?: '0';
// $Java_springBoot_02_value = get_user_meta($user_id, 'Java_springBoot_02', true) ?: '0';
// $Java_springBoot_03_value = get_user_meta($user_id, 'Java_springBoot_03', true) ?: '0';
// $Java_springBoot_04_value = get_user_meta($user_id, 'Java_springBoot_04', true) ?: '0';
// $Java_springBoot_05_value = get_user_meta($user_id, 'Java_springBoot_05', true) ?: '0';
// $Java_springBoot_06_value = get_user_meta($user_id, 'Java_springBoot_06', true) ?: '0';
// $Java_springBoot_07_value = get_user_meta($user_id, 'Java_springBoot_07', true) ?: '0';
// $Java_springBoot_08_value = get_user_meta($user_id, 'Java_springBoot_08', true) ?: '0';
// $Java_springBoot_09_value = get_user_meta($user_id, 'Java_springBoot_09', true) ?: '0';
// $Java_springBoot_10_value = get_user_meta($user_id, 'Java_springBoot_10', true) ?: '0';
// $Java_springBoot_11_value = get_user_meta($user_id, 'Java_springBoot_11', true) ?: '0';
// $Java_springBoot_12_value = get_user_meta($user_id, 'Java_springBoot_12', true) ?: '0';
// $Java_springBoot_13_value = get_user_meta($user_id, 'Java_springBoot_13', true) ?: '0';
// $Java_WebsoketSTOMP_01_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_01', true) ?: '0';
// $Java_WebsoketSTOMP_02_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_02', true) ?: '0';
// $Java_WebsoketSTOMP_03_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_03', true) ?: '0';
// $Java_WebsoketSTOMP_04_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_04', true) ?: '0';
// $Java_WebsoketSTOMP_05_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_05', true) ?: '0';
// $Java_WebsoketSTOMP_06_value = get_user_meta($user_id, 'Java_WebsoketSTOMP_06', true) ?: '0';
// $Java_SpringBatch_01_value =  get_user_meta($user_id, 'Java_SpringBatch_01', true) ?: '0';
// $Java_SpringBatch_02_value =  get_user_meta($user_id, 'Java_SpringBatch_02', true) ?: '0';
// $Java_SpringBatch_03_value =  get_user_meta($user_id, 'Java_SpringBatch_03', true) ?: '0';
// $Java_SpringBatch_04_value =  get_user_meta($user_id, 'Java_SpringBatch_04', true) ?: '0';
// $Java_SpringBatch_05_value =  get_user_meta($user_id, 'Java_SpringBatch_05', true) ?: '0';
// $Java_Test_01_value =  get_user_meta($user_id, 'Java_Test_01', true) ?: '0';
// $Java_Test_02_value =  get_user_meta($user_id, 'Java_Test_02', true) ?: '0';
// $Java_Test_03_value =  get_user_meta($user_id, 'Java_Test_03', true) ?: '0';
// $Java_Test_04_value =  get_user_meta($user_id, 'Java_Test_04', true) ?: '0';
// $Java_Test_05_value =  get_user_meta($user_id, 'Java_Test_05', true) ?: '0';
// $Java_Test_06_value =  get_user_meta($user_id, 'Java_Test_06', true) ?: '0';
// $Java_Test_07_value =  get_user_meta($user_id, 'Java_Test_07', true) ?: '0';
// $Java_Test_08_value =  get_user_meta($user_id, 'Java_Test_08', true) ?: '0';
// $Java_Test_09_value =  get_user_meta($user_id, 'Java_Test_09', true) ?: '0';
// $Java_Test_10_value =  get_user_meta($user_id, 'Java_Test_10', true) ?: '0';
// $Java_Test_11_value =  get_user_meta($user_id, 'Java_Test_11', true) ?: '0';
// $Java_Test_12_value =  get_user_meta($user_id, 'Java_Test_12', true) ?: '0';

// //SQL
// $SQL01_value = get_user_meta($user_id, 'SQL01', true) ?: '0';
// $SQL02_value = get_user_meta($user_id, 'SQL02', true) ?: '0';
// $SQL03_value = get_user_meta($user_id, 'SQL03', true) ?: '0';
// $SQL04_value = get_user_meta($user_id, 'SQL04', true) ?: '0';
// $SQL_ex01_value = get_user_meta($user_id, 'SQL_ex01', true) ?: '0';
// $SQL05_value = get_user_meta($user_id, 'SQL05', true) ?: '0';
// $SQL06_value = get_user_meta($user_id, 'SQL06', true) ?: '0';
// $SQL07_value = get_user_meta($user_id, 'SQL07', true) ?: '0';
// $SQL_ex02_value = get_user_meta($user_id, 'SQL_ex02', true) ?: '0';
// $SQL08_1_value = get_user_meta($user_id, 'SQL08_1', true) ?: '0';
// $SQL08_2_value = get_user_meta($user_id, 'SQL08_2', true) ?: '0';
// $SQL09_1_value = get_user_meta($user_id, 'SQL09_1', true) ?: '0';
// $SQL09_2_value = get_user_meta($user_id, 'SQL09_2', true) ?: '0';
// $SQL09_3_value = get_user_meta($user_id, 'SQL09_3', true) ?: '0';
// $SQL09_4_value = get_user_meta($user_id, 'SQL09_4', true) ?: '0';
// $SQL_ex03_value = get_user_meta($user_id, 'SQL_ex03', true) ?: '0';
// $SQL10_1_value = get_user_meta($user_id, 'SQL10_1', true) ?: '0';
// $SQL10_2_value = get_user_meta($user_id, 'SQL10_2', true) ?: '0';
// $SQL10_3_value = get_user_meta($user_id, 'SQL10_3', true) ?: '0';
// $SQL11_1_value = get_user_meta($user_id, 'SQL11_1', true) ?: '0';
// $SQL11_2_value = get_user_meta($user_id, 'SQL11_2', true) ?: '0';
// $SQL11_3_value = get_user_meta($user_id, 'SQL11_3', true) ?: '0';
// $SQL12_value = get_user_meta($user_id, 'SQL12', true) ?: '0';
// $SQL_ex04_value = get_user_meta($user_id, 'SQL_ex04', true) ?: '0';
// $SQL13_1_value = get_user_meta($user_id, 'SQL13_1', true) ?: '0';
// $SQL13_2_value = get_user_meta($user_id, 'SQL13_2', true) ?: '0';
// $SQL14_1_value = get_user_meta($user_id, 'SQL14_1', true) ?: '0';
// $SQL14_2_value = get_user_meta($user_id, 'SQL14_2', true) ?: '0';
// $SQL15_value = get_user_meta($user_id, 'SQL15', true) ?: '0';
// $SQL_ex05_value = get_user_meta($user_id, 'SQL_ex05', true) ?: '0';
// $SQL16_value = get_user_meta($user_id, 'SQL16', true) ?: '0';
// $SQL_last_value = get_user_meta($user_id, 'SQL_last', true) ?: '0';


// // Design
// $Design01_value = get_user_meta($user_id, 'Design01', true) ?: '0';
// $Design01_2_value = get_user_meta($user_id, 'Design01_2', true) ?: '0';
// $Design02_value = get_user_meta($user_id, 'Design02', true) ?: '0';
// $Design02_2_value = get_user_meta($user_id, 'Design02_2', true) ?: '0';
// $Design02_3_value = get_user_meta($user_id, 'Design02_3', true) ?: '0';
// $Design02_4_value = get_user_meta($user_id, 'Design02_4', true) ?: '0';
// $Design02_5_value = get_user_meta($user_id, 'Design02_5', true) ?: '0';
// $Design02_6_value = get_user_meta($user_id, 'Design02_6', true) ?: '0';
// $Design03_value = get_user_meta($user_id, 'Design03', true) ?: '0';
// $Design03_2_value = get_user_meta($user_id, 'Design03_2', true) ?: '0';
// $Design03_3_value = get_user_meta($user_id, 'Design03_3', true) ?: '0';
// $Design03_4_value = get_user_meta($user_id, 'Design03_4', true) ?: '0';
// $Design04_value = get_user_meta($user_id, 'Design04', true) ?: '0';
// $Design04_2_value = get_user_meta($user_id, 'Design04_2', true) ?: '0';
// $Design04_3_value = get_user_meta($user_id, 'Design04_3', true) ?: '0';
// $Design04_4_value = get_user_meta($user_id, 'Design04_4', true) ?: '0';
// $Design04_4_1_value = get_user_meta($user_id, 'Design04_4_1', true) ?: '0';
// $Design04_4_2_value = get_user_meta($user_id, 'Design04_4_2', true) ?: '0';
// $Design04_4_3_value = get_user_meta($user_id, 'Design04_4_3', true) ?: '0';
// $Design05_value = get_user_meta($user_id, 'Design05', true) ?: '0';
// $Design06_value = get_user_meta($user_id, 'Design06', true) ?: '0';
// $Design06_2_value = get_user_meta($user_id, 'Design06_2', true) ?: '0';
// $Design07_value = get_user_meta($user_id, 'Design07', true) ?: '0';
// $Design07_2_value = get_user_meta($user_id, 'Design07_2', true) ?: '0';
// $Design07_3_value = get_user_meta($user_id, 'Design07_3', true) ?: '0';
// $Design07_4_value = get_user_meta($user_id, 'Design07_4', true) ?: '0';
// $Design08_value = get_user_meta($user_id, 'Design08', true) ?: '0';
// $Design08_2_value = get_user_meta($user_id, 'Design08_2', true) ?: '0';
// $Design09_value = get_user_meta($user_id, 'Design09', true) ?: '0';
// $Design09_2_value = get_user_meta($user_id, 'Design09_2', true) ?: '0';
// $Design09_3_value = get_user_meta($user_id, 'Design09_3', true) ?: '0';

// // 設計書
// $Spec01_value = get_user_meta($user_id, 'Spec01', true) ?: '0';

// //ワードプレス
// $wordpress01_value = get_user_meta($user_id, 'wordpress01', true) ?: '0';
// $wordpress02_value = get_user_meta($user_id, 'wordpress02', true) ?: '0';
// $wordpress03_value = get_user_meta($user_id, 'wordpress03', true) ?: '0';
// $wordpress04_value = get_user_meta($user_id, 'wordpress04', true) ?: '0';
// $wordpress05_value = get_user_meta($user_id, 'wordpress05', true) ?: '0';
// $wordpress06_value = get_user_meta($user_id, 'wordpress06', true) ?: '0';
// $wordpress07_value = get_user_meta($user_id, 'wordpress07', true) ?: '0';
// $wordpress08_value = get_user_meta($user_id, 'wordpress08', true) ?: '0';
// $wordpress09_value = get_user_meta($user_id, 'wordpress09', true) ?: '0';
// $wordpress10_value = get_user_meta($user_id, 'wordpress10', true) ?: '0';

// //JSTQB
// $jstqb0_value = get_user_meta($user_id, 'jstqb0', true) ?: '0';
// $jstqb01_1_value = get_user_meta($user_id, 'jstqb01_1', true) ?: '0';
// $jstqb01_2_value = get_user_meta($user_id, 'jstqb01_2', true) ?: '0';
// $jstqb01_3_value = get_user_meta($user_id, 'jstqb01_3', true) ?: '0';
// $jstqb01_4_value = get_user_meta($user_id, 'jstqb01_4', true) ?: '0';
// $jstqb01_5_value = get_user_meta($user_id, 'jstqb01_5', true) ?: '0';
// $jstqb02_1_value = get_user_meta($user_id, 'jstqb02_1', true) ?: '0';
// $jstqb02_2_value = get_user_meta($user_id, 'jstqb02_2', true) ?: '0';
// $jstqb02_3_value = get_user_meta($user_id, 'jstqb02_3', true) ?: '0';
// $jstqb03_1_value = get_user_meta($user_id, 'jstqb03_1', true) ?: '0';
// $jstqb03_2_value = get_user_meta($user_id, 'jstqb03_2', true) ?: '0';
// $jstqb04_1_value = get_user_meta($user_id, 'jstqb04_1', true) ?: '0';
// $jstqb04_2_value = get_user_meta($user_id, 'jstqb04_2', true) ?: '0';
// $jstqb04_3_value = get_user_meta($user_id, 'jstqb04_3', true) ?: '0';
// $jstqb04_4_value = get_user_meta($user_id, 'jstqb04_4', true) ?: '0';
// $jstqb04_5_value = get_user_meta($user_id, 'jstqb04_5', true) ?: '0';
// $jstqb05_1_value = get_user_meta($user_id, 'jstqb05_1', true) ?: '0';
// $jstqb05_2_value = get_user_meta($user_id, 'jstqb05_2', true) ?: '0';
// $jstqb05_3_value = get_user_meta($user_id, 'jstqb05_3', true) ?: '0';
// $jstqb05_4_value = get_user_meta($user_id, 'jstqb05_4', true) ?: '0';
// $jstqb05_5_value = get_user_meta($user_id, 'jstqb05_5', true) ?: '0';
// $jstqb06_1_value = get_user_meta($user_id, 'jstqb06_1', true) ?: '0';
// $jstqb06_2_value = get_user_meta($user_id, 'jstqb06_2', true) ?: '0';

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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($env0_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="env0" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($env0_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築①　GitとSourcetree</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($env01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="env01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($env01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築②　VSコード</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($env02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="env02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($env02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>環境構築③　ブラウザ</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($env03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="env03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($env03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証ツール（デベロッパーツール）の使い方</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($val01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="val01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($val01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証をしてみよう！</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($val02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="val02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($val02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>検証の重要性</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($val03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="val03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($val03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>HTML/CSSとは</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($init01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="init01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($init01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>学習をはじめる前に</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($init02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="init02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($init02_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq04_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq05_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($jq06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="jq06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($jq06_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($minilp_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="minilp" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($minilp_value); ?>" />
                                            </div>
                                        </div>

                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>LP</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($lp01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="lp01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($lp01_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sass01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sass01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sass01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sass02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sass02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sass02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sass03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sass03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sass03_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($form01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="form01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($form01_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($fam01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="fam01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($fam01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM-占い</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($fam02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="fam02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($fam02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM-さくらんぼ</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($fam03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="fam03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($fam03_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($js01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="js01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($js01_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($seo01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="seo01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($seo01_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react01.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react01__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react01__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react01__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02⑦</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_7_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_7" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_7_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02⑧</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_8_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_8" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_8_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react02⑨</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02_9_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02_9" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02_9_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react 2.5 基礎マスターガイド</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react02__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react02__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react02__5_value); ?>" />
                                            </div>


                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03_4_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03_5_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react03.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react03__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react03__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react03__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react04⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react04_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react04_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react04_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react06⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react06_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react06_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react06_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react09⑥</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react09_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react09_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react09_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react11_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react13①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react13_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react13_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react13_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react13②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react13_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react13_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react13_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react13③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react13_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react13_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react13_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react14①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react14_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react14_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react14_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react14②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react14_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react14_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react14_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react15</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react15_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react15" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react15_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react15.5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react15__5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react15__5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react15__5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react16</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react16_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react16" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react16_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react17</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react17_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react17" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react17_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react18①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react18_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react18_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react18_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react18②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react18_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react18_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react18_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react18③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react18_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react18_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react18_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react18④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react18_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react18_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react18_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>react19</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($react19_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="react19" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($react19_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java0_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java0" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java0_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java11_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java オブジェクト指向1</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_object_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_object_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_object_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java オブジェクト指向2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_object_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_object_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_object_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java オブジェクト指向3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_object_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_object_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_object_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java オブジェクト指向4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_object_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_object_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_object_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java オブジェクト指向5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_object_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_object_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_object_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java アプリ06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_app_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_app_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_app_06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_10_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Springboot11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springboot_11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springboot_11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springboot_11_value); ?>" />
                                            </div>
                                            <!-- <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java SpringBoot12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springBoot_12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springBoot_12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springBoot_12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java SpringBoot13</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_springBoot_13_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_springBoot_13" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_springBoot_13_value); ?>" />
                                            </div> -->

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP1</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Websoket・STOMP6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_WebsoketSTOMP_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_WebsoketSTOMP_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_WebsoketSTOMP_06_value); ?>" />
                                            </div>
                                            <!-- <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Spring Batch01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_SpringBatch_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_SpringBatch_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_SpringBatch_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Spring Batch02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_SpringBatch_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_SpringBatch_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_SpringBatch_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Spring Batch03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_SpringBatch_03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_SpringBatch_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_SpringBatch_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Spring Batch04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_SpringBatch_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_SpringBatch_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_SpringBatch_04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Spring Batch05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_SpringBatch_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_SpringBatch_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_SpringBatch_05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_04_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_05_value); ?>" />
                                            </div> 
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_06_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_07_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java Test08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_08_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_09_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_10_value); ?>" />
                                            </div>  
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test11</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_11_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_11" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_11_value); ?>" />
                                            </div>  

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>java  Test12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($java_Test_12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="java_Test_12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($java_Test_12_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 演習問題①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_ex01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_ex01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_ex01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 演習問題②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_ex02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_ex02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_ex02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql08①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql08_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql08_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql08_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql08②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql08_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql08_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql08_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql09①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql09_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql09_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql09_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql09②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql09③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql09_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql09④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql09_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql09_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql09_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 演習問題③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_ex03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_ex03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_ex03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql10①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql10_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql10_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql10_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql10②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql10_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql10_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql10_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql10③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql10_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql10_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql10_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql11①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql11_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql11_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql11_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql11②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql11_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql11_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql11_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql11③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql11_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql11_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql11_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql12</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql12_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql12" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql12_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 演習問題④</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_ex04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_ex04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_ex04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql13①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql13_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql13_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql13_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql13②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql13_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql13_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql13_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql14①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql14_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql14_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql14_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql14②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql14_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql14_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql14_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql15</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql15_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql15" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql15_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 演習問題⑤</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_ex05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_ex05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_ex05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql16</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql16_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql16" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql16_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>sql 最終問題</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($sql_last_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="sql_last" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($sql_last_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design01_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design1-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design01_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design01_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design01_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2-5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_5_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02_5" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_5_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design2-6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design02_6_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design02_6" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design02_6_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design03_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design3-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design03_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design03_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design03_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design3-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design03_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design03_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design03_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design3-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design03_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design03_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design03_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-4-①</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_4_1_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_4_1" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_4_1_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-4-②</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_4_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_4_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_4_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design4-4-③</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design04_4_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design04_4_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design04_4_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design5</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design05_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design6</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design06_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design6-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design06_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design06_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design06_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design7</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design07_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design7-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design07_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design07_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design07_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design7-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design07_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design07_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design07_3_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design7-4</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design07_4_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design07_4" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design07_4_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design8</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design08_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design8-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design08_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design08_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design08_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design9</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design09_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design9-2</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design09_2_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design09_2" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design09_2_value); ?>" />
                                            </div>
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>design9-3</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($design09_3_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="design09_3" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($design09_3_value); ?>" />
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
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($spec01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="spec01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($spec01_value); ?>" />
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