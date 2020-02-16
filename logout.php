<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
    // unset session variables
    session_unset();
    // destroy the session
    session_destroy();
}
?>

<!-- <h1 style = "display: flex; justify-content: center; align-items: center; text-transform: uppercase; font-family: 'Poppins', sans-serif; letter-spacing: 10px;
    font-size: 48px;">You've been logged out successfully</h1> -->

<?php
// Redirect user to login page
// header('Location: login.php');
return 'SUCCESS';
?>