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

   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('.menu').toggleClass("active");
     $('body').toggleClass("active");
     $('.menu__bg').toggleClass("active");
     $('.billboard').toggleClass("active");
   }); 
  $(".js-link,.menu__bg").on("click", function(){
    $('.burger').removeClass("active");
    $('.menu').removeClass("active");
    $('body').removeClass("active");
    $('.menu__bg').removeClass("active");
    $('.billboard').removeClass("active");
  });

  $(window).scroll(function () {
    $('.up,.down,.left,.right,.pop,.juwa,.graphScale,.bounce,.stamp,.flow_juwa').each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass('show');
      }
    });
  });

  $(window).scroll(function() {
    var kvHeight = $('.KV').height();
    var scrollTop = $(window).scrollTop();
  
    if (scrollTop >= kvHeight) {
      $('.billboard').addClass('action');
    } else {
      $('.billboard').removeClass('action');
    }
  });

  
});