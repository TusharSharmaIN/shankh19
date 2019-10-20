$('.nav-ul-a').on('click', function(){
    $('.nav-ul').toggleClass('active');
    $('.nav-ul-a').toggleClass('active');
    $('.burger').toggleClass('toggle');
});
$('.burger').on('click', function(){
    $('.nav-ul').toggleClass('active');
    $('.nav-ul-a').toggleClass('active');
    $('.burger').toggleClass('toggle');
});

$('#personalDetail').on('click', function(){
    $(this).addClass('active');
    $('#collegeDetail').removeClass('active');
    $('#eventRegister').removeClass('active');
    $('#changePassword').removeClass('active');
    $('#personal-details').show();
    $('#college-details').hide();
    $('#events-register').hide();
    $('#change-password').hide();
});

$('#collegeDetail').on('click', function(){
    $(this).addClass('active');
    $('#eventRegister').removeClass('active');
    $('#changePassword').removeClass('active');
    $('#personalDetail').removeClass('active');
    $('#personal-details').hide();
    $('#college-details').show();
    $('#events-register').hide();
    $('#change-password').hide();
});

$('#eventRegister').on('click', function(){
    $(this).addClass('active');
    $('#collegeDetails').removeClass('active');
    $('#changePassword').removeClass('active');
    $('#personalDetail').removeClass('active');
    $('#personal-details').hide();
    $('#college-details').hide();
    $('#events-register').show();
    $('#change-password').hide();
});

$('#changePassword').on('click', function(){
    $(this).addClass('active');
    $('#collegeDetails').removeClass('active');
    $('#eventRegister').removeClass('active');
    $('#personalDetail').removeClass('active');
    $('#personal-details').hide();
    $('#college-details').hide();
    $('#events-register').hide();
    $('#change-password').show();
});