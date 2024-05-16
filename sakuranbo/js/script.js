$(function () {   

  // フォント
  (function(d) {
    var config = {
      kitId: 'cqo6ypz',
      scriptTimeout: 3000,
      async: true
    },
    h = d.documentElement,
    t = setTimeout(function() {
      h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
    }, config.scriptTimeout),
    tk = d.createElement("script"),
    f = false,
    s = d.getElementsByTagName("script")[0],
    a;
    h.className += " wf-loading";
    tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
    tk.async = true;
    tk.onload = tk.onreadystatechange = function() {
      a = this.readyState;
      if (f || a && a != "complete" && a != "loaded") return;
      f = true;
      clearTimeout(t);
      try {
        Typekit.load(config)
      } catch (e) {}
    };
    s.parentNode.insertBefore(tk, s)
  })(document);

  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
    //  $('.menu').toggleClass("active");
     $('body').toggleClass("active");
   }); 
  // $(".js-link,.menu").on("click", function(){
  //   $('.burger').removeClass("active");
  //   $('.menu').removeClass("active");
  //   $('body').removeClass("active");
  // });

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
  // var loadingFinished = false;
  // var loading = $('.loadUp');

  // $(window).on('load', function () {
  //   loading.addClass('show');
  //   loadingFinished = true;
  // });
  // setTimeout(function(){
  //   if (!loadingFinished) {
  //     loading.addClass('show');
  //   }
  // }, 2000);



});