$(function () {
	// ハンバーガーメニュー
	$(".header-btn").on("click", function () {
		$('body').toggleClass("is-active");
	});

	$(".header-menu .header-menu-nav .main-list .main-list-item a , .header-menu .header-menu-nav .main-list .main-list-item .main-list-inr .ain-list-item-inr a").on("click", function () {
		$('body').removeClass("is-active");
	});


	// 	メニュー内のアコーディオン
	$(".main-list-item-accordion").on("click", function () {
		$(this).toggleClass("is-active");
	});

	// コンテンツボックスのアコーディオン
	$(".C_contents_box-accordion .accordion-ttl").on("click", function () {
		$(this).parent().toggleClass("is-active");
	});

	// footer-mainにreserve-btnが重なっている時は、reserve-btnを非表示
	var reserveBtn = document.querySelector('.reserve-btn');
	var footerMain = document.querySelector('.footer-main');
	if (reserveBtn && footerMain && 'IntersectionObserver' in window) {
		var reserveObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				// footer-mainが画面内に入る＝reserve-btnと重なる
				if (entry.isIntersecting) {
					reserveBtn.classList.add('is-footer-hidden');
				} else {
					reserveBtn.classList.remove('is-footer-hidden');
				}
			});
		}, { root: null, threshold: 0 });
		reserveObserver.observe(footerMain);
	}

	// 要素が画面下部に来たらshowを付与
	// $(window).scroll(function () {
	//   $('.up,.roll').each(function () {
	//     var top_of_element = $(this).offset().top;
	//     var bottom_of_window = $(window).scrollTop() + $(window).height();
	//     if (bottom_of_window > top_of_element) {
	//       $(this).addClass('show');
	//     }
	//   });
	// });
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
