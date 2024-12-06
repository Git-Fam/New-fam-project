<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<div class="entry">
    <div class="entry--letter"></div>
    <div class="entry--sheet">
        <?php if (is_user_logged_in()): ?>
            <div class="entry--sheet--title">
                <h2 class="TL">有料申し込み</h2>
            </div>
            <div class="entry--sheet--inputs">
                <?php
                echo do_shortcode('[swpm_payment_button id="61"]');
                ?>
            </div>
        <?php else: ?>
            <p>ログインしていません。</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>