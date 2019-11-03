<?php
    session_start();
    if(!isset($_SESSION['email']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])){
		// User is not signed in
		header('Location: login.php');//Redirect to login page
		exit();
	}
	// Include dependencies
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];

	// Create a db instance
	$db = new Database();
	// Connect to db
	$userDB = $db->getUserDBConnection();
	
	// Create a user instance
	$user = new User($userDB);

	// Get user data from session variable
	$user->setEmail($email);
	$user->setFName($fname);
	$user->setLName($lname);

	if(!$user->hasFilledDetailsForm()){
?>

	<!-- FIRST TIME DASHBOARD CODE HERE -->
	<html>
		<head>
			<title>Dash Board</title>
			<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
			<meta charset = "utf-8">
			<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
			<link rel = "stylesheet" href = "./assets/css/dashboard.css">
			<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
			<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		</head>
		<body>
			<section id = 'home'>
				<nav>
					<div class = "nav-logo">
						<img src = "./images/shankh-white.svg">
						<h1>Shankhnaad'19</h1>
					</div>
				</nav>
			</section>
			<section class = "dashboard">
				<div class="welcomeNote">
					<p style = "text-transform = capitalize">Hi, <?php echo $fname; ?>!</p>
					<p>Please take a moment and fill out this form to help us know you better</p>
				</div>
				<div class = "form-container">
					<div class="switch">
						<div class="switch-btn switch-btn-active" id = "switch-personal">Personal</div>
						<div class="switch-btn" id = "switch-college">College</div>
					</div>
					<form id = "card-personal" enctype="application/x-www-form-urlencoded">
						<div class="inputField" id="nameField">
							<input type="text" name="FirstName" placeholder="First Name" value = "<?php echo $fname; ?>" disabled autocomplete = "given-name">
							<input type="text" name="LastName" placeholder="Last Name" value = "<?php echo $lname; ?>" disabled autocomplete = "family-name">
						</div>
						<div class="inputField" id="emailField">
							<input type="email" name="email" placeholder="Email" value = "<?php echo $email; ?>" disabled autocomplete = "email">
						</div>
						<div class="inputField" id="numberField">
							<input type="tel" name="phoneNumber" maxlength="10" placeholder="Phone Number" autocomplete = "tel-national">
							<input type="tel" name="alternateNumber" maxlength="10" placeholder="Alternate Number" autocomplete = "tel-national">
						</div>
						<div class="inputField" id="personalField">
							<input type="text" class = "datepicker" name="dateofbirth" placeholder="Date of Birth" autocomplete = "off">
							<input name="gender" list="gender" placeholder="Gender" autocomplete = "sex">
							<datalist id="gender">
								<option>Male</option>
								<option>Female</option>
								<option>Other</option>
							</datalist>
						</div>
						<div class="inputField" id="addressField">
							<textarea rows="3" name="address" placeholder="Address" autocomplete = "street-address"></textarea>
						</div>
						<input type = "button" class = "button" id = "next-btn" value = "Next">
					</form>
					<form id = "card-college" enctype="application/x-www-form-urlencoded">
						<div class="inputField" id="collegeName">
							<input type="text" name="collegeName" placeholder="College Name" autocomplete = "off">
						</div>
						<div class="inputField" id="yearOfStudy">
							<input type="text" name="yearOfStudy" list="year" placeholder="Year of Study" autocomplete = "off">
							<datalist id="year">
								<option>First Year</option>
								<option>Second Year</option>
								<option>Third Year</option>
								<option>Fourth Year</option>
							</datalist>
						</div>
						<div class="inputField" id="branch">
							<input type="text" name="branch" list="branches" placeholder="Branch" autocomplete = "off">
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
							<input type="text" name="collegeCity" placeholder="College City" autocomplete = "off">
						</div>
						<input type = "button" class = "button" id = "submit-btn" value = "Submit">
					</form>
				</div>
			</section>
			<script src = "./assets/scripts/dashboard.js"></script>
			<script type = "text/javascript">
				//AJAX request to submit form
				$("#submit-btn").on('click', function(){
					//Check if all details in college form is valid
					if(!validateCollegeDetails())
						return;
					
					var dob = $('input[name="dateofbirth"]').val();
					var gender = $('input[name="gender"]').val();
					var phoneNumber = $('input[name="phoneNumber"]').val();
					var alternatePhone = $('input[name="alternateNumber"]').val();
					var address = $('textarea[name="address"]').val();
					var collegeName = $('input[name="collegeName"]').val();
					var yearOfStudy = $('input[name="yearOfStudy"]').val();
					var branch = $('input[name="branch"]').val();
					var collegeCity = $('input[name="collegeCity"]').val();
					
					//AJAX request for details form
					$.ajax(
						{
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
								yearOfStudy: yearOfStudy,
								branch: branch,
								collegeCity: collegeCity
							},
							beforeSend: function(){
								//Show loader before sending ajax request
								$(this).prop('disabled', true);
								$(this).val('Please Wait');
							},
							success: function(response){
								if(response == "UPDATE_SUCCESS"){
									$(this).val('Submitted');
									window.location.href = "https://shankhnaad.org/dashboard";
								}
								else{
									//Server error
									console.log('Server error');
								}
							}
						}
					);
				});
			</script>
		</body>
	</html>
<?php
	}
	else{
?>

<!-- PUT REGULAR DASHBOARD CODE HERE -->
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
		<title>Shankhnaad'19</title>
	</head>
	<body>
		<h1 style = "display: flex; justify-content: center; align-items: center; text-transform: uppercase; font-family: 'Poppins', sans-serif; letter-spacing: 10px;
    font-size: 48px;">Shankhnaad'19</h1>
		<p style = "display: flex; justify-content: center; height: 10vh; align-items: center; text-transform: uppercase; font-size: 18px">Regular dashboard is under construction</p>
	</body>
</html>


<?php
	}
?>