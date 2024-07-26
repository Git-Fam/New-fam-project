<?php get_header() ;?>

        <!-- photogalleryトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/photogallery--top.jpg" alt="photogalleryトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>PHOTOGALLERY<br><span>スタッフブログ</span></p>
        </div>

        <!-- 追尾ボタン用 -->
        <div class="tracking">

            <!-- お問い合わせボタン -->
            <a href="<?php bloginfo('url'); ?>/contact" class="contact_btn">
                <img src="<?php echo get_template_directory_uri(); ?>/imag/contact-icon.svg" alt="メールアイコン">
                <p>
                    <span>お</span>
                    <span>問</span>
                    <span>い</span>
                    <span>合</span>
                    <span>わ</span>
                    <span>せ</span>
                </p>
            </a>

            <!-- ページトップ -->
            <a href="#" class="page__top">
                <img src="<?php echo get_template_directory_uri(); ?>/imag/page--top.svg" alt="ページトップ">
            </a>

            <!-- photogallery -->
            <div class="photogallery contact_btn--margin">

            <div class="photogallery__item">

                <?php  
                    $args = array(
                    'post_type' => 'photogallery',
                    );
                    $the_query = new WP_Query($args); if ($the_query->have_posts()): 
                ?>

                <div class="photogallery__item__section">
                    <?php
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'posts_per_page' => 15,
                            'paged' => $paged,
                            'post_type' => 'photogallery',
                        );
                        $the_query = new WP_Query($args);
                        
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                            // アイキャッチ画像のURLを取得
                            $thumbnail_url = get_the_post_thumbnail_url();
                    ?>

                            <a href="<?php the_permalink(); ?>" class="photogallery__item" style="background-image: url('<?php echo $thumbnail_url; ?>');">
                                <p>
                                    <?php the_title(); ?>
                                </p>
                            </a>

                    <?php
                        endwhile; endif;
                        wp_reset_postdata(); // クエリのリセット
                    ?>
                </div>


                <!-- ページネーション -->
                <div class="photogallery__item__next">
                    <?php 
                        wp_pagenavi(); 
                    ?>
                </div>

                <?php else: ?>
                <p>まだ投稿がありません。</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

                </div>


            </div>

            <!-- リンクボタンエリア -->
            <div class="btn__area">
                <div class="btn__area__links">
                    <a href="<?php bloginfo('url'); ?>/company">
                        <p>COMPANY</p>
                        <p>会社案内</p>
                    </a>
                    <a href="<?php bloginfo('url'); ?>/safety">
                        <p>SAFETY</p>
                        <p>安全・環境への取り組み</p>
                    </a>
                    <a href="<?php bloginfo('url'); ?>/staff">
                        <p>STAFF</p>
                        <p>スタッフ紹介</p>
                    </a>
                </div>
            </div>

        </div>
        
<?php get_footer() ;?>