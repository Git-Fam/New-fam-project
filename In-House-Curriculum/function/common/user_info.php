<?php

// 欄追加
add_filter('user_contactmethods', 'add_user_info');
function add_user_info()
{
  $user_info = array();

  // カテゴリーを取得（並び替え順に従う）
  $categories = get_categories(array(
    'orderby' => 'term_order',
    'order' => 'ASC',
    'hide_empty' => false
  ));

  // 各カテゴリーごとにタグを取得して保存スペースを作成
  foreach ($categories as $category) {
    // カテゴリー内の投稿を取得（menu_order順）
    $posts = get_posts(array(
      'post_type' => 'post',
      'category_name' => $category->slug,
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC'
    ));

    // 投稿ごとにタグを取得して配列に格納
    $tag_array = array();
    foreach ($posts as $post) {
      $post_tags = wp_get_object_terms($post->ID, 'post_tag', array(
        'orderby' => 'term_order',
        'order' => 'ASC'
      ));

      if (!is_wp_error($post_tags) && !empty($post_tags)) {
        foreach ($post_tags as $tag) {
          $tag_array[$tag->slug] = $tag->name;
        }
      }
    }

    // タグを保存スペースに追加
    $user_info = array_merge($user_info, $tag_array);
  }

  return $user_info;
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
