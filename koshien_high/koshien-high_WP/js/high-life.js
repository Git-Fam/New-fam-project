$(function () {

  // ===== 1日の流れ 画像スクロール表示 =====
  // 画面TOPから p(64)（基準幅1366px）の位置を境に、
  // 通過したら is-opa を外して表示 / 戻ったら is-opa を付けて非表示（1つ目は常に表示）
  (function () {
    var PC_BASE = 1366;
    var items = Array.prototype.slice.call(
      document.querySelectorAll('.high-life-day-img-area.pc .img-item')
    );
    if (items.length <= 1) return;

    // 1つ目は常に表示なので対象外
    var targets = items.slice(1);
    var ticking = false;

    function check() {
      ticking = false;
      var triggerY = window.innerWidth * 200 / PC_BASE;
      targets.forEach(function (el) {
        if (el.getBoundingClientRect().top <= triggerY) {
          el.classList.remove('is-opa');
        } else {
          el.classList.add('is-opa');
        }
      });
    }

    function onScroll() {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(check);
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    check();
  })();

});