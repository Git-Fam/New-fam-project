<?php
function log_board()
{
    global $normal_day; // グローバル変数を参照

    $user_id = get_current_user_id(); // 現在のユーザーIDを取得
    $last_display_time = get_user_meta($user_id, 'last_log_board_display', true);
    $current_timestamp = current_time('timestamp');

    // $normal_dayに一度表示されたかどうかを確認
    if ($last_display_time && ($current_timestamp - strtotime($last_display_time)) < $normal_day) {
        $log_board_class = 'none';
    } else {
        $log_board_class = '';
        update_user_meta($user_id, 'last_log_board_display', date('Y-m-d H:i:s', $current_timestamp));
    }
?>

    <div class="log-board <?php echo $log_board_class; ?>">
        <div class="board-close">
            <span></span>
            <span></span>
        </div>
        <div class="log-board--top">
            <!-- 丘-->
            <div class="log-board--top__hills"></div>
            <!-- 木 -->
            <div class="log-board--top__trees">
                <div class="trees__img trees-01"></div>
                <div class="trees__img trees-02"></div>
            </div>
            <!-- キャラクター -->
            <div class="log-board--top__characters">
                <div class="characters__img characters-01"></div>
                <div class="characters__img characters-02"></div>
                <div class="characters__img characters-03"></div>
            </div>

            <!-- メイン -->
            <div class="log-board--top__main">
                <div class="main__title">
                    <h2 class="TL">ログインボーナス</h2>
                </div>
                <div class="main__month">
                    <p class="TX">
                        <?php $month = date('n'); ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/log-board/log-board-month-<?php echo $month; ?>.webp" alt="">
                    </p>
                </div>
            </div>

            <!-- 草 -->
            <div class="log-board--top__grassy"></div>
            <!-- 日光 -->
            <div class="log-board--top__sunlight">
                <div class="sunlight__img sunlight-01"></div>
                <div class="sunlight__img sunlight-02"></div>
                <div class="sunlight__img sunlight-03"></div>
                <div class="sunlight__img sunlight-04"></div>
            </div>
        </div>
        <div class="log-board--content">
            <div class="log-board--content__lists">
                <ul>
                    <?php
                    $days_in_month = date('t'); // 現在の月の日数を取得
                    $login_history = get_user_meta($user_id, 'login_history', true);
                    if (!is_array($login_history)) {
                        $login_history = [];
                    }
                    $login_days = array_map(function ($login_time) {
                        return date('j', strtotime($login_time));
                    }, $login_history);

                    $last_login_month = get_user_meta($user_id, 'last_login_month', true);
                    $current_month = date('n');

                    if ($last_login_month != $current_month) {
                        // 月が変わった場合、ログイン履歴をリセット
                        $login_history = [];
                        update_user_meta($user_id, 'login_history', $login_history);
                        update_user_meta($user_id, 'last_login_month', $current_month);
                    }

                    // ログイン回数を取得
                    $login_count = count($login_days);

                    for ($day = 1; $day <= $days_in_month; $day++) {
                        $classes = [];
                        if ($day <= $login_count - 1) {
                            $classes[] = 'checked__cards';
                        }
                        if ($day == $login_count) {
                            $classes[] = 'todays__cards';
                        }
                        if ($day % 5 == 0) {
                            $classes[] = 'coins__cards';
                        }
                        $class = implode(' ', $classes);
                    ?>
                        <!-- cards -->
                        <li class="<?php echo $class; ?>">
                            <div class="cards">
                                <div class="cards__number"><?php echo $day; ?></div>
                                <div class="item__img"></div>
                                <div class="item__highlight"></div>
                                <div class="check__img"></div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>


<?php
}
?>