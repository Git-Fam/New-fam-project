<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="page-news">
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

    <section class="news-contents">

        <div class="category-btns">
            <?php
            // 表示順の優先スラッグ（すべて → お知らせ → 診療について → それ以外）
            $priority_slugs = ['news', 'about-medical'];
            $cats = get_categories(['hide_empty' => true]);
            usort($cats, function ($a, $b) use ($priority_slugs) {
                $ia = array_search($a->slug, $priority_slugs);
                $ib = array_search($b->slug, $priority_slugs);
                if ($ia === false) $ia = PHP_INT_MAX;
                if ($ib === false) $ib = PHP_INT_MAX;
                return $ia <=> $ib;
            });
            $current_cat_id = is_category() ? get_queried_object_id() : 0;
            ?>
            <a class="category-btn <?php echo !is_category() ? 'is-selected' : ''; ?>" href="<?php echo esc_url(home_url('/news/')); ?>">すべて</a>
            <?php foreach ($cats as $cat): ?>
                <a class="category-btn <?php echo ($current_cat_id === $cat->term_id) ? 'is-selected' : ''; ?>" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
            <?php endforeach; ?>
        </div>

        <?php if (have_posts()): ?>

            <ul class="news-list">

                <?php while (have_posts()):
                    the_post(); ?>

                    <li class="news-list-item">
                        <a class="news-list-item-link" href="<?php the_permalink(); ?>">
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
                        </a>
                    </li>
                <?php
                endwhile; ?>

            <?php else: ?>
                <li>投稿はありません</li>
            <?php endif; ?>
            </ul>

            <?php
            global $wp_query;
            $total_pages = (int) $wp_query->max_num_pages;
            $paged = max(1, (int) get_query_var('paged'));
            if ($total_pages > 1):
            ?>
            <div class="pagination">
                <?php if ($paged > 1): ?>
                    <a class="pagination-btn prev" href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/btn-prev.svg" alt="PREV">
                    </a>
                <?php endif; ?>
                <div class="pagination-num">
                    <?php
                    $dots = false;
                    for ($i = 1; $i <= $total_pages; $i++):
                        // 先頭・末尾・現在ページの前後1つを表示、それ以外は『…』でまとめる
                        if ($i === 1 || $i === $total_pages || abs($i - $paged) <= 1):
                            $dots = true;
                            if ($i === $paged): ?>
                                <a href="" class="TX is-selected"><?php echo $i; ?></a>
                            <?php else: ?>
                                <a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="TX"><?php echo $i; ?></a>
                            <?php endif;
                        elseif ($dots): ?>
                            <span class="TX">…</span>
                        <?php
                            $dots = false;
                        endif;
                    endfor;
                    ?>
                </div>
                <?php if ($paged < $total_pages): ?>
                    <a class="pagination-btn next" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/news/btn-next.svg" alt="NEXT">
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>


    </section>
</div>


<?php get_template_part('./inc/footer'); ?>