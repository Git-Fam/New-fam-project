<?php

function register_random_post_type()
{


  // カスタム投稿タイプ「ランダムイベント」
  register_post_type(
    'random',
    array(
      'label' => 'ランダムイベント',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'random'), // スラッグを設定
      'menu_position' => 10,
      'show_in_rest' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
        'comments'
      ),
    )
  );

  // カスタム投稿タイプ「ランダムイベント」のカテゴリー
  register_taxonomy(
    'random-cat',
    'random',
  
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'random-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「ランダムイベント」のタグ
  register_taxonomy(
    'random-tag',
    'random',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}
