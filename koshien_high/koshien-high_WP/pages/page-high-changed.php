<?php
/*
Template Name: 好きを見つけて変わった生徒たち
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page-high-changed page--high-all">

  <section class="high-changed-kv">

    <div class="high-changed-kv-cover">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-cover-sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-cover-pc.webp" alt="">
      </picture>
    </div>

    <div class="high-changed-kv-inr">

      <div class="high-changed-kv-item high-changed-kv-item-01">
        <div class="high-changed-kv-item-bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv01_bg_sp'), 'full')); ?>">
            <img src="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv01_bg_pc'), 'full')); ?>" alt="">
          </picture>
        </div>
        <div class="high-changed-kv-item-ttl">
          <div class="high-changed-kv-item-ttl-inr">
            <?php
            $ttl01 = esc_html(trim(SCF::get('kv01_ttl')));
            $ttl01 = str_replace('[pcbr]', '<br class="pc">', $ttl01);
            $ttl01 = str_replace('[spbr]', '<br class="sp">', $ttl01);
            $ttl01 = str_replace('[br]',   '<br>',            $ttl01);
            ?>
            <h3 class="high-changed-kv-item-ttl-tx"><?php echo $ttl01; ?></h3>
          </div>
        </div>
      </div>

      <div class="high-changed-kv-item high-changed-kv-item-02">
        <div class="high-changed-kv-item-bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv02_bg_sp'), 'full')); ?>">
            <img src="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv02_bg_pc'), 'full')); ?>" alt="">
          </picture>
        </div>
        <div class="high-changed-kv-item-ttl">
          <div class="high-changed-kv-item-ttl-inr">
            <?php
            $ttl02 = esc_html(trim(SCF::get('kv02_ttl')));
            $ttl02 = str_replace('[pcbr]', '<br class="pc">', $ttl02);
            $ttl02 = str_replace('[spbr]', '<br class="sp">', $ttl02);
            $ttl02 = str_replace('[br]',   '<br>',            $ttl02);
            ?>
            <h3 class="high-changed-kv-item-ttl-tx"><?php echo $ttl02; ?></h3>
          </div>
        </div>
      </div>

      <div class="high-changed-kv-item high-changed-kv-item-03">
        <div class="high-changed-kv-item-bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-03-sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-03-pc.webp" alt="">
          </picture>
        </div>
        <div class="high-changed-kv-item-ttl">
          <div class="high-changed-kv-item-ttl-inr js-fade">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv03_ttl_sp'), 'full')); ?>">
              <img src="<?php echo esc_url(wp_get_attachment_image_url(SCF::get('kv03_ttl_pc'), 'full')); ?>" alt="わたしが見つけた好きは… 人と話すこと">
            </picture>
          </div>
        </div>
      </div>

      <!-- <div class="high-changed-kv-item high-changed-kv-item-04">
        <div class="high-changed-kv-item-bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-04-sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-04-pc.webp" alt="">
          </picture>
        </div>
      </div> -->

      <div class="high-changed-kv-item high-changed-kv-item-05">
        <div class="high-changed-kv-item-bg">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-03-sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-kv-bg-03-pc.webp" alt="">
          </picture>
        </div>
        <div class="high-changed-kv-item-ttl">
          <div class="high-changed-kv-item-ttl-inr js-fade">
            <?php
            $tl = trim(SCF::get('kv05_tl'));
            $tl_html = esc_html($tl);
            $tl_html = str_replace('[pcbr]', '<br class="pc">', $tl_html);
            $tl_html = str_replace('[spbr]', '<br class="sp">', $tl_html);
            $tl_html = str_replace('[br]',   '<br>',            $tl_html);
            ?>
            <h2 class="TL"><?php echo $tl_html; ?></h2>
            <p class="TX"><?php echo nl2br(esc_html(SCF::get('kv05_tx'))); ?></p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="high-changed js-fade">
    <div class="ttl">
      <h2 class="TL">
        <picture>
          <img src="<?php echo get_template_directory_uri(); ?>/img/high-changed/high-changed-ttl.svg" alt="その他の見つけた生徒">
      </h2>
    </div>
    <div class="high-changed-contents">
      <a href="<?php echo home_url('/high/changed/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-01-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed2/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-02-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed3/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-03-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed4/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-04-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-04-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed5/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-05-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-05-pc.webp" alt="">
        </picture>
      </a>
      <a href="<?php echo home_url('/high/changed6/'); ?>" class="high-changed-contents-item hover-opa">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/high/high-change-06-sp.webp" media="(max-width: 768px)">
          <img src="<?php echo get_template_directory_uri(); ?>/img/high/high-change-06-pc.webp" alt="">
        </picture>
      </a>
    </div>
    <div class="high-changed-pagination"></div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>