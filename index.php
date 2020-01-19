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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/6c05aa3d79.js" crossorigin="anonymous"></script>
	<script defer src="/assets/scripts/index.js"></script>
	<link rel="shortcut icon" type="image/png" href="img/shankh-black.png" />
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
			<li><a class="nav-ul-a" href="/#events">Events</a></li>
			<li><a id="brochure" class="nav-ul-a" href="" target="_blank">Brochure</a></li>
			<li><a class="nav-ul-a" href="/#mentors">Mentors</a></li>
			<li><a class="nav-ul-a" href="/#teams">Team</a></li>
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
			<div><img src="img/img-1.png"></div>
			<div><img src="img/img-2.png"></div>
			<div><img src="img/img-3.png"></div>
			<div><img src="img/img-4.png"></div>
		</div>
		<!--- End Slider -->
	</a>
	<!--End Home-->

	<!--Start Events-->
	<a id="events" name="events">
		<!--Start Banner Wrapper For Events-->
		<div id="banner-wrapper">
			<h1>This year Events</h1>
			<section class="one-third">
				<img src="img/cultural.jpg">
				<h3>Cultural</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam consequuntur iste est quasi magnam sequi vitae optio aspernatur ducimus eveniet fugit, inventore reprehenderit itaque. Dolores perspiciatis quibusdam praesentium quam sed!</p>
			</section>
			<section class="one-third">
				<img src="img/literature.jpg">
				<h3>Literature</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam consequuntur iste est quasi magnam sequi vitae optio aspernatur ducimus eveniet fugit, inventore reprehenderit itaque. Dolores perspiciatis quibusdam praesentium quam sed!</p>
			</section>
			<section class="one-third">
				<img src="img/technical.jpg">
				<h3>Technical</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam consequuntur iste est quasi magnam sequi vitae optio aspernatur ducimus eveniet fugit, inventore reprehenderit itaque. Dolores perspiciatis quibusdam praesentium quam sed!</p>
			</section>
		</div>
		<!--End Banner Wrapper-->
	</a>
	<!--End Events-->

	<div class="clearfix"></div>

	<!--Start Parallax 1 Section-->
	<section class="parallax-1">
		<div class="parallax-inner">
			<section class="one-one">
				<h3>Content Heading</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis porro asperiores culpa ipsum illo soluta ipsam omnis, doloribus minus amet sint consequuntur facilis magni nulla. Similique, ipsa repellat. Laboriosam, sit.</p>
			</section>
		</div>
	</section>
	<!--End Parallax 1 Section-->

	<div class="clear-fix"></div>

	<!--Start Mentors-->
	<a id="mentors" name="mentors">
		<!--Start Banner Wrapper For Teams-->
		<div id="banner-wrapper">
			<h1>Mentors</h1>
			<div class="one-third">
				<h3 class="sub-heading">Mentor 1</h3>
				<img src="img/mentor-1.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Dr. Anuj Srivastva<br>(Cultural Convenor)</figcaption>
			</div>
			<div class="one-third">
				<h3 class="sub-heading">Mentor 2</h3>
				<img src="img/man.png" alt="" width="100px" height="auto">
				<figcaption>Kapil Kumar Pandey<br>(Technical and Literary Convenor)</figcaption>
			</div>
			<div class="one-third">
				<h3 class="sub-heading">Mentor 3</h3>
				<img src="img/man.png" alt="" width="100px" height="auto">
				<figcaption>Sri Nath Dwivedi<br>(Chairman CECA)</figcaption>
			</div>
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Teams-->

	<div class="clearfix"></div>

	<!--Start Parallax 2 Section-->
	<section class="parallax-2">
		<div class="parallax-inner">
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
		</div>
	</section>
	<!--End Parallax 2 Section-->

	<div class="clearfix"></div>

	<!--Start Teams-->
	<a id="teams" name="teams">
		<!--Start Banner Wrapper For Teams-->
		<div id="banner-wrapper">
			<h1>Teams</h1>
			<div class="one-half">
				<h3>Team 1</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsam eum illum laborum adipisci harum praesentium, doloremque quas reprehenderit aspernatur dolores non nam alias cupiditate labore. Quae, est libero! Enim?</p>
			</div>
			<div class="one-half">
				<h3>Team 2</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsam eum illum laborum adipisci harum praesentium, doloremque quas reprehenderit aspernatur dolores non nam alias cupiditate labore. Quae, est libero! Enim?</p>
			</div>
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Teams-->

	<div class="clearfix"></div>

	<!--Start Parallax 2 Section-->
	<section class="parallax-2">
		<div class="parallax-inner">
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
		</div>
	</section>
	<!--End Parallax 2 Section-->

	<div class="clearfix"></div>

	<!--Start Sponsors-->
	<a id="sponsors" name="sponsors">
		<!--Start Banner Wrapper For Sponsors-->
		<div id="banner-wrapper">
			<h1>Sponsors</h1>
			<div class="one-half">
				<h3>Sponsor 1</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsam eum illum laborum adipisci harum praesentium, doloremque quas reprehenderit aspernatur dolores non nam alias cupiditate labore. Quae, est libero! Enim?</p>
			</div>
			<div class="one-half">
				<h3>Sponsor 2</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsam eum illum laborum adipisci harum praesentium, doloremque quas reprehenderit aspernatur dolores non nam alias cupiditate labore. Quae, est libero! Enim?</p>
			</div>
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Sponsors-->

	<div class="clearfix"></div>

	<!--Start Parallax 3 Section-->
	<section class="parallax-3">
		<div class="parallax-inner">
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
			<section class="one-third">
				<h3>Heading title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, veritatis autem est sapiente consequuntur eum officia enim ratione laudantium reprehenderit sed officiis ipsa delectus nobis dicta voluptate. Tempora, possimus consectetur.</p>
			</section>
		</div>
	</section>
	<!--End Parallax 3 Section-->

	<div class="clearfix"></div>

	<!--Start About Us-->
	<a id="about-us" name="aboutus">
		<!--Start Banner Wrapper-->
		<section class="left-col">
			<h1>About Us</h1>
			<p>Dr. Ambedkar Institute of Technology for Handicapped, Kanpur with the motto of "न दैन्यम् न पलायनम्" is again ready to bring along all of you and rejuvenate you with an extreme amount of pure happiness and ecstasy. The annual socio-cultural event Shankhnaad 2020 is waiting at your doorstep to incarnate the memories which last a lifetime.</p>
			<p>So, let us give to ourselves this everlasting essence of incredible human experience with an enchanting fusion of a 3 day long literary, musical and artistic events and have an escape from all the bitterness in life. Embrace yourself for another cultural extravaganza.</p>
			<div class="quotation">
				<h4>"उठे जो स्वर तो अच्छा है,<br>पर उठे, आज धीमे ही सही,<br>मिलकर जो आएगी आवाज़,<br>तो गूंजेगा शंखनाद भी यहीं।"</h4>
			</div>
		</section>
		<section class="sidebar">
			<img src="img/college.jpg">
		</section>
		<!--End Banner Wrapper-->
	</a>
	<!--End About Us-->

	<div class="clearfix"></div>

	<!--Start Footer-->
	<footer>
		<div id="map">
			<iframe width="100%" height="100%" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped+(Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				<style>
					#gmap_canvas img {
						max-width: none !important;
						background: none !important
					}
				</style>
		</div>
		<div id="footer-text">
			Developed by HumbleFool.<br>
			Copyright &copy; 2020 Shankhnaad. All rights reserved.<br>
			Contact - shankhnaad@aith.ac.in
			<div id="social-media-icons">
				<a class="fab fa-facebook-f" href="https://www.facebook.com/shankhnaadAITH" target="_blank"></a>
				<a class="fab fa-instagram" href="https://www.instagram.com/shankhnaadAITH/" target="_blank"></a>
				<a class="fab fa-youtube" href="https://www.youtube.com/shankhnaadAITH" target="_blank"></a>
			</div>
		</div>
	</footer>
</body>

</html>