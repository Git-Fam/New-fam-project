$(function () {
	var loadingFinished = false;
	var loading = $(".loadUp,.loadDown,.loadRight,.loadLeft,.loadPop,.loadscale");

	$(window).on("load", function () {
		loading.addClass("show");
		loadingFinished = true;
	});
	setTimeout(function () {
		if (!loadingFinished) {
			loading.addClass("show");
		}
	}, 2000);
});
