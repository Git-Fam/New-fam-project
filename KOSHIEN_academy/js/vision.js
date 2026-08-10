$(function () {


	// 要素が画面下部に来たらshowを付与
	 $(window).scroll(function () {
    var top_of_value = $('#value').offset().top;
    var bottom_of_window = $(window).scrollTop() + $(window).height();

    if (bottom_of_window > top_of_value + 200) {
      $('.page-vision--inner').addClass('is-show');
    } else {
      $('.page-vision--inner').removeClass('is-show');
    }
  });
});
