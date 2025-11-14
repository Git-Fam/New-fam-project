<?php
/*
Template Name: recruit
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

        <div class="page recruit-page">
            <div class="recruit-inner">
                <div class="recruit-content">
                    <div class="TL-box">
                        <h3 class="TL"><?php echo nl2br(SCF::get('details-01')); ?></h3>
                    </div>


                    <ul class="recruit-item">
                    <?php
                    $fulltime = SCF::get('full-time');
                    foreach ($fulltime as $fields) { ?>

                        <li>
                            <div class="item-box label">
                                <h4><?php echo $fields['full-time-label']; ?></h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX"><?php echo nl2br($fields['full-time-content']); ?></p>
                            </div>
                        </li>
                        <?php }
                    ?>                            

                        <!-- <li>
                            <div class="item-box label">
                                <h4>給与</h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX">基本給　230,000円～250,000円<br>
                                資格手当　30,000円～100,000円<br>
                                夜勤手当・拘束手当・呼び出し手当・日曜・祝日手当（日勤のみ）<br>
                                その他手当あり</p>
                            </div>
                        </li>
                        <li>
                            <div class="item-box label">
                                <h4>休日</h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX">・年間118日<br>
                                　9日/月・夏季休暇・冬期休暇・誕生日<br class="sp"><span class="sp">　</span>休暇あり<br>
                                    ・有給休暇<br>
                                    　入職6カ月経過後より10日付与<br>
                                　（翌年11日、翌々年12日、最大20日）</p>
                            </div>
                        </li>
                        <li>
                            <div class="item-box label">
                                <h4>退職金制度</h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX">なし</p>
                            </div>
                        </li>
                        <li>
                            <div class="item-box label">
                                <h4>賞与</h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX">実績なし<br>
                                    ・実績に応じて12月、7月の年2回支給予<br class="sp"><span class="sp">　</span>定</p>
                            </div>
                        </li>
                        <li>
                            <div class="item-box label">
                                <h4>試用期間</h4>
                            </div>
                            <div class="item-box textbox">
                                <p class="TX">１か月</p>
                            </div>
                        </li> -->
                    </ul> 


                </div>

                <?php
                $details02 = SCF::get('details-02');
                $parttime = SCF::get('part-time');
                // どちらも空なら出力しない
                if (!empty($details02) || !empty($parttime)): ?>
                    <div class="recruit-content">
                        
                        <?php if (!empty($details02)): ?>
                            <div class="TL-box">
                                <h3 class="TL"><?php echo nl2br($details02); ?></h3>
                            </div>
                        <?php endif; ?>

                        <ul class="recruit-item">
                        <?php if (!empty($parttime)): ?>
                            <?php foreach ($parttime as $fields): ?>
                                <?php if (!empty($fields['part-time-label']) || !empty($fields['part-time-content'])): ?>
                                    
                                        <li>
                                            <div class="item-box label">
                                                <h4><?php echo esc_html($fields['part-time-label']); ?></h4>
                                            </div>
                                            <div class="item-box textbox">
                                                <p class="TX"><?php echo nl2br(esc_html($fields['part-time-content'])); ?></p>
                                            </div>
                                        </li>
                                    
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif;
                ?>

                <div class="recruit-link">
                    <p class="TX">
                        エントリーをご希望の方はお問い合わせフォームの<br>
                        「お問い合わせ内容」欄にご記入ください。
                    </p>
                    <a class="link hover-opa" href="<?php echo esc_url(home_url('/contact')); ?>">
                        <p class="link-TX">お問い合わせフォーム</p>
                    </a>
                </div>
                <div class="recruit-img"></div>
            </div>
        </div>


<?php get_template_part('./inc/footer'); ?>
