$(function () {
  const $body = $('body');
  const video = document.getElementById('video');

  function openVideo($section) {
    $section.addClass('is-active');
    $body.addClass('is-active');

    if (!video) return;

    const playPromise = video.play();
    if (playPromise && typeof playPromise.catch === 'function') {
      playPromise.catch(() => { });
    }
  }

  function closeVideo($section) {
    $section.removeClass('is-active');
    $body.removeClass('is-active');

    if (!video) return;
    video.pause();
    try {
      video.currentTime = 0;
    } catch (_) { }
  }

  $('#video_open').on('click', function (e) {
    e.preventDefault();
    const $section = $(this).closest('.company_type_video');
    openVideo($section.length ? $section : $('.company_type_video'));
  });

  $('.video_close').on('click', function (e) {
    e.preventDefault();
    const $section = $(this).closest('.company_type_video');
    closeVideo($section.length ? $section : $('.company_type_video'));
  });
});
