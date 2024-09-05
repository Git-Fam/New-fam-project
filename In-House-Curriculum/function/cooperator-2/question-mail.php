<?php
// コメントが投稿されたときにメールを送信する
add_action('comment_post', 'notify_on_comment', 10, 2);

function notify_on_comment($comment_id, $comment_approved)
{
    // コメントが承認された場合のみメールを送信
    if (1 === $comment_approved) {
        $comment = get_comment($comment_id); // コメントオブジェクトを取得
        $post_id = $comment->comment_post_ID; // コメントが投稿された投稿のIDを取得
        $post_type = get_post_type($post_id); // 投稿タイプを取得

        // カスタム投稿タイプ「講師への質問」の場合のみメールを送信
        if ('question' === $post_type) {
            // 通知を受け取るメールアドレスを配列として指定
            $to = array('ikumi.kaku818@gmail.com', 'ari.yasu.da8@i.softbank.jp', 'iku.doremi0717@gmail.com'); 

            $subject = '新しいコメントが投稿されました: ' . get_the_title($post_id);
            $message = '新しいコメントが投稿されました。' . "\r\n\r\n";
            $message .= '投稿タイトル: ' . get_the_title($post_id) . "\r\n";
            $message .= 'コメント内容: ' . $comment->comment_content . "\r\n";
            $message .= 'コメント投稿者: ' . $comment->comment_author . "\r\n";
            $message .= 'コメントURL: ' . get_comment_link($comment_id) . "\r\n";

            // メールを送信
            wp_mail($to, $subject, $message);
        }
    }
}
?>
