<?php
// ユーザー編集画面に投稿一覧チェックリストを追加
add_action('show_user_profile', 'add_viewing_limit_posts');
add_action('edit_user_profile', 'add_viewing_limit_posts');
function add_viewing_limit_posts($user)
{
  // すべてのカテゴリーを取得（昇順）
  $categories = get_terms([
    'taxonomy' => 'category',
    'orderby' => 'term_id',
    'order' => 'ASC',
    'hide_empty' => false,
  ]);

  // ユーザーメタ取得
  $allowed_posts = get_user_meta($user->ID, 'allowed_posts', true);

  // 投稿IDを格納する配列
  $sorted_posts = [];

  foreach ($categories as $cat) {
    // 各カテゴリーごとに投稿を取得
    $posts = get_posts([
      'numberposts' => -1,
      'post_type' => 'post',
      'post_status' => 'publish',
      'category' => $cat->term_id,
      'orderby' => 'menu_order',
      'order' => 'ASC'
    ]);
    foreach ($posts as $post) {
      $sorted_posts[] = $post;
    }
  }

  // デフォルトは全て許可
  if (!is_array($allowed_posts)) {
    $allowed_posts = wp_list_pluck($sorted_posts, 'ID');
  }
?>
  <h3>閲覧許可する投稿（カテゴリー順）</h3>
  <table class="form-table">
    <tr>
      <th><label for="allowed_posts">投稿タイトル</label></th>
      <td>
        <script>
          // カテゴリーごとに全選択/全解除
          function toggleCategoryAll(catId, checked) {
            var checkboxes = document.querySelectorAll('.cat-' + catId + '-post');
            checkboxes.forEach(function(cb) {
              cb.checked = checked;
            });
          }
        </script>
        <?php
        foreach ($categories as $cat):
          echo '<br><strong>' . esc_html($cat->name) . '</strong> ';
          // 『すべて』チェックボックス
          echo '<label style="font-weight:normal;margin-left:10px;">';
          echo '<input type="checkbox" onclick="toggleCategoryAll(' . $cat->term_id . ', this.checked)">すべて';
          echo '</label><br>';
          foreach ($sorted_posts as $post):
            if (in_array($cat->term_id, wp_list_pluck(get_the_category($post->ID), 'term_id'))) {
        ?>
              <label>
                <input type="checkbox" class="cat-<?php echo $cat->term_id; ?>-post" name="allowed_posts[]" value="<?php echo $post->ID; ?>"
                  <?php checked(in_array($post->ID, $allowed_posts)); ?>>
                <?php echo esc_html($post->post_title); ?>
              </label><br>
        <?php
            }
          endforeach;
        endforeach;
        ?>
      </td>
    </tr>
  </table>
<?php
}

// 保存処理
add_action('personal_options_update', 'save_viewing_limit_posts');
add_action('edit_user_profile_update', 'save_viewing_limit_posts');
function save_viewing_limit_posts($user_id)
{
  if (current_user_can('edit_user', $user_id)) {
    // チェックがなければ空配列
    $allowed = isset($_POST['allowed_posts']) ? array_map('intval', $_POST['allowed_posts']) : [];
    update_user_meta($user_id, 'allowed_posts', $allowed);
  }
}
