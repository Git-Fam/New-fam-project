<?php
function continuous_board()
{
    global $normal_day; // グローバル変数を参照

    $user_id = get_current_user_id(); // 現在のユーザーIDを取得
    $last_display_time = get_user_meta($user_id, 'last_continuous_board_display', true);
    $current_timestamp = current_time('timestamp');

    // $normal_dayに一度表示されたかどうかを確認
    if ($last_display_time && ($current_timestamp - strtotime($last_display_time)) < $normal_day) {
        $continuous_board_class = 'none';
    } else {
        $continuous_board_class = '';
        update_user_meta($user_id, 'last_continuous_board_display', date('Y-m-d H:i:s', $current_timestamp));
    }
?>

    <div class="continuous-board <?php echo $continuous_board_class; ?>">
        <div class="board-close">
            <span></span>
            <span></span>
        </div>
        <div class="continuous-board__container">
            <div class="container__title">
                <h2 class="TL" data-text="連続ログインボーナス！">連続ログインボーナス！</h2>
                <div class="TX">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/log-board/continuous-board-belt.svg" alt="毎日ログインして豪華アイテムをGET!">
                </div>
            </div>
            <div class="container__content">
                <div class="container__content__inner">
                    <div class="content__title">
                        <div class="content__title__inner">
                            <?php
                            $user_id = get_current_user_id(); // 現在のユーザーIDを取得
                            $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true);
                            // 連続ログイン日数を整数に変換
                            $consecutive_login_days = intval($consecutive_login_days);
                            ?>
                            <p class="TX"><span><?php echo $consecutive_login_days; ?>日</span>連続ログイン中！</p>
                        </div>
                    </div>
                    <div class="content__stamp">
                        <?php
                        $user_id = get_current_user_id(); // 現在のユーザーIDを取得
                        $consecutive_login_days = get_user_meta($user_id, 'consecutive_login_days', true);
                        $days_to_display = 9; // 9日目までのスタンプ
                        $reset_day = 10; // 10日目にリセット

                        // 連続ログイン日数を整数に変換してから計算
                        $consecutive_login_days = intval($consecutive_login_days);
                        // 連続ログイン日数をリセット
                        $effective_login_days = ($consecutive_login_days - 1) % $reset_day + 1;

                        for ($day = 1; $day <= $days_to_display; $day++) {
                            $classes = ['stamp__item'];
                            if ($effective_login_days >= $day) {
                                $classes[] = 'stamp-clear';
                            }
                            $class = implode(' ', $classes);
                        ?>
                            <div class="<?php echo $class; ?>"></div>
                        <?php
                        }
                        ?>
                        <div class="stamp__item__gale <?php echo ($effective_login_days == $reset_day) ? 'stamp-clear' : ''; ?>">
                            <div class="stamp__item__gale__inner">
                                <div class="ticket-img"></div>
                                <div class="flash-img"></div>
                            </div>
                            <div class="stamp__item__gale__text">
                                <p class="TX">イベント優待<span>チケット</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="content__plus">
                        <div class="plus__more">
                            <p class="TX">さらに！</p>
                        </div>
                        <div class="content__plus__inner">
                            <div class="inner__text">
                                <p class="TX">
                                    <span>1ヶ月毎日ログインを達成すると</span><br>
                                    レア称号＋〇〇〇がもらえる！
                                </p>
                            </div>
                            <div class="inner__img">
                                <div class="img--badge"></div>
                                <div class="img--ticket"></div>
                                <div class="img--coin coin-01"></div>
                                <div class="img--coin coin-02"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
}
?>