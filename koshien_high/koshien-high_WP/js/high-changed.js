$(function () {
  // ===== LOVE CHANGE スライダー（slick） =====
  var $slider = $('.high-changed-contents');
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
      appendDots: $('.high-changed-pagination'),
      customPaging: function () {
        return '<button type="button" class="high-changed-dot"></button>';
      },
      pauseOnHover: true,
    });
  }


});