<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<div class="columns">
    <div class="columns--main">
        <?php
        get_template_part('category-side');
        ?>

        <div class="columns--wrap">
            <div class="columns--title">
                <h2 class="TL">コラム</h2>
            </div>
            <div class="pins">
                <div class="pin"></div>
                <div class="pin"></div>
                <div class="pin"></div>
                <div class="pin"></div>
            </div>
            <div class="columns--container">
                <div class="columns--container--inner">
                    <div class="columns_category border">
                        <p class="TX">Category >
                            <?php single_term_title(); ?>
                        </p>
                    </div>
                    <div class="columns_search border">
                        <div class="search-item">
                            <?php get_template_part('searchform', 'column'); ?>
                        </div>
                    </div>
                    <div class="columns_contents border">
                        <ul class="columns_contents--inner">

                            <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                            $args = array(
                                'posts_per_page' => 8,
                                'paged' => $paged,
                                'post_type' => 'column',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'column-cat',
                                        'field'    => 'slug',
                                        'terms'    => get_queried_object()->slug,
                                    ),
                                ),
                            );

                            $the_query = new WP_Query($args);

                            if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                    $thumbnail_url = get_the_post_thumbnail_url();
                            ?>
                                    <li class="hover-opa">
                                        <a href="<?php the_permalink(); ?>">
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
                    <div class="columns_pageNation">
                        <div class="columns_pageNation--inner">
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
    <div class="kinta"></div>
</div>

<?php get_footer(); ?>