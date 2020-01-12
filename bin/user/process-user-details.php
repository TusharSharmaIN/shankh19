<?php
session_start();
//Check if session exists or not
if (!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
    // User is not signed in
    exit('UNAUTHORIZED_ACCESS');
}

//Check if POST is set or not
if (!isset($_POST['phoneNumber']) || !isset($_POST['dob']) || !isset($_POST['gender']) || !isset($_POST['address']) || !isset($_POST['collegeName']) || !isset($_POST['yearOfStudy']) || !isset($_POST['branch']) || !isset($_POST['collegeCity'])) {
    exit('SERVER_ERROR');
}

// Include dependencies
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
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

// Store POST data into variables
$phone = $_POST['phoneNumber'];
$altPhone = $_POST['alternatePhone'];
$dob = $_POST['dob'];
$dob = str_replace('/', '-', $dob);
$dob = date('Y-m-d', strtotime($dob));
$gender = strtoupper($_POST['gender']);
$gender = $gender[0]; //Only store M, F, or O
$address = $_POST['address'];
$clgName = $_POST['collegeName'];
$rollNumber = $_POST['rollNumber'];
$yearOfStudy = $_POST['yearOfStudy'];
$branch = $_POST['branch'];
$clgCity = $_POST['collegeCity'];

// DO DATA VALIDATION HERE BEFORE SAVING INTO DB

if ($user->updateUserDetails($phone, $altPhone, $dob, $gender, $address, $clgName, $rollNumber, $yearOfStudy, $branch, $clgCity))
    exit('UPDATE_SUCCESS');

exit('SERVER_ERROR');