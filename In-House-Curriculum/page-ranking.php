<?php
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
        'number' => -1, // 全ユーザーを取得
        'meta_key' => 'user_point', // 'user_point' メタキーを基に
        'orderby' => 'meta_value_num', // メタ値（ポイント数）で並び替え
        'order' => 'DESC' // 降順でソート（高い順）
    );
    $user_query = new WP_User_Query($args);
    return $user_query->get_results();
}

// 今月のログイン日数を取得する関数
function get_user_login_days_this_month($user_id) {
    $current_month = date('Y-m');
    $login_dates = get_user_meta($user_id, 'login_dates', true);

    // ログイン日付のリストが空の場合は空の配列を返す
    if (!is_array($login_dates)) {
        $login_dates = [];
    }

    // 今月のログイン日付をフィルタリング
    $login_days_this_month = array_filter($login_dates, function($date) use ($current_month) {
        return strpos($date, $current_month) === 0;
    });

    // 今月のログイン日数を返す
    return count($login_days_this_month);
}

// 今月のログイン日数でユーザーをランキングする関数
function get_login_days_users() {
    $users = get_users(array('number' => -1)); // 全ユーザーを取得
    $login_days_users = [];

    foreach ($users as $user) {
        // 各ユーザーの今月のログイン日数を取得
        $login_count = get_user_login_days_this_month($user->ID);
        $login_days_users[] = ['user' => $user, 'login_count' => $login_count];
    }

    // ログイン日数で降順にソート
    usort($login_days_users, function($a, $b) {
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
            <img src="<?php echo esc_url($avatar_url); ?>" alt="" class="user-icon">
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
$users = get_ranked_users();

// ログインしているユーザーの順位を取得
$current_user_rank = 0;
foreach ($users as $index => $user) {
    if ($user->ID == $current_user->ID) {
        $current_user_rank = $index + 1; // 順位は0から始まるため+1
        break;
    }
}

// 今月のログイン日数ランキングの順位を取得
$current_user_login_rank = 0;
foreach ($login_days_users as $index => $user_info) {
    if ($user_info['user']->ID == $current_user->ID) {
        $current_user_login_rank = $index + 1; // 順位は0から始まるため+1
        break;
    }
}
?>

<?php get_header(); ?>
<div class="page-wappaer">
    <section id="pageーranking" class="ranking">
        <div class="bg">
            <div class="bg-left"></div>
            <div class="bg-right"></div>
            <div class="stump-back"></div>
            <div class="character-box">
                <div class="C_character">
                    <dotlottie-player src="https://lottie.host/e60cec2b-65a9-4722-99fa-d9218781a66b/TBEXhkebbF.json" background="transparent" speed="1" loop autoplay></dotlottie-player>
                </div>
                <div class="stump"></div>
            </div>
            <div class="stump-front"></div>
            <div class="ranking-header">
                <p class="TL">学んであつめて！ポイントランキング！</p>
            </div>
            <div class="inner">
                <div class="main">
                    <!-- ポイント数情報 -->
                    <div class="my-info">
                        <!-- ポイント情報 -->
                        <div class="name-box">
                            <img src="<?php echo esc_url($avatar_url); ?>" alt="" class="img">
                            <p class="name"><?php echo esc_html($current_user->display_name); ?></p>
                        </div>
                        <div id="point-info" class="result">
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($user_points); ?> pt</p>
                            </div>
                        </div>
                        <!-- ログイン日数情報 -->
                        <div id="login-days-info" class="result hidden">
                            <?php
                            // 今月のログイン日数を取得
                            $current_user_login_days = get_user_login_days_this_month($current_user->ID);
                            ?>
                            <div class="result-box">
                                <p class="number"><?php echo $current_user_login_rank; ?></p>
                                <div class="icon"></div>
                                <p class="point"><?php echo number_format($current_user_login_days); ?> 日</p>
                            </div>
                        </div>
                    </div>
                    <div id="point-ranking" class="ranking-bord">
                        <div class="TL-bg">
                            <img class="TL" src="<?php echo get_template_directory_uri(); ?>/img/Ranking-TL.svg" alt="Ranking">
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    // 上位3名を表示順に合わせて出力
                                    $rank_positions = [1 => 'second', 0 => 'first', 2 => 'third'];
                                    foreach ($rank_positions as $index => $rank_class) {
                                        if (!isset($users[$index])) continue;
                                        display_user_item($users[$index], $rank_class);
                                    }
                                    ?>
                                </ul>
                            </div>
                            <ul class="onward">
                                <?php for ($i = 3; $i < min(20, count($users)); $i++): ?>
                                    <?php
                                    // ユーザー情報の取得
                                    $user = $users[$i];
                                    $user_name = $user->display_name;
                                    $user_points = get_user_meta($user->ID, 'user_point', true);
                                    $user_points = $user_points ? $user_points : 0;
                                    $avatar_url = get_avatar_url($user->ID);
                                    ?>
                                    <li>
                                        <div class="img">
                                            <img src="<?php echo esc_url($avatar_url); ?>" alt="" class="user-icon">
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
                    <!-- 今月のログイン日数ランキングの表示 -->
                    <div id="login-days-ranking" class="ranking-bord hidden">
                        <div class="TL-bg">
                            <img class="TL" src="<?php echo get_template_directory_uri(); ?>/img/Ranking-TL.svg" alt="Ranking">
                        </div>
                        <div class="ranking-list">
                            <div class="list-item top-group">
                                <ul class="rank">
                                    <?php
                                    // 上位3名を表示順に合わせて出力
                                    $rank_positions = [1 => 'second', 0 => 'first', 2 => 'third'];
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
                    </div>
                    <div class="btn" id="toggle-ranking-btn">Login</div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>

