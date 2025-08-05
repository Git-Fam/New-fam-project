<?php

/**
 * Slack API設定
 */

// Slack API設定を取得
function get_slack_config()
{
  // WordPressのオプションから取得（管理画面で設定可能）
  $bot_token = get_option('slack_bot_token', '');

  // 環境変数から取得（本番環境用）
  if (empty($bot_token) && defined('SLACK_BOT_TOKEN')) {
    $bot_token = SLACK_BOT_TOKEN;
  }

  // 定数から取得（開発環境用）
  if (empty($bot_token) && defined('SLACK_BOT_TOKEN_DEV')) {
    $bot_token = SLACK_BOT_TOKEN_DEV;
  }

  return array(
    'bot_token' => $bot_token,
    'api_base_url' => 'https://slack.com/api/'
  );
}

// Slack Bot Tokenを設定する管理画面機能
function add_slack_settings_page()
{
  add_options_page(
    'Slack API設定',
    'Slack API設定',
    'manage_options',
    'slack-api-settings',
    'slack_settings_page'
  );
}
add_action('admin_menu', 'add_slack_settings_page');

// 設定ページのHTML
function slack_settings_page()
{
  if (isset($_POST['submit'])) {
    update_option('slack_bot_token', sanitize_text_field($_POST['slack_bot_token']));
    echo '<div class="notice notice-success"><p>設定を保存しました。</p></div>';
  }

  $current_token = get_option('slack_bot_token', '');
?>
  <div class="wrap">
    <h1>Slack API設定</h1>
    <form method="post">
      <table class="form-table">
        <tr>
          <th scope="row">
            <label for="slack_bot_token">Slack Bot Token</label>
          </th>
          <td>
            <input type="password"
              id="slack_bot_token"
              name="slack_bot_token"
              value="<?php echo esc_attr($current_token); ?>"
              class="regular-text" />
            <p class="description">
              Slack AppのBot User OAuth Tokenを入力してください。<br>
              <a href="https://api.slack.com/apps" target="_blank">Slack API Apps</a>でアプリを作成し、Bot Token Scopesに以下を追加してください：
            </p>
            <ul>
              <li><code>channels:read</code> - パブリックチャンネル一覧の取得</li>
              <li><code>groups:read</code> - プライベートチャンネル（鍵付き）の取得</li>
              <li><code>channels:history</code> - チャンネルのメッセージ履歴取得</li>
              <li><code>users:read</code> - ユーザー情報の取得</li>
            </ul>
            <p><strong>重要:</strong> プライベートチャンネル（鍵付き）を取得するには、Botがそのチャンネルに招待されている必要があります。</p>

            <h4>⚠️ 追加で必要なスコープ</h4>
            <p>プライベートチャンネルに完全にアクセスするには、以下のスコープも追加してください：</p>
            <ul>
              <li><code>groups:history</code> - プライベートチャンネルのメッセージ履歴取得</li>
              <li><code>im:read</code> - ダイレクトメッセージ一覧の取得</li>
              <li><code>im:history</code> - ダイレクトメッセージの履歴取得</li>
              <li><code>mpim:read</code> - グループダイレクトメッセージ一覧の取得</li>
              <li><code>mpim:history</code> - グループダイレクトメッセージの履歴取得</li>
            </ul>
            <p><strong>設定方法:</strong></p>
            <ol>
              <li><a href="https://api.slack.com/apps" target="_blank">Slack API Apps</a>でアプリを開く</li>
              <li>「OAuth & Permissions」をクリック</li>
              <li>「Bot Token Scopes」セクションで「Add an OAuth Scope」をクリック</li>
              <li>上記のスコープを追加</li>
              <li>「Install to Workspace」をクリックして再インストール</li>
            </ol>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>

    <h2>接続テスト</h2>
    <?php
    if (!empty($current_token)) {
      $config = get_slack_config();

      // 基本接続テスト
      $test_result = test_slack_api_connection();

      if ($test_result['success']) {
        echo '<div class="notice notice-success"><p>✅ 基本接続成功: ' . esc_html($test_result['team_name']) . '</p></div>';

        // Bot権限確認
        $bot_permissions = check_bot_permissions();
        if ($bot_permissions['success']) {
          echo '<div class="notice notice-success"><p>✅ Bot権限確認成功: ' . esc_html($bot_permissions['bot_info']['name'] ?? 'Unknown') . '</p></div>';
        } else {
          echo '<div class="notice notice-warning"><p>⚠️ Bot権限確認: ' . esc_html($bot_permissions['error']) . '</p></div>';
        }

        // プライベートチャンネルアクセステスト
        $private_test = test_private_channels_access();

        if ($private_test['success']) {
          echo '<div class="notice notice-success"><p>✅ プライベートチャンネルアクセス成功: ' . esc_html($private_test['message']) . '</p></div>';
        } else {
          echo '<div class="notice notice-warning"><p>⚠️ プライベートチャンネルアクセス: ' . esc_html($private_test['error']) . '</p></div>';
          echo '<div class="notice notice-info"><p>💡 プライベートチャンネルにアクセスするには、Botを各プライベートチャンネルに招待してください。</p></div>';
        }

        // チャンネル情報の取得テスト
        $channels = get_slack_channels_with_message_count();
        $public_count = 0;
        $private_count = 0;

        foreach ($channels as $channel) {
          if ($channel['is_private']) {
            $private_count++;
          } else {
            $public_count++;
          }
        }

        echo '<div class="notice notice-info"><p>📊 取得可能なチャンネル: パブリック ' . $public_count . '件, プライベート ' . $private_count . '件</p></div>';

        // 実際に取得されたチャンネルの詳細情報
        if (!empty($channels)) {
          echo '<h4>取得されたチャンネル詳細</h4>';
          echo '<div class="card">';
          echo '<table class="widefat">';
          echo '<thead><tr><th>チャンネル名</th><th>タイプ</th><th>メンバー数</th><th>メッセージ数</th></tr></thead>';
          echo '<tbody>';
          foreach ($channels as $channel) {
            $type = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
            echo '<tr>';
            echo '<td>' . esc_html($channel['display_name']) . '</td>';
            echo '<td>' . $type . '</td>';
            echo '<td>' . esc_html($channel['member_count']) . '</td>';
            echo '<td>' . esc_html($channel['message_count']) . '</td>';
            echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
          echo '</div>';

          // 詳細デバッグ情報を表示
          $channels_debug = get_option('slack_channels_debug', array());
          if (!empty($channels_debug)) {
            echo '<h4>詳細デバッグ情報</h4>';
            echo '<div class="card">';
            echo '<ul>';
            echo '<li>総チャンネル数: ' . ($channels_debug['total_channels'] ?? 0) . '件</li>';
            echo '<li>処理済みパブリックチャンネル: ' . ($channels_debug['public_channels'] ?? 0) . '件</li>';
            echo '<li>処理済みプライベートチャンネル: ' . ($channels_debug['private_channels'] ?? 0) . '件</li>';
            echo '</ul>';

            if (!empty($channels_debug['processed_channels'])) {
              echo '<h5>処理されたチャンネル一覧</h5>';
              echo '<table class="widefat">';
              echo '<thead><tr><th>チャンネル名</th><th>タイプ</th><th>メッセージ数</th></tr></thead>';
              echo '<tbody>';
              foreach ($channels_debug['processed_channels'] as $processed) {
                $type = $processed['type'] === 'private' ? '🔒 プライベート' : '# パブリック';
                echo '<tr>';
                echo '<td>' . esc_html($processed['name']) . '</td>';
                echo '<td>' . $type . '</td>';
                echo '<td>' . esc_html($processed['message_count']) . '</td>';
                echo '</tr>';
              }
              echo '</tbody>';
              echo '</table>';
            }
            echo '</div>';
          }

          // get_channels_by_type関数のデバッグ情報を表示
          $public_debug = get_option('slack_channels_by_type_debug_public_channel', array());
          $private_debug = get_option('slack_channels_by_type_debug_private_channel', array());

          if (!empty($public_debug) || !empty($private_debug)) {
            echo '<h4>API呼び出し詳細</h4>';
            echo '<div class="card">';

            if (!empty($public_debug)) {
              echo '<h5>パブリックチャンネル取得</h5>';
              echo '<ul>';
              echo '<li>タイプ: ' . esc_html($public_debug['type']) . '</li>';
              echo '<li>ページ数: ' . ($public_debug['pages'] ?? 0) . '</li>';
              echo '<li>総チャンネル数: ' . ($public_debug['total_channels'] ?? 0) . '件</li>';
              echo '<li>プライベートチャンネル数: ' . ($public_debug['private_channels'] ?? 0) . '件</li>';
              echo '</ul>';
            }

            if (!empty($private_debug)) {
              echo '<h5>プライベートチャンネル取得</h5>';
              echo '<ul>';
              echo '<li>タイプ: ' . esc_html($private_debug['type']) . '</li>';
              echo '<li>ページ数: ' . ($private_debug['pages'] ?? 0) . '</li>';
              echo '<li>総チャンネル数: ' . ($private_debug['total_channels'] ?? 0) . '件</li>';
              echo '<li>プライベートチャンネル数: ' . ($private_debug['private_channels'] ?? 0) . '件</li>';
              echo '</ul>';

              // 取得されたチャンネルの詳細一覧を表示
              if (!empty($private_debug['channel_details'])) {
                echo '<h6>取得されたチャンネル詳細</h6>';
                echo '<table class="widefat">';
                echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>プライベート</th><th>アーカイブ</th><th>メンバー数</th><th>生データ</th></tr></thead>';
                echo '<tbody>';
                foreach ($private_debug['channel_details'] as $channel) {
                  $is_private = $channel['is_private'] ? '🔒 はい' : '❌ いいえ';
                  $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';
                  $raw_data = 'is_private: ' . ($channel['raw_is_private'] ?? 'undefined') . ', is_group: ' . ($channel['raw_is_group'] ?? 'undefined');
                  echo '<tr>';
                  echo '<td>' . esc_html($channel['display_name']) . '</td>';
                  echo '<td><code>' . esc_html($channel['id']) . '</code></td>';
                  echo '<td>' . $is_private . '</td>';
                  echo '<td>' . $is_archived . '</td>';
                  echo '<td>' . esc_html($channel['member_count']) . '</td>';
                  echo '<td><small>' . esc_html($raw_data) . '</small></td>';
                  echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
              }

              // 生のAPIレスポンス情報を表示
              if (!empty($private_debug['raw_api_response'])) {
                echo '<h6>生APIレスポンス情報</h6>';
                echo '<table class="widefat">';
                echo '<thead><tr><th>ページ</th><th>チャンネル数</th><th>サンプルデータ</th></tr></thead>';
                echo '<tbody>';
                foreach ($private_debug['raw_api_response'] as $page_data) {
                  echo '<tr>';
                  echo '<td>' . $page_data['page'] . '</td>';
                  echo '<td>' . $page_data['channels_count'] . '</td>';
                  echo '<td><small>';
                  foreach ($page_data['sample_channels'] as $sample) {
                    echo 'ID: ' . esc_html($sample['id']) . ', Name: ' . esc_html($sample['name']) . ', is_private: ' . (isset($sample['is_private']) ? ($sample['is_private'] ? 'true' : 'false') : 'undefined') . '<br>';
                  }
                  echo '</small></td>';
                  echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
              }
            }

            echo '</div>';
          }
        }

        // デバッグ情報を表示
        $debug_info = get_slack_debug_info();
        if (!empty($debug_info['debug_info'])) {
          echo '<h3>デバッグ情報</h3>';
          echo '<div class="card">';
          echo '<h4>API呼び出し結果</h4>';
          echo '<ul>';
          if (isset($debug_info['debug_info']['public_count'])) {
            echo '<li>パブリックチャンネル: ' . $debug_info['debug_info']['public_count'] . '件</li>';
          }
          if (isset($debug_info['debug_info']['public_error'])) {
            echo '<li>パブリックチャンネルエラー: ' . esc_html($debug_info['debug_info']['public_error']) . '</li>';
          }
          if (isset($debug_info['debug_info']['private_count'])) {
            echo '<li>プライベートチャンネル: ' . $debug_info['debug_info']['private_count'] . '件</li>';
          }
          if (isset($debug_info['debug_info']['private_error'])) {
            echo '<li>プライベートチャンネルエラー: ' . esc_html($debug_info['debug_info']['private_error']) . '</li>';
          }
          echo '</ul>';

          // プライベートチャンネルの詳細情報
          if (isset($debug_info['debug_info']['private_count']) && $debug_info['debug_info']['private_count'] > 0) {
            echo '<h4>プライベートチャンネル情報</h4>';
            echo '<p>✅ プライベートチャンネルが正常に取得されています。</p>';
            echo '<p>プライベートチャンネルが表示されない場合は、Botが各チャンネルに招待されているか確認してください。</p>';
          } else {
            echo '<h4>プライベートチャンネル情報</h4>';
            echo '<p>⚠️ プライベートチャンネルが取得できていません。</p>';
            echo '<p>以下の手順を確認してください：</p>';
            echo '<ol>';
            echo '<li>Bot Token Scopesに <code>groups:read</code> が含まれているか確認</li>';
            echo '<li>各プライベートチャンネルで <code>/invite @Bot名</code> を実行</li>';
            echo '<li>Botがチャンネルのメンバーリストに表示されるか確認</li>';
            echo '</ol>';
          }

          echo '</div>';
        }
      } else {
        echo '<div class="notice notice-error"><p>❌ 接続失敗: ' . esc_html($test_result['error']) . '</p></div>';
      }
    } else {
      echo '<div class="notice notice-warning"><p>⚠️ Bot Tokenが設定されていません。</p></div>';
    }
    ?>

    <?php if (!empty($current_token)): ?>
      <!-- 「三猿」チャンネルの詳細情報を表示 -->
      <h4>「三猿」チャンネル詳細</h4>
      <div class="card">
        <?php
        $sanen_info = get_specific_channel_info('三猿');
        if ($sanen_info['success']) {
          $channel = $sanen_info['channel'];
          $is_private = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
          $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';

          echo '<table class="widefat">';
          echo '<tr><th>項目</th><th>値</th></tr>';
          echo '<tr><td>チャンネル名</td><td>' . esc_html($channel['display_name']) . '</td></tr>';
          echo '<tr><td>チャンネルID</td><td><code>' . esc_html($channel['id']) . '</code></td></tr>';
          echo '<tr><td>タイプ</td><td>' . $is_private . '</td></tr>';
          echo '<tr><td>アーカイブ</td><td>' . $is_archived . '</td></tr>';
          echo '<tr><td>メンバー数</td><td>' . esc_html($channel['member_count']) . '</td></tr>';
          echo '<tr><td>トピック</td><td>' . esc_html($channel['topic']) . '</td></tr>';
          echo '<tr><td>目的</td><td>' . esc_html($channel['purpose']) . '</td></tr>';
          echo '</table>';
        } else {
          echo '<p>❌ エラー: ' . esc_html($sanen_info['error']) . '</p>';
        }
        ?>
      </div>

      <!-- Botが招待されているチャンネル一覧を表示 -->
      <h4>Botが招待されているプライベートチャンネル</h4>
      <div class="card">
        <?php
        $invited_channels = get_bot_invited_channels();
        if ($invited_channels['success']) {
          if ($invited_channels['count'] > 0) {
            echo '<p>✅ Botが招待されているプライベートチャンネル: ' . $invited_channels['count'] . '件</p>';
            echo '<table class="widefat">';
            echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>メンバー数</th></tr></thead>';
            echo '<tbody>';
            foreach ($invited_channels['channels'] as $channel) {
              echo '<tr>';
              echo '<td>' . esc_html($channel['display_name']) . '</td>';
              echo '<td><code>' . esc_html($channel['id']) . '</code></td>';
              echo '<td>' . esc_html($channel['member_count']) . '</td>';
              echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
          } else {
            echo '<p>⚠️ Botが招待されているプライベートチャンネルがありません。</p>';
            echo '<p>プライベートチャンネルで <code>/invite @curriculumApp</code> を実行してください。</p>';
          }
        } else {
          echo '<p>❌ エラー: ' . esc_html($invited_channels['error']) . '</p>';
        }
        ?>
      </div>
    <?php endif; ?>

    <!-- 全チャンネル一覧を表示（デバッグ用） -->
    <h4>全チャンネル一覧（デバッグ用）</h4>
    <div class="card">
      <?php
      $all_channels = get_all_channels_debug();
      if ($all_channels['success']) {
        echo '<p>📊 総チャンネル数: ' . $all_channels['count'] . '件 (パブリック: ' . $all_channels['public_count'] . '件, プライベート: ' . $all_channels['private_count'] . '件)</p>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>タイプ</th><th>アーカイブ</th><th>メンバー数</th><th>トピック</th></tr></thead>';
        echo '<tbody>';
        foreach ($all_channels['channels'] as $channel) {
          $is_private = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
          $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';
          $row_class = $channel['display_name'] === '三猿' ? 'style="background-color: #fff3cd;"' : '';
          echo '<tr ' . $row_class . '>';
          echo '<td>' . esc_html($channel['display_name']) . '</td>';
          echo '<td><code>' . esc_html($channel['id']) . '</code></td>';
          echo '<td>' . $is_private . '</td>';
          echo '<td>' . $is_archived . '</td>';
          echo '<td>' . esc_html($channel['member_count']) . '</td>';
          echo '<td>' . esc_html($channel['topic']) . '</td>';
          echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
      } else {
        echo '<p>❌ エラー: ' . esc_html($all_channels['error']) . '</p>';
      }
      ?>
    </div>

    <!-- 包括的なチャンネル検索結果 -->
    <h4>包括的なチャンネル検索結果</h4>
    <div class="card">
      <?php
      $comprehensive_channels = search_all_channels_comprehensive();
      if ($comprehensive_channels['success']) {
        echo '<p>📊 総チャンネル数: ' . $comprehensive_channels['count'] . '件 (パブリック: ' . $comprehensive_channels['public_count'] . '件, プライベート: ' . $comprehensive_channels['private_count'] . '件)</p>';

        if ($comprehensive_channels['count'] > 0) {
          echo '<table class="widefat">';
          echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>タイプ</th><th>アーカイブ</th><th>メンバー数</th><th>トピック</th></tr></thead>';
          echo '<tbody>';
          foreach ($comprehensive_channels['channels'] as $channel) {
            $is_private = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
            $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';
            $row_class = $channel['display_name'] === '三猿' ? 'style="background-color: #fff3cd;"' : '';
            echo '<tr ' . $row_class . '>';
            echo '<td>' . esc_html($channel['display_name']) . '</td>';
            echo '<td><code>' . esc_html($channel['id']) . '</code></td>';
            echo '<td>' . $is_private . '</td>';
            echo '<td>' . $is_archived . '</td>';
            echo '<td>' . esc_html($channel['member_count']) . '</td>';
            echo '<td>' . esc_html($channel['topic']) . '</td>';
            echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
        } else {
          echo '<p>⚠️ チャンネルが見つかりませんでした。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($comprehensive_channels['error']) . '</p>';
      }
      ?>
    </div>

    <!-- 手動でチャンネルIDを指定して確認 -->
    <h4>手動チャンネル確認</h4>
    <div class="card">
      <p>「三猿」チャンネルのIDがわかっている場合は、直接確認できます。</p>
      <p>Slackで「三猿」チャンネルを開き、URLの <code>channels/</code> の後の文字列がチャンネルIDです。</p>
      <p>例: <code>https://app.slack.com/client/T1234567890/C0987654321</code> の <code>C0987654321</code> 部分</p>

      <!-- 「三猿」チャンネルIDで直接確認 -->
      <h5>「三猿」チャンネル（ID: C083RN4F127）の直接確認</h5>
      <?php
      $sanen_by_id = get_channel_info_by_id('C083RN4F127');
      if ($sanen_by_id['success']) {
        $channel = $sanen_by_id['channel'];
        $is_private = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
        $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';

        echo '<table class="widefat">';
        echo '<tr><th>項目</th><th>値</th></tr>';
        echo '<tr><td>チャンネル名</td><td>' . esc_html($channel['display_name']) . '</td></tr>';
        echo '<tr><td>チャンネルID</td><td><code>' . esc_html($channel['id']) . '</code></td></tr>';
        echo '<tr><td>タイプ</td><td>' . $is_private . '</td></tr>';
        echo '<tr><td>アーカイブ</td><td>' . $is_archived . '</td></tr>';
        echo '<tr><td>メンバー数</td><td>' . esc_html($channel['member_count']) . '</td></tr>';
        echo '<tr><td>トピック</td><td>' . esc_html($channel['topic']) . '</td></tr>';
        echo '<tr><td>目的</td><td>' . esc_html($channel['purpose']) . '</td></tr>';
        echo '</table>';

        if ($channel['is_private']) {
          echo '<p>✅ 「三猿」チャンネルはプライベートチャンネルです。</p>';
          echo '<p>⚠️ Botがこのチャンネルに招待されていないため、APIで取得できません。</p>';
          echo '<p>💡 解決方法: 「三猿」チャンネルで <code>/invite @curriculumApp</code> を実行してください。</p>';
        } else {
          echo '<p>ℹ️ 「三猿」チャンネルはパブリックチャンネルです。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($sanen_by_id['error']) . '</p>';
        echo '<p>💡 このエラーは、Botが「三猿」チャンネルにアクセスする権限がないことを意味します。</p>';
        echo '<p>解決方法: 「三猿」チャンネルで <code>/invite @curriculumApp</code> を実行してください。</p>';

        // エラーの詳細分析
        if ($sanen_by_id['error'] === 'invalid_arguments') {
          echo '<h6>エラー詳細分析</h6>';
          echo '<ul>';
          echo '<li><strong>invalid_arguments</strong>: チャンネルIDが無効またはBotがアクセスできない</li>';
          echo '<li><strong>channel_not_found</strong>: チャンネルが存在しない</li>';
          echo '<li><strong>missing_scope</strong>: Botに必要な権限がない</li>';
          echo '</ul>';
          echo '<p><strong>推奨される解決手順:</strong></p>';
          echo '<ol>';
          echo '<li>Slackで「三猿」チャンネルを開く</li>';
          echo '<li>メッセージ入力欄に <code>/invite @curriculumApp</code> と入力</li>';
          echo '<li>Enterキーを押してBotを招待</li>';
          echo '<li>Botがチャンネルのメンバーリストに表示されることを確認</li>';
          echo '<li>WordPress管理画面を再読み込みして確認</li>';
          echo '</ol>';
        }
      }
      ?>
    </div>

    <!-- ワークスペース情報と無料版制限の確認 -->
    <h4>ワークスペース情報と制限確認</h4>
    <div class="card">
      <?php
      $workspace_info = get_workspace_info();
      if ($workspace_info['success']) {
        $workspace = $workspace_info['workspace'];
        $plan = $workspace['plan'];
        $is_free = $plan === 'free';

        echo '<table class="widefat">';
        echo '<tr><th>項目</th><th>値</th></tr>';
        echo '<tr><td>ワークスペース名</td><td>' . esc_html($workspace['name']) . '</td></tr>';
        echo '<tr><td>ドメイン</td><td>' . esc_html($workspace['domain']) . '</td></tr>';
        echo '<tr><td>プラン</td><td>' . esc_html($plan) . '</td></tr>';
        echo '<tr><td>エンタープライズ</td><td>' . ($workspace['is_enterprise'] ? '✅ はい' : '❌ いいえ') . '</td></tr>';
        echo '</table>';

        if ($is_free) {
          echo '<h5>⚠️ 無料版の制限について</h5>';
          echo '<ul>';
          echo '<li>プライベートチャンネルの数に制限がある場合があります</li>';
          echo '<li>Botの権限が制限される場合があります</li>';
          echo '<li>API呼び出し回数に制限がある場合があります</li>';
          echo '</ul>';
          echo '<p><strong>推奨:</strong> 有料プランへのアップグレードを検討してください。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($workspace_info['error']) . '</p>';
      }
      ?>
    </div>

    <!-- 無料版制限を考慮した「三猿」チャンネル確認 -->
    <h4>無料版制限を考慮した「三猿」チャンネル確認</h4>
    <div class="card">
      <?php
      $sanen_workaround = get_channel_info_free_workaround('C083RN4F127');
      if ($sanen_workaround['success']) {
        $channel = $sanen_workaround['channel'];
        $is_private = $channel['is_private'] ? '🔒 プライベート' : '# パブリック';
        $is_archived = $channel['is_archived'] ? '✅ はい' : '❌ いいえ';

        echo '<p>✅ 成功: ' . esc_html($sanen_workaround['method']) . ' を使用して取得</p>';
        echo '<table class="widefat">';
        echo '<tr><th>項目</th><th>値</th></tr>';
        echo '<tr><td>チャンネル名</td><td>' . esc_html($channel['display_name']) . '</td></tr>';
        echo '<tr><td>チャンネルID</td><td><code>' . esc_html($channel['id']) . '</code></td></tr>';
        echo '<tr><td>タイプ</td><td>' . $is_private . '</td></tr>';
        echo '<tr><td>アーカイブ</td><td>' . $is_archived . '</td></tr>';
        echo '<tr><td>メンバー数</td><td>' . esc_html($channel['member_count']) . '</td></tr>';
        echo '<tr><td>トピック</td><td>' . esc_html($channel['topic']) . '</td></tr>';
        echo '<tr><td>目的</td><td>' . esc_html($channel['purpose']) . '</td></tr>';
        echo '</table>';

        if ($channel['is_private']) {
          echo '<p>✅ 「三猿」チャンネルはプライベートチャンネルです。</p>';
          echo '<p>💡 無料版の制限により、一部の機能が制限される可能性があります。</p>';
        } else {
          echo '<p>ℹ️ 「三猿」チャンネルはパブリックチャンネルです。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($sanen_workaround['error']) . '</p>';
        echo '<h6>詳細エラー情報</h6>';
        echo '<ul>';
        echo '<li>conversations.info エラー: ' . esc_html($sanen_workaround['conversations_error']) . '</li>';
        echo '<li>channels.info エラー: ' . esc_html($sanen_workaround['channels_error']) . '</li>';
        echo '</ul>';
        echo '<p><strong>推奨される解決手順:</strong></p>';
        echo '<ol>';
        echo '<li>Slackで「三猿」チャンネルを開く</li>';
        echo '<li>メッセージ入力欄に <code>/invite @curriculumApp</code> と入力</li>';
        echo '<li>Enterキーを押してBotを招待</li>';
        echo '<li>Botがチャンネルのメンバーリストに表示されることを確認</li>';
        echo '<li>有料プランへのアップグレードを検討</li>';
        echo '</ol>';
      }
      ?>
    </div>

    <!-- Botのスコープ設定確認 -->
    <h4>Botのスコープ設定確認</h4>
    <div class="card">
      <?php
      $scope_check = check_bot_scopes();
      if ($scope_check['success']) {
        echo '<h5>必要なスコープ一覧</h5>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>スコープ</th><th>説明</th><th>現在の状態</th></tr></thead>';
        echo '<tbody>';

        foreach ($scope_check['required_scopes'] as $scope => $description) {
          $is_set = isset($scope_check['current_scopes'][$scope]) && $scope_check['current_scopes'][$scope];
          $status = $is_set ? '✅ 設定済み' : '❌ 未設定';
          $row_class = $is_set ? '' : 'style="background-color: #ffe6e6;"';

          echo '<tr ' . $row_class . '>';
          echo '<td><code>' . esc_html($scope) . '</code></td>';
          echo '<td>' . esc_html($description) . '</td>';
          echo '<td>' . $status . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // 不足しているスコープの確認
        $missing_scopes = array();
        foreach ($scope_check['required_scopes'] as $scope => $description) {
          if (!isset($scope_check['current_scopes'][$scope]) || !$scope_check['current_scopes'][$scope]) {
            $missing_scopes[] = $scope;
          }
        }

        if (!empty($missing_scopes)) {
          echo '<h5>⚠️ 不足しているスコープ</h5>';
          echo '<p>以下のスコープを追加してください：</p>';
          echo '<ul>';
          foreach ($missing_scopes as $scope) {
            echo '<li><code>' . esc_html($scope) . '</code> - ' . esc_html($scope_check['required_scopes'][$scope]) . '</li>';
          }
          echo '</ul>';
          echo '<p><strong>設定手順:</strong></p>';
          echo '<ol>';
          echo '<li><a href="https://api.slack.com/apps" target="_blank">Slack API Apps</a>でアプリを開く</li>';
          echo '<li>「OAuth & Permissions」をクリック</li>';
          echo '<li>「Bot Token Scopes」セクションで「Add an OAuth Scope」をクリック</li>';
          echo '<li>上記のスコープを追加</li>';
          echo '<li>「Install to Workspace」をクリックして再インストール</li>';
          echo '</ol>';
        } else {
          echo '<p>✅ 全ての必要なスコープが設定されています。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($scope_check['error']) . '</p>';
      }
      ?>
    </div>

    <!-- Bot Tokenのスコープ直接確認 -->
    <h4>Bot Tokenのスコープ直接確認</h4>
    <div class="card">
      <?php
      $token_scope_check = check_bot_token_scopes();
      if ($token_scope_check['success']) {
        echo '<h5>Bot Token基本情報</h5>';
        echo '<table class="widefat">';
        echo '<tr><th>項目</th><th>値</th></tr>';
        echo '<tr><td>Bot名</td><td>' . esc_html($token_scope_check['bot_info']['user'] ?? 'Unknown') . '</td></tr>';
        echo '<tr><td>チーム名</td><td>' . esc_html($token_scope_check['bot_info']['team'] ?? 'Unknown') . '</td></tr>';
        echo '<tr><td>チームID</td><td><code>' . esc_html($token_scope_check['bot_info']['team_id'] ?? 'Unknown') . '</code></td></tr>';
        echo '<tr><td>Bot ID</td><td><code>' . esc_html($token_scope_check['bot_info']['user_id'] ?? 'Unknown') . '</code></td></tr>';
        echo '</table>';

        echo '<h5>スコープテスト結果</h5>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>スコープ</th><th>説明</th><th>利用可能</th><th>エラー</th></tr></thead>';
        echo '<tbody>';

        $recommended_scopes = get_recommended_scopes();
        foreach ($token_scope_check['scope_tests'] as $scope => $result) {
          $status = $result['available'] ? '✅ 利用可能' : '❌ 利用不可';
          $error = $result['error'] ? esc_html($result['error']) : '-';
          $row_class = $result['available'] ? '' : 'style="background-color: #ffe6e6;"';

          echo '<tr ' . $row_class . '>';
          echo '<td><code>' . esc_html($scope) . '</code></td>';
          echo '<td>' . esc_html($recommended_scopes[$scope] ?? '説明なし') . '</td>';
          echo '<td>' . $status . '</td>';
          echo '<td>' . $error . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // 不足しているスコープの確認
        $missing_scopes = array();
        foreach ($token_scope_check['scope_tests'] as $scope => $result) {
          if (!$result['available']) {
            $missing_scopes[] = $scope;
          }
        }

        if (!empty($missing_scopes)) {
          echo '<h5>⚠️ 不足しているスコープ</h5>';
          echo '<p>以下のスコープが不足しています：</p>';
          echo '<ul>';
          foreach ($missing_scopes as $scope) {
            echo '<li><code>' . esc_html($scope) . '</code> - ' . esc_html($recommended_scopes[$scope] ?? '説明なし') . '</li>';
          }
          echo '</ul>';

          // channels:historyスコープの特別な説明
          if (in_array('channels:history', $missing_scopes)) {
            echo '<h6>💡 channels:historyスコープについて</h6>';
            echo '<p><strong>channels:history</strong> スコープは、Botがチャンネルのメンバーになっている場合のみ利用可能です。</p>';
            echo '<p>エラー「not_in_channel」は、Botがチャンネルに招待されていないことを意味します。</p>';
            echo '<p><strong>解決手順:</strong></p>';
            echo '<ol>';
            echo '<li>Slack Appの設定で <code>channels:history</code> スコープを追加</li>';
            echo '<li>「Install to Workspace」をクリックして再インストール</li>';
            echo '<li>新しいBot Tokenを取得してWordPressに設定</li>';
            echo '<li>各チャンネルで <code>/invite @curriculumApp</code> を実行</li>';
            echo '<li>Botがチャンネルのメンバーリストに表示されることを確認</li>';
            echo '</ol>';
          }

          echo '<p><strong>設定手順:</strong></p>';
          echo '<ol>';
          echo '<li><a href="https://api.slack.com/apps" target="_blank">Slack API Apps</a>でアプリを開く</li>';
          echo '<li>「OAuth & Permissions」をクリック</li>';
          echo '<li>「Bot Token Scopes」セクションで「Add an OAuth Scope」をクリック</li>';
          echo '<li>上記のスコープを追加</li>';
          echo '<li>「Install to Workspace」をクリックして再インストール</li>';
          echo '<li>新しいBot Tokenを取得してWordPressに設定</li>';
          echo '</ol>';
        } else {
          echo '<p>✅ 全ての必要なスコープが利用可能です。</p>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($token_scope_check['error']) . '</p>';
        echo '<p>💡 Bot Tokenが無効です。Slack Appの設定を確認してください。</p>';
      }
      ?>
    </div>

    <!-- スコープ設定完了後の次のステップ -->
    <h4>🎉 スコープ設定完了！次のステップ</h4>
    <div class="card">
      <p>✅ 全ての必要なスコープが設定されました！</p>
      <p>次に、新しいBot Tokenを取得してWordPressに設定してください：</p>

      <h5>📋 手順</h5>
      <ol>
        <li><strong>Slack Appを再インストール</strong>
          <ul>
            <li>Slack Appの設定ページで「Install to Workspace」をクリック</li>
            <li>権限の確認画面で「Allow」をクリック</li>
          </ul>
        </li>
        <li><strong>新しいBot Tokenを取得</strong>
          <ul>
            <li>「OAuth & Permissions」ページを開く</li>
            <li>「Bot User OAuth Token」をコピー</li>
            <li>このトークンは <code>xoxb-</code> で始まります</li>
          </ul>
        </li>
        <li><strong>WordPressに新しいBot Tokenを設定</strong>
          <ul>
            <li>WordPress管理画面の「Slack API設定」を開く</li>
            <li>「Slack Bot Token」欄に新しいトークンを貼り付け</li>
            <li>「設定を保存」をクリック</li>
          </ul>
        </li>
        <li><strong>Botをチャンネルに招待</strong>
          <ul>
            <li>「三猿」チャンネルで <code>/invite @curriculumApp</code> を実行</li>
            <li>Botがチャンネルのメンバーリストに表示されることを確認</li>
          </ul>
        </li>
        <li><strong>動作確認</strong>
          <ul>
            <li>WordPress管理画面を再読み込み</li>
            <li>「三猿」チャンネルが表示されることを確認</li>
          </ul>
        </li>
      </ol>

      <h5>⚠️ 注意事項</h5>
      <ul>
        <li>新しいBot Tokenは古いトークンと異なります</li>
        <li>必ず新しいトークンをWordPressに設定してください</li>
        <li>Botをチャンネルに招待しないと、プライベートチャンネルにアクセスできません</li>
      </ul>
    </div>

    <h2>プライベートチャンネル（鍵付き）の取得について</h2>
    <div class="card">
      <h3>必要な手順</h3>
      <ol>
        <li><strong>Bot Token Scopes設定:</strong> Slack Appの設定で <code>groups:read</code> スコープを追加</li>
        <li><strong>Bot招待:</strong> 各プライベートチャンネルで <code>/invite @Bot名</code> を実行</li>
        <li><strong>権限確認:</strong> Botがチャンネルのメンバーになっていることを確認</li>
      </ol>

      <h3>よくある問題</h3>
      <ul>
        <li>Botがプライベートチャンネルに招待されていない</li>
        <li>Bot Token Scopesに <code>groups:read</code> が含まれていない</li>
        <li>ワークスペースの設定でBotの権限が制限されている</li>
        <li>Bot名が間違っている（App Nameを確認）</li>
      </ul>

      <h3>トラブルシューティング</h3>
      <ol>
        <li><strong>Bot名確認:</strong> Slack Appの "Basic Information" で "Display Name" を確認</li>
        <li><strong>招待確認:</strong> プライベートチャンネルで <code>/invite @Bot名</code> を実行</li>
        <li><strong>権限確認:</strong> Botがチャンネルのメンバーリストに表示されることを確認</li>
        <li><strong>スコープ確認:</strong> Slack Appの "OAuth & Permissions" で <code>groups:read</code> が含まれていることを確認</li>
      </ol>
    </div>

    <!-- Botの招待状況詳細調査 -->
    <h4>Botの招待状況詳細調査</h4>
    <div class="card">
      <?php
      $invitation_investigation = investigate_bot_invitation_status();
      $invitation_status = check_private_channel_invitation_status();

      echo '<h5>📊 調査結果サマリー</h5>';
      echo '<table class="widefat">';
      echo '<tr><th>項目</th><th>結果</th></tr>';

      // プライベートチャンネル取得状況
      if (isset($invitation_investigation['private_count'])) {
        echo '<tr><td>取得可能なプライベートチャンネル数</td><td>' . $invitation_investigation['private_count'] . '件</td></tr>';
      } else {
        echo '<tr><td>プライベートチャンネル取得エラー</td><td>❌ ' . esc_html($invitation_investigation['private_error'] ?? 'unknown') . '</td></tr>';
      }

      // 「三猿」チャンネルアクセス状況
      if (isset($invitation_investigation['specific_channel_accessible']) && $invitation_investigation['specific_channel_accessible']) {
        echo '<tr><td>「三猿」チャンネルアクセス</td><td>✅ アクセス可能</td></tr>';
      } else {
        echo '<tr><td>「三猿」チャンネルアクセス</td><td>❌ アクセス不可 (' . esc_html($invitation_investigation['specific_channel_error'] ?? 'unknown') . ')</td></tr>';
      }

      // 招待状況
      if (isset($invitation_status['sanen_invited'])) {
        echo '<tr><td>「三猿」チャンネルへの招待</td><td>' . ($invitation_status['sanen_invited'] ? '✅ 招待済み' : '❌ 未招待') . '</td></tr>';
      }

      echo '</table>';

      // 詳細情報
      if (isset($invitation_investigation['private_channels']) && !empty($invitation_investigation['private_channels'])) {
        echo '<h5>📋 取得可能なプライベートチャンネル一覧</h5>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>メンバー数</th></tr></thead>';
        echo '<tbody>';
        foreach ($invitation_investigation['private_channels'] as $channel) {
          $row_class = $channel['name_normalized'] === '三猿' ? 'style="background-color: #fff3cd;"' : '';
          echo '<tr ' . $row_class . '>';
          echo '<td>' . esc_html($channel['name_normalized'] ?? $channel['name']) . '</td>';
          echo '<td><code>' . esc_html($channel['id']) . '</code></td>';
          echo '<td>' . esc_html($channel['num_members'] ?? 0) . '</td>';
          echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
      }

      // 問題の診断
      echo '<h5>🔍 問題診断</h5>';
      if (isset($invitation_investigation['specific_channel_accessible']) && !$invitation_investigation['specific_channel_accessible']) {
        echo '<p>❌ <strong>問題:</strong> Botが「三猿」チャンネルにアクセスできません。</p>';
        echo '<p>💡 <strong>原因:</strong> Botが「三猿」チャンネルに招待されていない可能性があります。</p>';
        echo '<p>🛠️ <strong>解決方法:</strong></p>';
        echo '<ol>';
        echo '<li>Slackで「三猿」チャンネルを開く</li>';
        echo '<li>メッセージ入力欄に <code>/invite @curriculumApp</code> と入力</li>';
        echo '<li>Enterキーを押してBotを招待</li>';
        echo '<li>Botがチャンネルのメンバーリストに表示されることを確認</li>';
        echo '<li>WordPress管理画面を再読み込み</li>';
        echo '</ol>';
      } else {
        echo '<p>✅ <strong>状況:</strong> Botは「三猿」チャンネルにアクセス可能です。</p>';
      }
      ?>
    </div>

    <!-- プライベートチャンネル招待状況詳細調査 -->
    <h4>プライベートチャンネル招待状況詳細調査</h4>
    <div class="card">
      <?php
      $private_invitation_investigation = investigate_private_channel_invitation();

      if (isset($private_invitation_investigation['channel_analysis'])) {
        echo '<h5>📊 プライベートチャンネル分析結果</h5>';
        echo '<p>取得されたプライベートチャンネル数: <strong>' . $private_invitation_investigation['private_count'] . '件</strong></p>';

        echo '<table class="widefat">';
        echo '<thead><tr><th>チャンネル名</th><th>ID</th><th>招待状況</th><th>アクセス可能</th><th>メンバー数</th><th>フラグ情報</th></tr></thead>';
        echo '<tbody>';

        foreach ($private_invitation_investigation['channel_analysis'] as $analysis) {
          $invitation_status = $analysis['invitation_status'] === 'invited' ? '✅ 招待済み' : '❌ 未招待';
          $accessible = $analysis['accessible'] ? '✅ 可能' : '❌ 不可';
          $flags = 'is_private: ' . $analysis['is_private_flag'] . ', is_group: ' . $analysis['is_group_flag'];

          $row_class = $analysis['display_name'] === '三猿' ? 'style="background-color: #fff3cd;"' : '';

          echo '<tr ' . $row_class . '>';
          echo '<td>' . esc_html($analysis['display_name']) . '</td>';
          echo '<td><code>' . esc_html($analysis['id']) . '</code></td>';
          echo '<td>' . $invitation_status . '</td>';
          echo '<td>' . $accessible . '</td>';
          echo '<td>' . esc_html($analysis['member_count']) . '</td>';
          echo '<td><small>' . esc_html($flags) . '</small></td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // 問題の診断
        echo '<h5>🔍 問題診断</h5>';

        $invited_count = 0;
        $not_invited_count = 0;
        $sanen_found = false;
        $sanen_invited = false;

        foreach ($private_invitation_investigation['channel_analysis'] as $analysis) {
          if ($analysis['invitation_status'] === 'invited') {
            $invited_count++;
          } else {
            $not_invited_count++;
          }

          if ($analysis['display_name'] === '三猿') {
            $sanen_found = true;
            $sanen_invited = $analysis['invitation_status'] === 'invited';
          }
        }

        echo '<ul>';
        echo '<li>招待済みチャンネル: <strong>' . $invited_count . '件</strong></li>';
        echo '<li>未招待チャンネル: <strong>' . $not_invited_count . '件</strong></li>';

        if ($sanen_found) {
          echo '<li>「三猿」チャンネル: ' . ($sanen_invited ? '✅ 招待済み' : '❌ 未招待') . '</li>';
        } else {
          echo '<li>「三猿」チャンネル: ❌ 見つかりません</li>';
        }
        echo '</ul>';

        if ($not_invited_count > 0) {
          echo '<h6>⚠️ 未招待チャンネルの解決方法</h6>';
          echo '<p>以下のチャンネルでBotを招待してください：</p>';
          echo '<ul>';
          foreach ($private_invitation_investigation['channel_analysis'] as $analysis) {
            if ($analysis['invitation_status'] === 'not_invited') {
              echo '<li><strong>' . esc_html($analysis['display_name']) . '</strong> で <code>/invite @curriculumApp</code> を実行</li>';
            }
          }
          echo '</ul>';
        }
      } else {
        echo '<p>❌ エラー: ' . esc_html($private_invitation_investigation['error'] ?? 'unknown') . '</p>';
      }
      ?>
    </div>

    <!-- Slack App再インストール手順 -->
    <h4>🚨 Slack App再インストールが必要です</h4>
    <div class="card" style="border-left: 4px solid #dc3232;">
      <h5>問題の特定</h5>
      <p>Botは「三猿」チャンネルに招待されていますが、Slack Appに問題があります。</p>
      <p><strong>エラー:</strong> "アプリが見つかりません" または "アプリを表示する権限がありません"</p>

      <h5>🛠️ 解決手順</h5>
      <ol>
        <li><strong>Slack Appの設定ページを開く</strong>
          <ul>
            <li><a href="https://api.slack.com/apps" target="_blank">Slack API Apps</a>にアクセス</li>
            <li>該当するAppを選択</li>
          </ul>
        </li>
        <li><strong>Bot名を確認</strong>
          <ul>
            <li>「Basic Information」をクリック</li>
            <li>「Display Name」を確認（例: siteapp）</li>
            <li>この名前が招待に使用するBot名です</li>
          </ul>
        </li>
        <li><strong>OAuth & Permissionsを確認</strong>
          <ul>
            <li>「OAuth & Permissions」をクリック</li>
            <li>必要なスコープが全て追加されているか確認</li>
            <li>不足しているスコープがあれば追加</li>
          </ul>
        </li>
        <li><strong>Appを再インストール</strong>
          <ul>
            <li>「Install to Workspace」をクリック</li>
            <li>権限の確認画面で「Allow」をクリック</li>
            <li>新しいBot Tokenが生成される</li>
          </ul>
        </li>
        <li><strong>新しいBot Tokenを取得</strong>
          <ul>
            <li>「Bot User OAuth Token」をコピー</li>
            <li>このトークンは <code>xoxb-</code> で始まります</li>
          </ul>
        </li>
        <li><strong>WordPressに新しいBot Tokenを設定</strong>
          <ul>
            <li>WordPress管理画面の「Slack API設定」を開く</li>
            <li>「Slack Bot Token」欄に新しいトークンを貼り付け</li>
            <li>「設定を保存」をクリック</li>
          </ul>
        </li>
        <li><strong>Botをチャンネルに招待（重要）</strong>
          <ul>
            <li>「三猿」チャンネルで <code>/invite @siteapp</code> を実行</li>
            <li>（または確認したBot名を使用）</li>
            <li>Botがチャンネルのメンバーリストに表示されることを確認</li>
          </ul>
        </li>
        <li><strong>動作確認</strong>
          <ul>
            <li>WordPress管理画面を再読み込み</li>
            <li>「三猿」チャンネルが表示されることを確認</li>
          </ul>
        </li>
      </ol>

      <h5>⚠️ 重要な注意事項</h5>
      <ul>
        <li>新しいBot Tokenは古いトークンと異なります</li>
        <li>必ず新しいトークンをWordPressに設定してください</li>
        <li>Botは既に「三猿」チャンネルに招待されているので、再招待は不要です</li>
        <li>Appの権限が正しく設定されていれば、プライベートチャンネルが表示されます</li>
      </ul>

      <h5>🔍 確認ポイント</h5>
      <ul>
        <li>Slack Appの「Basic Information」で「Display Name」を確認</li>
        <li>「OAuth & Permissions」で必要なスコープが全て含まれているか確認</li>
        <li>「Install to Workspace」でAppが正しくインストールされているか確認</li>
      </ul>
    </div>

    <!-- 現在のBot名確認 -->
    <h4>🤖 現在のBot名確認</h4>
    <div class="card">
      <?php
      $auth_test = slack_api_request('auth.test');
      if ($auth_test && isset($auth_test['ok']) && $auth_test['ok']) {
        $bot_name = $auth_test['user'] ?? 'unknown';
        echo '<p><strong>現在のBot名:</strong> <code>' . esc_html($bot_name) . '</code></p>';
        echo '<p><strong>招待コマンド:</strong> <code>/invite @' . esc_html($bot_name) . '</code></p>';
        echo '<p>💡 このBot名を使用して「三猿」チャンネルに招待してください。</p>';
      } else {
        echo '<p>❌ Bot名を取得できませんでした。</p>';
      }
      ?>
    </div>
  </div>
<?php
}

// 設定を初期化
function init_slack_settings()
{
  add_option('slack_bot_token', '');
}
register_activation_hook(__FILE__, 'init_slack_settings');
