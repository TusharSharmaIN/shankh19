/* NAV CODE HERE */

// Add event listener for nav menu
$(".nav-ul-a").on("click", function() {
	$(".nav-ul").toggleClass("active");
	$(".nav-ul-a").toggleClass("active");
	$(".burger").toggleClass("toggle");
	$("html").toggleClass("nav-active");
});
$(".burger").on("click", function() {
	$(".nav-ul").toggleClass("active");
	$(".nav-ul-a").toggleClass("active");
	$(".burger").toggleClass("toggle");
	$("html").toggleClass("nav-active");
});

/*	Brochure URL changes for different clients	*/
function changeBrochureURL(x) {
	if (x.matches) {
		//	compressed version
		document.getElementById("brochure").href =
			"https://drive.google.com/file/d/1yWHvFuxK3XA9F_jDrT-2_z-cKGIRPjph/view?usp=sharing";
	} else {
		document.getElementById("brochure").href =
			"https://drive.google.com/file/d/1_yhtfiNugNTBvbuuTxWp1SOBCelP267s/view?usp=sharing";
	}
}

var x = window.matchMedia("(max-width: 768px)");
changeBrochureURL(x); // Call listener function at run time
x.addListener(changeBrochureURL); // Attach listener function on state changes

/* REST CODE HERE */

// EID of the event for which the user wants to register
var eid = window.location.href.substr(window.location.href.length - 8);

// Make AJAX request to get all details of an event
$.ajax({
	url: "/bin/event/process-event",
	method: "GET",
	dataType: "json",
	contentType: "application/json",
	data: {
		getEvent: true,
		EID: eid
	},
	success: function(response) {
		if (response.status == 1) {
			event = response.data;
			$("title").text(`Shankhnaad'20 - ${event.name}`);
			$(".event-name").text(event.name);
			if (event.date) {
				let d = new Date(event.date + " " + event.time);
				let date = d.toLocaleDateString("en-IN", {
					year: "numeric",
					month: "short",
					day: "numeric"
				});
				let time = d.toLocaleTimeString("en-IN", {
					timeStyle: "short"
				});
				$(".event-venue").text(`${time}, ${date} at ${event.venue}`);
			}
			// Add event handler to register button
			$(".event-register-btn").on("click", event => {
				$(".dialog").addClass("active");
				$(".overlay").toggle();
				$("#dialog-confirm-btn").focus();
			});
		}
	}
}).then(() => {
	// Make AJAX request to check if user is registered to a particular EID or not
	$.ajax({
		url: "/bin/event/process-event",
		method: "GET",
		dataType: "json",
		contentType: "application/json",
		data: {
			isUserRegistered: true,
			EID: eid
		},
		success: function(response) {
			if (response.status == 0 && !response.loggedIn) {
				showError(
					"You're not logged in. Please login to register to this event."
				);
			}
			if (response.status == 1) {
				$(".event-register-btn")
					.addClass("registered")
					.attr("disabled", true)
					.text("Registered")
					.off("click");
			}
		}
	});
});

function registerEvent() {
	if (!eid) return;
	// Send AJAX request to register for the event
	$.ajax({
		url: "/bin/event/process-event",
		method: "GET",
		dataType: "json",
		contentType: "application/json",
		data: {
			registerEvent: true,
			EID: eid
		},
		success: function(response) {
			if (response.status == 0 && !response.loggedIn) {
				showError("You're not logged in. Redirecting to login page...");
				setTimeout(() => {
					window.location.href = "/login";
				}, 1000);
			} else if (response.status == 0 && response.alreadyRegistered) {
				showError("You're already registered for this event.");
			} else if (response.status == 1) {
				showSuccess("Registration successful.");
				$(".event-register-btn")
					.addClass("registered")
					.attr("disabled", true)
					.text("Registered")
					.off("click");
			} else {
				showError("Oops! Something went wrong.");
			}
		}
	});
}

function closeDialog() {
	$(".dialog").removeClass("active");
	$(".overlay").toggle();
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

$(".overlay").on("click", closeDialog);

$("#dialog-confirm-btn").on("click", () => {
	registerEvent();
	closeDialog();
});

$("#dialog-cancel-btn").on("click", closeDialog);
