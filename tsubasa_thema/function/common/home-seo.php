<?php

// フロントページ(トップ)のSEOタイトル・メタディスクリプションを、
// 指定した固定ページのYoast設定から流用する。
//
// 【使い方】
// 1. 固定ページを1つ作成（スラッグは下記 HOME_SEO_PAGE_SLUG と一致させる）
// 2. その固定ページのYoastボックスで「SEOタイトル」「メタディスクリプション」を設定
// 3. トップページにその値が反映される

if (!defined('HOME_SEO_PAGE_SLUG')) {
    define('HOME_SEO_PAGE_SLUG', 'home-seo');
}

// 元ネタ固定ページのYoastメタ値を取得（変数展開込み）
function get_home_seo_meta($meta_key)
{
    if (!is_front_page()) {
        return '';
    }
    $page = get_page_by_path(HOME_SEO_PAGE_SLUG);
    if (!$page) {
        return '';
    }
    $value = get_post_meta($page->ID, $meta_key, true);
    if (empty($value)) {
        return '';
    }
    // %%sitename%% などのYoast変数を展開
    if (function_exists('wpseo_replace_vars')) {
        $value = wpseo_replace_vars($value, get_post($page->ID));
    }
    return $value;
}

// SEOタイトルを差し替え
add_filter('wpseo_title', function ($title) {
    $custom = get_home_seo_meta('_yoast_wpseo_title');
    return $custom !== '' ? $custom : $title;
});

// メタディスクリプションを差し替え
add_filter('wpseo_metadesc', function ($desc) {
    $custom = get_home_seo_meta('_yoast_wpseo_metadesc');
    return $custom !== '' ? $custom : $desc;
});
