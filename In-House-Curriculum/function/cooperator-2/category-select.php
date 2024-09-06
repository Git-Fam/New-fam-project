<?php
//質問の際にどのカテゴリーに投稿するか選択する
function enqueue_custom_scripts() {
    // 外部JavaScriptファイルを読み込む
    wp_enqueue_script('comment-handler', get_template_directory_uri() . '/js/cooperatorScript.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

