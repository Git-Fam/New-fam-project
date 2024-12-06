<?php

function register_chatbot_post_type()
{



  // カスタム投稿タイプ「チャットボット」
  register_post_type(
    'chatbot',
    array(
      'label' => 'チャットボット',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'chatbot'), // スラッグを設定
      'menu_position' => 9,
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

  // カスタム投稿タイプ「チャットボット」のカテゴリー
  register_taxonomy(
    'chatbot-cat',
    'chatbot',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'chatbot-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「チャットボット」のタグ
  register_taxonomy(
    'chatbot-tag',
    'chatbot',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}
