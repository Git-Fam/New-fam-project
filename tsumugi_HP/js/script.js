$(function () {
    // ハンバーガーメニュー
    $('.burger-open').on('click', function () {
        $('body').addClass('active');
    });
    $('.burger-close,.nav-invisible').on('click', function () {
        $('body').removeClass('active');
    });

    // ハンバーガーメニュー
    $('.C_guidance-contents-inner .sticky-menu').on('click', function () {
        $(this).toggleClass('open');
    });

    // トップボタン & reserveボタン & C_guidance-contents-inner sticky-menu
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();

        // トップボタン：footer上にいる時だけactive
        var footer = $('.footer');
        if (footer.length) {
            var footerTop = footer.offset().top;
            var scrollBottom = scrollTop + $(window).height();

            if (scrollBottom >= footerTop) {
                $('.top-back-btn').addClass('active');
            } else {
                $('.top-back-btn').removeClass('active');
            }
        }

        // reserveボタン：750px以上スクロールでactive
        if (scrollTop >= 750) {
            $('.reserve-btn').addClass('active');
        } else {
            $('.reserve-btn').removeClass('active');
        }

        // header：700px以上スクロールでactive
        if (scrollTop >= 700) {
            $('.header').addClass('active');

            if (scrollBottom >= footerTop) {
                $('.header').removeClass('active');
            }
        } else {
            $('.header').removeClass('active');
        }

        // sticky-menu：C_guidance-contents-inner内にいる時だけactive
        var guidanceInner = $('.C_guidance-contents-inner');
        var stickyMenu = $('.C_guidance-contents-inner .sticky-menu');
        if (guidanceInner.length && stickyMenu.length) {
            var innerTop = guidanceInner.offset().top;
            var innerBottom = innerTop + guidanceInner.outerHeight();
            var menuTop = scrollTop;
            var menuBottom = menuTop + stickyMenu.outerHeight();

            if (menuTop >= innerTop && menuBottom <= innerBottom) {
                stickyMenu.addClass('active');
            } else {
                stickyMenu.removeClass('active');
            }
        }
    });

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
