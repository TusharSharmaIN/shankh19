// Add event listener to next button in personal details form
$('.cardPersonal .button').on('click', function(){
    $('.cardPersonal').hide();
    $('.cardCollege').show();
    $('#switch-personal').removeClass('switch-btn-active');
    $('#switch-college').addClass('switch-btn-active');
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-personal').on('click',function(){
    $('#switch-college').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');
    $('.cardCollege').hide();
    $('.cardPersonal').show();
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-college').on('click',function(){
    $('#switch-personal').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');    
    $('.cardPersonal').hide();
    $('.cardCollege').show();
});

// Using jQuery datepicker API for Date of Birth field
$(function(){
    $(".datepicker").datepicker({dateFormat: 'dd-mm-yy', changeYear: true, changeMonth: true, defaultDate: new Date(2000, 0, 1)});
});