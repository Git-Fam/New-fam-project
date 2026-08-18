// ローディング画面の非表示
document.addEventListener("DOMContentLoaded", function () {
  // 8秒後にローディング画面を強制的に非表示
  setTimeout(function () {
    document.querySelector('.loading__parts').classList.remove('active');
  }, 5000);

  // 読み込みが完了したら4秒後にローディング画面を非表示
  window.addEventListener('load', function () {
    setTimeout(function () {
      document.querySelector('.loading__parts').classList.remove('active');
    }, 1000);
  });
});