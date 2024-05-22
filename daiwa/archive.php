<?php get_header(); ?>

        <!-- works Start -->
        <div class="works">

            <!-- WorksSub -->
            <div class="C_WorksSub">
                <p class="TX">
                    大和ハウジングの施工事例を<br class="sp">ご覧いただけます。<br>
                    リノベーション、リフォームから水回りまで、様々な施工を行っております。
                </p>
            </div>

            <!-- WorksMain -->
            <div class="C_Works">

                <?php if (have_posts()):
                    while (have_posts()):the_post(); 
                ?>

                    <!-- アイテム -->
                    <div class="WorksMan">
                        <div class="WorksMan--inner">
                            <div class="img__area">
                                <div class="BtoA">
                                    <img class="img" src="<?php echo CFS()->get('before'); ?>" alt="">
                                    <p class="TX Be">Before</p>
                                </div>
                                <div class="BtoA">
                                    <img class="img" src="<?php echo CFS()->get('after'); ?>" alt="">
                                    <p class="TX Af">After</p>
                                </div>
                            </div>
                            <div class="content__area">
                                <div class="content__area--title">
                                    <h3 class="TL">施工内容</h3>
                                </div>
                                <div class="content__area--text">
                                    <p class="TX"><?php echo CFS()->get('construction'); ?></p>
                                    <p class="TX"><?php echo CFS()->get('comment'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile;?>
                <?php else: ?>
                    <p style="text-align: center;">投稿がまだありません。</p>
                <?php endif; ?>

            </div>

        </div>
        <!-- works End -->

<?php get_footer(); ?>