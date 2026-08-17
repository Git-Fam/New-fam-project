$(function () {
    // ヘッダー：SPメニュー開閉
    $('.js-header-toggle').on('click', function () {
        var isOpen = $('.header').toggleClass('is-open').hasClass('is-open');
        $(this).attr('aria-expanded', isOpen);
        $('body').toggleClass('active', isOpen);
    });
    $('.js-header-menu').on('click', '.header__menu-link, .header__menu-cta', function () {
        $('.header').removeClass('is-open');
        $('.js-header-toggle').attr('aria-expanded', false);
        $('body').removeClass('active');
    });

    // // ハンバーガーメニュー
    //  $(".burger").on("click", function(){
    //    $(this).toggleClass("active");
    //    $('.menu').toggleClass("active");
    //    $('body').toggleClass("active");
    //  });
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
    // 要素が画面下部に来たらshowを付与
    // $(window).scroll(function () {
    //   $('.up,.down,.right,.left,.pop').each(function () {
    //     var top_of_element = $(this).offset().top;
    //     var bottom_of_window = $(window).scrollTop() + $(window).height();
    //     if (bottom_of_window > top_of_element) {
    //       $(this).addClass('show');
    //     }
    //   });
    // });
    // ローディング
    // var loadingFinished = false;
    // var loading = $('.loadUp,.loadDown,.loadRight,.loadLeft,.loadPop');
    // $(window).on('load', function () {
    //   loading.addClass('show');
    //   loadingFinished = true;
    // });
    // setTimeout(function(){
    //   if (!loadingFinished) {
    //     loading.addClass('show');
    //   }
    // }, 2000);
    // FAQ：アコーディオン開閉
    $('.js-faq-toggle').on('click', function () {
        var $item = $(this).closest('.faq__item');
        var $answer = $item.find('.faq__answer');
        var isOpen = $item.hasClass('is-open');

        if (isOpen) {
            $item.removeClass('is-open');
            $(this).attr('aria-expanded', false);
            $answer.slideUp(200, function () {
                $answer.attr('hidden', true);
            });
        } else {
            $item.addClass('is-open');
            $(this).attr('aria-expanded', true);
            $answer.removeAttr('hidden').hide().slideDown(200);
        }
    });
});
