<?php
/*
Template Name: recruit-index
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="recruit-index_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit-index/recruit-index_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit-index/recruit-index_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/recruit-index/recruit-index_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/recruit-index/recruit-index_kv-ttl.svg" alt="RECRUIT / 採用情報">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_recruit-index">

    <section class="recruit-index_type-01_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <h3 class="TL">
            <img src="<?php echo get_template_directory_uri(); ?>/img/recruit-index/recruit-index-sec-ttl.svg" alt="READ TO">
          </h3>
        </div>
        <div class="recruit-index_sec_01">
          <div class="txt_area s-pop">
            <p class="TX">
              オフロムの若手社員にインタビュー。技術部、製造部、管理部などのさまざまな社員に<br
                class="pc">現在の仕事内容や今後の目標や夢などの「将来の道」について答えてもらいました。
            </p>
          </div>
          <div class="contents_area s-pop">

            <ul class="lists">
              <?php
              $recruit_query = new WP_Query(array(
                'post_type' => 'recruit',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish',
              ));
              $noindex_img = get_template_directory_uri() . '/img/recruit-index/recruit-index_sec_01-contents-item-05-hover.webp';
              if ($recruit_query->have_posts()) :
                while ($recruit_query->have_posts()) : $recruit_query->the_post();
                  $post_id = get_the_ID();
                  $staff_img = SCF::get('staff_img', $post_id);
                  $no_index = SCF::get('no_index', $post_id);
                  $hide_link = ($no_index === false || $no_index === '' || $no_index === '0');
                  if ($hide_link) {
                    $img_src = $noindex_img;
                  } else {
                    if (empty($staff_img)) { continue; }
                    $img_src = is_numeric($staff_img) ? wp_get_attachment_image_url($staff_img, 'medium_large') : $staff_img;
                    if (empty($img_src)) { continue; }
                  }
              ?>
                  <li class="item">
                    <?php if ($hide_link) : ?>
                      <div class="def">
                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>">
                      </div>
                    <?php else : ?>
                      <a href="<?php the_permalink(); ?>">
                        <div class="def">
                          <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                      </a>
                    <?php endif; ?>
                  </li>
              <?php
                endwhile;
                wp_reset_postdata();
              endif;
              ?>
            </ul>

            <ul class="links">
              <li class="C_link_banner s-pop">
                <a href="<?php echo home_url('/requirements'); ?>">
                  <div class="inner">募集要項</div>
                </a>
              </li>
              <li class="C_link_banner s-pop">
                <a href="<?php echo home_url('/entry-new'); ?>">
                  <div class="inner">新卒採用エントリー</div>
                </a>
              </li>
              <li class="C_link_banner s-pop">
                <a href="<?php echo home_url('/entry-mid'); ?>">
                  <div class="inner">中途採用エントリー</div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>