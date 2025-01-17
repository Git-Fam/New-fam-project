$(function () {

  $('.C_first_tag').on('click', function () {
    $('.C_first_tag').removeClass('active');
    $(this).addClass('active');
    $('.book--contents').removeClass('active');
    var index = $('.C_first_tag').index(this);
    $('.book--contents').eq(index).addClass('active');
  });

});