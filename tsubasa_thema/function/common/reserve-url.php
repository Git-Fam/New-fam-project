<?php

// 予約のURL一覧。全テンプレートかから get_reserve_url() で参照できる。
function get_reserve_url($key = null)
{
    $reserve_url = [
        // ウェブ予約
        'web_reservation' => '#',
        // 問診票
        'questionnaire' => '#',
    ];

    if ($key === null) {
        return $reserve_url;
    }

    return isset($reserve_url[$key]) ? $reserve_url[$key] : '';
}
