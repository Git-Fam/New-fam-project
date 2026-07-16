<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自 -->
<main class="page_main_contents">
    <div class="page_news">

        <section class="news_type_section">
            <div class="all_sec_inner"> 
                <div class="sec_ttl s-pop">
                    <h2 class="TL">
                        <picture>
                            <source srcset="<?php echo get_template_directory_uri(); ?>/img/news/news_ttl-sp.svg" media="(max-width: 767px)">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/news/news_ttl.svg" alt="NEWS / お知らせ">
                        </picture>
                    </h2>
                </div>

                <div class="news_contents">
                    <div class="main_area main_area_single s-pop">
                        <?php if (have_posts()): ?>
                            <?php while (have_posts()):
                                the_post(); ?>
                                <div class="article_area" id="post-<?php the_ID(); ?>">
                                    <div class="info">
                                        <?php
                                        $cats = get_the_category();
                                        $default_cat_id = get_option('default_category');
                                        $cat_name = '';
                                        if ($cats) {
                                            foreach ($cats as $c) {
                                                if ((int) $c->term_id !== (int) $default_cat_id) {
                                                    $cat_name = $c->name;
                                                    break;
                                                }
                                            }
                                            if ($cat_name === '' && ! empty($cats)) {
                                                $cat_name = $cats[0]->name;
                                            }
                                        }
                                        if ($cat_name) : ?>
                                            <div class="category"><?php echo esc_html($cat_name); ?></div>
                                        <?php endif; ?>
                                        <time class="time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                                    </div>
                                    <div class="ttl">
                                        <h3 class="TL"><?php the_title(); ?></h3>
                                    </div>
                                    <div class="txt">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            <?php
                            endwhile; ?>
                        <?php else: ?>
                            <p>記事が見つかりませんでした。</p>
                        <?php endif; ?>
                        <div class="single_nav">
                            <div class="back_to_list">
                                <a href="<?php echo home_url('/news'); ?>">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri(); ?>/img/news/back_to_list-btn-sp.svg" media="(max-width: 767px)">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/back_to_list-btn.svg" alt="一覧へ戻る">
                                    </picture>
                                </a>
                            </div>
                            <div class="nav_wrap">
                                <?php
                                $prev_post = get_previous_post();
                                $next_post = get_next_post();
                                ?>
                                <?php if ($prev_post) : ?>
                                    <a class="btn back-btn" href="<?php echo esc_url(get_permalink($prev_post)); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/back-btn.svg" alt="BACK">
                                    </a>
                                <?php endif; ?>
                                <?php if ($next_post) : ?>
                                    <a class="btn next-btn" href="<?php echo esc_url(get_permalink($next_post)); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/next-btn.svg" alt="NEXT">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php get_template_part('./inc/category'); ?>

                </div>

            </div>
        </section>


    </div>
</main>
<!-- 独自 end -->



<?php get_template_part('./inc/footer'); ?>