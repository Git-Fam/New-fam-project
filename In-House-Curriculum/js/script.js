$(function () {   

  // マイページのタブ切り替え
  $('.tab').on('click', function() {
    var target = $(this).hasClass('tab--1') ? '.tab--content--progress' : '.tab--content--membership';
    $('.tab').not(this).removeClass('active');
    $(this).addClass('active');
    $('.tab--content > div').not(target).removeClass('active');
    $(target).addClass('active');
    $('.my--content').addClass('active');
});

$('.gorilla').on('click', function() {
  $('.my--content').removeClass('active');
});

$('.info_button').on('click', function() {
  $('.my--info').toggleClass('active');
});



// input要素の値を取得して表示
document.querySelectorAll('.update--item').forEach(function(checkElement) {
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
$(document).ready(function() {
  $('.progress--TOC--ul--li').click(function() {
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

// タブ切り替え
$(document).ready(function() {
  $('.archive--item').on('click', function() {
      // すべての.archive--itemから.activeを削除
      $('.archive--item').removeClass('active');
      // クリックされた.archive--itemに.activeを追加
      $(this).addClass('active');

      // すべての.archive--contents--items--wapから.activeを削除
      $('.archive--contents--items--wap').removeClass('active');
      // クリックされた.archive--itemのインデックスに基づいて対応する.archive--contents--items--wapに.activeを追加
      var index = $('.archive--item').index(this);
      $('.archive--contents--items--wap').eq(index).addClass('active');
  });
});


// メッセージ上書き
$('.swpm-login-error-msg').text('メールアドレスまたはパスワードが正しくありません。');
$('.swpm-login-form-register-link').text('新規会員登録はこちら');
// URLの取得と'/charged/'を追加
var currentURL = window.location.href + 'charged/';
// URLを埋め込む
$('.swpm-post-no-access-msg').html(`このコンテンツを閲覧するには<a href="${currentURL}">有料会員レベル</a>が必要です。`);

$('.swpm-post-not-logged-in-msg').html(`このコンテンツを閲覧するには<a href="${currentURL}">有料会員レベル</a>が必要です。`);




});