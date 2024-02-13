$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('nav').toggleClass("active");
     $('body').toggleClass("active");
   }); 
   
   $(".menu a").on("click", function(){
    $(this).toggleClass("active");
    $('nav').toggleClass("active");
    $('body').toggleClass("active");
  }); 

   // headerがページの上部から100pxを超えたら.activeを付与する
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 100) {
        $('header').addClass('active');
      } else {
        $('header').removeClass('active');
      }
    });

    new ScrollHint('.trouble--contents', {
      suggestiveShadow: true,
      remainingTime: 9999999999,
      i18n: {
        scrollable: '横スクロール'
      }
    });
    
    // itemの表示非表示
    $(".show--btn").on("click", function(){
      $(this).toggleClass("active");
      $('.item.no').toggleClass("active");
    }); 

    // タブカテゴリー分け
    // 一旦うまくいかないからタブ切り替えで
    $(".tab--category").on("click", function(){
      let index = $(".tab--category").index(this);
      $(".tab--category").removeClass("active");
      $(this).addClass("active");
      $(".tab--tab").fadeOut(0);
      $(".tab--tab").eq(index).fadeIn(0);
    }); 

      // アコーディオン
      const parentMenu = document.querySelectorAll('.item--f');
      for (let i = 0; i < parentMenu.length; i++) {
        parentMenu[i].addEventListener('click', function() {
          this.classList.toggle('active');
          const circleArrow = this.querySelector('.item--f::before');
          if (circleArrow) {
            circleArrow.classList.toggle('active');
          }
          this.nextElementSibling.classList.toggle('active');
        });
      }


   

});
