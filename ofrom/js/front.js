$(function () {

	// ローディング
	var loadingFinished = false;
	var loading_header = $('.header_inner');
	var loading_kv = $('.front_kv .TL');
	$(window).on('load', function () {
		loading_header.removeClass('is-loading');
		loading_kv.removeClass('is-loading');
		loadingFinished = true;
	});
	setTimeout(function () {
		if (!loadingFinished) {
			loading_header.removeClass('is-loading');
			loading_kv.removeClass('is-loading');
		}
	}, 2000);

});
