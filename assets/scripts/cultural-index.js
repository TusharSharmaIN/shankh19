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
var eid = null;

// Make AJAX request to get all cultural events list from DB which are active
$.ajax({
	url: "/bin/event/process-event",
	method: "GET",
	dataType: "json",
	contentType: "application/json",
	data: {
		getAllCulturalEvents: true
	},
	success: function(response) {
		if (response.status == 1) {
			events = response.data;
			// Sort events list by date and time in ascending order
			events.sort((a, b) => {
				let d_a = new Date(a.DOE + " " + a.TOE);
				let d_b = new Date(b.DOE + " " + b.TOE);
				if (d_a < d_b) return -1;
				else if (d_a > d_b) return 1;
				else return 0;
			});
			let i = 1;
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
                                <td class="event-details"><a href = "./${event.EID}" id="${event.EID}-details-btn" class="event-details-btn">Details</a></td>
								<td class="event-register"><button id="${event.EID}-register-btn" class="event-register-btn">Register</button></td>
							</tr>`;
				$(".events-list-table").append(html);
				$(`#row-${event.EID}`).css("opacity", 0);
				setTimeout(() => {
					$(`#row-${event.EID}`).animate(
						{
							opacity: 1
						},
						50
					);
				}, 50 * i);
				i++;
			});
			// Add event handler to all event register buttons
			$(".event-register-btn").on("click", event => {
				eid = event.target.id.substr(0, 8);
				$(".dialog").addClass("active");
				$(".overlay").toggle();
				$("#dialog-confirm-btn").focus();
			});
		}
	}
}).then(() => {
	// Make AJAX request to get all cultural events list from DB which to which user is registered
	$.ajax({
		url: "/bin/event/process-event",
		method: "GET",
		dataType: "json",
		contentType: "application/json",
		data: {
			getUserEvents: true,
			type: "Cultural"
		},
		success: function(response) {
			if (response.status == 0 && !response.loggedIn) {
				showError(
					"You're not logged in. Please login to register to any event."
				);
			}
			if (response.status == 1) {
				events = response.data;
				events.forEach(event => {
					$(`#row-${event.EID}`).addClass("registered");
					$(`#${event.EID}-register-btn`)
						.addClass("registered")
						.attr("disabled", true)
						.text("Registered")
						.off("click");
				});
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
			} else if (response.status == 0 && response.detailsNotFilled) {
				showError(
					"Please complete your profile. Redirecting to dashboard..."
				);
				setTimeout(() => {
					window.location.href = "/dashboard";
				}, 1000);
			} else if (response.status == 0 && response.alreadyRegistered) {
				showError("You're already registered for this event.");
			} else if (response.status == 1) {
				showSuccess("Registration successful.");
				$(`#row-${eid}`).addClass("registered");
				$(`#${eid}-register-btn`)
					.addClass("registered")
					.attr("disabled", true)
					.text("Registered")
					.off("click");
			} else {
				showError("Oops! Something went wrong.");
			}
			eid = null;
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
