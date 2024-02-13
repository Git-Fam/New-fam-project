<?php get_header(); ?>
        
        <!-- blog -->
        <div class="blog--wapper">

        <section class="blog--blog">
            <div class="blog--blog--inner">

            <?php 
                if (have_posts()):
                while (have_posts()):
                the_post(); 
            ?>

                    <!-- ループ始まり -->
                    <a href="<?php the_permalink(); ?>" class="blog--item hover-opa">
                        <div class="blog--thumbnail"
                        style="background-image: url(<?php if (has_post_thumbnail()) {
                                the_post_thumbnail_url('large');
                            } else {
                                echo get_template_directory_uri() . '/img/thumbnail.png';
                            } ?>);">

                            <p class="blog--new">New !</p>
                        </div>
                        <div class="blog--content">
                            <p class="blog--new">New !</p>
                            <p class="blog--time"><?php the_time('Y.m.d'); ?></p>
                            <p class="blog--title"><?php the_title(); ?></p>
                        </div>
                    </a>

            <?php 
                endwhile;
                else:
            ?>
                    <!-- 投稿がない場合のメッセージ -->
                    <p class="no-message">まだ投稿がありません。</p>

            <?php
                endif; 
            ?>                    

            </div>

            <div class="page--nation">
                <?php wp_pagenavi();?>
            </div>

        </section>

            
        </div>
        <!-- blog end -->

<?php get_footer(); ?>