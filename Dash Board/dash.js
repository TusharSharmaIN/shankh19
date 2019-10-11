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

function display(){
    $('.cardPersonal').bind('click', function(){
        $('.cardPersonal').toggleClass('notactive');
        $('.cardCollege').toggleClass('active');
    });
}