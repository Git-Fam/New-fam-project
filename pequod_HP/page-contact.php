<?php get_header(); ?>
<div class="page-contact">
    <section class="Contact_Title">
        <div class="C_ContactTitle">
            <div class="C_TL type02 light">
                <p class="C_TL_deco">
                    <span class="js-g01">c</span>
                    <span class="js-g01">o</span>
                    <span class="js-g01">n</span>
                    <span class="js-g01">t</span>
                    <span class="js-g01">a</span>
                    <span class="js-g01">c</span>
                    <span class="js-g01">t</span>
                    <span class="js-g01">&nbsp;</span>
                    <span class="js-g01">f</span>
                    <span class="js-g01">o</span>
                    <span class="js-g01">r</span>
                    <span class="js-g01">m</span>
                </p>
                <h3 class="C_TL_main">
                    <span class="js-g01">お</span>
                    <span class="js-g01">問</span>
                    <span class="js-g01">合</span>
                    <span class="js-g01">せ</span>
                    <span class="js-g01">フ</span>
                    <span class="js-g01">ォ</span>
                    <span class="js-g01">ー</span>
                    <span class="js-g01">ム</span>
                </h3>
            </div>
            <div class="content">
                <div class="content--text">
                    <p class="TX">
                        この度はpequodにご興味を持ってくださいまして、誠にありがとうございます。<br>
                        ご不明点・ご相談は、お気軽にお問い合わせください。<br>
                        ご返信は3営業日以内を目途にさせて頂きます。
                    </p>
                </div>
                <div class="content--text">
                    <p class="TX">
                        ※alwaterのお問い合わせにつきましては、当サイトからは受付しておりません。<br>
                        下記公式サイトまでお問い合わせいただきますよう、お願い致します。
                    </p>
                    <a class="hover-opa" href="https://alwater.jp/" target="_blank" rel="noopener noreferrer">https://alwater.jp/</a>
                </div>
            </div>
        </div>
    </section>
    <section class="Contact_Tab">
        <div class="C_ContactTab">
            <div class="C_ContactTab__Buttons">
                <div class="BTN active">
                    <p class="TX">お問い合わせ</p>
                </div>
                <div class="BTN">
                    <p class="TX">エントリーフォーム</p>
                </div>
            </div>
            <div class="C_ContactTab__former">
                <!-- 問い合わせ -->
                <div class="former active">
                    <div class="C_Form">
                        <?php
                            echo do_shortcode('[contact-form-7 id="7ed9ac7" title="Contact"]');
                        ?>
                    </div>
                </div>
                <!-- エントリー -->
                <div class="former">
                    <div class="C_Form">
                        <?php
                        echo do_shortcode('[contact-form-7 id="c575f5d" title="Contact-Entry"]');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>