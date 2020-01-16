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

// Make AJAX request to get all technical events list from DB which are active
$.ajax({
	url: "/bin/event/process-event",
	method: "GET",
	dataType: "json",
	contentType: "application/json",
	data: {
		getAllTechnicalEvents: true
	},
	success: function(response) {
		if (response.status == 1) {
			events = response.data;
			events.forEach(event => {
				let d = new Date(event.DOE + " " + event.TOE);
				let date = d.toLocaleDateString("en-IN", {
					year: "numeric",
					month: "short",
					day: "numeric"
				});
				let time = d.toLocaleTimeString("en-IN", {
					timeStyle: "short"
				});
				let html = `<tr id="row-${event.EID}" class="event-list">
								<td class="event-doe">${date}</td>
								<td class="event-toe">${time}</td>
								<td class="event-name">${event.Name}</td>
								<td class="event-details"><button id="${event.EID}-details-btn" class="event-details-btn">Details</button></td>
								<td class="event-register"><button id="${event.EID}-register-btn" class="event-register-btn">Register</button></td>
							</tr>`;
				$(".events-list-table").append(html);
			});
		}
	}
});

// EID of the event for which the user wants to register
var eid = null;

// Add event handler to all event register buttons
$(".event-register-btn").on("click", event => {
	eid = event.target.id.substr(0, 8);
	// Check if user is logged in or not. If not then redirect to login page
	// Send a dummy request to the server
	$.ajax({
		url: "/bin/event/process-event",
		method: "GET",
		dataType: "json",
		contentType: "application/json",
		data: {},
		success: function(response) {
			if (response.status == 0 && !response.loggedIn) {
				window.location.href = "/login";
			} else {
				// Show confirmation box as user is logged in
				$(".dialog").addClass("active");
				$(".overlay").toggle();
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
			if (response.status == 0 && response.alreadyRegistered) {
				showError("You're already registered for this event.");
			} else if (response.status == 1) {
				showSuccess("Registration successful.");
			} else {
				showError("Oops! Something went wrong.");
			}
		}
	});
}

function closeDialog() {
	$(".dialog").removeClass("active");
	$(".overlay").toggle();
	eid = null;
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
				$(".alert").removeClass("error-alert");
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
