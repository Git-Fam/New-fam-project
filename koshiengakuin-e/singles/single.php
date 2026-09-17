<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="p-single">
    <div class="p-single__inner">

        <?php if (have_posts()): ?>
            <?php while (have_posts()):
                the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="p-single__head">
                        <div class="p-single__top">
                            <!-- date -->
                            <span class="p-single__date font-avenir"><?php echo get_the_date('Y.m.d'); ?></span>
                            <!-- カテゴリー -->
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                $category = $categories[0];
                                echo '<span class="c-label is-current">' . esc_html($category->name) . '</span>';
                            }
                            ?>
                        </div>

                        <h1 class="p-single__title"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()): ?>
                            <div class="p-single__thumbnail">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="p-single__content">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
            <?php
            endwhile; ?>
        <?php else: ?>
            <p>記事が見つかりませんでした。</p>
        <?php endif; ?>


        <div class="p-single__btn pc-mgt-90 sp-mgt-50">
            <a id="back-to-news" href="<?php echo esc_url(home_url('/news/')); ?>" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span>一覧に戻る</span></div>
            </a>
        </div>
        <script>
            (function() {
                try {
                    var state = JSON.parse(sessionStorage.getItem('koshienNewsArchive') || 'null');
                    if (state && state.url) {
                        var link = document.getElementById('back-to-news');
                        if (link) link.setAttribute('href', state.url);
                    }
                } catch (e) {}
            })();
        </script>

        <?php
        $other_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true,
        ));
        ?>
        <?php if ($other_query->have_posts()): ?>
            <div class="p-single-other pc-mgt-110 sp-mgt-120">
                <h3 class="p-single-other__title">その他の記事</h3>

                <div class="p-single-other__archive">
                    <div class="p-archive-2">
                        <?php
                        while ($other_query->have_posts()) {
                            $other_query->the_post();
                            $post_id = get_the_ID();
                            $thumb_id = get_post_thumbnail_id($post_id);
                            $thumb_url = $thumb_id ? wp_get_attachment_url($thumb_id) : get_template_directory_uri() . '/img/no-image.webp';
                            $post_date = get_the_date('Y.m.d');
                            $categories = get_the_category($post_id);
                            $category_name = !empty($categories) ? $categories[0]->name : 'お知らせ';
                        ?>
                            <a class="p-archive-2__item" href="<?php the_permalink(); ?>">
                                <div class="p-archive-2__image pc-mgb-10"><img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"></div>
                                <div class="p-archive-2__content">
                                    <div class="p-archive-2__head pc-mgb-5">
                                        <span class="p-archive-2__date font-avenir"><?php echo esc_html($post_date); ?></span>
                                        <div>
                                            <span class="c-label"><?php echo esc_html($category_name); ?></span>
                                        </div>
                                    </div>
                                    <span class="p-archive-2__title"><?php the_title(); ?></span>
                                </div>
                            </a>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_template_part('./inc/footer'); ?>