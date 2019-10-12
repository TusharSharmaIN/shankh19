function navSlide(){
    $('.nav-ul-a').bind('click', function(){
        $('.nav-ul').toggleClass('active');
        $('.nav-ul-a').toggleClass('active');
        $('.burger').toggleClass('toggle');
    });
    $('.burger').bind('click', function(){
        $('.nav-ul').toggleClass('active');
        $('.nav-ul-a').toggleClass('active');
        $('.burger').toggleClass('toggle');
    });
  };
  
navSlide();

function next(){
    $('.cardPersonal').on('click', function(){
        $('.cardPersonal').toggleClass('notactive');
        $('.cardCollege').toggleClass('active');
    });
}