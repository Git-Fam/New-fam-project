
<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="news-archive">
    <div class="inner">

        <h1 class="page-title">お知らせ</h1>

        <!-- カテゴリータブ -->
        <div class="news-tabs">
            <ul>
                <li><a href="<?php echo get_post_type_archive_link('news'); ?>" class="<?php if(!is_category()) echo 'active'; ?>">すべて</a></li>
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'category',
                    'orderby' => 'term_order',
                    'order'   => 'ASC',
                ));
                foreach($categories as $cat) :
                ?>
                    <li><a href="<?php echo get_category_link($cat->term_id); ?>" class="<?php if(is_category($cat->slug)) echo 'active'; ?>">
                        <?php echo $cat->name; ?>
                    </a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- 投稿ループ -->
        <div class="news-list">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article class="news-item">
                    <a href="<?php the_permalink(); ?>">
                        <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                        <span class="cat">
                            <?php $cat = get_the_category(); if ($cat) echo $cat[0]->name; ?>
                        </span>
                        <h2><?php the_title(); ?></h2>
                    </a>
                </article>
            <?php endwhile; else : ?>
                <p>お知らせはまだありません。</p>
            <?php endif; ?>
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'mid_size' => 1,
                'prev_text' => '« 前へ',
                'next_text' => '次へ »',
            ));
            ?>
        </div>

    </div>
</main>

<?php get_template_part('./inc/footer'); ?>
