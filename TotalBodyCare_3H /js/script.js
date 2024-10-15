$(function () {   

  // ハンバーガーメニュー
  $(".burger").on("click", function () {
      $('.menu--back').toggleClass("active");
      $('.header--nav').toggleClass("active");
      $('body').toggleClass("active");
  });

  $(".header--nav ul li a ").on("click", function () {
      $('.menu--back').removeClass("active");
      $('.header--nav').removeClass("active");
      $('body').removeClass("active")
  });

  $(".menu--back").on("click", function () {
    $(this).removeClass("active");
    $('.header--nav').removeClass("active");
    $('body').removeClass("active")
});



  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.up,.title--br').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      } else {
        $(this).removeClass('show');
      }
    });
  });


});