<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-single">
    <div class="page-single--inner">
        <section class="single_content">
            <div class="single_content--inner">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()):
                        the_post(); ?>
                        <div class="info">
                            <p class="time"><?php the_time('Y.m.d'); ?></p>
                            <p class="category"><?php
                                                $categories = get_the_category();
                                                if (!empty($categories)) {
                                                    echo esc_html($categories[0]->name);
                                                }
                                                ?></p>
                        </div>
                        <div class="ttl">
                            <h2 class="TL">
                                <?php the_title(); ?>
                            </h2>
                        </div>
                        <div class="thumbnail">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/front/front-news-card-thumbnail.webp" alt="サムネイル">
                            <?php endif; ?>
                        </div>
                        <div class="contents">
                            <?php the_content(); ?>
                        </div>
                    <?php
                    endwhile; ?>
                <?php else: ?>
                    <p>記事が見つかりませんでした。</p>
                <?php endif; ?>
            </div>

            <div class="single_content--nav">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                <?php if ($prev_post) : ?>
                    <a class="prev hover-opa" href="<?php echo esc_url(get_permalink($prev_post)); ?>"></a>
                <?php else : ?>
                    <a class="prev is-disabled"style="display: none;"></a>
                <?php endif; ?>
                <?php if ($next_post) : ?>
                    <a class="next hover-opa" href="<?php echo esc_url(get_permalink($next_post)); ?>"></a>
                <?php else : ?>
                    <a class="next is-disabled" style="display: none;"></a>
                <?php endif; ?>
                <a class="list-link hover-opa" href="<?php echo home_url('/news'); ?>">
                    <p class="TX">一覧へ戻る</p>
                </a>
            </div>

            <div class="single_content--related">
                <?php
                $current_id = get_the_ID();
                $cats = get_the_category();
                $cat_ids = $cats ? array_map(function ($c) { return $c->term_id; }, $cats) : array();
                $related_args = array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => 3,
                    'post__not_in'   => array($current_id),
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                if (!empty($cat_ids)) {
                    $related_args['category__in'] = $cat_ids;
                }
                $related_query = new WP_Query($related_args);
                ?>
                <div class="related--ttl">
                    <h3 class="TL">関連記事</h3>
                </div>
                <div class="card-list">
                    <?php if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post();
                            $categories = get_the_category();
                            $cat_name = !empty($categories) ? $categories[0]->name : '';
                    ?>
                    <article class="card">
                        <a class="hover-opa" href="<?php the_permalink(); ?>">
                            <div class="thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/front/front-news-card-thumbnail.webp" alt="サムネイル">
                                <?php endif; ?>
                            </div>
                            <div class="card--inner">
                                <div class="info">
                                    <p class="time"><?php the_time('Y.m.d'); ?></p>
                                    <p class="category"><?php echo esc_html($cat_name); ?></p>
                                </div>
                                <div class="ttl">
                                    <h4 class="TL"><?php the_title(); ?></h4>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </div>

        </section>
    </div>
</div>
<!-- 独自ページ --end -->



<?php get_template_part('./inc/footer'); ?>