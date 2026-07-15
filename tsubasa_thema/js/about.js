$(function () {

	if (window.Swiper) {
		new Swiper(".about-features-slider", {
			slidesPerView: 1,
			centeredSlides: true,
			loop: true,
			spaceBetween: 24,
      autoplay: {
        delay: 5000,
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
