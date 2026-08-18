$(function () {

  $('.C_first_tag').on('click', function () {
    $('.C_first_tag').removeClass('active');
    $(this).addClass('active');
    $('.book--contents').removeClass('active');
    var index = $('.C_first_tag').index(this);
    $('.book--contents').eq(index).addClass('active');
  });

  $('.book--contents--nation__btn .TX').on('click', function () {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    var index = $('.book--contents--nation__btn .TX').index(this);
    $('.book--contents__inner__page').removeClass('active');
    $('.book--contents__inner__page').eq(index).addClass('active');
  });

});
