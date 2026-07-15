<?php
/*
Template Name: オープンスクール（中学）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--junior-openschool page--high-openschool page--high-all">
  <div class="high-openschool-bg">
    <div class="high-openschool-bg-inr"></div>
    <picture>
      <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-bg-sp.webp" type="image/svg+xml">
      <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-bg-pc.webp" alt="">
    </picture>
  </div>

  <div class="high-openschool-inr">
    <section class="high-openschool-kv">
      <h2 class="TL">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-kv-ttl-sp.svg" type="image/svg+xml">
          <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-kv-ttl-pc.svg" alt="好きを見つける 体験会 OPEN SCHOOL">
        </picture>
      </h2>
      <div class="high-openschool-kv-schedule">
        <?php
        $schedules = class_exists('SCF') ? SCF::get('openschool_schedule') : array();
        $setsumeikai = array();
        $openschool = array();
        if (!empty($schedules)) {
          foreach ($schedules as $s) {
            if ($s['os_type'] === '説明会') $setsumeikai[] = $s;
            else $openschool[] = $s;
          }
        }
        ?>

        <?php if (!empty($setsumeikai)) : ?>
        <div class="kv-schedule-item">
          <p class="tg">説明会</p>
          <div class="TM-wrap">
            <?php foreach ($setsumeikai as $s) :
              $end_class = !empty($s['os_active']) ? '' : ' is-end';
              // 年があれば「2026.6.13」、なければ「8.22」
              $date_disp = !empty($s['os_year']) ? $s['os_year'] . '.' . $s['os_date'] : $s['os_date'];
            ?>
            <p class="TM<?php echo $end_class; ?>">
              <?php echo esc_html($date_disp); ?><span><?php echo esc_html($s['os_day_en']); ?></span>
            </p>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($openschool)) : ?>
        <div class="kv-schedule-item">
          <p class="tg">オープンスクール</p>
          <div class="TM-wrap">
            <?php foreach ($openschool as $s) :
              $end_class = !empty($s['os_active']) ? '' : ' is-end';
              $date_disp = !empty($s['os_year']) ? $s['os_year'] . '.' . $s['os_date'] : $s['os_date'];
            ?>
            <p class="TM<?php echo $end_class; ?>">
              <?php echo esc_html($date_disp); ?><span><?php echo esc_html($s['os_day_en']); ?></span>
            </p>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <div class="high-openschool-txt">
      <p class="TX">
        「ちょっと気になる！」<br>
        そんな気持ちがあれば大歓迎！<br>
        甲子園学院中学校の<br class="sp">オープンスクールでは、<br>
        学校の雰囲気や学び、<br>
        クラブ活動などを<br class="sp">楽しく体験できます。<br>
        あなたの“夢中”のきっかけを、<br>
        ぜひ見つけに来てください。
      </p>
    </div>

    <section class="high-openschool-date">
      <h3 class="high-openschool-date-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-date-ttl.svg" alt="開催日程">
      </h3>
      <div class="high-openschool-date-items js-fade">
        <?php if (!empty($schedules)) : foreach ($schedules as $s) :
          $end_class = !empty($s['os_active']) ? '' : ' is-end';
        ?>
        <div class="date-item<?php echo $end_class; ?>">
          <div class="date-item-inr">
            <p class="TG"><?php echo esc_html($s['os_type']); ?></p>
            <div class="DD-INFO-wrap">
              <p class="DD"><?php echo esc_html($s['os_date']); ?><span>（<?php echo esc_html($s['os_day_jp']); ?>）</span></p>
              <p class="INFO"><?php echo esc_html($s['os_time']); ?>&nbsp;&nbsp;/&nbsp;&nbsp;<br class="sp">会場：<?php echo esc_html($s['os_place']); ?></p>
            </div>
          </div>
          <div class="date-item-end">
            <p class="TX">終了しました</p>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
      <p class="high-openschool-date-txt">
      ※説明会、オープンスクールはいずれの日程も開始5分前までにお越しください。<br>
      ※詳細等については決定次第、ホームページ・インスタグラムにてお知らせいたします。
      </p>
    </section>

    <section class="high-openschool-agenda">
      <h3 class="high-openschool-agenda-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-ttl.svg" alt="当日の内容">
      </h3>
      <div class="high-openschool-agenda-items">
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-bg-01.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-01-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-01-pc.svg" alt="知れるコト01 教育方針やカリキュラム">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-bg-02.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-02-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-02-pc.svg" alt="知れるコト02 コース制について">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-bg-03.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-03-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-03-pc.svg" alt="知れるコト03 部活動 体験・見学">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-bg-04.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-04-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-04-pc.svg" alt="知れるコト04 校舎見学">
            </picture>
          </p>
        </div>
        <div class="agenda-item js-fade">
          <div class="agenda-item-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-bg-05.webp" alt="">
          </div>
          <p class="agenda-item-txt">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-05-sp.svg" type="image/svg+xml">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-openschool/junior-openschool-agenda-item-txt-05-pc.svg" alt="知れるコト05 制服試着">
            </picture>
          </p>
        </div>
      </div>
    </section>

    <section class="high-openschool-form">
      <h3 class="high-openschool-form-ttl js-fade">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-openschool/high-openschool-form-ttl.svg" alt="応募フォーム">
      </h3>
      <div class="p-openschool-form p-contact js-fade">
        <?php echo do_shortcode('[contact-form-7 id="65ce6b0" title="中学_応募フォーム"]'); ?>
      </div>

    </section>




  </div>
</main>


<?php get_template_part('./inc/footer'); ?>
