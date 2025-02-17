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
                <p>The ultimate face-off open for all expert coders and code enthusiasts. It is a three-phase round in which participants will code for a given problems statements. The participants who will clear the first two phases and will solve the problem in minimum time in the third phase by clearing all the test cases will be the winner.</p>
            </div>
            <div class="event-phase">
                <h4>Phase 1</h4>
                <ul>
                    <li>This phase will contain 5 coding problems of the beginner level.</li>
                    <li>The participants who will solve 3 problems by satisfying all respective test cases will clear the round and will attempt the next phase.</li>
                </ul>
            </div>
            <div class="event-phase">
                <h4>Phase 2</h4>
                <ul>
                    <li>This phase will contain 3 coding problems of medium level.</li>
                    <li>The participants who will solve 2 problems by satisfying all respective test cases will clear the round and will attempt the next phase.</li>
                </ul>
            </div>
            <div class="event-phase">
                <h4>Phase 3</h4>
                <ul>
                    <li>This phase will contain 2 coding problems of the hard level.</li>
                    <li>The participants who will solve 1 problem by satisfying all respective test cases will clear the round and will attempt the next phase.</li>
                </ul>
            </div>
            <div class="event-criteria">
                <h4>Judging Criteria</h4>
                <ul>
                    <li>The team which solves a problem the fastest will get a better multiplier.</li>
                    <li>The total score will be calculated by multiplying the number of test cases successfully run multiplied by the multiplier.</li>
                    <li>If the total score of two teams are equal, then the team with a greater number of problem statements attempted will be prioritized.</li>
                </ul>
            </div>
            <div class="event-rules">
                <h4>Rules and Regulations</h4>
                <ul>
                    <li>It will be a solo event based on pure coding.</li>
                    <li>Each participants is allowed to carry a sheet and pen with them.</li>
                    <li>Disturbing other participants and arguing with the coordinators may result in disqualification.</li>
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