<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自 -->
<div class="requirements_kv">
    <div class="bg">
        <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg-sp.webp" media="(max-width: 767px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-bg.webp">
        </picture>
    </div>
    <div class="sent_wrap">
        <h2 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/requirements/requirements_kv-ttl.svg" alt="RECRUIT / 採用情報">
        </h2>
    </div>
</div>
<main class="page_main_contents">
    <div class="page-single-recruit">

        <section class="single-recruit_sect">
            <div class="all_sec_inner">

                <div class="main_area">

                    <?php
                    $post_id = get_the_ID();
                    $staff_img = SCF::get('staff_img', $post_id);
                    $staff_img_url = !empty($staff_img) ? (is_numeric($staff_img) ? wp_get_attachment_image_url($staff_img, 'medium_large') : $staff_img) : '';
                    $road_to = SCF::get('road_to', $post_id);
                    $department = SCF::get('department', $post_id);
                    $joining_graduation = SCF::get('joining_graduation', $post_id);
                    $the_title = get_the_title();
                    ?>
                    <div class="top_sent_area">
                        <?php if (!empty($staff_img_url)) : ?>
                            <div class="top_sent_thumbnail">
                                <img src="<?php echo esc_url($staff_img_url); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="top_sent_ttl">
                            <div class="ttl_area">
                                <div class="ttl">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/single-recruit/inr_ttl.webp" alt="ROAD TO">
                                </div>
                                <?php if (!empty($road_to)) : ?>
                                    <div class="frame">
                                        <h2 class="TL"><?php echo esc_html($road_to); ?></h2>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="info">
                                <?php if (!empty($the_title)) : ?>
                                    <div class="name">
                                        <p class="TX"><?php the_title(); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($department) || !empty($joining_graduation)) : ?>
                                    <div class="txt">
                                        <p class="TX">
                                            <?php if (!empty($department)) : ?>
                                                <?php echo esc_html($department); ?>
                                            <?php endif; ?>
                                        </p>
                                        <p class="TX">
                                            <?php echo esc_html($joining_graduation ?: ''); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="other_sec_inner">
                        <ul class="contents_area">
                            <?php
                            $contents_q_a = SCF::get('contents_q_a', $post_id);
                            if (!empty($contents_q_a) && is_array($contents_q_a)) :
                                foreach ($contents_q_a as $row) :
                                    $q = isset($row['contents_question']) ? trim($row['contents_question']) : '';
                                    $a = isset($row['contents_answer']) ? trim($row['contents_answer']) : '';
                                    if ($q === '' && $a === '') continue;
                            ?>
                                    <li class="item">
                                        <?php if ($q !== '') : ?>
                                            <div class="ttl">
                                                <h3 class="TL"><?php echo esc_html($q); ?></h3>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($a !== '') : ?>
                                            <div class="sent">
                                                <p class="TX"><?php echo nl2br(esc_html($a)); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="other_area">
                    <div class="other_area_ttl">
                        <h2 class="TL">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/single-recruit/other_ttl-sp.webp"
                                    media="(max-width: 767px)">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/single-recruit/other_ttl.webp" alt="OTHER PEOPLE">
                            </picture>
                        </h2>
                        <p class="TX">その他の社員</p>
                    </div>
                    <ul class="contents_area">
                        <?php
                        $other_recruit = new WP_Query(array(
                            'post_type' => 'recruit',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post_status' => 'publish',
                            'post__not_in' => array($post_id),
                        ));
                        $default_thumb = get_template_directory_uri() . '/img/recruit-index/recruit-index_sec_01-contents-item-01.webp';
                        if ($other_recruit->have_posts()) :
                            while ($other_recruit->have_posts()) : $other_recruit->the_post();
                                $oid = get_the_ID();
                                $o_no_index = SCF::get('no_index', $oid);
                                if ($o_no_index === false || $o_no_index === '' || $o_no_index === '0') {
                                    continue;
                                }
                                $o_thumb = SCF::get('thumbnail_img', $oid);
                                $o_thumb_url = !empty($o_thumb) ? (is_numeric($o_thumb) ? wp_get_attachment_image_url($o_thumb, 'medium_large') : $o_thumb) : '';
                                if (empty($o_thumb_url)) {
                                    $o_thumb = SCF::get('staff_img', $oid);
                                    $o_thumb_url = !empty($o_thumb) ? (is_numeric($o_thumb) ? wp_get_attachment_image_url($o_thumb, 'medium_large') : $o_thumb) : $default_thumb;
                                }
                                $o_dept = SCF::get('department', $oid);
                                $o_title = get_the_title();
                        ?>
                                <li class="item">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="bg">
                                            <img src="<?php echo esc_url($o_thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                        <div class="cover"></div>
                                        <div class="cover-txt">
                                            <?php if (!empty($o_dept)) : ?><p class="TX"><?php echo esc_html($o_dept); ?></p><?php endif; ?>
                                            <?php if (!empty($o_title)) : ?><p class="TX name"><?php the_title(); ?></p><?php endif; ?>
                                        </div>
                                    </a>
                                </li>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>

            </div>
        </section>

    </div>
</main>
<!-- 独自 end -->



<?php get_template_part('./inc/footer'); ?>