$(function () {

	if (window.Swiper) {
		new Swiper(".type-swiper", {
			slidesPerView: 1,
			centeredSlides: true,
			loop: true,
			speed: 1000,
      autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				prevEl: ".type-swiper-prev",
				nextEl: ".type-swiper-next",
			},
			pagination: {
				el: ".type-swiper-pagination",
				clickable: true,
			},
		});
	}

});
