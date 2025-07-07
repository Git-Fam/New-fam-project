<?php
// =========================
// クイズ設定（投稿画面）
// =========================

// 「クイズあり」チェックボックスを投稿画面に追加
function add_quiz_checkbox_meta_box()
{
    add_meta_box(
        'quiz_checkbox',
        'クイズ設定',
        function ($post) {
            $value = get_post_meta($post->ID, '_has_quiz', true);
            wp_nonce_field('quiz_checkbox_nonce_action', 'quiz_checkbox_nonce_name');
            echo '<label><input type="checkbox" name="has_quiz" value="1"' . checked($value, '1', false) . '> クイズあり</label>';
        },
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'add_quiz_checkbox_meta_box');

// チェックボックスの保存処理
function save_quiz_checkbox_meta($post_id)
{
    if (
        !isset($_POST['quiz_checkbox_nonce_name']) ||
        !wp_verify_nonce($_POST['quiz_checkbox_nonce_name'], 'quiz_checkbox_nonce_action')
    ) return;

    update_post_meta($post_id, '_has_quiz', isset($_POST['has_quiz']) ? '1' : '');
}
add_action('save_post', 'save_quiz_checkbox_meta');


// =========================
// Ajax: 進捗を100に更新
// =========================

function ajax_set_progress_100()
{
    if (!is_user_logged_in()) wp_send_json_error('ログインしていません');

    $user_id = get_current_user_id();
    $tag_slug = sanitize_text_field($_POST['tag_slug']);

    // 進捗保存
    update_user_meta($user_id, $tag_slug, 100);
    update_user_meta($user_id, 'last_progress_key', $tag_slug);

    // 紙吹雪フラグ
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['confetti_show'] = 1;

    wp_send_json_success('進捗を100にしました');
}
add_action('wp_ajax_set_progress_100', 'ajax_set_progress_100');



function enqueue_custom_progress_script()
{
    wp_enqueue_script(
        'single-script',
        get_template_directory_uri() . '/js/single.js',
        [],
        null,
        true
    );
    
    wp_localize_script('single-script', 'ajax_data', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_progress_script');
