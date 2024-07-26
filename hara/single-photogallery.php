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

            <!-- お知らせブログ -->
            <div class="news contact_btn--margin">

                <div class="news__section">

                    		
                    <?php if(have_posts()) : while(have_posts()) : the_post();?><!-- ループ開始 -->
								
								
                                <h2><?php the_title();?></h2>
                                <h3><?php the_date('Y.m.d') ;?></h3>
                                <h4><?php the_content(); ?></h4>
                            
                            
                    <?php endwhile; endif; ?><!-- ループ終わり -->


                    <!-- 記事自体の次へ、前へ -->
                    <div class="single-nation">
                        
                                <div class="single-next">
                                    <?php if (get_next_post()):?>
                                    <?php next_post_link('%link', '次の記事へ'); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="single-back">
                                    <a href="<?php bloginfo('url') ;?>/photogallery">戻る</a>
                                </div>
                                
                                <div class="single-previous">
                                    <?php if (get_previous_post()):?>
                                    <?php previous_post_link('%link', '前の記事へ'); ?>
                                    <?php endif; ?>
                                </div>

                    </div>

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