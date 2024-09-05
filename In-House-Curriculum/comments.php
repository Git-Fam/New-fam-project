<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <!-- コメントフォームを常に表示 -->
    <?php comment_form(); ?>

    <?php
    // コメントが閉じられている場合のメッセージ表示
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php esc_html_e( '現在質問を受け付けていません', 'In-House-Curriculum' ); ?></p>
    <?php endif; ?>

</div><!-- #comments -->
