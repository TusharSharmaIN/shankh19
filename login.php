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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="/assets/css/login.css" />
    <script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit&hl=en" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script defer src="/assets/scripts/login.js"></script>
    <title>Login</title>
</head>

<body>
    <script>
        var referer = "<?php echo $referer; ?>";
    </script>
    <div class="form-structor">
        <form id="signup-form" class="signup">
            <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
            <div class="form-holder">
                <input type="text" class="input" id="signup-name" autocomplete="name" placeholder="Full Name" />
                <input type="email" class="input" id="signup-email" autocomplete="email" placeholder="Email" />
                <input type="password" class="input" id="signup-password" autocomplete="off" placeholder="Password" />
                <input type="password" class="input" id="signup-cpassword" autocomplete="off" placeholder="Confirm Password" />
            </div>
            <div id="g-recaptcha-signup"></div>
            <button class="submit-btn" id="signup-btn">
                Sign up
            </button>
        </form>
        <div class="login slide-up">
            <div class="center">
                <h2 class="form-title" id="login" name="login-heading">
                    <span>or</span>Log in
                </h2>
                <div class="form-holder">
                    <input type="email" class="input" id="login-email" autocomplete="email" placeholder="Email" />
                    <input type="password" class="input" id="login-password" autocomplete="current-password" placeholder="Password" />
                </div>
                <div class="frgt-pswd">
                    <button class="text-button" data-modal-target="#modal">
                        Forgot Password
                    </button>
                    <div class="modal" id="modal">
                        <div class="modal-header">
                            <div class="title">Reset Password</div>
                        </div>
                        <div class="modal-body">
                            <form class="reset-form">
                                <label>
                                    <input type="text" autocomplete="email" id="password-reset-email" placeholder="Email" />
                                </label>
                                <input type="submit" value="Submit" id="password-reset-btn" class="submit-btn" />
                            </form>
                            <a href="#" id="reset-back">Back</a>
                        </div>
                    </div>
                    <div class="overlay" id="overlay-reset"></div>
                </div>
                <div class="resend-email">
                    <button class="text-button" data-modal-target="#resend-modal">
                        Resend Confirmation Link
                    </button>
                    <div class="modal" id="resend-modal">
                        <div class="modal-body">
                            <p>
                                Do you want to resend the Confirmation Link?
                            </p>
                            <form class="reset-form">
                                <input type="submit" value="Yes" class="submit-btn" id="resend-email-btn" />
                            </form>
                            <a href="#" id="resend-back">Back</a>
                        </div>
                    </div>
                    <div class="overlay" id="overlay-resend"></div>
                </div>
                <div id="g-recaptcha-signin"></div>
                <button class="submit-btn" id="signin-btn">Log in</button>
            </div>
        </div>
    </div>
    <div id="alert" class="alert"></div>
</body>

</html>