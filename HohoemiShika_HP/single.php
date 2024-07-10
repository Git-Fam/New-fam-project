<?php get_header(); ?>

<main>
    <div class="frontPage">


        <div class="C_single">
            <div class="C_single--content">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <div class="content--title">
                            <div class="tag">ブログ</div>
                            <h3 class="TL"><?php the_title(); ?></h3>
                            <p class="time"><?php the_date('Y.m.d'); ?></p>
                        </div>
                        <div class="content--text">
                            <p class="TX"><?php the_content(); ?></p>
                        </div>
                <?php endwhile;
                endif; ?>
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
        </div>

    </div>
</main>

<?php get_footer(); ?>