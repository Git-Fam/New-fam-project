<?php
  // JS使用可能
  function enqueue_custom_scripts() {
      wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
  }
  add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

  // コンタクトフォーム７pタグ削除
  add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
  function wpcf7_autop_return_false()
  {
    return false;
  }

// 投稿
function post_has_archive($args, $post_type ) { // 設定後に（パーマリンク更新すること）
	if('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog';
		$args['label'] = 'ブログ';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10,2);


// カスタム投稿追加
/* ---------- カスタム投稿の追加 ---------- */
// add_action( 'init', 'create_post_type' );
// function create_post_type() {
//   register_post_type( // カスタム投稿タイプの追加関数
//     'calendar', //カスタム投稿タイプ名（半角英数字の小文字）
//     array( //オプション（以下）
//       'label' => 'カレンダー', // 管理画面上の表示（日本語でもOK）
//       'public' => true, // 管理画面に表示するかどうかの指定
//       'has_archive' => true, // 投稿した記事の一覧ページを作成する
//       'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
//       'show_in_rest' => true, // Gutenbergの有効化
//       'supports' => array( // サポートする機能（以下）
//         'title',  // タイトル
//         'editor', // エディター
//         'thumbnail', // アイキャッチ画像
//         'revisions' // リビジョンの保存
//       ),
//     )
//   );
//   register_taxonomy(
//     'calendar-cat',
//     'calendar',
//     array(
//       'label' => 'カテゴリー',
//       'hierarchical' => true,
//       'public' => true,
//       'show_in_rest' => true,
//     )
//   );
//   register_taxonomy(
//     'calendar-tag',
//     'calendar',
//     array(
//       'label' => 'タグ',
//       'hierarchical' => false,
//       'public' => true,
//       'show_in_rest' => true,
//       'update_count_callback' => '_update_post_term_count',
//     )
//   );
// }

add_theme_support( 'post-thumbnails' );



//リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
// function load_recaptcha_js() {
// 	if ( ! is_page('contact') && ! is_page('confirmation') && ! is_page('complete')) {
// 		wp_deregister_script( 'google-recaptcha' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );

// 固定ページのエディターを非表示
add_filter('use_block_editor_for_post',function($use_block_editor,$post){
	if($post->post_type==='page'){
		remove_post_type_support('page','editor');
		return false;
	}
	return $use_block_editor;
},10,2);

?>