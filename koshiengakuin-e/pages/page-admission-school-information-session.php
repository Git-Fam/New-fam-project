<?php
/*
Template Name: 入試情報 - 募集説明会
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/admission_school_information_session_kv.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">

          <div class="p-admission-index__info">
            <span class="p-front-banner-info__top font-avenir-bold">Experience Event</span>
            <span class="p-front-banner-info__bottom">体験イベント</span>
          </div>
        </div>

        <div class="p-admission-child-wrap">
          <div class="p-admission-child__inner m-type-2 pc-pdt-70 sp-pdt-56" style="background: none;">

            <h2 class="p-admission-child__title font-marumin-old pc-mgb-40 sp-mgb-30">
              先生や在校生とつながる<br class="pc-none"><span class="u-sp-spacing"></span>楽しい体験を。
            </h2>
            <p class="p-admission-child__text pc-pdb-30 pc-pdl-20 pc-pdr-20 sp-pdb-50 sp-pdl-40 sp-pdr-40">
              幼稚園・保育園の園児や、転入をお考えの小学生を対象に、春・夏・冬の体験イベントを開催しています。<br class="sp-none">先生や在校生とふれあいながら、楽しい体験学習や入試対策に参加していただけます。<br class="sp-none">ぜひ本校のあたたかい雰囲気と学びを体感してください。
            </p>
          </div>
          <section class="p-event-list-wrap">
            <div class="p-event-list swiper">

              <div class="swiper-wrapper">
                <? /*
                  <div class="p-event-list__item swiper-slide">
                    <div class="p-event-list__img pc-mgb-18 sp-mgb-18"><img src="<?php echo get_template_directory_uri(); ?>/img/event-spring.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100"></div>
                    <p class="p-event-list__title">スプリング体験学習・学校説明会</p>
                    <ul class="p-event-list-table">
                      <li><div class="p-event-list-table__head">対象</div><div>年長・年中・年少</div></li>
                      <li><div class="p-event-list-table__head">日付</div><div>令和9年3月24日（土）</div></li>
                      <li><div class="p-event-list-table__head">時間</div><div>9:30～12:00</div></li>
                      <li><div class="p-event-list-table__head">場所</div><div>甲子園学院小学校</div></li>
                    </ul>
                  </div>
                  */ ?>

                <?php if (current_user_can('manage_options')) :
                  $all = function_exists('get_fields') ? get_fields(get_the_ID()) : false;
                  echo '<!-- ACF debug all_fields => ' . PHP_EOL . var_export($all, true) . PHP_EOL . '-->' . PHP_EOL;
                endif; ?>
                <?php
                // collect rows into array (current post first, fallback to post 31)
                $slides = array();

                if (! function_exists('_acf_sub_first')) {
                  function _acf_sub_first($keys)
                  {
                    foreach ((array)$keys as $k) {
                      $v = get_sub_field($k);
                      if ($v !== null && $v !== '') return $v;
                    }
                    return '';
                  }
                }

                if (! function_exists('_is_event_finished')) {
                  function _is_event_finished($date_str)
                  {
                    // Check if 終了チェック field exists and is checked
                    $finish_check = get_sub_field('終了チェック');
                    if ($finish_check) return true;

                    // Parse date string like "令和8年1月29日（金）"
                    if (empty($date_str)) return false;

                    // Extract year, month, day from Japanese date format
                    if (preg_match('/令和(\d+)年(\d+)月(\d+)日/', $date_str, $m)) {
                      $reiwa_year = intval($m[1]);
                      $month = intval($m[2]);
                      $day = intval($m[3]);
                      $gregorian_year = 2018 + $reiwa_year;
                      $event_date = mktime(0, 0, 0, $month, $day, $gregorian_year);
                      $today = strtotime('tomorrow');
                      return $event_date < $today;
                    }

                    return false;
                  }
                }

                if (have_rows('体験イベント')) {
                  while (have_rows('体験イベント')) {
                    the_row();
                    $date = _acf_sub_first(array('日付'));
                    $slides[] = array(
                      'img' => _acf_sub_first(array('画像', 'イベント画像')),
                      'title' => _acf_sub_first(array('タイトル', '体験イベント_タイトル')),
                      'target' => _acf_sub_first(array('対象')),
                      'date' => $date,
                      'time' => _acf_sub_first(array('時間')),
                      'place' => _acf_sub_first(array('場所')),
                      'is_finished' => _is_event_finished($date),
                    );
                  }
                } elseif (have_rows('体験イベント', 31)) {
                  while (have_rows('体験イベント', 31)) {
                    the_row();
                    $date = _acf_sub_first(array('日付'));
                    $slides[] = array(
                      'img' => _acf_sub_first(array('画像', 'イベント画像')),
                      'title' => _acf_sub_first(array('タイトル', '体験イベント_タイトル')),
                      'target' => _acf_sub_first(array('対象')),
                      'date' => $date,
                      'time' => _acf_sub_first(array('時間')),
                      'place' => _acf_sub_first(array('場所')),
                      'is_finished' => _is_event_finished($date),
                    );
                  }
                }

                // if 3 or fewer items, duplicate the array once (倍にする)
                if (count($slides) > 0 && count($slides) <= 3) {
                  $slides = array_merge($slides, $slides);
                }

                // render
                foreach ($slides as $s) :
                  $finished_class = $s['is_finished'] ? ' is-finished' : '';
                ?>
                  <div class="p-event-list__item swiper-slide<?php echo $finished_class; ?>">
                    <div class="p-event-list__img pc-mgb-18 sp-mgb-18">
                      <?php if (! empty($s['img'])) : ?>
                        <img src="<?php echo esc_url($s['img']); ?>" alt="" loading="lazy" aria-hidden="true" class="u-w100">
                      <?php endif; ?>
                    </div>
                    <p class="p-event-list__title"><?php echo esc_html($s['title']); ?></p>
                    <ul class="p-event-list-table">
                      <li>
                        <div class="p-event-list-table__head">対象</div>
                        <div><?php echo esc_html($s['target']); ?></div>
                      </li>
                      <li>
                        <div class="p-event-list-table__head">日付</div>
                        <div><?php echo esc_html($s['date']); ?></div>
                      </li>
                      <li>
                        <div class="p-event-list-table__head">時間</div>
                        <div><?php echo esc_html($s['time']); ?></div>
                      </li>
                      <li>
                        <div class="p-event-list-table__head">場所</div>
                        <div><?php echo esc_html($s['place']); ?></div>
                      </li>
                    </ul>
                  </div>
                <?php
                endforeach;
                ?>

              </div>


            </div>
          </section>

          <div class="p-admission-child__inner" style="background: none;min-height: initial;">

            <div class="p-admission-child__btn pc-mgt-70 pc-pdb-90 sp-mgt-50 sp-pdb-90">
              <a href="https://mirai-compass.net/usr/kosienge/event/evtIndex.jsf" target="_blank" class="c-btn c-btn--fill">
                <div class="c-btn__inner"><span>お申し込みはこちら</span></div>
              </a>
            </div>
          </div>
        </div>




      </div>



    </main>
  </div>


</div>

<?php get_template_part('./inc/footer'); ?>