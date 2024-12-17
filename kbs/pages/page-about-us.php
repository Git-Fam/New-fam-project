<?php
/*
Template Name: about-us
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="KV KV_about-us"></div>

<!-- メイン -->
<main class="main">

    <div class="main__about-us">

        <div class="section__wrapper max-size-medium">
            <div class="main__title">
                <div class="C_gra-vert-title">
                    <h2 class="TL type-02">会社概要</h2>
                </div>
            </div>
        </div>

        <section class="section_about-us_message max-size-small">
            <div class="C_about-us_message">
                <div class="img--wrapper imgAnime">
                    <img src="<?php echo get_template_directory_uri(); ?>" alt="代表取締役　桐部 貴大">
                </div>
                <div class="contents--wrapper">
                    <div class="title">
                        <h3 class="TL">代表あいさつ</h3>
                    </div>
                    <div class="text">
                        <p class="TX right delay-10">
                            私たちは創業以来、常に「安全・品質・信頼」を最優先に考え、お客様のご要望に合わせて丁寧に対応することで事業を通じて地域社会に貢献し、お客様に頼られる会社を目指しています。<br>
                            近年、建設業界はますます厳しい競争と変化の中で進化し続けていますが、当社はこれまで培った技術力と経験を活かし、どんなご依頼にも迅速かつ確実に対応してまいります。<br>
                            社員一丸となって、品質向上を目指し、常に前進していく所存です。これからもお客様と共に成長できるよう、努力を惜しまず取り組んでまいりますので、引き続きご愛顧賜りますようお願い申し上げます。
                        </p>
                    </div>
                    <div class="name">
                        <p class="TX">代表取締役　桐部 貴大</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_about-us_summary max-size-small-other">
            <div class="C_about-us_summary">
                <div class="summary--title">
                    <h3 class="TL">概要</h3>
                </div>
                <ul class="summary--contents right">
                    <li>
                        <div class="list--title">
                            <p class="TX">社名</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">株式会社KBS</p>
                        </div>
                    </li>
                    <li>
                        <div class="list--title">
                            <p class="TX">代表者名</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">桐部 貴大</p>
                        </div>
                    </li>
                    <li>
                        <div class="list--title">
                            <p class="TX">設立日</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">0000年00月00日</p>
                        </div>
                    </li>
                    <li>
                        <div class="list--title">
                            <p class="TX">住所</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">206-0823 　<br class="sp"><span>東京都稲城市平尾 2-75-4</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="list--title">
                            <p class="TX">電話番号</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">042-378-2111</p>
                        </div>
                    </li>
                    <li>
                        <div class="list--title">
                            <p class="TX">事業内容</p>
                        </div>
                        <div class="list--contents">
                            <p class="TX">一般住宅、マンション、<br class="sp"><span>アパート、テナント</span></p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="section_about-us_access">
            <div class="C_about-us_access">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3243.8447350665806!2d139.4885791120094!3d35.60689637249715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018fa53f295ce23%3A0xa9050992e9da72ee!2z44CSMjA2LTA4MjMg5p2x5Lqs6YO956iy5Z-O5biC5bmz5bC-77yS5LiB55uu77yX77yV4oiS77yU!5e0!3m2!1sja!2sjp!4v1734359101755!5m2!1sja!2sjp"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="access--inner max-size-small">
                    <div class="access--title">
                        <h3 class="TL">アクセス</h3>
                    </div>
                </div>
            </div>
        </section>

    </div>

</main>

<?php get_template_part('./inc/footer'); ?>