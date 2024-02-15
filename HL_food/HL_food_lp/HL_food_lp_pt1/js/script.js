$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('.menu').toggleClass("active");
   }); 
   $(".menu ul li a").on("click", function(){
    $(this).removeClass("active");
    $('.menu').removeClass("active");
    $('.burger').removeClass("active");
  }); 



  $(".menu--book--detail--page--img").on("click", function(){
    $('.menu--book--detail--page--title').toggleClass("active");
    $('.menu--book--detail--page--text').toggleClass("active");
  }); 

  $(".menu--book--detail--page--title").on("click", function(){
    $(this).removeClass("active");
    $('.menu--book--detail--page--text').removeClass("active");
  }); 

  $(".menu--book--detail--page--text").on("click", function(){
    $(this).removeClass("active");
    $('.menu--book--detail--page--title').removeClass("active");
  }); 
   

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

  // 画面上部から200pxスクロールしたら .followBtnに.activeを付与
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.followBtn').addClass('active');
    } else {
      $('.followBtn').removeClass('active');
    }
  });

});