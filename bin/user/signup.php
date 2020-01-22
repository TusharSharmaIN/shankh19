<?php
// Include dependencies
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

// Get POST data from HTTP body
$body = file_get_contents('php://input');
$body = json_decode($body, true);

// Check if post has data
if (isset($body['fname']) && isset($body['lname']) && isset($body['email']) && isset($body['password']) && isset($body['cpassword'])) {
    // Google recaptcha server script
    // Get secret key from greconfig.php file
    require $_SERVER['DOCUMENT_ROOT'] . '/../config/greconfig.php';
    $responseKey = $body['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);
    // Only proceed when recaptcha is verified
    if ($response->success) {
        $fname = $body['fname'];
        $lname = $body['lname'];
        $email = $body['email'];
        $password = $body['password'];
        $cpassword = $body['cpassword'];

        //Validate email, password and confirm password
        $response = validate($fname, $lname, $email, $password, $cpassword);

        // If validation is failed
        if ($response != 'VALIDATED') {
            exit(json_encode(array("code" => $response)));
        }

        // Create a db instance
        $db = new Database();
        // Connect to user's db
        $userDB = $db->getUserDBConnection();

        // Create a user instance
        $user = new User($userDB);

        // Get user data from sign up form
        $user->setFName($fname);
        $user->setLName($lname);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCreated(date('Y-m-d H:i:s'));

        // Sign up the user
        $response = $user->signup();
        if ($response == 'SIGNUP_SUCCESS') {
            // User has been successfully signed up
            exit(json_encode(array("code" => $response)));
        } else if ($response == 'USER_ALREADY_EXIST') {
            // User is already signed up
            exit(json_encode(array("code" => $response)));
        } else {
            // Sign up failed
            exit(json_encode(array("code" => 'SERVER ERROR')));
        }
    } else {
        //Recaptcha verification failed
        exit(json_encode(array("code" => 'RECAPTCHA_FAILED')));
    }
} else {
    // User has not submitted form
    exit(json_encode(array("code" => 'FORM_NOT_SUBMITTED')));
}

// Function to validate if email is in correct format or not
function validate($fname, $lname, $email, $password, $cpassword)
{
    // Check for any empty field
    if (strlen($fname) <= 0 || strlen($lname) <= 0 || strlen($email) <= 0 || strlen($password) <= 0 || strlen($cpassword) <= 0) {
        return 'EMPTY_FIELDS';
    }
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'INVALID_EMAIL_FORMAT';
    }
    // Validate password
    if (strlen($password) < 5 || strlen($password) > 15) {
        return 'INVALID_PASSWORD_SIZE';
    }
    if ($password != $cpassword) {
        return 'PASSWORDS_DO_NOT_MATCH';
    }
    // Everything is validated
    return 'VALIDATED';
}
