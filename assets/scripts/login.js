const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");

$("#login").on("click", () => {
	$(".login").toggleClass("slide-up");
	$(".signup").toggleClass("slide-up");
});

$("#signup").on("click", () => {
	$(".login").toggleClass("slide-up");
	$(".signup").toggleClass("slide-up");
});

const openModalButtons = document.querySelectorAll("[data-modal-target]");
const closeModalButtons = document.querySelectorAll("[data-close-button]");
const overlayReset = document.getElementById("overlay-reset");
const overlayResend = document.getElementById("overlay-resend");
const resetBack = document.getElementById("reset-back");
const resendBack = document.getElementById("resend-back");

openModalButtons.forEach(button => {
	button.addEventListener("click", () => {
		const modal = document.querySelector(button.dataset.modalTarget);
		openModal(modal);
	});
});

overlayReset.addEventListener("click", () => {
	const modals = document.querySelectorAll(".modal.active");
	modals.forEach(modal => {
		closeModal(modal);
	});
});

resetBack.addEventListener("click", () => {
	const modals = document.querySelectorAll(".modal.active");
	modals.forEach(modal => {
		closeModal(modal);
	});
});

overlayResend.addEventListener("click", () => {
	const modals = document.querySelectorAll(".modal.active");
	modals.forEach(modal => {
		closeModal(modal);
	});
});

resendBack.addEventListener("click", () => {
	const modals = document.querySelectorAll(".modal.active");
	modals.forEach(modal => {
		closeModal(modal);
	});
});

closeModalButtons.forEach(button => {
	button.addEventListener("click", () => {
		const modal = button.closest(".modal");
		closeModal(modal);
	});
});

function openModal(modal) {
	if (modal == null) return;
	modal.classList.add("active");
	overlayReset.classList.add("active");
}

function closeModal(modal) {
	if (modal == null) return;
	modal.classList.remove("active");
	overlayReset.classList.remove("active");
}

//Explicit recaptcha rendering
var reCaptchaCallback = function() {
	grecaptcha.render("g-recaptcha-signup", {
		sitekey: "6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo",
		theme: "dark"
	});
	grecaptcha.render("g-recaptcha-signin", {
		sitekey: "6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo"
	});
};

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
	}, 3000);
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
	}, 2000);
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}

//AJAX request for signup form
$("#signup-btn").on("click", function(event) {
	event.preventDefault();
	// Validate signup form details here
	let name = $("#signup-name")
		.val()
		.split(" ");
	if (name.length != 2) {
		showError("Please enter your first name and last name.");
		$("#signup-name").focus();
		return false;
	}
	let fname = name[0];
	let lname = name[1];

	let email = $("#signup-email").val();
	if (!validateEmail(email)) {
		showError("The email provided is invalid");
		return false;
	}

	let password = $("#signup-password").val();
	if (password.length < 5 || password.length > 15) {
		showError("Password must be 5 to 15 characters long.");
		$("#signup-password").focus();
		return false;
	}

	let cpassword = $("#signup-cpassword").val();
	if (password != cpassword) {
		showError("Password and confirm password do not match.");
		$("#signup-cpassword").focus();
		return false;
	}

	if (grecaptcha === undefined) {
		showError("reCAPTCHA error. Please refresh the page and try again.");
		return false;
	}
	let token = grecaptcha.getResponse(0);
	if (!token) {
		showError("Complete the reCAPTCHA and try again.");
		return false;
	}

	//AJAX request for signup form
	$.ajax({
		url: "bin/user/signup",
		method: "POST",
		dataType: "json",
		contentType: "application/json",
		data: JSON.stringify({
			fname: fname,
			lname: lname,
			email: email,
			password: password,
			cpassword: cpassword,
			"g-recaptcha-response": token
		}),
		beforeSend: function() {
			//Show loader before sending ajax request
			//$(".block-form").show();
			//$(".lds-grid").css("display", "inline-block");
		},
		success: function(response) {
			//Hide loader after receiving request
			//$(".lds-grid").hide();
			if (response == "EMPTY_FIELDS") {
				//User has left atleast one field empty
				console.log("Fill all fields");
			} else if (response == "INVALID_EMAIL_FORMAT") {
				//User has provided invalid email
				console.log("Check your email format");
			} else if (response == "PASSWORDS_DO_NOT_MATCH") {
				//Password and confirm password do not match
				console.log("Passwords do not match");
			} else if (response == "PASSWORD_EMPTY") {
				//User has not provided password
				console.log("Password cannot be empty");
			} else if (response == "SIGNUP_SUCCESS") {
				//Allow user to login now
				console.log("Signup successful");
			} else if (response == "USER_ALREADY_EXIST") {
				//User is already registered
				console.log("User already exist");
			} else if (response == "RECAPTCHA_FAILED") {
				//Recaptcha verification has failed
				console.log("Recaptcha failed");
			} else if (response == "FORM_NOT_SUBMITTED") {
				//User has not submitted the form
				console.log("Form not submitted");
			} else {
				//Server error
				console.log("Server error");
			}
			//Reset recaptcha
			grecaptcha.reset();
			$("#signup-name").val("");
			$("#signup-email").val("");
			$("#signup-password").val("");
			$("#signup-cpassword").val("");
			// $(".block-form").fadeOut();
			grecaptcha.reset(0);
		},
		error: function(request, error) {
			showError("Server error. Try again later.");
			grecaptcha.reset(0);
		}
	});
});

$("#signin-btn").on("click", function(event) {
	event.preventDefault();
	let email = $("#login-email").val();
	if (!validateEmail(email)) {
		if (!email) showError("Please enter an email");
		else showError("The email provided is invalid");
		$("#login-email").focus();
		return false;
	}

	let password = $("#login-password").val();
	if (!password) {
		showError("Please enter a password");
		$("#login-password").focus();
		return false;
	}

	if (grecaptcha === undefined) {
		showError("reCAPTCHA error. Please refresh the page and try again.");
		return false;
	}
	let token = grecaptcha.getResponse(1);
	if (!token) {
		showError("Complete the reCAPTCHA and try again.");
		return false;
	}

	//AJAX request for signin form
	$.ajax({
		url: "bin/user/signin",
		method: "POST",
		dataType: "json",
		contentType: "application/json",
		data: JSON.stringify({
			email: email,
			password: password,
			"g-recaptcha-response": token
		}),
		beforeSend: function() {
			//Show loader before sending ajax request
			// $(".block-form").show();
			// $(".lds-grid").css("display", "inline-block");
		},
		success: function(response) {
			// console.log(response);
			//Hide loader after receiving request
			// $(".lds-grid").hide();
			if (response.code == "SIGNIN_SUCCESS") {
				//User credentials has been successfully validated
				let patt = new RegExp("https://shankhnaad.org/events/*");
				// Redirect to the referer or to the dashboard
				if (patt.test(referer)) window.location.href = referer;
				else window.location.href = "https://shankhnaad.org/dashboard";
			} else if (response.code == "SIGNIN_FAILED") {
				//User has provided invalid credentials or is not registered
				console.log("Invalid credentials");
			} else if (response.code == "EMAIL_NOT_VERIFIED") {
				//User has not verified his email
				console.log("Verify your email");
			} else if (response.code == "RECAPTCHA_FAILED") {
				//Recaptcha verification has failed
				console.log("Recaptcha failed");
			} else if (response.code == "FORM_NOT_SUBMITTED") {
				//User has not submitted the form
				console.log("Form not submitted");
			} else {
				//Server error
				console.log("Server error");
			}
			//Reset recaptcha
			grecaptcha.reset(1);
			$("#login-email").val("");
			$("#login-password").val("");
			// $(".block-form").fadeOut();
		},
		error: function(request, error) {
			showError("Server error. Try again later.");
			grecaptcha.reset(1);
		}
	});
});
