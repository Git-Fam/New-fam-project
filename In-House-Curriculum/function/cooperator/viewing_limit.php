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

  // 除外リストを取得
  $ng_posts = get_user_meta($user->ID, 'ng_posts', true);
  if (!is_array($ng_posts)) $ng_posts = [];

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
  $all_post_ids = wp_list_pluck($sorted_posts, 'ID');

  // // デフォルトは全て許可
  // if (!is_array($allowed_posts)) {
  //   $allowed_posts = $all_post_ids;
  // }else {
  //   // すでに保存したユーザーにも、新規投稿を自動で許可
  //   // ↓↓↓ ここで「新規投稿」を自動追加
  //   $allowed_posts = array_unique(array_merge($allowed_posts, array_diff($all_post_ids, $allowed_posts)));
  // }

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
              $checked = !in_array($post->ID, $ng_posts); // 除外リストに無ければチェック
        ?>
              <label>
                <input type="checkbox" class="cat-<?php echo $cat->term_id; ?>-post" name="allowed_posts[]" value="<?php echo $post->ID; ?>"
                <?php if($checked) echo 'checked'; ?>>
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
    //画面でチェックされたもの
    $allowed = isset($_POST['allowed_posts']) ? array_map('intval', $_POST['allowed_posts']) : [];

    $all_post_ids = get_posts([
      'numberposts' => -1,
      'post_type' => 'post',
      'post_status' => 'publish',
      'fields' => 'ids',
    ]);

    // 除外リストを作成（チェックされていないID）
    $ng_posts = array_diff($all_post_ids, $allowed);

  // すべてチェックの場合は除外リストを削除（未設定へ）
    if (empty($ng_posts)) {
      delete_user_meta($user_id, 'ng_posts');
    } else {
      update_user_meta($user_id, 'ng_posts', $ng_posts);
    }
  }
}

// --- 閲覧権限判定関数
function user_can_view_post($user_id, $post_id) {
  $ng_posts = get_user_meta($user_id, 'ng_posts', true);
  if (!is_array($ng_posts)) $ng_posts = [];
  return !in_array($post_id, $ng_posts);
}
