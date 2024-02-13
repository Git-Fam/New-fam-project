<?php get_header(); ?>
        
        <!-- contact-confirmation -->
        <div class="contact--wapper">

            <!-- contact--form -->
            <section class="contact--form">
                <div class="C-title C-title--JP">
                    <h2>メールフォーム</h2>
                </div>
                <div class="contact--form--area">
                    <?php
                        echo do_shortcode('[contact-form-7 id="79e5562" title="confirmation"]');
                    ?>
                </div>
            </section>

        </div>
        <!-- contact end -->

<?php get_footer(); ?>