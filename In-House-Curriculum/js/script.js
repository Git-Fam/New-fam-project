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


  // カテゴリータブ切り替え(スキン編集画面)
  $(document).ready(function () {
    $('.category__list__items li').on('click', function () {
      $('.category__list__items li').removeClass('active');
      $(this).addClass('active');

      $('.tag__list__area').removeClass('active');
      var index = $('.category__list__items li').index(this);
      $('.tag__list__area').eq(index).addClass('active');

      $('.control__list__wrap').removeClass('active');
      $('.control__list__wrap').eq(index).addClass('active');

      // 1つ目の.tag__itemに.activeを付与
      var activeTagListArea = $('.tag__list__area').eq(index);
      activeTagListArea.find('.tag__item').removeClass('active');
      activeTagListArea.find('.tag__item').first().addClass('active');

      // .tag__item.activeに対応した.control__category-tag__listにactiveを付与
      var controlListWrap = $('.control__list__wrap').eq(index);
      controlListWrap.find('.control__category-tag__list').removeClass('active');
      controlListWrap.find('.control__category-tag__list').first().addClass('active');
    });
  });

  // タグタブ切り替え(スキン編集画面)
  $(document).ready(function () {
    $('.tag__list__items li .tag__item').on('click', function () {
      $('.tag__list__items li .tag__item').removeClass('active');
      $(this).addClass('active');

      $('.control__category-tag__list').removeClass('active');
      var index = $('.tag__list__items li .tag__item').index(this);
      $('.control__category-tag__list').eq(index).addClass('active');
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



  // マイページのタブ切り替え
  $('.item__button .buttons.cancel').on('click', function () {
    $('.display__character__serif').addClass('none');
  });





});







$(function() {
  // 操作履歴を保存するためのスタック
  var actionStack = [];

  // 操作をスタックにプッシュする関数
  function pushAction(action) {
      actionStack.push(action);
  }

  // 操作を元に戻す関数
  function popAction() {
      return actionStack.pop();
  }

  // input要素の::beforeがある場合の処理
  $('input.category-tag__item--wrap').on('change', function() {
      var paymentType = $(this).closest('li').find('.payment_type').text();
      var thumbnailUrl = $(this).closest('li').find('img').attr('src'); // 画像のURLを取得
      var tag = $(this).data('tag'); // データ属性からタグを取得
      var name = $(this).attr('name');

      // 現在の状態をスタックにプッシュ
      pushAction({
          name: name,
          previousUrl: $('.' + name).attr('src')
      });

      if ($(this).is(':checked') && !$(this).siblings('.nothing-item').hasClass('active')) {
          $('.display__character__serif').removeClass('none');
          $('.item__cost .icon').removeClass('coin point').addClass(paymentType); // 以前のクラスを削除してから追加
          $('.item__cost .TX').text($(this).closest('li').find('.price').text()); // 価格を設定
          $('.item__img').attr('src', thumbnailUrl); // 画像のURLを設定
          $('.character__' + tag).attr('src', thumbnailUrl); // タグに対応する画像のURLを設定
      } else {
          $('.display__character__serif').addClass('none');
          $('.item__cost .icon').removeClass('coin point'); // すべてのクラスを削除
          $('.item__img').attr('src', ''); // 画像のURLをクリア
          $('.character__' + tag).attr('src', ''); // タグに対応する画像のURLをクリア
      }

      // saving__buttonのdisabled属性の制御
      var allActiveChecked = true;
      $('input.category-tag__item--wrap').each(function() {
          if ($(this).is(':checked') && !$(this).siblings('.nothing-item').hasClass('active')) {
              allActiveChecked = false;
          }
      });

      if (allActiveChecked) {
          $('.saving__button').removeAttr('disabled');
      } else {
          $('.saving__button').attr('disabled', 'disabled');
      }
  });

  // クリックでimgを変更（着せ替え）
  $('input.category-tag__item--wrap').on('change', function() {
      var name = $(this).attr('name');
      var thumbnailUrl = $(this).closest('li').find('img').attr('src');

      // 現在の状態をスタックにプッシュ
      pushAction({
          name: name,
          previousUrl: $('.' + name).attr('src')
      });

      // 対応するクラスのimg要素のsrcを変更
      $('.' + name).attr('src', thumbnailUrl);
  });

  // ひとつ戻すボタンのクリックイベント
  $('.sideButton__button').on('click', function() {
      var lastAction = popAction();
      if (lastAction) {
          $('.' + lastAction.name).attr('src', lastAction.previousUrl);
      }
  });

  // 交換するボタンのクリックイベント
  $('.buttons.exchange').on('click', function() {
      var paymentType = $('.item__cost .icon').hasClass('coin') ? 'coin' : 'point';
      var cost = parseInt($('.item__cost .TX').text(), 10);
      var selectedItem = $('input.category-tag__item--wrap:checked').val();

      if (confirm('本当に交換しますか？')) {
          $.ajax({
              url: ajaxurl, // WordPressのAjax URL
              type: 'POST',
              data: {
                  action: 'exchange_item',
                  payment_type: paymentType,
                  cost: cost,
                  user_id: user_id, // 現在のユーザーID
                  selected_item: selectedItem // 選択されたアイテム
              },
              success: function(response) {
                  if (response.success) {
                      alert('交換が成功しました！');
                      location.reload(); // ページをリロードして最新の情報を表示
                  } else {
                      alert('交換に失敗しました: ' + response.data);
                  }
              }
          });
      }
  });
});