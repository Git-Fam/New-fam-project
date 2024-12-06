<?php

// ユーザープロフィールページに「質問へのコメント数」を追加
function add_custom_user_comment_count_field($user) {
    // ユーザーの「question」へのコメント数を取得
    $comment_count = get_user_meta($user->ID, '_question_comment_count', true);
    ?>
    <h3>ユーザーの質問数</h3>
    <table class="form-table">
        <tr>
            <th><label for="question_comment_count">質問をした数</label></th>
            <td>
                <input type="number" name="question_comment_count" id="question_comment_count" value="<?php echo esc_attr($comment_count); ?>" class="regular-text" /><br />
                <span class="description">このユーザーが質問広場で質問をした数</span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_custom_user_comment_count_field');
add_action('edit_user_profile', 'add_custom_user_comment_count_field');

// ユーザーごとのコメント数をカウント
function update_user_comment_count_on_post($comment_ID, $comment_approved) {
    $comment = get_comment($comment_ID);
    $post_id = $comment->comment_post_ID;
    $user_id = $comment->user_id;

    // 投稿タイプが "question" であることを確認
    if (get_post_type($post_id) === 'question' && $user_id) {
        // ユーザーごとのコメント数を取得
        $user_comment_count = get_user_meta($user_id, '_question_comment_count', true);
        $user_comment_count = (int) $user_comment_count;
        $user_comment_count++;

        // ユーザーメタにコメント数を更新
        update_user_meta($user_id, '_question_comment_count', $user_comment_count);
    }
}
add_action('wp_insert_comment', 'update_user_comment_count_on_post', 10, 2);
