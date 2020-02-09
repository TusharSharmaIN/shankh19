<?php
//https://shankhnaad.org/bin/user/forgot-password?email=EMAIL_ADDRESS
$email = $_GET['email'];
// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit(json_encode(array('code' => 'INVALID_EMAIL_FORMAT')));
}

// Include dependencies
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

// Create a db instance
$db = new Database();
// Connect to user's db
$userDB = $db->getUserDBConnection();
// Create a User's instance
$user = new User($userDB);
// Set email
$user->setEmail($email);
$response = $user->sendPasswordResetEmail();
exit(json_encode(array('code' => $response)));
