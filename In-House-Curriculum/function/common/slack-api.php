<?php

/**
 * Slack API連携機能
 */
/**
 * Slack APIにリクエストを送信
 */
function slack_api_request($endpoint, $params = [])
{
  $config = get_slack_config();

$token = $config['bot_token'];


  $url = $config['api_base_url'] . $endpoint;

  $args = array(
    'headers' => array(
      'Authorization' => 'Bearer ' . $config['bot_token'],
      'Content-Type' => 'application/json; charset=utf-8'
    ),
    'body' => json_encode($params),
    'method' => 'POST',
    'timeout' => 30
  );

  $response = wp_remote_post($url, $args);

  if (is_wp_error($response)) {
    return false;
  }

  $body = wp_remote_retrieve_body($response);
  return json_decode($body, true);
}

/**
 * 全てのチャンネル一覧を取得（プライベートのみ）
 */
 // slack-api.php
 
 require_once get_template_directory() . '/function/common/slack-config.php';
 
 function get_slack_channels()
 {
     $config = get_slack_config();
     $token = $config['bot_token'];
     $base_url = $config['api_base_url'] . 'conversations.list';
 
     if (empty($token)) {
         error_log('[Slack Error] トークンが設定されていません。');
         return [];
     }
 
     $params = [
         'types' => 'public_channel,private_channel',
         'limit' => 1000
     ];
 
     $query = http_build_query($params);
 
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $base_url . '?' . $query);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, [
         "Authorization: Bearer $token"
     ]);
 
     $response = curl_exec($ch);
     curl_close($ch);
 
     $data = json_decode($response, true);
 
     if (!isset($data['channels'])) {
         error_log('[Slack Error] チャンネル情報の取得に失敗: ' . print_r($data, true));
         return [];
     }
 
     // ✅ Botが参加しているチャンネルのみを抽出
     $private_channels = array_filter($data['channels'], function ($channel) {
      return !empty($channel['is_member']) && !empty($channel['is_private']);
      });
      return $private_channels;

       // ✅ 各チャンネルにメッセージ数を追加
     foreach ($joined_channels as &$channel) {
         $channel['message_count'] = get_channel_message_count($channel['id']);
     }
 
     return $joined_channels;
 }
 

/**
 * 指定されたタイプのチャンネルをページネーションで取得
 */
function get_channels_by_type($type)
{
  $channels = array();
  $cursor = null;
  $debug_info = array(
    'type' => $type,
    'pages' => 0,
    'total_channels' => 0,
    'private_channels' => 0,
    'channel_details' => array(),
    'raw_api_response' => array() // 生のAPIレスポンスを保存
  );

  do {
    $params = array(
      'types' => $type,
      'limit' => 1000,
      'exclude_archived' => false
    );

    if ($cursor) {
      $params['cursor'] = $cursor;
    }

    $response = slack_api_request('conversations.list', $params);

    if ($response && isset($response['ok']) && $response['ok']) {
      $page_channels = $response['channels'] ?? array();
      $channels = array_merge($channels, $page_channels);

      $debug_info['pages']++;
      $debug_info['total_channels'] += count($page_channels);

      // 各チャンネルの詳細情報を記録（生データも含む）
      foreach ($page_channels as $channel) {
        // より詳細なプライベート判定
        $is_private = false;
        if (isset($channel['is_private'])) {
          $is_private = (bool)$channel['is_private'];
        } elseif (isset($channel['is_group'])) {
          $is_private = (bool)$channel['is_group'];
        } elseif ($type === 'private_channel') {
          $is_private = true; // private_channelタイプで取得した場合はプライベート
        }

        // 追加の判定: チャンネルIDの形式で判定
        if (!$is_private && $type === 'private_channel') {
          // private_channelタイプで取得されたチャンネルは、Botが招待されていなくてもプライベート
          $is_private = true;
        }

        $debug_info['channel_details'][] = array(
          'id' => $channel['id'],
          'name' => $channel['name'],
          'display_name' => $channel['name_normalized'] ?? $channel['name'],
          'is_private' => $is_private,
          'is_archived' => $channel['is_archived'] ?? false,
          'member_count' => $channel['num_members'] ?? 0,
          'raw_is_private' => $channel['is_private'] ?? 'undefined',
          'raw_is_group' => $channel['is_group'] ?? 'undefined',
          'type_requested' => $type
        );

        if ($is_private) {
          $debug_info['private_channels']++;
        }
      }

      // 生のAPIレスポンスも保存
      $debug_info['raw_api_response'][] = array(
        'page' => $debug_info['pages'],
        'channels_count' => count($page_channels),
        'sample_channels' => array_slice($page_channels, 0, 3) // 最初の3件をサンプルとして保存
      );

      // 次のページがあるかチェック
      if (isset($response['response_metadata']['next_cursor']) && !empty($response['response_metadata']['next_cursor'])) {
        $cursor = $response['response_metadata']['next_cursor'];
      } else {
        $cursor = null;
      }
    } else {
      // エラーが発生した場合はループを終了
      $cursor = null;
    }
  } while ($cursor);

  // デバッグ情報を保存
  update_option('slack_channels_by_type_debug_' . $type, $debug_info);

  return $channels;
}

/**
 * チャンネルのメッセージ数を取得
 */
function get_channel_message_count($channel_id)
{
    $messages = [];
    $cursor = null;
    $has_more = true;

    while ($has_more) {
        $params = [
            'channel' => $channel_id,
            'limit' => 200
        ];
        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        $response = slack_api_request('conversations.history', $params);

        if (!$response || !$response['ok']) {
            error_log('[Slack Error] メッセージ取得失敗: ' . print_r($response, true));
            return '未取得';
        }

        $messages = array_merge($messages, $response['messages']);
        $cursor = $response['response_metadata']['next_cursor'] ?? null;
        $has_more = !empty($cursor);
    }

    return count($messages);
}

/**
 * チャンネル情報とメッセージ数を取得
 */
function get_slack_channels_with_message_count()
{
  $channels = get_slack_channels();
  $result = array();
  $debug_info = array(
    'total_channels' => count($channels),
    'public_channels' => 0,
    'private_channels' => 0,
    'processed_channels' => array()
  );

  foreach ($channels as $channel) {
    $message_count = get_channel_message_count($channel['id']);

    $channel_info = array(
      'id' => $channel['id'],
      'name' => $channel['name'],
      'display_name' => $channel['name_normalized'] ?? $channel['name'],
      'is_private' => $channel['is_private'] ?? false,
      'is_archived' => $channel['is_archived'] ?? false,
      'member_count' => $channel['num_members'] ?? 0,
      'message_count' => $message_count,
      'topic' => isset($channel['topic']['value']) ? $channel['topic']['value'] : '',
      'purpose' => isset($channel['purpose']['value']) ? $channel['purpose']['value'] : '',
      'channel_type' => $channel['is_private'] ? 'private' : 'public'
    );

    $result[] = $channel_info;

    // デバッグ情報を記録
    if ($channel_info['is_private']) {
      $debug_info['private_channels']++;
    } else {
      $debug_info['public_channels']++;
    }

    $debug_info['processed_channels'][] = array(
      'name' => $channel_info['display_name'],
      'type' => $channel_info['is_private'] ? 'private' : 'public',
      'message_count' => $message_count
    );
  }

  // メッセージ数でソート（降順）
  usort($result, function ($a, $b) {
    $countA = isset($a['message_count']) ? (int)$a['message_count'] : 0;
    $countB = isset($b['message_count']) ? (int)$b['message_count'] : 0;
    return $countB - $countA;
});


  // デバッグ情報を保存
  update_option('slack_channels_debug', $debug_info);

  return $result;
}

/**
 * Slack APIの接続テスト
 */
function test_slack_api_connection()
{
  $response = slack_api_request('auth.test');

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => $response['error'] ?? 'Unknown error'
    );
  }

  return array(
    'success' => true,
    'team_name' => $response['team'] ?? '',
    'user_name' => $response['user'] ?? '',
    'team_id' => $response['team_id'] ?? ''
  );
}

/**
 * プライベートチャンネルの取得テスト
 */
function test_private_channels_access()
{
  $response = slack_api_request('conversations.list', array(
    'types' => 'private_channel',
    'limit' => 1
  ));

  if (!$response || !isset($response['ok'])) {
    return array(
      'success' => false,
      'error' => 'API接続エラー'
    );
  }

  if (!$response['ok']) {
    return array(
      'success' => false,
      'error' => $response['error'] ?? 'プライベートチャンネルへのアクセス権限がありません'
    );
  }

  return array(
    'success' => true,
    'message' => 'プライベートチャンネルへのアクセス権限があります',
    'count' => count($response['channels'] ?? array())
  );
}

/**
 * デバッグ情報を取得
 */
function get_slack_debug_info()
{
  $debug_info = get_option('slack_debug_info', array());
  $config = get_slack_config();

  return array(
    'debug_info' => $debug_info,
    'bot_token_exists' => !empty($config['bot_token']),
    'bot_token_prefix' => substr($config['bot_token'], 0, 4) . '...',
    'api_base_url' => $config['api_base_url']
  );
}

/**
 * Botの権限を確認
 */
function check_bot_permissions()
{
  $response = slack_api_request('auth.test');

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => 'Bot Tokenが無効です'
    );
  }

  // Botの権限を確認
  $permissions_response = slack_api_request('users.info', array(
    'user' => $response['user_id']
  ));

  if (!$permissions_response || !isset($permissions_response['ok']) || !$permissions_response['ok']) {
    return array(
      'success' => false,
      'error' => 'Botの権限情報を取得できません'
    );
  }

  return array(
    'success' => true,
    'bot_info' => $permissions_response['user'],
    'team_info' => $response
  );
}

/**
 * Botの現在のスコープ設定を確認
 */
function check_bot_scopes()
{
  $response = slack_api_request('auth.test');

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => 'Bot Tokenが無効です'
    );
  }

  // Botの権限を確認
  $permissions_response = slack_api_request('users.info', array(
    'user' => $response['user_id']
  ));

  if (!$permissions_response || !isset($permissions_response['ok']) || !$permissions_response['ok']) {
    return array(
      'success' => false,
      'error' => 'Botの権限情報を取得できません'
    );
  }

  // 必要なスコープのリスト
  $required_scopes = array(
    'channels:read' => 'パブリックチャンネル一覧の取得',
    'groups:read' => 'プライベートチャンネル一覧の取得',
    'channels:history' => 'パブリックチャンネルのメッセージ履歴取得',
    'groups:history' => 'プライベートチャンネルのメッセージ履歴取得',
    'im:read' => 'ダイレクトメッセージ一覧の取得',
    'im:history' => 'ダイレクトメッセージの履歴取得',
    'mpim:read' => 'グループダイレクトメッセージ一覧の取得',
    'mpim:history' => 'グループダイレクトメッセージの履歴取得',
    'users:read' => 'ユーザー情報の取得'
  );

  // 現在のスコープを取得（実際にはAPIで取得できないため、手動で確認）
  $current_scopes = array(
    'channels:read' => true,
    'groups:read' => true,
    'channels:history' => true,
    'users:read' => true
  );

  return array(
    'success' => true,
    'bot_info' => $permissions_response['user'],
    'team_info' => $response,
    'required_scopes' => $required_scopes,
    'current_scopes' => $current_scopes
  );
}

/**
 * Bot Tokenのスコープを直接確認
 */
function check_bot_token_scopes()
{
  // auth.testでBot Tokenの基本情報を取得
  $auth_response = slack_api_request('auth.test');

  if (!$auth_response || !isset($auth_response['ok']) || !$auth_response['ok']) {
    return array(
      'success' => false,
      'error' => 'Bot Tokenが無効です: ' . ($auth_response['error'] ?? 'unknown')
    );
  }

  // 現在のBot Tokenで利用可能なスコープをテスト
  $scope_tests = array(
    'channels:read' => array('method' => 'conversations.list', 'params' => array('types' => 'public_channel', 'limit' => 1)),
    'groups:read' => array('method' => 'conversations.history
', 'params' => array('types' => 'private_channel', 'limit' => 1)),
    'channels:history' => array('method' => 'conversations.history', 'params' => array('channel' => 'C031EPH6PMG', 'limit' => 1)),
    'users:read' => array('method' => 'users.list', 'params' => array('limit' => 1))
  );

  $test_results = array();

  foreach ($scope_tests as $scope => $test) {
    $response = slack_api_request($test['method'], $test['params']);
    $test_results[$scope] = array(
      'available' => $response && isset($response['ok']) && $response['ok'],
      'error' => $response['error'] ?? null
    );
  }

  return array(
    'success' => true,
    'bot_info' => $auth_response,
    'scope_tests' => $test_results
  );
}

/**
 * 推奨されるスコープ設定を取得
 */
function get_recommended_scopes()
{
  return array(
    'channels:read' => 'パブリックチャンネル一覧の取得',
    'groups:read' => 'プライベートチャンネル一覧の取得',
    'channels:history' => 'パブリックチャンネルのメッセージ履歴取得',
    'groups:history' => 'プライベートチャンネルのメッセージ履歴取得',
    'im:read' => 'ダイレクトメッセージ一覧の取得',
    'im:history' => 'ダイレクトメッセージの履歴取得',
    'mpim:read' => 'グループダイレクトメッセージ一覧の取得',
    'mpim:history' => 'グループダイレクトメッセージの履歴取得',
    'users:read' => 'ユーザー情報の取得'
  );
}

/**
 * 特定のチャンネル情報を直接取得
 */
function get_specific_channel_info($channel_name)
{
  // まず、conversations.listでチャンネルを検索
  $response = slack_api_request('conversations.list', array(
    'types' => 'public_channel,private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => 'チャンネル一覧の取得に失敗しました'
    );
  }

  $channels = $response['channels'] ?? array();
  $target_channel = null;

  // 指定されたチャンネル名を検索
  foreach ($channels as $channel) {
    $display_name = $channel['name_normalized'] ?? $channel['name'];
    if ($display_name === $channel_name) {
      $target_channel = $channel;
      break;
    }
  }

  if (!$target_channel) {
    return array(
      'success' => false,
      'error' => 'チャンネル「' . $channel_name . '」が見つかりません'
    );
  }

  return array(
    'success' => true,
    'channel' => array(
      'id' => $target_channel['id'],
      'name' => $target_channel['name'],
      'display_name' => $target_channel['name_normalized'] ?? $target_channel['name'],
      'is_private' => $target_channel['is_private'] ?? false,
      'is_archived' => $target_channel['is_archived'] ?? false,
      'member_count' => $target_channel['num_members'] ?? 0,
      'topic' => isset($target_channel['topic']['value']) ? $target_channel['topic']['value'] : '',
      'purpose' => isset($target_channel['purpose']['value']) ? $target_channel['purpose']['value'] : ''
    )
  );
}

/**
 * Botが招待されているチャンネル一覧を取得
 */
function get_bot_invited_channels()
{
  $response = slack_api_request('conversations.list', array(
    'types' => 'private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => 'プライベートチャンネルの取得に失敗しました'
    );
  }

  $channels = $response['channels'] ?? array();
  $invited_channels = array();

  foreach ($channels as $channel) {
    $invited_channels[] = array(
      'id' => $channel['id'],
      'name' => $channel['name'],
      'display_name' => $channel['name_normalized'] ?? $channel['name'],
      'is_private' => $channel['is_private'] ?? false,
      'member_count' => $channel['num_members'] ?? 0
    );
  }

  return array(
    'success' => true,
    'channels' => $invited_channels,
    'count' => count($invited_channels)
  );
}

/**
 * 全チャンネル一覧を取得（デバッグ用）
 */
function get_all_channels_debug()
{
  $response = slack_api_request('conversations.list', array(
    'types' => 'public_channel,private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => 'チャンネル一覧の取得に失敗しました'
    );
  }

  $channels = $response['channels'] ?? array();
  $all_channels = array();

  foreach ($channels as $channel) {
    $all_channels[] = array(
      'id' => $channel['id'],
      'name' => $channel['name'],
      'display_name' => $channel['name_normalized'] ?? $channel['name'],
      'is_private' => $channel['is_private'] ?? false,
      'is_archived' => $channel['is_archived'] ?? false,
      'member_count' => $channel['num_members'] ?? 0,
      'topic' => isset($channel['topic']['value']) ? $channel['topic']['value'] : '',
      'purpose' => isset($channel['purpose']['value']) ? $channel['purpose']['value'] : ''
    );
  }

  // 名前でソート
  usort($all_channels, function ($a, $b) {
    return strcmp($a['display_name'], $b['display_name']);
  });

  return array(
    'success' => true,
    'channels' => $all_channels,
    'count' => count($all_channels),
    'public_count' => count(array_filter($all_channels, function ($c) {
      return !$c['is_private'];
    })),
    'private_count' => count(array_filter($all_channels, function ($c) {
      return $c['is_private'];
    }))
  );
}

/**
 * チャンネルIDで直接情報を取得
 */
function get_channel_info_by_id($channel_id)
{
  $response = slack_api_request('conversations.info', array(
    'channel' => $channel_id
  ));

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => $response['error'] ?? 'チャンネル情報の取得に失敗しました'
    );
  }

  $channel = $response['channel'];

  return array(
    'success' => true,
    'channel' => array(
      'id' => $channel['id'],
      'name' => $channel['name'],
      'display_name' => $channel['name_normalized'] ?? $channel['name'],
      'is_private' => $channel['is_private'] ?? false,
      'is_archived' => $channel['is_archived'] ?? false,
      'member_count' => $channel['num_members'] ?? 0,
      'topic' => isset($channel['topic']['value']) ? $channel['topic']['value'] : '',
      'purpose' => isset($channel['purpose']['value']) ? $channel['purpose']['value'] : ''
    )
  );
}

/**
 * ワークスペース内の全チャンネルを検索（包括的）
 */
function search_all_channels_comprehensive()
{
  $all_channels = array();

  // 1. パブリックチャンネルを取得
  $public_response = slack_api_request('conversations.list', array(
    'types' => 'public_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if ($public_response && isset($public_response['ok']) && $public_response['ok']) {
    $all_channels = array_merge($all_channels, $public_response['channels'] ?? array());
  }

  // 2. プライベートチャンネルを取得
  $private_response = slack_api_request('conversations.list', array(
    'types' => 'private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if ($private_response && isset($private_response['ok']) && $private_response['ok']) {
    $all_channels = array_merge($all_channels, $private_response['channels'] ?? array());
  }

  // 3. 結果を整理
  $formatted_channels = array();
  foreach ($all_channels as $channel) {
    $formatted_channels[] = array(
      'id' => $channel['id'],
      'name' => $channel['name'],
      'display_name' => $channel['name_normalized'] ?? $channel['name'],
      'is_private' => $channel['is_private'] ?? false,
      'is_archived' => $channel['is_archived'] ?? false,
      'member_count' => $channel['num_members'] ?? 0,
      'topic' => isset($channel['topic']['value']) ? $channel['topic']['value'] : '',
      'purpose' => isset($channel['purpose']['value']) ? $channel['purpose']['value'] : ''
    );
  }

  // 名前でソート
  usort($formatted_channels, function ($a, $b) {
    return strcmp($a['display_name'], $b['display_name']);
  });

  return array(
    'success' => true,
    'channels' => $formatted_channels,
    'count' => count($formatted_channels),
    'public_count' => count(array_filter($formatted_channels, function ($c) {
      return !$c['is_private'];
    })),
    'private_count' => count(array_filter($formatted_channels, function ($c) {
      return $c['is_private'];
    }))
  );
}

/**
 * 無料版制限を考慮したチャンネル情報取得
 */
function get_channel_info_free_workaround($channel_id)
{
  // 1. まず conversations.info を試す
  $response = slack_api_request('conversations.info', array(
    'channel' => $channel_id
  ));

  if ($response && isset($response['ok']) && $response['ok']) {
    return array(
      'success' => true,
      'method' => 'conversations.info',
      'channel' => array(
        'id' => $response['channel']['id'],
        'name' => $response['channel']['name'],
        'display_name' => $response['channel']['name_normalized'] ?? $response['channel']['name'],
        'is_private' => $response['channel']['is_private'] ?? false,
        'is_archived' => $response['channel']['is_archived'] ?? false,
        'member_count' => $response['channel']['num_members'] ?? 0,
        'topic' => isset($response['channel']['topic']['value']) ? $response['channel']['topic']['value'] : '',
        'purpose' => isset($response['channel']['purpose']['value']) ? $response['channel']['purpose']['value'] : ''
      )
    );
  }

  // 2. エラーの場合は、channels.info を試す（古いAPI）
  $response2 = slack_api_request('channels.info', array(
    'channel' => $channel_id
  ));

  if ($response2 && isset($response2['ok']) && $response2['ok']) {
    return array(
      'success' => true,
      'method' => 'channels.info',
      'channel' => array(
        'id' => $response2['channel']['id'],
        'name' => $response2['channel']['name'],
        'display_name' => $response2['channel']['name_normalized'] ?? $response2['channel']['name'],
        'is_private' => false, // channels.info はパブリックチャンネルのみ
        'is_archived' => $response2['channel']['is_archived'] ?? false,
        'member_count' => $response2['channel']['num_members'] ?? 0,
        'topic' => isset($response2['channel']['topic']['value']) ? $response2['channel']['topic']['value'] : '',
        'purpose' => isset($response2['channel']['purpose']['value']) ? $response2['channel']['purpose']['value'] : ''
      )
    );
  }

  // 3. 両方とも失敗した場合
  return array(
    'success' => false,
    'error' => $response['error'] ?? 'チャンネル情報の取得に失敗しました',
    'conversations_error' => $response['error'] ?? 'unknown',
    'channels_error' => $response2['error'] ?? 'unknown'
  );
}

/**
 * ワークスペース情報を取得（無料版制限の確認）
 */
function get_workspace_info()
{
  $response = slack_api_request('team.info');

  if (!$response || !isset($response['ok']) || !$response['ok']) {
    return array(
      'success' => false,
      'error' => $response['error'] ?? 'ワークスペース情報の取得に失敗しました'
    );
  }

  $team = $response['team'];

  return array(
    'success' => true,
    'workspace' => array(
      'id' => $team['id'],
      'name' => $team['name'],
      'domain' => $team['domain'],
      'plan' => $team['plan'] ?? 'free',
      'is_enterprise' => $team['is_enterprise'] ?? false
    )
  );
}

/**
 * Botの招待状況を詳しく調査
 */
function investigate_bot_invitation_status()
{
  $results = array();

  // 1. 現在のBot Tokenで取得可能なプライベートチャンネルを確認
  $private_response = slack_api_request('conversations.list', array(
    'types' => 'private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if ($private_response && isset($private_response['ok']) && $private_response['ok']) {
    $results['private_channels'] = $private_response['channels'] ?? array();
    $results['private_count'] = count($results['private_channels']);
  } else {
    $results['private_error'] = $private_response['error'] ?? 'unknown';
  }

  // 2. 特定のチャンネルIDで直接確認
  $specific_channel_id = 'C083RN4F127'; // 「三猿」チャンネルのID
  $channel_response = slack_api_request('conversations.info', array(
    'channel' => $specific_channel_id
  ));

  if ($channel_response && isset($channel_response['ok']) && $channel_response['ok']) {
    $results['specific_channel'] = $channel_response['channel'];
    $results['specific_channel_accessible'] = true;
  } else {
    $results['specific_channel_error'] = $channel_response['error'] ?? 'unknown';
    $results['specific_channel_accessible'] = false;
  }

  // 3. Botの基本情報を取得
  $auth_response = slack_api_request('auth.test');
  if ($auth_response && isset($auth_response['ok']) && $auth_response['ok']) {
    $results['bot_info'] = $auth_response;
  }

  return $results;
}

/**
 * プライベートチャンネルへの招待状況を確認
 */
function check_private_channel_invitation_status()
{
  $results = array();

  // 現在取得可能なプライベートチャンネル一覧
  $private_channels = get_bot_invited_channels();

  if ($private_channels['success']) {
    $results['invited_channels'] = $private_channels['channels'];
    $results['invited_count'] = $private_channels['count'];

    // 「三猿」チャンネルが含まれているかチェック
    $sanen_found = false;
    foreach ($private_channels['channels'] as $channel) {
      if ($channel['display_name'] === '三猿') {
        $sanen_found = true;
        $results['sanen_channel'] = $channel;
        break;
      }
    }
    $results['sanen_invited'] = $sanen_found;
  } else {
    $results['error'] = $private_channels['error'];
  }

  return $results;
}

/**
 * プライベートチャンネルの招待状況を詳しく調査
 */
function investigate_private_channel_invitation()
{
  $results = array();

  // 1. private_channelタイプで取得したチャンネル一覧
  $private_response = slack_api_request('conversations.list', array(
    'types' => 'private_channel',
    'limit' => 1000,
    'exclude_archived' => false
  ));

  if ($private_response && isset($private_response['ok']) && $private_response['ok']) {
    $private_channels = $private_response['channels'] ?? array();
    $results['private_channels'] = $private_channels;
    $results['private_count'] = count($private_channels);

    // 各チャンネルの詳細情報を分析
    $channel_analysis = array();
    foreach ($private_channels as $channel) {
      $analysis = array(
        'id' => $channel['id'],
        'name' => $channel['name'],
        'display_name' => $channel['name_normalized'] ?? $channel['name'],
        'is_private_flag' => isset($channel['is_private']) ? $channel['is_private'] : 'undefined',
        'is_group_flag' => isset($channel['is_group']) ? $channel['is_group'] : 'undefined',
        'member_count' => $channel['num_members'] ?? 0,
        'is_archived' => $channel['is_archived'] ?? false,
        'invitation_status' => 'unknown'
      );

      // 招待状況を確認（conversations.infoでアクセス可能かテスト）
      $info_response = slack_api_request('conversations.info', array(
        'channel' => $channel['id']
      ));

      if ($info_response && isset($info_response['ok']) && $info_response['ok']) {
        $analysis['invitation_status'] = 'invited';
        $analysis['accessible'] = true;
      } else {
        $analysis['invitation_status'] = 'not_invited';
        $analysis['accessible'] = false;
        $analysis['error'] = $info_response['error'] ?? 'unknown';
      }

      $channel_analysis[] = $analysis;
    }

    $results['channel_analysis'] = $channel_analysis;
  } else {
    $results['error'] = $private_response['error'] ?? 'unknown';
  }

  return $results;
}
