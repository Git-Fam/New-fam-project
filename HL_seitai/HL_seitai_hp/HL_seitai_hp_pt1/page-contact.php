<?php get_header(); ?>
        
        <!-- contact -->
        <div class="contact--wapper">

            <!-- contact--tel -->
            <section class="contact--tel">
                <div class="C-title C-title--JP">
                    <h2>電話でのご予約・お問い合わせ</h2>
                </div>
                <div class="contact--tel--item">
                    <p>
                        ご質問やご相談などお気軽にお問い合わせください。<br>
                        また、ご予約も承っております。お電話またはネット予約にて受付ております。
                    </p>
                </div>
                <div class="contact--tel--content">
                    <h3>完全予約制</h3>
                    <a href="tel:00000000000">052-203-0701</a>
                    <p>
                        電話受付時間：（平日）10:00〜18:00 完全予約制（土・日・祝）10:00〜17:00 休業日：不定休<br>
                        ※施術中は電話に出られないこともございます。

                    </p>
                </div>
                <div class="contact--tel--container">
                    <p>
                        お電話でご予約の方へ<br>
                        下記の3つをお聞きしますので、<br class="sp">あらかじめご用意ください。
                    </p>
                    <p>
                        ①お名前　<br class="sp">②ご予約希望日時　<br class="sp">③ご希望のメニュー
                    </p>
                </div>
            </section>


            <!-- contact--form -->
            <section class="contact--form">
                <a href="#" class="form--to"></a>
                <div class="C-title C-title--JP">
                    <h2>メールフォーム</h2>
                </div>
    
                <div class="contact--form--area">
                    <?php
                        echo do_shortcode('[contact-form-7 id="f246dbf" title="contact"]');
                    ?>
                </div>

            </section>

        </div>
        <!-- contact end -->

<?php get_footer(); ?>