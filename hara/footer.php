 <footer>
            <img src="<?php echo get_template_directory_uri(); ?>/imag/logo.png" alt="ロゴ">
            <ul class="footer__menu">
               <li class="footer__menu__main"><a href="<?php bloginfo('url'); ?>/service">事業内容</a></li>
               <li class="footer__menu__main"><a href="<?php bloginfo('url'); ?>/company">会社案内</a>
                <ul class="footer__sub--menu">
                    <li class="footer__menu__sub--main"><a href="<?php bloginfo('url'); ?>/news">お知らせ</a></li>
                    <li class="footer__menu__sub--main"><a href="<?php bloginfo('url'); ?>/trac">車両案内</a></li>
                    <li class="footer__menu__sub--main"><a href="<?php bloginfo('url'); ?>/safety">安全・環境への取り組み</a></li>
                    <li class="footer__menu__sub--main"><a href="<?php bloginfo('url'); ?>/staff">スタッフ紹介</a></li>
                    <li class="footer__menu__sub--main"><a href="<?php bloginfo('url'); ?>/privacypolicy">プライバシーポリシー</a></li>
                </ul>
                </li>
               <li class="footer__menu__main"><a href="<?php bloginfo('url'); ?>/photogallery">フォトギャラリー</a></li>
               <li class="footer__menu__main"><a href="<?php bloginfo('url'); ?>/recruit">採用情報</a></li>
               <li class="footer__menu__main"><a href="<?php bloginfo('url'); ?>/contact">お問い合わせ</a></li>
            </ul>
            <p>Copyright©︎ 2019 Harasyouji Transport Co.,Ltd.</p>
        </footer>

        <?php wp_footer() ?>
        
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src='<?php echo get_stylesheet_directory_uri(); ?>/script.js'></script>
    </body>
</html>