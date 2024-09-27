<?php get_header(); ?>
    <div class="page-wappaer">
        <section id="pageーchat" class="page">
            <div class="chat">
                <div class="header">
                    <p class="TL">カリキュラム＞　アクションページ</p>
                </div>
                <div class="chat-content">
                    <div class="timeline-modal">
                        <p class="timeline-TL">完了タイムライン</p>
                        <div class="timeline-wrap">
                            <div class="timeline">
                                <?php
                                // ログインしているユーザーのグループを取得
                                $current_user_id = get_current_user_id();
                                $user_group = $current_user_id ? get_user_meta($current_user_id, 'user_group', true) : null;

                                // JavaScriptのエンキューとデータのローカライズ
                                wp_enqueue_script('cooperator-script', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
                                wp_localize_script('cooperator-script', 'userGroupData', array(
                                    'group' => $user_group,
                                    'username' => wp_get_current_user()->user_login,
                                    'ajaxurl' => admin_url('admin-ajax.php')
                                ));

                                // 同じグループに所属するユーザーを取得
                                $args = array(
                                    'meta_key'   => 'user_group',
                                    'meta_value' => $user_group,
                                );

                                $group_users = get_users($args);

                                // グループユーザーの進捗をチェック
                                foreach ($group_users as $user) {
                                    $user_id = $user->ID;  // ループ内のユーザーID
                                    $user_name = $user->display_name;

                                    // ユーザーの進捗を取得（各項目の100%チェック）
                                    $progress_data = array(
                                        'DIVパズル１' => get_user_meta($user_id, 'div01', true) ?: '0',
                                        'DIVパズル２' => get_user_meta($user_id, 'div02', true) ?: '0',
                                        'DIVパズル３' => get_user_meta($user_id, 'div03', true) ?: '0',
                                        'DIVパズル４' => get_user_meta($user_id, 'div04', true) ?: '0',
                                        'DIVパズル５' => get_user_meta($user_id, 'div05', true) ?: '0',
                                        'DIVパズル６' => get_user_meta($user_id, 'div06', true) ?: '0',
                                        'DIVパズル７' => get_user_meta($user_id, 'div07', true) ?: '0',
                                        'レスポンシブ課題' => get_user_meta($user_id, 'responsive', true) ?: '0',
                                        'jQuery１' => get_user_meta($user_id, 'JQ01', true) ?: '0',
                                        'jQuery２' => get_user_meta($user_id, 'JQ02', true) ?: '0',
                                        'jQuery３' => get_user_meta($user_id, 'JQ03', true) ?: '0',
                                        'jQuery４' => get_user_meta($user_id, 'JQ04', true) ?: '0',
                                        'jQuery５' => get_user_meta($user_id, 'JQ05', true) ?: '0',
                                        'jQuery６' => get_user_meta($user_id, 'JQ06', true) ?: '0',
                                        'jQuery７' => get_user_meta($user_id, 'JQ07', true) ?: '0',
                                        'jQuery８' => get_user_meta($user_id, 'JQ08', true) ?: '0',
                                        'jQuery９' => get_user_meta($user_id, 'JQ09', true) ?: '0',
                                        'jQuery１０' => get_user_meta($user_id, 'JQ10', true) ?: '0',
                                        'JQ最終課題' => get_user_meta($user_id, 'JQLast', true) ?: '0',
                                        'サイト制作' => get_user_meta($user_id, 'LP01', true) ?: '0',
                                        'Sass01' => get_user_meta($user_id, 'Sass01', true) ?: '0',
                                        'FAM01' => get_user_meta($user_id, 'FAM01', true) ?: '0',
                                        'JS01' => get_user_meta($user_id, 'JS01', true) ?: '0',
                                        'WP01' => get_user_meta($user_id, 'WP01', true) ?: '0',
                                        'SEO01' => get_user_meta($user_id, 'SEO01', true) ?: '0',
                                    );

                                    // 日時を保存するカスタムフィールド名
                                    $date_fields = array(
                                        'div01_date', 'div02_date', 'div03_date', 'div04_date', 'div05_date',
                                        'div06_date', 'div07_date', 'responsive_date', 'JQ01_date', 'JQ02_date',
                                        'JQ03_date', 'JQ04_date', 'JQ05_date', 'JQ06_date', 'JQ07_date',
                                        'JQ08_date', 'JQ09_date', 'JQ10_date', 'JQLast_date', 'LP01_date',
                                        'Sass01_date', 'FAM01_date', 'JS01_date', 'WP01_date', 'SEO01_date'
                                    );

                                    // 100%の項目をタイムラインに表示
                                    $i = 0;
                                    foreach ($progress_data as $key => $value) {
                                        if ($value == '100') {
                                            if (!get_user_meta($user_id, $date_fields[$i], true)) {
                                                $current_time = current_time('mysql');
                                                update_user_meta($user_id, $date_fields[$i], $current_time);
                                            }
                                    
                                            $completion_date = get_user_meta($user_id, $date_fields[$i], true);
                                            $formatted_date = date_i18n('n月j日 G:i', strtotime($completion_date));
                                    
                                            // 正しいitem_idを使用していいねカウントを取得
                                            $item_id = $user_id . '_' . $key;
                                            $like_count = get_option('global_like_count_' . $item_id, 0); // グローバルいいね数を取得
                                    
                                            // 既にいいねしているか確認
                                            $liked_items = get_user_meta(get_current_user_id(), 'liked_items', true) ?: array();
                                    
                                            // 投稿に対して一度でもいいねされているかを確認するフラグ
                                            $already_liked_any = in_array($item_id . '_heart', $liked_items) || in_array($item_id . '_hand', $liked_items) || in_array($item_id . '_cat', $liked_items);
                                    
                                            echo '<div class="timeline-item">';
                                            echo '<h3>' . esc_html($user_name) . 'さんが<br>' . esc_html($key) . 'を完了しました！'  . '</h3>';
                                            echo '<div class="like-button-wrap">';
                                    
                                            // ボタンごとに異なるitem_idを設定し、どれか一つでも「いいね」されている場合は全てのボタンを無効化
                                            echo '<button class="like-button heart' . (in_array($item_id . '_heart', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_heart') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">いいね</button>';
                                            echo '<button class="like-button hand' . (in_array($item_id . '_hand', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_hand') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">おめでとう</button>';
                                            echo '<button class="like-button cat' . (in_array($item_id . '_cat', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_cat') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">負けないよ</button>';
                                    
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        $i++;
                                    }
                                }
                                ?>
                            </div>
                            <div class="C_reaction timeline-jamp">
                                <div class="coin-counter">
                                    <div class="icon"></div>
                                    <div class="number">3</div>
                                </div>
                                <div class="textbox">
                                    <p class="TX">5回リアクションを送ろう！</p>
                                    <div class="reaction-counter">0/5</div>
                                </div>
                            </div>
                            <div class="chat-back sp timeline-jamp">
                                <div class="icon"></div>
                                <p class="TX">チャットに戻る</p>
                            </div>
                        </div>
                    </div>

                    <div class="chat-wrap">
                        <div class="chat-TL">
                        <p class="TL"><?php echo esc_html($user_group); ?>チャット</p>
                        </div>
                        <?php if (function_exists('simple_ajax_chat')) simple_ajax_chat(); ?>
                        <div class="C_reaction sp good-jamp timeline-jamp" >
                            <div class="textbox">
                                <p class="TX">5回リアクションを<br>送ろう！</p>
                                <div class="reaction-counter">0/5</div>
                            </div>
                            <div class="coin-counter">
                                <div class="icon"></div>
                                <div class="number">3</div>
                            </div>
                        </div>

                    </div>





                </div>

            </div>
        </section>    
    </div>


<?php get_footer(); ?>

