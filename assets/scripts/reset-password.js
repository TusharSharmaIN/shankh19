function validate(){
	var new_pswd = $("#password").val();
	var cnfrm_pswd = $("#cpassword").val();
	var result = $(".result");

	if (new_pswd == '' ) {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>New password cannot be empty!</p>";
	}
	else if (cnfrm_pswd == '') {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>Confirm password cannot be empty!</p>";
	}
	else if (new_pswd.length < 5 || new_pswd.length > 15) {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>Password must be between 5 to 15 characters long!</p>";
	}
	else {
		if (new_pswd != cnfrm_pswd) {
			result[0].style.visibility = 'visible';
			result[0].innerHTML = "<p>Passwords does not match!</p>";
		}
		else {
			return true;
		}
	}
	return false;
}