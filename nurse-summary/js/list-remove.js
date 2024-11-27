$(function () {
  // タブ切り替え
  $(".C_ranking-tab .tab .tab--item").on("click", function () {
    let $parentTab = $(this).closest('.C_ranking-tab');
    let index = $parentTab.find(".tab--item").index(this);

    $parentTab.find(".tab--item").removeClass("active");
    $(this).addClass("active");

    $parentTab.find(".contents--item").removeClass("active");
    $parentTab.find(".contents--item").eq(index).addClass("active");
  });

  // 全ての口コミを表示
  $(".C_ranking-review .more").on("click", function () {
    let $parentReview = $(this).closest('.C_ranking-review');

    $parentReview.find(".reviews--lists").toggleClass("active");
    $(this).toggleClass("active");
    if ($(this).hasClass("active")) {
      $(this).text("閉じる");
    } else {
      $(this).text("すべての口コミを見る");
    }
  });


});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.C_ranking-contents .list').forEach(function (listItem) {
    if (!listItem.textContent.trim()) {
      listItem.remove();
    }
  });
});