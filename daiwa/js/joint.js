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

});