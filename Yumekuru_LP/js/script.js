$(function () {

  // ローディング
  var loadingFinished = false;
  var loading = $('.loading');
  var minTime = 2000; // 最低2秒
  var maxTime = 4000; // 最長4秒
  var startTime = Date.now();

  $(window).on('load', function () {
    var elapsedTime = Date.now() - startTime;
    var remainingTime = Math.max(0, minTime - elapsedTime);

    setTimeout(function () {
      loading.removeClass('active');
      loadingFinished = true;

      // ローディング終了後0.5秒後に.KVにactiveを付与
      setTimeout(function () {
        $('.KV').addClass('active');
      }, 1000);
    }, remainingTime);
  });

  // 最長4秒で強制的に終了
  setTimeout(function () {
    if (!loadingFinished) {
      loading.removeClass('active');
      loadingFinished = true;

      // ローディング終了後0.5秒後に.KVにactiveを付与
      setTimeout(function () {
        $('.KV').addClass('active');
      }, 1000);
    }
  }, maxTime);


  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $('.header').toggleClass("active");
    $('body').toggleClass("active");
  });
  $(".js-link,.logo").on("click", function () {
    $('.header').removeClass("active");
    $('body').removeClass("active");
  });

  // ホバー
  $(".animal").hover(function () {
    var $this = $(this);
    var $voiceBlock = $this.closest('.C_voice');
    var index = $this.index();
    $voiceBlock.find(".message").eq(index).addClass("show");

  }, function () {
    var $this = $(this);
    var $voiceBlock = $this.closest('.C_voice');
    $voiceBlock.find(".message").removeClass("show");
  });


  // 着せ替え
  $('.C_dress_up-tab').on('click', function () {
    var dressUpTab = $(this).index();
    $(this).addClass('is-active');
    $(this).siblings().removeClass('is-active');
    $('.C_dress_up-content').eq(dressUpTab).fadeIn().addClass('is-active');
    $('.C_dress_up-content').eq(dressUpTab).siblings().fadeOut(0).removeClass('is-active');
  });

  //できること
  $('.C_possible_tab').on('click', function () {
    var possibleTab = $(this).index();
    $(this).addClass('is-active');
    $(this).siblings().removeClass('is-active');
    $('.C_possible_content').eq(possibleTab).fadeIn().addClass('is-active');
    $('.C_possible_content').eq(possibleTab).siblings().fadeOut(0).removeClass('is-active');
  });

  // みんなの声
  $('.C_voice--tabs .tsb').on('click', function () {
    var voiceTab = $(this).index();
    $(this).addClass('is-active');
    $(this).siblings().removeClass('is-active');
    $('.C_voice').eq(voiceTab).fadeIn().addClass('is-active');
    $('.C_voice').eq(voiceTab).siblings().fadeOut(0).removeClass('is-active');
  });

  // ヘッダー
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function () {
    var currentScrollpos = window.pageYOffset;
    var kvElement = document.querySelector(".KV");
    var kvTop = kvElement.offsetTop;
    var kvBottom = kvTop + kvElement.offsetHeight;

    // KV上に位置している場合はonを外し、それ以外はつける
    if (currentScrollpos >= kvTop && currentScrollpos < kvBottom) {
      document.querySelector(".header").classList.remove("on");
    } else {
      document.querySelector(".header").classList.add("on");
    }
    prevScrollpos = currentScrollpos;
  }

  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.pop').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });



  // アコーディオン
  $('.question__area').on('click', function () {
    $(this).parent().stop().toggleClass('is-active');
    $(this).next().stop().slideToggle();
  });



});


