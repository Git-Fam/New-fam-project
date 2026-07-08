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

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // アクティブ切替
            tabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');

            const filter = tab.dataset.filter; // all / oshirase / exam / event / club

            items.forEach(item => {
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
            tabs.forEach(function (t) {
                t.classList.remove('is-active');
            });
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

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target); // 一度出したら監視終了（1回だけ）
                }
            });
        },
        {
            rootMargin: '0px 0px -10% 0px', // 要素が少し画面に入ったら発火
            threshold: 0,
        }
    );

    targets.forEach(function (el) {
        observer.observe(el);
    });
})();

// =====  FV スライドショー（全幅ゲージ連動） =====
(function () {
    // idではなく、共通のクラス（js-fv-slideshow）を持つ要素をすべて取得
    const fvContainers = document.querySelectorAll('.js-fv-slideshow');
    if (!fvContainers.length) return;

    // 見つかったスライドショーの数だけ、それぞれ独立して処理を回す
    fvContainers.forEach(function (fv) {
        const slides = fv.querySelectorAll('.p-fv-slide-target'); // 各スライド
        const fill = fv.querySelector('.js-fv-gauge-fill');     // そのスライド内のゲージ
        if (!slides.length || !fill) return;

        const DURATION = 3000; // CSSの 3s と合わせる
        let current = 0;

        function show(index) {
            slides.forEach(function (s, i) {
                s.classList.toggle('is-active', i === index);
            });
            // ゲージをリセットして左→右へ伸ばす
            fill.classList.remove('is-filling');
            void fill.offsetWidth; // リフロー強制でアニメリセット
            fill.classList.add('is-filling');
        }

        // 初期実行
        show(0);

        // タイマー設定
        setInterval(function () {
            current = (current + 1) % slides.length;
            show(current);
        }, DURATION);
    });
})();


// ===== ごあいさつ メッセージスライダー =====
(function () {
    const el = document.querySelector('.p-greeting__slider');
    if (!el || typeof Swiper === 'undefined') return;

    new Swiper(el, {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: '.p-greeting__pagination',
            clickable: true,
        },
    });
})();

// ===== ごあいさつ スクロールジャック（背景固定＋テキスト上昇） =====
(function () {
    const section = document.getElementById('greeting');
    const box = document.querySelector('.p-greeting__box');
    if (!section || !box) return;
    if (window.innerWidth <= 767) return; // PCのみ

    function onScroll() {
        const rect = section.getBoundingClientRect();
        const sectionHeight = section.offsetHeight - window.innerHeight; // スクロール可能量
        // セクション内の進捗（0〜1）
        let progress = -rect.top / sectionHeight;
        progress = Math.min(Math.max(progress, 0), 1);

        // テキストが動く量 = ボックスの高さ - 表示エリア高さ
        const boxHeight = box.scrollHeight;
        const viewH = window.innerHeight;
        const moveMax = Math.max(boxHeight - viewH + 160, 0); // 160=上下余白ぶん

        // 下から上へ：最初は下寄り(viewの下)、進捗で上へ
        const startOffset = viewH * 0.2; // 開始位置（画面下から20%）
        const y = startOffset - progress * (moveMax + startOffset);
        box.style.transform = 'translateY(' + y + 'px)';
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    onScroll();
})();


// ===== concept FV → 理念 背景白フェード =====
(function () {
    const fv = document.getElementById('js-fv-scroll-fade');
    const white = document.getElementById('js-fv-white');
    if (!fv || !white) return;

    const vh = window.innerHeight;

    function onScroll() {
        const scrollY = window.scrollY;
        // 0〜100vhスクロールで白フェード 0→1
        let progress = scrollY / (vh * 0.9);
        progress = Math.min(Math.max(progress, 0), 1);
        white.style.opacity = progress;
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();

// ===== 建学の精神 背景ふわっと表示/非表示 =====
(function () {
    const target = document.querySelector('.p-history-message');
    if (!target) return;

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-show'); // 入ったら表示
                } else {
                    entry.target.classList.remove('is-show'); // 出たら非表示
                }
            });
        },
        {
            rootMargin: '-10% 0px -10% 0px',
            threshold: 0,
        }
    );

    observer.observe(target);
})();


// ===== 制服紹介 スクロールスナップ切替 =====
(function () {
  const section = document.getElementById('js-uniform');
  if (!section) return;

  // テキストや画像単体ではなく、切り替えたい単位である「item」を取得する
  const items = section.querySelectorAll('.pt-uniform__item');
  const triggers = section.querySelectorAll('.pt-uniform__trigger');
  if (!items.length || !triggers.length) return;

  function setActive(index) {
    // すべてのitemに対して、インデックスが一致したものだけに is-active を付与
    items.forEach(function (el, i) {
      el.classList.toggle('is-active', i === index);
    });
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        const index = parseInt(entry.target.dataset.index, 10);
        setActive(index);
      }
    });
  }, {
    rootMargin: '-50% 0px -50% 0px',  // 画面中央に来たトリガーで切替
    threshold: 0
  });

  triggers.forEach(function (t) { observer.observe(t); });
})();


// ===== 設備・施設・アクセス：校舎案内 左サイドバーの階数ハイライト =====
(function () {
  const gallery = document.getElementById('js-campus-gallery');
  const nav = document.getElementById('js-campus-nav');
  if (!gallery || !nav) return;

  const floors = gallery.querySelectorAll('.p-campus__floor');
  const navItems = nav.querySelectorAll('.p-campus__nav-item');
  if (!floors.length || !navItems.length) return;

  function setActive(key) {
    navItems.forEach(function (item) {
      item.classList.toggle('is-active', item.dataset.floor === key);
    });
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        setActive(entry.target.dataset.floorSection);
      }
    });
  }, {
    rootMargin: '-45% 0px -45% 0px', // 画面中央付近に来たセクションで切替
    threshold: 0
  });

  floors.forEach(function (el) { observer.observe(el); });
})();


// ===== お知らせ一覧 絞り込み＋さらに読み込む =====
(function () {
  const list = document.getElementById('js-news-list');
  const moreBtn = document.getElementById('js-news-more');
  if (!list) return;

  const tabs = document.querySelectorAll('.p-news-archive__tab');
  const items = Array.from(list.querySelectorAll('.p-news-archive__item'));
  const STEP = 9;              // 1回に表示する件数（3列×3行）
  let filter = 'all';
  let shown = STEP;

  function render() {
    // 絞り込み後の対象
    const matched = items.filter(function (item) {
      return filter === 'all' || item.dataset.category === filter;
    });
    // 全アイテムを一旦隠す
    items.forEach(function (item) { item.style.display = 'none'; });
    // 対象を shown 件だけ表示
    matched.slice(0, shown).forEach(function (item) {
      item.style.display = '';
    });
    // 「さらに読み込む」の表示制御
    if (moreBtn) {
      moreBtn.style.display = (matched.length > shown) ? '' : 'none';
    }
  }

  // タブ切替
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) { t.classList.remove('is-active'); });
      tab.classList.add('is-active');
      filter = tab.dataset.filter;
      shown = STEP;   // 絞り込み変更時は表示数リセット
      render();
    });
  });

  // さらに読み込む
  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      shown += STEP;
      render();
    });
  }

  render();
})();