// Function to check if a date is valid or not
function isDate(txtDate) {
	var currVal = txtDate;
	if (currVal == "") return false;

	//Declare Regex
	var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
	var dtArray = currVal.match(rxDatePattern); // is format OK?

	if (dtArray == null) return false;
	//Checks for mm/dd/yyyy format.
	dtDay = dtArray[1];
	dtMonth = dtArray[3];
	dtYear = dtArray[5];

	if (dtMonth < 1 || dtMonth > 12) return false;
	else if (dtDay < 1 || dtDay > 31) return false;
	else if (
		(dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) &&
		dtDay == 31
	)
		return false;
	else if (dtMonth == 2) {
		var isleap =
			dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0);
		if (dtDay > 29 || (dtDay == 29 && !isleap)) return false;
	}
	return true;
}

function showError(msg) {
	$(".alert")
		.addClass("error-alert")
		.text(msg)
		.animate(
			{
				top: "60px",
				opacity: 1
			},
			500
		);

	setTimeout(function() {
		$(".alert").animate(
			{
				top: "0px",
				opacity: 0
			},
			500,
			function() {
				$(".alert").removeClass("error-alert");
			}
		);
	}, 3000);
}

function showSuccess(msg) {
	$(".alert")
		.addClass("success-alert")
		.text(msg)
		.animate(
			{
				top: "60px",
				opacity: 1
			},
			500
		);

	setTimeout(function() {
		$(".alert").animate(
			{
				top: "0px",
				opacity: 0
			},
			500,
			function() {
				$(".alert").removeClass("success-alert");
			}
		);
	}, 2000);
}

function validatePersonalDetails() {
	//First of all validate inputs on personal form
	var filter = /[1-9]{1}[0-9]{9}/;
	//Validate phone number
	if (!filter.test($('input[name="phoneNumber"]').val())) {
		if ($('input[name="phoneNumber"]').val() === "")
			showError("Phone number cannot be left empty");
		else showError("Invalid phone number");
		$('input[name="phoneNumber"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="phoneNumber"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate alternate phone number iff it is not empty
	if (
		$('input[name="alternateNumber"]').val() !== "" &&
		!filter.test($('input[name="alternateNumber"]').val())
	) {
		showError("Invalid alternate phone number");
		$('input[name="alternateNumber"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="alternateNumber"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate date
	if (!isDate($('input[name="dateofbirth"]').val())) {
		showError("Invalid Date of Birth");
		$('input[name="dateofbirth"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="dateofbirth"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate gender
	var gender = $('input[name="gender"]')
		.val()
		.toLowerCase();
	if (!(gender == "male" || gender == "female" || gender == "other")) {
		if (gender === "") showError("Gender cannot be left empty");
		else showError("Invalid Gender");
		$('input[name="gender"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="gender"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate address
	if ($('textarea[name="address"]').val() == "") {
		showError("Address cannot be left empty");
		$('textarea[name="address"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('textarea[name="address"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Everything is valid
	return true;
}

function validateCollegeDetails() {
	//Validate college name
	if ($('input[name="collegeName"]').val() == "") {
		showError("College name cannot be left empty");
		$('input[name="collegeName"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="collegeName"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate year of study
	var year = $('input[name="yearOfStudy"]')
		.val()
		.toLowerCase();
	if (
		!(
			year == "first year" ||
			year == "second year" ||
			year == "third year" ||
			year == "fourth year"
		)
	) {
		if (year === "") showError("Year of study cannot be left empty");
		else showError("Invalid year of study");
		$('input[name="yearOfStudy"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="yearOfStudy"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate branch
	if ($('input[name="branch"]').val() == "") {
		showError("Branch cannot be left empty");
		$('input[name="branch"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="branch"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Validate college city
	if ($('input[name="collegeCity"]').val() == "") {
		showError("College city cannot be left empty");
		$('input[name="collegeCity"]')
			.addClass("input-error")
			.focus();
		setTimeout(function() {
			$('input[name="collegeCity"]').removeClass("input-error");
		}, 2000);
		return false;
	}
	//Everything is valid
	return true;
}

// Add event listener to next button in personal details form
$("#next-btn").on("click", function() {
	// If validation fails
	if (!validatePersonalDetails()) return;
	$("#card-personal").hide();
	$("#card-college").show();
	$("#switch-personal").removeClass("switch-btn-active");
	$("#switch-college").addClass("switch-btn-active");
});

// Add event listener to switch button to switch between personal and college details form
$("#switch-college").on("click", function() {
	// If validation fails
	if (!validatePersonalDetails()) return;
	$("#switch-personal").removeClass("switch-btn-active");
	$(this).addClass("switch-btn-active");
	$("#card-personal").hide();
	$("#card-college").show();
});

// Add event listener to switch button to switch between personal and college details form
$("#switch-personal").on("click", function() {
	$("#switch-college").removeClass("switch-btn-active");
	$(this).addClass("switch-btn-active");
	$("#card-college").hide();
	$("#card-personal").show();
});

// Using jQuery datepicker API for Date of Birth field
$(function() {
	$(".datepicker").datepicker({
		dateFormat: "dd/mm/yy",
		yearRange: "1950:2020",
		changeYear: true,
		changeMonth: true
	});
});

//AJAX request to submit form
$("#submit-btn").on("click", function() {
	//Check if all details in college form is valid
	if (!validateCollegeDetails()) return;

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
		url: "bin/user/process-user-details",
		method: "POST",
		dataType: "text",
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
			$("#submit-btn").prop("disabled", true);
			$("#submit-btn").css("cursor", "not-allowed");
			$("#submit-btn").val("Please Wait");
		},
		success: function(response) {
			if (response == "UPDATE_SUCCESS") {
				showSuccess("Details saved successfully");
				setTimeout(function() {
					window.location.href = "https://shankhnaad.org/dashboard";
				}, 1000);
			} else {
				//Server error
				showError(response);
				$("#submit-btn").prop("disabled", false);
				$("#submit-btn").css("cursor", "pointer");
				$("#submit-btn").val("Submit");
			}
		}
	});
});
