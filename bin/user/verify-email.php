<?php
    //https://shankhnaad.org/bin/user/verify-email?email=EMAIL_ADDRESS   

    if(!isset($_GET['email'])){
        // Redirected to this page by an invalid link
        exit('INVALID_LINK');
    }

    // Get user's email
    $email = $_GET['email'];

    // Check email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Email provided in the link is invalid
        exit('INVALID_EMAIL_FORMAT');
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';
    
    /* Check if user exist or not and if his email is verified or not */
    // Create a db instance
    $db = new Database();
    // Connect to db
    $userDB = $db->getUserDBConnection();
    // Create a User's instance
    $user = new User($userDB);
    // Set email
    $user->setEmail($email);
    // Try to resend verification email
    $response = $user->resendVerificationEmail();
    exit($response);
?>