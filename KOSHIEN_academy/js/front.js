$(function () {

	// お知らせフィルター（フロントのみ・リロードなしで切り替え）
	var $frontNews = $("#front_news");
	if ($frontNews.length) {
		$frontNews.on("click", ".filter-tab a", function (e) {
			e.preventDefault();
			var href = $(this).attr("href");
			if (!href || href.indexOf("#") === 0) return;
			var $tab = $(this).closest(".filter-tab");
			var $cardList = $frontNews.find(".card-list");
			if (!$cardList.length) return;
			$cardList.addClass("is-loading");
			$frontNews.find(".filter-tab").removeClass("is-active");
			$tab.addClass("is-active");
			fetch(href, { headers: { "X-Requested-With": "XMLHttpRequest" } })
				.then(function (res) { return res.text(); })
				.then(function (html) {
					var parser = new DOMParser();
					var doc = parser.parseFromString(html, "text/html");
					var newList = doc.querySelector("#front_news .card-list");
					if (newList) {
						$cardList[0].innerHTML = newList.innerHTML;
					}
				})
				.catch(function () {
					window.location.href = href;
				})
				.finally(function () {
					$cardList.removeClass("is-loading");
				});
			if (window.history && window.history.pushState) {
				window.history.pushState({ frontNews: href }, "", href);
			}
		});
		// ブラウザ戻る／進む対応（fetch のみでタブと内容を更新、pushState はしない）
		$(window).on("popstate", function (e) {
			var href = e.originalEvent.state && e.originalEvent.state.frontNews;
			if (!href) return;
			var $cardList = $frontNews.find(".card-list");
			$cardList.addClass("is-loading");
			$frontNews.find(".filter-tab").removeClass("is-active");
			$frontNews.find(".filter-tab a").filter(function () { return $(this).attr("href") === href; }).closest(".filter-tab").addClass("is-active");
			fetch(href).then(function (res) { return res.text(); }).then(function (html) {
				var doc = new DOMParser().parseFromString(html, "text/html");
				var newList = doc.querySelector("#front_news .card-list");
				if (newList) $cardList[0].innerHTML = newList.innerHTML;
			}).finally(function () { $cardList.removeClass("is-loading"); });
		});
	} else {
		// アーカイブなど他ページのタブ（従来どおり見た目のみ）
		$(".filter-tab").on("click", function () {
			$(".filter-tab").removeClass("is-active");
			$(this).addClass("is-active");
		});
	}

	// SP
	$(".filter-tabs .sp-opener").on("click", function () {
		$(".filter-tabs").addClass("is-open");
		$(".sp-opener-bg").addClass("is-open");
	});
	$(".filter-tab,.sp-opener-bg").on("click", function () {
		$(".filter-tabs").removeClass("is-open");
		$(".sp-opener-bg").removeClass("is-open");
	});


	// link_school (PC)
	$(".link_school .link--area ul li").hover(function () {
		$(this).index();
		$(".link_school .img--area ul li").removeClass("is-active").eq($(this).index()).addClass("is-active");
	});


	// // link_school (SP)
	// // 3秒でis-active-spを削除し、次のliにis-active-spを追加を繰り返し、最後のliになったら最初のliに戻る
	// setInterval(function () {
	// 	var $items = $(".link_school .img--area ul li");
	// 	var $current = $items.filter(".is-active-sp");
	// 	var currentIndex = $current.index();
	// 	var nextIndex = (currentIndex + 1) % $items.length;

	// 	$current.removeClass("is-active-sp");
	// 	$items.eq(nextIndex).addClass("is-active-sp");
	// }, 3000);

	// Slick: 768px未満のみ有効、768px以上では停止
	var SLICK_BREAKPOINT = 768;
	var $slickEl = $(".js-slick");
	if ($slickEl.length && typeof $slickEl.slick === "function") {
		function initSlickIfNeeded() {
			if ($(window).width() < SLICK_BREAKPOINT) {
				if (!$slickEl.hasClass("slick-initialized")) {
					$slickEl.slick({
						arrows: false,
						dots: true,
						autoplay: true,
						autoplaySpeed: 3000,
						slidesToShow: 1,
						infinite: true,
						centerMode: true,
						centerPadding: "5%",
					});
				}
			} else {
				if ($slickEl.hasClass("slick-initialized")) {
					$slickEl.slick("unslick");
				}
			}
		}
		initSlickIfNeeded();
		$(window).on("resize", initSlickIfNeeded);
	}



});
