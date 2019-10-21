// Add event listener to next button in personal details form
$('#card-personal button').on('click', function(){
    $('#card-personal').hide();
    $('#card-college').show();
    $('#switch-personal').removeClass('switch-btn-active');
    $('#switch-college').addClass('switch-btn-active');
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-personal').on('click',function(){
    $('#switch-college').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');
    $('#card-college').hide();
    $('#card-personal').show();
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-college').on('click',function(){
    $('#switch-personal').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');    
    $('#card-personal').hide();
    $('#card-college').show();
});

// Using jQuery datepicker API for Date of Birth field
$(function(){
    $(".datepicker").datepicker({dateFormat: 'dd-mm-yy', changeYear: true, changeMonth: true, defaultDate: new Date(2000, 0, 1)});
});