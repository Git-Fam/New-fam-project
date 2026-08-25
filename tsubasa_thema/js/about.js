$(function () {

	if (!window.Swiper) return;

	// クリニックの特徴
	new Swiper(".about-features-slider", {
		slidesPerView: 1,
		centeredSlides: true,
		loop: true,
		spaceBetween: 24,
		speed: 1000,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		navigation: {
			prevEl: ".about-features-slider-prev",
			nextEl: ".about-features-slider-next",
		},
		pagination: {
			el: ".about-features-slider-pagination",
			clickable: true,
		},
	});

	// 院内紹介（ドットなし / 名前クリックで対応スライドへ）
	var $introNames = $(".about-introduction-slider-names .item-name");
	var introSlider = new Swiper(".about-introduction-slider-content", {
		slidesPerView: 1,
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		navigation: {
			prevEl: ".about-introduction-slider-prev",
			nextEl: ".about-introduction-slider-next",
		},
		on: {
			init: function () {
				$introNames.eq(this.realIndex).addClass("is-active");
			},
			slideChange: function () {
				$introNames.removeClass("is-active").eq(this.realIndex).addClass("is-active");
			},
		},
	});

	$introNames.on("click", function () {
		var index = $(this).index();
		introSlider.slideToLoop(index);
	});

});
