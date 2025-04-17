<?php
/*
 Template Name: works
 Template Post Type: page
 Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="works">
    <section class="works__works">
        <?php
        // 現在のカテゴリーを取得
        $current_category = isset($_GET['category']) ? $_GET['category'] : 'all'; // デフォルトを 'all' に設定

        ?>

        <div class="C_worksCategory">
            <ul class="list">
                <?php
                $categories = get_categories();
                usort($categories, function ($a, $b) {
                    return $a->slug === 'all' ? -1 : ($b->slug === 'all' ? 1 : 0);
                });

                foreach ($categories as $category) {
                    // 現在のカテゴリーと一致する場合にis-activeを付与
                    $active_class = ($category->slug === $current_category) ? 'is-active' : '';

                    // 現在のURLからpage/を削除
                    $base_url = preg_replace('/page\/\d+\//', '', strtok($_SERVER["REQUEST_URI"], '?'));
                    $category_url = $base_url . '?category=' . $category->slug;
                ?>
                    <li class="item <?php echo $active_class; ?>" category="<?php echo $category->slug; ?>">
                        <a href="<?php echo $category_url; ?>" class="item--inner">
                            <p class="TX"><?php echo $category->name; ?></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>


        <div class="C_worksPosts">

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => 'post', // 投稿タイプを指定
                'posts_per_page' => 5, // 表示する投稿数
                'category_name' => isset($_GET['category']) ? $_GET['category'] : '', // URLパラメータからカテゴリーを取得
                'paged' => $paged, // ページ番号を設定
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>

                <ul class="list">

                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <li class="item">
                            <div class="img__area">
                                <div class="card--img">
                                    <?php
                                    $scf_field = SCF::get('construction_place_image_before');
                                    $img_src = wp_get_attachment_image_src($scf_field, 'full');
                                    ?>
                                    <img src="<?php echo $img_src[0]; ?>" alt="">
                                    <div class="card--img--title">
                                        <p class="TL">BEFORE</p>
                                    </div>
                                </div>
                                <div class="card--img">
                                    <?php
                                    $scf_field = SCF::get('construction_place_image_after');
                                    $img_src = wp_get_attachment_image_src($scf_field, 'full');
                                    ?>
                                    <img src="<?php echo $img_src[0]; ?>" alt="">
                                    <div class="card--img--title">
                                        <p class="TL">AFTER</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category__area">

                                <?php
                                $construction_place = SCF::get('construction_place');
                                foreach ($construction_place as $fields) {
                                ?>
                                    <h3 class="TX"><?php echo $fields['construction_place_individual']; ?></h3>
                                <?php } ?>
                            </div>
                            <div class="text__area">
                                <p class="TX">
                                    <?php
                                    $scf_field = SCF::get('construction_place_description');
                                    echo nl2br($scf_field);
                                    ?>
                                </p>
                            </div>
                        </li>
                    <?php endwhile; ?>

                </ul>

                <div class="page-nav">
                    <?php wp_pagenavi(array('query' => $query)); ?>
                </div>

            <?php else : ?>
                <p>準備中です。しばらくお待ちください。</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</div>


<?php get_template_part('./inc/footer'); ?>