<?php
// バッジを表示する関数
function badge_display() {
    $user_id = get_current_user_id();
    $div_fields = ['div01', 'div02', 'div03', 'div04', 'div05', 'div06', 'div07', 'responsive'];
    $jq_fields = ['JQ01', 'JQ02', 'JQ03', 'JQ04', 'JQ05', 'JQ06', 'JQ07', 'JQ08', 'JQ09', 'JQ10', 'JQLast'];
    $lp_field = 'LP01';
    $all_div_fields_100 = true;
    $all_jq_fields_100 = true;
    
    // LPフィールドの値を取得してチェック
    $lp_value = get_user_meta($user_id, $lp_field, true) ?: '0';
    
    // 選択したバッジのメタ情報を取得
    $selected_badge = get_user_meta($user_id, 'selected_badge', true) ?: 'beginner';
    
    // デフォルトは初心者バッジ
    $badge_src = 'badge-beginner.png';
    
    // LPフィールドが100%の場合のバッジ表示
    if ($lp_value == '100') {
        $badge_src = 'badge-lp.png';
    }
    
    // JQフィールドの値を取得してチェック
    foreach ($jq_fields as $field) {
        $value = get_user_meta($user_id, $field, true) ?: '0';
        if ($value != '100') {
            $all_jq_fields_100 = false;
            break;
        }
    }

    // 全てのJQフィールドが100%の場合
    if ($all_jq_fields_100) {
        $badge_src = 'badge-jq.png';
    }

    // divフィールドの値を取得してチェック
    foreach ($div_fields as $field) {
        $value = get_user_meta($user_id, $field, true) ?: '0';
        if ($value != '100') {
            $all_div_fields_100 = false;
            break;
        }
    }

    // 全てのdivフィールドが100%の場合
    if ($all_div_fields_100) {
        $badge_src = 'badge-html.png';
    }

    // ユーザーが選択したバッジがあればそれを使用
    if ($selected_badge) {
        $badge_src = "badge-$selected_badge.png";
    }

    // バッジを表示
?>
    <img class="badge" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $badge_src; ?>" alt="バッジ" onclick="openBadgeSelector()" />
<?php
}
?>
