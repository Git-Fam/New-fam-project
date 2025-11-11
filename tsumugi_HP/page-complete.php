<?php
/*
Template Name: complete
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>
    <main>
        <div class="page contact-page">
            <div class="complete-inner">
                <div class="C_KV-title type-02">
                    <div class="icon"></div>
                    <h2 class="TL">送信完了しました</h2>
                </div>

                <p class="TX">
                    お問い合わせいただき<br class="sp">ありがとうございます。<br />
                    お問い合わせ内容確認の上、<br class="sp">近日中にご返信させていただきます。 
                </p>

                <a href="<?php echo home_url(); ?>" class="link hover-opa">
                    <p class="link-TX">戻る</p>
                </a>
                <div class="complate-img"></div>
            </div>
        </div>
    </main>

<?php get_template_part('./inc/footer'); ?>
