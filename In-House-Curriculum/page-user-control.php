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
        <!-- 検索機能 -->
        <div class="search-section">
            <div class="search-input-group">
                <input type="text" id="search-input" placeholder="ユーザー名、姓名、メールアドレスで検索...">
                <select id="search-filter">
                    <option value="all">すべて</option>
                    <option value="username">ユーザー名</option>
                    <option value="name">姓名</option>
                    <option value="email">メールアドレス</option>
                    <option value="group">グループ</option>
                </select>
                <button id="search-button" class="search-btn">検索</button>
                <button id="clear-search" class="clear-btn">クリア</button>
            </div>
            <div class="search-stats">
                <span id="search-results-count">全ユーザー: <span id="total-count">0</span>件</span>
            </div>
        </div>

        <ul class="user-control_list-top">
            <li>
                <div class="user_data"></div>
                <div class="user_data sortable" data-sort="username">
                    <p class="TX">ユーザー名 <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="name">
                    <p class="TX">姓 名 <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="email">
                    <p class="TX">メールアドレス <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="tickets">
                    <p class="TX">優先チケット枚数 <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="coins">
                    <p class="TX">コイン枚数 <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="points">
                    <p class="TX">ポイント数 <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="group">
                    <p class="TX">グループ <span class="sort-icon">↕</span></p>
                </div>
                <div class="user_data sortable" data-sort="lastlogin">
                    <p class="TX">最終ログイン <span class="sort-icon">↕</span></p>
                </div>
            </li>
            <ul class="user-control_list-bottom" id="user-list-container">
                <?php
                // 全ユーザーを取得
                $users = get_users();
                foreach ($users as $user) {
                    $user_id = $user->ID;
                    $priority_ticket = get_user_meta($user_id, 'priority_ticket', true) ?: 0;
                    $user_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
                    $user_points = get_user_meta($user_id, 'user_point', true) ?: 0;
                    $user_group = get_user_meta($user_id, 'user_group', true) ?: '未設定';

                    // 最終ログイン日を取得
                    $login_history = get_user_meta($user_id, 'login_history', true);
                    $last_login = '不明';
                    if (is_array($login_history) && !empty($login_history)) {
                        // 最新のログイン日時を取得
                        $latest_login = end($login_history);
                        if ($latest_login) {
                            $last_login = date('Y-m-d H:i', strtotime($latest_login));
                        }
                    }
                ?>
                    <li class="user-row"
                        data-username="<?php echo esc_attr($user->user_login); ?>"
                        data-name="<?php echo esc_attr($user->last_name . ' ' . $user->first_name); ?>"
                        data-email="<?php echo esc_attr($user->user_email); ?>"
                        data-tickets="<?php echo esc_attr($priority_ticket); ?>"
                        data-coins="<?php echo esc_attr($user_coins); ?>"
                        data-points="<?php echo esc_attr($user_points); ?>"
                        data-group="<?php echo esc_attr($user_group); ?>"
                        data-lastlogin="<?php echo esc_attr($last_login); ?>">
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
        </ul>
    </div>
    <div class="button_area">
        <div class="button sky">
            <input type="number" id="ticket-input" placeholder="枚数（+付与/-削除）">
            <p id="ticket-button">チケット操作</p>
        </div>
        <div class="button sky">
            <input type="number" id="coin-input" placeholder="枚数（+付与/-削除）">
            <p id="coin-button">コイン操作</p>
        </div>
        <div class="button sky">
            <input type="number" id="point-input" placeholder="ポイント（+付与/-削除）">
            <p id="point-button">ポイント操作</p>
        </div>
        <div class="button orange" id="create-email-button">
            <p>メール作成</p>
        </div>
        <div class="button red" id="set-all-progress-button">
            <p>全進捗を100に設定</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    // 検索機能
    let allUsers = [];
    let filteredUsers = [];

    // ページ読み込み時に全ユーザーを保存
    document.addEventListener('DOMContentLoaded', function() {
        // 全ユーザー行を取得して保存
        const userRows = document.querySelectorAll('.user-row');
        allUsers = Array.from(userRows);
        filteredUsers = [...allUsers];

        // 総数を表示
        updateUserCount();

        // 検索イベントリスナーを設定
        setupSearchEventListeners();

        // 並び替えイベントリスナーを設定
        setupSortEventListeners();
    });

    // 検索イベントリスナーを設定
    function setupSearchEventListeners() {
        const searchInput = document.getElementById('search-input');
        const searchFilter = document.getElementById('search-filter');
        const searchButton = document.getElementById('search-button');
        const clearButton = document.getElementById('clear-search');

        // リアルタイム検索（入力時に検索）
        searchInput.addEventListener('input', function() {
            performSearch();
        });

        // フィルター変更時
        searchFilter.addEventListener('change', function() {
            performSearch();
        });

        // 検索ボタンクリック
        searchButton.addEventListener('click', function() {
            performSearch();
        });

        // クリアボタンクリック
        clearButton.addEventListener('click', function() {
            clearSearch();
        });

        // Enterキーで検索
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }

    // 検索実行
    function performSearch() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
        const filterType = document.getElementById('search-filter').value;

        // 検索条件に基づいてユーザーをフィルタリング
        filteredUsers = allUsers.filter(userRow => {
            if (!searchTerm) return true;

            const username = userRow.getAttribute('data-username').toLowerCase();
            const name = userRow.getAttribute('data-name').toLowerCase();
            const email = userRow.getAttribute('data-email').toLowerCase();
            const group = userRow.getAttribute('data-group').toLowerCase();

            switch (filterType) {
                case 'username':
                    return username.includes(searchTerm);
                case 'name':
                    return name.includes(searchTerm);
                case 'email':
                    return email.includes(searchTerm);
                case 'group':
                    return group.includes(searchTerm);
                case 'all':
                default:
                    return username.includes(searchTerm) ||
                        name.includes(searchTerm) ||
                        email.includes(searchTerm) ||
                        group.includes(searchTerm);
            }
        });

        // 表示を更新
        updateUserDisplay();
        updateUserCount();
    }

    // 検索クリア
    function clearSearch() {
        document.getElementById('search-input').value = '';
        document.getElementById('search-filter').value = 'all';
        filteredUsers = [...allUsers];
        updateUserDisplay();
        updateUserCount();
    }

    // ユーザー表示を更新
    function updateUserDisplay() {
        const container = document.getElementById('user-list-container');
        const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();

        // 全ユーザーを非表示
        allUsers.forEach(userRow => {
            userRow.classList.add('hidden');
            userRow.classList.remove('highlight');
        });

        // フィルタリングされたユーザーのみ表示
        filteredUsers.forEach(userRow => {
            userRow.classList.remove('hidden');

            // 検索語がある場合はハイライト
            if (searchTerm) {
                userRow.classList.add('highlight');
            }
        });
    }

    // ユーザー数を更新
    function updateUserCount() {
        const totalCount = allUsers.length;
        const filteredCount = filteredUsers.length;
        const searchTerm = document.getElementById('search-input').value.trim();

        if (searchTerm) {
            document.getElementById('search-results-count').textContent =
                `検索結果: ${filteredCount}件 / 全${totalCount}件`;
        } else {
            document.getElementById('search-results-count').textContent =
                `全ユーザー: ${totalCount}件`;
        }
    }

    // 並び替えイベントリスナーを設定
    function setupSortEventListeners() {
        const sortableHeaders = document.querySelectorAll('.sortable');
        sortableHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const sortColumn = this.getAttribute('data-sort');
                handleSort(sortColumn);
            });
        });
    }

    // 並び替え機能
    let currentSort = {
        column: null,
        direction: 'asc'
    };

    // 並び替え処理
    function handleSort(column) {
        const container = document.getElementById('user-list-container');
        const rows = Array.from(filteredUsers); // フィルタリングされたユーザーのみを並び替え

        // ソート方向を決定
        if (currentSort.column === column) {
            currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
        } else {
            currentSort.column = column;
            currentSort.direction = 'asc';
        }

        // アイコンを更新
        updateSortIcons(column, currentSort.direction);

        // 行を並び替え
        rows.sort((a, b) => {
            let aValue = a.getAttribute('data-' + column);
            let bValue = b.getAttribute('data-' + column);

            // 数値の場合は数値として比較
            if (column === 'tickets' || column === 'coins' || column === 'points') {
                aValue = parseInt(aValue) || 0;
                bValue = parseInt(bValue) || 0;
            }
            // 日付の場合は日付として比較
            else if (column === 'lastlogin') {
                if (aValue === '不明') aValue = '1900-01-01 00:00';
                if (bValue === '不明') bValue = '1900-01-01 00:00';
                aValue = new Date(aValue);
                bValue = new Date(bValue);
            }
            // その他は文字列として比較
            else {
                aValue = aValue || '';
                bValue = bValue || '';
            }

            let comparison = 0;
            if (aValue > bValue) comparison = 1;
            if (aValue < bValue) comparison = -1;

            return currentSort.direction === 'asc' ? comparison : -comparison;
        });

        // 並び替えた行を再配置
        rows.forEach(row => container.appendChild(row));
    }

    // ソートアイコンを更新
    function updateSortIcons(activeColumn, direction) {
        const headers = document.querySelectorAll('.sortable');
        headers.forEach(header => {
            const icon = header.querySelector('.sort-icon');
            const column = header.getAttribute('data-sort');

            if (column === activeColumn) {
                icon.textContent = direction === 'asc' ? '↑' : '↓';
            } else {
                icon.textContent = '↕';
            }
        });
    }

    // メール作成機能
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

    // チケット操作機能（付与・削除両対応）
    document.getElementById('ticket-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
            userIds.push(checkbox.getAttribute('data-user-id'));
        });
        var amount = parseInt(document.getElementById('ticket-input').value);

        if (userIds.length > 0 && amount !== 0) {
            var action = amount > 0 ? '付与' : '削除';
            var absAmount = Math.abs(amount);
            var confirmMessage = '選択したユーザーにチケットを' + absAmount + '枚' + action + 'しますか？';

            if (confirm(confirmMessage)) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    alert('チケットの' + action + 'が完了しました。');
                                    location.reload();
                                } else {
                                    alert('チケットの' + action + 'に失敗しました: ' + response.data);
                                }
                            } catch (e) {
                                alert('レスポンスの解析に失敗しました: ' + xhr.responseText);
                            }
                        } else {
                            alert('チケットの' + action + 'に失敗しました。ステータス: ' + xhr.status);
                        }
                    }
                };
                xhr.onerror = function() {
                    alert('通信エラーが発生しました。');
                };
                var actionName = amount > 0 ? 'add_tickets' : 'consume_tickets';
                var data = 'action=' + actionName + '&user_ids=' + JSON.stringify(userIds) + '&amount=' + absAmount;
                xhr.send(data);
            }
        } else {
            alert('ユーザーを選択し、0以外の数値を入力してください。\n正の数：付与、負の数：削除');
        }
    });

    // コイン操作機能（付与・削除両対応）
    document.getElementById('coin-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
            userIds.push(checkbox.getAttribute('data-user-id'));
        });
        var amount = parseInt(document.getElementById('coin-input').value);

        if (userIds.length > 0 && amount !== 0) {
            var action = amount > 0 ? '付与' : '削除';
            var absAmount = Math.abs(amount);
            var confirmMessage = '選択したユーザーにコインを' + absAmount + '枚' + action + 'しますか？';

            if (confirm(confirmMessage)) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    alert('コインの' + action + 'が完了しました。');
                                    location.reload();
                                } else {
                                    alert('コインの' + action + 'に失敗しました: ' + response.data);
                                }
                            } catch (e) {
                                alert('レスポンスの解析に失敗しました: ' + xhr.responseText);
                            }
                        } else {
                            alert('コインの' + action + 'に失敗しました。ステータス: ' + xhr.status);
                        }
                    }
                };
                xhr.onerror = function() {
                    alert('通信エラーが発生しました。');
                };
                var actionName = amount > 0 ? 'add_coins' : 'consume_coins';
                var data = 'action=' + actionName + '&user_ids=' + JSON.stringify(userIds) + '&amount=' + absAmount;
                xhr.send(data);
            }
        } else {
            alert('ユーザーを選択し、0以外の数値を入力してください。\n正の数：付与、負の数：削除');
        }
    });

    // ポイント操作機能（付与・削除両対応）
    document.getElementById('point-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
            userIds.push(checkbox.getAttribute('data-user-id'));
        });
        var amount = parseInt(document.getElementById('point-input').value);

        if (userIds.length > 0 && amount !== 0) {
            var action = amount > 0 ? '付与' : '削除';
            var absAmount = Math.abs(amount);
            var confirmMessage = '選択したユーザーにポイントを' + absAmount + 'ポイント' + action + 'しますか？';

            if (confirm(confirmMessage)) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    alert('ポイントの' + action + 'が完了しました。');
                                    location.reload();
                                } else {
                                    alert('ポイントの' + action + 'に失敗しました: ' + response.data);
                                }
                            } catch (e) {
                                alert('レスポンスの解析に失敗しました: ' + xhr.responseText);
                            }
                        } else {
                            alert('ポイントの' + action + 'に失敗しました。ステータス: ' + xhr.status);
                        }
                    }
                };
                xhr.onerror = function() {
                    alert('通信エラーが発生しました。');
                };
                var actionName = amount > 0 ? 'add_points' : 'consume_points';
                var data = 'action=' + actionName + '&user_ids=' + JSON.stringify(userIds) + '&amount=' + absAmount;
                xhr.send(data);
            }
        } else {
            alert('ユーザーを選択し、0以外の数値を入力してください。\n正の数：付与、負の数：削除');
        }
    });

    // 全進捗を100に設定機能
    document.getElementById('set-all-progress-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.user-checkbox:checked');
        var userIds = [];
        checkboxes.forEach(function(checkbox) {
            userIds.push(checkbox.getAttribute('data-user-id'));
        });
        var amount = 100;

        if (userIds.length > 0 && amount !== 0) {
            var action = '付与';
            var absAmount = Math.abs(amount);
            var confirmMessage = '選択したユーザーにポイントを' + absAmount + 'ポイント' + action + 'しますか？';

            if (confirm(confirmMessage)) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    alert('ポイントの' + action + 'が完了しました。');
                                    location.reload();
                                } else {
                                    alert('ポイントの' + action + 'に失敗しました: ' + response.data);
                                }
                            } catch (e) {
                                alert('レスポンスの解析に失敗しました: ' + xhr.responseText);
                            }
                        } else {
                            alert('ポイントの' + action + 'に失敗しました。ステータス: ' + xhr.status);
                        }
                    }
                };
                xhr.onerror = function() {
                    alert('通信エラーが発生しました。');
                };
                var actionName = 'add_points';
                var data = 'action=' + actionName + '&user_ids=' + JSON.stringify(userIds) + '&amount=' + absAmount;
                xhr.send(data);
            }
        } else {
            alert('ユーザーを選択し、0以外の数値を入力してください。\n正の数：付与、負の数：削除');
        }
    });
</script>

<?php get_footer(); ?>