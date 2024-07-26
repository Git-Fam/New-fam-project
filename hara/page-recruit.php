    <?php get_header() ;?>

    <?php
    /*
    Template Name:リクルートページ
    */
    ?>

        <!-- recruitトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/recruit--top.jpg" alt="recruitトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>RECRUIT<br><span>採用情報</span></p>
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

            <!-- recruit -->
            <div class="recruit contact_btn--margin">

                <div class="recruit__at">
                    <div class="recruit__at__text">
                        <p><?php echo CFS()->get('recruit_main_title_1'); ?></p>
                        <p><?php echo CFS()->get('recruit_main_text_1'); ?></p>
                    </div>
                    <div class="recruit__at__text">
                        <p><?php echo CFS()->get('recruit_main_title_2'); ?></p>
                        <p><?php echo CFS()->get('recruit_main_text_2'); ?></p>
                    </div>
                </div>

                <div class="workflow">
                    <div class="workflow__title">
                        <p>WORKFLOW</p>
                        <p>仕事の流れ</p>
                    </div>
                    <div class="workflow__text">
                        <p><?php echo CFS()->get('recruit_workflow_text_1'); ?></p>
                    </div>
                    <div class="workflow__flow">
                        <img src="<?php echo CFS()->get('recruit_workflow_content_1'); ?>" alt="本社１日の流れ">
                        <img src="<?php echo CFS()->get('recruit_workflow_content_2'); ?>" alt="野田１日の流れ">
                    </div>
                </div>
                
                <div class="voice">
                    <div class="voice__title">
                        <p>VOICE</p>
                        <p>先輩社員の声</p>
                    </div>
                    <div class="voice__box">

                       <div class="voice__box--item">
                            <img src="<?php echo CFS()->get('recruit_voice_img_1'); ?>" alt="">
                            <div class="item--text">
                                <h3><?php echo CFS()->get('recruit_voice_title_1'); ?></h3>
                                <p><?php echo CFS()->get('recruit_voice_text_1'); ?></p>
                            </div>
                       </div>

                       <div class="voice__box--item">
                            <img src="<?php echo CFS()->get('recruit_voice_img_2'); ?>" alt="">
                            <div class="item--text">
                                <h3><?php echo CFS()->get('recruit_voice_title_2'); ?></h3>
                                <p><?php echo CFS()->get('recruit_voice_text_2_1'); ?></p>
                                <p><?php echo CFS()->get('recruit_voice_text_2_2'); ?></p>
                            </div>
                       </div>
                       
                    </div>
                </div>

                <div class="outline">
                    <div class="outline__title">
                        <p>OUTLINE</p>
                        <p>募集要項/ドライバー</p>
                    </div>
                    <div class="outline__box">

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_1'); ?></h3>
                            </div>
                            <div class="item--content">
                                <h4><?php echo CFS()->get('recruit_outline_text_1_1'); ?></h4>
                                <ul>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_1_1_1'); ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_1_1_2'); ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_1_1_3'); ?></p>
                                    </li>
                                </ul>
                                <h4><?php echo CFS()->get('recruit_outline_text_1_2'); ?></h4>
                                <ul>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_1_2_1'); ?></p>
                                    </li>
                                </ul>
                                <p><?php echo CFS()->get('recruit_outline_point_1'); ?></p>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_2'); ?></h3>
                            </div>
                            <div class="item--content">
                                <p><?php echo CFS()->get('recruit_outline_text_2'); ?></p>
                                <br>
                                <p><?php echo CFS()->get('recruit_outline_point_2_1_1'); ?></p>
                                <p><?php echo CFS()->get('recruit_outline_point_2_1_2'); ?></p>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_3'); ?></h3>
                            </div>
                            <div class="item--content">
                                <h4><?php echo CFS()->get('recruit_outline_text_3_1'); ?></h4>
                                <p><?php echo CFS()->get('recruit_outline_address_3_1_1'); ?></p>
                                <p><?php echo CFS()->get('recruit_outline_address_3_1_2'); ?></p>
                                <ul>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_3_1_1'); ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_3_1_2'); ?></p>
                                    </li>
                                </ul>
                                <h4><?php echo CFS()->get('recruit_outline_text_3_2'); ?></h4>
                                <p><?php echo CFS()->get('recruit_outline_address_3_2_1'); ?></p>
                                <p><?php echo CFS()->get('recruit_outline_address_3_2_1'); ?></p>
                                <ul>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_3_2_1'); ?></p>
                                    </li>
                                </ul>
                                <p><?php echo CFS()->get('recruit_outline_point_3'); ?></p>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_4'); ?></h3>
                            </div>
                            <div class="item--content">
                                <p><?php echo CFS()->get('recruit_outline_time_4'); ?></p>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_5'); ?></h3>
                            </div>
                            <div class="item--content">
                                <ul>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_5_1'); ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_5_2'); ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo CFS()->get('recruit_outline_list_5_3'); ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_6'); ?></h3>
                            </div>
                            <div class="item--content">
                                <p><?php echo CFS()->get('recruit_outline_text_6'); ?></p>
                            </div>
                        </div>

                        <div class="outline__box--item">
                            <div class="item--title">
                                <h3><?php echo CFS()->get('recruit_outline_title_7'); ?></h3>
                            </div>
                            <div class="item--content">
                               <p><?php echo CFS()->get('recruit_outline_text_7'); ?></p>
                            </div>
                        </div>
                      
                    </div>
                </div>

                <div class="how">
                    <div class="how__title">
                        <p>応募方法</p>
                    </div>
                    <div class="how__text">
                        <p><?php echo CFS()->get('recruit_entry_text'); ?></p>
                    </div>
                    <div class="how__btn">
                        <a href="tel:0482553020">
                            <img src="<?php echo get_template_directory_uri(); ?>/imag/tell.svg" alt="電話アイコン">
                            <p>電話でのご応募</p>
                        </a>
                        <a href="<?php bloginfo('url'); ?>/contact">
                            <img src="<?php echo get_template_directory_uri(); ?>/imag/mail.svg" alt="メールアイコン">
                            <p>メールでのご応募</p>
                        </a>
                    </div>
                </div>

            </div>

            <!-- リンクボタンエリア -->
            <div class="btn__area">
                <div class="btn__area__links">
                    <a href="#">
                        <p>COMPANY</p>
                        <p>会社案内</p>
                    </a>
                    <a href="#">
                        <p>SAFETY</p>
                        <p>安全・環境への取り組み</p>
                    </a>
                    <a href="#">
                        <p>STAFF</p>
                        <p>スタッフ紹介</p>
                    </a>
                </div>
            </div>

        </div>

        <?php get_footer() ;?>