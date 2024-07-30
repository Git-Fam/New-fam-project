

$(document).ready(function() {
    const $container = $('.C_InvisalignFlow--container');
    const $content = $('.C_InvisalignFlow--container--inner');
    const $scrollbar = $container.find('.scrollbar');
    const $thumb = $scrollbar.find('.scrollbar-thumb');
  
    const updateThumb = () => {
      const containerWidth = $container.width();
      const contentWidth = $content[0].scrollWidth;
      const thumbWidth = containerWidth * (containerWidth / contentWidth);
      $thumb.width(thumbWidth);
      $thumb.css('transform', 'translateX(0)'); // Reset initial position
    };
  
    updateThumb();
  
    $container.on('scroll', () => {
      const scrollPercent = $container.scrollLeft() / ($content[0].scrollWidth - $container.width());
      const thumbOffset = scrollPercent * ($container.width() - $thumb.width());
      $thumb.css('transform', `translateX(${thumbOffset}px)`);
    });
  
    $(window).on('resize', updateThumb);

  });

  
    //topへ戻る
    $(function() {
        $(window).on('scroll', function() {
          const windowHeight = $(window).height();
          const scrollTop = $(window).scrollTop();
          const $goTop = $('.go-top');
          const targetPosi = $('footer').offset().top;
          const offsetTop = 500; 
      
          if (scrollTop + windowHeight < targetPosi && scrollTop > offsetTop) {
            $goTop.addClass('active');
          } else {
            $goTop.removeClass('active');
          }
        });
      });
    
  

