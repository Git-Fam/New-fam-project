<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>
<?php get_template_part('inc/loading'); ?>

<!-- single -->
<div class="single">

    <div class="single--img"></div>

    <div class="single--wap">
        <div class="single--wap--content">
            <div class="single--wap--content--title">
                <div class="single--wap--content--title--img">
                    <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.png'; ?>" alt="">
                </div>
                <div class="single--wap--content--title--title">
                    <p class="TL"><?php the_title(); ?></p>
                </div>
                <div class="single--wap--content--title--time">
                    <p class="TX"><?php the_time('Y.m.d'); ?></p>
                </div>
            </div>
            <div class="single--wap--content--text">
                <p><?php the_content(); ?></p>
                <div class="single-nation">
                    <div class="single-nation-text">
                        <?php
                        $next_post = get_adjacent_post(true, '', false, 'category');
                        if (!empty($next_post)): ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>">前の記事へ</a>
                        <?php endif; ?>
                    </div>
                    <div class="single-nation-text">
                        <a href="javascript:window.close()">戻る</a>
                    </div>
                    <div class="single-nation-text">
                        <?php
                        $prev_post = get_adjacent_post(true, '', true, 'category');
                        if (!empty($prev_post)): ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>">次の記事へ</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>