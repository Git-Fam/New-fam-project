// フォント
(function (d) {
  var config = {
    kitId: 'cqo6ypz',
    scriptTimeout: 3000,
    async: true
  },
    h = d.documentElement,
    t = setTimeout(function () {
      h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
    }, config.scriptTimeout),
    tk = d.createElement("script"),
    f = false,
    s = d.getElementsByTagName("script")[0],
    a;
  h.className += " wf-loading";
  tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
  tk.async = true;
  tk.onload = tk.onreadystatechange = function () {
    a = this.readyState;
    if (f || a && a != "complete" && a != "loaded") return;
    f = true;
    clearTimeout(t);
    try {
      Typekit.load(config)
    } catch (e) { }
  };
  s.parentNode.insertBefore(tk, s)
})(document);

$(function () {

  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(this).toggleClass("active");
    $('.menu, .menu__back, body').toggleClass("active");
  });
  $(".menu__back").on("click", function () {
    $(this).removeClass("active");
    $('.menu, .burger, body').removeClass("active");
  });

  // テキスト表示
  $(".C_hoverText").on("click", function () {
    $(this).toggleClass("active");
  });

  var prevScrollpos = window.pageYOffset;
  window.onscroll = function () {
    var currentScrollpos = window.pageYOffset;
    if (prevScrollpos > currentScrollpos || currentScrollpos < 500) {
      document.querySelector(".header").classList.remove("active");
    } else {
      document.querySelector(".header").classList.add("active");
    }
    prevScrollpos = currentScrollpos;
  }

  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.up,.roll,.down,.right,.left').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });

  // ローディング
  var loadingFinished = false;
  var loading = $('.loadRight');

  $(window).on('load', function () {
    loading.addClass('show');
    loadingFinished = true;
  });
  setTimeout(function () {
    if (!loadingFinished) {
      loading.addClass('show');
    }
  }, 2000);

  // page-orthodontics--example
  $(".example__container--tabs .js--selector").on('click', function () {
    let index = $(".example__container--tabs .js--selector").index(this);
    $(".example__container--tabs .js--selector").removeClass("active");
    $(this).addClass("active");
    $(".example__container--contents .js--content").removeClass("active");
    $(".example__container--contents .js--content").eq(index).addClass("active");
    return false;
  });

  // C_price
  $(".C_price--container--selectors .js--selector").on('click', function () {
    let index = $(".C_price--container--selectors .js--selector").index(this);
    $(".C_price--container--selectors .js--selector").removeClass("active");
    $(this).addClass("active");
    $(".C_price--container--contents .js--content").fadeOut(0);
    $(".C_price--container--contents .js--content").eq(index).fadeIn(0);
    return false;
  });



});

// rollAnimeにrollというクラス名を付ける定義
function RollAnimeControl() {
  $('.rollAnime').each(function () {
    var elemPos = $(this).offset().top - 50;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    var childs = $(this).children();  //rollAnimeの子要素を取得
    if (scroll >= elemPos - windowHeight) {
      $(childs).each(function (i) {   //子要素を1つ1つ処理をおこなう
        if (i < 10) {         //10未満の場合
          $(this).css("transition-delay", "." + i + "s");  //子要素にcsstransition-delayを追加
        } else {             //10以上の場合
          var n = i / 10;       //ミリ秒指定なので10で割る
          $(this).css("transition-delay", n + "s");  //子要素にcsstransition-delayを追加
        }
      });

      $(this).addClass("roll"); //rollというアニメーションクラスを付与

    } else {
      $(childs).each(function () {    //子要素を1つ1つ処理をおこなう
        $(this).css("transition-delay", "0s");//子要素にcsstransition-delayの秒を0とする
      });
      $(this).removeClass("roll");//rollというアニメーションクラスを除去
    }
  });
}

// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function () {
  RollAnimeControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
  //spanタグを追加する
  var element = $(".rollAnime");
  element.each(function () {
    var text = $(this).text();
    var textbox = [];
    text.split('').forEach(function (t, i) {
      if (t !== " ") {
        if (i < 10) {
          textbox += '<span style="transition-delay:.' + i + 's;">' + t + '</span>';
        } else {
          var n = i / 10;
          textbox += '<span style="transition-delay:' + n + 's;">' + t + '</span>';
        }

      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);
  });

  RollAnimeControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述


// rollAnimeLoadにrollというクラス名を付ける定義
function RollAnimeLoadControl() {
  $('.rollAnimeLoad').each(function () {
    var elemPos = $(this).offset().top - 50;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    var childs = $(this).children();  //rollAnimeLoadの子要素を取得
    if (scroll >= elemPos - windowHeight) {
      $(childs).each(function (i) {   //子要素を1つ1つ処理をおこなう
        if (i < 10) {         //10未満の場合
          $(this).css("transition-delay", "." + i + "s");  //子要素にcsstransition-delayを追加
        } else {             //10以上の場合
          var n = i / 10;       //ミリ秒指定なので10で割る
          $(this).css("transition-delay", n + "s");  //子要素にcsstransition-delayを追加
        }
      });

      $(this).addClass("roll"); //rollというアニメーションクラスを付与

    } else {
      $(childs).each(function () {    //子要素を1つ1つ処理をおこなう
        $(this).css("transition-delay", "0s");//子要素にcsstransition-delayの秒を0とする
      });
      $(this).removeClass("roll");//rollというアニメーションクラスを除去
    }
  });
}

// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function () {
  RollAnimeLoadControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
  //spanタグを追加する
  var element = $(".rollAnimeLoad");
  element.each(function () {
    var text = $(this).text();
    var textbox = [];
    text.split('').forEach(function (t, i) {
      if (t !== " ") {
        if (i < 10) {
          textbox += '<span style="transition-delay:.' + i + 's;">' + t + '</span>';
        } else {
          var n = i / 10;
          textbox += '<span style="transition-delay:' + n + 's;">' + t + '</span>';
        }

      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);
  });

  RollAnimeLoadControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述


// 画面転換でタブ切り替え
document.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const tab = urlParams.get('tab');

  if (tab) {
      const tabs = document.querySelectorAll('.example__container--tabs .js--selector');
      const contents = document.querySelectorAll('.example__container--contents .js--content');

      tabs.forEach(t => t.classList.remove('active'));
      contents.forEach(c => c.classList.remove('active'));

      const activeTab = document.querySelector(`.example__container--tabs .js--selector[data-tab="${tab}"]`);
      const activeContent = document.querySelector(`.example__container--contents .js--content[data-content="${tab}"]`);

      if (activeTab && activeContent) {
          activeTab.classList.add('active');
          activeContent.classList.add('active');
      }
  }
});