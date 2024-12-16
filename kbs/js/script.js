$(function () {
  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(".header--inner").toggleClass("active");
    $("body").toggleClass("active");
  });
  $(".header--nav").on("click", function () {
    $(".header--inner").removeClass("active");
    $("body").removeClass("active");
  });

  // スクロールでヘッダーをずらす
  var lastScrollTop = 0;
  $(window).scroll(function () {
    var kvHeight = $('.KV').outerHeight();
    var scrollTop = $(window).scrollTop();

    if (scrollTop >= kvHeight) {
      $('.header').addClass('active');
    } else {
      $('.header').removeClass('active');
    }

    if (scrollTop < lastScrollTop) {
      $('.header').removeClass('active');
    }

    lastScrollTop = scrollTop;
  });

  // ホバー
  // $(".C_selector .list").hover(function () {
  //   $(".C_selector .list").removeClass("active");
  //   $(this).addClass("active");
  // }, function () {
  //   $(this).removeClass("active");
  // });

  $(".C_selector .list").on("click", function () {
    $(".C_selector .list").removeClass("selected");
    $(this).addClass("selected");
  });

  // var prevScrollpos = window.pageYOffset;
  // window.onscroll = function() {
  //   var currentScrollpos = window.pageYOffset;
  //   if (prevScrollpos > currentScrollpos || currentScrollpos < 450) {
  //     document.querySelector(".header").classList.remove("active");
  //   } else {
  //     document.querySelector(".header").classList.add("active");
  //   }
  //   prevScrollpos = currentScrollpos;
  // }

  // // 要素が画面下部に来たらshowを付与
  // $(window).scroll(function () {
  //   $('.up,.roll').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


  // ローディング
  // var loadingFinished = false;
  // var loading = $('.loadUp');

  // $(window).on('load', function () {
  //   loading.addClass('show');
  //   loadingFinished = true;
  // });
  // setTimeout(function(){
  //   if (!loadingFinished) {
  //     loading.addClass('show');
  //   }
  // }, 2000);



});