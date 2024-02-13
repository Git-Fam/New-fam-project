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

                        <!-- 投稿により年が増えるように -->
                            <ul class="year">
                                <?php 
                                    if (have_posts()):
                                    while (have_posts()):
                                    the_post(); 
                                ?>
                                <li class="year--list">
                                    <p class="year--list--title"><?php the_time('Y'); ?><span>▲</span></p>
                                    <ul class="month">
                                        <li class="month--list">
                                            <!-- 年代別一覧へ飛ばせるように -->
                                        <a class="month--list--title" href="<?php bloginfo('url'); ?>/blog"><?php the_time('m'); ?>月<span>(
                                            <?php
                                                $year = get_the_time('Y');
                                                $month = get_the_time('m');
                                                $lastposts = get_posts('year=' . $year . '&monthnum=' . $month);
                                                echo count($lastposts);
                                            ?>
                                            )</span></a>

                                        </li>  
                                    </ul>
                                </li>
                                <?php endwhile; endif; ?>
                            </ul>


                        </div>
                    </aside>
                </div>
            </section>
            
        </div>
        <!-- article end -->

<?php get_footer(); ?>