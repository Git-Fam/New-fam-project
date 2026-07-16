$(function () {
  const $frame = $('.top_sent_ttl .frame');
  if (!$frame.length) return;

  const $tl = $frame.find('.TL');
  if (!$tl.length) return;

  const el = $tl[0];
  const lineHeight = parseFloat(getComputedStyle(el).lineHeight);
  const lines = lineHeight > 0 ? Math.round(el.scrollHeight / lineHeight) : 1;

  if (lines >= 2) {
    $frame.addClass('is-active');
  }
});
