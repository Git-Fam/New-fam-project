// タブ切り替え

// $(function () {
// 	window.updateArchiveItemActive = function () {
// 		$(".archive--item").removeClass("active");
// 		const $activeWap = $(".archive--contents--items--wap.active").first();
// 		if ($activeWap.length) {
// 			const classes = $activeWap.attr("class").split(" ");
// 			const categoryClass = classes.find(
// 				(c) => c !== "archive--contents--items--wap" && c !== "active"
// 			);
// 			if (categoryClass) {
// 				$(".archive--item").each(function () {
// 					const tx = $(this).find(".TX").text().trim();
// 					if (tx === categoryClass) {
// 						$(this).addClass("active");
// 					}
// 				});
// 			}
// 		}
// 	};
// 	// 初回だけ呼んでおく（多重呼び出しOK）
// 	window.updateArchiveItemActive();
// });
