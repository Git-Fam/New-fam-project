$(function () {
  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(this).toggleClass("active");
    $('.header__nav,body').toggleClass("active");
  });

  // var prevScrollpos = window.pageYOffset;
  // window.onscroll = function() {
  //   var currentScrollpos = window.pageYOffset;
  //   if (prevScrollpos > currentScrollpos || currentScrollpos < 450) {
  //     document.querySelector(".header").classList.remove("active");
  //   } else {
  //     document.querySelector(".header").classList.add("active");
  //   }
  //   prevScrollpos = currentScrollpos;
  // }

  // // 要素が画面下部に来たらshowを付与
  // $(window).scroll(function () {
  //   $('.up,.roll').each(function () {
  //     var top_of_element = $(this).offset().top;
  //     var bottom_of_window = $(window).scrollTop() + $(window).height();
  //     if (bottom_of_window > top_of_element) {
  //       $(this).addClass('show');
  //     }
  //   });
  // });


  // ローディング
  var loadingFinished = false;
  var loading = $('.loadSunnyFront,.loadSunny');

  $(window).on('load', function () {
    loading.addClass('show');
    loadingFinished = true;
  });
  setTimeout(function(){
    if (!loadingFinished) {
      loading.addClass('show');
    }
  }, 2000);



});

// .whopperと.headerが重なったら
$(document).ready(function () {
  function checkOverlap() {
    var header = $('.header');
    var whopper = $('.whopper');

    var headerOffset = header.offset();
    var whopperOffset = whopper.offset();

    var headerBottom = headerOffset.top + header.outerHeight();
    var whopperTop = whopperOffset.top;

    if (headerBottom > whopperTop) {
      header.addClass('active');
    } else {
      header.removeClass('active');
    }
  }

  checkOverlap();

  $(window).on('scroll', function () {
    checkOverlap();
  });

  $(window).on('resize', function () {
    checkOverlap();
  });
});



// フラッシュアニメーション
const getRandomInt = (min, max) => {
  return Math.floor(Math.random() * (max - min) + min);
}

const ScrollAnimation = {
  instance: undefined,
  set() {
    this.instance = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if(entry.isIntersecting) {
            entry.target.classList.add('is-active');
          }
        });
      },
      {
        root: null,
        rootMargin: '0px',
        threshold: 0,
      }
    );
    
    const blocks = document.querySelectorAll('.title-anime');
    blocks.forEach((block) => {
      this.instance.observe(block);
    });
  },
};

const SplitText = (target) => {
  const splitElm = document.querySelectorAll(target);
  splitElm.forEach((el, index) => {
    let text = el.textContent;
    el.textContent = '';
    text = text.split('');
    let newText = '';
    text.forEach((t, index) => {
      newText += `<span data-random="${getRandomInt(1, 8)}">${t}</span>`;
    });
    el.insertAdjacentHTML('beforeend', newText);
  });
};

window.addEventListener('load', () => {
  SplitText('.text-split');
  ScrollAnimation.set();
});