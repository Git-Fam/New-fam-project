<?php

function register_avatar_post_type()
{
  // カスタム投稿タイプ「アバター」
  register_post_type(
    'avatar',
    array(
      'label' => 'アバター',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'avatar'), // スラッグを設定
      'menu_position' => 6,
      'show_in_rest' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
        'custom-fields' // カスタムフィールドを追加
      ),
    )
  );

  // カスタム投稿タイプ「アバター」のカテゴリー
  register_taxonomy(
    'avatar-cat',
    'avatar',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'avatar-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「アバター」のタグ
  register_taxonomy(
    'avatar-tag',
    'avatar',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );

  // カスタムフィールドのメタボックスを追加
  function add_avatar_meta_box()
  {
    add_meta_box(
      'avatar_meta_box', // メタボックスID
      'アバター設定', // タイトル
      'display_avatar_meta_box', // コールバック関数
      'avatar', // 投稿タイプ
      'side', // 表示位置
      'high' // 表示優先度
    );
  }
  add_action('add_meta_boxes', 'add_avatar_meta_box');

  function display_avatar_meta_box($post)
  {
    $value_payment = get_post_meta($post->ID, '_avatar_radio_payment', true);
    $value_price = get_post_meta($post->ID, '_avatar_price', true);
?>
    <label for="avatar_radio_coin">
      <input type="radio" name="avatar_radio_payment" id="avatar_radio_coin" value="coin" <?php checked($value_payment, 'coin'); ?> />
      コイン
    </label>
    <br>
    <label for="avatar_radio_point">
      <input type="radio" name="avatar_radio_payment" id="avatar_radio_point" value="point" <?php checked($value_payment, 'point'); ?> />
      ポイント
    </label>
    <br>
    <label for="avatar_price">
      値段:
      <input type="number" name="avatar_price" id="avatar_price" value="<?php echo esc_attr($value_price); ?>" />
    </label>
<?php
  }

  function save_avatar_meta_box($post_id)
  {
    if (array_key_exists('avatar_radio_payment', $_POST)) {
      update_post_meta(
        $post_id,
        '_avatar_radio_payment',
        $_POST['avatar_radio_payment']
      );
    } else {
      delete_post_meta($post_id, '_avatar_radio_payment');
    }

    if (array_key_exists('avatar_price', $_POST)) {
      update_post_meta(
        $post_id,
        '_avatar_price',
        $_POST['avatar_price']
      );
    } else {
      delete_post_meta($post_id, '_avatar_price');
    }
  }
  add_action('save_post', 'save_avatar_meta_box');












  // // カスタム投稿タイプ「アバター」
  // register_post_type(
  //   'avatar',
  //   array(
  //     'label' => 'アバター',
  //     'public' => true,
  //     'has_archive' => true,
  //     'rewrite' => array('slug' => 'avatar'), // スラッグを設定
  //     'menu_position' => 6,
  //     'show_in_rest' => true,
  //     'supports' => array(
  //       'title',
  //       'editor',
  //       'thumbnail',
  //       'revisions',
  //     ),
  //   )
  // );

  // // カスタム投稿タイプ「アバター」のカテゴリー
  // register_taxonomy(
  //   'avatar-cat',
  //   'avatar',
  //   array(
  //     'label' => 'カテゴリー',
  //     'hierarchical' => true,
  //     'public' => true,
  //     'show_in_rest' => true,
  //     'rewrite' => array('slug' => 'avatar-cat'), // スラッグを設定
  //   )
  // );

  // // カスタム投稿タイプ「アバター」のタグ
  // register_taxonomy(
  //   'avatar-tag',
  //   'avatar',
  //   array(
  //     'label' => 'タグ',
  //     'hierarchical' => false,
  //     'public' => true,
  //     'show_in_rest' => true,
  //     'update_count_callback' => '_update_post_term_count',
  //   )
  // );




}
