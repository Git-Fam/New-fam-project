<?php
function display_priority_ticket()
{
    $user_id = get_current_user_id();
    $priority_ticket = get_user_meta($user_id, 'priority_ticket', true) ?: 0;

    if ($priority_ticket > 0) {
?>
        <div class="coin-point">
            <p class="TX">優先チケット:
                <span>
                    <?php echo esc_html($priority_ticket); ?>&nbsp;枚
                </span>
            </p>
        </div>
<?php
    }
}
?>