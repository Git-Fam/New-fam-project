<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main class="front">

	<!-- ===== hero ===== -->
	<section class="hero">
		<div class="hero__panel hero__panel--junior js-fade">
			<img class="hero__img" src="<?php echo get_template_directory_uri(); ?>/img/home/top/hero-junior.webp" alt="あなたの好きを応援する中学校　DIVE IN LOVE!">
			<div class="hero__body">
				<a class="hero__btn" href="<?php echo home_url('/junior/'); ?>">
					<span class="hero__btn-label">甲子園学院中学校</span>
					<span class="hero__btn-icon" aria-hidden="true">
						<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="10" cy="10" r="9.25" stroke="currentColor" stroke-width="1"/>
							<path d="M8.5 6.5L12.2 10L8.5 13.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</a>
			</div>
		</div>
		<div class="hero__panel hero__panel--high js-fade">
			<img class="hero__img" src="<?php echo get_template_directory_uri(); ?>/img/home/top/hero-high.webp" alt="あなたの好きを見つける高等学校　FIND LOVE!">
			<div class="hero__body">
				<a class="hero__btn" href="<?php echo home_url('/high/'); ?>">
					<span class="hero__btn-label">甲子園学院高等学校</span>
					<span class="hero__btn-icon" aria-hidden="true">
						<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="10" cy="10" r="9.25" stroke="currentColor" stroke-width="1"/>
							<path d="M8.5 6.5L12.2 10L8.5 13.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</a>
			</div>
		</div>
	</section>

    <!-- ============ NEWS ============ -->
    <section class="p-news">
    <div class="p-news__inner">
      <!-- タイトル行（タイトルのみ） -->
      <div class="p-news__head">
        <h2 class="p-news__ttl js-fade">
          <picture>
            <source media="(max-width: 767px)"
              srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/news_ttl_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/top/news_ttl_pc.webp"
              alt="NEWS 新着情報" class="p-news__ttl-img">
          </picture>
        </h2>
      </div>

      <!-- タブ行（タブ ＋ 一覧へ） -->
      <div class="p-news__tabrow js-fade">
        <div class="p-news__tabs" role="tablist">
          <button class="p-news__tab is-active" data-filter="all" type="button">すべて</button>
          <button class="p-news__tab" data-filter="info" type="button">お知らせ</button>
          <button class="p-news__tab" data-filter="exam" type="button">入試情報</button>
          <button class="p-news__tab" data-filter="event" type="button">イベント</button>
          <button class="p-news__tab" data-filter="club" type="button">部活動</button>
        </div>
        <a href="<?php echo home_url('/news/'); ?>" class="p-news__more p-news__more--pc">
           <span class="p-news__more-txt">お知らせ一覧へ</span>
           <span class="p-news__more-icon" aria-hidden="true"></span>
        </a>
      </div>

        <!-- カード（PCはグリッド / SPはSwiper） -->
        <div class="p-news__body js-fade">
        <div class="swiper p-news__slider">
            <ul class="swiper-wrapper p-news__list">
            <?php
            $news_query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));
            if ($news_query->have_posts()):
                while ($news_query->have_posts()): $news_query->the_post();

                // 日付（ACF: news_date。無ければ投稿日）
                $news_date = get_field('news_date');
                if (!$news_date) {
                    $news_date = get_the_date('Y.m.d');
                }

                // 内容カテゴリ（1件想定）
                $cats = get_the_terms(get_the_ID(), 'news_category');
                $cat_slug = ($cats && !is_wp_error($cats)) ? $cats[0]->slug : '';
                $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';

                // 学校区分（1件想定）
                $schools = get_the_terms(get_the_ID(), 'news_school');
                $school_slug = ($schools && !is_wp_error($schools)) ? $schools[0]->slug : '';
                $school_name = ($schools && !is_wp_error($schools)) ? $schools[0]->name : '';

                // サムネイル
               // サムネイル（ACF優先・配列/URL/未定義すべて安全に処理）
                $thumb = '';
                if (function_exists('get_field')) {
                    $thumb_raw = get_field('news_thumb');
                    if (is_array($thumb_raw)) {
                        $thumb = !empty($thumb_raw['url']) ? $thumb_raw['url'] : '';
                    } elseif (is_string($thumb_raw)) {
                        $thumb = $thumb_raw;
                    }
                }
                if (!$thumb) {
                    $thumb = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'medium')
                        : get_template_directory_uri() . '/img/common/noimage.svg';
                }
            ?>
            <li class="swiper-slide p-news__item"
                data-category="<?php echo esc_attr($cat_slug); ?>"
                data-school="<?php echo esc_attr($school_slug); ?>">
                <a href="<?php the_permalink(); ?>" class="p-news__card">
                <div class="p-news__thumb">
                    <?php if ($school_name): ?>
                    <span class="p-news__badge p-news__badge--<?php echo esc_attr($school_slug); ?>">
                        <?php echo esc_html($school_name); ?>
                    </span>
                    <?php endif; ?>
                    <img src="<?php echo esc_url($thumb); ?>" alt="" class="p-news__img">
                </div>
                <div class="p-news__meta">
                    <time class="p-news__date"><?php echo esc_html($news_date); ?></time>
                    <?php if ($cat_name): ?>
                    <span class="p-news__cat p-news__cat--<?php echo esc_attr($cat_slug); ?>">
                        <?php echo esc_html($cat_name); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <p class="p-news__text"><?php echo esc_html(get_the_title()); ?></p>
                </a>
            </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
            <li class="p-news__empty">現在お知らせはありません。</li>
            <?php endif; ?>
            </ul>
            <!-- SP用ページネーション -->
            <div class="p-news__pagination swiper-pagination"></div>
        </div>
        </div>

        <a href="<?php echo home_url('/news/'); ?>" class="p-news__more p-news__more--sp">
        お知らせ一覧へ <span class="p-news__more-icon" aria-hidden="true"></span>
        </a>
    </div>
    </section>

	<!-- ============ MESSAGE ============ -->
	<section class="p-message js-fade">
		<!-- 背景は将来<video>に差し替え予定。p-message__media の中身のみ入れ替えればよい -->
		<div class="p-message__media">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/manabu-bg-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/manabu-bg-pc.webp" alt="" class="p-message__img">
			</picture>
		</div>
		<div class="p-message__overlay" aria-hidden="true"></div>
		<p class="p-message__catch">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/manabu-txt-sp.svg">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/manabu-txt-pc.svg" alt="学ぶことは、心を磨くこと" class="p-message__catch-img">
			</picture>
		</p>
		<a class="p-message__brand" href="<?php echo home_url('/about/concept/'); ?>">
            <span class="p-message__brand-txt">BRAND CONCEPT</span>
            <span class="p-message__brand-icon" aria-hidden="true">
                <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="p-message__brand-circle" cx="20" cy="20" r="20" fill="#fff"/>
                    <path class="p-message__brand-arrow" d="M15 20H26M26 20L21 15M26 20L21 25" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </a>
	</section>

	<!-- ============ ABOUT ============ -->
	<section class="p-about">
		<div class="p-about__bg">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/about-bg-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/about-bg-pc.webp" alt="" class="p-about__bg-img">
			</picture>
		</div>
		<div class="p-about__inner js-fade">
			<p class="p-about__head">
				<picture>
					<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/about-title.webp">
					<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/about-title.webp" alt="ABOUT 学校案内" class="p-about__head-img">
				</picture>
			</p>
			<ul class="p-about__pills">
				<li class="p-about__pill-item">
					<a href="<?php echo home_url('/about/concept/'); ?>" class="p-about__pill">
						<span class="p-about__pill-txt">ごあいさつ</span>
						<span class="p-about__pill-icon" aria-hidden="true"></span>
					</a>
				</li>
				<li class="p-about__pill-item">
					<a href="<?php echo home_url('/about/history/'); ?>" class="p-about__pill">
						<span class="p-about__pill-txt">建学の精神</span>
						<span class="p-about__pill-icon" aria-hidden="true"></span>
					</a>
				</li>
				<li class="p-about__pill-item">
					<a href="<?php echo home_url('/about/history/#enkaku'); ?>" class="p-about__pill">
						<span class="p-about__pill-txt">沿革</span>
						<span class="p-about__pill-icon" aria-hidden="true"></span>
					</a>
				</li>
				<li class="p-about__pill-item">
					<a href="<?php echo home_url('/about/facility/'); ?>" class="p-about__pill">
						<span class="p-about__pill-txt">施設・設備</span>
						<span class="p-about__pill-icon" aria-hidden="true"></span>
					</a>
				</li>
				<li class="p-about__pill-item">
					<a href="<?php echo home_url('/about/facility/#access'); ?>" class="p-about__pill">
						<span class="p-about__pill-txt">アクセス</span>
						<span class="p-about__pill-icon" aria-hidden="true"></span>
					</a>
				</li>
			</ul>
		</div>
	</section>

	<!-- ============ UNIFORM ============ -->
	<section class="p-uniform">
		<div class="p-uniform__bg">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/uniform-bg-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/uniform-bg-pc.webp" alt="" class="p-uniform__bg-img">
			</picture>
		</div>
		<p class="p-uniform__text js-fade">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/uniform-title-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/uniform-title-pc.webp" alt="好きな自分で、学校へ行こう。 私服・制服併用制度スタート" class="p-uniform__text-img">
			</picture>
		</p>
		<a href="<?php echo home_url('/about/uniform/'); ?>" class="p-uniform__btn">
			<span class="p-uniform__btn-txt">制服紹介</span>
			<span class="p-uniform__btn-icon" aria-hidden="true"></span>
		</a>
	</section>

	<!-- ============ BANNERS ============ -->
	<section class="p-banners">

		<!-- OPEN SCHOOL -->
		<div class="p-banner p-banner--openschool js-fade">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/openschool-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/openschool-pc.webp" alt="OPEN SCHOOL オープンスクール" class="p-banner__img">
			</picture>
			<div class="p-banner__links">
				<a href="<?php echo home_url('/junior/openschool/'); ?>" class="p-banner__link">
					<span class="p-banner__link-txt">甲子園学院中学校</span>
					<span class="p-banner__link-icon" aria-hidden="true"></span>
				</a>
				<a href="<?php echo home_url('/high/openschool/'); ?>" class="p-banner__link">
					<span class="p-banner__link-txt">甲子園学院高等学校</span>
					<span class="p-banner__link-icon" aria-hidden="true"></span>
				</a>
			</div>
		</div>

		<!-- RECRUIT -->
		<a href="<?php echo home_url('/recruit/'); ?>" class="p-banner p-banner--recruit js-fade">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/recruit-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/recruit-pc.webp" alt="RECRUIT 教職員採用情報" class="p-banner__img">
			</picture>
		</a>

		<!-- GRADUATES -->
		<a href="<?php echo home_url('/alumni/'); ?>" class="p-banner p-banner--graduates js-fade">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/graduates-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/graduates-pc.webp" alt="GRADUATES 卒業生の方" class="p-banner__img">
			</picture>
		</a>

	</section>

	<!-- ============ VISION ============ -->
	<section class="p-vision js-fade">
		<a href="https://koshiengakuin.voiceados02.com/vision/" target="_blank" rel="noopener noreferrer" class="p-vision__link">
			<picture>
				<source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/top/vision-sp.webp">
				<img src="<?php echo get_template_directory_uri(); ?>/img/home/top/vision-pc.webp" alt="甲子園学院グループについて 99 YEARS VISION PROJECT 創立100周年を見据え、新たなプロジェクトを始動します。" class="p-vision__img">
			</picture>
		</a>
	</section>

</main>

<?php get_template_part('./inc/footer'); ?>
