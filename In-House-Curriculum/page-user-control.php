<?php
// ベーシック認証の関数
function basic_auth()
{
    $username = 'aaaa'; // ベーシック認証のユーザー名
    $password = '0000'; // ベーシック認証のパスワード

    if (
        !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password
    ) {
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo '認証が必要です';
        exit;
    }
}

// ベーシック認証を実行
basic_auth();

get_header(); ?>

<div class="user-control_wrap">
    <div class="user-control_inner">
        <ul>
            <li>
                <div class="user_data"></div>
                <div class="user_data">
                    <p class="TX">ユーザー名</p>
                </div>
                <div class="user_data">
 
                <p class="TX">姓 名</p>
                </div>
                <div class="user_data">
                    <p class="TX">メールアドレス</p>
                </div>
                <div class="user_data">
                    <p class="TX">優先チケット枚数</p>
                </div>
                <div class="user_data">
                    <p class="TX">コイン枚数</p>
                </div>
                <div class="user_data">
                    <p class="TX">ポイント数</p>
                </div>
                <div class="user_data">
                    <p class="TX">グループ</p>
                </div>
                <div class="user_data">
                    <p class="TX">最終ログイン</p>
                </div>
            </li>
            <?php
            // 全ユーザーを取得
            $users = get_users();
            foreach ($users as $user) {
                $user_id = $user->ID;
                $priority_ticket = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
                $user_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
                $user_points = get_user_meta($user_id, 'user_point', true) ?: 0;
                $user_group = get_user_meta($user_id, 'user_group', true) ?: '未設定';
                $last_login = get_user_meta($user_id, 'last_login', true) ?: '不明';
            ?>
                <li>
                    <div class="user_data">
                        <input type="checkbox" class="user-checkbox" data-user-id="<?php echo esc_attr($user_id); ?>" data-email="<?php echo esc_attr($user->user_email); ?>">
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user->user_login); ?></p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user->last_name . ' ' . $user->first_name); ?></p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user->user_email); ?></p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($priority_ticket); ?> チケット</p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user_coins); ?> コイン</p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user_points); ?> ポイント</p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($user_group); ?></p>
                    </div>
                    <div class="user_data">
                        <p class="TX"><?php echo esc_html($last_login); ?></p>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="button_area">
        <div class="button sky" id="consume-ticket-button">チケット消費</div>
        <div class="button pink" id="create-email-button">メール作成</div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('create-email-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var emails = [];
        checkboxes.forEach(function(checkbox) {
            emails.push(checkbox.getAttribute('data-email'));
        });
        if (emails.length > 0) {
            var mailtoLink = 'mailto:dummy@example.com?bcc=' + emails.join(',');
            window.location.href = mailtoLink;
        } else {
            alert('メールを送信するユーザーを選択してください。');
        }
    });

    document.getElementById('consume-ticket-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
            userIds.push(checkbox.getAttribute('data-user-id'));
        });
        if (userIds.length > 0) {
            if (confirm('選択したユーザーのチケットを消費しますか？')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('チケットが消費されました。');
                            location.reload(); // ページをリロード
                        } else {
                            alert('チケットの消費に失敗しました: ' + response.data);
                        }
                    } else {
                        alert('チケットの消費に失敗しました。');
                    }
                };
                xhr.send('action=consume_tickets&user_ids=' + JSON.stringify(userIds));
            }
        } else {
            alert('チケットを消費するユーザーを選択してください。');
        }
    });
</script>

<?php get_footer(); ?>