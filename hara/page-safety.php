<?php get_header() ;?>

<?php
/*
Template Name:セーフティーページ
*/
?>

        <!-- safetyトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/safety--top.jpg" alt="safetyトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>SAFETY<br><span>安全・環境への取り組み</span></p>
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

            <!-- 安全 -->
            <div class="safety contact_btn--margin">

                <div class="safety__certification">
                    <div class="safety__certification__title">
                        <p>CERTIFICATION</p>
                        <p>取得認定証</p>
                    </div>

                    <div class="safety__certification__contents safety__certification__contents--first">
                        <p class="sp"><?php echo CFS()->get('safety_certification_title_1'); ?></p>
                        <img src="<?php echo CFS()->get('safety_certification_img_1'); ?>" alt="">
                        <div class="safety__certification__contents__text">
                            <p class="pc"><?php echo CFS()->get('safety_certification_title_1'); ?></p>
                            <p><?php echo CFS()->get('safety_certification_text_1'); ?></p>
                            <a href="<?php echo CFS()->get('safety_certification_url_1'); ?>" target="_blank" rel="noopener noreferrer"><?php echo CFS()->get('safety_certification_btn_1'); ?><img src="<?php echo get_template_directory_uri(); ?>/imag/point--white.svg" alt=""></a>
                        </div>
                    </div>

                    <div class="safety__certification__contents safety__certification__contents--second">
                        <p class="sp"><?php echo CFS()->get('safety_certification_title_2'); ?></p>
                        <img src="<?php echo CFS()->get('safety_certification_img_2'); ?>" alt="グリーン経営事業所認定">
                        <div class="safety__certification__contents__text">
                            <p class="pc"><?php echo CFS()->get('safety_certification_title_2'); ?></p>
                            <p><?php echo CFS()->get('safety_certification_text_2'); ?></p>
                            <a href="https://www.green-m.jp/" target="_blank" rel="noopener noreferrer"><?php echo CFS()->get('safety_certification_btn_2'); ?><img src="<?php echo get_template_directory_uri(); ?>/imag/point--white.svg" alt=""></a>
                        </div>
                    </div>
                </div>


                <div class="certificate__certification">
                    <div class="certificate__certification__title">
                        <p>CERTIFICATION</p>
                        <p>認定書</p>
                    </div>
                    <div class="certificate__certification__text">
                        <p><?php echo CFS()->get('safety_certification_subTitle'); ?></p>
                    </div>
                    <div class="certificate__certification__section">

                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title"><?php echo CFS()->get('safety_certification_1_title'); ?></p>
                            <div class="contents--item">
                                <img src="<?php echo CFS()->get('safety_certification_1_img'); ?>" alt="">
                                <div class="contents--item--text">
                                    <p><?php echo CFS()->get('safety_certification_1_text'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title"><?php echo CFS()->get('safety_certification_2_title'); ?></p>
                            <div class="contents--item">
                                <img src="<?php echo CFS()->get('safety_certification_2_img'); ?>" alt="">
                                <div class="contents--item--text">
                                    <p><?php echo CFS()->get('safety_certification_2_text'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title"><?php echo CFS()->get('safety_certification_3_title'); ?></p>
                            <div class="contents--item">
                                <img src="<?php echo CFS()->get('safety_certification_3_img'); ?>" alt="">
                                <div class="contents--item--text">
                                    <p><?php echo CFS()->get('safety_certification_3_text'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title"><?php echo CFS()->get('safety_certification_4_title'); ?></p>
                            <div class="contents--item">
                                <img src="<?php echo CFS()->get('safety_certification_4_img'); ?>" alt="">
                                <div class="contents--item--text">
                                    <p><?php echo CFS()->get('safety_certification_4_text'); ?></p>
                                </div>
                            </div>
                        </div>
						

                        <!-- <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title">安全性優良事業所表彰</p>
                            <div class="contents--item">
                                <img src="<?php echo get_template_directory_uri(); ?>/imag/safety-certification-2.png" alt="">
                                <div class="contents--item--text">
                                    <p>
                                    「安全性優良事業所認定」（Gマーク）を10年以上取得しており、運送の安全対象において顕著な功績が認められる事業所に対して、国土交通省の表彰制度が創設されています。令和4年に認定していただき、埼玉県運輸支局に表彰されました。
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title">グリーン経営認証</p>
                            <div class="contents--item">
                                <img src="<?php echo get_template_directory_uri(); ?>/imag/safety-certification-3.png" alt="">
                                <div class="contents--item--text">
                                    <p>
                                    グリーン経営認証は、継続的な環境保全活動を行ない、運輸業における環境負荷の軽減につなげていくための制度です。 交通エコロジー・モビリティ財団が国土交通省、全日本トラック協会と協力をし、グリーン経営推進マニュアルに基づいて、一定以上のレベル以上の取り組みを行なっている事業者に与えられます。当社は平成24年にグリーン経営認証に登録されました。
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="certificate__certification__section__contents">
                            <p class="certificate__certification__section__contents--title">グリーン経営認証</p>
                            <div class="contents--item">
                                <img src="<?php echo get_template_directory_uri(); ?>/imag/safety-certification-4.png" alt="">
                                <div class="contents--item--text">
                                    <p>
                                    社は平成24年に認証を受け、永年にわたりグリーン経営に取り組み、環境の保全に努め、地球温暖化防止に貢献したとして、「グリーン経営認証永年表彰」を受領いたしました。今後とも環境に配慮した取り組みを積極的に進めて参ります。
                                    </p>
                                </div>
                            </div>
                        </div> -->
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
