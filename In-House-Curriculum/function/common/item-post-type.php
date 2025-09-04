<?php

function register_item_post_type()
{
  // カスタム投稿タイプ「アイテム」
  register_post_type(
    'item',
    array(
      'label' => 'アイテム',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'item'), // スラッグを設定
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

  // カスタム投稿タイプ「アイテム」のカテゴリー
  register_taxonomy(
    'item-cat',
    'item',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'item-cat'), // スラッグを設定
    )
  );

  // カスタム投稿タイプ「アイテム」のタグ
  register_taxonomy(
    'item-tag',
    'item',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );

  // タグの編集画面にカスタムフィールドを追加
  function add_item_category_slug_field_to_tag_edit($term)
  {
    $category_slug = get_term_meta($term->term_id, 'category_slug', true);
?>
    <tr class="form-field">
      <th scope="row" valign="top"><label for="category_slug"><?php _e('Category Slug'); ?></label></th>
      <td>
        <input type="text" name="category_slug" id="category_slug" value="<?php echo esc_attr($category_slug) ? esc_attr($category_slug) : ''; ?>">
        <p class="description"><?php _e('Enter the slug of the category this tag is associated with.'); ?></p>
      </td>
    </tr>
  <?php
  }
  add_action('item-tag_edit_form_fields', 'add_item_category_slug_field_to_tag_edit');

  // タグのカスタムフィールドを保存
  function save_item_category_slug_field_to_tag($term_id)
  {
    if (isset($_POST['category_slug'])) {
      update_term_meta($term_id, 'category_slug', sanitize_text_field($_POST['category_slug']));
    }
  }
  add_action('edited_item-tag', 'save_item_category_slug_field_to_tag');



  // タグのカスタムフィールドを保存
  function save_item_category_id_field_to_tag($term_id)
  {
    if (isset($_POST['category_id'])) {
      update_term_meta($term_id, 'category_id', sanitize_text_field($_POST['category_id']));
    }
  }
  add_action('edited_item-tag', 'save_item_category_id_field_to_tag');

  // カスタムフィールドのメタボックスを追加
  function add_item_meta_box()
  {
    add_meta_box(
      'item_meta_box', // メタボックスID
      'アイテム設定', // タイトル
      'display_item_meta_box', // コールバック関数
      'item', // 投稿タイプ
      'side', // 表示位置
      'high' // 表示優先度
    );
  }
  add_action('add_meta_boxes', 'add_item_meta_box');

  function display_item_meta_box($post)
  {
    $value_payment = get_post_meta($post->ID, '_item_radio_payment', true);
    $value_price = get_post_meta($post->ID, '_item_price', true);
    $value_aspect_ratio = get_post_meta($post->ID, '_item_aspect_ratio', true);
  ?>
    <label for="item_radio_coin">
      <input type="radio" name="item_radio_payment" id="item_radio_coin" value="coin" <?php checked($value_payment, 'coin'); ?> />
      コイン
    </label>
    <br>
    <label for="item_radio_point">
      <input type="radio" name="item_radio_payment" id="item_radio_point" value="point" <?php checked($value_payment, 'point'); ?> />
      ポイント
    </label>
    <br>
    <label for="item_price">
      値段:
      <input type="number" name="item_price" id="item_price" value="<?php echo esc_attr($value_price); ?>" />
    </label>
    <br><br>
    <label for="item_aspect_ratio">
      アスペクト比:
      <input type="text" name="item_aspect_ratio" id="item_aspect_ratio" value="<?php echo esc_attr($value_aspect_ratio); ?>" placeholder="例: 1/2, 16/9" />
      <p class="description">幅/高さの形式で入力してください（例: 1/2, 16/9）</p>
    </label>
<?php
  }

  function save_item_meta_box($post_id)
  {
    if (array_key_exists('item_radio_payment', $_POST)) {
      update_post_meta(
        $post_id,
        '_item_radio_payment',
        $_POST['item_radio_payment']
      );
    } else {
      delete_post_meta($post_id, '_item_radio_payment');
    }

    if (array_key_exists('item_price', $_POST)) {
      update_post_meta(
        $post_id,
        '_item_price',
        $_POST['item_price']
      );
    } else {
      delete_post_meta($post_id, '_item_price');
    }

    if (array_key_exists('item_aspect_ratio', $_POST)) {
      update_post_meta(
        $post_id,
        '_item_aspect_ratio',
        sanitize_text_field($_POST['item_aspect_ratio'])
      );
    } else {
      delete_post_meta($post_id, '_item_aspect_ratio');
    }
  }
  add_action('save_post', 'save_item_meta_box');
}
