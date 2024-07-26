<?php get_header() ;?>

<?php
/*
Template Name:アテンプトページ
*/
?>

        <!-- attemptトップバック -->
        <div class="FV__background">
            <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt--top.jpg" alt="attemptトップバック">
        </div>

        <!-- サービス--FV -->
        <div class="FV__background__text">
            <p>ATTEMPT<br><span>取り組み内容</span></p>
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

            <!-- attempt -->
            <div class="attempt contact_btn--margin">

                <div class="attempt__safety">
                    <div class="attempt__safety__title">
                        <p>SAFETY</p>
                        <p>安全への取り組み</p>
                    </div>
                    <div class="attempt__safety__text">
                        <p><?php echo CFS()->get('attempt_safety_subTitle_1'); ?><span><?php echo CFS()->get('attempt_safety_subTitle_bold'); ?></span><?php echo CFS()->get('attempt_safety_subTitle_2'); ?></p>
                    </div>
                    <div class="attempt__safety__text--sb">
                        <p><?php echo CFS()->get('attempt_safety_title'); ?></p>
                    </div>
                    <div class="attempt__safety__contents">
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-1'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-1'); ?></p>
                        </div>
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-2'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-2'); ?></p>
                        </div>
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-3'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-3'); ?></p>
                        </div>
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-4'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-4'); ?></p>
                        </div>
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-5'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-5'); ?></p>
                        </div>
                        <div class="attempt__safety__contents__goal">
                            <div class="attempt__safety__contents__goal__select">
                                <p class="click--point active">本社川口営業所</p>
                                <p class="click--point">野田営業所</p>
                            </div>
                            
                            <table class="click--contents active">
                                <tbody>
                                    <tr>
                                        <td class="top-color top-text border-right" colspan="2">前年度目標項目</td>
                                        <td class="top-color top-text border-right">前年度目標</td>
                                        <td class="top-color top-text border-right">前年度実績</td>
                                        <td class="top-color top-text">達成/未達成</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3" class="top-color top-text border-top">達成状況</td>
                                        <td>人身事故</td>
                                        <td><?php echo CFS()->get('MainTable_injury_target'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_injury_actual'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_injury_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-top">車両事故（対物・対車両）</td>
                                        <td><?php echo CFS()->get('MainTable_crash_target'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_crash_actual'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_crash_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>健康起因による事故</td>
                                        <td><?php echo CFS()->get('MainTable_health_target'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_health_actual'); ?></td>
                                        <td><?php echo CFS()->get('MainTable_health_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="top-color top-text border-top">未達成時<br>要因・分析</td>
                                        <td colspan="4"><?php echo CFS()->get('MainTable_profile_text'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="top-color top-text border-top">改善方法</td>
                                        <td colspan="4"><?php echo CFS()->get('MainTable_improvement_text'); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="click--contents">
                                <tbody>
                                    <tr>
                                        <td class="top-color top-text border-right" colspan="2">前年度目標項目</td>
                                        <td class="top-color top-text border-right">前年度目標</td>
                                        <td class="top-color top-text border-right">前年度実績</td>
                                        <td class="top-color top-text">達成/未達成</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3" class="top-color top-text border-top">達成状況</td>
                                        <td>人身事故</td>
                                        <td><?php echo CFS()->get('NodaTable_injury_target'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_injury_actual'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_injury_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-top">車両事故（対物・対車両）</td>
                                        <td><?php echo CFS()->get('NodaTable_crash_target'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_crash_actual'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_crash_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>健康起因による事故</td>
                                        <td><?php echo CFS()->get('NodaTable_health_target'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_health_actual'); ?></td>
                                        <td><?php echo CFS()->get('NodaTable_health_Y_or_N'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="top-color top-text border-top">未達成時<br>要因・分析</td>
                                        <td colspan="4"><?php echo CFS()->get('NodaTable_profile_text'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="top-color top-text border-top">改善方法</td>
                                        <td colspan="4"><?php echo CFS()->get('NodaTable_improvement_text'); ?></td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="attempt__safety__contents__text">
                            <p><?php echo CFS()->get('attempt_safety_listTitle-6'); ?></p>
                            <p><?php echo CFS()->get('attempt_safety_listText-6'); ?></p>
                        </div>
                    </div>                   
                </div>


                <div class="attempt__action">
                    <div class="attempt__action__title">
                        <p>安全への取り組み内容</p>
                    </div>

                    <div class="attempt__action__contents">

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_1'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_1'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                <p><?php echo CFS()->get('attempt_safety_content_text_1'); ?></p>
                            </div>
                        </div>
						
						<div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_1_2'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_1_2'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                <p><?php echo CFS()->get('attempt_safety_content_text_1_2'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_2'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_2'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                            <div class="attempt__action__contents__run__text">
                                <p><?php echo CFS()->get('attempt_safety_content_text_2'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_3'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_3'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_3'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_4'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_4'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_4'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_5'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_5'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_5'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_6'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_6'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_6'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_7'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_7'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_7'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_8'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_8'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_8'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_9'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_9'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_9'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_10'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_10'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_10'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_11'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_11'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_11'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_safety_content_img_12'); ?>);">
                                <div class="attempt__action__contents__run__item__title">
                                    <p><?php echo CFS()->get('attempt_safety_content_title_12'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_safety_content_text_12'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="attempt__environment">
                    <div class="attempt__environment__title">
                        <p>ENVIRONMENT</p>
                        <p>環境への取り組み</p>
                    </div>
                    <div class="attempt__environment__text">
                        <p><?php echo CFS()->get('attempt_environment_subTitle_1'); ?></p>
                    </div>
                    <div class="attempt__environment__text--sb">
                        <p>基本方針</p>
                    </div>
                    <div class="attempt__environment__container">

                        <div class="container--item">
                            <div class="number">
                                <h3>1</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-1'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>2</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-2'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>3</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-3'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>4</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-4'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>5</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-5'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>6</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-6'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>7</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-7'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>8</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-8'); ?></p>
                            </div>
                        </div>

                        <div class="container--item">
                            <div class="number">
                                <h3>9</h3>
                            </div>
                            <div class="text">
                                <p><?php echo CFS()->get('attempt_environment_tableText-9'); ?></p>
                            </div>
                        </div>


               
                    </div>
                </div>

                <div class="attempt__action">
                    <div class="attempt__action__title attempt__action__title__environment">
                        <p>安全への取り組み</p>
                    </div>

                    <div class="attempt__action__contents">


                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_1'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi--1">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_1'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                <p><?php echo CFS()->get('attempt_environment_content_text_1'); ?></p>
                            </div>
                        </div>


                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_2'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_2'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                            <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_2'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_3'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_3'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_3'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_4'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_4'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_4'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_5'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_5'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_5'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_6'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_6'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_6'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_7'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_7'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_7'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_8'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_8'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_8'); ?></p>
                            </div>
                        </div>

                        <div class="attempt__action__contents__run attempt__action__contents__run__environment">
                            <div class="attempt__action__contents__run__item" style="background-image:url(<?php echo CFS()->get('attempt_environment_content_img_9'); ?>);">
                                <div class="attempt__action__contents__run__item__title attempt__action__contents__run__item__title__envi">
                                    <p><?php echo CFS()->get('attempt_environment_content_title_9'); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action.svg" alt="">
                                </div>
                            </div>
                             <div class="attempt__action__contents__run__text">
                                 <p><?php echo CFS()->get('attempt_environment_content_text_9'); ?></p>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="attempt__digital">
                    <div class="attempt__digital__title">
                        <p>デジタルタコグラフの活用</p>
                    </div>
                    <div class="attempt__digital__text">
                        <p><?php echo CFS()->get('digital_octopus_graph'); ?></p>
                    </div>

                    <div class="attempt__digital__contents">
                        <img src="<?php echo get_template_directory_uri(); ?>/imag/attempt__action--environment--2.jpg" alt="デジタルタコグラフ">
                        <div class="attempt__digital__contents__textbox">
                            <p><?php echo CFS()->get('digital_octopus_graph_text'); ?></p>
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