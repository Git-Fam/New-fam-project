$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('.menu').toggleClass("active");
     $('body').toggleClass("active");
   }); 

   $(".menu ul li a").on("click", function(){
    $('.menu').removeClass("active");
    $('.burger').removeClass("active");
    $('body').removeClass("active");
  }); 


  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.up , .down , .right , .left , .pop').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });

  // ローディングが終わったらshowを付与
  $(window).on('load', function () {
    $('.load_pop, .load_right').addClass('show');
  });



});
