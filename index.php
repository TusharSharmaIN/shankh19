<?php
$loggedIn = false;
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
	$loggedIn = true;
}
?>

<!DOCTYPE html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shankhnaad'20 - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<link rel="stylesheet" href="/assets/css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/png" href="img/shankh-black.png"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<script src="https://kit.fontawesome.com/6c05aa3d79.js" crossorigin="anonymous"></script>
	<script defer src="/assets/scripts/index.js"></script>
</head>

<body>
	<!--- Start Navigation -->
	<nav>
		<div class="nav-logo">
			<img src="./img/shankh-white.svg">
			<h1>Shankhnaad'20</h1>
		</div>
		<ul class="nav-ul" id="nav">
			<?php
				if ($loggedIn) echo "<li><a class=\"nav-ul-a\" href=\"/dashboard\">Dashboard</a></li>";
				else echo "<li><a class=\"nav-ul-a\" href=\"/login\">Login</a></li>"
			?>
			<li><a class="nav-ul-a" href="/biofest">Bio-Fest 2020</a></li>
			<li><a class="nav-ul-a" href="/#events">Events</a></li>
			<li><a id="brochure" class="nav-ul-a" href="" target="_blank">Brochure</a></li>
			<!--li><a class="nav-ul-a" href="/#executive-comitee">Mentors</a></li-->
			<li><a class="nav-ul-a" href="/#testimonials">Testimonials</a></li>
			<li><a class="nav-ul-a" href="/#sponsors">Sponsors</a></li>
			<li><a class="nav-ul-a" href="/#about-us">About us</a></li>
		</ul>
		<div class="burger">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</nav>
	<!--- End Navigation -->
	
	<!--Start Home-->
	<a name="home">
		<!--- Start Slider -->
		<script>
			$(document).ready(function() {
				$('.slider').bxSlider({
					mode: 'fade',
					controls: false,
					auto: true,
					pager: false,
					responsive: true
				});
			});
		</script>
		<div class="slider">
			<div><img src="img/img-1.jpg"></div>
			<div><img src="img/img-2.jpg"></div>
			<div><img src="img/img-3.jpg"></div>
			<div><img src="img/img-4.jpg"></div>
			<div><img src="img/img-5.jpg"></div>
		</div>
		<!--- End Slider -->
	</a>
	<!--End Home-->

	<!--Start Parallax 1 Section-->
	<section class="parallax" id="parallax-intro">
		<div class="parallax-inner">
			<blockquote id="shankhnaad-intro">The blare of the conch shell, herald victory, embarking the start of a new venture, with this ethos, we the people of AITH welcome you to our sumptuous Annual Techno-Cultural and Literary fest. SHANKHNAAD. This will be a feast to your soul and mind. With all the novice celebration, it will be a memorable episode. With the adventure of treasure hunt, to the humor of stand-up comedy, and wrapped with the grace of soulful music, it will be an extravaganza experience. Do join us to celebrate your joy to the fullest and give a try to this happening occurrence.</blockquote>
		</div>
	</section>
	<!--End Parallax 1 Section-->

	<!--Start Events-->
	<a id="events" name="events">
		<!--Start Banner Wrapper For Events-->
		<div class="banner-wrapper">
			<h1>This Year's Events</h1>
			<section class="one-third">
				<img src="img/technical.jpg">
				<h3>Technical</h3>
				<p>Technology helps us to step into this new era with ease, and engineers are known as the wizard of technology. So a shout out to all the technocrats out there here, it is big feed for all of you as you'll get a blow of microflora art to PC gaming. Check your expertise with us and adore these festivities.</p>
				<a class="event-button" href="/events/technical/" target="_blank">See Technical Events</a>
				<!--button onclick="window.location.href = '/events/technical/';">See Events</button-->
			</section>
			<section class="one-third">
				<img src="img/literature.jpg">
				<h3>Literary</h3>
				<p>We all somewhere empty our way too filled mind with our artistic qualities hidden somewhere within us. So it's high time to do it more skillfully. Process, nothing much shows the grace of eloquent mindset and content you have, and that's it. Come with us to this beautiful expedition of model United Nation to mock-shashatkar and manifest your finesse.</p>
				<a class="event-button" href="events/literary/" target="_blank">See Literary Events</a>
				<!--button onclick="window.location.href = 'events/literary/'; window.location.target = '_blank';">See Events</button-->
			</section>
			<section class="one-third">
				<img src="img/cultural.jpg">
				<h3>Cultural</h3>
				<p>It will be very sketchy without a touch of music, dance and some adventure. So to give this trip an extra dose of happiness and enthusiasm, we present you the elegance of the cultural interlude. From classical dance to hip hop, it just contains each and everything to palliate you. So Gather to the arena and play a part in this delight.</p>
				<a class="event-button" href="/events/cultural/" target="_blank">See Cultural Events</a>
				<!--button onclick="window.location.href = 'events/cultural/';">See Events</button-->
			</section>
		</div>
		<!--End Banner Wrapper-->
	</a>
	<!--End Events-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clear-fix"></div>

	<!--Start Mentors-->
	<a id="executive-comitee" name="executive-comitee">
		<!--Start Banner Wrapper For Teams-->
		<div class="banner-wrapper">
			<h1>Executive Committee</h1>
			<div class="one-third">
				<img src="img/mentor-1.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Sri Nath Dwivedi<br>(Chairman CECA)</figcaption>
			</div>
			<div class="one-third">
				<img src="img/mentor-2.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Dr. Anuj Srivastva<br>(Cultural Convenor)</figcaption>
			</div>
			<div class="one-third">
				<img src="img/mentor-3.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Kapil Kumar Pandey<br>(Technical and Literary Convenor)</figcaption>
			</div>
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Teams-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start Testimonials-->
	<a id="testimonials" name="testimonials">
		<!--Start Banner Wrapper For Teams-->
		<div class="banner-wrapper">
			<div class="testimonial-section">
				<div class="inner-width">
					<h1>Testimonials</h1>
					<div class="testimonial-pics">
						<img src="img/test-1.jpg" alt="test-1" class="active">
						<img src="img/test-2.jpg" alt="test-2">
						<img src="img/test-3.jpg" alt="test-3">
					</div>

					<div class="testimonial-contents">
						<div class="testimonial active" id="test-1">
						<p>"The rate at which this college is enhancing makes me feel so proud. I am awestruck by these beautiful performances."</p>
						<span class="description">
							<h3 class="name">Prof. Vinay Kumar Pathak</h3>
							<h6>Vice Chancellor<br>AKTU, Lucknow</h6>
						</span>
						</div>

						<div class="testimonial" id="test-2">
						<p>"To see physically challenged students performing so well makes me astound. It was a memorable episode to experience."</p>
						<span class="description">
							<h3 class="name">Ira Singhal</h3>
							<h6>Deputy Commissionor<br>Nagar Nigam, North Delhi</h6>
						</span>
						</div>

						<div class="testimonial" id="test-3">
							<p>"To see this joyous gathering, even instrument beats are most elated. Thank you for the top musical experience and a wonderful night!"</p>
							<span class="description">
								<h3 class="name">Ankesh Jha</h3>
								<h6>Lead Singer<br>The Mixtape Band</h6>
						</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
    		$('.testimonial-pics img').click(function(){
        	$(".testimonial-pics img").removeClass("active");
        	$(this).addClass("active");
        	$(".testimonial").removeClass("active");
        	$("#"+$(this).attr("alt")).addClass("active");
      		});
    	</script>
		<!--End Banner Wrapper For Testimonials-->
	</a>
	<!--End Testimonials-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start Sponsors-->
	<a id="sponsors" name="sponsors">
		<!--Start Banner Wrapper For Sponsors-->
		<div class="banner-wrapper">
			<h1>Our Sponsors</h1>
			<img src="img/sponsors.jpg" alt="" width="60%" height="auto" class="image-center" id="img-sponsors">
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Sponsors-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start About Us-->
	<a id="about-us" name="aboutus">
		<!--Start Banner Wrapper-->
		<section class="left-col">
			<h1>About Us</h1>
			<p>Dr. Ambedkar Institute of Technology for Handicapped, Kanpur with the motto of "न दैन्यम् न पलायनम्" is again ready to bring along all of you and rejuvenate you with an extreme amount of pure happiness and ecstasy. The annual socio-cultural event Shankhnaad 2020 is waiting at your doorstep to incarnate the memories which last a lifetime.</p>
			<p>So, let us give ourselves this eternal essence of incredible human experience with an enchanting fusion of a three-day-long literary, musical, and artistic events and have an escape from all the bitterness in life. Embrace yourself for another cultural extravaganza.</p>
			<div class="quotation">
				<h4>"उठे जो स्वर तो अच्छा है,<br>पर उठे, आज धीमे ही सही,<br>मिलकर जो आएगी आवाज़,<br>तो गूंजेगा शंखनाद भी यहीं।"</h4>
			</div>
		</section>
		<section class="sidebar">
			<img id="img-college" src="img/college.jpg">
		</section>
		<!--End Banner Wrapper-->
	</a>
	<!--End About Us-->

	<div class="clearfix"></div>

	<!--Start Footer-->
	<footer>
		<div class="footer-content">
			<div class="col" id="main">
				<h3>Team</a></h3>
				<ul>
					<li><a href="#">Management</a></li>
					<li><a href="#">Developer</a></li>
					<li><a href="#">Content Creator</a></li>
				</ul>
				<br>
				<h3>Media</h3>
				<ul>
					<li><a id="footer-brochure" href="" target="_blank">Brochure</a></li>
					<li><a href="gallery.html" target="_blank">Gallery</a></li>
					<!--li><a href="#">After Movie</a></li-->
				</ul>
				<br>
				<h3>Contact Us</h3>
				<ul>
					<li><a href="mailto:shankhnaad@aith.ac.in" style="color: rgba(255,255,255,0.75);">shankhnaad@aith.ac.in</a></li>
					<!--li><li-->
				</ul>
				<br>
				<h3>Connect With US</h3>
				<div id="social-media-icons">
				<a class="fab fa-facebook-f" href="https://www.facebook.com/shankhnaadAITH" target="_blank"></a>
				<a class="fab fa-instagram" href="https://www.instagram.com/shankhnaadAITH/" target="_blank"></a>
				<a class="fab fa-youtube" href="https://www.youtube.com/shankhnaadAITH" target="_blank"></a>
			</div>
			</div>
			<div class="col" id="map">
				<iframe width="100%" height="100%" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped+(Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				<style>
					#gmap_canvas img {
						max-width: none !important;
						background: none !important
					}
				</style>
			</div>
		</div>
		<div id="footer-end-text">
			Developed by HumbleFool Club.<br>
			Copyright &copy; 2020 Shankhnaad. All rights reserved.<br><br>
			Dr. Ambedkar Institute Of Technology For Handicapped,<br>
			Awadhpuri, Kanpur - 208024
		</div>
	</footer>
</body>

</html>