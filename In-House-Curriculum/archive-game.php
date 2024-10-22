<?php get_header(); ?>



        <div class="game-wrap">
            <div class="inner">
                <div class="game-container">

                    <div class="TL-box">
                    <p class="TL">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/game-START.svg" alt="START">
                    </p>
                    <div class="TX">
                    ミニゲーム。クイズや実装の研修が体験できるよ。<br>
                    今までに身についた知識のおさらいをしよう！<br>
                    あなたはどこまでできる？<br>
                    </div>
                    </div>
                    <div class="game-container-inner">
                        <div class="game_category border">
                            <p class="TX">Category >
                                <?php
                                if (is_tax('game-cat')) {
                                    single_term_title();
                                } else {
                                    echo 'ALL';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="game_search border">
                            <div class="search-item">
                                <?php get_template_part('searchform', 'game'); ?>
                            </div>
                        </div>
                        <div class="game_contents border">
                            <ul class="game_contents-inner">

                                <?php
                                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                $args = array(
                                    'posts_per_page' => 8,
                                    'paged' => $paged,
                                    'post_type' => 'game',
                                );

                                if (is_tax('game-cat')) {
                                    $args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'game-cat',
                                            'field'    => 'slug',
                                            'terms'    => get_queried_object()->slug,
                                        ),
                                    );
                                }

                                $the_query = new WP_Query($args);

                                if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                        $thumbnail_url = get_the_post_thumbnail_url();
                                ?>
                                        <li class="hover-opa">
                                            <a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                                <div class="thumbnail">
                                                    <img src="<?php echo $thumbnail_url ? $thumbnail_url : get_template_directory_uri() . '/img/noimage.jpg'; ?>" alt="">
                                                </div>
                                                <div class="title">
                                                    <h3 class="TL"><?php the_title(); ?></h3>
                                                </div>
                                                <div class="time">
                                                    <p class="TX"><?php the_time('Y.m.d'); ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endwhile;
                                else: ?>
                                    <p>まだ投稿がありません。</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="game_pageNation">
                            <div class="game_pageNation-inner">
                                <?php
                                if (function_exists('wp_pagenavi')) {
                                    wp_pagenavi(array('query' => $the_query));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kinta"></div>

<?php get_footer();?>