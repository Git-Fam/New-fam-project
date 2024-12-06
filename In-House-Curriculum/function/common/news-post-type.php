<?php

function register_news_post_type()
{

  // カスタム投稿タイプ「お知らせ」
  register_post_type(
    'news',
    array(
      'label' => 'お知らせ',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'news'), // スラッグを設定
      'menu_position' => 6,
      'show_in_rest' => true,
      'supports' => array(
        'title',
        // 'editor',
        // 'thumbnail',
        'revisions'
      ),
    )
  );

  // カスタム投稿タイプ「お知らせ」のカテゴリー
  register_taxonomy(
    'news-cat',
    'news',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'news-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「お知らせ」のタグ
  register_taxonomy(
    'news-tag',
    'news',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}
