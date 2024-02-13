<?php get_header(); ?>
        
        <!-- flow -->
        <div class="menu--wapper">
        
            <!-- menu--general -->
            <section class="menu--general">
                <div class="C-title C-title--JP">
                    <h2>一般治療</h2>
                </div>
                <div class="menu--general--text">
                    <span>
                        身体の痛みや悩みをお持ちの方は<br>
                        まずはご相談ください！
                    </span>
                </div>

                <div class="menu--general--subText">
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。この文章はダミーです。
                    </p>

                    <p>
                        文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br>この文文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                    </p>
                </div>




            </section>

            <!-- menu--flow -->
            <section class="menu--flow">
                <div class="menu--flow--wap">
                    <div class="C-title C-title--JP">
                        <h2>施術の流れ</h2>
                    </div>
                    <div class="menu--flow--wap--content">
                        <!-- 1 -->
                        <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                         <!-- 2 -->
                         <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                         <!-- 3 -->
                         <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                         <!-- 4 -->
                         <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                        <!-- 5 -->
                        <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                         <!-- 6 -->
                         <div class="item">
                            <div class="number"></div>
                            <div class="img"></div>
                            <h3>借りテキスト</h3>
                            <p>
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために配置しています。
                            </p>
                        </div>

                    </div>
                </div>
            </section>

            <!-- menu--column -->
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



            <!-- menu--fee -->
            <section class="menu--fee">
                <div class="campaign--tag pc"></div>
                <div class="C-title C-title--JP">
                    <h2>料金表</h2>
                </div>
                <div class="menu--fee--campaign">
                    <p>
                        ただいまキャンペーン中！
                    </p>
                </div>
                <div class="menu--fee--text">
                    <p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認する</p>
                    <p>ために入れています。この文文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。</p>
                </div>

                <div class="menu--fee--content">
                    <!-- 1 -->
                    <div class="item">
                        <h3>治療75分</h3>
                        <p class="normal">通常22,000円のところ</p>
                        <p class="special">半額/11,000円（税込）</p>
                    </div>

                    <!-- 2 -->
                    <div class="item">
                        <h3>治療90分</h3>
                        <p class="normal">通常22,000円のところ</p>
                        <p class="special">半額/11,000円（税込）</p>
                    </div>

                </div>
            </section>
            
        </div>
        <!-- menu end -->

<?php get_footer(); ?>