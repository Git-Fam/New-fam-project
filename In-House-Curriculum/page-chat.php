<?php get_header(); ?>
        <div class="page-wappaer">
            <section id="page-01" class="page">
                <div class="inner">
                    <div class="page-content">

                    <?php if (function_exists('simple_ajax_chat')) simple_ajax_chat(); ?>

                    </div>    
                </div>
            </section>    
        </div>
<?php get_footer(); ?>