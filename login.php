<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    // Session is set i.e., user is already signed in
    header('Location: dashboard.php'); //Redirect to dashboard
    exit();
}
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page | Beta</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="login-wrap">
        <div class='block-form'></div>
        <div class="lds-grid">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

            <div class="login-form">
                <form class="sign-in-htm" method="POST" action="bin/user/signin">
                    <div class="group">
                        <label for="user" class="label">Email</label>
                        <input id="email-signin" name="email" type="text" class="form-input" autocomplete="email" required>
                    </div>

                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="password-signin" name="password" class="form-input" type="password" autocomplete="current-password" required>
                    </div>

                    <div class="group">
                        <input id="check" type="checkbox" class="check" unchecked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>

                    <div class="group" style="text-align: center">
                        <div class="g-recaptcha" id="g-recaptcha-signin" style="display: inline-block" data-sitekey="6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo"></div>
                    </div>

                    <div class="group">
                        <input type="button" id="signin-btn" name="signin" class="button" value="Sign In">
                    </div>

                    <div class="foot-lnk">
                        <a href="bin/user/forgot-password.php">Forgot Password?</a>
                    </div>
                </form>

                <form class="sign-up-htm" method="POST" action="bin/user/signup">
                    <div class="group">
                        <label for="name" class="label">First name</label>
                        <input id="fname-signup" name="fname" type="text" class="form-input" autocomplete="given-name" required>
                    </div>
                    <div class="group">
                        <label for="name" class="label">Last name</label>
                        <input id="lname-signup" name="lname" type="text" class="form-input" autocomplete="family-name" required>
                    </div>

                    <div class="group">
                        <label for="user" class="label">Email</label>
                        <input id="email-signup" name="email" type="text" class="form-input" autocomplete="email" required>
                    </div>

                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="password-signup" name="password" type="password" class="form-input" autocomplete="new-password" required>
                    </div>

                    <div class="group">
                        <label for="pass" class="label">Confirm Password</label>
                        <input id="cpassword-signup" type="password" class="form-input" autocomplete="new-password" required>
                    </div>

                    <div class="group" style="text-align: center">
                        <div class="g-recaptcha" id="g-recaptcha-signup" style="display: inline-block" data-sitekey="6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo"></div>
                    </div>

                    <div class="group">
                        <input type="button" id="signup-btn" name="signup" class="button" value="Sign Up">
                    </div>

                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                </form>
                <script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit&hl=en" async defer></script>
                <script>
                    //Explicit recaptcha rendering
                    var reCaptchaCallback = function() {
                        grecaptcha.render("g-recaptcha-signin", {
                            'sitekey': '6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo'
                        });
                        grecaptcha.render("g-recaptcha-signup", {
                            'sitekey': '6Ldj7boUAAAAALnA7dls640MoCefrmwAGbs_hOJo'
                        });
                    };
                </script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#signin-btn").on('click', function() {
                            var email = $("#email-signin").val();
                            var password = $("#password-signin").val();
                            var recaptchaResponse = $(".sign-in-htm .g-recaptcha-response").val();
                            //AJAX request for signin form
                            $.ajax({
                                url: 'bin/user/signin',
                                method: 'POST',
                                dataType: "json",
                                contentType: "application/json",
                                data: JSON.stringify({
                                    email: email,
                                    password: password,
                                    'g-recaptcha-response': recaptchaResponse
                                }),
                                beforeSend: function() {
                                    //Show loader before sending ajax request
                                    $('.block-form').show();
                                    $('.lds-grid').css('display', 'inline-block');
                                },
                                success: function(response) {
                                    console.log(response);
                                    //Hide loader after receiving request
                                    $('.lds-grid').hide();
                                    if (response.code == 'SIGNIN_SUCCESS') {
                                        //User credentials has been successfully validated
                                        let referer = '<?php echo $referer ?>';
                                        let patt = new RegExp('https://shankhnaad.org/events/*');
                                        // Redirect to the referer or to the dashboard
                                        if(patt.test(referer))
                                            window.location.href = referer;
                                        else
                                            window.location.href = "https://shankhnaad.org/dashboard";
                                    } else if (response.code == 'SIGNIN_FAILED') {
                                        //User has provided invalid credentials or is not registered
                                        console.log('Invalid credentials');
                                    } else if (response.code == 'EMAIL_NOT_VERIFIED') {
                                        //User has not verified his email
                                        console.log('Verify your email');
                                    } else if (response.code == 'RECAPTCHA_FAILED') {
                                        //Recaptcha verification has failed
                                        console.log('Recaptcha failed');
                                    } else if (response.code == 'FORM_NOT_SUBMITTED') {
                                        //User has not submitted the form
                                        console.log('Form not submitted');
                                    } else {
                                        //Server error
                                        console.log('Server error');
                                    }
                                    //Reset recaptcha
                                    grecaptcha.reset(0);
                                    $("#email-signin").val('');
                                    $("#password-signin").val('');
                                    $('.block-form').fadeOut();
                                }
                            });
                        });

                        //AJAX request for signup form
                        $("#signup-btn").on('click', function() {
                            var fname = $("#fname-signup").val();
                            var lname = $("#lname-signup").val();
                            var email = $("#email-signup").val();
                            var password = $("#password-signup").val();
                            var cpassword = $("#cpassword-signup").val();
                            var recaptchaResponse = $(".sign-up-htm .g-recaptcha-response").val();
                            //AJAX request for signup form
                            $.ajax({
                                url: 'bin/user/signup',
                                method: 'POST',
                                dataType: "text",
                                data: {
                                    fname: fname,
                                    lname: lname,
                                    email: email,
                                    password: password,
                                    cpassword: cpassword,
                                    'g-recaptcha-response': recaptchaResponse
                                },
                                beforeSend: function() {
                                    //Show loader before sending ajax request
                                    $('.block-form').show();
                                    $('.lds-grid').css('display', 'inline-block');
                                },
                                success: function(response) {
                                    //Hide loader after receiving request
                                    $('.lds-grid').hide();
                                    if (response == 'EMPTY_FIELDS') {
                                        //User has left atleast one field empty
                                        console.log('Fill all fields');
                                    } else if (response == 'INVALID_EMAIL_FORMAT') {
                                        //User has provided invalid email
                                        console.log('Check your email format');
                                    } else if (response == 'PASSWORDS_DO_NOT_MATCH') {
                                        //Password and confirm password do not match
                                        console.log('Passwords do not match');
                                    } else if (response == 'PASSWORD_EMPTY') {
                                        //User has not provided password
                                        console.log('Password cannot be empty');
                                    } else if (response == 'SIGNUP_SUCCESS') {
                                        //Allow user to login now
                                        console.log('Signup successful');
                                    } else if (response == 'USER_ALREADY_EXIST') {
                                        //User is already registered
                                        console.log('User already exist');
                                    } else if (response == 'RECAPTCHA_FAILED') {
                                        //Recaptcha verification has failed
                                        console.log('Recaptcha failed');
                                    } else if (response == 'FORM_NOT_SUBMITTED') {
                                        //User has not submitted the form
                                        console.log('Form not submitted');
                                    } else {
                                        //Server error
                                        console.log('Server error');
                                    }
                                    //Reset recaptcha
                                    grecaptcha.reset(1);
                                    $("#email-signup").val('');
                                    $("#password-signup").val('');
                                    $("#cpassword-signup").val('');
                                    $('.block-form').fadeOut();
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>