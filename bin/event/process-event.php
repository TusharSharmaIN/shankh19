<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/event/event.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

// If request is to get list all technical events which are active
if (isset($_GET['getAllTechnicalEvents'])) {
	$events = Event::getAllEventsByType('Technical');
	exit(json_encode(array("status" => 1, "data" => $events)));
}

// If request is to get list all cultural events which are active
if (isset($_GET['getAllCulturalEvents'])) {
	$events = Event::getAllEventsByType('Cultural');
	exit(json_encode(array("status" => 1, "data" => $events)));
}

// If request is to get list all literary events which are active
if (isset($_GET['getAllLiteraryEvents'])) {
	$events = Event::getAllEventsByType('Literary');
	exit(json_encode(array("status" => 1, "data" => $events)));
}

session_start();

// Check if user is signed in or not
if (!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
	exit(json_encode(array("status" => 0, "loggedIn" => false))); // Status 0 means request failed
}

// If request is to register a user for an event
if (isset($_GET['registerEvent'])) {
	// Email of the user
	$email = $_SESSION['email'];
	// Event ID
	$eid = $_GET['EID'];

	// Create an event instance
	$event = new Event($eid);
	// Check if user is already registered to this event
	if ($event->isRegistered($email))
		exit(json_encode(array("status" => 0, "alreadyRegistered" => true, "loggedIn" => true)));

	$event->fillDetailsFromDB();
	// Create SesApi object to send email
	$ses = new SesApi();
	$html = "<h1
				style=\"padding:5px;display:flex;color:#fff;background-color:#000;text-transform:uppercase;font-family:'Poppins',sans-serif;letter-spacing:10px;font-size:48px;justify-content:center;font-weight:100;\"
			>
				Shankhnaad'20
			</h1>
			<p style=\"text-align:center;font-family:\'Poppins\',sans-serif;\">You\'ve successfully registered for {$event->getName()}.</p>
			<p style=\"text-align:center;font-family:\'Poppins\',sans-serif;\">Please go through the rules and regulations of the event.</p>
			<footer
				style=\"padding:10px;font-size: 14px;text-align:center;background-color:rgba(0, 0, 0, 1);color:white;font-family:\'Poppins\',sans-serif;\"
			>
				Developed by HumbleFool.<br />
				Copyright &copy; 2020 Shankhnaad. All rights reserved.<br />
				Contact - shankhnaad@aith.ac.in
			</footer>";
	$text = "You\'ve successfully registered for {$event->getName()}.";

	// Register user for the event and send email
	if ($event->registerUser($email) && $ses->sendEmail('events@shankhnaad.org', array($email), 'Event registration', $html, ''))
		exit(json_encode(array("status" => 1)));
}
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
	if (isset($_GET['type'])) // If request has type of the event
		$events = $user->getAllEventsByType($_GET['type']);
	else // otherwise return all types of events
		$events = $user->getAllEvents();
	exit(json_encode(array("status" => 1, "data" => $events)));
}
// If request is to deregister a user for an event
if (isset($_GET['deregisterEvent'])) {
	// Email of the user whose events have to be fetched
	$email = $_SESSION['email'];
	$eid = $_GET['EID'];

	$event = new Event($eid);
	if ($event->deregisterUser($email))
		exit(json_encode(array("status" => 1)));
}
exit(json_encode(array("status" => 0, "loggedIn" => true))); // Status 0 means request failed
