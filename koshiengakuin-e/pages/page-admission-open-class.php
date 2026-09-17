<?php
/*
Template Name: 入試情報 - 公開授業
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-admission">

  <div class="p-admission-content">

    <?php get_template_part('./inc/admission-sidebar'); ?>

    <main class="p-admission-content-main">

      <div class="p-admission-child">

        <div class="p-admission-child__kv">
          <img src="<?php echo get_template_directory_uri(); ?>/img/admission_open-class_kv.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">

          <div class="p-admission-index__info">
            <span class="p-front-banner-info__top font-avenir-bold">Open Class</span>
            <span class="p-front-banner-info__bottom">公開授業・募集説明会</span>
          </div>
        </div>

        <div class="p-admission-child__inner pc-pdt-70 pc-pdb-100 sp-pdt-40 sp-pdb-60">

          <h2 class="p-admission-child__title font-marumin-old pc-mgb-40 sp-mgb-30">
            <span class="u-sp-spacing"></span>心がつながる学びを、<br class="pc-none"><span class="u-sp-spacing"></span>体験する。
          </h2>

          <p class="p-admission-child__text pc-mgb-50 sp-mgb-30">
            1年生から6年生までの全学級において、各教科の学習の様子をありのままご覧いただけます。<br class="sp-none">子どもたちが主体的に学び、対話を通して考えを深めていく姿など、<br class="sp-none">日常の学びの空気をそのまま感じていただけます。
          </p>

          <div class="pc-mgb-90 sp-mgb-40">
            <?php if (have_rows('公開授業・募集説明会のアイテム')) : ?>
              <?php while (have_rows('公開授業・募集説明会のアイテム')) : the_row(); ?>
                <?php
                $is_finished = false;

                // Check if 終了チェック is set
                if (function_exists('get_sub_field') && get_sub_field('終了チェック')) {
                  $is_finished = true;
                }

                // Check if date has passed
                if (!$is_finished && function_exists('get_sub_field')) {
                  $date_str = get_sub_field('日付');
                  if ($date_str) {
                    // Extract date from format like "令和8年1月29日（金）"
                    preg_match('/(\d+)年(\d+)月(\d+)日/', $date_str, $matches);
                    if (!empty($matches)) {
                      $year = intval($matches[1]);
                      $month = intval($matches[2]);
                      $day = intval($matches[3]);

                      // Convert Reiwa year to Gregorian calendar (Reiwa started in 2019)
                      $gregorian_year = $year + 2018;

                      $event_date = mktime(0, 0, 0, $month, $day, $gregorian_year);
                      $today = strtotime('tomorrow');

                      if ($event_date < $today) {
                        $is_finished = true;
                      }
                    }
                  }
                }
                ?>
                <div class="p-admission-child-table <?php echo $is_finished ? 'is-finished' : ''; ?>">
                  <h3 class="p-admission-child-table__title"><?php echo function_exists('get_sub_field') ? get_sub_field('タイトル') : ''; ?></h3>
                  <ul class="p-admission-child-table__inner">
                    <?php if (function_exists('get_sub_field') && get_sub_field('日付')) : ?>
                      <li>
                        <div>日付</div>
                        <div><?php echo get_sub_field('日付'); ?></div>
                      </li>
                    <?php endif; ?>
                    <?php if (function_exists('get_sub_field') && get_sub_field('時間')) : ?>
                      <li>
                        <div>時間</div>
                        <div><?php echo get_sub_field('時間'); ?></div>
                      </li>
                    <?php endif; ?>
                    <?php if (function_exists('get_sub_field') && get_sub_field('場所')) : ?>
                      <li>
                        <div>場所</div>
                        <div><?php echo get_sub_field('場所'); ?></div>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <?php /*
            <div class="p-admission-child__btn">
              <?php if ( get_field('終了チェック') ) : ?>
              <a href="#" class="c-btn c-btn--fill c-btn--is-disabled">
                <div class="c-btn__inner"><span>終了しました</span></div>
              </a>
              <?php else : ?>
              <a href="<?php echo esc_url( home_url() ); ?>/contact/" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span>お申し込みはこちら</span></div>
              </a>
              <?php endif; ?>
            </div>
            */ ?>


        </div>


      </div>


      <?php get_template_part('./inc/footer'); ?>

    </main>
  </div>


</div>