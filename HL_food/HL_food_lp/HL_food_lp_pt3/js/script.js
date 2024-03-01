$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $('.header--nav').toggleClass("active");
     $('body').toggleClass("active");
   }); 

   $(".header--nav ul li a").on("click", function(){
    $('.header--nav').removeClass("active");
    $('body').removeClass("active");
  }); 

  $(".header--nav").on("click", function(){
    $('.header--nav').removeClass("active");
    $('body').removeClass("active");
  }); 


   
  //  // headerの下部が.mainと重なったらheaderにactiveクラスを付与
  //    $(window).scroll(function () {
  //      if ($(window).scrollTop() > $('.main').offset().top - 100) {
  //        $('header').addClass('active');
  //      } else {
  //        $('header').removeClass('active');
  //      }
  //    });

  // // 要素が画面下部に来たらshowを付与
  // $(window).scroll(function () {
  //   $('.up , .down , .right , .left , .pop').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


});

