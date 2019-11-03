<?php
    // If link is opened with email and key combo
    if(!isset($_GET['email']) || !isset($_GET['key']))
        exit('INVALID_LINK');
    
    // Include dependencies
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

    $email = $_GET['email'];
    $key = $_GET['key'];

    // Check email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Email provided in the link is invalid
        exit('INVALID_EMAIL_FORMAT');
    }

    // Create a db instance
    $db = new Database();
    // Connect to db
    $userDB = $db->getUserDBConnection();
    // Create a User's instance
    $user = new User($userDB);
    // Set email
    $user->setEmail($email);
    // Check if email and key combo matches against the DB
    if(!$user->checkEmailAndHash($email, $key))
        exit('INVALID_KEY');
    
    // Display reset password form
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reset Password</title>
        <noscript>
            <h1 style = "text-align = center">Your browser does not support JavaScript. You will not be able to use this website.</h1>
        </noscript>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
        <link rel = "stylesheet" href = "/assets/css/reset-password.css">
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    </head>
    <body>
        <div class = 'block-form'></div>
        <div class = "lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <form class="box">
            <h1>Reset password for <?php echo $email; ?></h1>
            <input id = "password" type = "password" placeholder = "New Password">
            <input id = "cpassword" type = "password" placeholder = "Confirm Password">
            <div class = "result"></div>
            <input id = "submit-btn" type = "button" value = "Submit">
        </form>
    </body>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "/assets/scripts/reset-password.js"></script>
    <script type = "text/javascript">
        <!--
        $(document).ready(function(){
            $("#submit-btn").on('click', function(){
                if(validate()){
                    var email = '<?php echo $user->getEmail(); ?>';
                    var key = '<?php echo $key; ?>';
                    var password = $("#password").val();
                    var cpassword = $("#cpassword").val();
                    //AJAX request for signin form
                    $.ajax(
                        {
                            url: '/bin/user/process-password-reset',
                            method: 'POST',
                            dataType: 'text',
                            data: {
                                email: email,
                                key: key,
                                password: password,
                                cpassword: cpassword
                            },
                            beforeSend: function(){
                                //Show loader before sending ajax request
                                $('.block-form').show();
                                $('.lds-grid').css('display', 'inline-block');
                            },
                            success: function(response){
                                //Hide loader after receiving request
                                $('.lds-grid').hide();
                                $('.block-form').fadeOut();
                                //Empty passwords after form submission
                                $("#password").val('');
                                $("#cpassword").val('');
                                var result = $(".result");
                                if(response == 'PASSWORD_CHANGED'){
                                    result[0].style.visibility = 'visible';
                                    result[0].style.backgroundColor = "#b2dbb2";
                                    result[0].style.borderColor = "green";
                                    result[0].style.color = "darkgreen";
                                    result[0].innerHTML = "<p>Passwords changed successfully. Click <a href = 'https://shankhnaad.org/login'>here</a> to login!</p>";
                                }
                                else if(response == 'EMPTY_FIELDS'){
                                    result[0].style.visibility = 'visible';
		                            result[0].innerHTML = "<p>Password(s) cannot be empty!</p>";
                                }
                                else if(response == 'PASSWORDS_DO_NOT_MATCH'){
                                    result[0].style.visibility = 'visible';
			                        result[0].innerHTML = "<p>Passwords do not match!</p>";
                                }
                                else if(response == 'INVALID_PASSWORD_SIZE'){
                                    result[0].style.visibility = 'visible';
		                            result[0].innerHTML = "<p>Password must be between 5 to 15 characters long!</p>";
                                }
                                else{
                                    //Server error
                                    result[0].style.visibility = 'visible';
			                        result[0].innerHTML = "<p>Oops. Something went wrong. Please try again later.</p>";
                                }
                            }
                        }
                    );
                }
            });
        }); 
        //-->
    </script>
</html>