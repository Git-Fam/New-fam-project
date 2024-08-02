$(function () {
  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(this).toggleClass("active");
    $('.header__nav,body').toggleClass("active");
  });

  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.Sunny').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });


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

  // formタブ切り替え
  $(".C_ContactTab__Buttons .BTN").on('click', function(){
    let index = $(".C_ContactTab__Buttons .BTN").index(this);
    $(".C_ContactTab__Buttons .BTN").removeClass("active");
    $(this).addClass("active");
    $(".C_ContactTab__former .former").removeClass("active");
    $(".C_ContactTab__former .former").eq(index).addClass("active");
    return false;
  });

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


// ホバーバブル
document.addEventListener('DOMContentLoaded', function() {
  const atWater = document.querySelector('.C_AtWater');
  const hoverBubbles = atWater.querySelector('.hover-bubbles');
  let targetX = 0, targetY = 0;
  let currentX = 0, currentY = 0;

  atWater.addEventListener('mouseenter', () => {
    hoverBubbles.classList.add('active');
  });

  atWater.addEventListener('mouseleave', () => {
    hoverBubbles.classList.remove('active');
  });

  atWater.addEventListener('mousemove', (e) => {
    const rect = atWater.getBoundingClientRect();
    targetX = e.clientX - rect.left;
    targetY = e.clientY - rect.top;
  });

  function updatePosition() {
    currentX += (targetX - currentX) * 0.1;
    currentY += (targetY - currentY) * 0.1;
  
    hoverBubbles.style.transform = `translate(calc(${currentX}px - 50%), calc(${currentY}px - 50%))`;
  
    requestAnimationFrame(updatePosition);
  }

  updatePosition();
});