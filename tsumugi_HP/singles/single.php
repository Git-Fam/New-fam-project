<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>



<main class="news-single">
    <div class="inner">
    <?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post(); ?>

            <article class="news-detail">
                <div class="detail-wrap title-wrap">
                    <div class="top-wrap">
                        <div class="icon"></div>
                        <time datetime="<?php the_time('Y-m-d'); ?>" class="date"><?php the_time('Y.m.d'); ?></time>
                        <span class="cat">
                            <?php $cat = get_the_category(); if ($cat) echo $cat[0]->name; ?>
                        </span>
                    </div>
                    <h3 class="title"><?php the_title(); ?></h3>
                </div>

                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>

            <!-- 前後ナビ -->
            <div class="post-nav">
                <div class="prev arrow"><?php previous_post_link('%link', 'PREV'); ?></div>
                <div class="archive"><a href="<?php echo home_url(); ?>/news">お知らせ一覧へ</a></div>
                <div class="next arrow"><?php next_post_link('%link', 'NEXT'); ?></div>
            </div>

        <?php
        endwhile; ?>
    <?php else: ?>
        <p>記事が見つかりませんでした。</p>
    <?php endif; ?>
    </div>
</main>




<?php get_template_part('./inc/footer'); ?>
