<?php

function register_column_post_type()
{

  register_post_type(
    'column',
    array(
      'label' => 'コラム',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'column'), // スラッグを設定
      'menu_position' => 5,
      'show_in_rest' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
    )
  );

  // カスタム投稿タイプのカテゴリー
  register_taxonomy(
    'column-cat',
    'column',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'column-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプのタグ
  register_taxonomy(
    'column-tag',
    'column',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}
