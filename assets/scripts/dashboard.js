// Function to check if a date is valid or not
function isDate(txtDate){
    var currVal = txtDate;
    if(currVal == '')
        return false;

    //Declare Regex 
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;
    //Checks for mm/dd/yyyy format.
    dtDay = dtArray[1];
    dtMonth= dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay> 31)
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
        return false;
    else if (dtMonth == 2){
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap))
            return false;
    }
    return true;
}

function validatePersonalDetails(){
    //First of all validate inputs on personal form
    var filter = /[1-9]{1}[0-9]{9}/;
    //Validate phone number
    if(!filter.test($('input[name="phoneNumber"]').val())){
        $('input[name="phoneNumber"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="phoneNumber"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate alternate phone number
    if(!filter.test($('input[name="alternateNumber"]').val())){
        $('input[name="alternateNumber"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="alternateNumber"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate date
    if(!isDate($('input[name="dateofbirth"]').val())){
        $('input[name="dateofbirth"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="dateofbirth"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate gender
    var gender = $('input[name="gender"]').val().toLowerCase();
    if(!(gender == "male" || gender == "female" || gender == "other")){
        $('input[name="gender"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="gender"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate address
    if($('textarea[name="address"]').val() == ""){
        $('textarea[name="address"]').addClass('input-error').focus();
        setTimeout(function(){ $('textarea[name="address"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Everything is valid
    return true;
}

function validateCollegeDetails(){
    //Validate college name
    if($('input[name="collegeName"]').val() == ''){
        $('input[name="collegeName"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="collegeName"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate year of study
    var year = $('input[name="yearOfStudy"]').val().toLowerCase();
    if(!(year == 'first year' || year == 'second year' || year == 'third year' || year == 'fourth year')){
        $('input[name="yearOfStudy"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="yearOfStudy"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate branch
    if($('input[name="branch"]').val() == ''){
        $('input[name="branch"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="branch"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Validate college city
    if($('input[name="collegeCity"]').val() == ''){
        $('input[name="collegeCity"]').addClass('input-error').focus();
        setTimeout(function(){ $('input[name="collegeCity"]').removeClass('input-error'); }, 2000);
        return false;
    }
    //Everything is valid
    return true;
}

// Add event listener to next button in personal details form
$('#next-btn').on('click', function(){
    // If validation fails
    if(!validatePersonalDetails())
        return;
    $('#card-personal').hide();
    $('#card-college').show();
    $('#switch-personal').removeClass('switch-btn-active');
    $('#switch-college').addClass('switch-btn-active');
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-college').on('click',function(){
    // If validation fails
    if(!validatePersonalDetails())
        return;
    $('#switch-personal').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');    
    $('#card-personal').hide();
    $('#card-college').show();
});

// Add event listener to switch button to switch between personal and college details form
$('#switch-personal').on('click',function(){
    $('#switch-college').removeClass('switch-btn-active');
    $(this).addClass('switch-btn-active');
    $('#card-college').hide();
    $('#card-personal').show();
});

// Using jQuery datepicker API for Date of Birth field
$(function(){
    $(".datepicker").datepicker({dateFormat: 'dd/mm/yy', yearRange: "1950:2019", changeYear: true, changeMonth: true, minDate: new Date(1950, 0, 1)});
});