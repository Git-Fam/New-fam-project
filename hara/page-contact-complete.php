<?php get_header() ;?>

        <!-- contact-completeトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/contact--top.jpg" alt="contact-completeトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>CONTACT<br><span>送信完了</span></p>
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

            <!-- contact-complete -->
            <div class="contact-complete contact_btn--margin">
                <div class="contact-complete__text">
                    <p>送信を完了致しました。</p>
                    <p>この度はお問い合わせいただきまして<br class="sp">誠にありがとうございます。<br>
                        ご入力頂いたメールアドレス宛へ、<br class="sp">ご確認メールをお送りしておりますのでご確認ください。<br>
                        内容を確認次第、担当者より折返し<br class="sp">ご連絡させていただきます。</p>
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