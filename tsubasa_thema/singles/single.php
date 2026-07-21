<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="page-single">
    <section class="C_kv">
        <div class="C_kv-board">
            <h2 class="TL">お知らせ</h2>
        </div>
        <div class="C_kv-char">
            <div class="char-05">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-05.webp" alt="">
            </div>
        </div>
    </section>




    <section class="single-contents">

        <?php if (have_posts()): ?>
            <?php while (have_posts()):
                the_post(); ?>
                <div class="single-contents-ttl">
                    <div class="info-wrap">
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-inr-ttl-icon.svg" alt="">
                        <p class="TM"><?php the_time('Y.m.d'); ?></p>
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            $selected_cat = $categories[0];
                            foreach ($categories as $cat) {
                                if ($cat->slug === 'news') {
                                    $selected_cat = $cat;
                                    break;
                                }
                            }
                            echo '<p class="TG">' . esc_html($selected_cat->name) . '</p>';
                        }
                        ?>
                    </div>
                    <h3 class="TL"><?php the_title(); ?></h3>
                </div>

                <div class="single-contents-main" id="post-<?php the_ID(); ?>">
                    <?php the_content(); ?>
                <?php
            endwhile; ?>
            <?php else: ?>
                <p>記事が見つかりませんでした。</p>
            <?php endif; ?>
                </div>

                <div class="pagination">
                    <?php $prev_post = get_previous_post(); ?>
                    <?php if (!empty($prev_post)): ?>
                        <a class="pagination-btn prev" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/news/btn-prev.svg" alt="PREV">
                        </a>
                    <?php else: ?>
                    <?php endif; ?>
                    <a class="pagination-back-btn" href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ一覧へ</a>
                    <?php $next_post = get_next_post(); ?>
                    <?php if (!empty($next_post)): ?>
                        <a class="pagination-btn next" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/news/btn-next.svg" alt="NEXT">
                        </a>
                    <?php else: ?>
                    <?php endif; ?>
                </div>

    </section>

</div>


<?php get_template_part('./inc/footer'); ?>