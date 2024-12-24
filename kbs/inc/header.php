<header class="header">
    <div class="header--inner">
        <div class="header--logo">
            <a href="<?php echo get_home_url(); ?>">
                <h1 class="TL">
                    <img class="hover-opa" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="PAINT & REFORM KBS">
                </h1>
            </a>
        </div>
        <div class="burger sp">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header--nav">
            <nav class="nav">
                <ul class="links">
                    <li><a href="<?php echo get_home_url(); ?>/contact">お問い合わせ</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/recruit">採用情報</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/example">施工事例</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/business">事業内容</a></li>
                    <li><a href="<?php echo get_home_url(); ?>/about-us">会社概要</a></li>
                </ul>
                <ul class="sns">
                    <li><a href="tel:042-378-2111">042-378-2111</a></li>
                    <li><a href="https://www.instagram.com/kiribisou/profilecard/?igsh=Z3U3eDluM3A2YzAw" target="_blank" rel="noopener noreferrer">instagram</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="whopper">
    <?php get_template_part('./inc/kv'); ?>