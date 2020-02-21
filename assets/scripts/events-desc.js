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

/* REST CODE HERE */

// EID of the event for which the user wants to register
var eid = window.location.href.substr(window.location.href.length - 8);

// Make AJAX request to get all technical events list from DB which are active
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
	// Make AJAX request to get all technical events list from DB which to which user is registered
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
