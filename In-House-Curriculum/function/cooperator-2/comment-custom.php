<?php

// コメントフォームに画像添付フィールドを追加
add_action('comment_form_logged_in_after', 'add_image_upload_field');
function add_image_upload_field() {
    echo '<p class="comment-form-image"><label for="comment_image">' . esc_html__('画像を添付:', 'In-House-Curriculum') . '</label>
    <input type="file" name="comment_image" id="comment_image" accept="image/*"></p>';
}

// 管理画面でコメント編集時にタイトルと画像を表示するためのメタボックスを追加
function add_title_comment_field_box() {
    global $comment;
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
        error_log('Debugging: User does not have permission to edit comment ' . $comment_id);
        return;
    }

    // 画像の保存処理
    if (!empty($_FILES['comment_image']['name'])) {
        $file = $_FILES['comment_image'];
        error_log('Debugging: Image upload attempt from admin during comment edit. Filename: ' . $file['name']);

        if (is_uploaded_file($file['tmp_name'])) {
            error_log('Debugging: File is uploaded correctly. Temp file: ' . $file['tmp_name']);

            $upload = wp_handle_upload($file, array('test_form' => false));

            if (!isset($upload['error']) && isset($upload['url'])) {
                $image_url = $upload['url'];
                update_comment_meta($comment_id, 'comment_image', $image_url);
                error_log('Debugging: Image successfully uploaded from admin during comment edit for comment ID ' . $comment_id . ': ' . $image_url);
            } else {
                error_log('Debugging: Image upload error from admin during comment edit: ' . $upload['error']);
            }
        } else {
            error_log('Debugging: File was not uploaded correctly. Temporary file: ' . $file['tmp_name']);
        }
    } else {
        error_log('Debugging: No file selected for upload during comment edit.');
    }
}
add_action('edit_comment', 'save_edited_comment_image');





// 管理画面でコメント返信時にタイトルフィールドを追加
function add_title_to_admin_reply_form() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        console.log('JavaScript loaded');

        // 返信フォームにタイトルフィールドを追加
        $('#wp-replycontent-editor-container').append(
            '<p><label for="reply-title"><?php echo esc_html__('返信のタイトル', 'In-House-Curriculum'); ?>: </label>' +
            '<input type="text" name="comtitle" id="reply-title" class="widefat" /></p>'
        );

        $(document).on('click', 'button.save.button-primary', function(event) {
            console.log('Save button clicked');
            event.preventDefault();

            var formData = new FormData();
            formData.append('action', 'save_reply_title_from_admin'); 
            formData.append('_ajax_nonce', ajaxNonce); 
            formData.append('comtitle', $('#reply-title').val());
            formData.append('comment_ID', $('input[name="comment_ID"]').val());

            console.log('FormData prepared with all necessary fields.');

            $.ajax({
                url: ajaxurl, // WordPressで定義されたadmin-ajax.phpのURL
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        console.log('Form successfully submitted.', response);
                    } else {
                        console.error('Error in form submission:', response.data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error in form submission:', textStatus, errorThrown);
                }
            });
        });
    });
    </script>
    <?php
}
add_action('admin_print_footer_scripts', 'add_title_to_admin_reply_form');

// 返信時にタイトルのみを保存
function save_reply_title_from_admin() {
    error_log('Debugging: save_reply_title_from_admin function called.');

    // セキュリティチェック: Nonceの検証
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'save_reply_nonce')) {
        wp_send_json_error('セキュリティチェックに失敗しました');
        exit;
    }

    // タイトルの保存のみ行う
    if (isset($_POST['comtitle'])) {
        $comment_id = intval($_POST['comment_ID']);
        $reply_title = sanitize_text_field($_POST['comtitle']);
        if (!empty($reply_title)) {
            update_comment_meta($comment_id, 'comtitle', $reply_title);
            error_log('Debugging: Title saved successfully for comment ID ' . $comment_id);
        } else {
            delete_comment_meta($comment_id, 'comtitle');
            error_log('Debugging: Title deleted successfully for comment ID ' . $comment_id);
        }
    }

    wp_send_json_success(array('message' => 'コメントが更新されました'));
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

error_log('Debugging: $_FILES content: ' . print_r($_FILES, true));

?>
