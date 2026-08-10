<?php
/*
Template Name: special
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<?php
function special_br($t)
{
  if (!is_string($t)) return $t;
  $s = html_entity_decode($t, ENT_QUOTES, 'UTF-8');
  return wp_kses_post(nl2br($s));
}
?>

<!-- 独自ページ --start -->
<div class="page-special">
  <section class="special_kv">
    <div class="ttl">
      <h2 class="TL">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/special/special_kv-ttl-pc.svg" media="(min-width: 768px)"
            type="image/svg+xml">
          <img src="<?php echo get_template_directory_uri(); ?>/img/special/special_kv-ttl-sp.svg" alt="甲子園学院 百人百景">
        </picture>
      </h2>
      <p class="TX">
        卒業生と教職員。<br class="sp">甲子園学院に関わる人々の<br class="sp">心象風景をのぞきました。<br>
        「あなたはどんな心を磨いていますか？」
      </p>
    </div>
    <div class="tabs anime-fade">
      <ul>
        <li class="hover-opa tab is-active" data-tab="all">すべて</li>
        <li class="hover-opa tab" data-tab="graduate">卒業生</li>
        <li class="hover-opa tab" data-tab="teacher">教職員</li>
        <!-- <li class="hover-opa tab" data-tab="other">その他</li> -->
      </ul>
    </div>
  </section>

  <section class="special_contents">

    <ul class="item--wrap">

      <?php
      $special_query = new WP_Query(array(
        'post_type'      => 'special',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ));
      if ($special_query->have_posts()) :
        while ($special_query->have_posts()) : $special_query->the_post();
          $terms = get_the_terms(get_the_ID(), 'special-cat');
          $cat_slug = (is_array($terms) && isset($terms[0])) ? $terms[0]->slug : 'other';

          $catch_raw = SCF::get('catch_txt');
          $catch_txt = (is_array($catch_raw) && isset($catch_raw[0])) ? (is_array($catch_raw[0]) ? ($catch_raw[0]['catch_txt'] ?? $catch_raw[0]) : $catch_raw[0]) : $catch_raw;

          $thumb_raw = SCF::get('thumbnail_img');
          $thumb_row = (is_array($thumb_raw) && isset($thumb_raw[0])) ? $thumb_raw[0] : $thumb_raw;
          $thumb_id = is_array($thumb_row) ? ($thumb_row['thumbnail_img'] ?? $thumb_row) : $thumb_row;
          $thumb_url = ($thumb_id && is_numeric($thumb_id)) ? wp_get_attachment_image_url((int) $thumb_id, 'full') : '';
          if ($thumb_url === '') {
            $thumb_url = get_template_directory_uri() . '/img/special/special_contents-item-img-01.webp';
          }
          $thumb_url = esc_url($thumb_url);

          $job_def_raw = SCF::get('job_txt_def');
          $job_txt_def = (is_array($job_def_raw) && isset($job_def_raw[0])) ? (is_array($job_def_raw[0]) ? ($job_def_raw[0]['job_txt_def'] ?? $job_def_raw[0]) : $job_def_raw[0]) : $job_def_raw;

          $job_pop_raw = SCF::get('job_txt_pop');
          $job_txt_pop = (is_array($job_pop_raw) && isset($job_pop_raw[0])) ? (is_array($job_pop_raw[0]) ? ($job_pop_raw[0]['job_txt_pop'] ?? $job_pop_raw[0]) : $job_pop_raw[0]) : $job_pop_raw;

          $grad_raw = SCF::get('graduation_txt_def');
          $graduation_txt_def = (is_array($grad_raw) && isset($grad_raw[0])) ? (is_array($grad_raw[0]) ? ($grad_raw[0]['graduation_txt_def'] ?? $grad_raw[0]) : $grad_raw[0]) : $grad_raw;

          $grad_pop_raw = SCF::get('graduation_txt_pop');
          $graduation_txt_pop = (is_array($grad_pop_raw) && isset($grad_pop_raw[0])) ? (is_array($grad_pop_raw[0]) ? ($grad_pop_raw[0]['graduation_txt_pop'] ?? $grad_pop_raw[0]) : $grad_pop_raw[0]) : $grad_pop_raw;

          $sentence_raw = SCF::get('sentence_txt');
          $sentence_txt = (is_array($sentence_raw) && isset($sentence_raw[0])) ? (is_array($sentence_raw[0]) ? ($sentence_raw[0]['sentence_txt'] ?? $sentence_raw[0]) : $sentence_raw[0]) : $sentence_raw;
     
          $name_group_pc_url = wp_get_attachment_image_url((int)SCF::get('name_group_pc'), 'full');
          $name_group_sp_url = wp_get_attachment_image_url((int)SCF::get('name_group_sp'), 'full');
          $name_group_pop_url = wp_get_attachment_image_url((int)SCF::get('name_group_pop'), 'full');
          ?>

          <li class="item" data-tab="<?php echo esc_attr($cat_slug); ?>">
            <div class="handle anime-fade">
              <div class="img--area">
                <img src="<?php echo $thumb_url; ?>" alt="">
              </div>
              <div class="txt--area">
                <div class="ttl">
                  <h3 class="TL"><?php echo special_br($catch_txt); ?></h3>
                </div>
                <div class="txt">
                <p class="name">
                    <img class="pc" src="<?php echo esc_url($name_group_pc_url); ?>" alt="">
                    <img class="sp" src="<?php echo esc_url($name_group_sp_url); ?>" alt="">
                </p>
                  <!-- <p class="graduate"><?php echo special_br($graduation_txt_def); ?></p> -->
                </div>
                <div class="btn hover-opa">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/img/special/more-btn-pc.svg" media="(min-width: 768px)"
                      type="image/svg+xml">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/special/more-btn-sp.svg" alt="READ MORE">
                  </picture>
                </div>
              </div>
            </div>
            <div class="pop_up">
              <div class="pop_up--inner">
                <div class="prev-btn hover-opa"></div>
                <div class="pop_up--inner--contents">
                  <div class="inner">
                    <div class="visual--area">
                      <div class="img">
                        <img src="<?php echo $thumb_url; ?>" alt="">
                      </div>
                      <div class="ttl">
                        <p class="sub">どんな心を磨いていますか？</p>
                        <h4 class="TL">
                          <?php echo special_br($catch_txt); ?>
                        </h4>
                        <div class="txt">
                          <p class="name">
                              <img src="<?php echo esc_url($name_group_pop_url); ?>" alt="">
                          </p>
                          <!-- <p class="graduate"><?php echo special_br($graduation_txt_pop); ?></p> -->
                        </div>
                      </div>
                    </div>
                    <div class="txt-area">
                      <p class="TX">
                        <?php echo special_br($sentence_txt); ?>
                      </p>
                    </div>
                    <div class="close-btn hover-opa">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/special/close-btn.svg" alt="一覧に戻る">
                    </div>
                  </div>
                </div>
                <div class="next-btn hover-opa"></div>
              </div>
            </div>
          </li>
      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>

    </ul>

  </section>

</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>