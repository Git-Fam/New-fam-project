<?php get_header() ;?>

        <!-- ニューストップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/news--top.jpg" alt="ニュースートップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>NEWS<br><span>お知らせ</span></p>
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

                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <!-- ループ開始 -->
                    <div class="news__section__contents">
                        <a href="<?php the_permalink(); ?>">
                            <p><?php the_time('Y.m.d'); ?></p>
                            <p><?php the_title(); ?></p>
                        </a>
                  
                    </div>
                <?php endwhile; endif; ?>
                <!-- ループ終わり -->

                <!-- ページネーション -->
                    <div class="next">
                        <?php 
                            wp_pagenavi(); 
                        ?>
                    </div>
                <!-- 投稿がない場合は投稿がありませんと表示 -->
                <?php if(!have_posts()): ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>


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