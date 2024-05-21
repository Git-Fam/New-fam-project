$(function () {   
  // // ハンバーガーメニュー
  //  $(".burger").on("click", function(){
  //    $(this).toggleClass("active");
  //    $('.menu').toggleClass("active");
  //    $('body').toggleClass("active");
  //  }); 
   
  //  // headerの下部が.mainと重なったらheaderにactiveクラスを付与
  //    $(window).scroll(function () {
  //      if ($(window).scrollTop() > $('.main').offset().top - 100) {
  //        $('header').addClass('active');
  //      } else {
  //        $('header').removeClass('active');
  //      }
  //    });

  // 要素が画面下部に来たらshowを付与
  $(window).scroll(function () {
    $('.up , .down , .right , .left , .pop, .slide_right, .slide_left').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });

});

var Obj = {
  loop: false,
  minDisplayTime: 2000,
  initialDelay: 300,
  autoStart: true,
  in: {
    effect: 'fadeInUp',
    delayScale: 1,
    delay: 100,
    sync: false,
    shuffle: true,
  },
  out: {}
};

var elements; // 複数の要素を格納するため、elementsという名前に変更

// 初期設定
function RandomInit() {
  elements = $(".randomAnime");
  $(elements[0]).textillate(Obj);
}

function RandomAnimeControl() {
  // 要素が存在しない場合や要素が1つしかない場合は何もしない
  if (elements.length <= 1) return;

  var elemPos = $(elements[1]).offset().top - 50;
  var scroll = $(window).scrollTop();
  var windowHeight = $(window).height();

  if (scroll >= elemPos - windowHeight) {
    $(elements[1]).textillate(Obj);
  }
}

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
  RandomInit();
  RandomAnimeControl();
});


// FVのタイトルの上
// 動きのきっかけの起点となるアニメーションの名前を定義
function BgFadeAnime(){

  // 背景色が伸びて出現（左から右）
$('.bgLRextendTrigger').each(function(){ //bgLRextendTriggerというクラス名が
  var elemPos = $(this).offset().top-50;//要素より、50px上の
  var scroll = $(window).scrollTop();
  var windowHeight = $(window).height();
  if (scroll >= elemPos - windowHeight){
    $(this).addClass('bgLRextend');// 画面内に入ったらbgLRextendというクラス名を追記
  }else{
    $(this).removeClass('bgLRextend');// 画面外に出たらbgLRextendというクラス名を外す
  }
});	

 // 文字列を囲う子要素
$('.bgappearTrigger').each(function(){ //bgappearTriggerというクラス名が
  var elemPos = $(this).offset().top-50;//要素より、50px上の
  var scroll = $(window).scrollTop();
  var windowHeight = $(window).height();
  if (scroll >= elemPos - windowHeight){
    $(this).addClass('bgappear');// 画面内に入ったらbgappearというクラス名を追記
  }else{
    $(this).removeClass('bgappear');// 画面外に出たらbgappearというクラス名を外す
  }
});		
}

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function(){
  BgFadeAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述