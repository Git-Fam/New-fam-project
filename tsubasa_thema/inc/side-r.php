<div class="side side-r">
    <div class="side-bg">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-bg.webp" alt="">
    </div>
    <div class="side-inr">
        <div class="side-r-menu">
            <div class="side-r-billboard">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-billboard.webp" alt="">
            </div>
            <div class="header-menu sp-nav">
                <?php get_template_part('inc/header-menu-inr'); ?>
            </div>
        </div>
        <div class="side-r-lawn-01">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-lawn-01.webp" alt="">
        </div>
        <div class="side-r-lawn-02">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-lawn-02.webp" alt="">
        </div>
        <div class="side-r-mushroom">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-mushroom.webp" alt="">
        </div>
        <div class="side-r-news">
            <div class="side-r-news-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-news-bg.webp" alt="">
            </div>
            <div class="side-r-news-inr">
                <div class="side-r-news-items">
                    <?php
                    $side_news = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => 2,
                        'no_found_rows'  => true,
                    ]);
                    if ($side_news->have_posts()):
                        while ($side_news->have_posts()): $side_news->the_post();
                    ?>
                        <a class="side-r-news-items-link" href="<?php the_permalink(); ?>">
                            <div class="info-wrap">
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
                                    echo '<p class="TL">' . esc_html($selected_cat->name) . '</p>';
                                }
                                ?>
                            </div>
                            <h3 class="TX"><?php the_title(); ?></h3>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                    ?>
                        <p class="nothing-TX">新着情報はありません</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="side-r-char">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/side-r-char-01.webp" alt="">
            </div>
        </div>

    </div>
</div>