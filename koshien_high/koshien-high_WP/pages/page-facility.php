<?php
/*
Template Name: 施設・設備・アクセス
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<?php
$theme_uri = get_template_directory_uri();
$img       = $theme_uri . '/img/home/facility';

// 校舎案内：階層とその階に含まれる部屋（フォルダ内の画像ファイル名 = スラッグ）
$campus_floors = array(
  array(
    'key'   => 'b1f',
    'label' => 'B1F',
    'rooms' => array(
      array('slug' => 'b1f-01-training', 'alt' => 'トレーニング室'),
      array('slug' => 'b1f-02-kendo',    'alt' => '剣道場（防音設備完備）'),
      array('slug' => 'b1f-03-brass',    'alt' => '吹奏楽練習室（防音設備完備）'),
      array('slug' => 'b1f-04-club',     'alt' => 'クラブ部室'),
    ),
  ),
  array(
    'key'   => '1f',
    'label' => '1F',
    'rooms' => array(
      array('slug' => '1f-01-entrance',   'alt' => 'エントランス'),
      array('slug' => '1f-02-library',    'alt' => '図書室'),
      array('slug' => '1f-03-staffroom',  'alt' => '職員室'),
      array('slug' => '1f-04-meeting',    'alt' => '会議室'),
      array('slug' => '1f-05-reception',  'alt' => '応接室'),
      array('slug' => '1f-06-counseling', 'alt' => '教育相談室'),
    ),
  ),
  array(
    'key'   => '2-4f',
    'label' => '2〜4F',
    'rooms' => array(
      array('slug' => '2-4f-01-classroom', 'alt' => '普通教室'),
      array('slug' => '2-4f-02-science',   'alt' => '理科室'),
      array('slug' => '2-4f-03-av',        'alt' => '視聴覚室'),
      array('slug' => '2-4f-04-cooking',   'alt' => '調理室'),
      array('slug' => '2-4f-05-sewing',    'alt' => '被服室'),
      array('slug' => '2-4f-06-career',    'alt' => '進路相談室'),
      array('slug' => '2-4f-07-study',     'alt' => '自習室'),
    ),
  ),
  array(
    'key'   => '5f',
    'label' => '5F',
    'rooms' => array(
      array('slug' => '5f-01-hall',        'alt' => '講堂'),
      array('slug' => '5f-02-music',       'alt' => '音楽室'),
      array('slug' => '5f-03-art',         'alt' => '美術室'),
      array('slug' => '5f-04-tea',         'alt' => '茶室'),
      array('slug' => '5f-05-calligraphy', 'alt' => '書道室'),
      array('slug' => '5f-06-computer',    'alt' => 'コンピュータ室'),
    ),
  ),
  array(
    'key'   => 'other',
    'label' => 'その他',
    'rooms' => array(
      array('slug' => 'other-01-cafeteria', 'alt' => '食堂・喫茶'),
    ),
  ),
);

// FACILITIES：1〜5の紹介画像（PC/SPで差し替え）
$facility_points = array(
  array('num' => 1, 'alt' => '学びを支える様々な設備'),
  array('num' => 2, 'alt' => '冷暖房完備で快適な環境'),
  array('num' => 3, 'alt' => '抜群な耐震性'),
  array('num' => 4, 'alt' => '美術資料館 久米アートミュージアム'),
  array('num' => 5, 'alt' => '万全な安全対策'),
);

$school_address = '兵庫県西宮市瓦林町4-25 甲子園学院中学校・高等学校';
?>

<main class="page page--facility">

  <!-- ============ KV ============ -->
  <section class="p-facility-hero">
    <picture class="p-facility-hero__pic">
      <source media="(max-width:767px)" srcset="<?php echo $img; ?>/hero_sp.webp">
      <img src="<?php echo $img; ?>/hero_pc.webp" alt="" class="p-facility-hero__img">
    </picture>
    <div class="p-facility-hero__body">
     <p class="p-facility__head js-fade">
				<picture>
					<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/about-title.webp">
					<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/about-title.webp" alt="ABOUT 学校案内" class="p-about__head-img">
				</picture>
			</p>
      <ul class="p-facility-hero__nav">
        <li class="p-about__pill-item js-fade">
          <a href="#facilities" class="p-about__pill">
            <span class="p-about__pill-txt">施設・設備</span>
            <span class="p-about__pill-icon" aria-hidden="true"></span>
          </a>
        </li>
        <li class="p-about__pill-item js-fade">
          <a href="#access" class="p-about__pill">
            <span class="p-about__pill-txt">アクセス</span>
            <span class="p-about__pill-icon" aria-hidden="true"></span>
          </a>
        </li>
      </ul>
    </div>
  </section>

  <!-- ============ FACILITIES ============ -->
  <section class="p-facility" id="facilities">
    <div class="p-facility__title js-fade">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo $img; ?>/facilities_title_sp.webp">
        <img src="<?php echo $img; ?>/facilities_title_pc.webp" alt="FACILITIES 設備・施設" class="p-facility__title-img">
      </picture>
    </div>


    <!-- ============ 設備・施設 ============ -->
    <ul class="p-facility__list">
      <?php foreach ($facility_points as $point) : ?>
        <li class="p-facility__item js-fade">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo $img; ?>/facilities_item<?php echo $point['num']; ?>_sp.webp">
            <img src="<?php echo $img; ?>/facilities_item<?php echo $point['num']; ?>_pc.webp" alt="<?php echo esc_attr($point['alt']); ?>" class="p-facility__item-img" loading="lazy">
          </picture>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <!-- ============ 校舎案内 ============ -->
  <section class="p-campus" id="campus">
    <div class="campus_TL sp">
      <img src="<?php echo get_template_directory_uri(); ?>/img/home/facility/campus_TL_sp.webp" alt="">
    </div>
    <div class="p-campus__inner">
      <aside class="p-campus__nav pc">
        <div class="p-campus__nav-inner">
          <p class="p-campus__nav-title">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/facility/campus_TL_pc.webp" alt="">
          </p>
          <ul class="p-campus__nav-list" id="js-campus-nav">
            <?php foreach ($campus_floors as $i => $floor) : ?>
              <li class="p-campus__nav-item<?php echo $i === 0 ? ' is-active' : ''; ?>" data-floor="<?php echo esc_attr($floor['key']); ?>">
                <?php echo esc_html($floor['label']); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </aside>

      <div class="p-campus__gallery" id="js-campus-gallery">
        <?php foreach ($campus_floors as $floor) : ?>
          <div class="p-campus__floor" data-floor-section="<?php echo esc_attr($floor['key']); ?>">
            <p class="p-campus__floor-label sp"><?php echo esc_html($floor['label']); ?></p>
            <div class="p-campus__grid">
              <?php foreach ($floor['rooms'] as $room) : ?>
                <figure class="p-campus__photo js-fade">
                  <img src="<?php echo $img; ?>/gallery/<?php echo esc_attr($room['slug']); ?>.webp" alt="<?php echo esc_attr($room['alt']); ?>" loading="lazy">
                </figure>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- ============ アクセス ============ -->
  <section class="p-access" id="access">
    <div class="p-access__title js-fade">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo $img; ?>/access_title_sp.webp">
        <img src="<?php echo $img; ?>/access_title_pc.webp" alt="ACCESS アクセス" class="p-access__title-img">
      </picture>
    </div>

    <div class="p-access__text">
      <p class="p-access__address sp js-fade">〒663-8107　兵庫県西宮市瓦林町4-25　<br class="sp">Tel 0798-65-6100</p>
    </div>
    <div class="p-access__block p-access__block--map">
      <div class="p-access__map">
        <iframe
          src="https://www.google.com/maps?q=<?php echo rawurlencode($school_address); ?>&output=embed"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="甲子園学院中学校・高等学校 地図"></iframe>
      </div>
      <div class="p-access__text js-fade">
        <p class="p-access__address pc">〒663-8107　兵庫県西宮市瓦林町4-25　Tel 0798-65-6100</p>
        <p class="p-access__route">
          <span class="p-access__mark">■</span>JR甲子園口駅から徒歩約7分<br>
          <span class="p-access__mark">■</span>阪急西宮北口駅から徒歩約15分　<br class="sp"><span class="p-access__mark">■</span>阪急バス甲子園学院前下車
        </p>
      </div>
    </div>

    <div class="p-access__block p-access__block--illustration pc js-fade">
      <img src="<?php echo $img; ?>/access_map_illustration.webp" alt="甲子園学院中学校・高等学校までのアクセスマップ">
    </div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
