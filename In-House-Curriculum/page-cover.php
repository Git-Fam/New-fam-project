<?php
// クエリパラメータから記事IDを取得
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
$queried_post = null;
$current_post_id = null;

if ($post_id) {
    $queried_post = get_post($post_id);
    if ($queried_post) {
        $current_post_id = $queried_post->ID;
    }
}
get_header();

// --- storyタグ以外の全投稿リスト取得（Post Types Orderの順） ---
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'suppress_filters' => false,
);
$all_posts_query = new WP_Query($args);
$filtered_posts = array();
if ($all_posts_query->have_posts()) {
    foreach ($all_posts_query->posts as $post_obj) {
        $tags = get_the_tags($post_obj->ID);
        $has_story = false;
        if ($tags && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                if ($tag->slug === 'story') {
                    $has_story = true;
                    break;
                }
            }
        }
        if (!$has_story) {
            $filtered_posts[] = $post_obj;
        }
    }
}
wp_reset_postdata();

// --- 進捗カウント（buddy用） ---
$count = 0;
if ($queried_post) {
    $tags = get_the_tags($queried_post->ID);
    if ($tags && !is_wp_error($tags)) {
        $progress_key = $tags[0]->slug;
        $users = get_users();
        foreach ($users as $user) {
            $progress = get_user_meta($user->ID, $progress_key, true);
            if (is_numeric($progress) && $progress >= 1 && $progress < 100) {
                $count++;
            }
        }
    }
}

// --- 前後の記事ID（story除外リストでループ） ---
$current_post_id = $queried_post->ID;
$prev_post_id = null;
$next_post_id = null;
foreach ($filtered_posts as $idx => $post_obj) {
    if ($post_obj->ID == $current_post_id) {
        // 前
        if ($idx > 0) {
            $prev_post_id = $filtered_posts[$idx - 1]->ID;
        }
        // 次
        if ($idx < count($filtered_posts) - 1) {
            $next_post_id = $filtered_posts[$idx + 1]->ID;
        }
        break;
    }
}

// 必要なら循環（ループ）させる場合
if ($prev_post_id === null && count($filtered_posts) > 1) {
    $prev_post_id = $filtered_posts[count($filtered_posts) - 1]->ID;
}
if ($next_post_id === null && count($filtered_posts) > 1) {
    $next_post_id = $filtered_posts[0]->ID;
}?>
<!--  <?php get_template_part('inc/loading'); ?> -->
<div class="cover-wrapper">
    <div class="cover">
        <div class="cover-header">
            <p class="TL">
                カリキュラム選択 〉
                <?php
                $categories = get_the_category($queried_post ? $queried_post->ID : 0);
                if (!empty($categories) && isset($categories[0]->name)) {
                    $category_url = site_url('/curriculum?category=' . urlencode($categories[0]->name));
                    echo '<a href="' . esc_url($category_url) . '">' . esc_html($categories[0]->name) . '</a>';
                } else {
                    echo '<p>カテゴリーが設定されていません。</p>';
                }
                ?>
                〉<?php echo esc_html($queried_post ? $queried_post->post_title : ''); ?>
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

                    $image_file_name = $category->slug . '.webp';
                    $image_src = get_template_directory_uri() . '/img/' . $image_file_name;
                    $noimg_src = get_template_directory_uri() . '/img/noimg.webp';
                ?>
                <div class="archive--item">
                    <a href="<?php echo esc_url(site_url('/cover/?post_id=' . $first_post_id)); ?>" class="archive--item--link">
                        <img 
                            class="archive--item--img" 
                            src="<?php echo $image_src; ?>" 
                            alt=""
                            onerror="this.onerror=null;this.src='<?php echo $noimg_src; ?>';"
                        >
                    </a>
                    <div class="archive--item--title"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <a href="<?php echo site_url('/chat'); ?>" class="chara-link koinubox">
            <div class="koinu"></div>
            <p class="link">チャット...</p>
        </a>
        <div class="tree tree01"></div>
        <div class="tree01-02"></div>
        <a href="<?php echo site_url('/question'); ?>" class="chara-link goatbox">
            <div class="goat"></div>
            <p class="link">質問する？</p>
        </a>
        <div class="tree tree02"></div>
        <div class="cover-content">
            <div class="intermediate-page" id="cover-curriculum">
                <div class="TL-wrap">
                    <p class="post-TL"><?php echo esc_html($queried_post ? $queried_post->post_title : ''); ?></p>
                    <?php if (!$queried_post) : ?>
                        <p class="post-TL error">記事が見つかりませんでした。</p>
                    <?php endif; ?>
                </div>
                <div class="post-thumbnail">
                    <a href="<?php echo $queried_post ? get_permalink($queried_post) : '#'; ?>">
                        <?php 
                        if ($queried_post && has_post_thumbnail($queried_post)) {
                            echo '<img class="img" src="' . esc_url(get_the_post_thumbnail_url($queried_post)) . '" alt="">';
                        } else {
                            echo '<img class="img" src="' . esc_url(get_template_directory_uri() . '/img/no-img.webp') . '" alt="No Image Available">';
                        }
                        ?>
                    </a>
                </div>
                <?php if ($queried_post): ?>
                    <a href="<?php echo get_permalink($queried_post); ?>" class="start-btn">はじめる</a>
                <?php endif; ?>
            </div>
            <div class="shironeko-wrap">
                <div class="shironeko pyon"></div>
                <div class="shadow"></div>
                <div class="buddy">
                    <p class="buddy_TX">いま同じ場所を頑張っている人が<span><?php echo $count + 2; ?></span>人いるよ！</p>
                </div>
            </div>
        </div>

        <div class="back-wrap">
            <div class="back"></div>
            <?php
            $categories = get_the_category($queried_post ? $queried_post->ID : 0);
            if (!empty($categories) && isset($categories[0]->name)) {
                $category_name = $categories[0]->name;
                $category_url = site_url('/curriculum?category=' . urlencode($category_name));
            } else {
                $category_url = '#';
            }
            ?>
            <a href="<?php echo esc_url($category_url); ?>" class="TX">戻る</a>
        </div>

        <!-- 前・次リンク -->
        <?php if ($prev_post_id && $queried_post): ?>
            <a href="<?php echo esc_url(site_url('/cover/?post_id=' . $prev_post_id)); ?>" class="board prev">
                <p class="link-TX prev-link">前に戻る</p>
            </a>
        <?php endif; ?>
        <?php if ($next_post_id && $queried_post): ?>
            <a href="<?php echo esc_url(site_url('/cover/?post_id=' . $next_post_id)); ?>" class="board next">
                <p class="link-TX next-link">次に進む</p>
            </a>
        <?php elseif ($queried_post): ?>
            <p>次の記事はありません。</p>
        <?php endif; ?>

        <div class="grass grass01"></div>
        <div class="grass grass02"></div>
    </div>
</div>
<?php get_footer(); ?>

