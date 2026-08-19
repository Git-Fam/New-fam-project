<?php

// お知らせアーカイブ(/news/)のSEOタイトル・メタディスクリプションを、
// 指定した固定ページのYoast設定から流用する。
//
// 【使い方】
// 1. 固定ページを1つ作成（スラッグは下記 NEWS_SEO_PAGE_SLUG と一致させる）
//    ※ スラッグを 'news' にしないこと（/news/ アーカイブと競合するため）
// 2. その固定ページのYoastボックスで「SEOタイトル」「メタディスクリプション」を設定
// 3. /news/ アーカイブにその値が反映される

if (!defined('NEWS_SEO_PAGE_SLUG')) {
    define('NEWS_SEO_PAGE_SLUG', 'news-seo');
}

// お知らせアーカイブ(/news/)かどうか
function is_news_archive()
{
    return is_post_type_archive('post');
}

// 元ネタ固定ページのYoastメタ値を取得（変数展開込み）
function get_news_seo_meta($meta_key)
{
    if (!is_news_archive()) {
        return '';
    }
    $page = get_page_by_path(NEWS_SEO_PAGE_SLUG);
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
    $custom = get_news_seo_meta('_yoast_wpseo_title');
    return $custom !== '' ? $custom : $title;
});

// メタディスクリプションを差し替え
add_filter('wpseo_metadesc', function ($desc) {
    $custom = get_news_seo_meta('_yoast_wpseo_metadesc');
    return $custom !== '' ? $custom : $desc;
});
