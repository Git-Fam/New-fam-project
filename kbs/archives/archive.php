<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>




<!-- メイン -->
<main class="main">

    <div class="main__example">

        <div class="section__wrapper max-size-medium">
            <div class="main__title">
                <div class="C_gra-vert-title">
                    <h2 class="TL type-02">施工事例</h2>
                </div>
            </div>
        </div>

        <section class="section_example max-size-small">

            <div class="C_selector">
                <div class="C_selector--inner">
                    <ul class="lists">
                        <li class="list selected" text-data="all">
                            <p class="TX">すべて</p>
                        </li>
                        <li class="list" text-data="footwork">
                            <p class="TX">足場</p>
                        </li>
                        <li class="list" text-data="paint">
                            <p class="TX">塗装</p>
                        </li>
                        <li class="list" text-data="waterproof">
                            <p class="TX">防水</p>
                        </li>
                        <li class="list" text-data="ceiling">
                            <p class="TX">シーリング</p>
                        </li>
                        <li class="list" text-data="roof">
                            <p class="TX">屋根工事</p>
                        </li>
                        <li class="list" text-data="interior">
                            <p class="TX">内装工事</p>
                        </li>
                    </ul>
                </div>
            </div>

            <?php if (have_posts()) : ?>

                <ul class="C_example-item">

                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        $categories = get_the_category();
                        $category_slugs = array_map(function ($cat) {
                            return $cat->slug;
                        }, $categories);
                        $category_slugs_string = implode(' ', $category_slugs);
                        ?>
                        <li class="item" text-data="<?php echo esc_attr($category_slugs_string); ?>">
                            <div class="img--area">
                                <div class="img--wrapper before">
                                    <?php
                                    $img_id = SCF::get('before_img');
                                    $img_data = wp_get_attachment_image_src($img_id, 'full');
                                    $url = $img_data[0];
                                    $alt = get_the_title();
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
                                </div>
                                <div class="img--wrapper after">
                                    <?php
                                    $img_id = SCF::get('after_img');
                                    $img_data = wp_get_attachment_image_src($img_id, 'full');
                                    $url = $img_data[0];
                                    $alt = get_the_title();
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
                                </div>
                            </div>
                            <div class="contents-area">
                                <div class="C_vert-title">
                                    <h3 class="TL">内装工事</h3>
                                </div>
                                <div class="TX--containaer">
                                    <p class="TX"><?php echo nl2br(get_post_meta($post->ID, 'ex_txt', true)); ?></p>
                                </div>
                            </div>
                        </li>

                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

        </section>

    </div>

</main>



<?php get_template_part('./inc/footer'); ?>