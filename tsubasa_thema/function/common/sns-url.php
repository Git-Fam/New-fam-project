<?php

// SNSのURL一覧。全テンプレートから get_sns_url() で参照できる。
function get_sns_url($key = null)
{
    $sns_url = [
        'instagram' => '#',
    ];

    if ($key === null) {
        return $sns_url;
    }

    return isset($sns_url[$key]) ? $sns_url[$key] : '';
}
