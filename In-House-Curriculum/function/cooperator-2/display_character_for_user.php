<?php

function display_character_for_user($user_id)
{
    // $user_idを使って、display_character()の中身をほぼコピペ
    // ※ get_current_user_id()は使わない（引数で来るので）

    $selected_character = get_user_meta($user_id, 'selected_avatar', true);
    $selected_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];

    // デフォルトアバターの設定
    if (empty($selected_character)) {
        $owned_avatars = json_decode(get_user_meta($user_id, 'owned_avatars', true), true) ?: [];
        if (!empty($owned_avatars)) {
            $selected_character = $owned_avatars[0];
        } else {
            $selected_character = 'normal-7547';
        }
    }

    $selected_character_thumbnail = get_template_directory_uri() . '/img/avatar-img/avatar01.webp';
    $selected_character_aspect_ratio = '';
    $selected_character_style = '';

    if (!empty($selected_character)) {
        $selected_character_parts = explode('-', $selected_character);
        $selected_character_id = end($selected_character_parts);
        $selected_character_thumbnail = get_the_post_thumbnail_url($selected_character_id, 'full') ?: $selected_character_thumbnail;
        $selected_character_aspect_ratio = get_post_meta($selected_character_id, '_avatar_aspect_ratio', true);
        $selected_character_style = get_post_meta($selected_character_id, '_avatar_style', true);
    }

    $display_items = [];
    $item_categories = get_terms(array(
        'taxonomy' => 'item-cat',
        'hide_empty' => false,
    ));

    if (is_array($item_categories) && !empty($item_categories)) {
        foreach ($item_categories as $category) {
            $category_slug = '';
            if (is_object($category) && isset($category->slug)) {
                $category_slug = $category->slug;
            } elseif (is_array($category) && isset($category['slug'])) {
                $category_slug = $category['slug'];
            } else {
                continue;
            }
            $item_value = '';
            if (isset($selected_items[$category_slug])) {
                $item_value = $selected_items[$category_slug];
            }
            if (!empty($item_value)) {
                $item_parts = explode('-', $item_value);
                $item_id = end($item_parts);

                $item_data = array(
                    'thumbnail' => get_the_post_thumbnail_url($item_id, 'full'),
                    'aspect_ratio' => get_post_meta($item_id, '_item_aspect_ratio', true),
                    'category' => $category_slug
                );

                if (!empty($selected_character)) {
                    $avatar_item_styles = get_post_meta($selected_character_id, '_avatar_item_styles', true);
                    if (is_array($avatar_item_styles) && isset($avatar_item_styles[$item_id])) {
                        $item_data['custom_style'] = $avatar_item_styles[$item_id];
                    }
                }

                $display_items[] = $item_data;
            }
        }
    }
    ?>

    <div class="display__character">
        <!-- キャラクター -->
        <img class="selected_items-character-character"
            src="<?php echo esc_url($selected_character_thumbnail); ?>"
            <?php if (!empty($selected_character_aspect_ratio)): ?>
            style="aspect-ratio: <?php echo esc_attr($selected_character_aspect_ratio); ?>; <?php echo esc_attr($selected_character_style); ?>"
            <?php endif; ?>>

        <!-- アイテム -->
        <?php foreach ($display_items as $item): ?>
            <img class="selected_items-item selected_items-<?php echo esc_attr($item['category']); ?>"
                src="<?php echo esc_url($item['thumbnail']); ?>"
                <?php if (!empty($item['aspect_ratio'])): ?>
                style="aspect-ratio: <?php echo esc_attr($item['aspect_ratio']); ?>; <?php echo esc_attr($item['custom_style'] ?? ''); ?>"
                <?php endif; ?>>
        <?php endforeach; ?>
    </div>

    <?php
}

?>