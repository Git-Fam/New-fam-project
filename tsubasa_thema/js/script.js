$(function () {
	// ハンバーガーメニュー
	$(".header-btn").on("click", function () {
		$('body').toggleClass("is-active");
	});

	// 	メニュー内のアコーディオン
	$(".main-list-item-accordion").on("click", function () {
		$(this).toggleClass("is-active");
	});

	// コンテンツボックスのアコーディオン
	$(".C_contents_box-accordion .accordion-ttl").on("click", function () {
		$(this).parent().toggleClass("is-active");
	});

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
