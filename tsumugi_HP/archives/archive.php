
<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="news-archive">
    <div class="inner">

        <!-- カテゴリータブ -->
        <div class="news-tabs">
            <ul class="tab-item">
                <!-- すべて -->
                <li class="tab <?php if (is_home() || is_post_type_archive('post')) {
                    echo 'active';
                } ?>">
                    <a href="<?php echo home_url('/news'); ?>">すべて</a>
                </li>

                <?php
                $categories = get_categories([
                    'taxonomy' => 'category',
                    'orderby' => 'term_order',
                    'order' => 'ASC',
                    'hide_empty' => true,
                ]);
                foreach ($categories as $cat): ?>
                    <li class="tab <?php if (is_category($cat->slug)) {
                        echo 'active';
                    } ?>">
                        <a href="<?php echo get_category_link($cat->term_id); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    </li>
                <?php endforeach;
                ?>
            </ul>
        </div>

        <!-- 投稿ループ -->
        <div class="news-list">
            <?php if (have_posts()):
                while (have_posts()):
                    the_post(); ?>
                <article class="news-item">
                    <a href="<?php the_permalink(); ?>" class="detail-wrap news-link">
                        <div class="sp-wrap">
                            <div class="icon"></div>
                            <time datetime="<?php the_time('Y-m-d'); ?>" class="date"><?php the_time('Y.m.d'); ?></time>
                            <span class="cat">
                                <?php
                                $cat = get_the_category();
                                if ($cat) {
                                    echo $cat[0]->name;
                                }
                                ?>
                            </span>
                        </div>
                        <h3 class="TL"><?php the_title(); ?></h3>
                        <p class="more">MORE</p>
                    </a>
                </article>
            <?php
                endwhile;
            else:
                 ?>
                <p>お知らせはまだありません。</p>
            <?php
            endif; ?>
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            <?php the_posts_pagination([
                'mid_size' => 1,
                'prev_text' => '　　　PREV',
                'next_text' => 'NEXT　　　',
            ]); ?>
        </div>

    </div>
    <div class="sec-decoration">
        <div class="img img-01 pc">
            <div class="char"></div>
        </div>
        <div class="img img-02">
            <div class="char"></div>
        </div>
    </div>
</main>

<?php get_template_part('./inc/footer'); ?>
