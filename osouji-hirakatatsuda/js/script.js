// LPのバーガーだったらボタン押された処理も書く
$(function () {
  $('.sp-menu__link, .button').on('click', function () {
    $('#sp-menu__check').prop('checked', false);
  });
}());


jQuery(function ($) {
  $(document).ready(function () {
    $('.accordion_title').click(function () {
      var $accordionInr = $(this).siblings('.accordion_001_inr');
      var isOpen = $accordionInr.hasClass('active');

      // 他のアコーディオンを閉じる
      $('.accordion_001_inr.active').slideUp(0, function () {
        $(this).removeClass('active');
        $(this).siblings('.accordion_title').find('.pointer').removeClass('active'); // 矢印を上向きに
      });

      if (isOpen) {
        $accordionInr.slideUp(0, function () {
          $accordionInr.removeClass('active');
          $(this).siblings('.accordion_title').find('.pointer').removeClass('active'); // 矢印を上向きに
        });
      } else {
        $accordionInr.addClass('active').slideDown(0);
        $(this).find('.pointer').addClass('active'); // 矢印を下向きに
      }
      return false;
    });
  });
});


function fadeAnime() {
  $('.fadeUpTrigger').each(function () {
    var elemPos = $(this).offset().top - 10;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeUp');
    } else {
      $(this).removeClass('fadeUp');
    }
  });

  $('.fadeInTrigger').each(function () {
    var elemPos = $(this).offset().top - 10;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeIn');
    } else {
      $(this).removeClass('fadeIn');
    }
  });

  $('.fadeLeftTrigger').each(function () { //fadeLeftTriggerというクラス名が
    var elemPos = $(this).offset().top - 10; //要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeLeft'); // 画面内に入ったらfadeLeftというクラス名を追記
    } else {
      $(this).removeClass('fadeLeft'); // 画面外に出たらfadeLeftというクラス名を外す
    }
  });

  $('.fadeRightTrigger').each(function () { //fadeRightTriggerというクラス名が
    var elemPos = $(this).offset().top - 50; //要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('fadeRight'); // 画面内に入ったらfadeRightというクラス名を追記
    } else {
      $(this).removeClass('fadeRight'); // 画面外に出たらfadeRightというクラス名を外す
    }
  });
}
$(window).scroll(function () {
  fadeAnime(); /* アニメーション用の関数を呼ぶ*/
});

document.addEventListener('DOMContentLoaded', () => {
  //.validationForm を指定した最初の form 要素を取得
  const validationForm = document.querySelector('.validationForm');
  //.validationForm を指定した form 要素が存在すれば
  if (validationForm) {
    //エラーを表示する span 要素に付与するクラス名（エラー用のクラス）
    const errorClassName = 'error';

    const radioElems = document.querySelectorAll('.radio');
    //required クラスを指定された要素の集まり  
    const requiredElems = document.querySelectorAll('.required');
    //email クラスを指定された要素の集まり
    const emailElems = document.querySelectorAll('.email');
    //tel クラスを指定された要素の集まり
    const telElems = document.querySelectorAll('.tel');
    //equal-to クラスを指定された要素の集まり
    const equalToElems = document.querySelectorAll('.equal-to');

    //エラーメッセージを表示する span 要素を生成して親要素に追加する関数
    //elem ：対象の要素
    //errorMessage ：表示するエラーメッセージ
    const createError = (elem, errorMessage) => {
      //span 要素を生成
      const errorSpan = document.createElement('span');
      //エラー用のクラスを追加（設定）
      errorSpan.classList.add(errorClassName);
      //aria-live 属性を設定
      errorSpan.setAttribute('aria-live', 'polite');
      //引数に指定されたエラーメッセージを設定
      errorSpan.textContent = errorMessage;
      //elem の親要素の子要素として追加
      elem.parentNode.appendChild(errorSpan);
    }

    const updateConfirmationModal = (selectedValue) => {
      // ここで確認モーダルの表示内容を更新
      // 例えば、id="display-radio" の要素に表示するならば
      document.getElementById('display-radio').textContent = selectedValue;
    };

    //form 要素の submit イベントを使った送信時の処理
    validationForm.addEventListener('submit', (e) => {
      //エラーを表示する要素を全て取得して削除（初期化）
      const errorElems = validationForm.querySelectorAll('.' + errorClassName);
      errorElems.forEach((elem) => {
        elem.remove();
      });

      let isValid = true;

      //.required を指定した要素を検証
      requiredElems.forEach((elem) => {
        //値（value プロパティ）の前後の空白文字を削除
        const elemValue = elem.value.trim();
        //値が空の場合はエラーを表示してフォームの送信を中止
        if (elemValue.length === 0) {
          createError(elem, '入力は必須です');
          isValid = false;
          e.preventDefault();
        }
      });

      //.email を指定した要素を検証
      emailElems.forEach((elem) => {
        //Email の検証に使用する正規表現パターン
        const pattern = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ui;
        //値が空でなければ
        if (elem.value !== '') {
          //test() メソッドで値を判定し、マッチしなければエラーを表示してフォームの送信を中止
          if (!pattern.test(elem.value)) {
            createError(elem, 'Email アドレスの形式が正しくないようです。');
            isValid = false;
            e.preventDefault();
          }
        }
      });

      if (isValid) {
        e.preventDefault();
        const selectedRadio = document.querySelector('input[name="radio"]:checked');
        const selectedValue = selectedRadio ? selectedRadio.value : '未選択';

        // 更新関数を呼び出し、確認モーダルの表示内容を更新
        updateConfirmationModal(selectedValue);

        document.getElementById("confirmation-modal").style.display = "block";
      }

      radioElems.forEach((radio) => {
        radio.addEventListener('change', () => {
          const selectedValue = document.querySelector('input[name="radio"]:checked').value;
          // 更新関数を呼び出し、確認モーダルの表示内容を更新
          updateConfirmationModal(selectedValue);
        });
      });
    });
  }
});

document.getElementById('My-Form').addEventListener('input', function () {
  var radio = document.querySelector('input[name="radio"]').value;
  document.getElementById('display-radio').textContent = radio;

  var name = document.querySelector('input[name="name"]').value;
  document.getElementById('display-name').textContent = name;

  var furigana = document.querySelector('input[name="furigana"]').value;
  document.getElementById('display-furigana').textContent = furigana;

  var address = document.querySelector('input[name="address"]').value;
  document.getElementById('display-address').textContent = address;

  var tel = document.querySelector('input[name="tel"]').value;
  document.getElementById('display-tel').textContent = tel;

  var email = document.querySelector('input[name="email"]').value;
  document.getElementById('display-email').textContent = email;

  var isMsg = document.querySelector('textarea[name="isMsg"]').value;
  document.getElementById('display-isMsg').textContent = isMsg;
});



// 確認ボタンがクリックされた際の処理
// document.getElementById("confirm-button").addEventListener("click", function () {
//   // ここでフォームデータを送信するためのAjaxリクエストを追加することができます。
//   // モーダルを閉じるか、成功時のメッセージを表示することができます。

  
// });

document.getElementById("confirm-button").addEventListener("click", function () {
  document.getElementById("confirmation-modal").style.display = "block";
  // フォームデータを取得
  var formData = new FormData(document.getElementById("My-Form")); // フォームのIDを指定

  // XMLHttpRequestを作成
  var xhr = new XMLHttpRequest();
  
  // リクエストメソッドと送信先URLを指定
  xhr.open("POST", "form.php", true);

  // リクエストが変化した際の処理
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) { // リクエストが完了したら
      if (xhr.status === 200) { // ステータスコードが200 (成功) の場合
        // 成功時の処理をここに追加
        console.log("フォームが正常に送信されました");
        alert("送信が完了しました。担当者からの返信をお待ちください。"); 
        window.location.href = "index.html";
        // モーダルを閉じたり、成功メッセージを表示したりすることができます
        document.getElementById("confirmation-modal").style.display = "block";
      } else {
        // エラーが発生した場合の処理
        console.error("フォームの送信中にエラーが発生しました");
        // エラーメッセージを表示したり、適切なエラーハンドリングを行ったりします
      }
    }
  };

  // フォームデータを送信
  xhr.send(formData);
  document.getElementById("confirmation-modal").style.display = "none";
});

// モーダルを閉じる
document.getElementById("close-button").addEventListener("click", function () {
  document.getElementById("confirmation-modal").style.display = "none";
});