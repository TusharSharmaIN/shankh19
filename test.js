$(window).scroll(function() {
  
  // selectors
  var $window = $(window),
      $body = $('body'),
      $panel = $('.panel');
  
  // Change 33% earlier than scroll position so colour is there when you arrive.
  var scroll = $window.scrollTop() + ($window.height() / 10);
 
  $panel.each(function () {
    var $this = $(this);
    
    // if position is within range of this panel.
    // So position of (position of top of div <= scroll position) && (position of bottom of div > scroll position).
    // Remember we set the scroll to 33% earlier in scroll var.
    if ($this.position().top <= scroll && $this.position().top + $this.height() > scroll) {
          
      // Remove all classes on body with color-
      $body.removeClass(function (index, css) {
        return (css.match (/(^|\s)color-\S+/g) || []).join(' ');
      });
       
      // Add class of currently active div
      $body.addClass('color-' + $(this).data('color'));
    }
  });    
  
}).scroll();

$(document).click(function(e) {
	if (!$(e.target).is('.burger') || !$(e.target).is('.nav-ul')) {
      if(true){
        $('.nav-ul').toggleClass('active');
        $('.nav-ul-a').toggleClass('active');
        $('.burger').toggleClass('toggle');
      }
    }
});


var slideIndex = 0;
showSlides();

function showSlides()
{
  var i;
  const slides = document.getElementsByClassName("slider-images");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;

  if (slideIndex > slides.length)
  {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";
  
  setTimeout(showSlides, 2000);
}