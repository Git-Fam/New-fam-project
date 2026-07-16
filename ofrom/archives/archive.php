<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自 -->
<main class="page_main_contents">
    <div class="page_news page_archive">

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
                    <div class="main_area s-pop">
                        <?php if (have_posts()): ?>
                        <ul class="article_list">
                            <?php while (have_posts()):
                                the_post(); ?>
                            <li class="item">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="article_item">
                                        <div class="info">
                                            <time class="time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                                            <?php
                                            $cats = get_the_category();
                                            $default_cat_id = get_option( 'default_category' );
                                            $cat_name = '';
                                            if ( $cats ) {
                                                foreach ( $cats as $c ) {
                                                    if ( (int) $c->term_id !== (int) $default_cat_id ) {
                                                        $cat_name = $c->name;
                                                        break;
                                                    }
                                                }
                                                if ( $cat_name === '' && ! empty( $cats ) ) {
                                                    $cat_name = $cats[0]->name;
                                                }
                                            }
                                            if ( $cat_name ) : ?>
                                            <div class="category"><?php echo esc_html( $cat_name ); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ttl">
                                            <h3 class="TL"><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/more-btn.svg" alt="MORE">
                                    </div>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php else: ?>
                                <p class="no-TX">投稿はありません</p>
                        <?php endif; ?>
                        <?php if ( have_posts() && $GLOBALS['wp_query']->max_num_pages > 1 ) : ?>
                        <div class="paging">
                            <?php
                            the_posts_pagination( array(
                                'mid_size'  => 1,
                                'prev_text' => '',
                                'next_text' => '',
                            ) );
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php get_template_part('./inc/category'); ?>

                </div>

            </div>
        </section>


    </div>
</main>
<!-- 独自 end -->



<?php get_template_part('./inc/footer'); ?>