$(function () {

	if (window.Swiper) {
		new Swiper(".about-features-slider", {
			slidesPerView: 1,
			centeredSlides: true,
			loop: true,
			spaceBetween: 24,
			speed: 1000, // 切り替わりアニメーション（デフォルト200ms → ゆっくり）
			autoplay: {
				delay: 10000, // 自動スクロール間隔（5秒 → 10秒）
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
	}

});
