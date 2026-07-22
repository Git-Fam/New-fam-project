<?php

// Smart Custom Fields のオプションページ「サイト共通設定」を
// WP管理画面の左メニューに追加する。
// ここに SCF で instagram / web_reservation / questionnaire などの
// URLフィールドを紐付けて編集できるようにする。
//
// ※ フロント側でも get_option_meta() を使えるように、
//    admin_menu フック内ではなく読み込み時に直接登録している。
if (class_exists('SCF')) {
    SCF::add_options_page(
        'サイト共通設定',        // ページタイトル
        'サイト共通設定',        // メニュー名（左メニュー表示）
        'edit_pages',            // 権限（管理者＋編集者）
        'site-settings',         // メニュースラッグ（取得時のキー）
        'dashicons-admin-links', // メニューアイコン
        77                       // 表示位置
    );
}
