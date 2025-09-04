$(function () {
	// 初期クラス設定
	updateMyInfoClass();

	// ランキングの切り替えイベント
	$(".switch-btn01, .switch-btn02").on("click", function () {
		setTimeout(updateMyInfoClass, 50); // 50ms の遅延を追加
	});

	function updateMyInfoClass() {
		const $myInfo = $(".my-info");
		const $numberElement = $myInfo.find(".result:visible .number"); // 表示されている .number を取得

		// 既存のランククラスを削除
		$myInfo.removeClass("rank-1 rank-2 rank-3");

		if ($numberElement.length > 0) {
			const rank = parseInt($numberElement.text().trim(), 10);

			// ランクに応じてクラスを追加
			if (rank === 1) {
				$myInfo.addClass("rank-1");
			} else if (rank === 2) {
				$myInfo.addClass("rank-2");
			} else if (rank === 3) {
				$myInfo.addClass("rank-3");
			}
		} else {
			console.error("表示されている `.number` 要素が見つかりません。");
		}
	}

	// ランキングボタンの切り替え処理
	$(".ranking-btn").on("click", function () {
		$(".btn-area").toggleClass("click");

		if (!$("#point-ranking").hasClass("hidden")) {
			$(".switch-btn01")
				.removeClass("coin-rank point-rank")
				.addClass("progress-rank")
				.html('<p class="switch-btn-TX progress-rank-TX">成長ランキング</p>');
			$(".switch-btn02")
				.removeClass("progress-rank point-rank")
				.addClass("coin-rank")
				.html('<p class="switch-btn-TX coin-rank-TX">コインランキング</p>');
		}

		if (!$("#coin-ranking").hasClass("hidden")) {
			$(".switch-btn01")
				.removeClass("coin-rank point-rank")
				.addClass("progress-rank")
				.html('<p class="switch-btn-TX progress-rank-TX">成長ランキング</p>');
			$(".switch-btn02")
				.removeClass("progress-rank point-rank")
				.addClass("point-rank")
				.html('<p class="switch-btn-TX point-rank-TX">ポイントランキング</p>');
		}

		if (!$("#progress-ranking").hasClass("hidden")) {
			$(".switch-btn01")
				.removeClass("coin-rank progress-rank")
				.addClass("point-rank")
				.html('<p class="switch-btn-TX coin-rank-TX">ポイントランキング</p>');
			$(".switch-btn02")
				.removeClass("progress-rank point-rank")
				.addClass("coin-rank")
				.html('<p class="switch-btn-TX coin-rank-TX">コインランキング</p>');
		}
	});
	$(".switch-btn").on("click", function () {
		$(".btn-area").removeClass("click");
	})


	// ランキング切り替え処理
	$(document).on("click", ".progress-rank", function () {
		$("#point-ranking, #point-info, #coin-ranking, #coin-info").addClass(
			"hidden"
		);
		$("#progress-ranking, #progress-info").removeClass("hidden");
	});

	$(document).on("click", ".coin-rank", function () {
		$(
			"#point-ranking, #point-info, #progress-ranking, #progress-info"
		).addClass("hidden");
		$("#coin-ranking, #coin-info").removeClass("hidden");
	});

	$(document).on("click", ".point-rank", function () {
		$("#coin-ranking, #coin-info, #progress-ranking, #progress-info").addClass(
			"hidden"
		);
		$("#point-ranking, #point-info").removeClass("hidden");
	});
});
