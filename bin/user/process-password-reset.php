<?php
    if(!isset($_POST['email']) || !isset($_POST['key']) || !isset($_POST['password']) || !isset($_POST['cpassword']))
        exit('UNAUTHORIZED_ACCESS');
    $response = validate($_POST['password'], $_POST['cpassword']);
    if($response != 'VALIDATED')
        exit($response);
    
    $email = $_POST['email'];
    $key = $_POST['key'];
    $password = $_POST['password'];

    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

    // Create a db instance
    $db = new Database();
    // Connect to db
    $userDB = $db->getUserDBConnection();
    //Create a new db instance
    $user = new User($userDB);
    // Set email
    $user->setEmail($email);
    // Set password
    $user->setPassword($password);
    // Only update Password if Email and Hash combo matches
    if($user->checkEmailAndHash($email, $key) && $user->updatePasswordInDB())
        exit('PASSWORD_CHANGED');
    exit('SERVER_ERROR');

    // Function to validate if email is in correct format or not
    function validate($password, $cpassword){
        // Check for any empty field
        if(strlen($password) <= 0 || strlen($cpassword) <= 0){
            return 'EMPTY_FIELDS';
        }
        // Validate password
        if(strlen($password) < 5 || strlen($password) > 15){
            return 'INVALID_PASSWORD_SIZE';
        }
        if($password != $cpassword){
            return 'PASSWORDS_DO_NOT_MATCH';
        }
        // Everything is validated
        return 'VALIDATED';
    }
?>