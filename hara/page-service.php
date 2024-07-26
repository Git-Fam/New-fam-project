<?php get_header() ;?>

<?php
/*
Template Name:サービスページ
*/
?>

        <!-- サービストップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/service--top.jpg" alt="サービストップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>SERVICE<br><span>事業内容</span></p>
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

            <!-- ドライバー -->
            <div class="driver contact_btn--margin">
                <div class="driver__title" id="driver__title">
                    <p>DRIVER</p>
                    <p>チャーター便</p>
                </div>

                <div class="driver__text">
                    <p>
                        <!-- 原商事運輸では、小口荷物配送、一般貨物配送を中心とした運送業務を行なっております。<br class="pc">お客様のご要望やプランに最適な配送サービスをご提供いたします。<br>また、当社では徹底した従業員教育を行ない、運転、荷扱、マナー等の<br class="pc">サービス品質向上に日々努めております。<br>お客様のニーズに合わせて柔軟に対応させていただきますので、まずはお気軽にお問い合わせください。 -->
                        <?php echo CFS()->get('service_driver_text'); ?>

                    </p>
                </div>

                <div class="driver__box">
                    <div class="driver__box__title">
                        <p>チャーター便</p>
                    </div>

                    <div class="driver__box__text">
                        <p>
                            <!-- チャーター便とは、中ロット～大ロットのお荷物の輸送に最適なサービスです。<br>
                            お客さまのための専用車両による専用輸送システムで、お客さまはもとよりお客さま<br>のお届け先さまにもよりきめ細やかな物流サービスをご提供いたします。 -->
                            <?php echo CFS()->get('service_charter_text'); ?>
                        </p>
                    </div>
                </div>

                <div class="driver__box">
                    <div class="driver__box__title">
                        <p>スポットチャーター便</p>
                    </div>

                    <img class="pc" src="<?php echo CFS()->get('service_spotCharter_imgPC'); ?>" alt="日時指定イラスト説明">
                    <img class="sp" src="<?php echo CFS()->get('service_spotCharter_imgSP'); ?>" alt="日時指定イラスト説明">

                    <div class="driver__box__text">
                        <p>
                            <!-- 急な荷物の配送や納入日時厳守のお荷物の配送はチャーター便がおすすめです。<br>車両が貸切なので、ご指定された日時にダイレクトにお荷物をお届することができます。 -->
                            <?php echo CFS()->get('service_spotCharter_text'); ?>
                        </p>
                    </div>
                </div>

                <div class="driver__box">
                    <div class="driver__box__title">
                        <p>往復便</p>
                    </div>

                    <img class="pc" src="<?php echo CFS()->get('service_round_imgPC'); ?>" alt="往復運行イラスト説明">
                    <img class="sp" src="<?php echo CFS()->get('service_round_imgPC'); ?>" alt="往復運行イラスト説明">


                    <div class="driver__box__text">
                        <p>
                            <!-- お客さま・お届け先さまの相互にお荷物の行き来がある方に最適です。<br class="pc">
                            常に往復運行をいたします。 -->
                            <?php echo CFS()->get('service_round_text'); ?>
                        </p>
                    </div>
                </div>

                <div class="driver__box">
                    <div class="driver__box__title">
                        <p>ルート配送便</p>
                    </div>

                    <img class="pc" src="<?php echo CFS()->get('service_root_imgPC'); ?>" alt="専属化イラスト説明">
                    <img class="sp" src="<?php echo CFS()->get('service_root_imgSP'); ?>" alt="専属化イラスト説明">


                    <div class="driver__box__text">
                        <p>
                            <!-- チャーター便とは、中ロット～大ロットのお荷物の輸送に最適なサービスです。<br>毎日、毎週などお客様のニーズに合わせて、お荷物をお届け致します。お取引先との効率的な配送ルートの構築により、スムーズな物流を実現します。 -->
                          <?php echo CFS()->get('service_root_text'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- エリア -->
            <div class="area">

                <div class="area__title" id="area__title">
                    <p>AREA</p>
                    <p>共同配送/自社配送エリア</p>
                </div>

                <div class="area__section">

                    <div class="area__section__contents">
                        <div class="area__section__contents__title">
                            <p>共同配送</p>
                        </div>
                        <img src="<?php echo CFS()->get('service_joint_img'); ?>" alt="共同配送イラスト説明">

                        <div class="area__section__contents__text">
                            <p>
                                <!-- 同じような業種とエリアに配送するお客さまに<br class="sp">”共同配送”を提案しています。<br>また、自社共同配送とともに協力企業様の共同配送網・<br class="sp">路線ネットワークを組み合わせる<br>ことで、さらなるコストダウンを実現いたします。 -->
                                <?php echo CFS()->get('service_joint_text'); ?>
                            </p>
                        </div>
                    </div>


                    <div class="area__section__contents">
                        <div class="area__section__contents__title">
                            <p>自社サービスエリア</p>
                        </div>
                        <img class="area--img--sp" src="<?php echo CFS()->get('service_own_img'); ?>" alt="共同配送イラスト説明">

                        <div class="area__section__contents__text">
                            <p class="text--center">
                                <!-- 埼玉・東京・神奈川・千葉・茨城<br>
                                ・栃木・群馬・福島・山梨・静岡 -->
                                <?php echo CFS()->get('service_own_text'); ?>
                            </p>
                        </div>
                    </div>


                    <div class="area__section__contents">
                        <div class="area__section__contents__title">
                            <p>斡旋業務</p>
                        </div>
                        <img class="area--img--sp--2" src="<?php echo CFS()->get('service_promotion_img'); ?>" alt="共同配送イラスト説明">

                        <div class="area__section__contents__text">
                            <p>
                                <!-- 関東を中心とした幅広いネットワークで日本全国<br class="sp">お得な帰り便・混載便を4t車から大型特殊車両まで、<br class="sp">お客様のニーズにあわせて各車両を迅速に<br class="sp">お探し致します。 -->
                                <?php echo CFS()->get('service_promotion_text'); ?>
                            </p>
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