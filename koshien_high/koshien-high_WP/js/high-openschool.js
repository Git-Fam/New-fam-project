$(function () {

  // ===== 背景オーバーレイ スクロール連動 =====
  // 画面TOPから100vhスクロールで opacity を 0 → 0.25 に変化（100vh以降は0.25で固定）
  (function () {
    var inr = document.querySelector('.high-openschool-bg-inr');
    if (!inr) return;

    var MAX_OPACITY = 0.25;
    var ticking = false;

    function update() {
      ticking = false;
      var progress = window.scrollY / window.innerHeight;
      if (progress < 0) progress = 0;
      if (progress > 1) progress = 1;
      inr.style.opacity = progress * MAX_OPACITY;
    }

    function onScroll() {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(update);
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
  })();

});