<?php

// global $wpdb;

// // 削除するメタキーの配列
// $meta_keys = array(
//     'env0', 'env01', 'env02', 'env03',
//     'val01', 'val02', 'val03',
//     'init01', 'init02',
//     'div01', 'div02', 'div03', 'div04', 'div05', 'div06', 'div07',
//     'responsive',
//     'ENV0', 'ENV01', 'ENV02', 'ENV03',
//     'VAL01', 'VAL02', 'VAL03',
//     'INIT01', 'INIT02',
//     'Responsive',
//     'JQ01', 'JQ02', 'JQ03', 'JQ04', 'JQ05', 'JQ06',
//     'jq01', 'jq02', 'jq03', 'jq04', 'jq05', 'jq06',
//     'MiniLP', 'minilp',
//     'LP01', 'lp01',
//     'Sass01', 'Sass02', 'Sass03',
//     'sass01', 'sass02', 'sass03',
//     'Form01', 'form01',
//     'Fam01', 'Fam02', 'Fam03',
//     'fam01', 'fam02', 'fam03',
//     'Test01', 'test01',
//     'JS01', 'js01',
//     'SEO01', 'seo01',
//     'React01', 'react01',
//     'React01__5', 'react01__5',
//     'React02_1', 'react02_1',
//     'React02_2', 'react02_2',
//     'React02_3', 'react02_3',
//     'React02_4', 'react02_4',
//     'React02_5', 'react02_5',
//     'React02_6', 'react02_6',
//     'React02_7', 'react02_7',
//     'React02_8', 'react02_8',
//     'React02_9', 'react02_9',
//     'React02__5', 'react02__5',
//     'React03_1', 'react03_1',
//     'React03_2', 'react03_2',
//     'React03_3', 'react03_3',
//     'React03_4', 'react03_4',
//     'React03_5', 'react03_5',
//     'React03__5', 'react03__5',
//     'React04', 'react04',
//     'React04_1', 'react04_1',
//     'React04_2', 'react04_2',
//     'React04_3', 'react04_3',
//     'React04_4', 'react04_4',
//     'React04_5', 'react04_5',
//     'React04_6', 'react04_6',
//     'React05', 'react05',
//     'React06', 'react06',
//     'React06_1', 'react06_1',
//     'React06_2', 'react06_2',
//     'React06_3', 'react06_3',
//     'React06_4', 'react06_4',
//     'React06_5', 'react06_5',
//     'React07', 'react07',
//     'React08', 'react08',
//     'React09', 'react09',
//     'React09_1', 'react09_1',
//     'React09_2', 'react09_2',
//     'React09_3', 'react09_3',
//     'React09_4', 'react09_4',
//     'React09_5', 'react09_5',
//     'React09_6', 'react09_6',
//     'React10', 'react10',
//     'React11', 'react11',
//     'React12', 'react12',
//     'React13_1', 'react13_1',
//     'React13_2', 'react13_2',
//     'React13_3', 'react13_3',
//     'React14_1', 'react14_1',
//     'React14_2', 'react14_2',
//     'React15', 'react15',
//     'React15__5', 'react15__5',
//     'React16', 'react16',
//     'React17', 'react17',
//     'React18_1', 'react18_1',
//     'React18_2', 'react18_2',
//     'React18_3', 'react18_3',
//     'React18_4', 'react18_4',
//     'React19', 'react19',
//     'Java0', 'java0',
//     'Java01', 'java01',
//     'Java02', 'java02',
//     'Java03', 'java03',
//     'Java04', 'java04',
//     'Java05', 'java05',
//     'Java06', 'java06',
//     'Java07', 'java07',
//     'Java08', 'java08',
//     'Java09', 'java09',
//     'Java10', 'java10',
//     'Java11', 'java11',
//     'Java12', 'java12',
//     'Java_object_01', 'java_object_01',
//     'Java_object_02', 'java_object_02',
//     'Java_object_03', 'java_object_03',
//     'Java_object_04', 'java_object_04',
//     'Java_object_05', 'java_object_05',
//     'Java_app_01', 'java_app_01',
//     'Java_app_02', 'java_app_02',
//     'Java_app_03', 'java_app_03',
//     'Java_app_04', 'java_app_04',
//     'Java_app_05', 'java_app_05',
//     'Java_app_06', 'java_app_06',
//     'Java_springBoot_01', 'java_springboot_01',
//     'Java_springBoot_02', 'java_springboot_02',
//     'Java_springBoot_03', 'java_springboot_03',
//     'Java_springBoot_04', 'java_springboot_04',
//     'Java_springBoot_05', 'java_springboot_05',
//     'Java_springBoot_06', 'java_springboot_06',
//     'Java_springBoot_07', 'java_springboot_07',
//     'Java_springBoot_08', 'java_springboot_08',
//     'Java_springBoot_09', 'java_springboot_09',
//     'Java_springBoot_10', 'java_springboot_10',
//     'Java_springBoot_11', 'java_springboot_11',
//     'Java_springBoot_12', 'java_springboot_12',
//     'Java_springBoot_13', 'java_springboot_13',
//     'Java_WebsoketSTOMP_01', 'java_WebsoketSTOMP_01',
//     'Java_WebsoketSTOMP_02', 'java_WebsoketSTOMP_02',
//     'Java_WebsoketSTOMP_03', 'java_WebsoketSTOMP_03',
//     'Java_WebsoketSTOMP_04', 'java_WebsoketSTOMP_04',
//     'Java_WebsoketSTOMP_05', 'java_WebsoketSTOMP_05',
//     'Java_WebsoketSTOMP_06', 'java_WebsoketSTOMP_06',
//     'Java_SpringBatch_01', 'java_SpringBatch_01',
//     'Java_SpringBatch_02', 'java_SpringBatch_02',
//     'Java_SpringBatch_03', 'java_SpringBatch_03',
//     'Java_SpringBatch_04', 'java_SpringBatch_04',
//     'Java_SpringBatch_05', 'java_SpringBatch_05',
//     'Java_Test_01', 'java_Test_01',
//     'Java_Test_02', 'java_Test_02',
//     'Java_Test_03', 'java_Test_03',
//     'Java_Test_04', 'java_Test_04',
//     'Java_Test_05', 'java_Test_05',
//     'Java_Test_06', 'java_Test_06',
//     'Java_Test_07', 'java_Test_07',
//     'Java_Test_08', 'java_Test_08',
//     'Java_Test_09', 'java_Test_09',
//     'Java_Test_10', 'java_Test_10',
//     'Java_Test_11', 'java_Test_11',
//     'Java_Test_12', 'java_Test_12',
//     'SQL01', 'sql01',
//     'SQL02', 'sql02',
//     'SQL03', 'sql03',
//     'SQL04', 'sql04',
//     'SQL_ex01', 'sql_ex01',
//     'SQL05', 'sql05',
//     'SQL06', 'sql06',
//     'SQL07', 'sql07',
//     'SQL_ex02', 'sql_ex02',
//     'SQL08_1', 'sql08_1',
//     'SQL08_2', 'sql08_2',
//     'SQL09_1', 'sql09_1',
//     'SQL09_2', 'sql09_2',
//     'SQL09_3', 'sql09_3',
//     'SQL09_4', 'sql09_4',
//     'SQL_ex03', 'sql_ex03',
//     'SQL10_1', 'sql10_1',
//     'SQL10_2', 'sql10_2',
//     'SQL10_3', 'sql10_3',
//     'SQL11_1', 'sql11_1',
//     'SQL11_2', 'sql11_2',
//     'SQL11_3', 'sql11_3',
//     'SQL12', 'sql12',
//     'SQL_ex04', 'sql_ex04',
//     'SQL13_1', 'sql13_1',
//     'SQL13_2', 'sql13_2',
//     'SQL14_1', 'sql14_1',
//     'SQL14_2', 'sql14_2',
//     'SQL15', 'sql15',
//     'SQL_ex05', 'sql_ex05',
//     'SQL16', 'sql16',
//     'SQL_last', 'sql_last',
//     'Design01', 'design01',
//     'Design01_2', 'design01_2',
//     'Design02', 'design02',
//     'Design02_2', 'design02_2',
//     'Design02_3', 'design02_3',
//     'Design02_4', 'design02_4',
//     'Design02_5', 'design02_5',
//     'Design02_6', 'design02_6',
//     'Design03', 'design03',
//     'Design03_2', 'design03_2',
//     'Design03_3', 'design03_3',
//     'Design03_4', 'design03_4',
//     'Design04', 'design04',
//     'Design04_2', 'design04_2',
//     'Design04_3', 'design04_3',
//     'Design04_4', 'design04_4',
//     'Design04_4_1', 'design04_4_1',
//     'Design04_4_2', 'design04_4_2',
//     'Design04_4_3', 'design04_4_3',
//     'Design05', 'design05',
//     'Design06', 'design06',
//     'Design06_2', 'design06_2',
//     'Design07', 'design07',
//     'Design07_2', 'design07_2',
//     'Design07_3', 'design07_3',
//     'Design07_4', 'design07_4',
//     'Design08', 'design08',
//     'Design08_2', 'design08_2',
//     'Design09', 'design09',
//     'Design09_2', 'design09_2',
//     'Design09_3', 'design09_3',
//     'Spec01', 'spec01',
//     'WordPress01', 'wordpress01',
//     'WordPress02', 'wordpress02',
//     'WordPress03', 'wordpress03',
//     'WordPress04', 'wordpress04',
//     'WordPress05', 'wordpress05',
//     'WordPress06', 'wordpress06',
//     'WordPress07', 'wordpress07',
//     'WordPress08', 'wordpress08',
//     'WordPress09', 'wordpress09',
//     'WordPress10', 'wordpress10',
//     'JSTQB0', 'jstqb0',
//     'JSTQB01_1', 'jstqb01_1',
//     'JSTQB01_2', 'jstqb01_2',
//     'JSTQB01_3', 'jstqb01_3',
//     'JSTQB01_4', 'jstqb01_4',
//     'JSTQB01_5', 'jstqb01_5',
//     'JSTQB02_1', 'jstqb02_1',
//     'JSTQB02_2', 'jstqb02_2',
//     'JSTQB02_3', 'jstqb02_3',
//     'JSTQB03_1', 'jstqb03_1',
//     'JSTQB03_2', 'jstqb03_2',
//     'JSTQB04_1', 'jstqb04_1',
//     'JSTQB04_2', 'jstqb04_2',
//     'JSTQB04_3', 'jstqb04_3',
//     'JSTQB04_4', 'jstqb04_4',
//     'JSTQB04_5', 'jstqb04_5',
//     'JSTQB05_1', 'jstqb05_1',
//     'JSTQB05_2', 'jstqb05_2',
//     'JSTQB05_3', 'jstqb05_3',
//     'JSTQB05_4', 'jstqb05_4',
//     'JSTQB05_5', 'jstqb05_5',
//     'JSTQB06_1', 'jstqb06_1',
//     'JSTQB06_2', 'jstqb06_2'
// );

// // メタキーを削除
// $placeholders = array_fill(0, count($meta_keys), '%s');
// $query = $wpdb->prepare(
//     "DELETE FROM {$wpdb->usermeta} WHERE meta_key IN (" . implode(',', $placeholders) . ")",
//     $meta_keys
// );

// $result = $wpdb->query($query);

// if ($result !== false) {
//     echo "Successfully deleted " . $result . " meta entries.";
// } else {
//     echo "Error deleting meta entries: " . $wpdb->last_error;
// }

// メモリ制限を緩和
ini_set('memory_limit', '512M');

// 欄追加
add_filter('user_contactmethods', 'add_user_info');
function add_user_info()
{
  $user_info = array();

  // カテゴリーを取得（並び替え順に従う）
  $categories = get_categories(array(
    'orderby' => 'term_order',
    'order' => 'ASC',
    'hide_empty' => false,
    'number' => 100 // 一度に取得するカテゴリー数を制限
  ));

  // 各カテゴリーごとにタグを取得して保存スペースを作成
  foreach ($categories as $category) {
    // カテゴリー内の投稿を取得（menu_order順）
    $posts = get_posts(array(
      'post_type' => 'post',
      'category_name' => $category->slug,
      'posts_per_page' => 100, // 一度に取得する投稿数を制限
      'orderby' => 'menu_order',
      'order' => 'ASC'
    ));

    // 投稿ごとにタグを取得して配列に格納
    $tag_array = array();
    foreach ($posts as $post) {
      $post_tags = wp_get_object_terms($post->ID, 'post_tag', array(
        'orderby' => 'term_order',
        'order' => 'ASC',
        'fields' => 'slugs' // スラッグのみを取得してメモリ使用量を削減
      ));

      if (!is_wp_error($post_tags) && !empty($post_tags)) {
        foreach ($post_tags as $tag_slug) {
          $tag_array[$tag_slug] = $tag_slug;
        }
      }
    }

    // タグを保存スペースに追加
    $user_info = array_merge($user_info, $tag_array);
  }

  return $user_info;
}

// 新規ユーザー登録時にデフォルト値を設定
add_action('user_register', 'set_default_progress_values');
function set_default_progress_values($user_id)
{
  $user_info = add_user_info();

  // バッチ処理でメタデータを追加
  $batch_size = 50;
  $tag_slugs = array_keys($user_info);
  $batches = array_chunk($tag_slugs, $batch_size);

  foreach ($batches as $batch) {
    foreach ($batch as $tag_slug) {
      add_user_meta($user_id, $tag_slug, '0', true);
    }
    // メモリを解放
    wp_cache_flush();
  }
}

// 投稿タグが更新されたときに保存スペースを更新
add_action('set_object_terms', 'update_storage_spaces', 10, 4);
function update_storage_spaces($object_id, $terms, $tt_ids, $taxonomy)
{
  if ($taxonomy === 'post_tag') {
    // ユーザー情報を更新
    $user_info = add_user_info();
    update_option('user_contactmethods', $user_info);
  }
}

// ツールバーデフォルト非表示
add_filter('show_admin_bar', '__return_false');
