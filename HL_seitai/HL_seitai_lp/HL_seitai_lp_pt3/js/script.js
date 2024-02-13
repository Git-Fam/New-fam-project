$(function () {   



//   // ページtopから最後までの高さを取得、ページトップから100pxまで非表示と、その取得した高さ-200pxまでスクロールしたらボタンを非表示
// $(function(){
//   var btn = $('.followBtn');
//   var timer;
  
//   $(window).scroll(function() {
//     //スクロール開始するとボタンを非表示
//     btn.addClass('active');
    
//     //スクロール中はイベントの発火をキャンセルする
//     clearTimeout(timer);
    
//     //スクロールが停止して0.05秒後にイベントを発火する
//     timer = setTimeout(function() {
//       //スクロール位置を判定してページ上部のときはボタンを非表示にする
//       if($(this).scrollTop() >= $(document).height() - $(this).height() - 200 || $(this).scrollTop() <= 100) {
//         btn.addClass('active');
//       }else{
//         btn.removeClass('active');
//       }
//     }, 50);
//   });

// }
// );
 

    // ハンバーガーメニュー
    $(".burger").on("click", function(){
      $(this).toggleClass("active");
      $('nav').toggleClass("active");
      $('body').toggleClass("active");
    }); 

    $(".menu-nav a").on("click", function(){
      $('.burger').toggleClass("active");
      $('nav').toggleClass("active");
      $('body').toggleClass("active");
    }); 


      // アコーディオン
      const parentMenu = document.querySelectorAll('.tab--title');
      for (let i = 0; i < parentMenu.length; i++) {
        parentMenu[i].addEventListener('click', function() {
          this.classList.toggle('active');
          const circleArrow = this.querySelector('.tab--title');
          if (circleArrow) {
            circleArrow.classList.toggle('active');
          }
          this.nextElementSibling.classList.toggle('active');
        });
      }

    // headerの下部が.mainと重なったらheaderにactiveクラスを付与
    // $(window).scroll(function () {
    //   if ($(window).scrollTop() > $('.main').offset().top - 100) {
    //     $('header').addClass('active');
    //   } else {
    //     $('header').removeClass('active');
    //   }
    // });

    // 要素が画面下部に来たらshowを付与
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