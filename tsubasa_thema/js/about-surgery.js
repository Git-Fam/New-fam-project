$(function () {

	if (window.Swiper) {
		new Swiper(".type-swiper", {
			slidesPerView: 1,
			centeredSlides: true,
			loop: true,
      autoplay: {
        delay: 5000,
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
