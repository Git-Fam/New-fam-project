<?php
/*
Template Name: 採用情報
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--recruit">

    <!-- ============ FV（sticky固定） ============ -->
    <div class="p-recruit-fv-wrap">
      <section class="p-recruit-fv js-fv-slideshow" id="js-fv-scroll-fade">
        <div class="p-recruit-fv__slider">
          <div class="p-recruit-fv__slide p-fv-slide-target is-active">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_01_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_01_pc.webp" alt="">
            </picture>
          </div>
          <div class="p-recruit-fv__slide p-fv-slide-target">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_02_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_02_pc.webp" alt="">
            </picture>
          </div>
          <div class="p-recruit-fv__slide p-fv-slide-target">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_03_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_03_pc.webp" alt="">
            </picture>
          </div>
        </div>


        <div class="p-recruit-fv__white" id="js-fv-white"></div>
        <div class="p-recruit-fv__gauge">
          <span class="p-recruit-fv__gauge-fill js-fv-gauge-fill" id="js-fv-gauge-fill"></span>
        </div>
      </section>
    </div>

    <!-- ============ 理念テキスト（FVに重なって上がってくる） ============ -->
       <!-- 中央タイトル -->
        <div class="p-recruit-fv__catch">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_catch_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/recruit/fv_catch_pc.webp" alt="RECRUIT 採用情報">
          </picture>
        </div>

    <div class="p-recruit-content">
      <section class="p-recruit-philosophy js-fade" id="js-recruit-philosophy">
        <div class="p-recruit-philosophy__inner">
          <div class="p-recruit-philosophy__text">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/recruit/philosophy_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/recruit/philosophy_pc.webp" alt="子どもたちと関わると、自分の在り方がいつも試されます。…">
            </picture>
          </div>
        </div>
      </section>


      <!-- ============ 募集要項 ============ -->
      <?php if (function_exists('get_field')) : ?>
      <section class="p-recruit-outline">
        <div class="p-recruit-outline__inner">

          <?php if ($title = get_field('recruit_title')) : ?>
          <h2 class="p-recruit-outline__ttl js-fade"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <dl class="p-recruit-outline__list">
            <?php
            // 項目名とフィールド名の対応
            $rows = array(
              '募集対象'         => 'recruit_target',
              '募集職種'         => 'recruit_position',
              '募集教科'         => 'recruit_subject',
              '応募方法'         => 'recruit_apply',
              '必要書類'         => 'recruit_documents',
              '選考方法'         => 'recruit_selection',
              '賃金・手当等'     => 'recruit_salary',
              '勤務時間'         => 'recruit_worktime',
              '休日'             => 'recruit_holiday',
              '書類の提出先 問い合わせ先' => 'recruit_contact',
            );
            foreach ($rows as $label => $key) :
              $value = get_field($key);
              if (!$value) continue;
            ?>
            <div class="p-recruit-outline__row js-fade">
              <dt class="p-recruit-outline__label"><?php echo esc_html($label); ?></dt>
              <dd class="p-recruit-outline__body"><?php echo $value; // Wysiwygはそのまま出力 ?></dd>
            </div>
            <?php endforeach; ?>
          </dl>

        </div>
      </section>
      <?php endif; ?>


      


      
    </div>

</main>


<?php get_template_part('./inc/footer'); ?>
