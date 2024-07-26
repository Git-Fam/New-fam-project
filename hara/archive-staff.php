<?php get_header() ;?>

        <!-- staffトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/staff--top.jpg" alt="staffトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>STAFF<br><span>スタッフ紹介</span></p>
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

            <!-- staff -->
            <div class="staff contact_btn--margin">
                <?php  
                    $args = array(
                    'post_type' => 'staff',
                    'staff-cat' => 'スタッフページ-テキスト', // カテゴリー名を指定
                    );
                ?>
                <div class="staff__text">
                    <?php
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'posts_per_page' => 1,
                            'paged' => $paged,
                            'post_type' => 'staff',
                            'staff-cat' => 'スタッフページ-テキスト', // カテゴリー名を指定
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                    ?>

                    <p><?php echo CFS()->get('staff_text'); ?></p>

                    <?php
                        endwhile; endif;
                        wp_reset_postdata(); // クエリのリセット
                    ?>
                </div>


                <?php  
                    $args = array(
                    'post_type' => 'staff',
                    'staff-cat' => 'staffIntroduction', // カテゴリー名を指定
                    );
                ?>

                <div class="staff__content">
                    <?php
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'posts_per_page' => 999,
                            'paged' => $paged,
                            'post_type' => 'staff',
                            'staff-cat' => 'staffIntroduction', // カテゴリー名を指定
                        );
                        $the_query = new WP_Query($args);

                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                        
                    ?>

                    <div class="staff__content--item">
                        <img src="<?php echo CFS()->get('staff_introduction_img'); ?>" alt="">
                        <div class="staff__content--item--textarea">
                            <div class="title">
                                <p><?php echo CFS()->get('staff_introduction_name'); ?></p>
                            </div>
                            <div class="text">
                                <div class="text--content">
                                    <div class="text--content--working_rep">
                                        <p>勤務地</p>
                                        <p><?php echo CFS()->get('staff_introduction_rep'); ?></p>
                                    </div>
                                    <div class="text--content--working_rep">
                                        <p>役職・担当</p>
                                        <p><?php echo CFS()->get('staff_introduction_job'); ?></p>
                                    </div>
                                </div>
                                <div class="text--message">
                                    <p>メッセージ</p>
                                    <p><?php echo CFS()->get('staff_introduction_message'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        endwhile; endif;
                        wp_reset_postdata(); // クエリのリセット
                    ?>
                    
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

