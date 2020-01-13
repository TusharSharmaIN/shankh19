// Add event listener for nav menu
$(".nav-ul-a").on("click", function() {
	$(".nav-ul").toggleClass("active");
	$(".nav-ul-a").toggleClass("active");
	$(".burger").toggleClass("toggle");
});
$(".burger").on("click", function() {
	$(".nav-ul").toggleClass("active");
	$(".nav-ul-a").toggleClass("active");
	$(".burger").toggleClass("toggle");
});

// Add event listener to switch button to switch personal details for desktop version
$("#personalDetail").on("click", function() {
	$(this).addClass("active");
	$("#collegeDetail").removeClass("active");
	$("#eventRegister").removeClass("active");
	$("#changePassword").removeClass("active");
	$("#personal-details-container").css("display", "flex");
	$("#college-details-container").hide();
	$("#events-registered-container").hide();
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch college details for desktop version
$("#collegeDetail").on("click", function() {
	$(this).addClass("active");
	$("#eventRegister").removeClass("active");
	$("#changePassword").removeClass("active");
	$("#personalDetail").removeClass("active");
	$("#personal-details-container").hide();
	$("#college-details-container").css("display", "flex");
	$("#events-registered-container").hide();
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch events register for desktop version
$("#eventRegister").on("click", function() {
	$(this).addClass("active");
	$("#collegeDetail").removeClass("active");
	$("#changePassword").removeClass("active");
	$("#personalDetail").removeClass("active");
	$("#personal-details-container").hide();
	$("#college-details-container").hide();
	$("#events-registered-container").css("display", "flex");
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch change password for desktop version
$("#changePassword").on("click", function() {
	$(this).addClass("active");
	$("#collegeDetail").removeClass("active");
	$("#eventRegister").removeClass("active");
	$("#personalDetail").removeClass("active");
	$("#personal-details-container").hide();
	$("#college-details-container").hide();
	$("#events-registered-container").hide();
	$("#change-password-container").css("display", "flex");
});

// Add event listener to switch button to switch personal details for mobile version
$("#mobilePersonal").on("click", function() {
	$(this).addClass("mobilelist-active");
	$("#mobileCollege").removeClass("mobilelist-active");
	$("#mobileEvents").removeClass("mobilelist-active");
	$("#mobilePassword").removeClass("mobilelist-active");
	$("#personal-details-container").css("display", "flex");
	$("#college-details-container").hide();
	$("#events-registered-container").hide();
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch college details for mobile version
$("#mobileCollege").on("click", function() {
	$(this).addClass("mobilelist-active");
	$("#mobilePersonal").removeClass("mobilelist-active");
	$("#mobileEvents").removeClass("mobilelist-active");
	$("#mobilePassword").removeClass("mobilelist-active");
	$("#personal-details-container").hide();
	$("#college-details-container").css("display", "flex");
	$("#events-registered-container").hide();
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch events details for mobile version
$("#mobileEvents").on("click", function() {
	$(this).addClass("mobilelist-active");
	$("#mobilePersonal").removeClass("mobilelist-active");
	$("#mobileCollege").removeClass("mobilelist-active");
	$("#mobilePassword").removeClass("mobilelist-active");
	$("#personal-details-container").hide();
	$("#college-details-container").hide();
	$("#events-registered-container").css("display", "flex");
	$("#change-password-container").hide();
});

// Add event listener to switch button to switch change password details for mobile version
$("#mobilePassword").on("click", function() {
	$(this).addClass("mobilelist-active");
	$("#mobilePersonal").removeClass("mobilelist-active");
	$("#mobileCollege").removeClass("mobilelist-active");
	$("#mobileEvents").removeClass("mobilelist-active");
	$("#personal-details-container").hide();
	$("#college-details-container").hide();
	$("#events-registered-container").hide();
	$("#change-password-container").css("display", "flex");
});

//Confirm Password validation
function Validate() {
	var password = document.getElementById("newPassword").value;
	var confirmPassword = document.getElementById("confirmPassword").value;
	if (password != confirmPassword) {
		alert("Passwords do not match.");
		return false;
	}
	return true;
}

// Make AJAX request to logout
$("#logout, #mobileLogout").on("click", function() {
	$.ajax({
		url: "/logout",
		method: "POST",
		dataType: "text",
		data: {},
		success: function(response) {
			window.location.href = "/login";
		}
	});
});

var events = {};

// Make AJAX request to fetch all events
$.ajax({
	url: "/bin/event/process-event",
	method: "GET",
	dataType: "json",
	contentType: "application/json",
	data: {
		getUserEvents: true
	},
	success: function(response) {
		// console.log(response);
		if (response.status == 1) {
			events = response.data;
			events.forEach(event => {
				let d = new Date(event.DOE + " " + event.TOE);
				let date = d.toLocaleDateString("en-IN", {year: 'numeric', month: 'short', day: 'numeric'});
				let time = d.toLocaleTimeString("en-IN", {timeStyle: "short"});
				let html = `<tr>
								<td>${event.Name}</td>
								<td>${time}</td>
								<td>${date}</td>
								<td>${event.Venue}</td>
								<td><i id="${event.EID}" class="fa fa-close deregister-btn"></i></td>
							</tr>`;
				if (event.Type === "Cultural") {
					$("#cultural-table").append(html);
				} else if (event.Type === "Technical") {
					$("#technical-table").append(html);
				} else if (event.Type === "Literary") {
					$("#literary-table").append(html);
				}
			});
			// Add event listener to all de-register buttons
			$("fa.fa-close.deregister-btn").on("click", event => {
				deregisterEvent(event.target.id);
			});
		}
	}
});

function deregisterEvent(eid) {
	console.log(eid);
}
