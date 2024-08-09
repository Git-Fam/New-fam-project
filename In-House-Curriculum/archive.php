<?php get_header(); ?>

        <!-- archive -->
        <div class="archive">
            <div class="archive--title">
                <p class="TL">カリキュラム選択</p>
            </div>

            <a href="<?php bloginfo('url'); ?>/my" class="my--Btn" target="_blank" rel="noopener noreferrer"><p class="TX">マイページへ</p></a>



            <!-- <div class="archive--contents">
                

                <div class="archive--contents--tab">
                    <?php
                    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
                    foreach ($categories as $category):
                        // カテゴリーに対応する画像ファイル名を想定しています。実際には適切に設定してください。
                        $image_file_name = $category->slug . '.png';
                        ?>
                        <div class="archive--item">
                            <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                            <div class="archive--item--title">
                                <p class="TX"><?php echo $category->name; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="archive--contents--items">
                    <?php
                    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
                    $firstCategory = true; // 最初のカテゴリーを識別するためのフラグ
                    foreach ($categories as $category):
                        ?>
                        <div class="archive--contents--items--wap<?php if ($firstCategory) echo ' active'; // 最初のカテゴリーにのみ.activeを追加 ?>">
                            <?php
                            $args = array(
                                'category__in' => array($category->term_id),
                                'posts_per_page' => -1, // すべての投稿を取得
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()): $query->the_post();
                                    ?>
                                    <a class="archive--items" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <div class="items--img">
                                            <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.png'; ?>" alt="">
                                        </div>
                                        <div class="items--title">
                                            <p class="TL"><?php the_title(); ?></p>
                                        </div>
                                    </a>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <p>このカテゴリーには投稿がありません。</p>
                                <?php
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                        $firstCategory = false; // 最初のカテゴリー後はフラグをfalseに設定
                    endforeach;
                    ?>
                </div>

                <div class="C_character character-1"></div>

            </div> -->

            <div class="archive--contents">
                <?php if ( ! is_user_logged_in() ): ?>
                    <div class="not-login">ログインしていません</div>
                <?php else: ?>

                <div class="archive--contents--tab">
                    <?php
                    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
                    foreach ($categories as $category):
                        // カテゴリーに対応する画像ファイル名を想定しています。実際には適切に設定してください。
                        $image_file_name = $category->slug . '.png';
                        ?>
                        <div class="archive--item">
                            <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                            <div class="archive--item--title">
                                <p class="TX"><?php echo $category->name; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="archive--contents--items">
                    <?php
                    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
                    $firstCategory = true; // 最初のカテゴリーを識別するためのフラグ
                    foreach ($categories as $category):
                        ?>
                        <div class="archive--contents--items--wap<?php if ($firstCategory) echo ' active'; // 最初のカテゴリーにのみ.activeを追加 ?>">
                            <?php
                            $args = array(
                                'category__in' => array($category->term_id),
                                'posts_per_page' => -1, // すべての投稿を取得
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()): $query->the_post();
                                    ?>
                                    <a class="archive--items" href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <div class="items--img">
                                            <img class="img" src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/img/no-img.png'; ?>" alt="">
                                        </div>
                                        <div class="items--title">
                                            <p class="TL"><?php the_title(); ?></p>
                                        </div>
                                    </a>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <p>このカテゴリーには投稿がありません。</p>
                                <?php
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                        $firstCategory = false; // 最初のカテゴリー後はフラグをfalseに設定
                    endforeach;
                    ?>
                </div>

                <div class="C_character">
                    <dotlottie-player src="https://lottie.host/e60cec2b-65a9-4722-99fa-d9218781a66b/TBEXhkebbF.json" background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></dotlottie-player>
                </div>

                <?php endif; ?>
            </div>

        </div>

<?php get_footer(); ?>