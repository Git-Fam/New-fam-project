<?php get_header(); ?>
        
        <!-- article -->
        <div class="article--wapper">

            <section class="article--article">

                <div class="article--article--inner">

                    <div class="article--content">

                    <?php 
                        if (have_posts()):
                        while (have_posts()):
                        the_post(); 
                    ?>

                        <div class="blog--title">
                            <h3><?php the_title();?></h3>
                        </div>

                        <img class="blog--thumbnail" src="
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail_url('large');
                            } else {
                                echo get_template_directory_uri() . '/img/thumbnail.png';
                            } ?>" alt="サムネイル">

          
                        <div class="blog--text">
                            <p><?php the_content(); ?></p>
                        </div>

                        <?php endwhile; endif; ?>

                        <div class="page--nation">
                            <a href="<?php bloginfo('url'); ?>/blog" class="page--back">ブログ一覧に戻る</a>
                            <div class="page--nav">
                                <div class="page--nav--btn">
                                    <div>
                                        <span></span>
                                    </div>
                                    <?php if (get_next_post()): ?>
                                        <?php next_post_link('%link', '次のタイトル'); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="page--nav--btn">
                                    <div>
                                        <span></span>
                                    </div>
                                    <?php if (get_previous_post()): ?>
                                        <?php previous_post_link('%link', '前のタイトル'); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- side -->
                    <aside class="article--aside">
                        <div class="article--aside--title">
                            <p>ARCHIVE</p>
                            <p>アーカイブ</p>
                        </div>

                        <div class="article--aside--content">


                            <!-- 投稿により年第によりが増えるように -->
                            <ul class="year">
                                    <?php
                                        $args = array(
                                            'posts_per_page' => -1, // すべての投稿を取得
                                        );
                                        $blog_query = new WP_Query($args);

                                        // 取得した投稿から年数を抽出
                                        $years = array();
                                        if ($blog_query->have_posts()) :
                                            while ($blog_query->have_posts()) :
                                                $blog_query->the_post();
                                                $years[] = get_the_time('Y');
                                            endwhile;
                                            $years = array_unique($years); // 重複を削除
                                            rsort($years); // 年数を逆順にソート
                                        endif;
                                        wp_reset_postdata();

                                        // 年ごとにリストを表示
                                        foreach ($years as $year) :
                                            // 年ごとの投稿を取得
                                            $year_posts = get_posts(array('year' => $year));
                                            if (count($year_posts) > 0) : // 投稿がある場合のみ表示
                                    ?>
                                    <li class="year--list">
                                        <p class="year--list--title"><?php echo $year; ?><span>▲</span></p>
                                        <ul class="month">
                                            <?php
                                            // 年ごとに月ごとのリンクを表示
                                            for ($month = 1; $month <= 12; $month++) :
                                                // 月ごとの投稿を取得
                                                $month_posts = get_posts(array('year' => $year, 'monthnum' => $month));
                                                if (count($month_posts) > 0) : // 投稿がある場合のみ表示
                                            ?>
                                                    <li class="month--list">
                                                        <a class="month--list--title" href="<?php echo get_month_link($year, $month); ?>">
                                                            <?php echo $month; ?>月<span>(
                                                                <?php
                                                                echo count($month_posts);
                                                                ?>
                                                            )</span>
                                                        </a>
                                                    </li>
                                            <?php endif; endfor;?>
                                        </ul>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>

                        </div>
                    </aside>
                </div>
            </section>
            
        </div>
        <!-- article end -->

<?php get_footer(); ?>