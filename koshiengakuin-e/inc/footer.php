<?php wp_footer(); ?>

<!-- Footer top: CONTACT bar -->

<?php if (!is_page('contact') && !is_page('recruit')) { ?>
	<section class="p-footer-top p-footer-top--contact">
		<div class="p-footer-top__inner">
			<div class="p-footer-top__left">
				<h3 class="p-footer-top__eyebrow font-avenir-demibold">CONTACT</h3>
				<p class="p-footer-top__desc">ご質問・学校見学・オンライン学校説明など<br>ご希望の場合はフォーム・お電話からご連絡ください。</p>
			</div>
			<div class="p-footer-top__center">
				<a href="<?php echo home_url(); ?>/contact/" class="c-btn c-btn--white">
					<div class="c-btn__inner"><span>お問い合わせフォーム</span></div>
				</a>
				<div class="p-footer-top__tel">
					<span class="p-footer-top__tel__icon"><img src="<?php echo get_template_directory_uri(); ?>/img/icon_tel.webp" alt="TEL"></span>
					<a href="tel:0798672366" class="p-footer-top__tel__number font-avenir-demibold">0798-67-2366</a>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<footer class="footer">

	<div class="footer__inner">

		<div class="footer__logo">
			<img src="<?php echo get_template_directory_uri(); ?>/img/footer_logo.webp" alt="甲子園学院小学校 KOSHIEN GAKUIN ELEMENTARY SCHOOL">
		</div>

		<div class="footer__sns">
			<a href="https://line.me/R/ti/p/@971ursgn" target="_blank" class="footer__sns__link is-line fade"></a>
			<a href="https://www.instagram.com/koshiengakuin_els?igsh=MTJ3cWNocDhteTFuZw==" target="_blank" class="footer__sns__link is-instagram fade"></a>
			<a href="https://www.youtube.com/@koshiengakuin/shorts" target="_blank" class="footer__sns__link is-youtube fade"></a>
		</div>

		<p class="footer__address">〒663-8104　兵庫県西宮市天道町10－15 <br class="pc-none">TEL <a href="tel:0798-67-2366">0798-67-2366</a></p>

		<p class="footer__group">
			<img src="<?php echo get_template_directory_uri(); ?>/img/footer_group.webp" alt="甲子園学院 甲子園大学 甲子園短期大学 甲子園学院中学校・高等学校 甲子園学院幼稚園">
		</p>

		<ul class="footer__nav">
			<li><a href="<?php echo home_url(); ?>/access/">アクセス</a></li>
			<!-- <li><a href="#">緊急対応について</a></li> -->
			<li><a href="<?php echo home_url(); ?>/privacy-policy/">個人情報保護方針</a></li>
		</ul>

		<p class="footer__copyright">Copyright © Koshien University. All Rights Reserved.</p>

	</div>

</footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php if (is_page_template('pages/page-schedule.php')) : ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/schedule.js"></script>
<?php endif; ?>
</body>

</html>