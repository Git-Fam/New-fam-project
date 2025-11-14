<?php
/*
Template Name: standard
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


        <div class="page standard-page">
            <div class="standard-inner">
                <p class="top-TX">
                つむぎクリニック（以下：当クリニック）では、厚生労働省の方針に基づき、施設基準に関する情報をホームページで公開することになりました。今後も医療の透明性確保と患者様本位のサービス充実に努めてまいります。ご理解とご協力をお願い申し上げます。
                </p>

                <ul class="standard-content">
                <?php
                $standard = SCF::get('standard');
                foreach ($standard as $fields) { ?>
                    <li>
                        <div class="C_KV-title type-01">
                            <div class="icon icon-02"></div>
                            <h2 class="TL"><?php echo $fields['title']; ?></h2>
                        </div>
                        <div class="textbox">
                            <p class="TX"><?php echo nl2br($fields['content']); ?></p>
                        </div>
                    </li>
                    <?php }
                ?>                            

                </ul>
            </div>
        </div>


<?php get_template_part('./inc/footer'); ?>
