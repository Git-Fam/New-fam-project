<?php wp_footer() ?>

<footer class="footer">
    <div class="footer--menu">
        <nav class="footer--menu--nav">
            <ul>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>">TOP</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/terms">利用規約</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/privacy-policy">プライバシーポリシー</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/company">運営会社</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/survey">調査概要</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/edit">編集方針</a>
                </li>
                <li>
                    <a class="hover-opa" href="<?php echo get_home_url(); ?>/column">転職に関するコラム記事はこちら</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="copyright">
        <p class="TX"> © 看護師転職応援サイト</p>
    </div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/joint.js"></script>

<?php if (is_front_page() || is_page('comparison')) : ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/list-remove.js"></script>
<?php endif; ?>
</body>

</html>