<?php
// session_start();
// if (!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
// 	// User is not signed in
// 	header('Location: login.php'); //Redirect to login page
// 	exit();
// }
// // Include dependencies
// include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
// include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

// $email = $_SESSION['email'];
// $fname = $_SESSION['fname'];
// $lname = $_SESSION['lname'];

$fname = "Shubham";
$lname = "Singh";

// // Create a db instance
// $db = new Database();
// // Connect to db
// $userDB = $db->getUserDBConnection();

// // Create a user instance
// $user = new User($userDB);

// // Get user data from session variable
// $user->setEmail($email);
// $user->setFName($fname);
// $user->setLName($lname);

if (false && !$user->hasFilledDetailsForm()) {
?>

	<!-- FIRST TIME DASHBOARD CODE HERE -->
	<html>

	<head>
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
		<link rel="stylesheet" href="./assets/css/first-time-dashboard.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	</head>

	<body>
		<section id='home'>
			<nav>
				<div class="nav-logo">
					<img src="./images/shankh-white.svg">
					<h1>Shankhnaad'19</h1>
				</div>
			</nav>
		</section>
		<section class="dashboard">
			<div class="welcomeNote">
				<p style="text-transform = capitalize">Hi, <?php echo $fname; ?>!</p>
				<p>Please take a moment and fill out this form to help us know you better</p>
			</div>
			<div class="form-container">
				<div class="switch">
					<div class="switch-btn switch-btn-active" id="switch-personal">Personal</div>
					<div class="switch-btn" id="switch-college">College</div>
				</div>
				<form id="card-personal" enctype="application/x-www-form-urlencoded">
					<div class="inputField" id="nameField">
						<input type="text" name="FirstName" placeholder="First Name" value="<?php echo $fname; ?>" disabled autocomplete="given-name">
						<input type="text" name="LastName" placeholder="Last Name" value="<?php echo $lname; ?>" disabled autocomplete="family-name">
					</div>
					<div class="inputField" id="emailField">
						<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" disabled autocomplete="email">
					</div>
					<div class="inputField" id="numberField">
						<input type="tel" name="phoneNumber" maxlength="10" placeholder="Phone Number" autocomplete="tel-national">
						<input type="tel" name="alternateNumber" maxlength="10" placeholder="Alternate Number (Optional)" autocomplete="tel-national">
					</div>
					<div class="inputField" id="personalField">
						<input type="text" class="datepicker" name="dateofbirth" placeholder="Date of Birth" autocomplete="off">
						<input name="gender" list="gender" placeholder="Gender" autocomplete="sex">
						<datalist id="gender">
							<option>Male</option>
							<option>Female</option>
							<option>Other</option>
						</datalist>
					</div>
					<div class="inputField" id="addressField">
						<textarea rows="3" name="address" placeholder="Address" autocomplete="street-address"></textarea>
					</div>
					<input type="button" class="button" id="next-btn" value="Next">
				</form>
				<form id="card-college" enctype="application/x-www-form-urlencoded">
					<div class="inputField" id="collegeName">
						<input type="text" name="collegeName" placeholder="College Name" autocomplete="off">
					</div>
					<div class="inputField" id="rollNumber">
						<input type="text" name="rollNumber" placeholder="Roll number (Optional)" autocomplete="off">
					</div>
					<div class="inputField" id="yearOfStudy">
						<input type="text" name="yearOfStudy" list="year" placeholder="Year of Study" autocomplete="off">
						<datalist id="year">
							<option>First Year</option>
							<option>Second Year</option>
							<option>Third Year</option>
							<option>Fourth Year</option>
						</datalist>
					</div>
					<div class="inputField" id="branch">
						<input type="text" name="branch" list="branches" placeholder="Branch" autocomplete="off">
						<datalist id="branches">
							<option>Computer Science and Engineering</option>
							<option>Information Technology</option>
							<option>Electronics Engineering</option>
							<option>Electrical Engineering</option>
							<option>Chemical Engineering</option>
							<option>Bio-Technology</option>
							<option>Civil Engineering</option>
							<option>Mechanical Engineering</option>
							<option>Electronics and Communication Engineering</option>
							<option>Metallurgical Engineering</option>
						</datalist>
					</div>
					<div class="inputField" id="collegeCity">
						<input type="text" name="collegeCity" placeholder="College City" autocomplete="off">
					</div>
					<input type="button" class="button" id="submit-btn" value="Submit">
				</form>
			</div>
		</section>
		<div id="alert" class="alert">Error</div>
		<script src="./assets/scripts/first-time-dashboard.js"></script>
		<script type="text/javascript">
			//AJAX request to submit form
			$("#submit-btn").on('click', function() {
				//Check if all details in college form is valid
				if (!validateCollegeDetails())
					return;

				var dob = $('input[name="dateofbirth"]').val();
				var gender = $('input[name="gender"]').val();
				var phoneNumber = $('input[name="phoneNumber"]').val();
				var alternatePhone = $('input[name="alternateNumber"]').val();
				var address = $('textarea[name="address"]').val();
				var collegeName = $('input[name="collegeName"]').val();
				var rollNumber = $('input[name="rollNumber"]').val();
				var yearOfStudy = $('input[name="yearOfStudy"]').val();
				var branch = $('input[name="branch"]').val();
				var collegeCity = $('input[name="collegeCity"]').val();

				//AJAX request for details form
				$.ajax({
					url: 'bin/user/process-user-details',
					method: 'POST',
					dataType: 'text',
					data: {
						gender: gender,
						dob: dob,
						address: address,
						phoneNumber: phoneNumber,
						alternatePhone: alternatePhone,
						collegeName: collegeName,
						rollNumber: rollNumber,
						yearOfStudy: yearOfStudy,
						branch: branch,
						collegeCity: collegeCity
					},
					beforeSend: function() {
						//Show loader before sending ajax request
						$("#submit-btn").prop('disabled', true);
						$("#submit-btn").css('cursor', 'not-allowed');
						$("#submit-btn").val('Please Wait');
					},
					success: function(response) {
						if (response == "UPDATE_SUCCESS") {
							showSuccess('Details saved successfully');
							setTimeout(function() {
								window.location.href = "https://shankhnaad.org/dashboard";
							}, 1000);
						} else {
							//Server error
							showError(response);
							$("#submit-btn").prop('disabled', false);
							$("#submit-btn").css('cursor', 'pointer');
							$("#submit-btn").val('Submit');
						}
					}
				});
			});
		</script>
	</body>

	</html>
<?php
} else {
?>
	<!-- REGULAR DASHBOARD CODE HERE -->
	<html>

	<head>
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
		<link rel="stylesheet" href="./assets/css/regular-dashboard.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>

	<body>
		<section id='home'>
			<nav>
				<div class="nav-logo">
					<img src="./images/shankh-white.svg">
					<h1>Shankhnaad'19</h1>
				</div>
				<ul class="nav-ul" id="nav">
					<li><a class="nav-ul-a" href="../Test/Border1.html">Login/Register</a></li>
					<li><a class="nav-ul-a" href="../index.html#events">Events</a></li>
					<li><a class="nav-ul-a" href="#">Brochure</a></li>
					<li><a class="nav-ul-a" href="../index.html#our-team">Team</a></li>
					<li><a class="nav-ul-a" href="../index.html#sponsors">Sponsors</a></li>
					<li><a class="nav-ul-a" href="../index.html#aboutus">About us</a></li>
				</ul>
				<div class="burger">
					<div class="line1"></div>
					<div class="line2"></div>
					<div class="line3"></div>
				</div>
			</nav>
		</section>
		<div class="mobileMenu">
			<div class="mobilelist mobilelist-active" id="mobileEvents">Events</div>
			<div class="mobilelist" id="mobilePersonal">Personal</div>
			<div class="mobilelist" id="mobileCollege">College</div>
			<div class="mobilelist" id="mobilePassword">Password</div>
			<div class="mobilelist" id="mobileLogout">Log Out</div>
		</div>
		<section id="dashboard-container">
			<div class="dashboard">
				<div class="dashMenu">
					<div class="name" id="name"><?php echo $fname . " " . $lname; ?></div>
					<div class="menulist active" id="eventRegister">Events Registered</div>
					<div class="menulist" id="personalDetail">Personal Details</div>
					<div class="menulist" id="collegeDetail">College Details</div>
					<div class="menulist" id="changePassword">Change Password</div>
					<div class="menulist" id="logout">Log Out</div>
				</div>
				<div class="form-container">
					<div id="personal-details-container" class="table-container">
						<table id="personal-details" class="details-table">
							<caption>Personal Details
								<hr>
							</caption>
							<tr>
								<th scope="row">Name</th>
								<td colspan="2"><input type="text" name="name" placeholder="Name" disabled value="<?php echo $fname . " " . $lname; ?>" required></td>
							</tr>
							<tr>
								<th scope="row">E-mail</th>
								<td colspan="2"><input type="email" name="email" placeholder="Email" disabled value=" <?php echo $email; ?>" required></td>
							</tr>
							<tr>
								<th scope="row">Contact</th>
								<td><input type="tel" name="phoneNumber1" maxlength="10" placeholder="Phone Number 1" disabled value="0123456789" required></td>
								<td><input type="tel" name="phoneNumber2" maxlength="10" placeholder="Phone Number 2" disabled value="0123456789"></td>
							</tr>
							<tr>
								<th scope="row">Date of Birth</th>
								<td colspan="2"><input type="text" name="dateOfBirth" placeholder="Date of Birth" disabled value="01/02/2000" required></td>
							</tr>
							<tr>
								<th scope="row">Gender</th>
								<td colspan="2">
									<input type="text" list="gender" name="gender" placeholder="Gender" disabled value="Male" required>
									<datalist id="gender">
										<option>Male</option>
										<option>Female</option>
										<option>Other</option>
									</datalist>
								</td>
							</tr>
							<tr>
								<th scope="row">Address</th>
								<td colspan="2"><textarea rows="1" name="address" placeholder="Address" disabled required>AITH, Awadhpuri, Kanpur - 208024</textarea></td>
							</tr>
						</table>
						<button class="edit-btn">Edit</button>
					</div>
					<div id="college-details-container" class="table-container">
						<table id="college-details" class="details-table">
							<caption>College Details
								<hr>
							</caption>
							<tr>
								<th scope="row">College Name</th>
								<td><input type="text" name="collegeName" placeholder="College Name" disabled value="Dr. Ambedkar Institute of Technology for Handicapped" required></td>
							</tr>
							<tr>
								<th scope="row">Year of Study</th>
								<td>
									<input type="text" name="yearOfStudy" placeholder="Year Of Study" disabled value="First Year" required>
									<datalist id="year">
										<option>First Year</option>
										<option>Second Year</option>
										<option>Third Year</option>
										<option>Fourth Year</option>
									</datalist>
								</td>
							</tr>
							<tr>
								<th scope="row">Branch</th>
								<td>
									<input type="text" name="branch" list="branches" placeholder="Branch" disabled value="Information Technology" required>
									<datalist id="branches">
										<option>Computer Science and Engineering</option>
										<option>Information Tecnlology</option>
										<option>Electronics Engineering</option>
										<option>Electrical Engineering</option>
										<option>Chemical Engineering</option>
										<option>Bio-Technology</option>
										<option>Civil Engineering</option>
										<option>Mechanical Engineering</option>
										<option>Electronics and Communication Engineering</option>
										<option>Metallurgical Engineering</option>
									</datalist>
								</td>
							</tr>
							<tr>
								<th scope="row">College City</th>
								<td><input type="text" name="collegeCity" placeholder="College City" disabled value="Kanpur" required></td>
							</tr>
						</table>
						<button class="edit-btn">Edit</button>
					</div>
					<div id="events-registered-container" class="table-container">
						<table class="details-table">
							<caption>Cultural Events
								<hr>
							</caption>
							<tr>
								<th>Event</th>
								<th>Date</th>
								<th>Venue</th>
								<th>De-register</th>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
						</table>
						<table class="details-table">
							<caption>Tech Events
								<hr>
							</caption>
							<tr>
								<th>Event</th>
								<th>Date</th>
								<th>Venue</th>
								<th>De-register</th>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
						</table>
						<table class="details-table">
							<caption>Literary Events
								<hr>
							</caption>
							<tr>
								<th>Event</th>
								<th>Date</th>
								<th>Venue</th>
								<th>De-register</th>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
							<tr>
								<td>Dance Competition</td>
								<td>01 Jan 2019</td>
								<td>Community Hall</td>
								<td>x</td>
							</tr>
						</table>
						<button class="edit-btn">Edit</button>
					</div>
					<div id="change-password-container" class="table-container">
						<table id="change-password" class="details-table">
							<caption>Change Password
								<hr>
							</caption>
							<tr>
								<th scope="row">Current Password</th>
								<td><input type="password" name="currentPassword" minlength="5" maxlength="15" placeholder="Current Password" required></td>
							</tr>
							<tr>
								<th scope="row">New Password</th>
								<td><input id="newPassword" type="password" name="newPassword" minlength="5" maxlength="15" placeholder="New Password" required></td>
							</tr>
							<tr>
								<th scope="row">Confirm Password</th>
								<td><input id="confirmPassword" type="password" name="confirmPassword" minlength="5" maxlength="15" placeholder="Confirm Password" required></td>
							</tr>
						</table>
						<button class="edit-btn">Confirm</button>
					</div>
				</div>
			</div>
		</section>
		<script src="./assets/scripts/regular-dashboard.js"></script>
	</body>

	</html>


<?php
}
?>