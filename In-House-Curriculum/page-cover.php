<?php
// クエリパラメータから記事IDを取得
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
if ($post_id) :
    $queried_post = get_post($post_id);

    if ($queried_post) :
        // 現在の投稿IDを取得
        $current_post_id = $queried_post->ID;

        // 投稿一覧を取得（Post Types Orderの並び順に従う）
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
            'suppress_filters' => false,
        );

        $all_posts = new WP_Query($args);
        wp_reset_postdata();
    endif;
endif;
?>
<?php
get_header();
?>
<div class="cover-wrapper">
    <div class="cover">
        <div class="cover-header">
            <p class="TL">
                カリキュラム選択 〉
                <?php
                    $categories = get_the_category($queried_post->ID);
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                ?> 
                〉<?php echo esc_html($queried_post->post_title); ?>
            </p>
            <div class="btn" id="cover-btn"></div>
        </div>

        <div class="tab-wrap" id="tab-wrap">
            <div class="archive--contents--tab">
                <?php
                    $categories = get_categories(array('parent' => 0));
                    foreach ($categories as $category):
                        // 各カテゴリの最初の投稿を取得
                        $first_post = get_posts(array(
                            'category' => $category->term_id,
                            'posts_per_page' => 1,
                            'order' => 'ASC'
                        ));
                        $first_post_id = !empty($first_post) ? $first_post[0]->ID : null;

                        $image_file_name = $category->slug . '.png';
                ?>
                    <div class="archive--item">
                        <a href="<?php echo esc_url(site_url('/cover/?post_id=' . $first_post_id)); ?>" class="archive--item--link">
                            <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                        </a>
                        <div class="archive--item--title">
                            <p class="TX"><?php echo esc_html($category->name); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <a href="<?php echo site_url('/chat'); ?>" class="chara-link koinubox">
            <div class="koinu"></div>
            <p class="link">チャット...</p>
        </a>
        <div class="tree tree01"></div>
        <a href="<?php echo site_url('/question'); ?>" class="chara-link goatbox">
            <div class="goat"></div>
            <p class="link">質問する？</p>
        </a>
        <div class="tree tree02"></div>
        <div class="cover-content">
            <div class="intermediate-page" id="cover-curriculum">
                <div class="TL-wrap">
                    <p class="post-TL"><?php echo esc_html($queried_post->post_title); ?></p>
                    <?php
                        if ($queried_post) :
                    ?>
                    <?php else : ?>
                        <p class="post-TL error">記事が見つかりませんでした。</p>
                    <?php endif; ?>
                </div>

                <div class="post-thumbnail">
                    <a href="<?php echo get_permalink($queried_post); ?>">
                        <?php 
                            if ($queried_post && has_post_thumbnail($queried_post)) {
                                echo '<img class="img" src="' . esc_url(get_the_post_thumbnail_url($queried_post)) . '" alt="">';
                            } else {
                                echo '<img class="img" src="' . esc_url(get_template_directory_uri() . '/img/no-img.png') . '" alt="No Image Available">';
                            }
                        ?>
                    </a>
                </div>

                <a href="<?php echo get_permalink($queried_post); ?>" class="start-btn">はじめる</a>
            </div>
            <div class="shironeko-wrap">
                <div class="shironeko pyon"></div>
                <div class="shadow"></div>
            </div>
        </div>

        <div class="back-wrap">
            <div class="back"></div>
            <a href="javascript:window.close()" class="TX">戻る</a>
        </div>

        <?php
        if ($post_id && $queried_post) :
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
                'suppress_filters' => false,
            );

            $all_posts = new WP_Query($args);
            $next_post_id = null;

            if ($all_posts->have_posts()) :
                $found_current = false;
                while ($all_posts->have_posts()) : $all_posts->the_post();
                    if ($found_current) {
                        $next_post_id = get_the_ID();
                        break;
                    }
                    if (get_the_ID() == $current_post_id) {
                        $found_current = true;
                    }
                endwhile;

                if (!$next_post_id && $found_current) {
                    $all_posts->rewind_posts();
                    $all_posts->the_post();
                    $next_post_id = get_the_ID();
                }
            endif;
            wp_reset_postdata();

            if ($next_post_id):
        ?>
                <a href="<?php echo esc_url(site_url('/cover/?post_id=' . $next_post_id)); ?>" class="next">
                    <p class="next-link">次に進む</p>
                </a>
        <?php
            else:
                echo '<p>次の記事はありません。</p>';
            endif;
        endif;
        ?>
        <div class="grass grass01"></div>
        <div class="grass grass02"></div>
    </div>
</div>
<?php
get_footer();
?>
