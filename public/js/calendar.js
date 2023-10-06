$(function () {
  $('.cancel-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var delete_day = $(this).attr('delete_day');
    var delete_reserve = $(this).attr('delete_reserve');
    var delete_text = $(this).val();
    // bladeのクラス名に値を渡している
    $('.modal-inner-day').text(delete_day);
    $('.modal-inner-reserve').text(delete_text);
    $('.delete_day').val(delete_day);
    $('.delete_part').val(delete_reserve);
    return false;
  });
});
