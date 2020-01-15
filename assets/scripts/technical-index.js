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
