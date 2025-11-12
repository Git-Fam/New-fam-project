<?php get_header(); ?>

<main class="news-single">
    <div class="inner">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="news-detail">
                <div>
                    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                    <span class="cat">
                        <?php $cat = get_the_category(); if ($cat) echo $cat[0]->name; ?>
                    </span>
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>

                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>

            <!-- 前後ナビ -->
            <div class="post-nav">
                <div class="prev"><?php previous_post_link('%link', '« 前の記事'); ?></div>
                <div class="next"><?php next_post_link('%link', '次の記事 »'); ?></div>
            </div>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
