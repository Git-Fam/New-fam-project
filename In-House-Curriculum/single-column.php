<?php 
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<div class="columns">
    <div class="columns--main columns--main--single">
        <?php get_template_part('category-side'); ?>

        <?php
        if (have_posts()) : while (have_posts()) : the_post();
                $thumbnail_url = get_the_post_thumbnail_url();
        ?>
                <div class="columns--single">
                    <div class="columns--single--inner">
                        <div class="title">
                            <h2 class="TL"><?php the_title(); ?></h2>
                        </div>
                        <div class="content">
                            <img class="thumbnail" src="<?php echo $thumbnail_url ? $thumbnail_url : get_template_directory_uri() . '/img/noimage.webp'; ?>" alt="">
                            <div class="content--text">
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                        <div class="single--nation">
                            <div class="single--nation--text">
                                <?php if (get_next_post()): ?>
                                    <?php next_post_link('%link', '次の記事へ'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="single--nation--text">
                                <a href="javascript:window.close()">戻る</a>
                            </div>
                            <div class="single--nation--text">
                                <?php if (get_previous_post()): ?>
                                    <?php previous_post_link('%link', '前の記事へ'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>