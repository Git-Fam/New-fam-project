<?php 
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<div class="game-main">
    <div class="game-wrap">
        <div class="game--menu-btn">
            <?php get_template_part('inc/menu-btn'); ?>
        </div>
        <div class="inner" id="game-single_inner">
            <div class="game-single_wrap">
                
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
