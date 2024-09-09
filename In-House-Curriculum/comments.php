<?php
if (post_password_required()) {
    return;
}

// コメントの表示形式をカスタマイズ
if (!function_exists('mytheme_comment')) {
    function mytheme_comment($comment, $args, $depth) {
        if ($comment->comment_approved != '1') {
            return;
        }
        $GLOBALS['comment'] = $comment;
        $comment_ID = $comment->comment_ID;
        $get_comment_title = esc_attr(get_comment_meta($comment->comment_ID, 'comtitle', true));
        $comment_image = esc_url(get_comment_meta($comment->comment_ID, 'comment_image', true)); ?>

        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <?php if ($get_comment_title) : ?>
                    <div class="comment-title"><?php echo esc_html($get_comment_title); ?></div>
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(esc_html__('%1$s at %2$s', 'In-House-Curriculum'), get_comment_date(), get_comment_time()); ?></a>
                </div>

                <?php comment_text(); ?>

                <!-- 画像を表示させる部分 -->
                <?php if ($comment_image) : ?>
                    <div class="comment-image">
                        <img src="<?php echo esc_url($comment_image); ?>" alt="<?php esc_attr_e('コメント画像', 'In-House-Curriculum'); ?>" style="max-width: 300px; height: auto;">
                    </div>
                <?php endif; ?>

            </div>
            <?php if (get_children(array('post_id' => $comment->comment_ID, 'status' => 'approve'))) : ?>
                <ol class="children">
                    <?php wp_list_comments(array('style' => 'ol', 'callback' => 'mytheme_comment'), get_children(array('post_id' => $comment->comment_ID, 'status' => 'approve'))); ?>
                </ol>
            <?php endif; ?>
        </li>
        <?php
    }
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
<?php else : ?>
    <p><?php esc_html_e('No comments yet.', 'In-House-Curriculum'); ?></p>
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
<?php
// コメントが閉じられている場合のメッセージ
if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
    <p class="no-comments"><?php esc_html_e('現在質問を受け付けていません', 'In-House-Curriculum'); ?></p>
<?php endif; ?>
