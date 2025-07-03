<?php

// 投稿
function post_has_archive($args, $post_type)
{ // 設定後に（パーマリンク更新すること）
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'curriculum';
    $args['label'] = 'カリキュラム';
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

add_theme_support('post-thumbnails');

// カスタム投稿追加
add_action('init', 'create_post_type');
function create_post_type()
{

  // コラム
  register_column_post_type();

  // お知らせ
  register_news_post_type();

  // 講師への質問
  register_question_post_type();

  // ミニゲーム
  register_game_post_type();


  // チャットボット
  register_chatbot_post_type();


  // アバター
  register_avatar_post_type();

  // アイテム
  register_item_post_type();

  //道のりランダムイベント
  register_random_post_type();
}








add_theme_support('post-thumbnails');
