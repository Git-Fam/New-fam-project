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
  <section class="p-history__year enkaku js-fade" id="enkaku">
     <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/history/history-year_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/history/history-year_pc.webp" alt="">
     </picture>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
