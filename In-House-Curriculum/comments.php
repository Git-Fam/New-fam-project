<?php
if (post_password_required()) {
    return;
}

// コメントがある場合の処理
if (have_comments()) : ?>
    <div id="comments" class="comments-area">
        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'callback'   => 'mytheme_comment',
                    'status'     => 'approve',
                )
            );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>
    </div>
<?php endif; ?>

<?php
// コメントフォームを表示する関数
function display_comment_form() {
    ?>
    <ul class="C_menu">
        <li class="menu-item category">
            <div class="category-content">
                <p class="category-content-TX">カテゴリー選択</p>

                <div class="select-content">
                    <ul class="select" id="select-post">
                        <?php
                        $args = array(
                            'post_type' => 'question',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        );
                        $posts = get_posts($args);

                        foreach ($posts as $post) {
                            echo '<li data-value="' . esc_attr($post->ID) . '">' . esc_html($post->post_title) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
    <?php
    // コメントフォームを表示
    comment_form(array(
        'title_reply' => __('コメントを残す', 'In-House-Curriculum'),
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => apply_filters('comment_form_default_fields', array(
            'comtitle' => '<p class="comment-form-title"><label for="comtitle">' . esc_html__('タイトル:', 'In-House-Curriculum') . '</label><input id="comtitle" name="comtitle" type="text" value="" size="15" /></p>',
        )),
        'format' => 'html5', // HTML5形式に指定
    ));
}
?>
