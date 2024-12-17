<?php wp_footer() ?>

<footer class="footer">
    <div class="footer--inner">
        <div class="footer--contents">
            <div class="logo">
                <a href="<?php echo get_home_url(); ?>">
                        <img class="hover-opa" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="PAINT & REFORM KBS">
                </a>
            </div>
            <nav class="nav">
                <ul class="links">
                    <li><a href="<?php echo get_home_url(); ?>/about-us">会社概要</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/business">事業内容</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/example">施工事例</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/recruit">採用情報</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/contact">お問い合わせ</a></li>
                    <li class="pc">
                    <p class="TX">@2024株式会社KBS</p>
                    </li>

                </ul>
            </nav>
        </div>
    <div class="copylight">
        <p class="TX sp">@2024株式会社KBS</p>
        <p class="TX TX--small">This site is protected by reCAPTCHA and the Google<a
                href="https://policies.google.com/privacy">Privacy Policy</a> and<a
                href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
    </div>
    </div>
</footer>


</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/joint.js"></script>
</body>

</html>