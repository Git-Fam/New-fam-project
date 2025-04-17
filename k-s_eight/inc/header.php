<header class="header">
    <div class="header--wapper">
        <div class="header--inner">
            <a href="<?php echo get_home_url(); ?>" class="header--logo">
                <h1 class="TL">株式会社ケイズエイト</h1>
            </a>
            <div class="burger sp">
                <div class="burger--inner">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <nav class="header--nav">
                <ul class="header--nav--list">
                    <li class="header--nav--item">
                        <a href="<?php bloginfo('url'); ?>/service" class="header--nav--link header--nav--link_js">
                            <p class="TX">施工サービス</p>
                        </a>
                    </li>
                    <li class="header--nav--item">
                        <a href="<?php bloginfo('url'); ?>/works" class="header--nav--link header--nav--link_js">
                            <p class="TX">施工事例</p>
                        </a>
                    </li>
                    <li class="header--nav--item">
                        <a href="<?php bloginfo('url'); ?>/contact" class="header--nav--link">
                            <span>お気軽にお問い合わせください！</span>
                            <p class="TX">ご相談はこちら</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="nav-bg sp"></div>
        </div>
    </div>
</header>

<div class="whopper">

    <?php get_template_part('./inc/kv'); ?>

    <main>