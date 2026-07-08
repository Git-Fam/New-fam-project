$(function () {
  // ===== NEWS スライダー（SPのみ / slick） =====
  var $news = $('.p-news__list');
  if ($news.length) {
    $news.slick({
      mobileFirst: true,
      slidesToShow: 1,
      variableWidth: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 3000,
      speed: 600,
      arrows: false,
      dots: true,
      appendDots: $('.p-news__pagination'),
      customPaging: function () {
        return '<button type="button" class="p-news-dot"></button>';
      },
      responsive: [
        {
          // 768px以上（PC）はスライダーを解除してグリッド表示に戻す
          breakpoint: 768,
          settings: 'unslick',
        },
      ],
    });
  }
});
