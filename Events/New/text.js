// Add event listener for nav menu
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