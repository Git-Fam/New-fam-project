<?php

function register_game_post_type()
{



  // カスタム投稿タイプ「ミニゲーム」
  register_post_type(
    'game',
    array(
      'label' => 'ミニゲーム',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'gamepost'), // スラッグを設定
      'menu_position' => 8,
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

  // カスタム投稿タイプ「ミニゲーム」のカテゴリー
  register_taxonomy(
    'game-cat',
    'game',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'game-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「ミニゲーム」のタグ
  register_taxonomy(
    'game-tag',
    'game',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'game-tag'), // スラッグを設定
      'update_count_callback' => '_update_post_term_count',
    )
  );
}


