<?php

// コメントカスタマイズ
add_action( 'comment_form_field_comment', 'add_title_comment_field' );
function add_title_comment_field( $defaults ) {
$defaults = '

<p class="comment-form-title"><label for="comment-title">タイトル:</label><input id="comtitle" name="comtitle" type="text" value="" size="15"><br>';
$defaults .= '

<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '<textarea id="comment" name="comment" cols="45" rows="8" ariarequired="true"></textarea><br>';
return $defaults;
}

// コメントメタデータとして追加項目を保存
function save_custom_comment_field( $comment_id ) {
    if ( !$comment = get_comment( $comment_id ) ) {
        return false;
    }
    $custom_key_comment_title = 'comtitle';
    $get_comment_title = esc_attr( $_POST[$custom_key_comment_title] );

    if ( '' == get_comment_meta( $comment_id, $custom_key_comment_title ) ) {
        add_comment_meta( $comment_id, $custom_key_comment_title, $get_comment_title, true );
    } else if ( $get_comment_title != get_comment_meta( $comment_id, $custom_key_comment_title ) ) {
        update_comment_meta( $comment_id, $custom_key_comment_title, $get_comment_title );
    } else if ( '' == $get_comment_title ) {
        delete_comment_meta( $comment_id, $custom_key_comment_title );
    }
    return false;
}
add_action( 'comment_post', 'save_custom_comment_field' );
add_action( 'edit_comment', 'save_custom_comment_field' );

// 管理画面でコメント編集時にタイトルを表示するためのメタボックスを追加
function add_title_comment_field_box() {
    global $comment;
    $comment_ID = $comment->comment_ID;
    $custom_key_comment_title = 'comtitle';
    $noncename = 'comment_noncename';
    $get_comment_title = esc_attr( get_comment_meta( $comment_ID, $custom_key_comment_title, true ) );

    echo '<input type="hidden" name="' . $noncename . '" id="' . $noncename . '" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '">' . "\n";
    echo '<p class="comment-form-title"><label for="comment-title">タイトル：</label><input id="' . $custom_key_comment_title . '" name="' . $custom_key_comment_title . '" type="text" value="' . $get_comment_title . '" size="15"><br>' . "\n";
}
add_action( 'add_meta_boxes_comment', 'add_title_comment_field_box' );

// 管理画面でコメント返信時にタイトルフィールドを追加
function add_title_to_admin_reply_form() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // 返信フォームのテキストエリアの上に入力フィールドを追加
        $('#replycontent').before(
            '<p><label for="reply-title"><?php _e('返信のタイトル'); ?>: </label>' +
            '<input type="text" name="comtitle" id="reply-title" class="widefat" /></p>'
        );
    });
    </script>
    <?php
}
add_action('admin_print_footer_scripts', 'add_title_to_admin_reply_form');

// 管理画面からの返信時にタイトルを保存
function save_reply_title_from_admin($comment_id) {
    if (isset($_POST['comtitle'])) {
        $reply_title = sanitize_text_field($_POST['comtitle']);
        if (!empty($reply_title)) {
            update_comment_meta($comment_id, 'comtitle', $reply_title);
        } else {
            delete_comment_meta($comment_id, 'comtitle');
        }
    }
}
add_action('edit_comment', 'save_reply_title_from_admin');
add_action('wp_insert_comment', 'save_reply_title_from_admin'); // コメント返信時にも動作するように追加

// カスタマイズしたコメントの表示形式
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $comment_ID = $comment->comment_ID;
    $get_comment_title = esc_attr( get_comment_meta( $comment->comment_ID, 'comtitle', true ) ); ?>

    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

            <!-- アバター独自にする場合は。名前表示させる場合は .fn 現在display:none -->
            <!-- <div class="comment-author vcard">
                <?php echo get_avatar($comment, 32); ?>
                <cite class="fn"><?php echo get_comment_author_link(); ?></cite> <span class="says">より:</span>
            </div> -->

            <?php if ($get_comment_title) : ?>
                <div class="comment-title"><?php echo $get_comment_title; ?></div>
            <?php endif; ?>

            <!-- 時間表示させる場合。現在display:none -->
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?></a>
            </div>

            <?php comment_text(); ?>

        </div>
        <?php if ($comment->children): ?>
            <ol class="children">
                <?php wp_list_comments(array('style' => 'ol', 'callback' => 'mytheme_comment'), $comment->children); ?>
            </ol>
        <?php endif; ?>
    </li>
    <?php
}
?>