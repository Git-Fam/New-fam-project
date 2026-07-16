$(function () {
  // SP版: チャート画像の横スクロール初期位置を左右中央に
  function centerChartScroll() {
    var el = document.querySelector('.chart_img');
    if (!el || el.scrollWidth <= el.clientWidth) return;
    el.scrollLeft = (el.scrollWidth - el.clientWidth) / 2;
  }
  centerChartScroll();
  // 画像読み込み後も再実行（SPで幅が確定してから中央に）
  $('#strength_contents-chart').on('load', centerChartScroll);
});
