<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

// ===【進捗ロック機能】===
$locked = false; // デフォルトはロック解除（=表示OK）

$categories = get_the_category();
if ($categories) {
    $cat = $categories[0];
    $args = [
        'cat' => $cat->term_id,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
        'fields' => 'ids',
    ];
    $post_ids = get_posts($args);
    $current_post_id = get_the_ID();
    $my_index = array_search($current_post_id, $post_ids);
    if ($my_index !== false && $my_index > 0) {
        $prev_post_id = $post_ids[$my_index - 1];
        $prev_tags = get_the_tags($prev_post_id);
        if ($prev_tags && !is_wp_error($prev_tags)) {
            foreach ($prev_tags as $tag) {
                $field_name = $tag->slug;
                $progress = get_post_meta($prev_post_id, $field_name, true);
                if (intval($progress) < 100) {
                    $locked = true; // 前の記事の進捗が100未満ならロック！
                    break;
                }
            }
        }
    }
}

if ($locked) {
    include( locate_template( 'locked-screen.php' ) );
    exit;
}

// ===【進捗ロック機能ここまで】===



// 閲覧権限チェック
$current_user = wp_get_current_user();
$allowed_posts = get_user_meta($current_user->ID, 'allowed_posts', true);
if (!is_array($allowed_posts) || empty($allowed_posts)) {
    // デフォルトは全て許可
    $all_posts = get_posts(['numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish']);
    $allowed_posts = wp_list_pluck($all_posts, 'ID');
}
if (!in_array(get_the_ID(), $allowed_posts)) {
    wp_redirect(home_url('/viewing-limit'));
    exit;
}

get_header();
?>

<!-- <?php 
 get_template_part('inc/loading');  
?> -->

<!-- single -->
<div class="single">

    <div class="single--img"></div>

    <div class="single--link">
        <div class="single--link--chara"></div>
        <div class="single--link--bg">
            <div class="single--link--text">
                <?php
                $next_post = get_adjacent_post(true, '', false, 'category');
                if (!empty($next_post)): ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>">前の記事へ</a>
                <?php endif; ?>
            </div>
            <div class="single--link--text">
                <?php
                $prev_post = get_adjacent_post(true, '', true, 'category');
                if (!empty($prev_post)): ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">次の記事へ</a>
                <?php endif; ?>
            </div>
            <div class="single--link--text">
                <?php
                    $categories = get_the_category();
                    $category_param = '';
                    if (!empty($categories)) {
                        $category_param = '?category=' . urlencode($categories[0]->name);
                    }
                ?>
                <a href="<?php bloginfo('url'); ?>/curriculum<?php echo $category_param; ?>">MAPへ戻る</a>
            </div>
            <div class="single--link--text">
                <a href="#">ページTOPへ</a>
            </div>

        </div>
        
    </div>

    <div class="single--wap">
        <div class="single--wap--content">
            <div class="single--wap--content--title">
                <div class="single--wap--content--title--img">
                    <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.webp'; ?>" alt="">
                </div>
                <div class="single--wap--content--title--title">
                    <p class="TL"><?php the_title(); ?></p>
                </div>
                <div class="single--wap--content--title--time">
                    <p class="TX"><?php the_time('Y.m.d'); ?></p>
                </div>
            </div>
            <div class="single--wap--content--text">
                <p><?php the_content(); ?></p>


                <!-- 進捗のバー -->
                <?php
                // 投稿に付与されているタグ一覧を取得
                $tags = get_the_tags();

                if ($tags && !is_wp_error($tags)) {
                    foreach ($tags as $tag) {
                        $slug = $tag->slug;

                        // 進捗値（例：オプションやメタから取得してると仮定）
                        // ここは保存方法に合わせて書き換えてね
                        $progress_value = get_post_meta(get_the_ID(), 'progress_' . $slug, true);

                        if ($progress_value === '') $progress_value = 0; // デフォ値

                        ?>
                        <!-- HTML -->
                        <form class="progress" action="<?php echo home_url('/registered'); ?>" method="post">
                        <div class="update--item single-progress">
                            <div class="update--item--title">
                                <p class="count"><output class="count" id="value_<?php echo esc_attr($slug); ?>"><?php echo esc_attr($progress_value); ?></output>%</p>
                            </div>
                            <input class="progressBar"
                                id="pi_input_<?php echo esc_attr($slug); ?>"
                                name="<?php echo esc_attr($slug); ?>"
                                type="range"
                                min="0"
                                max="100"
                                step="1"
                                value="<?php echo esc_attr($progress_value); ?>"
                            />
                            <div class="progress--submit">
                                    <input type="submit" value="更新">
                            </div>

                        </div>
                        </form>
                        <!-- end -->
                        <?php
                    }
                }
                ?>
                <!-- バーend -->

                <div class="single-nation">
                    <div class="single-nation-text">
                        <?php
                        $next_post = get_adjacent_post(true, '', false, 'category');
                        if (!empty($next_post)): ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>">前の記事へ</a>
                        <?php endif; ?>
                    </div>
                    <div class="single-nation-text">
                        <?php
                            $categories = get_the_category();
                            $category_param = '';
                            if (!empty($categories)) {
                                $category_param = '?category=' . urlencode($categories[0]->name);
                            }
                        ?>
                        <a href="<?php bloginfo('url'); ?>/curriculum<?php echo $category_param; ?>">戻る</a>
                    </div>
                    <div class="single-nation-text">
                        <?php
                        $prev_post = get_adjacent_post(true, '', true, 'category');
                        if (!empty($prev_post)): ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>">次の記事へ</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="confetti">
        <canvas id="confettiBurst" style="position: absolute; inset: 0; pointer-events:none; z-index:2;"></canvas>
        <canvas id="confettiRain"  style="position: absolute; inset: 0; pointer-events:none; "></canvas>
        <div class="confetti--main">
            <img src="<?php echo get_template_directory_uri(); ?>/img/single-complete.webp" alt="完了おめでとう！">
            <div class="confetti--main-chara"></div>
        </div>
        <div class="close"></div>
    </div>
</div>  

<?php get_footer(); ?>