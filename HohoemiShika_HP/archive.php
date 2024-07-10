<?php get_header(); ?>

<main>
    <div class="page-archive">


        <div class="C_archive">
            <ul class="C_archive--lists">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <li>
                            <a class="hover-opa" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                <div class="archive__commons">
                                    <div class="tag">ブログ</div>
                                    <p class="time"><?php the_time('Y.m.d'); ?></p>
                                </div>
                                <div class="archive__content">
                                    <h3 class="TL"><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </li>
                <?php endwhile;
                endif; ?>
                <?php if (!have_posts()) : ?>
                    <p>まだ投稿がありません。</p>
                <?php endif; ?>
            </ul>

            <!-- ページネーション -->
            <div class="pageNation">
                
            </div>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>