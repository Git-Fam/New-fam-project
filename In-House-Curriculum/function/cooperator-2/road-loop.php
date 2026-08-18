<?php
function generate_destination_item($post_id) {
    // タグをクラス化
    $post_tags = get_the_tags($post_id);
    $tag_classes = '';
  
    // === storyタグが含まれていたら何も出力しない ===
    if ($post_tags && !is_wp_error($post_tags)) {
        foreach ($post_tags as $tag) {
            if ($tag->slug === 'story') {
                return ''; // 何も出力しない
            }
        }
  
        $tag_slugs = array_map(function ($tag) {
            $tag_slug = esc_attr($tag->slug);
            return preg_replace('/[^a-zA-Z0-9_-]/', '_', $tag_slug);
        }, $post_tags);
        $tag_classes = implode(' ', $tag_slugs);
    }
  
    if (empty($tag_classes)) {
        $tag_classes = 'no-tags';
    }
  
    // トリガー用クラスの判定（任意で組み込み）
    $is_trigger = get_post_meta($post_id, '_is_lost_item_trigger', true);
    $trigger_class = $is_trigger ? 'lost-trigger' : '';
  
    // スラッグ
    $slug = get_post_field('post_name', $post_id);
    $decoded_slug = urldecode($slug);
  
    // 出力
    ob_start();
    ?>
    <div class="destination <?php echo esc_attr($tag_classes . ' ' . $trigger_class); ?>">
        <a class="goal-wrap" href="<?php echo esc_url(add_query_arg('post_id', $post_id, site_url('/cover'))); ?>">
            <div class="goal hover-scale"></div>
            <div class="goal-bg"></div>
            <div class="title-board">
                <p class="board-TX"><?php echo esc_html($decoded_slug); ?></p>
            </div>
        </a>
    </div>
    <?php
    return ob_get_clean();
  }
  