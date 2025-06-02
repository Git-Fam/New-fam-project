<?php
function comeback_board()
{
    global $normal_month;
    global $after_day; 

    $user_id = get_current_user_id(); // 現在のユーザーIDを取得
    $comeback_login_days = get_user_meta($user_id, 'comeback_login_days', true) ?: 0;
    $previous_comeback_login_days = get_user_meta($user_id, 'previous_comeback_login_days', true) ?: 0;
    $last_comeback_login_date = get_user_meta($user_id, 'last_comeback_login_date', true);
    $current_timestamp = current_time('timestamp');

    // $normal_month が経過した場合に表示
    if ($last_comeback_login_date && ($current_timestamp - strtotime($last_comeback_login_date)) >= $normal_month) {
        $comeback_board_class = '';
        update_user_meta($user_id, 'previous_comeback_login_days', $comeback_login_days);
        update_user_meta($user_id, 'last_comeback_login_date', date('Y-m-d H:i:s', $current_timestamp));
        update_user_meta($user_id, 'comeback_login_days', 1); // リセットして1からスタート
    } elseif ($comeback_login_days > $previous_comeback_login_days && $comeback_login_days <= $after_day) {
        // $after_day 日間表示
        $comeback_board_class = '';
        update_user_meta($user_id, 'previous_comeback_login_days', $comeback_login_days);
    } else {
        $comeback_board_class = 'none';
    }

    // 連続ログインが途切れた場合は非表示
    if ($comeback_login_days > $after_day) {
        $comeback_board_class = 'none';
    }
?>

    <div class="comeback-board <?php echo $comeback_board_class; ?>">
        <div class="board-close">
            <span></span>
            <span></span>
        </div>
        <div class="comeback-board__bg">
            <div class="curtain__item curtain-01"></div>
            <div class="curtain__item curtain-02"></div>
            <div class="curtain__item curtain-03"></div>
            <div class="cracker__item cracker-01"></div>
            <div class="cracker__item cracker-02"></div>
        </div>
        <div class="comeback-board__container">
            <div class="container__characters">
                <div class="characters character_01"></div>
                <div class="characters character_02"></div>
            </div>
            <div class="container__title">
                <h3 class="TL">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/log-board/comeback-board-title.webp" alt="カムバックボーナス">
                </h3>
            </div>
            <div class="container__text">
                <p class="TX">
                    おかえりなさい！<br>
                    久しぶりに開いてくれたあなたに、特別なボーナスを用意したよ！
                </p>
            </div>
            <div class="container__content">
                <div class="container__content__inner">

                    <div class="content__sentence">
                        <div class="sentence__title">
                            <p class="TX">今日から<?php echo $after_day; ?>日間連続でログインしよう！</p>
                        </div>
                        <div class="sentence__stamp">
                            <?php for ($day = 1; $day <= $after_day; $day++): ?>
                                <div class="stamp__item <?php echo ($comeback_login_days >= $day) ? 'stamp-clear' : ''; ?>"></div>
                            <?php endfor; ?>
                        </div>
                        <div class="sentence__remainder">
                            <div class="days">
                                <p class="TX">あと<span><?php echo max(0, $after_day - $comeback_login_days); ?></span>日</p>
                                <div class="seal"></div>
                            </div>
                        </div>
                    </div>

                    <div class="content__item">
                        <div class="item__body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>