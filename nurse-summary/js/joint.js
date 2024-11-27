$(function () {
	$("#tab-btn li").on("click", function () {
		let index = $("#tab-btn li").index(this);
		$("li").removeClass("active");
		$(this).addClass("active");
		$(".C_compare-tab-content table").hide();
		$(".C_compare-tab-content table").eq(index).show();
		return false;
	});
});

