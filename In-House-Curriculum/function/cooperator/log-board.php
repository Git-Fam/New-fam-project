<?php
function log_board()
{
    $user_id = get_current_user_id();

    $today = current_time('Y-m-d');
    $last_display_date = get_user_meta($user_id, 'last_log_board_display', true);

    // ▼▼▼ 動作確認用：常に表示（確認後に必ず下のコメントアウトを戻す）▼▼▼
    $log_board_class = '';
    
    if ($last_display_date === $today) {
        $log_board_class = 'none';
    } else {
        $log_board_class = '';
        update_user_meta($user_id, 'last_log_board_display', $today);
    }
    // ▲▲▲ ここまで ▲▲▲
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
                    $today_day = (int) current_time('j'); // 今日の日（1〜31）
                    $current_month = current_time('n');

                    // 月が変わっていたらログイン履歴をリセット（先に判定）
                    $last_login_month = get_user_meta($user_id, 'last_login_month', true);
                    if ($last_login_month != $current_month) {
                        update_user_meta($user_id, 'login_history', []);
                        update_user_meta($user_id, 'last_login_month', $current_month);
                    }

                    // 当月のログイン履歴を取得し、「日（j）」の配列に変換
                    $login_history = get_user_meta($user_id, 'login_history', true);
                    if (!is_array($login_history)) {
                        $login_history = [];
                    }
                    $login_days = array_map(function ($login_time) {
                        return (int) date('j', strtotime($login_time));
                    }, $login_history);

                    for ($day = 1; $day <= $days_in_month; $day++) {
                        $classes = [];

                        // 実際にログインした日
                        $is_logged_in = in_array($day, $login_days, true);

                        if ($is_logged_in && $day < $today_day) {
                            $classes[] = 'checked__cards'; // 過去のログイン済みの日
                        }
                        if ($day == $today_day && $is_logged_in) {
                            $classes[] = 'todays__cards'; // 今日（ログイン済み）
                        }
                        if ($day % 5 == 0) {
                            $classes[] = 'coins__cards'; // 5日ごとのコイン日（据え置き）
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