$(function () {
	// 要素が画面下部に来たらshowを付与
	$(window).scroll(function () {
		$(".imgAnime , .right").each(function () {
			var top_of_element = $(this).offset().top;
			var bottom_of_window = $(window).scrollTop() + $(window).height();
			if (bottom_of_window > top_of_element) {
				$(this).addClass("show");
			}
		});
	});
});
