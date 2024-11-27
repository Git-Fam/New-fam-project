<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="main">
    <div class="main__inner">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <section class="C_other-contents">
                    <div class="title">
                        <h1 class="TL"><?php the_title(); ?></h1>
                    </div>
                    <div class="C_other-contents--container container__single">
                        <div class="C_other-contents--container--inner">
                            <div class="single--contents">
                                <div class="single--contents--img">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/noimage.png" alt="No Image">
                                    <?php endif; ?>
                                </div>
                                <div class="single--contents--text">
                                    <p><?php the_content(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endwhile; ?>
        <?php endif; ?>



    </div>
</main>

<?php get_template_part('./inc/footer'); ?>