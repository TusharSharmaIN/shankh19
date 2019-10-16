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
        $('.switch1').toggleClass('switch3');
        $('.switch2').toggleClass('switch4');
    });
}

function personalForm(){
    $('.switch1').on('click',function(){
        $('.switch1').removeClass('switch3')
        $('.switch2').removeClass('switch4')
        $('.cardPersonal').removeClass('notactive');
        $('.cardCollege').removeClass('active');
    });
}

function collegeForm(){
    $('.switch2').on('click',function(){
        $('.switch1').toggelClass('switch3')
        $('.switch2').toggelClass('switch4')
        $('.cardPersonal').toggelClass('notactive');
        $('.cardCollege').toggelClass('active');
    });
}