// $(".burger").on("click", function () {
//     $(this).toggleClass("active");
//     $('.menu').toggleClass("active");
//     $('body').toggleClass("active");
// });

// $(".C_header nav ul li a , .header--logo").on("click", function () {
//     $('.burger').removeClass("active");
//     $('.menu').removeClass("active");
//     $('body').removeClass("active");
// });

// // 画面幅768px以上の時.burger、.menu、bodyからactiveクラスを削除
// $(window).resize(function () {
//   if ($(window).width() > 767) {
//     $('.burger').removeClass("active");
//     $('.menu').removeClass("active");
//     $('body').removeClass("active");
//   }
// });

$(document).ready(function () {
  function toggleActiveClasses() {
    if ($(window).width() <= 767) {
      $('.burger').toggleClass("active");
      $('.menu').toggleClass("active");
      $('body').toggleClass("active");
    } else {
      $('.burger, .menu, body').removeClass("active");
    }
  }

  $(".burger").on("click", function () {
    toggleActiveClasses();
  });

  $(".C_header nav ul li a ").on("click", function () {
    if ($(window).width() <= 767) {
      toggleActiveClasses();
    }
  });

  // ウィンドウのリサイズ時に処理を実行
  $(window).resize(function () {
    toggleActiveClasses();
  });
});

$(function () {



  // アコーディオン
    $('.item--Q').on('click',function(){
        $(this).next().toggleClass('active');
        $(this).find('.cArrow').toggleClass('active');
    });
  
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
  //   $('.up, .about--img--mask,.about--mask,.h22 h2 span').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


  // アコーディオン
  const parentMenu = document.querySelectorAll('.year--list--title');
  for (let i = 0; i < parentMenu.length; i++) {
    parentMenu[i].addEventListener('click', function () {
      this.classList.toggle('active');
      const circleArrow = this.querySelector('year--list--title');
      if (circleArrow) {
        circleArrow.classList.toggle('active');
      }
      this.nextElementSibling.classList.toggle('active')
    });
  }


  // $('select').on('change', function () {
  //   if ($(this).val() == "") {//first_as_labelのvalueは空文字で出力される。
  //     $(this).css('color', '#9F9F9F')
  //   } else {
  //     $(this).css('color', '#333')
  //   }
  // });


  $('.multiple-items').slick({
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
        }
      }
    ]
  });

   // スリック
   $('.slick__fv').slick({
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    adaptiveHeight: true,
    arrows: false,
    dots: true,

  });



});