<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="bbb">シングルblog</div>


<?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php
    endwhile; ?>
<?php else: ?>
    <p>記事が見つかりませんでした。</p>
<?php endif; ?>




<?php get_template_part('./inc/footer'); ?>
