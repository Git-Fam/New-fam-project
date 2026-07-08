$(function () {

  // ===== カリキュラム アコーディオン =====
  $(document).on('click', '.accordion-body-ttl', function () {
    $(this)
      .closest('.high-course-stage-curriculum-wrap')
      .toggleClass('is-active');
  });

});