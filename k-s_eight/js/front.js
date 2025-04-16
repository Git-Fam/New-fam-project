$(function () {
  // ローディング
  var loadingFinished = false;
  var loading = $('.KV__front--title');

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