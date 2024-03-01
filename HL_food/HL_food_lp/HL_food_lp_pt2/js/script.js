$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('.navMenu').toggleClass("active");
   }); 

   $(".navMenu--item ul li a").on("click", function(){
    $('.burger').toggleClass("active");
    $('.navMenu').toggleClass("active");
  }); 


  // rellax
  var rellax = new Rellax('.rellax', {
    speed: -5,
    center: false,
    // wrapper: null,
    round: true,
    vertical: true,
    horizontal: false
  });


  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.up').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });


});