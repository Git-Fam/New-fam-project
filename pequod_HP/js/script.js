$(function () {
  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(this).toggleClass("active");
    $('.header__nav,body').toggleClass("active");
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

$(document).ready(function () {
  function checkOverlap() {
    var header = $('.header');
    var whopper = $('.whopper');

    var headerOffset = header.offset();
    var whopperOffset = whopper.offset();

    var headerBottom = headerOffset.top + header.outerHeight();
    var whopperTop = whopperOffset.top;

    if (headerBottom > whopperTop) {
      header.addClass('active');
    } else {
      header.removeClass('active');
    }
  }

  checkOverlap();

  $(window).on('scroll', function () {
    checkOverlap();
  });

  $(window).on('resize', function () {
    checkOverlap();
  });
});