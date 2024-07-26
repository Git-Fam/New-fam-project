<?php get_header() ;?>

        <!-- contactトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/contact--top.jpg" alt="contactトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>CONTACT<br><span>お問い合わせ内容確認</span></p>
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

            <!-- contact-confirmation -->
            <div class="contact-confirmation contact_btn--margin">

                <div class="contact-confirmation__text">
                    <p>ご入力内容の確認</p>
                    <p>
                        まだ送信は完了していません。<br>
                        入力内容をご確認の上「送信」ボタンを押してください。<br>
                        内容に不備がある場合は「戻る」ボタンを<br class="sp">押して修正してください。
                    </p>
                </div>

                <div class="contact__main">

                       <?php
                            echo apply_shortcodes('[contact-form-7 id="b74cd5d" title="contact-confirm"]');
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