<?php get_header(); ?>
        
        <!-- top -->
        <div class="top--wapper">
        
            <!-- top--result -->
            <section class="top--result">
            <div class="top--result--subTitle">
                    <p>
                        お悩みの症状に<br>
                        効果のある治療を行います
                    </p>
                </div>
                <div class="top--result--title">
                    <h2><span>ずっと通う必要の<br class="sp">ない治療院</span></h2>
                </div>
                <div class="top--result--text">
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                    </p>
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                    </p>
                </div>
                <a href="<?php bloginfo('url'); ?>/#" target="_blank" rel="noopener noreferrer" class="top--result--banner"></a>
    
    
            </section>
    
            <!-- top--point -->
            <section class="top--point">
                <div class="top--point--wap">
                    <div class="C_point">
                        <!-- 1 -->
                        <div class="C_point--item">
                            <div class="C_point--item--No">1</div>
                            <div class="C_point--item--title">
                                <p>開院から名古屋で44年</p>
                                <h2>歴史ある治療院</h2>
                            </div>
                            <div class="C_point--item--img"></div>
                            <div class="C_point--item--text">
                                <p>
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="C_point--item">
                            <div class="C_point--item--No">2</div>
                            <div class="C_point--item--title">
                                <p>様々なお悩みに対応</p>
                                <h2>機械が充実</h2>
                            </div>
                            <div class="C_point--item--img"></div>
                            <div class="C_point--item--text">
                                <p>
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="C_point--item">
                            <div class="C_point--item--No">3</div>
                            <div class="C_point--item--title">
                                <p>交通手段が選べる</p>
                                <h2>アクセス良好</h2>
                            </div>
                            <div class="C_point--item--img"></div>
                            <div class="C_point--item--text">
                                <p>
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    
            <!-- top--news -->
            <section class="menu--column">
                <div class="C-link">
                    <div class="C-title C-title--white">
                        <h2>NEWS</h2>
                    </div>

                    <?php
                    $args = array(
                        'posts_per_page' => 15,
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                        'post_type' => array('blog', 'post'),
                    );

                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) :
                    ?>

                        <div class="C-link--content multiple-items">

                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                <a href="<?php the_permalink(); ?>" class="C-link--content--item hover-opa"
                                style="background-image: url(<?php if (has_post_thumbnail()) {
                                    the_post_thumbnail_url('large');
                                } else {
                                    echo get_template_directory_uri() . '/img/thumbnail.png';
                                } ?>);">
                                    <div class="C-link--content--item--title">NEWS</div>
                                    <p class="C-link--content--item--text"><?php the_title(); ?></p>
                                </a>

                            <?php endwhile; ?>

                        </div>

                    <?php else : ?>
                        <p class="no-message">まだ投稿がありません。</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </section>

    
            <!-- top--trouble -->
            <section class="top--trouble">
                <div class="top--trouble--wap">
                    <div class="title">
                        <h2>こんな症状に<br class="sp">お悩みではありませんか？</h2>
                    </div>
                    <div class="C_trouble">
                        <!-- 1 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症</p>
                            </div>
                        </div>
        
                        <!-- 2 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症<br>不眠症</p>
                            </div>
                        </div>
        
                        <!-- 3 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症</p>
                            </div>
                        </div>
        
                        <!-- 4 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症<br>不眠症</p>
                            </div>
                        </div>
        
                        <!-- 5 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症</p>
                            </div>
                        </div>
        
                        <!-- 6 -->
                        <div class="C_trouble--item">
                            <div class="C_trouble--item--icon">
                                <div class="C_trouble--item--icon--img"></div>
                            </div>
                            <div class="C_trouble--item--text">
                                <p>不眠症<br>不眠症</p>
                            </div>
                        </div>
        
                    </div>
                </div>
            </section>
    
            <!-- top--news -->
            <section class="top--news">
                <div class="C-title">
                    <h2>MENU</h2>
                </div>
                <div class="C-menu">
                    <div class="C-menu--content">
                        <!-- 1 -->
                        <div class="C-menu--content--item">
                            <div class="C-menu--content--item--img"></div>
                            <div class="C-menu--content--item--text">
                                <h3 class="text-h">美容鍼</h3>
                                <p class="text-p">
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                                <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="C-menu--content--item">
                            <div class="C-menu--content--item--img"></div>
                            <div class="C-menu--content--item--text">
                                <h3 class="text-h">美容鍼</h3>
                                <p class="text-p">
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                                <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="C-menu--content--item">
                            <div class="C-menu--content--item--img"></div>
                            <div class="C-menu--content--item--text">
                                <h3 class="text-h">美容鍼</h3>
                                <p class="text-p">
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                                <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="C-menuSub">
    
                    <!-- 1 -->
                    <div class="C-menuSub--item">
                        <div class="C-menuSub--item--img"></div>
                        <p class="C-menuSub--p">ハーブピーリング</p>
                        <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                            <p>MORE</p>
                            <span></span>
                        </a>
                    </div>
    
                    <!-- 2 -->
                    <div class="C-menuSub--item">
                        <div class="C-menuSub--item--img"></div>
                        <p class="C-menuSub--p">一般治療</p>
                        <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                            <p>MORE</p>
                            <span></span>
                        </a>
                    </div>
    
                    <!-- 3 -->
                    <div class="C-menuSub--item">
                        <div class="C-menuSub--item--img"></div>
                        <p class="C-menuSub--p">生理痛・PMS治療</p>
                        <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                            <p>MORE</p>
                            <span></span>
                        </a>
                    </div>
    
                    <!-- 4 -->
                    <div class="C-menuSub--item">
                        <div class="C-menuSub--item--img"></div>
                        <p class="C-menuSub--p">便秘治療</p>
                        <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                            <p>MORE</p>
                            <span></span>
                        </a>
                    </div>
    
                    <!-- 5 -->
                    <div class="C-menuSub--item">
                        <div class="C-menuSub--item--img"></div>
                        <p class="C-menuSub--p">禁煙治療</p>
                        <a href="<?php bloginfo('url'); ?>/menu" class="C-btn hover-opa">
                            <p>MORE</p>
                            <span></span>
                        </a>
                    </div>
    
                </div>
            </section>
    
            <!-- top--staff-reserve -->
            <section class="top--staff-reserve">
                <div class="top--staff-reserve--wap">
    
                    <!-- staff -->
                    <div class="top--staff">
                        <div class="C-title">
                            <h2>STAFF</h2>
                        </div>
                        <div class="top--staff--item">
                            <div class="top--staff--item--title"></div>
                            <div class="top--staff--item--tag"></div>
                            <div class="top--staff--item--text">
                                <p>
                                    この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                </p>
                            </div>
                        </div>
                        <div class="top--staff--state">
                            <!-- 1 -->
                            <div class="top--staff--state--item">
                                <div class="flex">
                                    <div class="img"></div>
                                    <div class="flex-in">
                                        <div class="name">
                                            <p>山田 太郎</p>
                                        </div>
                                        <div class="space">
                                            <p>空き状況</p>
                                        </div>
                                        <div class="mainText">
                                            <p>
                                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
            
                                            <p>
                                                この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="favorite">
                                    <p class="favorite--title">得意な施術</p>
                                    <p class="favorite--text">
                                        この文章はダミーです。文字の大きさ、量、字間、
                                    </p>
                                </div>
                                <a href="<?php bloginfo('url'); ?>/staff" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                            <!-- 2 -->
                            <div class="top--staff--state--item">
                                <div class="flex">
                                    <div class="img"></div>
                                    <div class="flex-in">
                                        <div class="name">
                                            <p>山田 太郎</p>
                                        </div>
                                        <div class="space">
                                            <p>空き状況</p>
                                        </div>
                                        <div class="mainText">
                                            <p>
                                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
            
                                            <p>
                                                この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="favorite">
                                    <p class="favorite--title">得意な施術</p>
                                    <p class="favorite--text">
                                        この文章はダミーです。文字の大きさ、量、字間、
                                    </p>
                                </div>
                                <a href="<?php bloginfo('url'); ?>/staff" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                            <!-- 3 -->
                            <div class="top--staff--state--item">
                                <div class="flex">
                                    <div class="img"></div>
                                    <div class="flex-in">
                                        <div class="name">
                                            <p>山田 太郎</p>
                                        </div>
                                        <div class="space">
                                            <p>空き状況</p>
                                        </div>
                                        <div class="mainText">
                                            <p>
                                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
            
                                            <p>
                                                この文文字の大きさ、量、字間、行間等を確認するために入れています。
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="favorite">
                                    <p class="favorite--title">得意な施術</p>
                                    <p class="favorite--text">
                                        この文章はダミーです。文字の大きさ、量、字間、
                                    </p>
                                </div>
                                <a href="<?php bloginfo('url'); ?>/staff" class="C-btn hover-opa">
                                    <p>MORE</p>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
    
                    <!-- reserve -->
                    <div class="top--reserve">
                        <div class="C-title">
                            <h2>RESERVE
                            </h2>
                        </div>
                        <div class="top--reserve--text">
                            <p>
                                この文章はダミーです。<span>文字の大きさ、量、字間、等を確認</span>するために入れています。行間等を<span>確認</span>するために入れています。
                            </p>
                        </div>
                        <a href="<?php bloginfo('url'); ?>/#" class="C-btn hover-opa">
                            <p>ネットでのご予約はこちら</p>
                            <span></span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- top--about -->
            <section class="top--about">
                <div class="top--about--title_img"></div>
                <div class="C-title">
                    <h2>ABOUT"ao"</h2>
                </div>
                <div class="top--about--content">
                    <div class="top--about--content--img">
                        <div class="top"></div>
                        <div class="under">
                            <div class="under--left"></div>
                            <div class="under--right"></div>
                        </div>
                    </div>
                    <div class="top--about--content--items">
                        <div class="item--title">
                            <h3>
                                美容に特化した<br>
                                中部治療院の姉妹院
                            </h3>
                        </div>
                        <div class="item--text">
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量を確認するために入れています。
                            </p>
                        </div>
                        <div class="item--main">
                            <div class="item--main--top">
                                <div class="logo"></div>
                                <div class="address">
                                    <h4>aoはり治療院</h4>
                                    <p>
                                        〒460-0022<br>
                                        名古屋市中区金山3丁目12番5号<br class="sp">グランドリュイソー1F
                                    </p>
                                </div>
                            </div>
                            <div class="item--main--middle">
                                <div class="item">
                                    <span></span>
                                    <p>
                                        地下鉄「金山」駅１番出口から徒歩5分
                                    </p>
                                </div>
                                <div class="item">
                                    <span></span>
                                    <p>
                                        駐車場：店舗前に1台有 （近くにコインパーキングも有ります）
                                    </p>
                                </div>
                            </div>
                            <a href="<?php bloginfo('url'); ?>/#" class="item--main--bottom" target="_blank" rel="noopener noreferrer">
                                詳しくはaoはり資料院のホームページへ
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- top--sns -->
            <section class="top--sns">
                <!-- Instagram -->
                <div class="item">
                    <div class="C-title">
                        <h2>Instagram</h2>
                    </div>
                    <div class="comment">
                        <p>
                            インスタグラム日々更新中！<br>
                            ＠chubuchiryoin
                        </p>
                       <div class="deco">
                            <div class="ration"></div>
                            <div class="ration"></div>
                            <div class="ration"></div>
                            <div class="ration"></div>
                       </div>
                    </div>
                    <a class="sns" href="<?php bloginfo('url'); ?>/#" target="_blank" rel="noopener noreferrer"></a>

                    <div class="text">
                        <p>
                            お気軽に<span>フォロー</span>お願いします
                        </p>
                    </div>
                </div>
                <!-- LINE -->
                <div class="item">
                    <div class="C-title">
                        <h2>LINE</h2>
                    </div>
                    <div class="comment">
                        <p>
                            キャンペーン情報<br>
                            ご予約にご利用ください！
                        </p>
                        <div class="deco">
                            <div class="ration"></div>
                            <div class="ration"></div>
                            <div class="ration"></div>
                            <div class="ration"></div>
                       </div>
                    </div>
                    <a class="sns" href="<?php bloginfo('url'); ?>/#" target="_blank" rel="noopener noreferrer"></a>
                    <div class="text pc">
                        <p>
                            QRコード読み取りで<span>友達追加</span>ができます
                        </p>
                    </div>
                </div>
            </section>
            
        </div>
        <!-- top end -->

<?php get_footer(); ?> 

