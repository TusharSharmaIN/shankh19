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
                <p>It is a typical application and practical approach to fluid mechanics.</p>
            </div>
            <div class="event-criteria">
                <h4>Judging Criteria</h4>
                <ul>
                    <li>The team which puts maximum cubes in a basket in a limited time will be regarded as the winner.</li>
                </ul>
            </div>
            <div class="event-rules">
                <h4>Rules and Regulations</h4>
                <ul>
                    <li>The competition s open to all the students.</li>
                    <li>EEach team has a maximum of four members.</li>
                    <li>Competition of putting cubes in the basket.</li>
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