<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

if (session_status() === PHP_SESSION_NONE) session_start();
$show_confetti = !empty($_SESSION['confetti_show']);
unset($_SESSION['confetti_show']);

// 完了判定用：先に取得しておく
$tags = get_the_tags();
$slug = ($tags && !is_wp_error($tags)) ? $tags[0]->slug : '';
$progress = get_user_meta(get_current_user_id(), $slug, true);
$is_complete = intval($progress) >= 100;
$has_quiz = get_post_meta(get_the_ID(), '_has_quiz', true);

// ===【進捗ロック機能】===
$locked = false;
$current_user_id = get_current_user_id();
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
                $progress = get_user_meta($current_user_id, $field_name, true);
                if (intval($progress) < 100) {
                    $locked = true;
                    break;
                }
            }
        }
    }
}

if ($locked) {
    include(locate_template('locked-screen.php'));
    exit;
}

// === 閲覧権限制御 ===
$current_user = wp_get_current_user();
$allowed_posts = get_user_meta($current_user->ID, 'allowed_posts', true);
if (!is_array($allowed_posts) || empty($allowed_posts)) {
    $all_posts = get_posts(['numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish']);
    $allowed_posts = wp_list_pluck($all_posts, 'ID');
}
if (!in_array(get_the_ID(), $allowed_posts)) {
    wp_redirect(home_url('/viewing-limit'));
    exit;
}

get_header();
?>

<div class="single <?php echo esc_attr($slug); ?>">
    <div class="single--img"></div>

    <div class="single--link">
        <div class="single--link--chara"></div>
        <div class="single--link--bg">

            <!-- 前の記事へ -->
            <div class="single--link--text">
                <?php
                $prev_post = get_adjacent_post(true, '', false, 'category');
                if (!empty($prev_post)): ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">前の記事へ</a>
                <?php endif; ?>
            </div>

            <!-- 次の記事へ：完了済みのときのみ表示（非表示で出しておく） -->
            <?php
            $next_post = get_adjacent_post(true, '', true, 'category');
            $next_post_url = $next_post ? get_permalink($next_post->ID) : '';
            if (!empty($next_post)): ?>
                <div class="single--link--text next-post-link" style="<?php echo $is_complete ? '' : 'display:none;'; ?>">
                    <a href="<?php echo esc_url($next_post_url); ?>">次の記事へ</a>
                </div>
            <?php endif; ?>

            <!-- MAPへ戻る -->
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

            <!-- ページTOP -->
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

                <!-- 完了ボタン -->
                <div class="progress-complete-button-wrapper" data-tag="<?php echo esc_attr($slug); ?>" data-next-url="<?php echo esc_url($next_post_url); ?>">
                    <?php if ($is_complete): ?>
                        <button disabled class="is-complete">完了済み</button>
                    <?php else: ?>
                        <button style="<?php echo $has_quiz ? 'display:none;' : ''; ?>">完了!</button>
                    <?php endif; ?>
                </div>
                <!-- 完了ボタン end -->

                <div class="single-nation">
                    <!-- 前の記事 -->
                    <div class="single-nation-text">
                        <?php
                        $prev_post = get_adjacent_post(true, '', false, 'category');
                        if (!empty($prev_post)): ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>">前の記事へ</a>
                        <?php endif; ?>
                    </div>

                    <!-- MAP -->
                    <div class="single-nation-text">
                        <a href="<?php bloginfo('url'); ?>/curriculum<?php echo $category_param; ?>">戻る</a>
                    </div>

                    <!-- 次の記事へ：完了済みのときのみ表示（非表示で出しておく） -->
                    <?php if (!empty($next_post)): ?>
                        <div class="single-nation-text next-post-link" style="<?php echo $is_complete ? '' : 'display:none;'; ?>">
                            <a href="<?php echo esc_url($next_post_url); ?>">次の記事へ</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confetti"> 
        <canvas id="confettiBurst"></canvas>
        <canvas id="confettiRain" ></canvas>
        <div class="confetti--main">
            <img src="<?php echo get_template_directory_uri(); ?>/img/single-complete.webp" alt="完了おめでとう！">
            <div class="confetti--main-chara"></div>
        </div>
        <div class="close"></div>
    </div>
</div>

<?php get_footer(); ?>
