<?php get_header(); ?>
<div class="archive-topics">
    <section class="Archiv_TopTopics">
        <?php
        $latest_post = new WP_Query(array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($latest_post->have_posts()) : while ($latest_post->have_posts()) : $latest_post->the_post();
        ?>
                <div class="C_TopTopics">
                    <a class="container hover-opa" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                        <div class="container--top">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="iCatch" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div>
                            <?php else : ?>
                                <div class="iCatch"></div>
                            <?php endif; ?>
                            <div class="title">
                                <p class="TX">TOP TOPICS</p>
                                <h3 class="TL"><?php the_title(); ?></h3>
                            </div>
                        </div>
                        <div class="contents">
                            <p class="TX"><?php the_content(); ?></p>
                        </div>
                    </a>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </section>
    <section class="Archiv_Topics">
        <div class="C_Topics">
            <div class="C_Topics--inner">
                <div class="container">
                    <ul class="lists">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <li>
                                    <a class="hover-opa" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <div class="content">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="iCatch" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div>
                                            <?php else : ?>
                                                <div class="iCatch"></div>
                                            <?php endif; ?>
                                            <div class="title">
                                                <p class="date"><?php the_time('Y.m.d'); ?></p>
                                                <h3 class="TL"><?php the_title(); ?></h3>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                        <?php endwhile;
                        endif; ?>
                        <?php if (!have_posts()) : ?>
                            <p>まだ投稿がありません。</p>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- ページネーション -->
                <div class="page_nation">
                <?php wp_pagenavi(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>