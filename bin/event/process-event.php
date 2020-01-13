<?php

session_start();

// Check if user is signed in or not
if (!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
	exit(json_encode(array("status" => 0))); // Status 0 means request failed
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/event/event.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

// If request is to get list of user's registered events
if (isset($_GET['getUserEvents'])) {
	// Email of the user whose events have to be fetched
	$email = $_SESSION['email'];
	// Create a db instance
	$db = new Database();
	// Create a user DB connection to get data from User_Event_Details table
	$userDB = $db->getUserDBConnection();
	$user = new User($userDB);
	$user->setEmail($email);
	$events = $user->getAllEvents();
	exit(json_encode(array("status" => 1, "data" => $events)));
}
