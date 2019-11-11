// popup click function
$('.popup-button').click(function(event) {
    $('.popup').fadeIn(800);
  });
  // popup close function
  $('.close_button').click(function(event) {
    $('.popup').fadeOut(800);
  });
  // popup 'esc' key to close
  $(document).on('keydown', function(e) {
    if (e.keyCode === 27) { // ESC
      $('.popup').hide();
    }
  });