<?php
// If link is NOT opened with email and key combo
if (!isset($_GET['email']) || !isset($_GET['key']))
    exit('INVALID_LINK');

// Include dependencies
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

$email = $_GET['email'];
$key = $_GET['key'];

// Check email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Email provided in the link is invalid
    exit('INVALID_EMAIL_FORMAT');
}

// Create a db instance
$db = new Database();
// Connect to db
$userDB = $db->getUserDBConnection();
// Create a User's instance
$user = new User($userDB);
// Set email
$user->setEmail($email);
// Check if email and key combo matches against the DB
if (!$user->checkEmailAndHash($email, $key))
    exit('INVALID_KEY');

// Display reset password form
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <noscript>
        <h1 style="text-align=center">Your browser does not support JavaScript. You will not be able to use this website.</h1>
    </noscript>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="/assets/css/reset-password.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
</head>

<body>
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
    <div class="form-structor">
        <form class="reset-password">
            <h2 class="form-title" id="signup">Reset Password</h2>
            <div class="form-holder">
                <input type="password" class="input" id="password" placeholder="Password" />
                <input type="password" class="input" id="cpassword" placeholder="Confirm Password" />
            </div>
            <input type="submit" class="submit-btn" value="Confirm">
        </form>
    </div>
    <div id="alert" class="alert"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    var email = "<?php echo $_GET['email'] ?>";
    var key = "<?php echo $_GET['key'] ?>";
</script>
<script src="/assets/scripts/reset-password.js"></script>

</html>