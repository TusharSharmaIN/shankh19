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

resetBack.addEventListener("click", e => {
    e.preventDefault();
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

resendBack.addEventListener("click", e => {
    e.preventDefault();
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
        showError("The email provided is not a valid email");
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
            $("#signup-btn")
                .html(
                    '<div id="signup-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "none");
            $("#signup-btn-loader").fadeIn();
            $("#signup-name").val("");
            $("#signup-email").val("");
            $("#signup-password").val("");
            $("#signup-cpassword").val("");
        },
        success: function(response) {
            //Hide loader after receiving request
            $("#signup-btn-loader").fadeOut();
            $("#signup-btn")
                .html(
                    'Sign up<div id="signup-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "auto");

            $("#signup-name").val("");
            $("#signup-email").val("");
            $("#signup-password").val("");
            $("#signup-cpassword").val("");
            grecaptcha.reset(0);
            if (response.code == "EMPTY_FIELDS") {
                //User has left at least one field empty
                showError("Fill all input fields.");
            } else if (response.code == "INVALID_EMAIL_FORMAT") {
                //User has provided invalid email
                showError("Check your email format.");
            } else if (response.code == "PASSWORDS_DO_NOT_MATCH") {
                //Password and confirm password do not match
                showError("Passwords do not match.");
            } else if (response.code == "PASSWORD_EMPTY") {
                //User has not provided password
                showError("Password cannot be empty.");
            } else if (response.code == "SIGNUP_SUCCESS") {
                //Allow user to login now
                showSuccess(
                    "Verify your email before logging in. Check your mail for the verification link."
                );
            } else if (response.code == "USER_ALREADY_EXIST") {
                //User is already registered
                showError(
                    "This email is already registered with us. Please log in."
                );
            } else if (response.code == "RECAPTCHA_FAILED") {
                //Recaptcha verification has failed
                showError("reCAPTCHA failed. Try again.");
            } else if (response.code == "FORM_NOT_SUBMITTED") {
                //User has not submitted the form
                showError("Server error. Try again later.");
            } else {
                //Server error
                showError("Server error. Try again later.");
            }
        },
        error: function(request, error) {
            showError("Server error. Try again later.");
            //Hide loader after receiving request
            $("#signup-btn-loader").fadeOut();
            $("#signup-btn")
                .html(
                    'Sign up<div id="signup-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "auto");
            grecaptcha.reset(0);
        }
    });
});

var resendEmailVerificationTo = null;

$("#signin-btn").on("click", function(event) {
    event.preventDefault();
    let email = $("#login-email").val();
    if (!validateEmail(email)) {
        if (!email) showError("Please enter an email");
        else showError("The email provided is not a valid email");
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
            $("#signin-btn")
                .html(
                    '<div id="signin-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "none");
            $("#signin-btn-loader").fadeIn();
            $("#login-email").val("");
            $("#login-password").val("");
        },
        success: function(response) {
            //Hide loader after receiving request
            $("#signin-btn-loader").fadeOut();
            $("#signin-btn")
                .html(
                    'Log in<div id="signin-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "auto");

            $("#login-email").val("");
            $("#login-password").val("");
            grecaptcha.reset(1);
            if (response.code == "SIGNIN_SUCCESS") {
                //User credentials has been successfully validated
                let pattern = new RegExp("https://shankhnaad.org/events/*");
                // Redirect to the referer or to the dashboard
                if (pattern.test(referer)) window.location.href = referer;
                else window.location.href = "https://shankhnaad.org/dashboard";
            } else if (response.code == "SIGNIN_FAILED") {
                //User has provided invalid credentials or is not registered
                showError("Invalid email or password.");
            } else if (response.code == "EMAIL_NOT_VERIFIED") {
                //User has not verified his email
                let resendModal = document.getElementById("resend-modal");
                openModal(resendModal);
                resendEmailVerificationTo = email;
            } else if (response.code == "RECAPTCHA_FAILED") {
                //Recaptcha verification has failed
                showError("reCAPTCHA failed.");
            } else if (response.code == "FORM_NOT_SUBMITTED") {
                //User has not submitted the form
                showError("Server error. Try again later.");
            } else {
                //Server error
                showError("Server error. Try again later.");
            }
        },
        error: function(request, error) {
            showError("Server error. Try again later.");
            //Hide loader after receiving request
            $("#signin-btn-loader").fadeOut();
            //Show loader before sending ajax request
            $("#signin-btn")
                .html(
                    'Log in<div id="signin-btn-loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
                )
                .css("pointer-events", "auto");
            grecaptcha.reset(1);
        }
    });
});

$("#resend-email-btn").on("click", event => {
    event.preventDefault();
    let email = resendEmailVerificationTo;
    if (!validateEmail(email)) {
        if (!email) showError("Please enter an email");
        else showError("The email provided is not a valid email");
        return false;
    }
    // AJAX request to resend verification email
    $.ajax({
        url: "/bin/user/verify-email",
        method: "GET",
        dataType: "json",
        data: {
            email: email
        },
        success: function(response) {
            if (response.code == "EMAIL_SENT") {
                showSuccess("Verification email sent. Check your inbox.");
            } else {
                showError("Server error. Try again later.");
            }
            resendEmailVerificationTo = null;
            let resendModal = document.getElementById("resend-modal");
            closeModal(resendModal);
        }
    });
});

$("#password-reset-btn").on("click", event => {
    event.preventDefault();
    let email = $("#password-reset-email").val();
    if (!validateEmail(email)) {
        if (!email) showError("Please enter an email");
        else showError("The email provided is not a valid email");
        return false;
    }
    // AJAX request to send password reset email
    $.ajax({
        url: "/bin/user/forgot-password",
        method: "GET",
        dataType: "json",
        data: {
            email: email
        },
        beforeSend: function() {
            $("#password-reset-email").val("");
        },
        success: function(response) {
            if (response.code == "EMAIL_SENT") {
                showSuccess(
                    "Password reset email has been sent. Check your inbox."
                );
            } else if (response.code == "EMAIL_DOES_NOT_EXIST") {
                showError(
                    "This email is not registered with us. Please sign up."
                );
            } else if (response.code == "EMAIL_NOT_VERIFIED") {
                showError(
                    "This email is not verified. Please login to get verification link."
                );
            } else if (response.code == "INVALID_EMAIL_FORMAT") {
                showError("The email provided is not a valid email");
            } else {
                showError("Server error. Try again later.");
            }
            resendEmailVerificationTo = null;
            let resendModal = document.getElementById("resend-modal");
            closeModal(resendModal);
        }
    });
});
