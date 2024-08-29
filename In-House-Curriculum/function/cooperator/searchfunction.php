<?php

// 検索機能
function filter_search_query($query)
{
  if ($query->is_search && !is_admin()) {
    $query->set('post_type', 'column');
  }
  return $query;
}
add_filter('pre_get_posts', 'filter_search_query');
