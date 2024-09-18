<?php

function register_question_post_type()
{


  // カスタム投稿タイプ「講師への質問」
  register_post_type(
    'question',
    array(
      'label' => '講師への質問',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'question'), // スラッグを設定
      'menu_position' => 7,
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

  // カスタム投稿タイプ「講師への質問」のカテゴリー
  register_taxonomy(
    'question-cat',
    'question',
    array(
      'label' => '��テゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'question-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「講師への質問」のタグ
  register_taxonomy(
    'question-tag',
    'question',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}
