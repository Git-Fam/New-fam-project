$(function () {
	// header が page_main_contents と重なる、またはその下にあるときに .is-color を付与
	var header = document.querySelector(".header");
	var pageMainContents = document.querySelector(".page_main_contents");

	function updateHeaderColorClass() {
		if (!header || !pageMainContents) return;
		var headerRect = header.getBoundingClientRect();
		var contentRect = pageMainContents.getBoundingClientRect();
		// 重なる: headerの下端がcontentの上端以上 かつ headerの上端がcontentの下端以下
		var isOverlap = headerRect.bottom >= contentRect.top && headerRect.top <= contentRect.bottom;
		// headerがpage_main_contentsより下にある
		var isHeaderBelow = headerRect.top >= contentRect.bottom;
		if (isOverlap || isHeaderBelow) {
			header.classList.add("is-color");
		} else {
			header.classList.remove("is-color");
		}
	}

	updateHeaderColorClass();
	window.addEventListener("scroll", updateHeaderColorClass, { passive: true });
	window.addEventListener("resize", updateHeaderColorClass);

	// ハンバーガーメニュー
	$(".burger").on("click", function () {
		$(".header").toggleClass("is-active");
		$('body').toggleClass("is-active");
	});
	$(".header a").on("click", function () {
		$('.header').removeClass("is-active");
		$('body').removeClass("is-active");
	});



	// 要素が画面下部に来たらshowを付与
	$(window).scroll(function () {
		$('.s-pop').each(function () {
			var top_of_element = $(this).offset().top;
			var bottom_of_window = $(window).scrollTop() + $(window).height();
			if (bottom_of_window > top_of_element) {
				$(this).addClass('show');
			}
		});
	});
	// ローディング
	// var loadingFinished = false;
	// var loading = $('.loadUp');
	// $(window).on('load', function () {
	//   loading.addClass('show');
	//   loadingFinished = true;
	// });
	// setTimeout(function(){
	//   if (!loadingFinished) {
	//     loading.addClass('show');
	//   }
	// }, 2000);
});
