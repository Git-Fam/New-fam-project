// ===== スクロールで要素をフェードイン =====
(function () {
    const targets = document.querySelectorAll('.js-fade, .up, .down');
    if (!targets.length) return;

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target); // 一度出したら監視終了
                }
            });
        },
        {
            rootMargin: '0px 0px -30% 0px', // 要素が少し画面に入ったら発火
            threshold: 0,
        }
    );

    targets.forEach(function (el) {
        observer.observe(el);
    });
})();

// ===== ヘッダー透明→白（透明ヘッダーページ・スクロールで） =====
(function () {
    const header = document.getElementById('js-header');
    if (!header) return;
    if (!document.body.classList.contains('is-hero-top')) return; // 透明ヘッダーページ以外は何もしない

    const onScroll = function () {
        if (window.scrollY > 50) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();

// =====  FV スライドショー（全幅ゲージ連動） =====
(function () {
    // idではなく、共通のクラス（js-fv-slideshow）を持つ要素をすべて取得
    const fvContainers = document.querySelectorAll('.js-fv-slideshow');
    if (!fvContainers.length) return;

    // 見つかったスライドショーの数だけ、それぞれ独立して処理を回す
    fvContainers.forEach(function (fv) {
        const slides = fv.querySelectorAll('.p-fv-slide-target'); // 各スライド
        const fill = fv.querySelector('.js-fv-gauge-fill'); // そのスライド内のゲージ
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

// ===== NEWS タブ絞り込み（SP: Swiper対応版）=====
(function () {
    const tabs = document.querySelectorAll('.p-news__tab');
    const wrapperEl = document.querySelector('.p-news__list');
    if (!tabs.length || !wrapperEl) return;

    const allItems = Array.from(wrapperEl.querySelectorAll('.p-news__item'));

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const filter = tab.dataset.filter;
            const isSP = window.innerWidth <= 767; // SPかどうかの判定

            // ★【条件変更】「SP環境」かつ「すべて」がクリックされたときだけリロードする
            if (isSP && filter === 'all') {
                window.location.reload();
                return;
            }

            // --- PC環境の「すべて」、または「特定のカテゴリ」がクリックされたときの処理 ---

            tabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');

            // wrapperを空にして、条件に合うitemだけ入れ直す
            wrapperEl.innerHTML = '';

            allItems.forEach(function (item) {
                const cat = item.dataset.category;
                if (filter === 'all' || cat === filter) {
                    item.classList.remove('is-hidden');
                    wrapperEl.appendChild(item);
                }
            });

            // PC用の絞り込み（is-hiddenで制御している場合はこちらも維持）
            allItems.forEach(function (item) {
                const cat = item.dataset.category;
                const show = filter === 'all' || cat === filter;
                item.classList.toggle('is-hidden', !show);
            });

            if (newsSwiper) {
                newsSwiper.update();
                newsSwiper.slideTo(0, 0);
            }
        });
    });
})();

/// NEWS タブ絞り込み（中学・高校ページ / high-news / Slick完全対応版）
(function () {
    const $tabs = $('.news-category-item');
    const $slider = $('.news-list-iner'); // Slickが適用されているコンテナ

    if (!$tabs.length || !$slider.length) return;

    $tabs.on('click', function (e) {
        e.preventDefault();

        // タブのアクティブクラス切り替え
        $tabs.removeClass('is-active');
        $(this).addClass('is-active');

        const filter = $(this).data('filter'); // all / info / exam / event / club

        // 1. 一度Slickの絞り込みを完全に解除して初期状態に戻す
        $slider.slick('slickUnfilter');

        // 2. 「すべて」以外が選ばれた場合のみ、Slickの機能で安全に絞り込む
        if (filter !== 'all') {
            // data-category が選んだフィルター名と一致する本物のスライド（クローン除く）だけを抽出して絞り込み
            $slider.slick('slickFilter', function () {
                return $(this).attr('data-category') === filter;
            });
        }

        // 3. 絞り込んだ後にスライダーの1枚目に強制移動
        $slider.slick('slickGoTo', 0);
    });
})();

// ===== ドロワー開閉 =====
(function () {
    const toggle = document.getElementById('js-drawer-toggle');
    const drawer = document.getElementById('js-drawer');
    const header = document.getElementById('js-header');
    if (!toggle || !drawer) return;

    toggle.addEventListener('click', function () {
        const isOpen = drawer.classList.toggle('is-open');
        toggle.classList.toggle('is-open', isOpen);
        toggle.setAttribute('aria-expanded', isOpen);
        toggle.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
        if (header) header.classList.toggle('is-menu-open', isOpen);
        // 背面スクロール固定
        document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // ドロワー内のリンクを押したら閉じる
    drawer.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            drawer.classList.remove('is-open');
            toggle.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            if (header) header.classList.remove('is-menu-open');
            document.body.style.overflow = '';
        });
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
    // PC限定の条件を削除（SPでも動かす）

    function onScroll() {
        const rect = section.getBoundingClientRect();
        const sectionHeight = section.offsetHeight - window.innerHeight;
        let progress = -rect.top / sectionHeight;
        progress = Math.min(Math.max(progress, 0), 1);

        const boxHeight = box.scrollHeight;
        const viewH = window.innerHeight;
        const moveMax = Math.max(boxHeight - viewH + 80, 0);

        // 開始位置：SPは画面下60%、PCは20%
        const isSP = window.innerWidth <= 767;
        const startOffset = viewH * (isSP ? 0.75 : 0.1);

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

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const index = parseInt(entry.target.dataset.index, 10);
                    setActive(index);
                }
            });
        },
        {
            rootMargin: '-50% 0px -50% 0px', // 画面中央に来たトリガーで切替
            threshold: 0,
        }
    );

    triggers.forEach(function (t) {
        observer.observe(t);
    });
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

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActive(entry.target.dataset.floorSection);
                }
            });
        },
        {
            rootMargin: '-45% 0px -45% 0px', // 画面中央付近に来たセクションで切替
            threshold: 0,
        }
    );

    floors.forEach(function (el) {
        observer.observe(el);
    });
})();

// ===== お知らせ一覧 絞り込み＋さらに読み込む =====
(function () {
    const list = document.getElementById('js-news-list');
    const moreBtn = document.getElementById('js-news-more');
    if (!list) return;

    const tabs = document.querySelectorAll('.p-news-archive__tab');
    const items = Array.from(list.querySelectorAll('.p-news-archive__item'));
    const STEP = 9; // 1回に表示する件数（3列×3行）
    let filter = 'all';
    let shown = STEP;

    function render() {
        // 絞り込み後の対象
        const matched = items.filter(function (item) {
            return filter === 'all' || item.dataset.category === filter;
        });
        // 全アイテムを一旦隠す
        items.forEach(function (item) {
            item.style.display = 'none';
        });
        // 対象を shown 件だけ表示
        matched.slice(0, shown).forEach(function (item) {
            item.style.display = '';
        });
        // 「さらに読み込む」の表示制御
        if (moreBtn) {
            moreBtn.style.display = matched.length > shown ? '' : 'none';
        }
    }

    // タブ切替
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) {
                t.classList.remove('is-active');
            });
            tab.classList.add('is-active');
            filter = tab.dataset.filter;
            shown = STEP; // 絞り込み変更時は表示数リセット
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

// ===== 資料請求・お問い合わせフォーム 初期値＋項目出し分け =====
window.addEventListener('load', function () {
    var radios = document.querySelectorAll('input[name="type"]');
    var extras = document.querySelectorAll('.js-form-extra');
    var pamphlet = document.querySelectorAll('.js-form-pamphlet');
    if (!radios.length) return;

    function toggleExtra() {
        var selected = '';
        radios.forEach(function (r) {
            if (r.checked) selected = r.value;
        });
        var isContact = selected === 'お問い合わせ';
        extras.forEach(function (el) {
            el.style.display = isContact ? 'none' : '';
        });
        pamphlet.forEach(function (el) {
            el.style.display = isContact ? '' : 'none';
        });
    }

    radios.forEach(function (r) {
        r.addEventListener('change', function () {
            // 変更時にsessionStorageに保存
            sessionStorage.setItem('contact_type', r.value);
            toggleExtra();
        });
    });

    setTimeout(function () {
        // sessionStorageに保存値があれば復元
        var saved = sessionStorage.getItem('contact_type');

        if (saved) {
            // 戻ってきた場合は保存値を使う
            radios.forEach(function (r) {
                r.checked = r.value === saved;
            });
        } else {
            // 初回アクセスはページで決める
            var isRequest = document.querySelector('.page--request') !== null;
            radios.forEach(function (r) {
                r.checked = isRequest ? r.value === '資料請求' : r.value === 'お問い合わせ';
            });
            // 初期値も保存
            radios.forEach(function (r) {
                if (r.checked) sessionStorage.setItem('contact_type', r.value);
            });
        }
        toggleExtra();
    }, 500);
});

// お問い合わせで隠す項目、確認画面も
document.addEventListener('DOMContentLoaded', () => {
    const typeValue = document.querySelector('.p-form__item .p-form__confirm');

    // multiformで出力されたtype（お申し込み内容）の値を取得
    const items = document.querySelectorAll('.p-form__item');
    let typeText = '';

    items.forEach(item => {
        const label = item.querySelector('.p-form__label');
        if (label && label.textContent.includes('お申し込み内容')) {
            typeText = item.querySelector('.p-form__confirm')?.textContent.trim();
        }
    });

    // お問い合わせの場合は関心・理由を非表示
    if (typeText === 'お問い合わせ') {
        document.querySelectorAll('.js-form-extra').forEach(el => {
            el.style.display = 'none';
        });
    }
});

// ===== ローディング =====
$(function () {
    const loading = document.querySelector('.loading');
    if (!loading) return;

    // 2回目以降は即非表示
    if (sessionStorage.getItem('loading_shown')) {
        loading.style.display = 'none';
        return;
    }

    window.addEventListener('load', function () {
        sessionStorage.setItem('loading_shown', 'true');

        setTimeout(function () {
            loading.classList.add('is-hidden');

            setTimeout(function () {
                loading.style.display = 'none';
            }, 800);
        }, 3000);
    });
});
// 中高TOPバナー
document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('js-float-banner');
    const hiro = document.querySelector('.high-hiro');
    if (!banner || !hiro) return;

    const footer = document.querySelector('footer'); // 必要ならセレクタを実際のフッターに合わせて変更
    let footerVisible = false;

    // フッターが画面に入っているかを監視
    if (footer) {
        const io = new IntersectionObserver(
            entries => {
                footerVisible = entries[0].isIntersecting;
                update();
            },
            { rootMargin: '0px', threshold: 0 }
        );
        io.observe(footer);
    }

    const update = () => {
        // FVを半分スクロールしたら表示。ただしフッターが見えていたら隠す
        const show = window.scrollY > hiro.offsetHeight * 0.3 && !footerVisible;
        banner.classList.toggle('is-hidden', !show);
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
});

// /high/why/
// なんで好きが見つかるの？（タイトル→本文 通しでクロスフェード）
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('js-why-hero');
    if (!section) return;

    const steps = section.querySelectorAll('.is-step');
    if (!steps.length) return;

    const update = () => {
        const rect = section.getBoundingClientRect();
        const total = section.offsetHeight - window.innerHeight;
        const progress = Math.min(Math.max(-rect.top / total, 0), 0.999);
        const index = Math.floor(progress * steps.length);
        const active = rect.top <= 0;

        steps.forEach((el, i) => {
            el.classList.toggle('is-current', active && i === index);
        });
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
});

// 私のコースの好きなところ
document.addEventListener('DOMContentLoaded', () => {
    const kv = document.getElementById('js-course-kv');
    if (!kv) return;

    const blocks = [
        { wrap: kv.querySelector('.high-course-kv-ttl'), el: kv.querySelector('.TL.is-step') },
        { wrap: kv.querySelector('.high-course-kv-txt'), el: kv.querySelector('.TX.is-step') },
    ];

    const update = () => {
        blocks.forEach(({ wrap, el }, index) => {
            if (!wrap || !el) return;

            const rect = wrap.getBoundingClientRect();
            const total = wrap.offsetHeight - window.innerHeight;
            const progress = -rect.top / total;

            const show = index === 0 ? progress < 0.75 : progress > 0.15 && progress < 0.75;

            el.classList.toggle('is-current', show);
        });
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
});

// オープンスクール（タイトル→本文 その場でクロスフェード）
document.addEventListener('DOMContentLoaded', () => {
    const pin = document.querySelector('.high-openschool-pin');
    if (!pin) return;

    const kv = pin.querySelector('.high-openschool-layer--kv');
    const txt = pin.querySelector('.high-openschool-layer--txt');
    if (!kv || !txt) return;

    const FADE_START = 0.3; // ★ここから
    const FADE_END = 0.6; // ★ここまで、範囲を広げてゆったりに

    // なめらかな加減速カーブ（smoothstep）
    const easeInOut = t => t * t * (3 - 2 * t);

    const update = () => {
        const rect = pin.getBoundingClientRect();
        const total = pin.offsetHeight - window.innerHeight;
        if (total <= 0) return;
        const progress = Math.min(Math.max(-rect.top / total, 0), 1);

        let t;
        if (progress <= FADE_START) {
            t = 0;
        } else if (progress >= FADE_END) {
            t = 1;
        } else {
            t = (progress - FADE_START) / (FADE_END - FADE_START);
        }

        const eased = easeInOut(t);

        kv.style.opacity = 1 - eased;
        txt.style.opacity = eased;
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
});

// 高校インタビュー
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.high-changed-kv-item');
    if (!items.length) return;

    const update = () => {
        items.forEach(item => {
            const rect = item.getBoundingClientRect();
            const center = window.innerHeight * 0.5;
            const active = rect.top <= center && rect.bottom >= center;

            const bg = item.querySelector('.high-changed-kv-item-bg');
            const ttl = item.matches('.high-changed-kv-item-01, .high-changed-kv-item-02') ? item.querySelector('.high-changed-kv-item-ttl-inr') : null;

            if (bg) bg.classList.toggle('is-current', active);
            if (ttl) ttl.classList.toggle('is-current', active);
        });
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
});

// PC/SPで動画を出し分け（リサイズ・回転にも追従）
(function () {
    const video = document.querySelector('.js-responsive-video');
    if (!video) return;

    const BREAKPOINT = 767;
    let currentType = null; // 'pc' or 'sp'

    function setSrc() {
        const isSP = window.innerWidth <= BREAKPOINT;
        const type = isSP ? 'sp' : 'pc';

        if (type === currentType) return; // 同じなら何もしない（無駄な再読み込み防止）
        currentType = type;

        const newSrc = isSP ? video.dataset.srcSp : video.dataset.srcPc;
        video.src = newSrc;
        video.load();
        video.play().catch(() => {}); // autoplay対策
    }

    setSrc();
    window.addEventListener('resize', setSrc, { passive: true });
})();

if (location.hash) {
    window.addEventListener('load', () => {
        const target = document.querySelector(location.hash);
        if (!target) return;

        const imgs = Array.from(document.images).filter(img => !img.complete);
        const imagesReady = imgs.length
            ? Promise.race([
                  Promise.all(
                      imgs.map(
                          img =>
                              new Promise(resolve => {
                                  img.addEventListener('load', resolve, { once: true });
                                  img.addEventListener('error', resolve, { once: true });
                              })
                      )
                  ),
                  new Promise(resolve => setTimeout(resolve, 2000)), // 万一のフリーズ防止
              ])
            : Promise.resolve();

        Promise.all([document.fonts.ready, imagesReady]).then(() => {
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    // レイアウト確定をもう一段階待つ
                    target.scrollIntoView({ behavior: 'auto', block: 'start' });
                });
            });
        });
    });
}