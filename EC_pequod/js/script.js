$(function () {

  // 利用規約チェック
  $('.rule-container_btn').on('click', function () {
    $(this).toggleClass('active');
  });
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


  // アコーディオン
  // $('.js_onClick').on('click', function () {
  //   $(this).next().slideToggle();
  //   $(this).toggleClass('active');
  // });



});
