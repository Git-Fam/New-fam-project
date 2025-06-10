<?php

// 検索機能
// function filter_search_query($query)
// {
//   if ($query->is_search && !is_admin()) {
//     $query->set('post_type', 'column');
//   }
//   return $query;
// }
// add_filter('pre_get_posts', 'filter_search_query');


add_filter('template_include', function($template) {
  if (is_search() && !is_admin()) {
      $post_type = '';
      if (!empty($_GET['post_type'])) {
          $post_type = $_GET['post_type'];
      } elseif (!empty($_POST['post_type'])) {
          $post_type = $_POST['post_type'];
      }
      // post_typeがpostならpage-search-map.phpを使う
      if ($post_type === 'post') {
          $new_template = locate_template('page-search-map.php');
          if ($new_template) return $new_template;
      }
      // post_typeがcolumnなら（デフォルトで）search.php
  }
  return $template;
});



//道のり検索用 POSTでもページが認識される
// add_action('init', function() {
//     if (
//         $_SERVER['REQUEST_METHOD'] === 'POST'
//         && !empty($_POST)
//         && !empty($_POST['use_search_map_post']) // ← このフラグがあるときだけ
//     ) {
//         global $wp;
//         $request = home_url(add_query_arg(array(), $wp->request));
//         if (!empty($request)) {
//             $_SERVER['REQUEST_URI'] = str_replace(home_url(), '', $request);
//         }
//     }
//   });
  


add_action('save_post', function($post_id){
    // 自動保存やリビジョンなら何もしない
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( wp_is_post_revision($post_id) ) return;

    $post = get_post($post_id);
    if ( !$post ) return;

    // 本文を取得
    $content = $post->post_content;
    // HTMLタグを除去
    $plain_text = strip_tags($content);
    // カスタムフィールド「search_keywords」に保存
    update_post_meta($post_id, 'search_keywords', $plain_text);
});

add_action('save_post', function($post_id){
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( wp_is_post_revision($post_id) ) return;

    $post = get_post($post_id);
    if ( !$post ) return;

    // 本文からHTMLタグ除去して保存
    $plain_text = strip_tags($post->post_content);
    update_post_meta($post_id, 'search_keywords', $plain_text);

    // 画像のaltテキストまとめて保存
    preg_match_all('/<img[^>]*alt=["\']([^"\']+)["\']/i', $post->post_content, $matches);
    $img_alt_texts = isset($matches[1]) ? implode(' ', $matches[1]) : '';
    update_post_meta($post_id, 'img_alt_texts', $img_alt_texts);
});

