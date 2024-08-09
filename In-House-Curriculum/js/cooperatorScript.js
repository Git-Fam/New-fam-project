// 適性診断　文字をタイピング風に表示
function TextTypingAnime() {
  $('.C_test .TX-bg .TX').each(function () {
      var elemPos = $(this).offset().top - 50;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      var thisChild = "";
      if (scroll >= elemPos - windowHeight) {
      thisChild = $(this).children(); //spanタグを取得
      //spanタグの要素の１つ１つ処理を追加
      thisChild.each(function (i) {
          var time = 100;
        //時差で表示する為にdelayを指定しその時間後にfadeInで表示させる
        $(this).delay(time * i).fadeIn(time);
      });
      } else {
      thisChild = $(this).children();
      thisChild.each(function () {
        $(this).stop(); //delay処理を止める
        $(this).css("display", "none"); //spanタグ非表示
      });
      }
  });
}
$(window).on('load', function () {
  //spanタグを追加する
  var element = $(".C_test .TX-bg .TX-wrap .TX");
  element.each(function () {
    var text = $(this).html();
    var textbox = "";
    text.split('').forEach(function (t) {
      if (t !== " ") {
        textbox += '<span>' + t + '</span>';
      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);

  });

  TextTypingAnime();/* アニメーション用の関数を呼ぶ*/
});

// var items = ['1番目','2番目','3番目'];
//   rand = items[Math.floor(Math.random()*items.length)];
//   $('.random').text(rand);;

  
  rand = Math.floor(Math.random()*((100 + 1) - 80)) + 80;
  $('.random').text(rand);;