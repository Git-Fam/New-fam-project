<?php get_header() ;?>

<?php
/*
Template Name:プライバシーポリシーページ
*/
?>

        <!-- privaトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/priva--top.jpg" alt="privaトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>PRIVACYPOLICY<br><span>プライバシーポリシー</span></p>
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
            <div class="priva contact_btn--margin">

                <div class="priva__text">
                    <p><?php echo CFS()->get('privacy_subTitle'); ?></p>
                </div>

                <div class="priva__content">

                    <div class="priva__content--item">
                        <h2 class="priva__content--item--title"><?php echo CFS()->get('privacy_tableTitle_1'); ?></h2>
                        <p class="priva__content--item--text"><?php echo CFS()->get('privacy_tableText_1'); ?></p>
                    </div>

                    <div class="priva__content--item">
                        <h2 class="priva__content--item--title"><?php echo CFS()->get('privacy_tableTitle_2'); ?></h2>
                        <p class="priva__content--item--text"><?php echo CFS()->get('privacy_tableText_2'); ?></p>
                        <ul>
                            <li><?php echo CFS()->get('privacy_tableList2-1'); ?></li>
                            <li><?php echo CFS()->get('privacy_tableList2-2'); ?></li>
                            <li><?php echo CFS()->get('privacy_tableList2-3'); ?></li>
                        </ul>
                    </div>

                    <div class="priva__content--item">
                        <h2 class="priva__content--item--title"><?php echo CFS()->get('privacy_tableTitle_3'); ?></h2>
                        <p class="priva__content--item--text"><?php echo CFS()->get('privacy_tableText_3'); ?></p>
                    </div>

                    <div class="priva__content--item">
                        <h2 class="priva__content--item--title"><?php echo CFS()->get('privacy_tableTitle_4'); ?></h2>
                        <p class="priva__content--item--text"><?php echo CFS()->get('privacy_tableText_4'); ?></p>
                    </div>

                    <div class="priva__content--item">
                        <h2 class="priva__content--item--title"><?php echo CFS()->get('privacy_tableTitle_5'); ?></h2>
                        <p class="priva__content--item--text"><?php echo CFS()->get('privacy_tableText_5'); ?></p>
                        <div class="container">
                            <h2><?php echo CFS()->get('privacy_tableList_5_1'); ?></h2>
                            <p><?php echo CFS()->get('privacy_tableList_5_2'); ?></p>
                            <p><?php echo CFS()->get('privacy_tableList_5_3'); ?></p>
                            <br>
                            <p><?php echo CFS()->get('privacy_tableList_5_4'); ?></p>
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