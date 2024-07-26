<?php get_header() ;?>

<?php
/*
Template Name:カンパニーページ
*/
?>

        <!-- カンパニートップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/company--top.jpg" alt="カンパニートップバック">
        </div>

        <!-- カンパニー--FV -->
        <div class="FV__background__text">
            <p>COMPANY<br><span>会社案内</span></p>
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

            <!-- メッセージ -->
            <div class="company contact_btn--margin">
                <div class="company__title">
                    <p>MESSAGE</p>
                    <p>代表挨拶</p>
                </div>

                <div class="company__img--text">
                    <img src="<?php echo get_template_directory_uri(); ?>/imag/company--message.jpg" alt="原商事運送株式会社代表　原 健二">
                    <p>
                        <!-- 原商事運輸ホームページにお越し下さいまして誠にありがとうございます。<br class="pc">
                        今日までの原商事運輸が歩んできた道は決して平坦なものではなく、
                        多くの困難も直面してまいりましたが、平成29年度にて創業50周年を
                        迎えることとなりました。<br  class="sp">これもひとえに皆様に支えられたからこそ
                        <br class="sp">今日の私たちがあるのだと思います。<br>
                        私たちは単純に荷物を運ぶだけではなく、その人の想いをプラスアルファー
                        して送り主に届ける。<br class="sp">それには、何よりも「笑顔や丁寧な言葉遣い」や<br class="sp">気配りのできるパーソナリティが必要になります。<br>
                        心待ちにしていた荷物もお届けしたドライバーが笑顔もなく、
                        失礼な言葉遣いでは、せっかくの商品や荷物も台無しです。<br>
                        これからも、原商事運輸は笑顔を受け取り笑顔を届け「スマイルファースト」
                        を常に心がけたいと思います。多くのお客様の温かいご支援、
                        関係各社様の手厚いサポート、そして素晴らしい社員に恵まれ、
                        企業人として幸せに感じております。 -->

                        <?php echo CFS()->get('company_message_text1'); ?>

                    </p>
                </div>

                <div class="company__text">
                    <p><?php echo CFS()->get('company_message_text2'); ?></p>
                    <p>代表取締役社長<br>
                        <span>原 健二</span></p>
                </div>
            </div>

            <!-- concept -->
            <div class="concept">
                <div class="concept__title">
                    <p>CONCEPT</p>
                    <p>経営理念</p>
                </div>

                <div class="concept__text">
                    <p><?php echo CFS()->get('company_concept_text'); ?></p>
                </div>
            </div>

            <!-- about -->
            <div class="about">
                <div class="about__title">
                    <p>ABOUT</p>
                    <p>会社概要</p>
                </div>

                <div class="about__img--text">
                    <img src=" <?php echo CFS()->get('company_about_img'); ?>" alt="原商事運送株式会社">
                    <div class="about__text--box">
                        <p><?php echo CFS()->get('company_about_text'); ?></p>
                    </div>
                </div>

                <div class="about__overview">
                    <div class="about__overview--content">
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title1'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text1'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title2'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text2'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title3'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text3'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title4'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text4'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title5'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text5'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title6'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text6'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title7'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text7'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title8'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text8'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title9'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text9'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title10'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text10'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title11'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text11'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title12'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text12'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title13'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text13'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title14'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text14'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title15'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text15'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title16'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text16'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_about_table_title17'); ?></p>
                            <p><?php echo CFS()->get('company_about_table_text17'); ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- history -->
            <div class="history">
                <div class="history__title">
                    <p>HISTORY</p>
                    <p>沿革</p>
                </div>

                <div class="history__overview">
                    <div class="about__overview--content">
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title1'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text1'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title2'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text2'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title3'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text3'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title4'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text4'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title5'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text5'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title6'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text6'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title7'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text7'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title8'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text8'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title9'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text9'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title10'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text10'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title11'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text11'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title12'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text12'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title13'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text13'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title14'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text14'); ?></p>
                        </div>
                        <div class="content--item">
                            <p><?php echo CFS()->get('company_history_table_title15'); ?></p>
                            <p><?php echo CFS()->get('company_history_table_text15'); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="history__img--section">
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-1'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-1'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-2'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-2'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-3'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-3'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-4'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-4'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-5'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-5'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-6'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-6'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-7'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-7'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-8'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-8'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-9'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-9'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-10'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-10'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-11'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-11'); ?></p>
                    </div>
                    <div class="history__img--section__box">
                        <img src="<?php echo CFS()->get('company_album-img-12'); ?>" alt="">
                        <p><?php echo CFS()->get('company_album-text-12'); ?></p>
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