<?php
/*
Template Name: 夢中学生
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--junior-students page--junior page--high page--high-all">

  <section class="junior-students-hiro">
    <div class="junior-students-hiro-bg">
      <picture>
        <source srcset="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('hero_bg_sp'), 'full')); ?>" media="(max-width: 768px)">
        <img src="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('hero_bg_pc'), 'full')); ?>" alt="">
      </picture>
    </div>
    <div class="junior-students-hiro-inr">
      <h2 class="TL"><?php
        $text = nl2br(esc_html(SCF::get('hero_title')));
        $text = str_replace('[pcbr]', '<br class="pcbr">', $text);
        $text = str_replace('[spbr]', '<br class="spbr">', $text);
        $text = str_replace('[br]',   '<br class="bothbr">', $text);
        echo $text;
      ?></h2>

      <div class="TX">
        <p class="label"><img src="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('hero_label'), 'full')); ?>" alt="夢中学生"></p>
        <p class="name"><?php echo esc_html(SCF::get('hero_name')); ?></p>
      </div>
    </div>
  </section>

  <section class="junior-students-contents">

  <?php
  $blocks = SCF::get('content_blocks');
  
  if (!empty($blocks)):
      foreach ($blocks as $b):
          $type = isset($b['block_type']) ? $b['block_type'] : 'text';

          if ($type === 'photo'):
              // ---- 写真だけのブロック ----
              $photo_pc = !empty($b['photo_pc']) ? $b['photo_pc'] : '';
              $photo_sp = !empty($b['photo_sp']) ? $b['photo_sp'] : '';
  ?>
      <div class="junior-students-contents-item js-fade">
        <picture>
          <source srcset="<?php echo esc_url(wp_get_attachment_image_url($photo_sp, 'full')); ?>" media="(max-width: 768px)">
          <img src="<?php echo esc_url(wp_get_attachment_image_url($photo_pc, 'full')); ?>" alt="">
        </picture>
      </div>
  <?php
          else:
              // ---- テキストブロック（背景ピンクは共通・ベタ書き） ----
              $icon = isset($b['icon_text']) ? trim($b['icon_text']) : '';
              $tl   = isset($b['tl']) ? trim($b['tl']) : '';
              $tx   = isset($b['tx']) ? trim($b['tx']) : '';
  ?>
      <div class="junior-students-contents-item js-fade">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-item-pc.webp" alt="">
        </picture>

        <div class="junior-students-contents-item-inr">
          <div class="icon-box">
            <p class="icon-box-text"><?php echo esc_html($icon); ?></p>
            <div class="icon-box-img"><img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/junior-students-icon.webp" alt="夢中"></div>
          </div>
          <?php
          $tl_html = esc_html($tl);
          $tl_html = str_replace('[pcbr]', '<br class="pc">', $tl_html);
          $tl_html = str_replace('[spbr]', '<br class="sp">', $tl_html);
          $tl_html = str_replace('[br]',   '<br>',            $tl_html);
          ?>
          <h3 class="TL"><?php echo $tl_html; ?></h3>
          <p class="TX"><?php echo nl2br(esc_html($tx)); ?></p>
        </div>
      </div>
  <?php
          endif;
      endforeach;
  endif;
  ?>

</section>

  <section class="high-change">
    <div class="ttl">
      <h2 class="TL">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-students/slider-ttl.svg" alt="その他の夢中学生">
      </h2>
    </div>
    <div class="high-change-contents">
      <a href="<?php echo home_url('/junior/students/'); ?>" class="high-change-contents-item hover-opa">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-01.webp" alt="">
      </a>
      <a href="<?php echo home_url('/junior/students2/'); ?>" class="high-change-contents-item hover-opa">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-02.webp" alt="">
      </a>
      <a href="<?php echo home_url('/junior/students3/'); ?>" class="high-change-contents-item hover-opa">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-03.webp" alt="">
      </a>
      <a href="<?php echo home_url('/junior/students4/'); ?>" class="high-change-contents-item hover-opa">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior/junior-change-04.webp" alt="">
      </a>
    </div>
    <div class="high-change-pagination"></div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>