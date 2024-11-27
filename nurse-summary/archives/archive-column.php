<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="main">
    <div class="main__inner">

        <section class="C_other-contents">
            <div class="title">
                <h1 class="TL">コラム記事一覧</h1>
            </div>
            <div class="C_other-contents--container container__archive">
                <div class="C_other-contents--container--inner">

                    <?php if (have_posts()) : ?>
                        <ul class="archive--lists">

                            <?php while (have_posts()) : the_post(); ?>
                                <li class="list" id="post-<?php the_ID(); ?>">
                                    <a href="<?php the_permalink(); ?>" class="list--link">
                                        <div class="list--img">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/noimage.png" alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="list--title">
                                            <h2 class="TL"><?php the_title(); ?></h2>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else : ?>
                        <p>投稿はありません</p>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <?php get_template_part('./inc/banner'); ?>
    </div>
</main>

<?php get_template_part('./inc/footer'); ?>