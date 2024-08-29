<?php

// ページネーション有効化
function add_custom_post_types_to_query($query) {
  if (!is_admin() && $query->is_main_query()) {
    if (is_home() || is_post_type_archive('column') || is_tax('column-cat')) {
      $query->set('posts_per_page', 8);
      $query->set('paged', get_query_var('paged') ? get_query_var('paged') : 1);
    }
  }
}
add_action('pre_get_posts', 'add_custom_post_types_to_query');

?>