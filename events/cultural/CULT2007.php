<?php
$loggedIn = false;
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    $loggedIn = true;
}
?>

<!DOCTYPE html>
<html lang="en" class="cultural">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/events-desc.css">
    <script defer src="/assets/scripts/events-desc.js"></script>
    <title>Shankhnaad'20 - Cultural Events</title>
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
            <div class="event-rules">
                <h4>Rules and Regulations</h4>
                <ul>
                    <li>Maximum of four members per team.</li>
                    <li>The Treasure Hunt consists of 8 clues, each one leading to the next clue. Each correctly solved clue carries 10 points. The final treasure gives 50 points.</li>
                    <li>The clues are to be found in a particular order. A team cannot skip a clue. Skipping a clue leads to the disqualification of the team.</li>
                    <li>Do not search for clues in off-limit areas.</li>
                    <li>If you found other team’s clue by any chance, never tamper it. A violation of this rule could cause the disqualification of your team.</li>
                    <li>You move any object to search the clue, kindly replace it.</li>
                    <li>All the clues of the teams are different and located at various places, but the final destination i.e., the treasure, is the same. The team which finds the treasure wins first.</li>
                    <li>Bikes are allowed (maximum 160CC)</li>
                    <li>The Management shall not be held responsible for any injury caused in the course of this event.</li>
                    <li>The use of expletives or aggressive behavior will result in immediate disqualification.</li>
                    <li>The Organizing Committee reserves the right to change the venue, time, and rules if desired.</li>
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