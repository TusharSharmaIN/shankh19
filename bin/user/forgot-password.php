<?php
    //https://shankhnaad.org/bin/user/forgot-password?email=EMAIL_ADDRESS
    // If link is opened with a GET parameter 'email'
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        // Validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            exit('INVALID_EMAIL_FORMAT');
        }

        // Include dependencies
        include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

        // Create a db instance
        $db = new Database();
        // Connect to user's db
        $userDB = $db->getUserDBConnection();
        // Create a User's instance
        $user = new User($userDB);
        // Set email
        $user->setEmail($email);
        $response = $user->sendPasswordResetEmail();
        exit($response);
    }
    else{
?>
<html>
    <head><title>Forgot Password</title></head>
    <body>
        <input type = "text" placeholder = "Enter your email" id = "email" name = "email" autocomplete="email">
        <input type = "button" id = "submit-btn" name = "submit" value = "Submit">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type = "text/javascript">
            $(document).ready(function(){
                $("#submit-btn").on('click', function(){
                    var email = $("#email").val();
                    //AJAX request for signin form
                    $.ajax(
                        {
                            url: 'forgot-password',
                            method: 'GET',
                            dataType: 'text',
                            data: {
                                email: email,
                            },
                            success: function(response){
                                console.log(response);
                            }
                        }
                    );
                });
            });
        </script>
    </body>
</html>

<?php
}
?>