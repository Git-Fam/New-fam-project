<?php

// 現在ログインしているユーザーのIDを取得
$user_id = get_current_user_id();


// ユーザーのメタデータの値を取得。デフォルト値は0。
// カテゴリーを取得（並び替え順に従う）
$categories = get_categories(array(
    'orderby' => 'term_order',
    'order' => 'ASC',
    'hide_empty' => false
));

// 各カテゴリーごとにタグの値を取得
foreach ($categories as $category) {
    // カテゴリー内の投稿を取得（menu_order順）
    $posts = get_posts(array(
        'post_type' => 'post',
        'category_name' => $category->slug,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    // 投稿ごとにタグを取得して値を取得
    foreach ($posts as $post) {
        $post_tags = wp_get_object_terms($post->ID, 'post_tag', array(
            'orderby' => 'term_order',
            'order' => 'ASC'
        ));

        if (!is_wp_error($post_tags) && !empty($post_tags)) {
            foreach ($post_tags as $tag) {
                // タグのスラッグ名を変数名として使用（小文字に統一）
                $var_name = $tag->slug . '_value';
                // ユーザーメタデータから値を取得（デフォルトは'0'）
                $$var_name = get_user_meta($user_id, $tag->slug, true) ?: '0';
            }
        }
    }
}

?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>
<!-- page-my -->

<div class="my">
    <div class="my--inner">
        <div class="my--title">
            <div class="my--title--title">
                <h2 class="TL">マイページ</h2>
            </div>
            <div class="my--title--name">
                <p class="TX">
                    <!-- ユーザーネーム -->
                    <?php
                    $current_user = wp_get_current_user();
                    echo $current_user->user_login;
                    ?>
                </p>

                <!-- バッジ -->
                <?php badge_display(); ?>

            </div>
            <div class="my--title--points">
                <div class="coin-point">
                    <p class="TX">現在の獲得コイン:
                        <span>
                            <?php
                            $user_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
                            echo esc_html($user_coins);
                            ?>&nbsp;coins
                        </span>
                    </p>
                </div>
                <div class="coin-point">
                    <p class="TX">現在の獲得ポイント:
                        <span>
                            <?php
                            $user_id = get_current_user_id();
                            $user_points = get_user_meta($user_id, 'user_point', true) ?: 0;
                            echo esc_html($user_points);
                            ?>&nbsp;points
                        </span>
                    </p>
                </div>

                <div class="coin-point">
                    <p class="TX">連続ログイン日数:
                        <span>
                            <?php
                            $user_id = get_current_user_id();
                            $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true) ?: 0;
                            echo esc_html($consecutive_login_days);
                            ?>&nbsp;日
                        </span>
                    </p>
                </div>

                <!-- 優先チケット -->
                <?php display_priority_ticket(); ?>

                <!-- 連続１０日ログインボーナス -->
                <?php display_login_bonus(); ?>

            </div>
            <div class="C_character js-character-edit">
                <?php display_character(); ?>
                <a class="clothes--change__button" href="<?php bloginfo('url'); ?>/avatar">編集する</a>
            </div>
        </div>

        <div class="my--info">
            <div class="bbs">
                <div class="chicken">
                    <div class="chicken--serif">
                        <?php
                        $recent_news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 1,
                            'date_query' => array(
                                array(
                                    // ３日間
                                    'after' => '72 hours ago'
                                )
                            )
                        ));
                        if ($recent_news_query->have_posts()) :
                        ?>
                            <p class="TX">新着のお知らせがあるよ！</p>
                        <?php else : ?>
                            <p class="TX">お知らせだよ！</p>
                        <?php endif; ?>
                    </div>
                    <div class="chicken--bird">
                        <iframe src="https://lottie.host/embed/421d3b3d-d381-49ba-b751-5d7dc96c02c8/XLrfuoTBb0.json"></iframe>
                    </div>
                </div>
                <div class="title">
                    <h2 class="TL">お知らせ</h2>
                </div>
                <div class="bbs--content">
                    <ul class="sentence">
                        <?php
                        $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 5, // 表示する投稿数
                            'paged' => $paged, 
                        ));
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                        ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>">
                                        <p class="time"><?php echo get_the_date('Y.m.d'); ?></p>
                                        <p class="text"><?php the_title(); ?></p>
                                    </a>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <li>
                                <p class="text">お知らせはありません。</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="bbs--content--pageNation">
                    <?php
                    if (function_exists('wp_pagenavi')) {
                        wp_pagenavi(array('query' => $news_query));
                    }
                    ?>
                </div>
            </div>

            <div class="spy">
                <div class="mole">
                    <iframe src="https://lottie.host/embed/b4994f66-3673-48c5-a9f8-a2dc72b38c6e/eWk4vLyDMj.json"></iframe>
                </div>
                <div class="spy--text">
                    <div class="spy--text--serif">
                        <p class="TX">
                            <?php
                            $latest_post = new WP_Query(array(
                                'post_type' => 'column',
                                'posts_per_page' => 1,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));

                            $nothing_echo = "コラムだよ！";

                            if ($latest_post->have_posts()) {
                                $latest_post->the_post();
                                $post_categories = get_the_terms(get_the_ID(), 'column-cat');
                                if ($post_categories && !is_wp_error($post_categories)) {
                                    $category = array_shift($post_categories);
                                    $category_description = $category->description;
                                    if (!empty($category_description)) {
                                        echo esc_html($category_description);
                                    } else {
                                        echo $nothing_echo;
                                    }
                                } else {
                                    echo $nothing_echo;
                                }
                                wp_reset_postdata();
                            } else {
                                echo $nothing_echo;
                            }
                            ?>
                        </p>
                    </div>
                    <div class="spy--text--column">
                        <a href="<?php bloginfo('url'); ?>/column">コラムを見に行く ▶</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="info_button sp">
            <p class="TX">
                お知らせ
            </p>
        </div>

        <div class="my--content">
            <div class="pageClip">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
            </div>
            <div class="my--content--container">
                <div class="my--content--page page--1"></div>
                <div class="my--content--page page--2"></div>
                <div class="my--content--page page--3"></div>
                <div class="tab tab--1 active">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">進</span>
                        <span class="TX-span">捗</span>
                        <span class="TX-span">更</span>
                        <span class="TX-span">新</span>
                    </p>
                </div>
                <div class="tab tab--2">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">会</span>
                        <span class="TX-span">員</span>
                        <span class="TX-span">情</span>
                        <span class="TX-span">報</span>
                    </p>
                </div>
                <div class="gorilla"></div>

                <div class="tab--content">
                    <!-- 進捗更新 -->
                    <div class="tab--content--progress active">
                        <!-- ログイン中のみ表示 -->
                        <?php if (is_user_logged_in()): ?>
                            <!-- <form class="progress" action="/test-hp-2/registered" method="post"> -->
                            <form class="progress" action="<?php echo home_url('/registered'); ?>" method="post">

                                <div class="progress--content">

                                    <?php
                                    // カテゴリーを取得（公開中の投稿があるもののみ）
                                    $categories = get_categories(array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => true,  // 投稿がないカテゴリーは非表示
                                        'post_status' => 'publish'  // 公開中の投稿のみを対象
                                    ));

                                    // 各カテゴリーを表示
                                    $is_first = true; // 最初のカテゴリーかどうかを判定するフラグ
                                    foreach ($categories as $category) {
                                        // 現在のカテゴリーがアクティブかどうかを確認
                                        $is_active = '';
                                        if ($is_first) {
                                            $is_active = 'active';
                                            $is_first = false;
                                        } else {
                                            $is_active = isset($_GET['category']) && $_GET['category'] === $category->slug ? 'active' : '';
                                        }

                                        // カテゴリー内の記事を取得
                                        $args = array(
                                            'category_name' => $category->slug,
                                            'post_status' => 'publish',
                                            'posts_per_page' => -1,
                                            'orderby' => 'menu_order',
                                            'order' => 'ASC'
                                        );
                                        $posts = get_posts($args);

                                        if (!empty($posts)) {
                                    ?>
                                            <div class="item <?php echo $is_active; ?>">
                                                <div class="progress--title">
                                                    <h3 class="TL"><?php echo esc_html($category->name); ?></h3>
                                                </div>
                                                <div class="progress--update">
                                                    <?php
                                                    foreach ($posts as $post) {
                                                        // 記事のタグを取得
                                                        $post_tags = wp_get_object_terms($post->ID, 'post_tag', array(
                                                            'orderby' => 'term_order',
                                                            'order' => 'ASC'
                                                        ));

                                                        if (!is_wp_error($post_tags) && !empty($post_tags)) {
                                                            foreach ($post_tags as $tag) {
                                                                // タグのスラッグに対応する変数名を生成
                                                                $var_name = $tag->slug . '_value';
                                                                $progress_value = isset($$var_name) ? $$var_name : '0';
                                                    ?>
                                                                <div class="update--item">
                                                                    <div class="update--item--title">
                                                                        <p class="TX"><span class="deco"></span><?php echo esc_html($post->post_title); ?></p>
                                                                        <p class="count"><output class="count" id="value"><?php echo esc_attr($progress_value); ?></output>%</p>
                                                                    </div>
                                                                    <input class="progressBar" id="pi_input" name="<?php echo esc_attr($tag->slug); ?>" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($progress_value); ?>" />
                                                                </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>

                                <div class="progress--TOC">
                                    <ul class="progress--TOC--ul">
                                        <?php
                                        // カテゴリーを取得（公開中の投稿があるもののみ）
                                        $categories = get_categories(array(
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => true,  // 投稿がないカテゴリーは非表示
                                            'post_status' => 'publish'  // 公開中の投稿のみを対象
                                        ));

                                        // 各カテゴリーを表示
                                        foreach ($categories as $category) {
                                            // 現在のカテゴリーがアクティブかどうかを確認
                                            $is_active = isset($_GET['category']) && $_GET['category'] === $category->slug ? 'active' : '';

                                            // カテゴリー名を表示用に整形
                                            $display_name = '・' . $category->name;

                                            echo '<li class="progress--TOC--ul--li">';
                                            echo '<p class="TX ' . $is_active . '">' . $display_name . '</p>';
                                            echo '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>


                                <div class="progress--submit">
                                    <input type="submit" value="更新">
                                </div>

                            </form>
                        <?php endif; ?>
                        <!-- ログインしていないトップにリダイレクト -->
                        <?php if (!is_user_logged_in()): ?>
                            <p class="TX">ログインしていません。</p>
                        <?php endif; ?>
                    </div>
                    <!-- 会員情報 -->
                    <div class="tab--content--membership">
                        <?php echo do_shortcode('[swpm_profile_form]'); ?>
                    </div>
                </div>

            </div>
            <a class="logout--button" href="?swpm-logout=true">ログアウト</a>
        </div>

        <!-- ログイン中のみ表示 -->
        <?php if (is_user_logged_in()): ?>
            <a class="curriculum--btn" href="<?php bloginfo('url'); ?>/curriculum">
                <p class="TX">カリキュラム<br>一覧</p>
            </a>
        <?php endif; ?>

    </div>

    <div class="my--menu-btn">
        <?php get_template_part('inc/first-btn'); ?>
        <?php get_template_part('inc/menu-btn'); ?>
    </div>

    <!-- ログインボーナス -->
    <?php log_board(); ?>

    <!-- 連続ログインボーナス -->
    <?php continuous_board(); ?>

    <!-- カムバックボーナス -->
    <?php comeback_board(); ?>


</div>

<?php get_footer(); ?>