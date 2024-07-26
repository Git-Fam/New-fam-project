<?php get_header(); ?>

<?php
/*
Template Name:トラックページ
*/
?>


<!-- トラックトップバック -->
<div class="FV__background">
    <img src="<?php echo get_template_directory_uri(); ?>/imag/trac--top.jpg" alt="トラックートップバック">
</div>

<!-- サービス--FV -->
<div class="FV__background__text">
    <p>TRAC<br><span>車両案内</span></p>
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

    <!-- 車両案内 -->
    <div class="trac contact_btn--margin">

        <div class="trac__text">
            <p>
                <?php echo CFS()->get('trac_main_text'); ?>
            </p>
        </div>

        <div class="trac--content">
            <!-- 13t 低床ウィング車 -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_1_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_1_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_1_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_1_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_1_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_1_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_1_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- 7t ウィング車 -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_2_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_2_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_2_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_2_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_2_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_2_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_2_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- 4t ウィング車 -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_3_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_3_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_3_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_3_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_3_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_3_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_3_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- 2t 箱車 -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_4_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_4_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_4_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_4_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_4_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_4_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_4_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- 2t ショート -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_5_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_5_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_5_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_5_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_5_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_5_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_5_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- ストック -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('tra6_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('tra6_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('tra6_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('tra6_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('tra6_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('tra6_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('tra6_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- ストック -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_7_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_7_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_7_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_7_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_7_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_7_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_7_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>
            <!-- ストック -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_8_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_8_img_1'); ?>" alt="">
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>積載量</h3>
                                    <p><?php echo CFS()->get('trac_8_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_8_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>保有台数</h3>
                                    <p><?php echo CFS()->get('trac_8_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerIn">
                        <img src="<?php echo CFS()->get('trac_8_img_2'); ?>" alt="">
                        <img src="<?php echo CFS()->get('trac_8_img_3'); ?>" alt="">
                    </div>
                </div>
            </div>

            <!-- 2tハンガー車(フルワイド車) -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_attachment_1_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn width">
                        <img src="<?php echo CFS()->get('trac_attachment_1_img'); ?>" alt="">
                    </div>
                    <div class="containerIn">
                        <div class="text--exception">
                            <p>
                                <?php echo CFS()->get('trac_attachment_1_memo'); ?>
                            </p>
                        </div>
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>バーの本数</h3>
                                    <p><?php echo CFS()->get('trac_attachment_1_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_attachment_1_list_text_2'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>最大枚数</h3>
                                    <p><?php echo CFS()->get('trac_attachment_1_list_text_3'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 特殊車両 7tセーフティーローダー -->
            <div class="trac--content--item">
                <div class="trac--content--item--title">
                    <p><?php echo CFS()->get('trac_attachment_2_name'); ?></p>
                </div>
                <div class="trac--content--item--container">
                    <div class="containerIn-nocolumn">
                        <img class="img2" src="<?php echo CFS()->get('trac_attachment_2_img'); ?>" alt="">
                        <div class="containerIn column">
                           <img src="<?php echo CFS()->get('trac_attachment_2-2_img'); ?>" alt="">
                           <img src="<?php echo CFS()->get('trac_attachment_2-3_img'); ?>" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="trac--content--item--container ">
                <div class="containerIn width">
                        <div class="text--exception">
                            <p>
                                <?php echo CFS()->get('trac_attachment_2_memo'); ?>
                            </p>
                        </div>
                        <div class="text--wap">
                            <div class="text">
                                <div class="text--detail">
                                    <h3>荷台内寸</h3>
                                    <p><?php echo CFS()->get('trac_attachment_2_list_text_1'); ?></p>
                                </div>
                                <div class="text--detail">
                                    <h3>最大枚数</h3>
                                    <p><?php echo CFS()->get('trac_attachment_2_list_text_2'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                     </div>

            </div>

            <div class="flex">
                <!-- 本社営業所 -->
                <div class="trac--content--item">
                    <div class="trac--content--item--title">
                        <p><?php echo CFS()->get('trac_mainOffice_title'); ?></p>
                    </div>
                    <div class="trac--content--item--container">
                        <ul class="container--list">
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_1'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_1'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_2'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_2'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_3'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_3'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_4'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_4'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_5'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_5'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_6'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_6'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_7'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_7'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_8'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_8'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_9'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_9'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_mainOffice_model_10'); ?></p>
                                <p><?php echo CFS()->get('trac_mainOffice_count_10'); ?></p>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- 野田営業所 -->
                <div class="trac--content--item">
                    <div class="trac--content--item--title">
                        <p><?php echo CFS()->get('trac_nodaOffice_title'); ?></p>
                    </div>
                    <div class="trac--content--item--container">
                        <ul class="container--list">
                        <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_1'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_1'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_2'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_2'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_3'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_3'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_4'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_4'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_5'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_5'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_6'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_6'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_7'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_7'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_8'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_8'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_9'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_9'); ?></p>
                            </li>
                            <li>
                                <p><?php echo CFS()->get('trac_nodaOffice_model_10'); ?></p>
                                <p><?php echo CFS()->get('trac_nodaOffice_count_10'); ?></p>
                            </li>
                        </ul>
                    </div>
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

<?php get_footer(); ?>