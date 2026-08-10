$(function () {
	// ハンバーガーメニュー
	$(".burger").on("click", function () {
		$('.header').toggleClass("is-active");
		$('body').toggleClass("is-active");
	});
	$(".header-nav a").on("click", function () {
		$('.header').removeClass("is-active");
		$('body').removeClass("is-active");
	});


	// ヘッダー：ページトップから数px離れたらis-scrollを付与
	// var scrollThreshold = 5;
	// $(window).on("scroll", function () {
	// 	$(".header").toggleClass("is-scroll", $(window).scrollTop() > scrollThreshold);
	// }).trigger("scroll");


	// TOP以外は常時is-scrollを付与
	if (!$('body').hasClass('home')) {
		// TOP以外は最初からis-scrollを付与、header-translateを外す
		$(".header").addClass("is-scroll").removeClass("header-translate");
	} else {
		// TOPだけスクロール判定
		var scrollThreshold = 5;
		$(window).on("scroll", function () {
			$(".header").toggleClass("is-scroll", $(window).scrollTop() > scrollThreshold);
		}).trigger("scroll");
}



	// 要素が画面下部に来たらshowを付与
	$(window).scroll(function () {
		$('.anime-fade').each(function () {
			var top_of_element = $(this).offset().top;
			var bottom_of_window = $(window).scrollTop() + $(window).height();
			if (bottom_of_window > top_of_element) {
				$(this).addClass('is-show');
			}
		});
	});

});
