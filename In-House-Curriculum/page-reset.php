<?php get_header(); ?>

        <div class="entry">
            <div class="entry--letter"></div>
            <div class="entry--sheet">
                <div class="entry--sheet--title">
                    <h2 class="TL">パスワード再発行</h2>
                </div>
                <div class="entry--sheet--inputs">
                    <?php echo do_shortcode('[swpm_reset_form]'); ?>
                </div>
            </div>
        </div>

<?php get_footer(); ?>