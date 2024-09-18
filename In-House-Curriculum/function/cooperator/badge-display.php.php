<?php
// function badge_display()
// {
//     $user_id = get_current_user_id();
//     $div_fields = ['div01', 'div02', 'div03', 'div04', 'div05', 'div06', 'div07', 'responsive'];
//     $jq_fields = ['JQ01', 'JQ02', 'JQ03', 'JQ04', 'JQ05', 'JQ06', 'JQ07', 'JQ08', 'JQ09', 'JQ10', 'JQLast'];
//     $lp_field = 'LP01';
//     $all_div_fields_100 = true;
//     $all_jq_fields_100 = true;

    // LPフィールドの値を取得してチェック
    // $lp_value = get_user_meta($user_id, $lp_field, true) ?: '0';
    // if ($lp_value == '100') {
        // LPフィールドが100%の場合にバッジを表示
?>
        <!-- <img class="badge" src="<?php echo get_template_directory_uri(); ?>/img/badge-lp.png" alt="バッジ"> -->
<?php
    //     return;
    // }

    // JQフィールドの値を取得してチェック
    // foreach ($jq_fields as $field) {
    //     $value = get_user_meta($user_id, $field, true) ?: '0';
    //     if ($value != '100') {
    //         $all_jq_fields_100 = false;
    //         break;
    //     }
    // }

    // if ($all_jq_fields_100) {
        // 全てのJQフィールドが100%の場合にバッジを表示
?>
        <!-- <img class="badge" src="<?php echo get_template_directory_uri(); ?>/img/badge-jq.png" alt="バッジ"> -->
<?php
    //     return;
    // }

    // divフィールドの値を取得してチェック
    // foreach ($div_fields as $field) {
    //     $value = get_user_meta($user_id, $field, true) ?: '0';
    //     if ($value != '100') {
    //         $all_div_fields_100 = false;
    //         break;
    //     }
    // }

    // if ($all_div_fields_100) {
        // 全てのdivフィールドが100%の場合にバッジを表示
?>
        <img class="badge" src="<?php echo get_template_directory_uri(); ?>/img/badge-html.png" alt="バッジ">
<?php
    //     return;
    // }

    // それ以外の場合にバッジを表示
?>
    <!-- <img class="badge" src="<?php echo get_template_directory_uri(); ?>/img/badge-beginner.png" alt="バッジ"> -->
<?php
// }
?>