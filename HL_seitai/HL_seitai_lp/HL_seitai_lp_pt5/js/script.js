$(function () {   

  // Adobe Fonts
  (function(d) {
    var config = {
      kitId: 'plq6khs',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);


  // ページtopから最後までの高さを取得、ページトップから100pxまで非表示と、その取得した高さ-200pxまでスクロールしたらボタンを非表示
$(function(){
  var btn = $('.followBtn');
  var timer;
  
  $(window).scroll(function() {
    //スクロール開始するとボタンを非表示
    btn.addClass('active');
    
    //スクロール中はイベントの発火をキャンセルする
    clearTimeout(timer);
    
    //スクロールが停止して0.05秒後にイベントを発火する
    timer = setTimeout(function() {
      //スクロール位置を判定してページ上部のときはボタンを非表示にする
      if($(this).scrollTop() >= $(document).height() - $(this).height() - 200 || $(this).scrollTop() <= 100) {
        btn.addClass('active');
      }else{
        btn.removeClass('active');
      }
    }, 50);
  });

}
);
 

    // ハンバーガーメニュー
    // $(".burger").on("click", function(){
    //   $(this).toggleClass("active");
    //   $('.menu').toggleClass("active");
    //   $('body').toggleClass("active");
    // }); 

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
    //   $('.up').each(function () {
    //     var top_of_element = $(this).offset().top;
    //     var bottom_of_window = $(window).scrollTop() + $(window).height();
    //     if (bottom_of_window > top_of_element) {
    //       $(this).addClass('show');
    //     }
    //   });
    // });


});