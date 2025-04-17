<?php wp_footer() ?>


</main>

<footer class="footer">
    <div class="footer--map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d401.1540351077385!2d139.39185946572485!3d35.551908483521906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018fdc71768c623%3A0xccf63e1ae9ab8952!2z44CSMjUyLTAyMjMg56We5aWI5bed55yM55u45qih5Y6f5biC5Lit5aSu5Yy65p2-44GM5LiY77yR5LiB55uu77yR77yY4oiS77yV!5e0!3m2!1sja!2sjp!4v1744707222703!5m2!1sja!2sjp"
            style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="footer--main">
        <div class="footer--main--containaer">
            <div class="footer__info">
                <div class="title">
                    <h2 class="TL">株式会社ケイズエイト</h2>
                </div>
                <div class="text">
                    <p class="TX">神奈川県相模原市中央区松ヶ丘1-18-5</p>
                    <a href="tel:042-707-4117" class="TX hover-opa">TEL : 042-707-4117</a>
                </div>
            </div>
            <div class="footer__menu">
                <nav class="footer__menu--nav">
                    <ul class="footer__menu--nav--list">
                        <li class="item">
                            <a href="<?php bloginfo('url'); ?>/service" class="TX hover-opa">施工サービス</a>
                        </li>
                        <li class="item">
                            <a href="<?php bloginfo('url'); ?>/works" class="TX hover-opa">施工事例</a>
                        </li>
                        <li class="item">
                            <a href="<?php bloginfo('url'); ?>/contact" class="TX hover-opa">お問い合わせ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer--main--copyright">
            <p class="TX">
                This site is protected by reCAPTCHA and the Google
                <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                <a href="https://policies.google.com/terms">Terms of Service</a> apply.
            </p>
            <p class="TX">&copy;株式会社ケイズエイト</p>
        </div>
    </div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php if (is_front_page()) : ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/front.js"></script>
<?php else : ?>
    <?php if (is_page('service') || is_page('works') || is_page('about') || is_page('contact') || is_page('contact-confirm') || is_page('contact-complete')) : ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/all-kv.js"></script>
    <?php endif; ?>
<?php endif; ?>
</body>

</html>