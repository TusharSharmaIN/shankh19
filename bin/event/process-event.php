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

// If request is to get a specific event
if (isset($_GET['getEvent'])) {
	$eid = $_GET['EID'];
	$event = new Event($eid);
	if ($event->fillDetailsFromDB()) {
		exit(json_encode(array("status" => 1, "data" => $event->getEventJSON())));
	}
	exit(json_encode(array("status" => 0)));
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
					<td align=\"center\" style=\"background:#000;color:#fff;padding:20px;font-size:36px;text-transform:uppercase;font-family:'Poppins',sans-serif;letter-spacing:10px;font-weight:100;\">
						Shankhnaad'20
					</td>
				</tr>
			</table>
			<table class=\"content\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;background:#ffd89b;background:linear-gradient(to right, #ffeeee, #ddefbb);\">
				<tr>
					<td align=\"center\" style=\"padding:50px 10px 5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						You've been successfully registered for the event <strong>{$event->getName()}</strong>.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						Please go through the rules and regulations of the event.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						We'll keep you informed in case there is any update in the schedule of the event.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:100px 10px 5px 10px;font-family:'Poppins',sans-serif;font-size:14px\">
						This is a system generated mail. Please do not reply to this email.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px 20px 10px;font-family:'Poppins',sans-serif;font-size:14px\">
						We reserve rights to cancel the event without any prior information.
					</td>
				</tr>
			</table>
			<table class=\"footer\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;\">
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:30px 5px 5px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
							<a href=\"https://www.shankhnaad.org\" style=\"color:#aaa;text-decoration:none;\">www.shankhnaad.org</a>
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:0px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						Copyright &copy; 2020 Shankhnaad. All rights reserved.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:5px 5px 0 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						Dr. Ambedkar Institute of Technology for Handicapped, Kanpur, U.P., India - 208024
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:5px 5px 30px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						<a href=\"mailto:shankhnaad@aith.ac.in\" style=\"color:#aaa;text-decoration:none;\">shankhnaad@aith.ac.in</a>
					</td>
				</tr>
			</table>
			";
	$text = "You've successfully registered for {$event->getName()}.";

	// Register user for the event and send email
	if ($event->registerUser($email) && $ses->sendEmail('events@shankhnaad.org', array($email), 'Event registration', $html, $text))
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

	$event->fillDetailsFromDB();
	// Create SesApi object to send email
	$ses = new SesApi();
	$html = "
			<table class=\"heading\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;\">
				<tr>
					<td align=\"center\" style=\"background:#000;color:#fff;padding:20px;font-size:36px;text-transform:uppercase;font-family:'Poppins',sans-serif;letter-spacing:10px;font-weight:100;\">
						Shankhnaad'20
					</td>
				</tr>
			</table>
			<table class=\"content\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;background:#ffd89b;background:linear-gradient(to right, #ffeeee, #ddefbb);\">
				<tr>
					<td align=\"center\" style=\"padding:50px 10px 5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						As per your request, you've been successfully deregistered from the event <strong>{$event->getName()}</strong>.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						In case you mistakenly deregistered from the event, go to the events page and register yourself again.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px;font-family:'Poppins',sans-serif;font-size:18px\">
						Still having issues? Contact us, at the email given below, for any help.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:100px 10px 5px 10px;font-family:'Poppins',sans-serif;font-size:14px\">
						This is a system generated mail. Please do not reply to this email.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"padding:5px 10px 20px 10px;font-family:'Poppins',sans-serif;font-size:14px\">
						We reserve rights to cancel the event without any prior information.
					</td>
				</tr>
			</table>
			<table class=\"footer\" width=\"100%\" cellpadding=0 border=0 cellspacing=0 style=\"border-spacing:0;\">
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:30px 5px 5px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
							<a href=\"https://www.shankhnaad.org\" style=\"color:#aaa;text-decoration:none;\">www.shankhnaad.org</a>
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:0px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						Copyright &copy; 2020 Shankhnaad. All rights reserved.
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:5px 5px 0 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						Dr. Ambedkar Institute of Technology for Handicapped, Kanpur, U.P., India - 208024
					</td>
				</tr>
				<tr>
					<td align=\"center\" style=\"background:#000;color:#aaa;letter-spacing:1px;padding:5px 5px 30px 5px;font-family:Helvetica,Arial,sans-serif;font-size:12px;\">
						<a href=\"mailto:shankhnaad@aith.ac.in\" style=\"color:#aaa;text-decoration:none;\">shankhnaad@aith.ac.in</a>
					</td>
				</tr>
			</table>
			";
	$text = "You've successfully deregistered from the event {$event->getName()}.";

	if ($event->deregisterUser($email) && $ses->sendEmail('events@shankhnaad.org', array($email), 'Event update', $html, $text))
		exit(json_encode(array("status" => 1)));
}

if (isset($_GET['isUserRegistered'])) {
	$email = $_SESSION['email'];
	$eid = $_GET['EID'];

	$event = new Event($eid);
	if ($event->isRegistered($email)) {
		exit(json_encode(array("status" => 1)));
	}
	exit(json_encode(array("status" => 0)));
}
exit(json_encode(array("status" => 0, "loggedIn" => true))); // Status 0 means request failed
