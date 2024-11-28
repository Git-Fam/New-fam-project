<div class="C_compare">
    <div class="C_noFrame">
        <h2 class="TL">転職サイト比較表</h2>
    </div>
    <div class="tab-wrapper">
        <div class="counter-container">
            <p class="text">
                昨日
                <span class="random-counter"></span>
                人が登録に進みました!
            </p>
        </div>
        <div class="C_compare-tab">
            <ul class="C_compare-tab-btn" id="tab-btn">
                <li class="active">
                    <p class="tab-TL">総合</p>
                </li>
                <li>
                    <p class="tab-TL">取り扱い求人</p>
                </li>
                <li>
                    <p class="tab-TL">サービス内容</p>
                </li>
            </ul>
            <div class="C_compare-tab-content">
                <?php $args = array(
                    'post_type' => array('post'),
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()):
                ?>
                    <!-- 総合 -->
                    <table class="content-01">
                        <tbody>
                            <tr>
                                <th>転職サイト名</th>
                                <th>おすすめ度</th>
                                <th>求人数</th>
                                <th>特徴</th>
                                <th>詳細</th>
                            </tr>

                            <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                            $args = array(
                                'posts_per_page' => 15,
                                'paged' => $paged,
                                'post_type' => array('post'),
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()):
                                $counter = 1; // Initialize counter
                                while ($the_query->have_posts()):
                                    $the_query->the_post();
                            ?>
                                    <tr>
                                        <td class="logo">
                                            <?php
                                            $scf_field = SCF::get('site-logo');
                                            $image_url = wp_get_attachment_url($scf_field);
                                            if (empty($image_url)) {
                                                $image_url = get_template_directory_uri() . '/img/noimage.png';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="ロゴ">

                                        </td>
                                        <td class="rating">
                                            <div class="star-box">
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
                                            <div class="rating-number"><?php echo post_custom('site-score'); ?></div>
                                        </td>
                                        <td class="good jobCount">
                                            <div class="inner">
                                                <?php
                                                $job_business_style = post_custom('site-job_offer-icon');

                                                if ($job_business_style === 'true01') {
                                                ?>
                                                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                <?php
                                                } elseif ($job_business_style === 'true02') {
                                                ?>
                                                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                <?php
                                                } elseif ($job_business_style === 'true03') {
                                                ?>
                                                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">

                                                <?php
                                                } elseif ($job_business_style === 'true04') {
                                                ?>
                                                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">

                                                <?php
                                                } elseif ($job_business_style === 'false') {
                                                ?>
                                                <?php
                                                }
                                                ?>
                                                <p class="number"><?php echo post_custom('site-job_offer'); ?></p>
                                            </div>
                                        </td>
                                        <td class="feature">
                                            <p class="TX"><?php echo post_custom('site-feature'); ?></p>
                                        </td>
                                        <td class="detail">
                                            <a href="<?php echo post_custom('site-url'); ?>" target="_blank" rel="noopener noreferrer">
                                                <p class="TX">詳細を見る</p>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php $counter++;
                                    ?>
                            <?php endwhile;
                            endif; ?>

                        <?php else: ?>
                            <p>情報はまだありません。</p>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                        </tbody>
                    </table>

                    <?php $args = array(
                        'post_type' => array('post'),
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()):
                    ?>
                        <!-- 取り扱い求人 -->
                        <table class="content-02">
                            <tbody>
                                <tr>
                                    <th>転職サイト名</th>
                                    <th>求人職種</th>
                                    <th>業務形態</th>
                                    <th>詳細</th>
                                </tr>

                                <?php
                                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                $args = array(
                                    'posts_per_page' => 15,
                                    'paged' => $paged,
                                    'post_type' => array('post'),
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()):
                                    $counter = 1; // Initialize counter
                                    while ($the_query->have_posts()):
                                        $the_query->the_post();
                                ?>

                                        <tr>
                                            <td class="logo">
                                                <?php
                                                $scf_field = SCF::get('site-logo');
                                                $image_url = wp_get_attachment_url($scf_field);
                                                if (empty($image_url)) {
                                                    $image_url = get_template_directory_uri() . '/img/noimage.png';
                                                }
                                                ?>
                                                <img src="<?php echo esc_url($image_url); ?>" alt="ロゴ">
                                            </td>
                                            <td class="iconTX industry">
                                                <div class="inner">
                                                    <?php
                                                    $site_job_category = SCF::get('site-job_category');

                                                    if (!empty($site_job_category)) {
                                                        foreach ($site_job_category as $category) {
                                                            if ($category === 'se') {
                                                    ?>
                                                                <p class="TX industry01">正看護師</p>
                                                            <?php
                                                            } elseif ($category === 'jun') {
                                                            ?>
                                                                <p class="TX industry02">准看護師</p>
                                                            <?php
                                                            } elseif ($category === 'ho') {
                                                            ?>
                                                                <p class="TX industry03">保健師</p>
                                                            <?php
                                                            } elseif ($category === 'jo') {
                                                            ?>
                                                                <p class="TX industry04">助産師</p>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="iconTX workStyle">
                                                <div class="inner">
                                                    <?php
                                                    $job_business_style = post_custom('site-job-business_style');

                                                    if ($job_business_style === 'true') {
                                                    ?>
                                                        <p class="TX workStyle01">常勤<br />(夜勤あり)</p>
                                                    <?php
                                                    } elseif ($job_business_style === 'false') {
                                                    ?>
                                                        <p class="TX workStyle02">常勤<br />(夜勤なし)</p>
                                                    <?php
                                                    } elseif ($job_business_style === 'both') {
                                                    ?>
                                                        <p class="TX workStyle03">常勤<br />(夜勤あり)</p>
                                                        <p class="TX workStyle02">常勤<br />(夜勤なし)</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="detail">
                                                <a href="<?php echo post_custom('site-url'); ?>" target="_blank" rel="noopener noreferrer">
                                                    <p class="TX">詳細を見る</p>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php $counter++;
                                        ?>
                                <?php endwhile;
                                endif; ?>

                            <?php else: ?>
                                <p>情報はまだありません。</p>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>

                            </tbody>
                        </table>

                        <?php $args = array(
                            'post_type' => array('post'),
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()):
                        ?>
                            <!-- サービス内容 -->
                            <table class="content-03">
                                <tbody>
                                    <tr>
                                        <th>転職サイト名</th>
                                        <th>対応エリア</th>
                                        <th>転職時期</th>
                                        <th>詳細</th>
                                    </tr>

                                    <?php
                                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                    $args = array(
                                        'posts_per_page' => 15,
                                        'paged' => $paged,
                                        'post_type' => array('post'),
                                    );
                                    $the_query = new WP_Query($args);
                                    if ($the_query->have_posts()):
                                        $counter = 1; // Initialize counter
                                        while ($the_query->have_posts()):
                                            $the_query->the_post();
                                    ?>

                                            <tr>
                                                <td class="logo">
                                                    <?php
                                                    $scf_field = SCF::get('site-logo');
                                                    $image_url = wp_get_attachment_url($scf_field);
                                                    if (empty($image_url)) {
                                                        $image_url = get_template_directory_uri() . '/img/noimage.png';
                                                    }
                                                    ?>
                                                    <img src="<?php echo esc_url($image_url); ?>" alt="ロゴ">
                                                </td>
                                                <td class="good area">
                                                    <div class="inner">
                                                        <?php
                                                        $site_fix_area_icon = post_custom('site-fix-area-icon');

                                                        if ($site_fix_area_icon === 'true01') {
                                                        ?>
                                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/double_circle.svg" alt="二重丸">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true02') {
                                                        ?>
                                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/circle.svg" alt="丸">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true03') {
                                                        ?>
                                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/triangle.svg" alt="三角">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'true04') {
                                                        ?>
                                                            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/cross.svg" alt="バツ">
                                                        <?php
                                                        } elseif ($site_fix_area_icon === 'false') {
                                                        ?>
                                                        <?php
                                                        }
                                                        ?>
                                                        <p class="number"><?php echo post_custom('site-fix-area'); ?></p>
                                                    </div>
                                                </td>
                                                <td class="timing">
                                                    <p class="TX"><?php echo post_custom('site-job_change_period'); ?></p>
                                                </td>
                                                <td class="detail">
                                                    <a href="<?php echo post_custom('site-url'); ?>" target="_blank" rel="noopener noreferrer">
                                                        <p class="TX">詳細を見る</p>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $counter++;
                                            ?>
                                    <?php endwhile;
                                    endif; ?>

                                <?php else: ?>
                                    <p>情報はまだありません。</p>
                                <?php endif; ?>
                                <?php wp_reset_postdata(); ?>

                                </tbody>
                            </table>
            </div>
        </div>
    </div>

</div>