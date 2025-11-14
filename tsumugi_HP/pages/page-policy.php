<?php
/*
Template Name: policy
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

        <div class="page standard-page">
            <div class="standard-inner">
                <p class="top-TX">
                    つむぎクリニック（以下 当クリニック）は、今日の高度情報通信社会において個人情報が重要な資産であることを理解し、個人情報を正しく扱うことが当クリニックの重要な責務であると認識し、以下の方針に基づき個人情報の保護に努めることを宣言する。
                </p>

                <ul class="standard-content">
                <?php
                $policy = SCF::get('policy');
                foreach ($policy as $fields) { ?>
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
