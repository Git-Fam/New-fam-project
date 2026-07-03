$(function () {
  // ===== LOVE CHANGE スライダー =====
  (function () {
    const el = document.querySelector('.high-change-contents');
    if (!el) return;

    new Swiper(el, {
      loop: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      spaceBetween: 16,
      speed: 600,
      grabCursor: true,
      pagination: {
        el: '.high-change-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          spaceBetween: 50,
        },
      },
    });
  })();





});