<?php
function badge_display()
{
    $user_id = get_current_user_id();
    $div_fields = ['div01', 'div02', 'div03', 'div04', 'div05', 'div06', 'div07', 'responsive'];
    $jq_fields = ['JQ01', 'JQ02', 'JQ03', 'JQ04', 'JQ05', 'JQ06', 'JQ07', 'JQ08', 'JQ09', 'JQ10', 'JQLast'];
    $lp_field = 'LP01';
    $all_div_fields_100 = true;
    $all_jq_fields_100 = true;

    // 獲得したバッジ
    $badges = [];

    // LPフィールドの値を取得してチェック
    $lp_value = get_user_meta($user_id, $lp_field, true) ?: '0';
    if ($lp_value == '100') {
        $badges[] = 'lp';
    }

    // JQフィールドの値を取得してチェック
    foreach ($jq_fields as $field) {
        $value = get_user_meta($user_id, $field, true) ?: '0';
        if ($value != '100') {
            $all_jq_fields_100 = false;
            break;
        }
    }

    if ($all_jq_fields_100) {
        $badges[] = 'jq';
    }

    // divフィールドの値を取得してチェック
    foreach ($div_fields as $field) {
        $value = get_user_meta($user_id, $field, true) ?: '0';
        if ($value != '100') {
            $all_div_fields_100 = false;
            break;
        }
    }

    if ($all_div_fields_100) {
          // 全てのdivフィールドが100%の場合にバッジを表示
        $badges[] = 'html';
    }

    // 現在選択中のバッジを取得
    $selected_badge = get_user_meta($user_id, 'selected_badge', true);

    // 獲得したバッジを表示
    foreach ($badges as $badge) {
        $is_selected = ($badge == $selected_badge) ? 'selected' : '';
        echo '<img class="badge ' . $is_selected . '" src="' . get_template_directory_uri() . '/img/badge-' . $badge . '.png" alt="' . $badge . 'バッジ" data-badge="' . $badge . '">';
    }

    // 選択したバッジを保存する処理
    function select_badge_ajax() {
        $user_id = get_current_user_id();
        $input_data = json_decode(file_get_contents('php://input'));

        if (isset($input_data->selected_badge)) {
            $selected_badge = sanitize_text_field($input_data->selected_badge);
            update_user_meta($user_id, 'selected_badge', $selected_badge);
            wp_send_json_success();
        } else {
            wp_send_json_error('No badge selected');
        }
    }
    add_action('wp_ajax_select_badge', 'select_badge_ajax');


    // JavaScriptでクリックイベントを設定
    ?>
    <script>
        document.querySelectorAll('.badge').forEach(function(badge) {
            badge.addEventListener('click', function() {
                const selectedBadge = this.getAttribute('data-badge');

                fetch('/wp-admin/admin-ajax.php?action=select_badge', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ selected_badge: selectedBadge })
                }).then(() => {
                    // 他のバッジの選択を解除し、選択したバッジをハイライト
                    document.querySelectorAll('.badge').forEach(function(b) {
                        b.classList.remove('selected');
                    });
                    this.classList.add('selected');
                });
            });
        });
    </script>
    <?php
}

?>