$(function () {
  // ===== LOVE CHANGE スライダー（slick） =====
  var $slider = $('.high-change-contents');
  if ($slider.length) {
    $slider.slick({
      centerMode: true,
      centerPadding: '0',
      variableWidth: true,
      slidesToShow: 1,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 3000,
      speed: 600,
      arrows: false,
      dots: true,
      appendDots: $('.high-change-pagination'),
      customPaging: function () {
        return '<button type="button" class="high-change-dot"></button>';
      },
      pauseOnHover: true,
    });
  }

  // ===== NEWS スライダー（SPのみ / slick） =====
  var $news = $('.news-list-iner');
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
      customPaging: function () {
        return '<button type="button" class="news-dot"></button>';
      },
      responsive: [
        {
          // 768px以上（PC）はスライダーを解除して通常表示に戻す
          breakpoint: 768,
          settings: 'unslick',
        },
      ],
    });
  }

});