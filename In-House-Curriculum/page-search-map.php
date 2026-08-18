<?php 
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
get_header();
?>

<?php
// 検索キーワード取得（$_GETで直接取得）
$s = isset($_GET['s']) ? $_GET['s'] : '';
$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : 'post';
$paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

$args = array(
    'post_type' => $post_type, // 柔軟に
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'search_keywords',
            'value'   => $s,
            'compare' => 'LIKE',
        ),
        array(
            'key'     => 'img_alt_texts',
            'value'   => $s,
            'compare' => 'LIKE',
        ),
    ),
);
$query = new WP_Query($args);
?>


<div class="sp-wrap">
    <div class="road-wappaer">
        <div class="archive--contents--tab">
            
            <?php
            $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
            foreach ($categories as $category):
                // カテゴリーに対応する画像ファイル名を想定しています。実際には適切に設定してください。
                $image_file_name = $category->slug . '.webp';
            ?>
                <a class="archive--item" href="<?php bloginfo('url'); ?>/curriculum?category=<?php echo urlencode($category->name); ?>">
                    <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                    <div class="archive--item--title">
                        <p class="TX"><?php echo $category->name; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        
        <div class="archive--contents--items--wap active">
            <div class="road-header">
                <p class="TL">検索結果</p>
                <div class="btn-box">

                    <div class="columns_search border">
                        <div class="search-item">
                            <?php get_template_part('searchform-map', 'post'); ?>
                        </div>
                    </div>

                    <div class="road-menu-btn">
                        <?php get_template_part('inc/menu-btn'); ?>
                    </div>
                </div>
            </div>

            <div class="post-list active">
                <div class="post-list-inner">
                    <ul>
                        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                        <li>
                            <a class="post-link" href="<?php the_permalink(); ?>">
                                <div class="items--img">
                                    <img class="img" src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.webp'; ?>" alt="">
                                </div>
                                <div class="items--title">
                                    <h3 class="TL"><?php the_title(); ?></h3>
                                </div>
                            </a>
                            <?php endwhile; else: ?>
                                <p>検索結果が見つかりませんでした。</p>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </li>
                    </ul>
                                
                </div>
            </div>

        </div>

        

        
            <!-- <div class="columns--container">
                <div class="columns--container--inner">
                    <div class="columns_contents border">
                        <ul class="columns_contents--inner">
                            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
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
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <div class="columns_pageNation">
                        <div class="columns_pageNation--inner">
                            <?php
                            if (function_exists('wp_pagenavi')) {
                                wp_pagenavi(array('query' => $query));
                            }
                            ?>
                        </div>
                </div>
            </div> -->
        <!-- </div> -->
    </div>
</div>

<?php get_footer(); ?>