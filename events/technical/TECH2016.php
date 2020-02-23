<?php
$loggedIn = false;
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    $loggedIn = true;
}
?>

<!DOCTYPE html>
<html lang="en" class="technical">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/events-desc.css">
    <script defer src="/assets/scripts/events-desc.js"></script>
    <title>Shankhnaad'20 - Technical Events</title>
</head>

<body>
    <!--- Start Navigation -->
    <nav>
        <div class="nav-logo">
            <img src="/img/shankh-black.svg">
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
    <section class="event-desc">
        <div class="event-desc-container">
            <div>
                <h2 class="event-name"></h2>
                <div class="event-venue">
                </div>
            </div>
            <div class="event-intro">
                <h4>Introduction</h4>
                <p>We are lucky enough to be born in era where hovercrafts are a thing, there is no other such vehicle as stylish, royal, thrilling to be rode on, maybe you have watched in movies an adventurous ride on Hovercraft by the protagonist. Now its time to witness in the real miniature world with your own model!<br>
                    With your hovercrafts ready on the start line, it is time to test the best master slave pair. Can you command your machine to travel over the difficult terrain we have set for it in the minimum time possible?
                </p>
            </div>
            <div class="event-intro">
                <h4>Problem Statement</h4>
                <p>Build a wireless remote controlled hovercraft (air cushion vehicle) which travels on various terrains like sand, mud, water, gravel and concrete and complete the specified track in the least possible time.</p>
            </div>
            <div class="event-criteria">
                <h4>Judging Criteria</h4>
                <ul>
                    <li><strong>Round 1:</strong><br><br>
                        Teams have to make their way to the top-15 best lap time. The lap time will be calculated as follows:<br><br>
                        Lap time = t + 2*n<br><br>
                        Where t is actual time taken to complete the track.<br><br>
                        n is no. of times the hovercraft is realigned on the track.</li><br>
                    <li><strong>Round 2:</strong><br><br>
                        The first to cross the finish line wins.<br><br>
                        The decision of the event coordinators will be bounding in case of any conflicts.</li>


                </ul>
            </div>
            <div class="event-rules">
                <h4>Rules and Regulations</h4>
                <ul>
                    <li>Length: 30 to 50 cm’s</li>
                    <li>Breadth: 20 to 30 cm’s</li>
                    <li>Height: no restriction</li>
                    <li>Maximum number of participants per team is 4</li>
                    <li>Ready to use kits and readymade building kits are strictly prohibited.</li>
                    <li>No limitation on the number of motors or type of motors or servos used.</li>
                    <li>During the event only one member per team is allowed to run the hovercraft.</li>
                    <li>The arena is subject to changes during the event depending on level of participation.</li>
                    <li>Event coordinators reserve the exclusive rights to disqualify any team indulging in misbehavior</li>

                </ul>
            </div>
            <button class="event-register-btn">Register</button>
        </div>
    </section>
    <div class="overlay"></div>
    <div class="dialog">
        <h2>Confirm registration</h2>
        <p>By clicking on the <strong>confirm</strong> button you agree to participate in the event and accept all the rules and regulations of this event.</p>
        <div class="dialog-btn-container">
            <button id="dialog-confirm-btn">Confirm</button>
            <button id="dialog-cancel-btn">Cancel</button>
        </div>
    </div>
    <!--Start Footer-->
    <footer>
        Developed by HumbleFool.<br>
        Copyright &copy; 2020 Shankhnaad. All rights reserved.<br>
        Contact - shankhnaad@aith.ac.in
    </footer>
    <!--End Footer-->
    <div class="alert"></div>
</body>

</html>