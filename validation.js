document.getElementById("submit").addEventListener('click', validate);
var result = document.getElementsByClassName("result");

function validate(){
	var new_pswd = document.getElementById("new").value;
	var cnfrm_pswd = document.getElementById("confirm").value;

	if (new_pswd == '' ) {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>New password cannot be empty!</p>";
	}

	else if (cnfrm_pswd == '') {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>Confirm password cannot be empty!</p>";
	}

	else if (new_pswd.length < 5) {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>password too short!!</p>";
	}

	else if (new_pswd.length > 15) {
		result[0].style.visibility = 'visible';
		result[0].innerHTML = "<p>password too long!!</p>";
	}

	else {
		if (new_pswd != cnfrm_pswd) {
			result[0].style.visibility = 'visible';
			result[0].innerHTML = "<p>Passwords does not match!</p>";
		}

		else {
			result[0].style.visibility = 'visible';
			result[0].style.backgroundColor = "#b2dbb2";
			result[0].style.borderColor = "green";
			result[0].style.color = "darkgreen";
			result[0].innerHTML = "<p>Passwords changed successfully. Click here to login!</p>";
		}
	}
}