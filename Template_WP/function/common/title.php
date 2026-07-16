<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});


add_action('wp_head', function () {
    // Yoast SEO が有効なら Yoast の出力に任せる
    if (defined('WPSEO_VERSION')) {
        return;
    }
    $desc = get_bloginfo('description');
    if ($desc) {
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    }
}, 1);