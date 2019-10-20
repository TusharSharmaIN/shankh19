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
    $('#personal-details').show();
    $('#college-details').hide();
});

$('#collegeDetail').on('click', function(){
    $(this).addClass('active');
    $('#personalDetail').removeClass('active');
    $('#personal-details').hide();
    $('#college-details').show();
});