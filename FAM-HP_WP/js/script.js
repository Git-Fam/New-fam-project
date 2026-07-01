$(function () {
  /* -----------------------
  header
----------------------- */
  // ⭐️⭐️⭐️ハンバーガーメニュー
  const hamburger = document.getElementById("js-hamburger");
  const drawer = document.getElementById("js-drawer");

  if (hamburger && drawer) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("is-open");
      drawer.classList.toggle("is-open");
      document.body.style.overflow = drawer.classList.contains("is-open")
        ? "hidden"
        : "";

        if (drawer.classList.contains("is-open")) {
            if (logoImg) logoImg.src = themeUri + "/img/global/fam_tosyo_logo_w.png";
          } else {
            // 閉じたらヘッダーのクラスに応じて戻す
            if (logoImg) {
              const isLight = header && header.classList.contains("header--light");
              logoImg.src = themeUri + (isLight ? "/img/global/fam_tosyo_logo_b.png" : "/img/global/fam_tosyo_logo_w.png");
            }
          }
    });

    // ドロワーのリンクをクリックしたら閉じる
    const drawerItems = drawer.querySelectorAll(".header__drawer-item");
    drawerItems.forEach((item) => {
      item.addEventListener("click", () => {
        hamburger.classList.remove("is-open");
        drawer.classList.remove("is-open");
        document.body.style.overflow = "";
      });
    });
  }

  // ⭐️⭐️⭐️PCメガメニュー
  const mega = document.getElementById("js-mega");
  const navWraps = document.querySelectorAll(".header__nav-item-wrap");

  if (mega && navWraps.length) {
    let closeTimer = null;
    const contactBand = document.querySelector(".header__mega-contact");
    const megaOverlay = document.getElementById("js-mega-overlay");

    navWraps.forEach((wrap) => {
      wrap.addEventListener("mouseenter", () => {
        clearTimeout(closeTimer);
        const key = wrap.dataset.menu;
        if (megaOverlay) megaOverlay.classList.add("is-active");

        mega
          .querySelectorAll(".header__mega-panel")
          .forEach((p) => p.classList.remove("is-active"));

        const target = mega.querySelector(`[data-panel="${key}"]`);
        if (target) target.classList.add("is-active");

        mega.classList.add("is-active");

        if (key === "contact") {
          mega.classList.add("is-contact");
          // ★CONTACTのとき帯SVGを変える
          if (contactBand)
            contactBand.style.backgroundImage = `url('${themeUri}/img/global/obi-contact.svg')`;
        } else {
          mega.classList.remove("is-contact");
          // ★それ以外は元のSVGに戻す
          if (contactBand)
            contactBand.style.backgroundImage = `url('${themeUri}/img/global/obi.svg')`;
        }

        // メガメニューが開いているときはロゴを黒に
        if (logoImg) logoImg.src = themeUri + "/img/global/fam_tosyo_logo_b.png";

        //ナビテキストを黒に
        navItems.forEach((item) => {
          item.style.color = "#333";
          item.style.webkitTextFillColor = "#333";
        });
      });

      wrap.addEventListener("mouseleave", () => {
        closeTimer = setTimeout(() => {
          mega.classList.remove("is-active");
          mega.classList.remove("is-contact");
          if (megaOverlay) megaOverlay.classList.remove("is-active");

          // メガメニューが閉じたらヘッダーのクラスに応じてロゴを戻す
          if (logoImg) {
            const isLight =
              header && header.classList.contains("header--light");
            logoImg.src =
              themeUri +
              (isLight
                ? "/img/global/fam_tosyo_logo_b.png"
                : "/img/global/fam_tosyo_logo_w.png");
          }

          navItems.forEach((item) => {
            item.style.color = "";
            item.style.webkitTextFillColor = "";
          });
        }, 200);
      });
    });

    mega.addEventListener("mouseenter", () => clearTimeout(closeTimer));
    mega.addEventListener("mouseleave", () => {
      closeTimer = setTimeout(() => {
        mega.classList.remove("is-active");
        mega.classList.remove("is-contact");
        if (megaOverlay) megaOverlay.classList.remove("is-active");

        // メガメニューが閉じたらロゴを戻す
        if (logoImg) {
          const isLight = header && header.classList.contains("header--light");
          logoImg.src =
            themeUri +
            (isLight
              ? "/img/global/fam_tosyo_logo_b.png"
              : "/img/global/fam_tosyo_logo_w.png");
        }

        navItems.forEach((item) => {
          item.style.color = "";
          item.style.webkitTextFillColor = "";
        });
      }, 200);
    });
  }

  // ナビ文字を1文字ずつspanで囲む
  const splitChars = (el) => {
    const text = el.textContent.trim();
    el.innerHTML = text
      .split("")
      .map((char) => `<span class="char">${char}</span>`)
      .join("");
  };

  const navItems = document.querySelectorAll(".header__nav-item");
  const drawerItems = document.querySelectorAll(".header__drawer-item");

  // PC・SPのナビに適用
  [...navItems, ...drawerItems].forEach((item) => {
    // drawerItemはspan.header__drawer-numを除いて処理
    if (item.classList.contains("header__drawer-item")) {
      const num = item.querySelector(".header__drawer-num");
      const numHTML = num ? num.outerHTML : "";
      const text = item.textContent
        .replace(num ? num.textContent : "", "")
        .trim();
      item.innerHTML =
        numHTML +
        text
          .split("")
          .map((char) => `<span class="char">${char}</span>`)
          .join("");
    } else {
      splitChars(item);
    }
  });

  // ⭐️⭐️⭐️ヘッダー色切り替え（スクロール連動）
  const header = document.querySelector(".header");
  const logoImg = document.querySelector(".header__logo-img");
  const themeUri = (() => {
    const link = document.querySelector('link[href*="main.css"]');
    return link ? link.href.replace("/css/main.css", "") : "";
  })();

  if (header) {
    const sections = document.querySelectorAll("[data-header]");

    const updateHeader = () => {
      const headerH = header.offsetHeight;
      const headerCenter = headerH / 2;
      let currentTheme = "dark"; // デフォルト

      sections.forEach((section) => {
        const rect = section.getBoundingClientRect();
        if (rect.top <= headerCenter && rect.bottom >= headerCenter) {
          currentTheme = section.dataset.header;
        }
      });

      if (currentTheme === "light") {
        header.classList.add("header--light");
        header.classList.remove("header--dark");
        if (logoImg) logoImg.src = themeUri + "/img/global/fam_tosyo_logo_b.png";
      } else {
        header.classList.add("header--dark");
        header.classList.remove("header--light");
        if (logoImg) logoImg.src = themeUri + "/img/global/fam_tosyo_logo_w.png";
      }
    };

    window.addEventListener("scroll", updateHeader, { passive: true });
    updateHeader();
  }

  /* -----------------------
  テキストアニメーション
----------------------- */
 // ⭐️⭐️⭐️チカチカアニメーション関数
const timerMap = new WeakMap();

const flickerChars = (chars, toVisible) => {
  chars.forEach((char) => {
    // 既存タイマーをキャンセル
    const existing = timerMap.get(char);
    if (existing) existing.forEach(clearTimeout);

    const delays = [];
    const flickerCount = 4 + Math.floor(Math.random() * 4);
    for (let i = 0; i < flickerCount; i++) {
      delays.push(Math.random() * 180);
    }
    delays.sort((a, b) => a - b);

    const timers = [];
    delays.forEach((delay) => {
      const t = setTimeout(() => {
        char.classList.toggle('is-hovered');
      }, delay);
      timers.push(t);
    });

    // 最終状態を確定
    const finalDelay = delays[delays.length - 1] + 60;
    const finalTimer = setTimeout(() => {
      if (toVisible) {
        char.classList.remove('is-hovered'); // 表示状態に戻す
      } else {
        char.classList.add('is-hovered'); // 消えた状態に確定
      }
    }, finalDelay);
    timers.push(finalTimer);

    timerMap.set(char, timers);
  });
};

[...navItems, ...drawerItems].forEach((item) => {
  item.addEventListener('mouseenter', () => {
    const chars = item.querySelectorAll('.char');
    flickerChars(chars, false); // チカチカ→消える
  });

  item.addEventListener('mouseleave', () => {
    const chars = item.querySelectorAll('.char');
    flickerChars(chars, true); // チカチカ→元に戻る
  });
});


  // ⭐️⭐️⭐️BUSINESSセクション 動画切り替え
  const bizItems = document.querySelectorAll(".business-sec__item");
  const bizVideos = document.querySelectorAll(".business-sec__video");

  if (bizItems.length && bizVideos.length) {
    const activateBiz = (key) => {
      bizVideos.forEach((v) => v.classList.remove("is-active"));
      bizItems.forEach((item) => {
        item.classList.remove("is-active");
        item.style.transform = ""; // 全員一旦リセット
      });

      const targetVideo = document.querySelector(
        `.business-sec__video[data-video="${key}"]`,
      );
      const targetItem = document.querySelector(
        `.business-sec__item[data-video="${key}"]`,
      );

      if (targetVideo) {
        targetVideo.classList.add("is-active");
        targetVideo.play();
      }

      if (targetItem) {
        targetItem.classList.add("is-active");

        // ★SPの場合のみ、アクティブになったら自動で右にずらす
        if (window.innerWidth <= 767) {
          targetItem.style.transform = "translateX(10px)"; // SP用の移動量
        }
      }
    };

    // 初期表示
    activateBiz("01");

    if (window.innerWidth <= 767) {
      // SP：自動ローテーション
      let currentIndex = 0;
      setInterval(() => {
        currentIndex = (currentIndex + 1) % bizItems.length;
        const key = String(currentIndex + 1).padStart(2, "0");
        activateBiz(key);
      }, 3000);
    } else {
      // PC：ホバーで切り替え ＋ ホバー時のみスライド
      bizItems.forEach((item) => {
        item.addEventListener("mouseenter", () => {
          const key = item.dataset.video;
          activateBiz(key);
          // PCは「今ホバーしている要素」だけを個別に動かす
          item.style.transform = `translateX(${(16 / 1280) * 100}vw)`;
        });

        item.addEventListener("mouseleave", () => {
          // マウスが離れたら位置を戻す
          item.style.transform = "";
        });
      });
    }
  }

  // ⭐️⭐️⭐️テキストリビールアニメーション
  const revealTexts = document.querySelectorAll(".js-text-reveal");

  if (revealTexts.length) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
          } else {
            entry.target.classList.remove("is-visible");
          }
        });
      },
      {
        threshold: 0.3,
      },
    );

    revealTexts.forEach((el) => observer.observe(el));
  }

  // ⭐️⭐️⭐️テキストマスクアニメーション（js-mask-text）
  const maskTexts = document.querySelectorAll(".js-mask-text");

  maskTexts.forEach((el) => {
    const html = el.innerHTML;
    el.innerHTML = `<span class="mask-wrap"><span class="mask-char">${html}</span></span>`;
  });

  // CAREERSセクション内のjs-mask-textは出現・消滅を繰り返す
  const careersSection = document.querySelector(".careers-sec");
  const normalMaskTexts = [];
  const careersMaskTexts = [];

  maskTexts.forEach((el) => {
    if (careersSection && careersSection.contains(el)) {
      careersMaskTexts.push(el);
    } else {
      normalMaskTexts.push(el);
    }
  });

  // 通常（一度だけ出現）
  const maskObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const chars = entry.target.querySelectorAll(".mask-char");
          chars.forEach((char, i) => {
            setTimeout(() => {
              char.classList.add("is-visible");
            }, i * 120);
          });
          maskObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 },
  );

  normalMaskTexts.forEach((el) => maskObserver.observe(el));

  // CAREERS（スクロール位置で出現・消滅を制御）
  const careersContent = document.querySelector(".careers-sec__content");

  if (careersContent && careersMaskTexts.length) {
    careersMaskTexts.forEach((el) => {
      const chars = el.querySelectorAll(".mask-char");
      chars.forEach((char) => char.classList.remove("is-visible"));
    });

    window.addEventListener("scroll", () => {
      const rect = careersContent.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      const isVisible =
        rect.top < windowHeight * 0.7 && rect.bottom > windowHeight * 0.3;
      const isLeaving =
        rect.top < windowHeight * 0.3 && rect.bottom < windowHeight * 0.3;

      if (isVisible) {
        careersMaskTexts.forEach((el, elIndex) => {
          const chars = el.querySelectorAll(".mask-char");
          chars.forEach((char, i) => {
            if (!char.classList.contains("is-visible")) {
              setTimeout(
                () => {
                  char.classList.add("is-visible");
                },
                (elIndex * 3 + i) * 40,
              );
            }
          });
        });
      } else {
        careersMaskTexts.forEach((el) => {
          const chars = el.querySelectorAll(".mask-char");
          chars.forEach((char) => char.classList.remove("is-visible"));
        });
      }
    });
  }

  /* -----------------------
  TOP
----------------------- */

  // ⭐️⭐️⭐️CAREERSセクション 背景画像 奥からポワン
const careersBgImgs = document.querySelectorAll('.careers-sec__bg-img');

if (careersBgImgs.length) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        const index = [...careersBgImgs].indexOf(entry.target);
        if (entry.isIntersecting) {
          // 画面に入ってきたとき：時間差でポワンと出現
          setTimeout(() => {
            entry.target.classList.add('is-visible');
            entry.target.classList.remove('is-hidden');
          }, index * 150);
        } else {
          // 画面外に出たとき：小さく戻る
          entry.target.classList.remove('is-visible');
          entry.target.classList.add('is-hidden');
        }
      });
    },
    { threshold: 0.1 }
  );

  careersBgImgs.forEach((img) => observer.observe(img));
}

  /* -----------------------
  COMPANY
----------------------- */

  // ⭐️⭐️⭐️パララックス（汎用）
  // 使い方: 背景要素に data-parallax="親セレクタ" を付けるだけ
  // 例: <div class="ceo-sec__bg" data-parallax=".ceo-sec">
  // 強度変更: data-parallax-strength="0.3"（省略時0.3）

  const parallaxEls = document.querySelectorAll("[data-parallax]");

  if (parallaxEls.length) {
    const parallaxItems = Array.from(parallaxEls)
      .map((el) => {
        const parentSel = el.dataset.parallax;
        const strength = parseFloat(el.dataset.parallaxStrength) || 0.3;
        const parent = parentSel
          ? document.querySelector(parentSel)
          : el.parentElement;
        return { el, parent, strength };
      })
      .filter((item) => item.parent);

    const updateParallax = () => {
      parallaxItems.forEach(({ el, parent, strength }) => {
        const rect = parent.getBoundingClientRect();
        const secHeight = parent.offsetHeight;
        const progress = 1 - rect.bottom / (secHeight + window.innerHeight);
        const move = progress * secHeight * strength;
        el.style.transform = `translateY(${move}px)`;
      });
    };

    window.addEventListener("scroll", updateParallax, { passive: true });
    updateParallax(); // 初期実行
  }

  // ⭐️⭐️⭐️COMPANY fullimg 左右余白アニメーション
  const fullimgWrap = document.querySelector(".company__fullimg-wrap");

  if (fullimgWrap) {
    const update = () => {
      const rect = fullimgWrap.getBoundingClientRect();
      const windowH = window.innerHeight;

      // 画面下端に入ってきてから中央に来るまで 0→1
      const progress = Math.min(1, Math.max(0, 1 - rect.top / windowH));

      // p(80) = 80/1280*100vw → 0vw
      const pad = (1 - progress) * ((280 / 1280) * 100);
      fullimgWrap.style.padding = `0 ${pad}vw`;
    };

    window.addEventListener("scroll", update, { passive: true });
    update();
  }

  /* -----------------------
  　BUSINESS
----------------------- */
  // ⭐️⭐️⭐️BUSINESSページ スクロール切り替え
  const bizWrap = document.querySelector(".biz-wrap");
  const bizTextItems = document.querySelectorAll(".biz-sec__text-item");
  const bizImgItems = document.querySelectorAll(".biz-sec__img-item");

  if (bizWrap && bizTextItems.length) {
    const total = bizTextItems.length;
    let currentIndex = -1;

    const activateBizItem = (index) => {
      if (index === currentIndex) return;

      bizTextItems.forEach((el, i) => {
        el.classList.remove("is-active", "is-exit");
        if (i === index) {
          el.classList.add("is-active");

          // ⭐️ is-activeになったタイミングでjs-text-revealを発火
          const revealEls = el.querySelectorAll(".js-text-reveal");
          revealEls.forEach((rev) => {
            // 一旦リセットしてから少し遅らせて発火（スライドアップと同期）
            rev.classList.remove("is-visible");
            setTimeout(() => {
              rev.classList.add("is-visible");
            }, 200); // biz-sec__text-itemのtransition(0.6s)の途中で発火
          });
        } else if (i < index) {
          el.classList.add("is-exit");

          // 抜けるときはリビールをリセット
          const revealEls = el.querySelectorAll(".js-text-reveal");
          revealEls.forEach((rev) => rev.classList.remove("is-visible"));
        }
      });

      bizImgItems.forEach((el, i) => {
        el.classList.remove("is-active", "is-exit");
        if (i === index) {
          el.classList.add("is-active");
        } else if (i < index) {
          el.classList.add("is-exit");
        }
      });

      currentIndex = index;
    };

    activateBizItem(0);

    window.addEventListener(
      "scroll",
      () => {
        const rect = bizWrap.getBoundingClientRect();
        const wrapHeight = bizWrap.offsetHeight;
        const windowH = window.innerHeight;

        const progress = Math.min(
          1,
          Math.max(0, -rect.top / (wrapHeight - windowH)),
        );

        const index = Math.min(total - 1, Math.floor(progress * total));
        activateBizItem(index);
      },
      { passive: true },
    );
  }


 // ⭐️⭐️⭐️BUSINESSページ ハッシュでインデックスジャンプ
if (bizWrap && bizTextItems.length) {
  const hash = window.location.hash;
  if (hash) {
    const indexMap = {
      '#biz-01': 0,
      '#biz-02': 1,
      '#biz-03': 2,
      '#biz-04': 3,
    };
    const targetIndex = indexMap[hash];
    if (targetIndex !== undefined) {
      window.addEventListener('load', () => {
        setTimeout(() => {
          // まずbiz-wrapの先頭までスクロール
          const wrapTop = bizWrap.offsetTop;
          const wrapHeight = bizWrap.offsetHeight;
          const windowH = window.innerHeight;
          const scrollableHeight = wrapHeight - windowH;

          // 各インデックスの境界値の中間にスクロール
          // 0→0〜25%, 1→25〜50%, 2→50〜75%, 3→75〜100%
          const ratio = (targetIndex + 0.5) / 4;
          const scrollTarget = wrapTop + ratio * scrollableHeight;

          window.scrollTo({ top: scrollTarget, behavior: 'instant' });

          // スクロール後にアクティブなインデックスを強制セット
          activateBizItem(targetIndex);
        }, 100);
      });
    }
  }
}
  /* -----------------------
  　アニメーション付与
----------------------- */

  // ⭐️⭐️⭐️アニメーション処理を関数化
  function checkAnimation() {
    $(".up, .roll, .right, .left, .down, .pop").each(function () {
      var top_of_element = $(this).offset().top;
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > top_of_element) {
        $(this).addClass("show");
      }
    });
  }

  // スクロール時
  $(window).scroll(function () {
    checkAnimation();
  });

  // ページ読み込み時にも実行
  $(document).ready(function () {
    checkAnimation();
  });

  /* -----------------------
  　お問い合わせ確認画面
----------------------- */

  // ⭐️⭐️⭐️確認ボタンの活性/非活性制御
  const confirmBtnEl = document.querySelector(".cf7-confirm-btn");

  if (confirmBtnEl) {
    const form = document.querySelector(".wpcf7-form");

    // 初期状態は非活性（薄く）
    confirmBtnEl.classList.add("is-disabled");

    const checkFormValid = () => {
      // 必須テキスト系フィールド
      const requiredInputs = form.querySelectorAll(
        ".wpcf7-validates-as-required",
      );
      let allFilled = true;
      requiredInputs.forEach((el) => {
        if (!el.value.trim()) allFilled = false;
      });

      // チェックボックス（同意）
      const checkbox = form.querySelector('input[type="checkbox"]');
      const checked = checkbox ? checkbox.checked : true;

      if (allFilled && checked) {
        confirmBtnEl.classList.remove("is-disabled");
      } else {
        confirmBtnEl.classList.add("is-disabled");
      }
    };

    // 入力のたびにチェック
    form.addEventListener("input", checkFormValid);
    form.addEventListener("change", checkFormValid);
  }

  // ⭐️⭐️⭐️CONTACTフォーム 確認画面
  const formArea = document.querySelector(".cf7-form-area");
  const confirmArea = document.querySelector(".cf7-confirm-area");
  const confirmBtn = document.querySelector(".cf7-confirm-btn");

  if (formArea && confirmArea && confirmBtn) {
    confirmBtn.addEventListener("click", () => {
      const form = document.querySelector(".wpcf7-form");

      // 必須チェック
      const requiredFields = form.querySelectorAll(
        ".wpcf7-validates-as-required",
      );
      let valid = true;
      requiredFields.forEach((el) => {
        if (!el.value.trim()) valid = false;
      });
      if (!valid) {
        // CF7のバリデーションを走らせる
        form.querySelector('[type="submit"]') &&
          form.querySelector('[type="submit"]').click();
        return;
      }

      const rows = [];

      // ラジオボタン
      const radioChecked = form.querySelector('input[type="radio"]:checked');
      if (radioChecked) {
        const label = radioChecked
          .closest(".wpcf7-list-item")
          ?.querySelector(".wpcf7-list-item-label");
        rows.push({
          label: "お問い合わせ項目",
          value: label ? label.textContent.trim() : "",
        });
      }

      // テキスト・メール・電話・テキストエリア
      const fields = form.querySelectorAll(".cf7-field");
      fields.forEach((field) => {
        const labelEl = field.querySelector("label");
        const input = field.querySelector(
          'input[type="text"], input[type="email"], input[type="tel"], textarea',
        );
        if (labelEl && input) {
          const labelText = labelEl.textContent.replace("*", "").trim();
          rows.push({ label: labelText, value: input.value });
        }
      });

      // プライバシーポリシー
      const acceptance = form.querySelector('input[type="checkbox"]:checked');
      rows.push({
        label: "プライバシーポリシー",
        value: acceptance ? "✓ 同意しました" : "未同意",
      });

      // テーブル生成
      const tbody = confirmArea.querySelector(".cf7-confirm-table tbody");
      tbody.innerHTML = rows
        .map(
          (row) => `
      <tr>
        <th>${row.label}</th>
        <td>${row.value.replace(/\n/g, "<br>")}</td>
      </tr>
    `,
        )
        .join("");

      // 画面切り替え
      formArea.style.display = "none";
      confirmArea.style.display = "block";
      window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // 戻るボタン
    const backBtn = confirmArea.querySelector(".cf7-back-btn");
    if (backBtn) {
      backBtn.addEventListener("click", () => {
        confirmArea.style.display = "none";
        formArea.style.display = "block";
      });
    }

    // 送信ボタン
    const sendBtn = confirmArea.querySelector(".cf7-send-btn");
    if (sendBtn) {
      sendBtn.addEventListener("click", () => {
        // CF7のsubmitを実行
        const submitBtn = document.querySelector('.wpcf7-form [type="submit"]');
        if (submitBtn) submitBtn.click();

        // 送信成功時にサンクスページへ遷移
        document.addEventListener("wpcf7mailsent", function handler() {
          window.location.href = "/thanks/";
          document.removeEventListener("wpcf7mailsent", handler);
        });

        // 送信失敗時は入力画面に戻す
        document.addEventListener("wpcf7invalid", function handler() {
          confirmArea.style.display = "none";
          formArea.style.display = "block";
          document.removeEventListener("wpcf7invalid", handler);
        });
      });
    }
  }

  /* -----------------------
  　カーソル
----------------------- */
  // ⭐️⭐️⭐️カスタムカーソル（COMPANY・CAREERSセクション）
  const cursorEl = document.createElement("div");
  cursorEl.classList.add("custom-cursor");
  cursorEl.innerHTML = `
  <div class="custom-cursor__inner">
    <img src="${(() => {
      const link = document.querySelector('link[href*="main.css"]');
      return link ? link.href.replace("/css/main.css", "") : "";
    })()}/img/global/arrow-cursor.svg" alt="">
  </div>
`;
  document.body.appendChild(cursorEl);

  const cursorSections = [
    { selector: ".company-sec", url: "/company/" },
    { selector: ".careers-sec", url: "/careers/" },
  ];

  let mouseX = 0;
  let mouseY = 0;
  let currentX = 0;
  let currentY = 0;
  let isInSection = false;

  // なめらかに追従（lerp）
  const lerp = (a, b, t) => a + (b - a) * t;

  const animateCursor = () => {
    currentX = lerp(currentX, mouseX, 0.12);
    currentY = lerp(currentY, mouseY, 0.12);
    cursorEl.style.transform = `translate(${currentX}px, ${currentY}px)`;
    requestAnimationFrame(animateCursor);
  };
  animateCursor();

  document.addEventListener("mousemove", (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  cursorSections.forEach(({ selector, url }) => {
    const section = document.querySelector(selector);
    if (!section) return;

    section.addEventListener("mouseenter", () => {
      cursorEl.classList.add("is-visible");
      isInSection = true;
      section.style.cursor = "none";
    });

    section.addEventListener("mouseleave", () => {
      cursorEl.classList.remove("is-visible");
      isInSection = false;
      section.style.cursor = "";
    });

    section.addEventListener("click", (e) => {
      // リンクや子要素のクリックは除外
      if (e.target.closest("a")) return;
      window.location.href = url;
    });
  });

  // // CONTACTパネルにカスタムカーソル
  // const contactPanel = mega.querySelector('[data-panel="contact"]');

  // if (contactPanel) {
  //   contactPanel.addEventListener("mouseenter", () => {
  //     cursorEl.classList.add("is-visible");
  //     contactPanel.style.cursor = "none";
  //   });

  //   contactPanel.addEventListener("mouseleave", () => {
  //     cursorEl.classList.remove("is-visible");
  //     contactPanel.style.cursor = "";
  //   });

  //   contactPanel.addEventListener("mousemove", (e) => {
  //     mouseX = e.clientX;
  //     mouseY = e.clientY;
  //   });
  // }
// ]全パネルに変更
const megaPanels = mega.querySelectorAll('.header__mega-panel');

megaPanels.forEach((panel) => {
  panel.addEventListener("mouseenter", () => {
    cursorEl.classList.add("is-visible");
    panel.style.cursor = "none";
  });

  panel.addEventListener("mouseleave", () => {
    cursorEl.classList.remove("is-visible");
    panel.style.cursor = "";
  });

  panel.addEventListener("mousemove", (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });
});


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