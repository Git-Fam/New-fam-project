$(function () {
	// 100の値チェックとactiveクラス付与の関数
	function checkAndSetActive($progressBar) {
		var $updateItem = $progressBar.closest(".update--item");
		if ($progressBar.val() == 100) {
			$updateItem.addClass("active");
		} else {
			$updateItem.removeClass("active");
		}
	}

	// 初回ロード時に100の値を検出してactiveを付与
	$(".progressBar").each(function () {
		checkAndSetActive($(this));
	});

	// progressBarが100の時は、update--itemにactiveを付与
	$(".progressBar").on("input", function () {
		checkAndSetActive($(this));
	});
});
