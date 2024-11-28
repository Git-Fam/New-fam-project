$(function () {
	$("#tab-btn li").on("click", function () {
		let index = $("#tab-btn li").index(this);
		$("li").removeClass("active");
		$(this).addClass("active");
		$(".C_compare-tab-content table").hide();
		$(".C_compare-tab-content table").eq(index).show();
		return false;
	});

	function updateRandomPeopleCount() {
		// 95から630の間でランダムな数を生成
		var min = 95;
		var max = 130;
		var randomPeopleCount = Math.floor(Math.random() * (max - min + 1)) + min;

		var today = new Date().toISOString().split("T")[0];

		localStorage.setItem("randomPeopleCount", randomPeopleCount);
		localStorage.setItem("randomPeopleDate", today);

		$(".counter-container .random-counter").text(randomPeopleCount);
	}

	var storedCount = localStorage.getItem("randomPeopleCount");
	var storedDate = localStorage.getItem("randomPeopleDate");
	var today = new Date().toISOString().split("T")[0];

	if (storedCount !== null && storedDate === today) {
		$(".counter-container .random-counter").text(storedCount);
	} else {
		updateRandomPeopleCount();
	}
});
