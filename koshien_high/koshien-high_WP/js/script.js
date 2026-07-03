$(function () {
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




// NEWS タブ絞り込み
(function () {
  const tabs = document.querySelectorAll('.p-news__tab');
  const items = document.querySelectorAll('.p-news__item');
  if (!tabs.length || !items.length) return;

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => {
      // アクティブ切替
      tabs.forEach((t) => t.classList.remove('is-active'));
      tab.classList.add('is-active');

      const filter = tab.dataset.filter; // all / oshirase / exam / event / club

      items.forEach((item) => {
        const cat = item.dataset.category; // 内容カテゴリ
        if (filter === 'all' || cat === filter) {
          item.classList.remove('is-hidden');
        } else {
          item.classList.add('is-hidden');
        }
      });
    });
  });
})();


// ===== ドロワー開閉 =====
(function () {
  const toggle = document.getElementById('js-drawer-toggle');
  const drawer = document.getElementById('js-drawer');
  if (!toggle || !drawer) return;

  toggle.addEventListener('click', function () {
    const isOpen = drawer.classList.toggle('is-open');
    toggle.classList.toggle('is-open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen);
    toggle.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
    // 背面スクロール固定
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // ドロワー内のリンクを押したら閉じる
  drawer.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      drawer.classList.remove('is-open');
      toggle.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });
})();


// ===== ヘッダー透明→白（TOPのみ・スクロールで） =====
(function () {
  const header = document.getElementById('js-header');
  if (!header) return;
  if (!document.body.classList.contains('is-front')) return; // TOP以外は常時白なので何もしない

  const onScroll = function () {
    if (window.scrollY > 50) {
      header.classList.add('is-scrolled');
    } else {
      header.classList.remove('is-scrolled');
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // 読み込み時にも判定
})();


// ===== NEWS タブ絞り込み =====
(function () {
  const tabs = document.querySelectorAll('.p-news__tab');
  const items = document.querySelectorAll('.p-news__item');
  if (!tabs.length || !items.length) return;

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) { t.classList.remove('is-active'); });
      tab.classList.add('is-active');

      const filter = tab.dataset.filter;
      items.forEach(function (item) {
        const cat = item.dataset.category;
        if (filter === 'all' || cat === filter) {
          item.classList.remove('is-hidden');
        } else {
          item.classList.add('is-hidden');
        }
      });
    });
  });
})();


// ===== スクロールで要素をフェードイン =====
(function () {
  const targets = document.querySelectorAll('.js-fade, .up, .down');
  if (!targets.length) return;

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        observer.unobserve(entry.target); // 一度出したら監視終了（1回だけ）
      }
    });
  }, {
    rootMargin: '0px 0px -10% 0px', // 要素が少し画面に入ったら発火
    threshold: 0
  });

  targets.forEach(function (el) {
    observer.observe(el);
  });
})();