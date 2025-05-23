<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>
<div class="page-wappaer">
    <section id="pageーchat" class="page">
        <div class="chat">
            <div class="header">
                <p class="TL">カリキュラム＞　アクションページ</p>
                <div class="chat--menu-btn">
                    <?php get_template_part('inc/menu-btn'); ?>
                </div>
            </div>
            <div class="chat-content">
                <div class="timeline-modal">
                    <p class="timeline-TL">完了タイムライン</p>
                    <div class="timeline-wrap">
                        <div class="timeline">
                            <?php
                            // --- タイムラインデータをためる配列 ---
                            $timeline_items = array();

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

                            // キー名と日本語課題名の対応表（必要なら増やして）
                            $task_names = array(
                                'div01' => 'DIVパズル１',
                                'div02' => 'DIVパズル２',
                                'div03' => 'DIVパズル３',
                                'div04' => 'DIVパズル４',
                                'div05' => 'DIVパズル５',
                                'div06' => 'DIVパズル６',
                                'div07' => 'DIVパズル７',
                                'responsive' => 'レスポンシブ課題',
                                'JQ01' => 'jQuery１',
                                'JQ02' => 'jQuery２',
                                'JQ03' => 'jQuery３',
                                'JQ04' => 'jQuery４',
                                'JQ05' => 'jQuery５',
                                'JQ06' => 'jQuery６',
                                'JQ07' => 'jQuery７',
                                'JQ08' => 'jQuery８',
                                'JQ09' => 'jQuery９',
                                'JQ10' => 'jQuery１０',
                                'JQLast' => 'JQ最終課題',
                                'LP01' => 'サイト制作',
                                'Sass01' => 'Sass01',
                                'FAM01' => 'FAM01',
                                'JS01' => 'JS01',
                                'WP01' => 'WP01',
                                'SEO01' => 'SEO01',
                            );

                            // 進捗メタキー（日本語配列じゃなくキー名のみで管理）
                            $progress_keys = array(
                                'div01', 'div02', 'div03', 'div04', 'div05', 'div06', 'div07',
                                'responsive', 'JQ01', 'JQ02', 'JQ03', 'JQ04', 'JQ05', 'JQ06', 'JQ07', 'JQ08', 'JQ09', 'JQ10',
                                'JQLast', 'LP01', 'Sass01', 'FAM01', 'JS01', 'WP01', 'SEO01'
                            );

                            // --- 各ユーザーごとに100%課題をタイムライン配列に格納 ---
                            foreach ($group_users as $user) {
                                $user_id = $user->ID;
                                $user_name = $user->display_name;
                                foreach ($progress_keys as $meta_key) {
                                    $value = get_user_meta($user_id, $meta_key, true);
                                    if ($value == '100') {
                                        $date_meta_key = $meta_key . '_date';
                                        // 未保存の場合のみ日付を保存
                                        if (!get_user_meta($user_id, $date_meta_key, true)) {
                                            $current_time = current_time('mysql');
                                            update_user_meta($user_id, $date_meta_key, $current_time);
                                        }
                                        $completion_date = get_user_meta($user_id, $date_meta_key, true);
                                        if ($completion_date) {
                                            $timeline_items[] = array(
                                                'user_name' => $user_name,
                                                'meta_key' => $meta_key,
                                                'task_name' => isset($task_names[$meta_key]) ? $task_names[$meta_key] : $meta_key,
                                                'user_id' => $user_id,
                                                'completion_date' => $completion_date,
                                                'formatted_date' => date_i18n('n月j日 G:i', strtotime($completion_date)),
                                            );
                                        }
                                    }
                                }
                            }

                            // --- 完了日（降順）で並び替え ---
                            usort($timeline_items, function($a, $b) {
                                return strtotime($b['completion_date']) - strtotime($a['completion_date']);
                            });


                            $count = 0; // ← カウンタ追加
                            // --- タイムライン出力 ---
                            foreach ($timeline_items as $item) {
                                if ($count >= 50) break; // ← 50件でストップ

                                $item_id = $item['user_id'] . '_' . $item['meta_key'];
                                $liked_items = get_user_meta(get_current_user_id(), 'liked_items', true) ?: array();
                                $already_liked_any = in_array($item_id . '_heart', $liked_items) || in_array($item_id . '_hand', $liked_items) || in_array($item_id . '_cat', $liked_items);

                                echo '<div class="timeline-item">';
                                echo '<h3>' . esc_html($item['user_name']) . 'さんが<br>' . esc_html($item['task_name']) . 'を完了しました！</h3>';
                                echo '<div style="font-size:0.9em;color:#888;">' . esc_html($item['formatted_date']) . '</div>';
                                echo '<div class="like-button-wrap">';
                                echo '<button class="like-button heart' . (in_array($item_id . '_heart', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_heart') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">いいね</button>';
                                echo '<button class="like-button hand' . (in_array($item_id . '_hand', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_hand') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">おめでとう</button>';
                                echo '<button class="like-button cat' . (in_array($item_id . '_cat', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_cat') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">負けないよ</button>';
                                echo '</div>';
                                echo '</div>';

                                $count++; // ← カウントアップ
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
                    <div class="C_reaction sp good-jamp timeline-jamp">
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
                            