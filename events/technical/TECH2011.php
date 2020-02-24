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
                <p>Design a manually controlled ROBOT wired or wireless within a specified dimension mentioned as below. The ROBOT that will demolish the other robot in minimum time or minimum parts damaged by the robot will be the winner.</p>
            </div>
            <div class="event-phase">
                <h4>Category 1</h4>
                <ul>
                    <li>In this category robots, up-to 8 kg will compete.</li>
                    <li>It will be knockout round, and only one team will be a winner in this category.</li>
                </ul>
            </div>
            <div class="event-phase">
                <h4>Category 2</h4>
                <ul>
                    <li>In this category robots, up-to 15 kg will compete.</li>
                    <li>It will be knockout round, and only one team will be a winner in this category.</li>
                </ul>
            </div>
            <div class="event-specs">
                <h4>Arena Specifications</h4>
                <ul>
                    <li>The first round of the war will be in a closed arena.</li>
                    <li>The second round of the war will be on the rectangular based closed arena.</li>
                    <li>The third round of the war will be on the rectangular based closed arena, and the dimension for the rectangular arena will be 250*180(cm).</li>
                </ul>
            </div>
            <div class="event-criteria">
                <h4>Judging Criteria</h4>
                <ul>
                    <li>War will be held in three rounds and each round has 10 minutes.</li>
                    <li>The aim of every match is to demolish and immobile the other robot completely.</li>
                </ul>
            </div>
            <div class="event-rules">
                <h4>Rules and Regulations</h4>
                <ul>
                    <li>Each team has to make their robots under the specifications given below.</li>
                    <li>Each team can have a maximum of 5 members. Students from different institutes can form a team.</li>
                    <li>No practice will be allowed in the arena.</li>
                    <li>The robot should not damage the arena else it will lead to a penalty.</li>
                    <li>Each member of the team must have an identity card of his /her respective institute.</li>
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