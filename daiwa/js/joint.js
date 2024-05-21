$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).addClass("active");
     $('.C_nav').addClass("active");
     $('body').addClass("active");
   }); 
   $(".C_nav--close").on("click", function(){
    $('.C_nav').removeClass("active");
    $('body').removeClass("active");
  }); 


    // 要素が画面下部に来たらshowを付与
    $(window).scroll(function () {
      $('.bon').each(function () {
        var top_of_element = $(this).offset().top;
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        if (bottom_of_window > top_of_element) {
          $(this).addClass('show');
        }
      });
    });

    $(".btn__area .TX").hover(function(){
      $(this).toggleClass("active");
      $(".btn__area .hr").toggleClass("active");
      $(".C_ServiceBtn .circle").toggleClass("active");
    });

});