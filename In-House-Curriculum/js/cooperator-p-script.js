// // 768以上のウィンドウサイズのみ　横scroll
// $(document).ready(function () {
//   const windowWidth = $(window).width();
//   const panels = gsap.utils.toArray(".js-scroll");
//   const wrapper = document.querySelector(".scl-wrapper");

//   if (wrapper && windowWidth > 768) {
//     const wrapperWidth = wrapper.offsetWidth;

//     gsap.to(panels, {
//       xPercent: -100 * (panels.length - 1), // transformX
//       ease: "none", // easingの設定
//       scrollTrigger: {
//         trigger: wrapper, // アニメーションの対象となる要素
//         pin: true, // 要素を固定する
//         scrub: 1, // スクロールとアニメーションを同期させる。数値で秒数の設定に
//         end: () => "+1000=" + wrapperWidth, // アニメーションの終了タイミング
//       },
//     });
//   }
// });

// pcは横scroll、spは横スクロール削除（縦スクロール）
$(document).ready(function () {
  const panels = gsap.utils.toArray(".js-scroll");
  const wrapper = document.querySelector(".scl-wrapper");

  ScrollTrigger.matchMedia({
    // 768px以上のメディアクエリに対するアニメーション設定
    "(min-width: 768px)": function () {
      if (wrapper) {
        const wrapperWidth = wrapper.offsetWidth;

        gsap.to(panels, {
          xPercent: -100 * (panels.length - 1), // transformX
          ease: "none", // easingの設定
          scrollTrigger: {
            trigger: wrapper, // アニメーションの対象となる要素
            pin: true, // 要素を固定する
            scrub: 1, // スクロールとアニメーションを同期させる。数値で秒数の設定に
            end: () => "+1000=" + wrapperWidth, // アニメーションの終了タイミング
          },
        });
      }
    },

    // 767px以下のメディアクエリに対するアニメーション設定
    "(max-width: 767px)": function () {
      // 768px以下の場合、スクロール効果を無効にする
      gsap.set(panels, { xPercent: 0 });
    },
  });
});

// 画面を見込んだらshowを付与

$(document).ready(function () {
  $(".up,.bird iframe").each(function () {
    var element_height = $(this).outerHeight();
    var element_top = $(this).offset().top;
    var element_middle = element_top + element_height / 2;
    var window_middle = $(window).scrollTop() + $(window).height() / 2;
    if (window_middle > element_middle) {
      $(this).addClass("show");
    }
  });
});

$(document).ready(function(){
  // ページが読み込まれた後に実行されるコード
  setTimeout(function(){
      // 0.5秒後に実行されるコード
      $('.rabbit iframe').addClass('show');
  }, 500); // 500ミリ秒 = 0.5秒
});


// 古いバージョン

// $(document).ready(function () {
//   const windowWidth = $(window).width();
//   const panels = gsap.utils.toArray(".js-scroll");
//   const wrapper = document.querySelector(".scl-wrapper");

//   if (wrapper && windowWidth > 768) {
//     // キャラクター要素を取得
//     const character = document.querySelector(".C_character.character-3");

//     // キャラクターの初期位置を取得
//     const characterTop = 385;
//     const characterLeft = -400;

//     character.style.position = "fixed";
//     character.style.left = characterLeft + "%";

//     window.addEventListener("scroll", function () {
//       // キャラクターを固定する関数
//       const fixCharacter = function () {
//         const scrollLeft =
//           window.pageYOffset || document.documentElement.scrollLeft;
//         // const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
//         character.style.left = characterLeft + scrollLeft * 0.062 + "%";
//       };

//       fixCharacter(); // キャラクターを固定
//     });
//   }
// });


// 修正―最新キャラ固定
$(document).ready(function () {
  const windowWidth = $(window).width();
  const panels = gsap.utils.toArray(".js-scroll");
  const wrapper = document.querySelector(".scl-wrapper");

  ScrollTrigger.matchMedia({
    // 768px以上のメディアクエリに対するアニメーション設定
    "(min-width: 768px)": function () {
      if (wrapper && windowWidth > 768) {
        // キャラクター要素を取得
        const character = document.querySelector(".C_character.character-3");

        // キャラクターの初期位置を取得
        const characterTop = 385;
        const characterLeft = -400;

        // body要素に対してposition: fixedを設定
        character.style.position = "fixed";
        // キャラクターの位置を設定
        character.style.left = characterLeft + "%";

        window.addEventListener("scroll", function () {
          // キャラクターを固定する関数
          const fixCharacter = function () {
            const scrollLeft =
              window.pageYOffset || document.documentElement.scrollLeft;
            character.style.left = characterLeft + scrollLeft * 0.062 + "%";
          };

          fixCharacter(); // キャラクターを固定
        });
      }
    },
  });
});
