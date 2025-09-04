<?php
function display_login_bonus()
{
    $user_id = get_current_user_id();
    $login_continuous_10days_count = get_user_meta($user_id, 'login_continuous_10days_count', true) ?: 0;

    if ($login_continuous_10days_count > 0) {
        $coins_to_add = 50; // 付与するコインの数
        $tickets_to_add = 1; // 付与する優先チケットの数
?>
        <div class="coin-point">
            <p class="TX">連続ログインボーナス</p>
            <div class="coin-point-select">
                <div class="coin-point_button hover-opa blue" id="ticket-reward-button">優先チケット獲得</div>
                <div class="coin-point_button hover-opa gold" id="coin-reward-button">コイン獲得</div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var coinsToAdd = <?php echo $coins_to_add; ?>;
                $('#coin-reward-button').on('click', function() {
                    if (confirm(coinsToAdd + '枚のコインを獲得しますか？')) {
                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'add_coins',
                                user_id: <?php echo $user_id; ?>,
                                coins_to_add: coinsToAdd
                            },
                            success: function(response) {
                                alert(response + 'コインが付与されました！');
                                location.reload(); // ページをリロード
                            }
                        });
                    }
                });

                var ticketsToAdd = <?php echo $tickets_to_add; ?>;
                $('#ticket-reward-button').on('click', function() {
                    if (confirm(ticketsToAdd + '枚の優先チケットを獲得しますか？')) {
                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'add_tickets',
                                user_id: <?php echo $user_id; ?>,
                                tickets_to_add: ticketsToAdd
                            },
                            success: function(response) {
                                alert(response + '優先チケットが付与されました！');
                                location.reload(); // ページをリロード
                            }
                        });
                    }
                });
            });
        </script>
<?php
    }
}

function add_coins()
{
    $user_id = intval($_POST['user_id']);
    $coins_to_add = intval($_POST['coins_to_add']);

    // コインを追加
    $current_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
    $new_coins = $current_coins + $coins_to_add;
    update_user_meta($user_id, 'user_coins', $new_coins);

    // 10日連続ログイン達成回数を減らす
    $login_continuous_10days_count = get_user_meta($user_id, 'login_continuous_10days_count', true) ?: 0;
    $login_continuous_10days_count = max(0, $login_continuous_10days_count - 1); // 値が負にならないようにする
    update_user_meta($user_id, 'login_continuous_10days_count', $login_continuous_10days_count);

    echo $coins_to_add; // 付与されたコイン数を返す
    wp_die();
}

function add_tickets()
{
    $user_id = intval($_POST['user_id']);
    $tickets_to_add = intval($_POST['tickets_to_add']);

    // 優先チケットを追加
    $current_tickets = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
    $new_tickets = $current_tickets + $tickets_to_add;
    update_user_meta($user_id, 'priority_ticket', $new_tickets);

    // 10日連続ログイン達成回数を減らす
    $login_continuous_10days_count = get_user_meta($user_id, 'login_continuous_10days_count', true) ?: 0;
    $login_continuous_10days_count = max(0, $login_continuous_10days_count - 1); // 値が負にならないようにする
    update_user_meta($user_id, 'login_continuous_10days_count', $login_continuous_10days_count);

    echo $tickets_to_add; // 付与された優先チケット数を返す
    wp_die();
}

add_action('wp_ajax_add_coins', 'add_coins');
add_action('wp_ajax_nopriv_add_coins', 'add_coins');
add_action('wp_ajax_add_tickets', 'add_tickets');
add_action('wp_ajax_nopriv_add_tickets', 'add_tickets');
?>