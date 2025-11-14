<?php
/*
Template Name: contact
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


        <div class="page contact-page">
            <div class="contact-inner">
                <p class="contact-TX">
                    当クリニックにご興味を持っていただき<br class="sp">ありがとうございます。<br>
                    ご質問のある方は下記フォームより<br class="sp">お問い合わせください。<br class="sp">「*」部分は必須入力となっております。
                </p>
                <?php echo do_shortcode('[contact-form-7 id="33d94c8" title="コンタクトフォーム 1"]'); ?>
                <div class="contact-img contact-chara"></div>
                <div class="contact-img contact-deco contact-anime delay-02"></div>
                <div class="contact-img contact-deco02 contact-anime delay-06"></div>

                </div>
        </div>


<?php get_template_part('./inc/footer'); ?>
