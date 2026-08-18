<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
get_header();



// 共通関数でメタデータを取得しデフォルト値を設定
function is_valid_role($user_id) {
    $user = get_userdata($user_id);
    return in_array('subscriber', (array) $user->roles, true);
}


// 現在のユーザー情報を取得
$current_user = wp_get_current_user();

// プロフィール画像のURLを取得
$avatar_url = get_avatar_url($current_user->ID);

// ユーザーのポイント数を取得
$user_points = get_user_meta($current_user->ID, 'user_point', true);
$user_points = $user_points ? $user_points : 0; // ポイント数が設定されていない場合は0

// 全ユーザーをポイント数で取得する関数
function get_ranked_users() {
    $args = array(
        'number' => -1,
        'meta_key' => 'user_point',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    $user_query = new WP_User_Query($args);
    $all_users = $user_query->get_results();

    $filtered_users = array_filter($all_users, function($user) {
        return is_valid_role($user->ID);
    });

    return array_values($filtered_users);
}


// 現在のユーザーのコイン数を取得
$user_coins = get_user_meta($current_user->ID, 'user_coins', true);
$user_coins = $user_coins ? $user_coins : 0; // コイン数が設定されていない場合は0

// 全ユーザーをコイン数で取得する関数
function get_users_by_coins() {
    $args = array(
        'number' => -1,
        'meta_key' => 'user_coins',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    $user_query = new WP_User_Query($args);
    $all_users = $user_query->get_results();

    $filtered_users = array_filter($all_users, function($user) {
        return is_valid_role($user->ID);
    });

    return array_values($filtered_users);
}

// 全ユーザーを進捗数で取得
function get_users_by_progress_count() {
    $users = get_users(['number' => -1]);
    $progress_users = [];

    foreach ($users as $user) {
        if (!is_valid_role($user->ID)) continue;

        $user_meta = get_user_meta($user->ID);
        $count_100 = 0;

        foreach ($user_meta as $key => $values) {
            // 値が '100' のカスタムフィールドをカウント
            if (isset($values[0]) && $values[0] === '100') {
                $count_100++;
            }
        }

        $progress_users[] = [
            'user' => $user,
            'progress_count' => $count_100
        ];
    }

    // progress_count が多い順にソート
    usort($progress_users, function ($a, $b) {
        return $b['progress_count'] - $a['progress_count'];
    });

    return $progress_users;
}


// 今月のログイン日数を取得する関数
function get_user_login_days_this_month($user_id) {
    $current_month = date('Y-m');
    $login_dates = get_user_meta($user_id, 'login_dates', true);

    if (!is_array($login_dates)) {
        $login_dates = [];
    }

    $login_days_this_month = array_filter($login_dates, function ($date) use ($current_month) {
        return strpos($date, $current_month) === 0;
    });

    return count($login_days_this_month);
}

// 今月のログイン日数でユーザーをランキングする関数
function get_login_days_users() {
    $users = get_users(array('number' => -1));
    $login_days_users = [];

    foreach ($users as $user) {
        if (!is_valid_role($user->ID)) continue;

        $count = get_user_login_days_this_month($user->ID);
        $login_days_users[] = ['user' => $user, 'login_count' => $count];
    }

    usort($login_days_users, function ($a, $b) {
        return $b['login_count'] - $a['login_count'];
    });

    return $login_days_users;
}


// ユーザーのリストアイテムを表示する関数
function display_user_item($user, $rank_class = '') {
    $user_name = $user->display_name;
    $user_points = get_user_meta($user->ID, 'user_point', true);
    $user_points = $user_points ? $user_points : 0;
    $avatar_url = get_avatar_url($user->ID);
?>
    <li class="rank-item <?php echo esc_attr($rank_class); ?>">
        <div class="img">
        <div class="user-icon"><?php display_character_for_user($user->ID); ?>
</div>
        </div>
        <div class="name-box">
            <p class="name"><?php echo esc_html($user_name); ?></p>
            <div class="point-box">
                <div class="icon"></div>
                <p class="point"><?php echo number_format($user_points); ?> pt</p>
            </div>
        </div>
    </li>
<?php
}

// 今月のログイン日数で並べたユーザーリストを取得
$login_days_users = get_login_days_users();

// 全ユーザーをポイント数で取得
$point_users = get_ranked_users();

// 現在のユーザーの順位を取得
$current_user_rank = 0;
foreach ($point_users as $index => $user) {
    if ($user->ID == $current_user->ID) {
        $current_user_rank = $index + 1; // 順位は0から始まるため+1
        break;
    }
}

// 全ユーザーのコイン数の順位を取得
$current_user_coin_rank = 0; // 初期値
$users = get_users_by_coins();

foreach ($users as $index => $user) {
    $user_coins = get_user_meta($user->ID, 'user_coins', true);
    $user_coins = $user_coins ? $user_coins : 0; // デフォルト値を設定

    if ($user->ID == $current_user->ID) {
        $current_user_coin_rank = $index + 1; // 順位は0から始まるため+1
        break;
    }
}

$progress_users = get_users_by_progress_count();

$current_user_progress_rank = 0;
$current_user_progress_count = 0;

foreach ($progress_users as $index => $item) {
    if ($item['user']->ID == $current_user->ID) {
        $current_user_progress_rank = $index + 1;
        $current_user_progress_count = $item['progress_count'];
        break;
    }
}



?>

<div class="page-wappaer">
    <section id="page-ranking" class="ranking">
        <div class="bg">
            <div class="bg-left"></div>
            <div class="bg-right"></div>
            <div class="stump-back"></div>
            <div class="rank-character-box">
                <div class="C_character">
                    <dotlottie-player src="https://lottie.host/e60cec2b-65a9-4722-99fa-d9218781a66b/TBEXhkebbF.json" background="transparent" speed="1" loop autoplay></dotlottie-player>
                </div>
                <div class="stump"></div>
            </div>
            <div class="stump-front"></div>
            <div class="ranking-header">
                <p class="TL">学んであつめて！ポイントランキング！</p>
                <div class="rank--menu-btn">
                    <?php get_template_part('inc/menu-btn'); ?>
                </div>
            </div>

            <div class="inner">
                <div class="main">
                    <!-- ポイント数情報 -->
                    <div class="my-info">
                        <div class="name-box">
                            <div class="img"><?php display_character_for_user($user->ID); ?>
</div>
                            <p class="name"><?php echo esc_html($current_user->display_name); ?></p>
                        </div>
                        <!-- ポイント情報 -->
                        <div id="point-info" class="result">
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($user_points); ?> pt</p>
                            </div>
                        </div>
                        <!-- コイン数情報 -->
                        <div id="coin-info" class="result hidden">
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_coin_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($user_coins); ?><span> コイン</span></p>
                            </div>
                        </div>
                        <!-- 進捗数情報 -->
                        <div id="progress-info" class="result hidden">
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_progress_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($current_user_progress_count); ?> <span>クリア</span></p>
                            </div>
                        </div>


                        <!-- ログイン日数情報 -->
                        <!-- <div id="login-days-info" class="result hidden">
                            <?php
                            // 今月のログイン日数を取得
                            $current_user_login_days = get_user_login_days_this_month($current_user->ID);
                            ?>
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_login_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($current_user_login_days); ?> 日</p>
                            </div>
                        </div> -->
                    </div>
                    <div id="point-ranking" class="ranking-bord">
                        <div class="TL-bg">
                            <p class="TL">ポイントランキング</p>
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    // 上位3名を表示順に合わせて出力
                                    $rank_positions = [1 => 'second', 0 => 'r-first', 2 => 'third'];
                                    foreach ($rank_positions as $index => $rank_class) {
                                        if (!isset($point_users[$index])) continue;
                                        display_user_item($point_users[$index], $rank_class);
                                    }
                                    ?>
                                </ul>
                            </div>
                            <ul class="onward">
                                <?php for ($i = 3; $i < min(20, count($point_users)); $i++): ?>
                                    <?php
                                    // ユーザー情報の取得
                                    $user = $point_users[$i];
                                    $user_name = $user->display_name;
                                    $user_points = get_user_meta($user->ID, 'user_point', true);
                                    $user_points = $user_points ? $user_points : 0;
                                    $avatar_url = get_avatar_url($user->ID);
                                    ?>
                                    <li>
                                        <div class="img">
                                            <div class="user-icon"><?php display_character_for_user($user->ID); ?></div>
                                        </div>
                                        <p class="name"><?php echo esc_html($user_name); ?></p>
                                        <div class="point-box">
                                            <div class="icon"></div>
                                            <p class="point"><?php echo number_format($user_points); ?> pt</p>
                                        </div>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- コインランキング -->
                    <div id="coin-ranking" class="ranking-bord hidden">
                        <div class="TL-bg">
                            <p class="TL">コインランキング</p>
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    // 上位3名を表示順に合わせて出力
                                    $rank_positions = [1 => 'second', 0 => 'r-first', 2 => 'third'];
                                    foreach ($rank_positions as $index => $rank_class) {
                                        if (!isset($users[$index])) continue;

                                        // コイン情報を取得
                                        $user = $users[$index];
                                        $user_coins = get_user_meta($user->ID, 'user_coins', true);
                                        $user_coins = $user_coins ? $user_coins : 0;

                                        // 表示
                                        ?>
                                        <li class="rank-item <?php echo esc_attr($rank_class); ?>">
                                            <div class="img">
                                                <div class="user-icon"><?php display_character_for_user($user->ID); ?>
</div>
                                            </div>
                                            <div class="name-box">
                                                <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                                <div class="point-box">
                                                    <div class="icon"></div>
                                                    <p class="point"><?php echo number_format($user_coins); ?> <span>コイン</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <ul class="onward">
                                <?php for ($i = 3; $i < min(20, count($users)); $i++): ?>
                                    <?php
                                    // ユーザー情報の取得
                                    $user = $users[$i];
                                    $user_coins = get_user_meta($user->ID, 'user_coins', true);
                                    $user_coins = $user_coins ? $user_coins : 0;
                                    ?>
                                    <li>
                                        <div class="img">
                                            <div class="user-icon"><?php display_character_for_user($user->ID); ?>
</div>
                                        </div>
                                        <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                        <div class="point-box">
                                            <div class="icon"></div>
                                            <p class="point"><?php echo number_format($user_coins); ?> <span>コイン</span></p>
                                        </div>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- 進捗ランキング -->
                    <div id="progress-ranking" class="ranking-bord hidden">
                        <div class="TL-bg">
                            <p class="TL">成長ランキング</p>
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    $rank_positions = [1 => 'second', 0 => 'r-first', 2 => 'third'];
                                    foreach ($rank_positions as $index => $rank_class) {
                                        if (!isset($progress_users[$index])) continue;
                                        $user = $progress_users[$index]['user'];
                                        $count = $progress_users[$index]['progress_count'];
                                        ?>
                                        <li class="rank-item <?php echo esc_attr($rank_class); ?>">
                                            <div class="img">
                                                <div class="user-icon"><?php display_character_for_user($user->ID); ?></div>
                                            </div>
                                            <div class="name-box">
                                                <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                                <div class="point-box">
                                                    <div class="icon"></div>
                                                    <p class="point"><?php echo number_format($count); ?> <span>クリア</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <ul class="onward">
                                <?php for ($i = 3; $i < min(20, count($progress_users)); $i++): ?>
                                    <?php
                                    $user = $progress_users[$i]['user'];
                                    $count = $progress_users[$i]['progress_count'];
                                    ?>
                                    <li>
                                        <div class="img">
                                            <div class="user-icon"><?php display_character_for_user($user->ID); ?></div>
                                        </div>
                                        <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                        <div class="point-box">
                                            <div class="icon"></div>
                                            <p class="point"><?php echo number_format($count); ?> <span>クリア</span></p>
                                        </div>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- 今月のログイン日数ランキングの表示 -->
                    <!-- <div id="login-days-ranking" class="ranking-bord hidden">
                        <div class="TL-bg">
                            <p class="TL">ログインランキング</p>
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    // 上位3名を表示順に合わせて出力
                                    $rank_positions = [1 => 'second', 0 => 'r-first', 2 => 'third'];
                                    foreach ($rank_positions as $index => $rank_class) {
                                        if (!isset($login_days_users[$index])) continue;
                                        $user_info = $login_days_users[$index];
                                        $user = $user_info['user'];
                                        $login_count = $user_info['login_count'];
                                    ?>
                                        <li class="rank-item <?php echo esc_attr($rank_class); ?>">
                                            <div class="img">
                                                <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="" class="user-icon">
                                            </div>
                                            <div class="name-box">
                                                <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                                <div class="point-box">
                                                    <div class="icon"></div>
                                                    <p class="point"><?php echo number_format($login_count); ?> 日</p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <ul class="onward">
                                <?php for ($i = 3; $i < min(20, count($login_days_users)); $i++): ?>
                                    <?php
                                    $user_info = $login_days_users[$i];
                                    $user = $user_info['user'];
                                    $login_count = $user_info['login_count'];
                                    ?>
                                    <li>
                                        <div class="img">
                                            <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="" class="user-icon">
                                        </div>
                                        <p class="name"><?php echo esc_html($user->display_name); ?></p>
                                        <div class="point-box">
                                            <div class="icon"></div>
                                            <p class="point"><?php echo number_format($login_count); ?> 日</p>
                                        </div>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div> -->
                    <div class="btn-area">
                        <div class="ranking-btn" id="toggle-ranking-btn"><p class="btn-TX">その他の<br>ランキングを<br>見る</p></div>
                        <div class="switch-btn switch-btn01 delay-02"></div>
                        <div class="switch-btn switch-btn02"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>