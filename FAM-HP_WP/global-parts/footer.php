<!-- CONTACT バナー -->
<section class="contact-ban">
    <a href="<?php echo get_home_url(); ?>/contact" class="contact-ban__inner">
        <!-- 背景動画 -->
        <video class="contact-ban__video" autoplay muted loop playsinline>
            <source src="<?php echo get_template_directory_uri(); ?>/img/global/contact-bg02.mp4" type="video/mp4">
        </video>
        <div class="contact-ban__body">
            <p class="contact-ban__title">CONTACTUS</p>
            <p class="contact-ban__text">ご依頼・ご相談などのお問い合わせはこちら。<br>お気軽にお問い合わせください。</p>
        </div>
    </a>
</section>

<!-- フッター -->
<footer class="footer">
    <div class="footer__inner">
        <div class="footer__left">
            <a href="<?php echo get_home_url(); ?>" class="footer__logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/global/fam_logo_w.png" alt="FAM">
            </a>
            <p class="footer__copy">© 2026 FAM</p>
        </div>
        <nav class="footer__nav">
            <a href="<?php echo get_home_url(); ?>/company" class="footer__nav-item">COMPANY</a>
            <a href="<?php echo get_home_url(); ?>/business" class="footer__nav-item">BUSINESS</a>
            <a href="<?php echo get_home_url(); ?>/careers" class="footer__nav-item">CAREERS</a>
            <a href="<?php echo get_home_url(); ?>/contact" class="footer__nav-item">CONTACT</a>
            <a href="https://twostone-s.com/privacy/" class="footer__nav-item" target="_blank" rel="noopener noreferrer">PRIVACY POLICY</a>
            <a href="https://twostone-s.com/external-transmissions/" class="footer__nav-item" target="_blank" rel="noopener noreferrer">EXTERNAL TRANSMISSIONS</a>
            <a href="https://twostone-s.com/antisocial-forces/" class="footer__nav-item" target="_blank" rel="noopener noreferrer">ANTISOCIAL FORCES</a>
        </nav>
    </div>
</footer>

<?php wp_footer() ?>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/joint.js"></script>
</body>

</html>