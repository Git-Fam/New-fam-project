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
                        <p>①ほにゃらら</p>
                        <p>①ほにゃらら</p>
                        <p>①ほにゃらら</p>
                    </div>
                    <form action="" method="post">
                        <div class="game-single_comment_input">
                            <div class="input-wrap">
                                <input type="text" name="game-single_comment_input" id="game-single_comment_input">
                            </div>
                            <button type="submit" name="game-single_comment_submit" id="game-single_comment_submit">送信</button>
                        </div>
                    </form>
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
        </div>
        <div class="lever"></div>
        <div class="btn"></div>
    </div>
</div>

<?php get_footer(); ?>