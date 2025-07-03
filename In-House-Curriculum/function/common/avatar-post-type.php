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

  // タグの編集画面にカスタムフィールドを追加
  function add_category_slug_field_to_tag_edit($term)
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
  add_action('avatar-tag_edit_form_fields', 'add_category_slug_field_to_tag_edit');

  // タグのカスタムフィールドを保存
  function save_category_slug_field_to_tag($term_id)
  {
    if (isset($_POST['category_slug'])) {
      update_term_meta($term_id, 'category_slug', sanitize_text_field($_POST['category_slug']));
    }
  }
  add_action('edited_avatar-tag', 'save_category_slug_field_to_tag');



  // タグのカスタムフィールドを保存
  function save_category_id_field_to_tag($term_id)
  {
    if (isset($_POST['category_id'])) {
      update_term_meta($term_id, 'category_id', sanitize_text_field($_POST['category_id']));
    }
  }
  add_action('edited_avatar-tag', 'save_category_id_field_to_tag');

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
    $value_aspect_ratio = get_post_meta($post->ID, '_avatar_aspect_ratio', true);
    $value_style = get_post_meta($post->ID, '_avatar_style', true);
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
    <br><br>
    <label for="avatar_aspect_ratio">
      アスペクト比:
      <input type="text" name="avatar_aspect_ratio" id="avatar_aspect_ratio" value="<?php echo esc_attr($value_aspect_ratio); ?>" placeholder="例: 1/2, 16/9" />
      <p class="description">幅/高さの形式で入力してください（例: 1/2, 16/9）</p>
    </label>
    <br><br>
    <label for="avatar_style">
      アバター固有スタイル設定:
      <textarea name="avatar_style" id="avatar_style" rows="4" cols="30" placeholder="CSSスタイルを入力してください"><?php echo esc_textarea($value_style); ?></textarea>
      <p class="description">アバター専用のCSSスタイルを入力してください（例: border-radius: 50%; filter: brightness(1.2);）</p>
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

    if (array_key_exists('avatar_aspect_ratio', $_POST)) {
      update_post_meta(
        $post_id,
        '_avatar_aspect_ratio',
        sanitize_text_field($_POST['avatar_aspect_ratio'])
      );
    } else {
      delete_post_meta($post_id, '_avatar_aspect_ratio');
    }

    if (array_key_exists('avatar_style', $_POST)) {
      update_post_meta(
        $post_id,
        '_avatar_style',
        sanitize_textarea_field($_POST['avatar_style'])
      );
    } else {
      delete_post_meta($post_id, '_avatar_style');
    }
  }
  add_action('save_post', 'save_avatar_meta_box');

  // アイテムスタイル設定用のメタボックスを追加
  function add_avatar_item_style_meta_box()
  {
    add_meta_box(
      'avatar_item_style_meta_box', // メタボックスID
      'アイテムスタイル設定', // タイトル
      'display_avatar_item_style_meta_box', // コールバック関数
      'avatar', // 投稿タイプ
      'normal', // 表示位置
      'default' // 表示優先度
    );
  }
  add_action('add_meta_boxes', 'add_avatar_item_style_meta_box');

  function display_avatar_item_style_meta_box($post)
  {
    // アイテム投稿を全て取得
    $items = get_posts(array(
      'post_type' => 'item',
      'numberposts' => -1,
      'post_status' => 'publish'
    ));

    // 現在のアバターに設定されているアイテムスタイルを取得
    $item_styles = get_post_meta($post->ID, '_avatar_item_styles', true);
    if (!is_array($item_styles)) {
      $item_styles = array();
    }
  ?>
    <div class="avatar-item-styles-container">
      <p>このアバターに関連するアイテムのスタイルを設定してください：</p>

      <?php if (!empty($items)) : ?>
        <table class="widefat">
          <thead>
            <tr>
              <th>アイテム名</th>
              <th>カテゴリー</th>
              <th>スタイル設定</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $item) : ?>
              <?php
              $item_categories = get_the_terms($item->ID, 'item-cat');
              $category_names = array();
              if ($item_categories && !is_wp_error($item_categories)) {
                foreach ($item_categories as $category) {
                  $category_names[] = $category->name;
                }
              }
              $current_style = isset($item_styles[$item->ID]) ? $item_styles[$item->ID] : '';
              ?>
              <tr>
                <td>
                  <strong><?php echo esc_html($item->post_title); ?></strong>
                </td>
                <td>
                  <?php echo esc_html(implode(', ', $category_names)); ?>
                </td>
                <td>
                  <textarea
                    name="avatar_item_styles[<?php echo $item->ID; ?>]"
                    rows="3"
                    cols="50"
                    placeholder="CSSスタイルを入力してください"><?php echo esc_textarea($current_style); ?></textarea>
                  <p class="description">例: aspect-ratio: 1/2; width: 80%; top: 10%; left: 50%; transform: translateY(-50%);</p>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>アイテムが登録されていません。</p>
      <?php endif; ?>
    </div>

    <style>
      .avatar-item-styles-container table {
        margin-top: 10px;
      }

      .avatar-item-styles-container textarea {
        width: 100%;
        max-width: 400px;
      }
    </style>
<?php
  }

  function save_avatar_item_style_meta_box($post_id)
  {
    if (array_key_exists('avatar_item_styles', $_POST)) {
      $item_styles = array();
      foreach ($_POST['avatar_item_styles'] as $item_id => $style) {
        if (!empty(trim($style))) {
          $item_styles[$item_id] = sanitize_textarea_field($style);
        }
      }
      update_post_meta($post_id, '_avatar_item_styles', $item_styles);
    } else {
      delete_post_meta($post_id, '_avatar_item_styles');
    }
  }
  add_action('save_post', 'save_avatar_item_style_meta_box');
}
