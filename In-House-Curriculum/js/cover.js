$(function () {
	// // 詳細ページのパンくずリストから戻ってくる
	if (selectCategory) {
		$(".archive--contents--items--wap").each(function () {
			// 現在の要素のクラスからカテゴリー名を取得
			const classes = $(this).attr("class").split(" ");
			if (classes.includes(selectCategory)) {
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});
	}
});


