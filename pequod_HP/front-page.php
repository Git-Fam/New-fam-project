<?php get_header(); ?>

<div class="front-page">
    <section class="Front_Vision">
        <div class="C_FrontVision">
            <div class="C_FrontVision--inner">
                <div class="title">
                    <div class="C_TL type01">
                        <p class="C_TL_deco">
                            <span class="js-g01">事</span>
                            <span class="js-g01">業</span>
                            <span class="js-g01">展</span>
                            <span class="js-g01">開</span>
                        </p>
                        <h3 class="C_TL_main">
                            <span class="js-g01">V</span>
                            <span class="js-g01">I</span>
                            <span class="js-g01">S</span>
                            <span class="js-g01">I</span>
                            <span class="js-g01">O</span>
                            <span class="js-g01">N</span>
                        </h3>
                    </div>
                </div>
                <div class="content">
                    <div class="text">
                        <p class="TX">1000年<br class="sp">愛され続ける組織</p>
                    </div>
                    <div class="img Sunny"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="Front_Topics">
        <div class="C_FrontTopics">
            <div class="C_FrontTopics--inner">
                <div class="title">
                    <div class="C_TL type01">
                        <p class="C_TL_deco">
                            <span class="js-g01">新</span>
                            <span class="js-g01">着</span>
                            <span class="js-g01">情</span>
                            <span class="js-g01">報</span>
                        </p>
                        <h3 class="C_TL_main">
                            <span class="js-g01">T</span>
                            <span class="js-g01">O</span>
                            <span class="js-g01">P</span>
                            <span class="js-g01">I</span>
                            <span class="js-g01">C</span>
                            <span class="js-g01">S</span>
                        </h3>
                    </div>
                </div>
                <div class="container">
                    <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = array(
                        'posts_per_page' => 3,
                        'paged' => $paged,
                        'post_type' => array('topics', 'post'),
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) :
                    ?>
                        <ul class="lists">
                            <?php
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                            ?>
                                <li>
                                    <a class="hover-opa" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <p class="date"><?php the_time('Y.m.d'); ?></p>
                                        <h4 class="TL"><?php the_title(); ?></h4>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else : ?>
                        <p>まだ投稿がありません。</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="Front_Service">
        <div class="C_FrontService">
            <div class="C_FrontService--inner">
                <div class="container">
                    <div class="title">
                        <div class="C_TL type01">
                            <p class="C_TL_deco">
                                <span class="js-g01">事</span>
                                <span class="js-g01">業</span>
                                <span class="js-g01">内</span>
                                <span class="js-g01">容</span>
                            </p>
                            <h3 class="C_TL_main">
                                <span class="js-g01">S</span>
                                <span class="js-g01">E</span>
                                <span class="js-g01">R</span>
                                <span class="js-g01">V</span>
                                <span class="js-g01">I</span>
                                <span class="js-g01">C</span>
                                <span class="js-g01">E</span>
                            </h3>
                        </div>
                    </div>
                    <div class="subTitle">
                        <p class="TL">
                            ウォーターサーバー事業
                        </p>
                    </div>
                    <div class="text">
                        <p class="TX">
                            安心で安全な「お水」に対する人々の関心がますます高まるなか、<br class="pc">天然の良質なミネラルウォーターを販売する事業を展開しております。<br class="pc">弊社では、ウォーターサーバー業界に精通したメンバーが中心となり、<br class="pc">全国の大型商業施設で、ワンウェイタイプ（使い捨てタイプ）と浄水型<br class="pc">ウォーターサーバーの、
                            イベント・PRを行っております。
                        </p>
                    </div>
                </div>
                <a class="C_ViewMore" href="<?php bloginfo('url'); ?>/service">
                    <p class="TX">view more</p>
                </a>
            </div>
        </div>
    </section>
    <section class="Front_AtWater">
        <div class="C_AtWater">
            <div class="content">
                <h3 class="TL">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/C_AtWater.svg" alt="at water">
                </h3>
                <div class="text">
                    <p class="TX">
                        pequodは、”アルウォーター”の<br class="sp">販売を行っております。<br>
                        私たちは、まさにこの「お水」のように<br>
                        型にはまることなく自在に<br class="sp">変化をしながら、お水で生活を豊かにし、<br>
                        お水で社会に貢献していきたいと<br class="sp">考えています。
                    </p>
                </div>
                <a class="C_ViewMore" href="<?php bloginfo('url'); ?>/coming-soon" target="_blank" rel="noopener noreferrer">
                    <p class="TX">view more</p>
                </a>

            </div>
            <div class="hover-bubbles">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
            </div>
        </div>
    </section>
    <section class="Front_Links">
        <div class="C_Links">
            <div class="C_TL type01">
                <p class="C_TL_deco">
                    <span class="js-g01">会</span>
                    <span class="js-g01">社</span>
                    <span class="js-g01">概</span>
                    <span class="js-g01">要</span>
                </p>
                <h3 class="C_TL_main">
                    <span class="js-g01">C</span>
                    <span class="js-g01">O</span>
                    <span class="js-g01">M</span>
                    <span class="js-g01">P</span>
                    <span class="js-g01">A</span>
                    <span class="js-g01">N</span>
                    <span class="js-g01">Y</span>
                </h3>
            </div>
            <div class="C_Links--container">
                <!-- 01 -->
                <a class="card img01" href="<?php bloginfo('url'); ?>/company/#greeting">
                    <div class="card--bar"></div>
                    <div class="title">
                        <h4 class="TL">代表挨拶</h4>
                    </div>
                    <div class="enTitle pc">
                        <p class="TX">GREETING</p>
                    </div>
                </a>
                <!-- 02 -->
                <a class="card img02" href="<?php bloginfo('url'); ?>/company/#profile">
                    <div class="card--bar"></div>
                    <div class="title">
                        <h4 class="TL">会社概要</h4>
                    </div>
                    <div class="enTitle pc">
                        <p class="TX">PROFILE</p>
                    </div>
                </a>
                <!-- 03 -->
                <a class="card img03" href="<?php bloginfo('url'); ?>/company/#access">
                    <div class="card--bar"></div>
                    <div class="title">
                        <h4 class="TL">アクセス</h4>
                    </div>
                    <div class="enTitle pc">
                        <p class="TX">ACCESS</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>