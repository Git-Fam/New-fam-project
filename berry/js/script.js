$(function () {
	// ハンバーガーメニュー
	$(".menu-btn").on("click", function () {
		//  $(this).toggleClass("active");
		//  $('.menu').toggleClass("active");
		$("body").toggleClass("active");
		$("header").toggleClass("active");
	});

	// var prevScrollpos = window.pageYOffset;
	// window.onscroll = function() {
	//   var currentScrollpos = window.pageYOffset;
	//   if (prevScrollpos > currentScrollpos || currentScrollpos < 450) {
	//     document.querySelector(".header").classList.remove("active");
	//   } else {
	//     document.querySelector(".header").classList.add("active");
	//   }
	//   prevScrollpos = currentScrollpos;
	// }

	// 要素が画面下部に来たらshowを付与
	$(window).scroll(function () {
		$(".up,.down,.right,.left,.pop").each(function () {
			var top_of_element = $(this).offset().top;
			var bottom_of_window = $(window).scrollTop() + $(window).height();
			if (bottom_of_window > top_of_element) {
				$(this).addClass("show");
			}
		});
	});

	// ローディング
	// var loadingFinished = false;
	// var loading = $('.loadUp,.loadDown,.loadRight,.loadLeft,.loadPop');

	// $(window).on('load', function () {
	//   loading.addClass('show');
	//   loadingFinished = true;
	// });
	// setTimeout(function(){
	//   if (!loadingFinished) {
	//     loading.addClass('show');
	//   }
	// }, 2000);

	// アコーディオン
	// $('.js_onClick').on('click', function () {
	//   $(this).next().slideToggle();
	//   $(this).toggleClass('active');
	// });

	// カウントダウンの終了日時を設定
	// カウントダウンの終了日時を設定
	let countdownDate = new Date("2025-04-10T00:00:00");

	// カウントダウン計算関数
	function updateCountdown() {
		let now = new Date();
		let distance = countdownDate - now;
		let days = Math.floor(distance / (1000 * 60 * 60 * 24));

		if (distance < 0) {
			clearInterval(x);
			$(".countdown").html("<span>終了</span>");
		} else {
			// 日数を文字列に変換して一文字ずつspanで囲む
			let daysStr = days
				.toString()
				.split("")
				.map((num) => `<span>${num}</span>`)
				.join("");
			$(".days").html(daysStr);
		}
	}

	// 初回実行
	updateCountdown();

	// 30分ごとに更新
	let x = setInterval(updateCountdown, 1800000);
});

// 初回やリロード時は更新
// その後は30分ごとに更新

// // カウントダウンの終了日時を設定
// let countdownDate = new Date("2025-01-29T00:00:00");
// // カウントダウン計算関数
// function updateCountdown() {
// 	let now = new Date();
// 	let distance = countdownDate - now;
// 	let days = Math.floor(distance / (1000 * 60 * 60 * 24));

// 	if (distance < 0) {
// 		clearInterval(x);
// 		$("#countdown").html("<span>終了</span>");
// 	} else {
// 		$("#days").text(days + "日");
// 	}
// }
// // 初回実行
// updateCountdown();

// // 30分ごとに更新
// let x = setInterval(updateCountdown, 1800000);
