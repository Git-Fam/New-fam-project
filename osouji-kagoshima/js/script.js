$(function () {
  $('.menu-btn').on('click', function () {
    $('.menu').toggleClass('is-active');
  });
}());

jQuery(function ($) {
  $(document).ready(function () {
    $('.accordion_title').click(function () {
      var $accordionInr = $(this).siblings('.accordion_001_inr');
      var isOpen = $accordionInr.hasClass('active');

      // 他のアコーディオンを閉じる
      $('.accordion_001_inr.active').slideUp(0, function () {
        $(this).removeClass('active');
        $(this).siblings('.accordion_title').find('.pointer').removeClass('active'); // 矢印を上向きに
      });

      if (isOpen) {
        $accordionInr.slideUp(0, function () {
          $accordionInr.removeClass('active');
          $(this).siblings('.accordion_title').find('.pointer').removeClass('active'); // 矢印を上向きに
        });
      } else {
        $accordionInr.addClass('active').slideDown(0);
        $(this).find('.pointer').addClass('active'); // 矢印を下向きに
      }
      return false;
    });
  });
});

function fadeAnime() {
  $('.fadeUpTrigger').each(function () {
    var elemPos = $(this).offset().top - 10;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeUp');
    } else {
      $(this).removeClass('fadeUp');
    }
  });

  $('.fadeInTrigger').each(function () {
    var elemPos = $(this).offset().top - 10;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeIn');
    } else {
      $(this).removeClass('fadeIn');
    }
  });

  $('.fadeLeftTrigger').each(function () { //fadeLeftTriggerというクラス名が
    var elemPos = $(this).offset().top - 10; //要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeLeft'); // 画面内に入ったらfadeLeftというクラス名を追記
    } else {
      $(this).removeClass('fadeLeft'); // 画面外に出たらfadeLeftというクラス名を外す
    }
  });

  $('.fadeRightTrigger').each(function () { //fadeRightTriggerというクラス名が
    var elemPos = $(this).offset().top - 50; //要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeRight'); // 画面内に入ったらfadeRightというクラス名を追記
    } else {
      $(this).removeClass('fadeRight'); // 画面外に出たらfadeRightというクラス名を外す
    }
  });
}
$(window).scroll(function () {
  fadeAnime(); /* アニメーション用の関数を呼ぶ*/
});


// ページtopから最後までの高さを取得、ページトップから100pxまで非表示と、その取得した高さ-200pxまでスクロールしたらボタンを非表示
$(function(){
  var btn = $('.follow--btn');
  var timer;
  
  $(window).scroll(function() {
    //スクロール開始するとボタンを非表示
    btn.removeClass('is-active');
    
    //スクロール中はイベントの発火をキャンセルする
    clearTimeout(timer);
    
    //スクロールが停止して0.2秒後にイベントを発火する
    timer = setTimeout(function() {
      //スクロール位置を判定してページ上部のときはボタンを非表示にする
      if($(this).scrollTop() >= $(document).height() - $(this).height() - 200 || $(this).scrollTop() <= 100) {
        btn.removeClass('is-active');
      }else{
        btn.addClass('is-active');
      }
    }, 200);
  });

}
);