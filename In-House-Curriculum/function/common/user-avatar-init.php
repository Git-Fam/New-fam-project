<?php
// 新規ユーザーの初期アバター付与

add_action('user_register', 'ihc_init_user_avatar');

function ihc_init_user_avatar($user_id)
{
    $owned = get_user_meta($user_id, 'owned_avatars', true);

    if ($owned === '' || $owned === null) {
        update_user_meta(
            $user_id,
            'owned_avatars',
            wp_json_encode(['normal-7547'], JSON_UNESCAPED_UNICODE)
        );
    }
}