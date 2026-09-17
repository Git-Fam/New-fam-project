<?php
/*
Template Name: 建学の精神・沿革
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--history">
<!-- ============ TITLE ============ -->
	<section class="p-about histry-kv">
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
					<a href="<?php echo home_url('/about/history/#seisin'); ?>" class="p-about__pill">
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
			</ul>
		</div>
	</section>

  <!-- ============ 進学の精神 ============ -->
  <!-- <section class="p-history-message js-fade" id="seisin">
     <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/history-message_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/history-message_pc.webp" alt="">
     </picture>
  </section> -->

  <section class="p-history-message" id="seisin">
    <div class="p-history-message__inner">

     <!-- 見出し「建学の精神」 -->
      <div class="p-history-message__head js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-ttl_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-ttl_pc.webp" alt="建学の精神">
        </picture>
      </div>

      <!-- 黽勉努力 -->
      <div class="p-history-message__block js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-01_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-01_pc.webp" alt="黽勉努力（びんべんどりょく）「黽勉」は、自らの心に従って自発的に勉め励む、自主創造の意味を持っています。また、一人ひとりが自らの人格陶冶に勉めるという意味も含まれています。">
        </picture>
      </div>

      <!-- 和衷協同 -->
      <div class="p-history-message__block js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-02_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-02_pc.webp" alt="和衷協同（わちゅうきょうどう）和やかに心をこめて力を合わせ、共に行動し、事に当たることをいい。自分だけでなく人と人との関係における心の持ち方を示します。">
        </picture>
      </div>

      <!-- 至誠一貫 -->
      <div class="p-history-message__block js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-03_sp.webp">
          <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/seishin-03_pc.webp" alt="至誠一貫（しせいいっかん）誠をもって人に接し、物事に対処して、一筋に真心を貫き通すことをいいます。真心は天に通じ、よい結果に至るという信念の下に、誠実な人間を育てることに勉めています。">
        </picture>
      </div>

    </div>
  </section>

  <!-- ============ 沿革 ============ -->
  <!-- <section class="p-history__year enkaku js-fade" id="enkaku">
     <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/history-year_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/history-year_pc.webp" alt="">
     </picture>
  </section> -->

  <!-- ============ 沿革 ============ -->
<section class="p-history__year enkaku" id="enkaku">
  <div class="p-history-year">
    <div class="p-history-year__panel js-fade">

      <!-- 見出し -->
      <div class="p-history-year__head">
        <picture>
            <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/history-yeartl_sp.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/history-yeartl_pc.webp" alt="">
        </picture>
      </div>

      <!-- タイムライン -->
      <dl class="p-history-year__list">

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1941</span>
            <span class="p-history-year__jp">昭和16年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">甲子園高等女学校設立認可<br>創立者久米長八、甲子園高等女学校初代校長に就任</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">甲子園高等女学校開校</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1948</span>
            <span class="p-history-year__jp">昭和23年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">7月</span><span class="p-history-year__txt">学制改革により、甲子園中学校・高等学校と改称</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1951</span>
            <span class="p-history-year__jp">昭和26年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">学校法人甲子園学院となり、久米長八初代学院長に就任<br>甲子園学院中学校・高等学校と改称</span></p>
            <p class="p-history-year__row"><span class="p-history-year__txt">創立10周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1954</span>
            <span class="p-history-year__jp">昭和29年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">久米長八初代学院長校長死去<br>久米利男第二代学院長、校長に就任</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1958</span>
            <span class="p-history-year__jp">昭和33年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">5月</span><span class="p-history-year__txt">本館（北館）第1期工事完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1959</span>
            <span class="p-history-year__jp">昭和34年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">本館（北館）第2期工事完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade mt-b">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1961</span>
            <span class="p-history-year__jp">昭和36年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">プール完成</span></p>
            <p class="p-history-year__row"><span class="p-history-year__txt">創立20周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1963</span>
            <span class="p-history-year__jp">昭和38年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">西館第1期工事完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1965</span>
            <span class="p-history-year__jp">昭和40年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">5月</span><span class="p-history-year__txt">西館第2期工事完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1971</span>
            <span class="p-history-year__jp">昭和46年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立30周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1973</span>
            <span class="p-history-year__jp">昭和48年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">11月</span><span class="p-history-year__txt">体育館完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1977</span>
            <span class="p-history-year__jp">昭和52年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">野外活動センター完成（三田市東山）</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1978</span>
            <span class="p-history-year__jp">昭和53年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">新体育館完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1980</span>
            <span class="p-history-year__jp">昭和55年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">12月</span><span class="p-history-year__txt">西館の増築および大改装完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1981</span>
            <span class="p-history-year__jp">昭和56年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立40周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1987</span>
            <span class="p-history-year__jp">昭和62年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">校祖生誕100年記念式典・記念行事</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1988</span>
            <span class="p-history-year__jp">昭和63年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">学院物故者慰霊塔建立（高野山）</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1991</span>
            <span class="p-history-year__jp">平成3年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立50周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1994</span>
            <span class="p-history-year__jp">平成6年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">第2土曜日を休業日とする</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1995</span>
            <span class="p-history-year__jp">平成7年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">1月</span><span class="p-history-year__txt">阪神・淡路大震災により被災<br>西館震災復旧補修工事</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">9月</span><span class="p-history-year__txt">北館取り壊し</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1996</span>
            <span class="p-history-year__jp">平成8年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">第4土曜日を休業日とする</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">1997</span>
            <span class="p-history-year__jp">平成9年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">1月</span><span class="p-history-year__txt">新校舎完成</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">西館取り壊し</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2001</span>
            <span class="p-history-year__jp">平成13年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立60周年を迎える<br>美術資料館開設</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2011</span>
            <span class="p-history-year__jp">平成23年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立70周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2015</span>
            <span class="p-history-year__jp">平成27年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">12月</span><span class="p-history-year__txt">久米利男第二代学院長死去</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2016</span>
            <span class="p-history-year__jp">平成28年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">1月</span><span class="p-history-year__txt">久米知子理事長、第三代学院長に就任</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">校舎地下練習場改築完成</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">高等学校新コース（6コース）スタート</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2017</span>
            <span class="p-history-year__jp">平成29年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">11月</span><span class="p-history-year__txt">体育館フロア整備工事完了</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2018</span>
            <span class="p-history-year__jp">平成30年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">9月</span><span class="p-history-year__txt">運動場第一期整備工事完了</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2019</span>
            <span class="p-history-year__jp">令和元年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">6月</span><span class="p-history-year__txt">本部正門移設工事完成</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2020</span>
            <span class="p-history-year__jp">令和2年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">2月</span><span class="p-history-year__txt">新型コロナウイルス感染拡大のため休学</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">3月</span><span class="p-history-year__txt">卒業式中止</span></p>
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">入学式（二部制）、45分・7時限授業開始</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2021</span>
            <span class="p-history-year__jp">令和3年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__txt">創立80周年を迎える</span></p>
          </dd>
        </div>

        <div class="p-history-year__item js-fade">
          <dt class="p-history-year__date">
            <span class="p-history-year__ad">2022</span>
            <span class="p-history-year__jp">令和4年</span>
          </dt>
          <dd class="p-history-year__body">
            <p class="p-history-year__row"><span class="p-history-year__month">4月</span><span class="p-history-year__txt">高等学校新コース制（2ステージ）スタート</span></p>
          </dd>
        </div>

      </dl>
    </div>
  </div>
</section>

</main>


<?php get_template_part('./inc/footer'); ?>