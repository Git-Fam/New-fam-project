$(function () {

	// お知らせフィルター
	// PC
	$(".filter-tab").on("click", function () {
		$(".filter-tab").removeClass("is-active");
		$(this).addClass("is-active");
	});

	// SP
	$(".filter-tabs .sp-opener").on("click", function () {
		$(".filter-tabs").addClass("is-open");
		$(".sp-opener-bg").addClass("is-open");
	});
	$(".filter-tab,.sp-opener-bg").on("click", function () {
		$(".filter-tabs").removeClass("is-open");
		$(".sp-opener-bg").removeClass("is-open");
	});

});
