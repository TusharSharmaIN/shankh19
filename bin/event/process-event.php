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
	$html = "
			<table class=\"heading\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;\">
				<tr>
					<td align=\"center\" style=\"background:#000;color:#fff;padding:10px;font-size:36px;text-transform:uppercase;font-family:'Poppins',sans-serif;letter-spacing:10px;font-weight:100;\">
						Shankhnaad'20
					</td>
				</tr>
			</table>
			<table class=\"content\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;background:#ffd89b;background:linear-gradient(to right, #a1ffce, #faffd1);\">
				<tr>
					<td align=\"center\" style=\"padding:20px 10px 10px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						You've successfully registered for <strong>{$event->getName()}</strong>.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:10px 10px 20px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						Please go through the rules and regulations of the event.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:10px 10px 20px 10px;font-family:'Poppins',sans-serif;font-size:14px\">
						This is a system generated mail. Please do not reply to this email.
					</td>
				</tr>
			</table>
			<table class=\"footer\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;\">
				<tr>
					<td align=\"center\" style=\"background:#000;background:linear-gradient(to right, #434343, #000000);color:#fff;padding:20px;font-family:Helvetica,Arial,sans-serif;font-size:14px;\">
							www.shankhnaad.org<br />
							Copyright &copy; 2020 Shankhnaad. All rights reserved.<br />
							shankhnaad@aith.ac.in
					</td>
				</tr>
			</table>
			";
	$text = "You've successfully registered for {$event->getName()}.";

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
