<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

if (session_status() === PHP_SESSION_NONE) session_start();
$show_confetti = !empty($_SESSION['confetti_show']);
unset($_SESSION['confetti_show']);

// 完了判定用
$tags = get_the_tags();
// 全てのタグのslagを取得
$slugs = '';
$is_story = false;
if ($tags && !is_wp_error($tags)) {
    $slugs_arr = [];
    foreach ($tags as $tag) {
        $slugs_arr[] = $tag->slug;
        if ($tag->slug === 'story') {
            $is_story = true;
        }
    }
    $slugs = implode(' ', $slugs_arr);
}
$progress = get_user_meta(get_current_user_id(), $slugs, true);
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

    $prev_post_id = null;
    $next_post_id = null;

    if ($my_index !== false) {
        if ($my_index > 0) {
            $prev_post_id = $post_ids[$my_index - 1];
        }
        if ($my_index < count($post_ids) - 1) {
            $next_post_id = $post_ids[$my_index + 1];
        }
    }

    // ★ storyの進捗は持たず、「直前の非story記事が未完了ならロック」
    if ($my_index !== false && $my_index > 0) {
        for ($i = $my_index - 1; $i >= 0; $i--) {
            $prev_post_id = $post_ids[$i];
            $prev_tags = get_the_tags($prev_post_id);

            if ($prev_tags && !is_wp_error($prev_tags)) {
                $has_story_tag = false;
                foreach ($prev_tags as $tag) {
                    if ($tag->slug === 'story') {
                        $has_story_tag = true;
                        break;
                    }
                }
                if (!$has_story_tag) {
                    // 非story記事が見つかった
                    foreach ($prev_tags as $tag) {
                        $field_name = $tag->slug;
                        $progress = get_user_meta($current_user_id, $field_name, true);
                        if (intval($progress) < 100) {
                            $locked = true;
                            break 2; // 二重ループ脱出
                        }
                    }
                    break; // 判定終わったのでbreak
                }
            }
        }
    }
}

if ($locked) {
    include(locate_template('locked-screen.php'));
    exit;
}


// === 1. 現在の記事のカテゴリ情報を取得 ===
$categories = get_the_category();
$active_category_slug = '';
$active_category_id   = 0;

if (!empty($categories)) {
    $active_category_slug = $categories[0]->slug;
    $active_category_id   = $categories[0]->term_id; // IDを取得しておく
}

// === 2. 閲覧権限制御 ===
$current_user = wp_get_current_user();
if (!user_can_view_post($current_user->ID, get_the_ID())) {
    wp_redirect(home_url('/viewing-limit'));
    exit;
}

get_header();

?>

<div class="single <?php echo esc_attr($slugs); ?>" data-category="<?php echo esc_attr($active_category_slug); ?>">

    <div class="single--img"></div>

    <div class="list-btn"></div>
    
    <div class="post-list">
        <div class="post-list-inner">
            <ul>
                <?php
                // 除外したいタグ「story」のIDを取得
                $story_tag = get_term_by('slug', 'story', 'post_tag');
                $story_tag_id = $story_tag ? $story_tag->term_id : 0;

                // 現在のカテゴリの記事のみを取得するクエリ
                $args = [
                    'post_type'      => 'post',
                    'cat'            => $active_category_id, // ★現在のカテゴリIDを指定
                    'posts_per_page' => -1,
                    'tag__not_in'    => [$story_tag_id],
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()):
                    while ($query->have_posts()): $query->the_post();
                ?>
                    <li>
                     <!-- 記事ページに直接飛ぶ場合 -->
                    <a href="<?php the_permalink(); ?>" class="post-link">
                    <!-- <a href="<?php echo add_query_arg('post_id', get_the_ID(), site_url('/cover')); ?>" class="post-link"> -->
                            <div class="items--img">
                                <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.webp'; ?>" alt="">
                            </div>
                            <div class="items--title">
                                <p class="TL"><?php the_title(); ?></p>
                            </div>
                        </a>
                    </li>
                <?php
                    endwhile;
                else:
                ?>
                    <p>このカテゴリーには投稿がありません。</p>
                <?php
                endif;

                wp_reset_postdata(); // クエリをリセット
                ?>
            </ul>
        </div>
    </div>


        
                
    <!-- ページネーション等 -->
    <div class="single--link">
        <div class="single--link--chara"></div>
        <div class="single--link--bg">

            <!-- 前の記事へ -->
            <div class="single--link--text">
            <?php if ($prev_post_id): ?>
                <a href="<?php echo get_permalink($prev_post_id); ?>">前の記事へ</a>
            <?php endif; ?>
            </div>

            <!-- 次の記事へ：完了済みのときのみ表示（非表示で出しておく） -->
            <div class="single--link--text">
            <?php
            $next_post_url = $next_post_id ? get_permalink($next_post_id) : '';
             if ($next_post_id): ?>
                <a href="<?php echo esc_url($next_post_url); ?>">次の記事へ</a>
            <?php endif; ?>
            </div>
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

                <!-- 完了ボタン：★story記事は非表示 -->
                <?php if (!$is_story): ?>
                <div class="progress-complete-button-wrapper" data-tag="<?php echo esc_attr($slugs); ?>" data-next-url="<?php echo esc_url($next_post_url); ?>">
                    <?php if ($is_complete): ?>
                        <button disabled class="is-complete">完了済み</button>
                    <?php else: ?>
                        <button style="<?php echo $has_quiz ? 'display:none;' : ''; ?>">完了!</button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <!-- 完了ボタン end -->

                <div class="single-nation">
                    <!-- 前の記事 -->
                    <div class="single-nation-text">
                    <?php if ($prev_post_id): ?>
                        <a href="<?php echo get_permalink($prev_post_id); ?>">前の記事へ</a>
                    <?php endif; ?>
                    </div>

                    <!-- MAP -->
                    <div class="single-nation-text">
                        <a href="<?php bloginfo('url'); ?>/curriculum<?php echo $category_param; ?>">戻る</a>
                    </div>

                    <!-- 次の記事へ：完了済みのときのみ表示 -->
                    <?php if ($next_post_id): ?>
                        <div class="single-nation-text next-post-link" style="<?php echo (!$is_story && !$is_complete) ? 'display:none;' : ''; ?>">
                            <a href="<?php echo esc_url($next_post_url); ?>">次の記事へ</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confetti close-area"> 
        <canvas id="confettiBurst"></canvas>
        <canvas id="confettiRain" ></canvas>
        <div class="confetti--main">
            <img src="<?php echo get_template_directory_uri(); ?>/img/single-complete.webp" alt="完了おめでとう！">
            <div class="confetti--main-chara"></div>
        </div>
        <div class="close close-area"></div>
    </div>
</div>

<?php get_footer(); ?>
