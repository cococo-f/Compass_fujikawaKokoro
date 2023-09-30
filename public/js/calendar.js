$(function () {
  $('.cancel-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var delete_day = $(this).attr('delete_day');
    var delete_reserve = $(this).attr('delete_reserve');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-day').text(delete_day);
    $('.modal-inner-reserve').text(delete_reserve);
    $('.edit-modal-hidden').val(delete_id);
    return false;
  });
});
