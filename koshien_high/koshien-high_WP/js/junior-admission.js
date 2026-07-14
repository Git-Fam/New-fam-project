$(function () {

  // ===== 奨学金制度 タブ PC =====
  $(document).on('click', '.scholarship-tab', function () {
    var $item = $(this).closest('.scholarship-item');
    $item.siblings('.scholarship-item').removeClass('is-active');
    $item.addClass('is-active');
  });

  // ===== 奨学金制度 タブ SP =====
  $(document).on('click', '.scholarship-tab', function () {
    var $item = $(this).closest('.scholarship-item');
    $item.toggleClass('is-active-sp');
  });

  // ===== 奨学金制度 サイドナビ（奨学金セクション内のタブを開く） =====
  $(document).on('click', '.aside-nav-list-item-link-sub[href="#scholarship"]', function () {
    var index = $(this).closest('.aside-nav-list-item-sub').index();
    var $items = $('.high-admission-scholarship-inr .scholarship-item');
    $items.removeClass('is-active');
    $items.eq(index).addClass('is-active');
  });

  // ===== Q&A アコーディオン =====
  $(document).on('click', '.item-q', function () {
    var $item = $(this).closest('.faq-item');
    $item.toggleClass('is-active');
  });
});
