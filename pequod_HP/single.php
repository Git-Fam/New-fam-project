<?php get_header(); ?>
<div class="single-topics">
    <section class="Single_Topics">
        <div class="C_TopTopics">
            <div class="container">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="container--top">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="iCatch" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div>
                            <?php else : ?>
                                <div class="iCatch"></div>
                            <?php endif; ?>
                            <div class="title">
                                <h3 class="TL"><?php the_title(); ?></h3>
                            </div>
                        </div>
                        <div class="contents">
                            <p class="TX"><?php the_content(); ?></p>
                        </div>
                <?php endwhile;
                endif; ?>
            </div>
        </div>
        <!-- ページネーション -->
        <div class="pageNation">
            <div class="pageNation__button hover-opa">
                <?php if (get_previous_post()) : ?>
                    <?php previous_post_link('%link', '前へ'); ?>
                <?php endif; ?>
            </div>
            <div class="pageNation__button hover-opa" onclick="window.close();">戻る</div>
            <div class="pageNation__button hover-opa">
                <?php if (get_next_post()) : ?>
                    <?php next_post_link('%link', '次へ'); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>