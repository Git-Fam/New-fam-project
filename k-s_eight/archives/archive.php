<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="works">
    <section class="works__works">
        <div class="C_worksCategory">
            <ul class="list">
                <li class="item is-active">
                    <div class="item--inner">
                        <p class="TX">すべて</p>
                    </div>
                </li>
                <li class="item">
                    <div class="item--inner">
                        <p class="TX">足場(塗装　改修工事)</p>
                    </div>
                </li>
                <li class="item">
                    <div class="item--inner">
                        <p class="TX">アパートの塗装・防水</p>
                    </div>
                </li>
                <li class="item">
                    <div class="item--inner">
                        <p class="TX">内装工事リノベーション</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="C_worksPosts">

            <?php if (have_posts()) : ?>

                <ul class="list">

                    <?php while (have_posts()) : the_post(); ?>
                        <li class="item">
                            <div class="img__area">
                                <div class="card--img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/s_01-b.jpg" alt="">
                                    <div class="card--img--title">
                                        <p class="TL">BEFORE</p>
                                    </div>
                                </div>
                                <div class="card--img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/s_01-a.jpg" alt="">
                                    <div class="card--img--title">
                                        <p class="TL">AFTER</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category__area">
                                <h3 class="TX">足場</h3>
                                <h3 class="TX">改修工事</h3>
                            </div>
                            <div class="text__area">
                                <p class="TX"><?php the_excerpt(); ?></p>
                            </div>
                        </li>
                        
                    <?php endwhile; ?>

                </ul>
            <?php else : ?>
                <p>準備中です。しばらくお待ちください。</p>
            <?php endif; ?>
        </div>
    </section>
</div>


<?php get_template_part('./inc/footer'); ?>