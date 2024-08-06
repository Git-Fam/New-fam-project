<?php
  // JS使用可能
  function enqueue_custom_scripts() {
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . 'script.js', array( 'jquery' ), '1.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

// 投稿
function post_has_archive($args, $post_type ) { // 設定後に（パーマリンク更新すること）
	if('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news';
		$args['label'] = 'お知らせ';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10,2);


// カスタム投稿追加
/* ---------- カスタム投稿の追加 ---------- */
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( // カスタム投稿タイプの追加関数
    'photogallery', //カスタム投稿タイプ名（半角英数字の小文字）
    array( //オプション（以下）
      'label' => 'フォトギャラリー', // 管理画面上の表示（日本語でもOK）
      'public' => true, // 管理画面に表示するかどうかの指定
      'has_archive' => true, // 投稿した記事の一覧ページを作成する
      'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
      'show_in_rest' => true, // Gutenbergの有効化
      'supports' => array( // サポートする機能（以下）
        'title',  // タイトル
        'editor', // エディター
        'thumbnail', // アイキャッチ画像
        'revisions' // リビジョンの保存
      ),
    )
  );

  register_taxonomy(
    'photogallery-cat',
    'photogallery',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'photogallery-tag',
    'photogallery',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );

  register_post_type( // カスタム投稿タイプの追加関数
    'staff', //カスタム投稿タイプ名（半角英数字の小文字）
    array( //オプション（以下）
      'label' => 'スタッフ', // 管理画面上の表示（日本語でもOK）
      'public' => true, // 管理画面に表示するかどうかの指定
      'has_archive' => true, // 投稿した記事の一覧ページを作成する
      'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
      'show_in_rest' => true, // Gutenbergの有効化
      'supports' => array( // サポートする機能（以下）
        'title',  // タイトル
        'revisions' // リビジョンの保存
      ),
    )
  );
  register_taxonomy(
    'staff-cat',
    'staff',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'staff-tag',
    'staff',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}



add_theme_support( 'post-thumbnails' );

// 固定ページエディタ削除
function remove_page_editor() {
  remove_post_type_support('page', 'editor');
}
add_action('init', 'remove_page_editor');



//リキャプチャの読み込みを問い合わせページ、確認ページのみに限定
function load_recaptcha_js() {
	if ( ! is_page('contact') && ! is_page('contact-confirm') && ! is_page('contact-complete')) {
		wp_deregister_script( 'google-recaptcha' );
	}
}
add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );



function create_custom_user_role() {
  // 新しい役割を追加
  add_role('custom_editor', 'Custom Editor', array(
      'read' => true,
      'edit_posts' => true,
      'edit_pages' => true,
      'edit_others_posts' => true,
      'edit_others_pages' => true,
      'publish_posts' => true,
      'publish_pages' => true,
      'delete_posts' => true,
      'delete_pages' => true,
      'delete_others_posts' => true,
      'delete_others_pages' => true,
      'read_private_posts' => true,
      'read_private_pages' => true,
      'edit_published_posts' => true,
      'edit_published_pages' => true,
      'delete_published_posts' => true,
      'delete_published_pages' => true,
  ));
}
add_action('init', 'create_custom_user_role');

function update_custom_user_role() {
  $role = get_role('custom_editor');
  $role->add_cap('edit_published_posts');
  $role->add_cap('edit_published_pages');
  $role->add_cap('delete_published_posts');
  $role->add_cap('delete_published_pages');
}
add_action('init', 'update_custom_user_role');

?>