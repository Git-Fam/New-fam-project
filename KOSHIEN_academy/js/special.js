$(function () {

  // カテゴリーわけ
  var $itemWrap = $(".page-special .item--wrap");
  var $allItems = $(".page-special .item--wrap .item");

  // リロードごとに表示順をランダムにする
  (function shuffleItems() {
    function shuffleArray(arr) {
      var a = arr.slice();
      for (var i = a.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var t = a[i];
        a[i] = a[j];
        a[j] = t;
      }
      return a;
    }
    var items = $allItems.get();
    if (items.length === 0) return;
    var shuffled = shuffleArray(items);
    $itemWrap.empty();
    $(shuffled).appendTo($itemWrap);
  })();

  $allItems = $(".page-special .item--wrap .item");

  $(".page-special .tabs .tab").on("click", function () {
    $(".page-special .tabs .tab").removeClass("is-active");
    $(this).addClass("is-active");

    var selectedTab = $(this).data("tab");

    // 現在表示されているitemをすべて削除
    $itemWrap.empty();

    if (selectedTab === "all") {
      // "all"の場合はすべてのitemを表示
      $allItems.appendTo($itemWrap);
    } else {
      // 選択されたタブに対応するitemだけを表示
      $allItems.each(function () {
        if ($(this).data("tab") === selectedTab) {
          $(this).appendTo($itemWrap);
        }
      });
    }
  });



  // ポップアップ
  // オープン（イベント委譲を使用）
  $(document).on("click", ".page-special .handle", function () {
    $(this).closest(".item").addClass("is-pop");
    $("body").addClass("is-pop");
  });

  // クローズ（イベント委譲を使用）
  $(document).on("click", ".page-special .pop_up .close-btn", function () {
    $(this).closest(".item").removeClass("is-pop");
    $("body").removeClass("is-pop");
  });

  // NEXTボタン（イベント委譲を使用）
  $(document).on("click", ".page-special .pop_up .next-btn", function () {
    var $currentItem = $(this).closest(".item");
    var $allItems = $(".page-special .item--wrap .item");
    var currentIndex = $allItems.index($currentItem);
    var nextIndex;

    // 最後のitemの場合は最初にループ
    if (currentIndex === $allItems.length - 1) {
      nextIndex = 0;
    } else {
      nextIndex = currentIndex + 1;
    }

    // 現在のitemからis-popを削除
    $currentItem.removeClass("is-pop");
    // 次のitemにis-popを付与
    $allItems.eq(nextIndex).addClass("is-pop");
  });

  // PREVボタン（イベント委譲を使用）
  $(document).on("click", ".page-special .pop_up .prev-btn", function () {
    var $currentItem = $(this).closest(".item");
    var $allItems = $(".page-special .item--wrap .item");
    var currentIndex = $allItems.index($currentItem);
    var prevIndex;

    // 最初のitemの場合は最後にループ
    if (currentIndex === 0) {
      prevIndex = $allItems.length - 1;
    } else {
      prevIndex = currentIndex - 1;
    }

    // 現在のitemからis-popを削除
    $currentItem.removeClass("is-pop");
    // 前のitemにis-popを付与
    $allItems.eq(prevIndex).addClass("is-pop");
  });

  // 改行なしSPのみ
if ($(window).width() < 768) {
    $('.handle .TL').each(function() {
        $(this).html($(this).html().replace(/<br\s*\/?>/gi, '').replace(/\n/g, '').trim());
    });
}
});
