<section class="ranking-section">
    <div class="C_ranking-title">
        <h3 class="TL">転職サイト人気ランキング</h3>
    </div>

    <div class="C_ranking-overview">

        <?php $args = array(
            'post_type' => array('post'),
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
        ?>
            <ul class="C_ranking-overview--lists">

                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $args = array(
                    'posts_per_page' => 5,
                    'paged' => $paged,
                    'post_type' => array('post'),
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()):
                    $counter = 1; // Initialize counter
                    while ($the_query->have_posts()):
                        $the_query->the_post();
                ?>
                        <li class="list">
                            <div class="list--inner">
                                <div class="C_flag-number flag-0<?php echo $counter; ?>">
                                    <img class="TX" src="<?php echo get_template_directory_uri(); ?>/img/flag-number-<?php echo $counter; ?>.svg" alt="<?php echo $counter; ?>">
                                </div>
                                <div class="title">
                                    <h4 class="TL"><?php the_title(); ?></h4>
                                </div>
                                <div class="star">
                                    <div class="img"></div>
                                    <p class="TX"><?php echo post_custom('site-score'); ?></p>
                                </div>
                                <a href="#detail-0<?php echo $counter; ?>" class="link">
                                    <p class="TX">詳細はこちら</p>
                                </a>
                            </div>
                        </li>
                        <?php $counter++;
                        ?>
                <?php endwhile;
                endif; ?>

            <?php else: ?>
                <p>ランキング情報はまだありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            </ul>
    </div>


    <?php $args = array(
        'post_type' => array('post'),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()):
    ?>
        <div class="detail-container">

            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = array(
                'posts_per_page' => 5,
                'paged' => $paged,
                'post_type' => array('post'),
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()):
                $counter = 1; // Initialize counter
                while ($the_query->have_posts()):
                    $the_query->the_post();
            ?>

                    <div class="C_ranking-detail" id="detail-0<?php echo $counter; ?>">


                        <div class="C_flag-number flag-0<?php echo $counter; ?>">
                            <img class="TX" src="<?php echo get_template_directory_uri(); ?>/img/flag-number-<?php echo $counter; ?>.svg" alt="<?php echo $counter; ?>">
                        </div>

                        <div class="C_ranking-detail--inner">

                            <div class="C_ranking-top">
                                <div class="title">
                                    <h4 class="TL"><?php the_title(); ?></h4>
                                    <div class="TX"><?php echo post_custom('site-text'); ?></div>
                                </div>
                                <div class="total_rating">
                                    <p class="TX-top">総合評価</p>
                                    <div class="star">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                        <p class="TX"><?php echo post_custom('site-score'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="C_ranking-contents">
                                <a class="site-img" href="<?php echo post_custom('site-url'); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    $scf_field = SCF::get('site-img-pc');
                                    $pc_image_url = wp_get_attachment_url($scf_field);
                                    if (empty($pc_image_url)) {
                                        $pc_image_url = get_template_directory_uri() . '/img/noimage.png';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($pc_image_url); ?>" class="pc" alt="サイト画像">

                                    <?php
                                    $scf_field = SCF::get('site-img-sp');
                                    $sp_image_url = wp_get_attachment_url($scf_field);
                                    if (empty($sp_image_url)) {
                                        $sp_image_url = get_template_directory_uri() . '/img/noimage.png';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($sp_image_url); ?>" class="sp" alt="サイト画像">
                                </a>
                                <div class="site-contents">
                                    <div class="title">
                                        <h5 class="TL"><?php the_title(); ?>の特徴</h5>
                                    </div>
                                    <div class="text">
                                        <ul class="lists">

                                            <?php
                                            $site_feature = SCF::get('site-feature');
                                            foreach ($site_feature as $fields) {
                                            ?>
                                                <li class="list">
                                                    <p class="TX"><?php echo $fields['site-feature-text']; ?></p>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="C_ranking-tab">
                                <div class="tab">
                                    <div class="tab--item active">
                                        <p class="TX">総合</p>
                                    </div>
                                    <div class="tab--item">
                                        <p class="TX">取り扱い求人</p>
                                    </div>
                                    <div class="tab--item">
                                        <p class="TX">サービス内容</p>
                                    </div>
                                </div>
                                <div class="contents">
                                    <!-- 1 -->
                                    <div class="contents--item active">
                                        <!-- 1-1 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">オススメ度</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <div class="stars">
                                                        <?php
                                                        $job_business_style = post_custom('site-recommended-degree');

                                                        if ($job_business_style === 'star0') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star05') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star1') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star15') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star2') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star25') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star3') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star35') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star4') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($job_business_style === 'star45') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-half.svg" alt="星半分">
                                                        <?php
                                                        } elseif ($job_business_style === 'star5') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/star-full.svg" alt="星">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="TX TX--star"><?php echo post_custom('site-score'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 1-2 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">求人数</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <div class="job-offer">
                                                        <?php
                                                        $job_business_style = post_custom('site-job_offer-icon');

                                                        if ($job_business_style === 'true01') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                        <?php
                                                        } elseif ($job_business_style === 'true02') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                        <?php
                                                        } elseif ($job_business_style === 'true03') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">

                                                        <?php
                                                        } elseif ($job_business_style === 'true04') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">

                                                        <?php
                                                        } elseif ($job_business_style === 'false') {
                                                        ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="TX"><?php echo post_custom('site-job_offer'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 1-3 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">業務形態</p>
                                            </div>
                                            <div class="evaluation">
                                                <?php
                                                $job_business_style = post_custom('site-job-business_style');

                                                if ($job_business_style === 'true') {
                                                ?>
                                                    <div class="evaluation--item gap-mini">
                                                        <div class="working-style">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ranking-working-style-on.svg" alt="あり">
                                                        </div>
                                                        <p class="TX">常勤(夜勤あり)</p>
                                                    </div>
                                                <?php
                                                } elseif ($job_business_style === 'false') {
                                                ?>
                                                    <div class="evaluation--item gap-mini">
                                                        <div class="working-style">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ranking-working-style-off.svg" alt="なし">
                                                        </div>
                                                        <p class="TX">常勤(夜勤なし)</p>
                                                    </div>
                                                <?php
                                                } elseif ($job_business_style === 'both') {
                                                ?>
                                                    <div class="evaluation--item gap-mini">
                                                        <div class="working-style">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ranking-working-style-on.svg" alt="あり">
                                                        </div>
                                                        <p class="TX">常勤(夜勤あり)</p>
                                                    </div>
                                                    <div class="evaluation--item gap-mini">
                                                        <div class="working-style">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ranking-working-style-off.svg" alt="なし">
                                                        </div>
                                                        <p class="TX">常勤(夜勤なし)</p>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2 -->
                                    <div class="contents--item">
                                        <!-- 2-1 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">求人職種</p>
                                            </div>
                                            <div class="evaluation align-contents">
                                                <?php
                                                $site_job_category = SCF::get('site-job_category');

                                                if (!empty($site_job_category)) {
                                                    foreach ($site_job_category as $category) {
                                                        if ($category === 'se') {
                                                ?>
                                                            <div class="evaluation--item gap-mini">
                                                                <div class="job_category">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/se.svg" alt="正看護師">
                                                                </div>
                                                                <p class="TX">正看護師</p>
                                                            </div>
                                                        <?php
                                                        } elseif ($category === 'jun') {
                                                        ?>
                                                            <div class="evaluation--item gap-mini">
                                                                <div class="job_category">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/jun.svg" alt="准看護師">
                                                                </div>
                                                                <p class="TX">准看護師</p>
                                                            </div>
                                                        <?php
                                                        } elseif ($category === 'ho') {
                                                        ?>
                                                            <div class="evaluation--item gap-mini">
                                                                <div class="job_category">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/ho.svg" alt="保健師">
                                                                </div>
                                                                <p class="TX">保健師</p>
                                                            </div>
                                                        <?php
                                                        } elseif ($category === 'jo') {
                                                        ?>
                                                            <div class="evaluation--item gap-mini">
                                                                <div class="job_category">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/jo.svg" alt="助産師">
                                                                </div>
                                                                <p class="TX">助産師</p>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!-- 2-2 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">非公開求人</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <div class="private-job-offer">
                                                        <?php
                                                        $site_private_job_offer_icon = post_custom('site-private_job_offer-icon');

                                                        if ($site_private_job_offer_icon === 'true01') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                        <?php
                                                        } elseif ($site_private_job_offer_icon === 'true02') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                        <?php
                                                        } elseif ($site_private_job_offer_icon === 'true03') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">

                                                        <?php
                                                        } elseif ($site_private_job_offer_icon === 'true04') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">

                                                        <?php
                                                        } elseif ($site_private_job_offer_icon === 'false') {
                                                        ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="TX"><?php echo post_custom('site-private_job_offer'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 2-3 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">転職時期</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <p class="TX"><?php echo post_custom('site-job_change_period'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3 -->
                                    <div class="contents--item">
                                        <!-- 3-1 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">対応エリア</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <div class="fix-area">
                                                        <?php
                                                        $site_fix_area_icon = post_custom('site-fix-area-icon');

                                                        if ($site_fix_area_icon === 'true01') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true02') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true03') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">

                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true04') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">

                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'false') {
                                                        ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="TX"><?php echo post_custom('site-fix-area'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 3-2 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">登録料</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <div class="register-fee">
                                                        <?php
                                                        $site_register_fee_icon = post_custom('site-register-fee-icon');

                                                        if ($site_register_fee_icon === 'true01') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                        <?php
                                                        } elseif ($site_register_fee_icon === 'true02') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                        <?php
                                                        } elseif ($site_register_fee_icon === 'true03') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">

                                                        <?php
                                                        } elseif ($site_register_fee_icon === 'true04') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">

                                                        <?php
                                                        } elseif ($site_register_fee_icon === 'false') {
                                                        ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="TX"><?php echo post_custom('site-register-fee'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 3-3 -->
                                        <div class="category">
                                            <div class="title">
                                                <p class="TX">特徴</p>
                                            </div>
                                            <div class="evaluation">
                                                <div class="evaluation--item">
                                                    <p class="TX"><?php echo post_custom('site-feature'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <a href="<?php echo post_custom('site-url'); ?>" class="C_ranking-btn" target="_blank" rel="noopener noreferrer">
                                <div class="text">
                                    <p class="TX">レバウェル看護の詳細を見る</p>
                                    <p class="TX--sub">（公式サイトへ）</p>
                                </div>
                                <div class="deco">
                                    <div class="img loopScale"></div>
                                    <div class="radius">
                                        <div class="arrow"></div>
                                    </div>
                                </div>
                            </a>

                            <div class="C_ranking-review">
                                <div class="title">
                                    <h5 class="TL">レバウェル看護の口コミ</h5>
                                </div>

                                <div class="reviews">
                                    <ul class="reviews--lists">


                                        <?php
                                        $siteReviews = SCF::get('site-reviews');
                                        foreach ($siteReviews as $fields) {
                                            $site_review_star = $fields['site-review-star']; 
                                        ?>
                                            <li class="list">
                                                <div class="list--inner">
                                                    <div class="review_stars">
                                                        <?php
                                                        if ($site_review_star === 'star0') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star05') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star1') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star15') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star2') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star25') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star3') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star35') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-half.svg" alt="星半分">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star4') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-none.svg" alt="星なし">
                                                        <?php
                                                        } elseif ($site_review_star === 'star45') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star-half.svg" alt="星半分">
                                                        <?php
                                                        } elseif ($site_review_star === 'star5') {
                                                        ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/review-star.svg" alt="星">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="review_title">
                                                        <p class="TX"><?php echo $fields['site-review-title']; ?></p>
                                                    </div>
                                                    <div class="review_text">
                                                        <p><?php echo $fields['site-review-text']; ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>


                                    </ul>
                                </div>

                                <div class="more">
                                    <p class="TX">すべての口コミを見る</p>
                                </div>

                                <div class="deco">
                                    <div class="img loop"></div>
                                </div>

                            </div>

                            <a href="<?php echo post_custom('site-url'); ?>" class="C_ranking-btn" target="_blank" rel="noopener noreferrer">
                                <div class="text">
                                    <p class="TX">レバウェル看護の詳細を見る</p>
                                    <p class="TX--sub">（公式サイトへ）</p>
                                </div>
                                <div class="deco">
                                    <div class="img loopScale"></div>
                                    <div class="radius">
                                        <div class="arrow"></div>
                                    </div>
                                </div>
                            </a>

                        </div>


                    </div>

                    <?php $counter++;
                    ?>
            <?php endwhile;
            endif; ?>

        <?php else: ?>
            <p>ランキング情報はまだありません。</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

        </div>
</section>