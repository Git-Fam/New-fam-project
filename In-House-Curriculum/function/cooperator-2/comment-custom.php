<?php


// question投稿タイプに対するコメントを承認待ちにする
function set_comments_pending_for_question($comment_id, $comment_approved, $commentdata) {
    // 投稿タイプが 'question' の場合のみ
    if (get_post_type($commentdata['comment_post_ID']) === 'question') {
        // コメントを承認待ち（0）に設定
        if ($comment_approved !== '0') { // 既に承認されていない場合
            wp_set_comment_status($comment_id, 'hold');
        }
    }
}
add_action('comment_post', 'set_comments_pending_for_question', 10, 3);


if (!function_exists('mytheme_comment')) {
    function mytheme_comment($comment, $args, $depth) {
        // コメントが属する投稿の投稿タイプが 'question' であるかを確認
        $post_type = get_post_type($comment->comment_post_ID);
        if ($post_type !== 'question') {
            return; // 投稿タイプが 'question' でない場合は終了
        }

        if ($comment->comment_approved != '1') {
            return;
        }

        $GLOBALS['comment'] = $comment;
        $comment_ID = $comment->comment_ID;
        $get_comment_title = esc_attr(get_comment_meta($comment->comment_ID, 'comtitle', true));
        $comment_image = esc_url(get_comment_meta($comment->comment_ID, 'comment_image', true));
        $post_title = get_the_title($comment->comment_post_ID); // コメントが属する投稿のタイトルを取得
        ?>

        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <?php if ($get_comment_title) : ?>
                    <div class="comment-title"><?php echo esc_html($get_comment_title); ?></div>
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(esc_html__('%1$s at %2$s', 'In-House-Curriculum'), get_comment_date(), get_comment_time()); ?></a>
                </div>

                <?php comment_text(); ?>

                <!-- コメントが属する投稿のタイトルを表示 -->
                <div class="post-title"><?php echo esc_html($post_title); ?></div>

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

// コメントフォームのカスタマイズ: コメントフィールドの直前にタイトルフィールドを追加
add_action('comment_form_field_comment', 'add_title_comment_field');
function add_title_comment_field($comment_field) {
    if (is_singular('question') || is_post_type_archive('question')) { // 投稿タイプが 'question' である場合のみ実行
        $title_field = '
        <p class="comment-form-title"><label for="comtitle">' . esc_html__('タイトル:', 'In-House-Curriculum') . '</label>
        <input id="comtitle" name="comtitle" type="text" value="" size="15"></p>';
        return $title_field . $comment_field;
    }
    return $comment_field;
}

// コメントフォームに画像添付フィールドを追加
add_action('comment_form_logged_in_after', 'add_image_upload_field');
function add_image_upload_field() {
    if (is_singular('question') || is_post_type_archive('question')) { // 投稿タイプが 'question' である場合のみ画像フィールドを追加
        echo '<p class="comment-form-image"><label for="comment_image">' . esc_html__('画像を添付:', 'In-House-Curriculum') . '</label>
        <input type="file" name="comment_image" id="comment_image" accept="image/*"></p>';
    }
}

// コメントメタデータとして追加項目を保存
function save_custom_comment_field($comment_id) {
    $comment = get_comment($comment_id);
    if (get_post_type($comment->comment_post_ID) !== 'question') {
        return; // 投稿タイプが 'question' でない場合は終了
    }

    $custom_key_comment_title = 'comtitle';
    $get_comment_title = isset($_POST[$custom_key_comment_title]) ? esc_attr($_POST[$custom_key_comment_title]) : '';

    if ('' == get_comment_meta($comment_id, $custom_key_comment_title)) {
        add_comment_meta($comment_id, $custom_key_comment_title, $get_comment_title, true);
    } else if ($get_comment_title != get_comment_meta($comment_id, $custom_key_comment_title)) {
        update_comment_meta($comment_id, $custom_key_comment_title, $get_comment_title);
    } else if ('' == $get_comment_title) {
        delete_comment_meta($comment_id, $custom_key_comment_title);
    }

    // 画像のアップロードと保存
    if (!empty($_FILES['comment_image']['name'])) {
        $file = $_FILES['comment_image'];
        $upload = wp_handle_upload($file, array('test_form' => false));

        if (!isset($upload['error']) && isset($upload['url'])) {
            $image_url = $upload['url'];
            add_comment_meta($comment_id, 'comment_image', $image_url);
            error_log('Image successfully uploaded: ' . $image_url);
        } else {
            error_log('Image upload error: ' . $upload['error']);
        }
    }
}
add_action('comment_post', 'save_custom_comment_field');
add_action('edit_comment', 'save_custom_comment_field');

// 管理画面でコメント編集時にタイトルと画像を表示するためのメタボックスを追加
function add_title_comment_field_box() {
    global $comment;
    if (get_post_type($comment->comment_post_ID) !== 'question') {
        return;
    }

    $comment_ID = $comment->comment_ID;
    $custom_key_comment_title = 'comtitle';
    $noncename = 'comment_noncename';
    $get_comment_title = esc_attr(get_comment_meta($comment_ID, $custom_key_comment_title, true));
    $comment_image = esc_url(get_comment_meta($comment_ID, 'comment_image', true));

    echo '<input type="hidden" name="' . esc_attr($noncename) . '" id="' . esc_attr($noncename) . '" value="' . esc_attr(wp_create_nonce(plugin_basename(__FILE__))) . '">' . "\n";
    echo '<p class="comment-form-title"><label for="comment-title">' . esc_html__('タイトル：', 'In-House-Curriculum') . '</label><input id="' . esc_attr($custom_key_comment_title) . '" name="' . esc_attr($custom_key_comment_title) . '" type="text" value="' . esc_attr($get_comment_title) . '" size="15"></p>' . "\n";

    echo '<p class="comment-form-image"><label for="comment_image">' . esc_html__('画像を確認・変更:', 'In-House-Curriculum') . '</label>';
    if ($comment_image) {
        echo '<img src="' . $comment_image . '" alt="' . esc_attr__('コメント画像', 'In-House-Curriculum') . '" style="max-width: 150px; height: auto; display: block; margin-bottom: 10px;">';
    }
    echo '<input type="file" name="comment_image" id="comment_image" accept="image/*"></p>';
}
add_action('add_meta_boxes_comment', 'add_title_comment_field_box');

// 管理画面のコメント編集フォームにenctypeを追加
function add_enctype_to_comment_edit_form() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // コメント編集フォームにenctypeを追加
        $('#post').attr('enctype', 'multipart/form-data');
        console.log('enctype added to comment edit form');
    });
    </script>
    <?php
}
add_action('admin_footer', 'add_enctype_to_comment_edit_form');

// コメント編集時の画像保存処理
function save_edited_comment_image($comment_id) {
    if (!current_user_can('edit_comment', $comment_id)) {
        return;
    }

    if (get_post_type(get_comment($comment_id)->comment_post_ID) !== 'question') {
        return;
    }

    // 画像の保存処理
    if (!empty($_FILES['comment_image']['name'])) {
        $file = $_FILES['comment_image'];

        // ファイルが正しくアップロードされたか確認
        if (is_uploaded_file($file['tmp_name'])) {
            $upload = wp_handle_upload($file, array('test_form' => false));

            // アップロードの成功を確認
            if (!isset($upload['error']) && isset($upload['url'])) {
                $image_url = $upload['url'];
                update_comment_meta($comment_id, 'comment_image', $image_url);
            }
        }
    }
}
add_action('edit_comment', 'save_edited_comment_image');

// 管理画面でコメント返信時にタイトルフィールドを追加（条件付き）
function add_title_to_admin_reply_form() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        const replyRow = document.getElementById('replyrow');
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    const isVisible = $(replyRow).is(':visible');
                    const isReplyMode = $('#replyhead').is(':visible');

                    if (isVisible && isReplyMode) {
                        if ($('#reply-title-container').length === 0) {
                            $('#wp-replycontent-editor-container').append(
                                '<p id="reply-title-container"><label for="reply-title">返信のタイトル: </label>' +
                                '<input type="text" name="comtitle" id="reply-title" class="widefat" /></p>'
                            );
                        }
                    }
                }
            });
        });

        observer.observe(replyRow, { attributes: true });

        $(document).on('click', 'button.save.button-primary', function(event) {
            event.preventDefault();

            const replyTitle = $('#reply-title').val();
            const formData = new FormData();
            formData.append('action', 'save_reply_title_from_admin'); 
            formData.append('_ajax_nonce', ajaxNonce); 
            formData.append('comtitle', replyTitle); 
            formData.append('comment_ID', $('input[name="comment_ID"]').val());

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        console.log('Reply title saved successfully.', response);
                    } else {
                        console.error('Error in saving reply title:', response.data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error in saving reply title:', textStatus, errorThrown);
                }
            });
        });
    });
    </script>
    <?php
}
add_action('admin_print_footer_scripts', 'add_title_to_admin_reply_form');

// 返信時のタイトル保存処理
function save_reply_title_from_admin() {
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'save_reply_nonce')) {
        wp_send_json_error('セキュリティチェックに失敗しました');
        exit;
    }

    if (isset($_POST['comtitle'])) {
        $comment_id = intval($_POST['comment_ID']);
        $reply_title = sanitize_text_field($_POST['comtitle']);
        
        if (!empty($reply_title)) {
            update_comment_meta($comment_id, 'reply_comtitle', $reply_title);
            error_log('Debugging: Reply title saved successfully for comment ID ' . $comment_id);
        } else {
            delete_comment_meta($comment_id, 'reply_comtitle');
            error_log('Debugging: Reply title deleted successfully for comment ID ' . $comment_id);
        }
    }

    wp_send_json_success(array('message' => '返信コメントが更新されました'));
}
add_action('wp_ajax_save_reply_title_from_admin', 'save_reply_title_from_admin');

// `nonce`をJavaScriptに渡す
function add_ajax_nonce_to_admin_footer() {
    $ajax_nonce = wp_create_nonce('save_reply_nonce');
    echo '<script type="text/javascript">var ajaxNonce = "' . $ajax_nonce . '";</script>';
}
add_action('admin_footer', 'add_ajax_nonce_to_admin_footer');

// コメントフォームの属性をフィルターで追加
add_filter('comment_form_defaults', 'add_enctype_to_comment_form');
function add_enctype_to_comment_form($defaults) {
    $defaults['id_form'] = 'commentform';
    $defaults['enctype'] = 'multipart/form-data';
    return $defaults;
}
?>
