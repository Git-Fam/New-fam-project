$(function () {   
  // // ハンバーガーメニュー
  //  $(".burger").on("click", function(){
  //    $(this).toggleClass("active");
  //    $('.menu').toggleClass("active");
  //    $('body').toggleClass("active");
  //  }); 
  // $(".js-link,.menu").on("click", function(){
  //   $('.burger').removeClass("active");
  //   $('.menu').removeClass("active");
  //   $('body').removeClass("active");
  // });

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

  // 要素が画面下部に来たらshowを付与
  // $(window).scroll(function () {
  //   $('.up,.down,.right,.left,.pop').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


  // ローディング
  // var loadingFinished = false;
  // var loading = $('.loadUp,.loadDown,.loadRight,.loadLeft,.loadPop');

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