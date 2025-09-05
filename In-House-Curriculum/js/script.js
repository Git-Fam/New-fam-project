$(function () {

  // マイページのタブ切り替え
  $('.tab').on('click', function () {
    var target = $(this).hasClass('tab--1') ? '.tab--content--progress' : '.tab--content--membership';
    $('.tab').not(this).removeClass('active');
    $(this).addClass('active');
    $('.tab--content > div').not(target).removeClass('active');
    $(target).addClass('active');
    $('.my--content').addClass('active');
  });

  $('.gorilla').on('click', function () {
    $('.my--content').removeClass('active');
  });


  $('.info_button').on('click', function () {
    $('.my--info').toggleClass('active');
  });

  // ボード系のクローズボタン
  $('.board-close').on('click', function () {
    $(this).closest('.comeback-board ,.log-board ,.continuous-board').addClass('none');
  });

  // SPキャラクタークリック
  $('.js-character-edit').on('click', function () {
    $(this).toggleClass('active');
  });

  // input要素の値を取得して表示
  document.querySelectorAll('.update--item').forEach(function (checkElement) {
    const rangeInput = checkElement.querySelector('[type="range"]');
    const valueOutput = checkElement.querySelector('output');

    rangeInput.addEventListener('input', (event) => {
      const value = event.target.value;
      valueOutput.textContent = value;
    });
  });

  // チェックボックスの状態を取得して表示
  // $(document).ready(function() {
  //   // プログレスバーのinput要素に対してイベントリスナーを設定
  //   $('.progressBar').on('input', function() {
  //       // input要素の値を取得
  //       var value = $(this).val();
  //       // 値が100の場合
  //       if (value == 100) {
  //           // 親要素の中の.deco要素に.activeクラスを追加
  //           $(this).closest('.update--item').find('.deco').addClass('active');
  //       } else {
  //           // それ以外の場合は.activeクラスを削除
  //           $(this).closest('.update--item').find('.deco').removeClass('active');
  //       }
  //   });
  // });




  // タブ切り替え
  $(document).ready(function () {
    $('.progress--TOC--ul--li').click(function () {
      // 全ての.progress--TOC--ul--li .TXから.activeを削除
      $('.progress--TOC--ul--li .TX').removeClass('active');
      // クリックされた.progress--TOC--ul--li .TXに.activeを追加
      $(this).find('.TX').addClass('active');

      // 全ての.progress--content .itemから.activeを削除
      $('.progress--content .item').removeClass('active');
      // クリックされた.progress--TOC--ul--liに対応する.progress--content .itemに.activeを追加
      var index = $(this).index();
      $('.progress--content .item').eq(index).addClass('active');
    });
  });

  // // タブ切り替え
  // $(document).ready(function () {
  //   $('.archive--item').on('click', function () {
  //     // すべての.archive--itemから.activeを削除
  //     $('.archive--item').removeClass('active');
  //     // クリックされた.archive--itemに.activeを追加
  //     $(this).addClass('active');

  //     // すべての.archive--contents--items--wapから.activeを削除
  //     $('.archive--contents--items--wap').removeClass('active');
  //     // クリックされた.archive--itemのインデックスに基づいて対応する.archive--contents--items--wapに.activeを追加
  //     var index = $('.archive--item').index(this);
  //     $('.archive--contents--items--wap').eq(index).addClass('active');
  //   });
  // });

<<<<<<< HEAD
=======
  // メッセージ上書き
  $(".swpm-login-error-msg").text(
    "メールアドレスまたはパスワードが正しくありません。"
  );
  $(".swpm-login-form-register-link").text("新規会員登録はこちら");
  // URLの取得と'/charged/'を追加
  // 現在のURLを取得
  var currentURL = window.location.origin + "/subscription/";
  
>>>>>>> new2_in_house_pi



  // メッセージ上書き
  $('.swpm-login-error-msg').text('メールアドレスまたはパスワードが正しくありません。');
  $('.swpm-login-form-register-link').text('新規会員登録はこちら');
  // URLの取得と'/charged/'を追加
  var currentURL = window.location.href + 'charged/';
  // URLを埋め込む
  // $('.swpm-post-no-access-msg').html(`このコンテンツを閲覧するには<a href="${currentURL}">有料会員レベル</a>が必要です。`);

  // $('.swpm-post-not-logged-in-msg').html(`このコンテンツを閲覧するには<a href="${currentURL}">有料会員レベル</a>が必要です。`);

  //25.0822変更　ランダムに訴求分を表示
 var noAccessMessages = [
   `<div class="no-access-img-container character"></div>この先はスタンダード専用です！<br>同期メンバーはもう次の冒険へ進んでいます。<br>あなたも一緒に挑戦を続けませんか?<br><a href="${currentURL}">スタンダード会員になる</a>`,
   `<div class="no-access-img-container character"></div>今、仲間が盛り上がっています！<br>スタンダードになるとコメント・質問・交流がすぐ可能に。<br>仲間と支え合って成長を加速させましょう！<br><a href="${currentURL}">スタンダード会員になる</a>`,
   `<div class="no-access-img-container character"></div>その疑問、すぐ解決できます！<br>スタンダードなら月15回まで質問OK。<br>つまずきを解消して、挫折しない学習へ！<br><a href="${currentURL}">スタンダード会員になる</a>`,
   `<div class="no-access-img-container character"></div>同期との交流イベントが間もなく開催！<br>スタンダード会員以上が参加可能な特別な時間！<br>学びと刺激を持ち帰ろう！<br><a href="${currentURL}">スタンダード会員になる</a>`,
   `<div class="no-access-img-container character"></div>クエストクリアおめでとう！<br>残りのステージはスタンダード専用です。<br>同期と一緒に最後まで走り抜けよう！<br><a href="${currentURL}">スタンダード会員になる</a>`,
 ];

 // 配列からランダムにメッセージを選択
 var randomMessage =
   noAccessMessages[Math.floor(Math.random() * noAccessMessages.length)];

 // 選択したメッセージを要素に埋め込む
 $(".swpm-post-no-access-msg").html(randomMessage);
 $(".swpm-post-not-logged-in-msg").html(randomMessage);





});




