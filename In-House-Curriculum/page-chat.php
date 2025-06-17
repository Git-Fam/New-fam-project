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
                <p class="TL"><a href="<?php echo home_url('/curriculum'); ?>">カリキュラム</a>＞　アクションページ</p>
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

                            // 自動進捗キー生成（グループ内全員分から取得＆ユニーク化）
                            $all_progress_keys = array();
                            foreach ($group_users as $user) {
                                $user_meta = get_user_meta($user->ID);
                                foreach ($user_meta as $meta_key => $meta_value) {
                                    if (preg_match('/^(env|VAL|INIT|div|responsive|JQ|LP|MiniLP|Sass|React|Java|SQL|Design|SEO|Form|FAM|test|JS|wordpress|jstqb)/i', $meta_key)) {
                                        // 末尾が _date のフィールドは除外
                                        if (substr($meta_key, -5) !== '_date') {
                                            $all_progress_keys[] = $meta_key;
                                        }
                                    }
                                }
                            }
                            $progress_keys = array_unique($all_progress_keys);
                            sort($progress_keys);


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
                            
                                            // ここから追加！タグのスラッグが $meta_key の投稿タイトルを取得
                                            $task_post_title = $meta_key;
                                            $task_query = new WP_Query(array(
                                                'posts_per_page' => 1,
                                                'tag' => $meta_key,
                                            ));
                                            if ($task_query->have_posts()) {
                                                $task_query->the_post();
                                                $task_post_title = get_the_title();
                                                wp_reset_postdata();
                                            }
                                            // ここまで追加
                            
                                            $timeline_items[] = array(
                                                'user_name' => $user_name,
                                                'meta_key' => $meta_key,
                                                'task_name' => $task_post_title, // ←ここだけ変わる
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

                            $count = 0;
                            // --- タイムライン出力 ---
                            foreach ($timeline_items as $item) {
                                if ($count >= 50) break;

                                $item_id = $item['user_id'] . '_' . $item['meta_key'];
                                $liked_items = get_user_meta(get_current_user_id(), 'liked_items', true) ?: array();
                                $already_liked_any = in_array($item_id . '_heart', $liked_items) || in_array($item_id . '_hand', $liked_items) || in_array($item_id . '_cat', $liked_items);

                                echo '<div class="timeline-item">';
                                echo '<h3>' . esc_html($item['user_name']) . 'さんが<br>' . esc_html($item['task_name']) . ' を完了しました！</h3>';
                                echo '<div style="font-size:0.9em;color:#888;">' . esc_html($item['formatted_date']) . '</div>';
                                echo '<div class="like-button-wrap">';
                                echo '<button class="like-button heart' . (in_array($item_id . '_heart', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_heart') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">いいね</button>';
                                echo '<button class="like-button hand' . (in_array($item_id . '_hand', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_hand') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">おめでとう</button>';
                                echo '<button class="like-button cat' . (in_array($item_id . '_cat', $liked_items) ? ' liked' : '') . '" data-item-id="' . esc_attr($item_id . '_cat') . '"' . ($already_liked_any ? ' disabled' : '') . '><div class="icon"></div><p class="like-TX">負けないよ</button>';
                                echo '</div>';
                                echo '</div>';

                                $count++;
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
