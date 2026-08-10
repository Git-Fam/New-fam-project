$(function () {

window.addEventListener('load', function() {
    var loading = document.querySelector('.loading');
    if (!loading) return;

    if (sessionStorage.getItem('loading_shown')) {
        // 2回目以降は最初から非表示
        loading.style.display = 'none';
    } else {
        // 初回のみアニメーション後に非表示
        sessionStorage.setItem('loading_shown', 'true');
        setTimeout(function() {
            loading.classList.add('is-hidden');
            setTimeout(function() {
                loading.style.display = 'none';
            }, 800);
        }, 3000);
    }
});

window.addEventListener('load', function() {
  setTimeout(function() {
    document.querySelector('.loading').classList.add('is-hidden');
  }, 3000); // 3秒後に消える
});


  // // ローディング
  // var loadingFinished = false;
  // var loading = $('.loading');
  // var startTime = Date.now();
  // var minLoadingTime = 2000; // 最低2秒

  // $(window).on('load', function () {
  //   var elapsedTime = Date.now() - startTime;
  //   var remainingTime = minLoadingTime - elapsedTime;

  //   if (remainingTime > 0) {
  //     // 読み込みが早く完了した場合、残り時間を待つ
  //     setTimeout(function () {
  //       loading.addClass('is-active');
  //       loadingFinished = true;
  //     }, remainingTime);
  //   } else {
  //     // 2秒以上経過している場合はすぐに削除
  //     loading.addClass('is-active');
  //     loadingFinished = true;
  //   }
  // });

  // // 2秒経過しても読み込みが完了していない場合のフォールバック
  // setTimeout(function () {
  //   if (!loadingFinished) {
  //     loading.addClass('is-active');
  //   }
  // }, minLoadingTime);


});
