<?php get_header(); ?>
    <div class="page-wappaer">
        <section id="pageーchat" class="page">
            <div class="inner">
                <div class="chat">
                    <div class="header">
                        <p class="TL">カリキュラム＞　アクションページ</p>
                    </div>
                    <div class="chat-contents">
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
                                        'div01' => get_user_meta($user_id, 'div01', true) ?: '0',
                                        'div02' => get_user_meta($user_id, 'div02', true) ?: '0',
                                        'div03' => get_user_meta($user_id, 'div03', true) ?: '0',
                                        'div04' => get_user_meta($user_id, 'div04', true) ?: '0',
                                        'div05' => get_user_meta($user_id, 'div05', true) ?: '0',
                                        'div06' => get_user_meta($user_id, 'div06', true) ?: '0',
                                        'div07' => get_user_meta($user_id, 'div07', true) ?: '0',
                                        'responsive' => get_user_meta($user_id, 'responsive', true) ?: '0',
                                        'JQ01' => get_user_meta($user_id, 'JQ01', true) ?: '0',
                                        'JQ02' => get_user_meta($user_id, 'JQ02', true) ?: '0',
                                        'JQ03' => get_user_meta($user_id, 'JQ03', true) ?: '0',
                                        'JQ04' => get_user_meta($user_id, 'JQ04', true) ?: '0',
                                        'JQ05' => get_user_meta($user_id, 'JQ05', true) ?: '0',
                                        'JQ06' => get_user_meta($user_id, 'JQ06', true) ?: '0',
                                        'JQ07' => get_user_meta($user_id, 'JQ07', true) ?: '0',
                                        'JQ08' => get_user_meta($user_id, 'JQ08', true) ?: '0',
                                        'JQ09' => get_user_meta($user_id, 'JQ09', true) ?: '0',
                                        'JQ10' => get_user_meta($user_id, 'JQ10', true) ?: '0',
                                        'JQLast' => get_user_meta($user_id, 'JQLast', true) ?: '0',
                                        'LP01' => get_user_meta($user_id, 'LP01', true) ?: '0',
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
                                            $already_liked = in_array($item_id, $liked_items);

                                            echo '<div class="timeline-item">';
                                            echo '<h3>' . esc_html($user_name) . '：' . esc_html($key) . 'が完了しました　' . esc_html($formatted_date) . '</h3>';
                                            echo '<button class="like-button' . ($already_liked ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id) . '"' . ($already_liked ? ' disabled' : '') . '>いいね❤︎</button>';
                                            echo '<span class="like-count" id="like-count-' . esc_attr($item_id) . '">' . esc_html($like_count) . '</span>';
                                            echo '</div>';
                                        }
                                        $i++;
                                    }
                                }
                                ?>
                            </div>

                        </div>
                        <?php if (function_exists('simple_ajax_chat')) simple_ajax_chat(); ?>

                        <!-- この要素追加で新着メッセージ表示 -->
                        <div id="latest-messages"></div>

                    </div>

                </div>
            </div>
        </section>    
    </div>
<?php get_footer(); ?>


