<?php get_header(); ?>

<div class="slack-channels-container">
  <div class="container">
    <h1 class="page-title">Slack プライベートチャンネル一覧</h1>
    <p class="page-description">プライベートチャンネル（鍵付き）のみを表示しています。</p>

    <?php
    require_once get_template_directory() . '/function/common/slack-api.php';
    // Slack API接続テスト
    $connection_test = test_slack_api_connection();

    if (!$connection_test['success']): ?>
      <div class="alert alert-danger">
        <h3>Slack API接続エラー</h3>
        <p>エラー: <?php echo esc_html($connection_test['error']); ?></p>
        <p>Slack Bot Tokenが正しく設定されているか確認してください。</p>
      </div>
    <?php else: ?>
      <div class="connection-info">
        <p><strong>接続成功:</strong> <?php echo esc_html($connection_test['team_name']); ?> (<?php echo esc_html($connection_test['user_name']); ?>)</p>
      </div>

      <?php
      // チャンネル情報を取得
      $channels = get_slack_channels();

      if (empty($channels)): ?>
        <div class="alert alert-warning">
          <p>チャンネル情報を取得できませんでした。</p>
        </div>
      <?php else: ?>
        <div class="channels-stats">
          <div class="stats-summary">
            <div class="stat-item">
              <span class="stat-number"><?php echo count($channels); ?></span>
              <span class="stat-label">プライベートチャンネル数</span>
            </div>
            <div class="stat-item">
              <span class="stat-number"><?php echo array_sum(array_column($channels, 'member_count')); ?></span>
              <span class="stat-label">総メンバー数</span>
            </div>
            <div class="stat-item">
              <span class="stat-number"><?php echo array_sum(array_column($channels, 'message_count')); ?></span>
              <span class="stat-label">総メッセージ数</span>
            </div>
          </div>
        </div>

        <div class="channels-table">
          <table class="table">
            <thead>
              <tr>
                <th>チャンネル名</th>
                <th>メッセージ数</th>
                <th>メンバー数</th>
                <th>トピック</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($channels as $channel): ?>
                <tr class="<?php echo $channel['is_archived'] ? 'archived' : ''; ?>">
                  <td>
                    <span class="channel-name">
                      <?php if ($channel['is_private']): ?>
                        <span class="private-icon" title="プライベートチャンネル">🔒</span>
                      <?php endif; ?>
                      <?php echo esc_html($channel['name']); ?>
                    </span>
                    <?php if ($channel['is_archived']): ?>
                      <span class="archived-badge">アーカイブ済み</span>
                    <?php endif; ?>
                  </td>
                  <td class="message-count">
                    <span class="count-number"><?php echo esc_html($channel['message_count'] ?? '未取得'); ?></span>
                  </td>
                  <td class="member-count">
                    <?php echo esc_html($channel['num_members']); ?>
                  </td>
                  <td class="channel-topic">
                    <?php echo esc_html($channel['topic']['value'] ?? ''); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<style>
  .slack-channels-container {
    padding: 40px 0;
    background-color: #f8f9fa;
    min-height: 100vh;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .page-title {
    text-align: center;
    margin-bottom: 40px;
    color: #333;
    font-size: 2.5rem;
    font-weight: bold;
  }

  .page-description {
    text-align: center;
    margin-bottom: 40px;
    color: #666;
    font-size: 1.1rem;
  }

  .alert {
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
  }

  .alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
  }

  .alert-warning {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
  }

  .connection-info {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 30px;
  }

  .channels-stats {
    margin-bottom: 30px;
  }

  .stats-summary {
    display: flex;
    gap: 30px;
    justify-content: center;
    margin-bottom: 30px;
  }

  .stat-item {
    text-align: center;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    min-width: 150px;
  }

  .stat-number {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    color: #007bff;
  }

  .stat-label {
    display: block;
    margin-top: 5px;
    color: #666;
    font-size: 0.9rem;
  }

  .channels-table {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
  }

  .table th {
    background-color: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
    color: #495057;
  }

  .table td {
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
  }

  .table tbody tr:hover {
    background-color: #f8f9fa;
  }

  .table tbody tr.archived {
    opacity: 0.6;
  }

  .channel-name {
    font-weight: 500;
    color: #333;
  }

  .private-icon {
    margin-right: 5px;
  }

  .archived-badge {
    background-color: #6c757d;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    margin-left: 10px;
  }

  .count-number {
    font-weight: bold;
    color: #007bff;
    font-size: 1.1rem;
  }

  .badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
  }

  .badge-public {
    background-color: #d4edda;
    color: #155724;
  }

  .badge-private {
    background-color: #f8d7da;
    color: #721c24;
  }

  .channel-topic {
    color: #666;
    font-size: 0.9rem;
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  @media (max-width: 768px) {
    .stats-summary {
      flex-direction: column;
      align-items: center;
    }

    .stat-item {
      min-width: 120px;
    }

    .table {
      font-size: 0.9rem;
    }

    .table th,
    .table td {
      padding: 10px 8px;
    }

    .channel-topic {
      max-width: 150px;
    }
  }
</style>

<?php get_footer(); ?>