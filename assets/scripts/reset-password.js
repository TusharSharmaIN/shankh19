function showError(msg) {
	$(".alert")
		.addClass("error-alert")
		.text(msg)
		.animate(
			{
				top: "60px",
				opacity: 1
			},
			500
		);

	setTimeout(function() {
		$(".alert").animate(
			{
				top: "0px",
				opacity: 0
			},
			500,
			function() {
				$(".alert").removeClass("error-alert");
			}
		);
	}, 5000);
}

function showSuccess(msg) {
	$(".alert")
		.addClass("success-alert")
		.text(msg)
		.animate(
			{
				top: "60px",
				opacity: 1
			},
			500
		);

	setTimeout(function() {
		$(".alert").animate(
			{
				top: "0px",
				opacity: 0
			},
			500,
			function() {
				$(".alert").removeClass("success-alert");
			}
		);
	}, 5000);
}

function validate() {
	var new_pswd = $("#password").val();
	var cnfrm_pswd = $("#cpassword").val();

	if (new_pswd == "") {
		showError("New password cannot be empty!");
	} else if (cnfrm_pswd == "") {
		showError("Confirm password cannot be empty!");
	} else if (new_pswd.length < 5 || new_pswd.length > 15) {
		showError("Password must be between 5 to 15 characters long!");
	} else {
		if (new_pswd != cnfrm_pswd) {
			showError("Passwords does not match!");
		} else {
			return true;
		}
	}
	return false;
}

$(".submit-btn").on("click", function(e) {
	e.preventDefault();
	if (validate()) {
		var password = $("#password").val();
		var cpassword = $("#cpassword").val();
		$.ajax({
			url: "/bin/user/process-password-reset",
			method: "POST",
			dataType: "text",
			data: {
				email: email, // Defined in reset-password.php
				key: key, // Defined in reset-password.php
				password: password,
				cpassword: cpassword
			},
			beforeSend: function() {
				//Show loader before sending ajax request
				$(".block-form").show();
				$(".lds-grid").css("display", "inline-block");
			},
			success: function(response) {
				//Hide loader after receiving request
				$(".lds-grid").hide();
				$(".block-form").fadeOut();
				//Empty passwords after form submission
				$("#password").val("");
				$("#cpassword").val("");
				if (response == "PASSWORD_CHANGED") {
					setTimeout(() => {
						showSuccess(
							"Passwords changed successfully. Redirecting to login page..."
						);
					}, 1000);
				} else if (response == "EMPTY_FIELDS") {
					showError("Passwords cannot be empty!");
				} else if (response == "PASSWORDS_DO_NOT_MATCH") {
					showError("Passwords do not match!");
				} else if (response == "INVALID_PASSWORD_SIZE") {
					showError(
						"Password must be between 5 to 15 characters long!"
					);
				} else {
					//Server error
					showError(
						"Oops. Something went wrong. Please try again later.!"
					);
				}
			}
		});
	}
});
