<?php get_header(); ?>

<div class="game-main">
    <div class="game-wrap">
        <div class="inner" id="game-single_inner">
            <div class="game-single_wrap">
                <div class="game-single_comment">
                    <div class="game-single_comment_title">
                        <h2 class="TL">回答を入力しよう</h2>
                    </div>
                    <div class="game-single_comment_selection">
                        <!-- コメントリストの表示 -->
                        <?php
                        // 現在のユーザー情報を取得
                        $current_user = wp_get_current_user();

                        // 全てのコメント（承認されていないコメントも含む）を取得するクエリ
                        $comments = get_comments(array(
                            'post_id'   => get_the_ID(), // 現在の投稿のID
                            'status'    => 'all',        // 'approve' ではなく 'all' で全てのコメントを取得
                            'author__in' => array($current_user->ID), // 現在のユーザーのIDと一致するコメントのみ
                        ));

                        if (!empty($comments)) :
                        ?>

                        <ol class="comment-list">
                            <?php
                            // 取得したコメントを wp_list_comments で表示
                            wp_list_comments(array(
                                'style'      => 'ol',
                                'short_ping' => true,
                                'avatar_size' => 50, // アバターのサイズ
                            ), $comments);
                            ?>
                        </ol>
                        <?php else : ?>
                            <p>まだ回答していません。</p>
                        <?php endif; ?>
                    </div>






                        <div class="game-single_comment_input">
                            <?php
                            if (comments_open()) {
                                comment_form();
                            } else {
                                echo '<p>コメントは受け付けていません。</p>';
                            }
                            ?>

                            <!-- <div class="input-wrap">
                                <input type="text" name="game-single_comment_input" id="game-single_comment_input">
                            </div>
                            <button type="submit" name="game-single_comment_submit" id="game-single_comment_submit">送信</button> -->
                        </div>
                </div>

                <div class="game-single_content">
                    <div class="game-single_content_wrap">
                        <div class="game-single_content_wrap_inner">
                            <?php
                            if (have_posts()) : while (have_posts()) : the_post();
                                    $thumbnail_url = get_the_post_thumbnail_url();
                            ?>
                                    <div class="game-single_content_title">
                                        <h2 class="TL"><?php the_title(); ?></h2>
                                    </div>
                                    <div class="game-single_content_text">
                                        <p><?php the_content(); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>該当する投稿がありません。</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chara-box">
                <div class="game-character">
                    <div class="img">
                    </div>
                </div>
                <div class="text-frame">
                    <p class="TX">きみならできる！</p>
                </div>

                <div class="game-mob">
                    <div class="img delay-04"></div>
                    <div class="img"></div>
                    <div class="img delay-04"></div>
                </div>
            </div>

        </div>
        <div class="lever"></div>
        <div class="btn"></div>
    </div>
</div>

<?php get_footer(); ?>
