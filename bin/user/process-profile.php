<?php
session_start();

// Check if user is signed in or not
if (!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
    exit(json_encode(array("status" => 0))); // Status 0 means request failed
}

// Include dependencies
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/event/event.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

$email = $_SESSION['email'];

// Create a db instance
$db = new Database();
// Connect to db
$userDB = $db->getUserDBConnection();

// Create a user instance
$user = new User($userDB);

// Get user data from session variable
$user->setEmail($email);

if (isset($_GET['getAllUserDetails'])) {
    $details = $user->getAllUserDetails();
    exit(json_encode(array("status" => 1, "data" => $details)));
}
exit(json_encode(array("status" => 0))); // Status 0 means request failed
