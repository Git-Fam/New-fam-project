$(function () {
  // ローディング
  var loadingFinished = false;
  var loading = $('.KV__all--title');

  $(window).on('load', function () {
    loading.addClass('is-active');
    loadingFinished = true;
  });
  setTimeout(function () {
    if (!loadingFinished) {
      loading.addClass('is-active');
    }
  }, 2000);

});