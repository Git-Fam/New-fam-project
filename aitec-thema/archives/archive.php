<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="bbb">アーカイブ</div>

<?php if (have_posts()): ?>
    <div class="post-list">
        <?php while (have_posts()):
            the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php
        endwhile; ?>
    </div>
<?php else: ?>
    <p>投稿はありません</p>
<?php endif; ?>


<?php get_template_part('./inc/footer'); ?>
