<?php 
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
get_header();
?>

<div class="columns">
    <div class="columns--main">
        <div class="columns--wrap">
            <div class="columns--title">
                <h2 class="TL">検索結果</h2>
            </div>
            <div class="columns--container">
                <div class="columns--container--inner">
                    <div class="columns_contents border">
                        <ul class="columns_contents--inner">
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <li class="hover-opa">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="thumbnail">
                                            <img src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/noimage.webp'; ?>" alt="">
                                        </div>
                                        <div class="title">
                                            <h3 class="TL"><?php the_title(); ?></h3>
                                        </div>
                                        <div class="time">
                                            <p class="TX"><?php the_time('Y.m.d'); ?></p>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; else: ?>
                                    <p>検索結果が見つかりませんでした。</p>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="columns_pageNation">
                        <div class="columns_pageNation--inner">
                            <?php
                            if (function_exists('wp_pagenavi')) {
                                wp_pagenavi();
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