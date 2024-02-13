$(function () {   
  // // ハンバーガーメニュー
   $(".burger--open").on("click", function(){
     $('.menu--back').toggleClass("active");
     $('.menu').toggleClass("active");
     $('body').toggleClass("active");
   }); 

    $(".burger--close").on("click", function(){
      $('.menu--back').toggleClass("active");
      $('.menu').toggleClass("active");
      $('body').toggleClass("active");
    }); 

    $(".menu--back").on("click", function(){
      $('.menu--back').toggleClass("active");
      $('.menu').toggleClass("active");
      $('body').toggleClass("active");
    }); 

    $(".menu--main li a").on("click", function(){
      $('.menu--back').toggleClass("active");
      $('.menu').toggleClass("active");
      $('body').toggleClass("active");
    }); 


    // スリック
    $(".slicker--menu").slick({
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
      });

       // スリック
    $(".slicker--facility").slick({
      autoplay: true,
      autoplaySpeed: 6000,
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
  //   $('.up').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


});