

// 画面を見込んだらshowを付与

$(document).ready(function () {
  $(".up,.bird iframe").each(function () {
    var element_height = $(this).outerHeight();
    var element_top = $(this).offset().top;
    var element_middle = element_top + element_height / 2;
    var window_middle = $(window).scrollTop() + $(window).height() / 2;
    if (window_middle > element_middle) {
      $(this).addClass("show");
    }
  });
});

$(document).ready(function(){
  // ページが読み込まれた後に実行されるコード
  setTimeout(function(){
      // 0.5秒後に実行されるコード
      $('.rabbit iframe').addClass('show');
  }, 500); // 500ミリ秒 = 0.5秒
});


