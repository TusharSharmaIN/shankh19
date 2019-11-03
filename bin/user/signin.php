<?php
    /**
     * Understanding response
     *  1. CREDENTIALS_VALID: User has provided valid credentials and email is verified
     *  2. CREDENTIALS_INVALID: Either email, password, or both are invalid
     *  3. EMAIL_VERIFIED: User has provided valid credentials and email is verified in both DB and SES
     *  4. EMAIL_NOT_VERIFIED_IN_SES: User has provided valid credentials but email is not verified in both DB and AWS SES
     *  5. EMAIL_NOT_VERIFIED_IN_DB: User has provided valid credentials and email is verified in AWS SES but not in DB
     */

    // Include dependencies
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

    // Check if post has data
    if(isset($_POST['email']) && isset($_POST['password'])){
        // Google recaptcha server script
        // Get secret key from greconfig.php file
        require $_SERVER['DOCUMENT_ROOT'] . '/../config/greconfig.php';
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $response = json_decode($response);
        // Only proceed when recaptcha is verified
        if($response->success){
            // Create a db instance
            $db = new Database();
            // Connect to user's db
            $userDB = $db->getUserDBConnection();
            
            // Create a user instance
            $user = new User($userDB);

            // Get user data from sign up form
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);

            // Try to login the user
            $response = $user->login();
            
            if($response == 'CREDENTIALS_VALID'){
                // Start a session
                session_start();
                // Set session variables
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['fname'] = $user->getFName();
                $_SESSION['lname'] = $user->getLName();
                exit('SIGNIN_SUCCESS');
            }
            else if($response == 'CREDENTIALS_INVALID'){
                //User has provided either invalid credentials or is not registered
                exit('SIGNIN_FAILED');
            }
            else if($response == 'EMAIL_NOT_VERIFIED_IN_SES'){
                //Ask user to verify the email and offer an email resend link
                exit('EMAIL_NOT_VERIFIED');
            }
            else{
                //Server error
                exit('SERVER_ERROR');
            }
        }
        else{
            // Recaptcha verification failed
            exit('RECAPTCHA_FAILED');
        }
    }
    else{
        // User has not submitted form
        exit('FORM_NOT_SUBMITTED');
    }
?>
