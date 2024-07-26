<?php get_header() ;?>


        <!-- ビデオバック -->
        <div class="video--background">
            <video class="pc" id="video" playsinline autoplay muted loop >
                <source src="<?php echo get_template_directory_uri(); ?>/imag/fv_mov.mp4" type="video/mp4">
            </video>  
            <video class="sp" id="video" playsinline autoplay muted loop >
                <source src="<?php echo get_template_directory_uri(); ?>/imag/fv_mov-sp.mp4" type="video/mp4">
            </video>  
        </div>

        <!-- index--FV -->
        <div class="index--FV">
            <h1>大切なものを、<br class="sp">大切なあなたへ</h1>
            <p>HARA</p>

            <!-- ON OFF ボタン -->
            <!-- <div class="on-off" id="on-off">音声をonにする</div> -->
            <a class="YouTube" href="#" target="_blank" rel="noopener noreferrer"></a>
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

            <!-- ABOUT US -->
            <div class="aboutoUS contact_btn--margin">
                <div class="aboutoUS__br"></div>
                <div class="aboutoUS__title">
                    <p>ABOUT US</p>
                    <p>原商事運輸株式会社</p>
                </div>
                <div class="aboutoUS__text">
                    <p>
                        <?php echo CFS()->get('front-aboutUS'); ?>
                        埼玉・川口にて創業50年。<br class="sp">お客様に満足いただける運送を行って参りました。<br>お客様のご要望やプランに最適な配送サービスを<br class="sp">ご提供いたします。<br>徹底した従業員教育のもと、運転、荷扱、マナー等の<br class="sp">サービス品質向上に日々努めております。
                    </p>
                </div>
                <div class="aboutoUS__br"></div>

                <div class="aboutoUS__page--link">

                    <div class="aboutoUS__page--link__contents">
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--company.jpg" alt="原商事会社ロゴ">
                        <div class="aboutoUS__page--link__contents__text">
                            <h2>COMPANY</h2>
                            <h3>会社概要</h3>
                            <p>
                                原商事運輸は物流を通じてお客様に満足・信頼していただき、<br class="pc">
                                さらに社会にも貢献できるように発展してまいりました。<br class="pc">
                                今後も安全・迅速・確実にお届けできるように精進してまいります。

                            </p>
                            <a href="<?php bloginfo('url'); ?>/company" class="more--btn">
                                <p>MORE</p>
                                <div class="page--link__more--br"></div>
                            </a>
                        </div>
                    </div>

                    <div class="aboutoUS__page--link__contents">
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--activity.jpg" alt="原商事で行われる講習会">
                        <div class="aboutoUS__page--link__contents__text">
                            <h2>ACTIVITY</h2>
                            <h3>安全・環境への取り組み</h3>
                            <p>
                                人にも環境にも優しい運送会社を<br class="sp">目指しております。
                            </p>
                            <a href="<?php bloginfo('url'); ?>/safety" class="more--btn">
                                <p>MORE</p>
                                <div class="page--link__more--br"></div>
                            </a>
                        </div>
                    </div>

                    <div class="aboutoUS__page--link__contents">
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--staff.jpg" alt="原商事のスタッフたち">
                        <div class="aboutoUS__page--link__contents__text">
                            <h2>STAFF</h2>
                            <h3>スタッフ紹介</h3>
                            <p>スタッフのメッセージを紹介しております。
                            </p>

                            <a href="<?php bloginfo('url'); ?>/staff" class="more--btn">
                                <p>MORE</p>
                                <div class="page--link__more--br"></div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- SERVICE -->
            <div class="service">
                <div class="service__title">
                    <p>SERVICE</p>
                    <p>お客様のご要望やプランに最適な<br class="sp">配送サービスをご提供いたします。</p>
                </div>
                <div class="service__section">
                    <div class="service__contents">
                        <p>チャーター便</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--service1.jpg" alt="原商事のトラック運転手">
                        <p>小口荷物配送、<br>
                            一般貨物配送を<br>
                            中心とした運送業務</p>
                        <a href="<?php bloginfo('url'); ?>/service/#driver__title"  class="more--btn">
                            <p>MORE</p>
                            <div class="page--link__more--br"></div>
                        </a>
                    </div>
                    <div class="service__contents">
                        <p>共同配送・斡旋業務</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--service2.jpg" alt="積み上がった段ボール">
                        <p>関東を中心として<br>
                            日本全国に配送<br>
                            さまざまな商品に<br>
                            幅広く対応中</p>
                        <a href="<?php bloginfo('url'); ?>/service/#area__title"  class="more--btn">
                            <p>MORE</p>
                            <div class="page--link__more--br"></div>
                        </a>
                    </div>
                    <div class="service__contents">
                        <p>車両案内</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/index--service3.jpg" alt="並んでいる原商事のトラック">
                        <p>ニーズに合わせた<br class="sp">車両をご用意し対応</p>
                        <a href="<?php bloginfo('url'); ?>/trac"  class="more--btn">
                            <p>MORE</p>
                            <div class="page--link__more--br"></div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Photogallery -->
            <div class="photogallery">
                <div class="photogallery__title">
                    <img src="<?php echo get_template_directory_uri(); ?>/imag/index--photogallery1.svg" alt="トラックのイラスト">
                    <div class="photogallery__title__text">
                        <p>PHOTOGALLERY</p>
                        <p>フォトギャラリー/ブログ</p>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/imag/index--photogallery2.svg" alt="トラックのイラスト">
                </div>


                <!-- ブログ -->
                <?php  
                        $args = array(
                        'post_type' => 'photogallery',
                        );
                        $the_query = new WP_Query($args); if ($the_query->have_posts()): 
                    ?>
                <div class="photogallery__contents">

                <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                            $args = array(
                                'posts_per_page' => 6,
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


                    <?php else: ?>
                    <p>まだ投稿がありません。</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>


            </div>

            <!-- ドライバー募集 -->
            <div class="driver--recruitment">
                <img class="pc" src="<?php echo get_template_directory_uri(); ?>/imag/index--driver--recruitment.jpg" alt="ドライバー大募集">
                <img class="sp" src="<?php echo get_template_directory_uri(); ?>/imag/index--driver--recruitment--sp.jpg" alt="ドライバー大募集">
                <a href="<?php bloginfo('url'); ?>/recruit"  class="more--btn">
                    <p>MORE</p>
                    <div class="page--link__more--br"></div>
                </a>
            </div>

            <!-- Access-->
            <div class="access">
                <div class="access__title">
                    <p>ACCESS</p>
                    <p>アクセス</p>
                </div>
                <div class="access__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d447.15217455083575!2d139.72011365456495!3d35.82049872004964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018949b14468885%3A0x79f46a6ea7b3e74e!2z5Y6f5ZWG5LqL6YGL6Ly444ix!5e0!3m2!1sja!2sjp!4v1692601378885!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="access__address">
                        <p>本社営業所</p>
                        <p>〒332-0031 <br class="pc">埼玉県川口市青木5-8-10</p>
                        <p>【アクセス】<br>JR京浜東北線「西川口駅」より車で約6分</p>
                    </div>
                </div>  
                 <div class="access__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1034.878319646186!2d139.90463424291144!3d35.93867110916212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601898f1fa6eadb5%3A0x966f7bfe85835127!2z44CSMjc4LTAwMTYg5Y2D6JGJ55yM6YeO55Sw5biC5LqM44OE5aGa77yR77yZ77yS4oiS77yX!5e0!3m2!1sja!2sjp!4v1692602286980!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="access__address">
                        <p>野田営業所</p>
                        <p>〒278-0016 <br class="pc">千葉県野田市二ツ塚192-7</p>
                        <p>【アクセス】<br>東武野田線「梅郷駅」より車で約7分</p>
                    </div>
                </div>
                <a href="https://bs-hara.com/" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_template_directory_uri(); ?>/imag/index--access.jpg" alt="原商事バナー">
                </a>
            </div>
        </div>

        <?php get_footer() ;?>