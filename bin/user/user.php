<?php

/**
 * Understanding response
 *  1. CREDENTIALS_VALID: User has provided valid credentials and email is verified
 *  2. CREDENTIALS_INVALID: Either email, password, or both are invalid
 *  3. EMAIL_VERIFIED: User has provided valid credentials and email is verified in both DB and SES
 *  4. EMAIL_NOT_VERIFIED_IN_SES: User has provided valid credentials but email is not verified in both DB and AWS SES
 *  5. EMAIL_NOT_VERIFIED_IN_DB: User has provided valid credentials and email is verified in AWS SES but not in DB
 */

//Include SesApi
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/api/SesApi.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';

class User
{
    // database connection
    private $conn;
    // Table names in user's db
    private $login_credentials = "Login_Credentials";
    private $user_per_details = "User_Personal_Details";
    private $user_clg_details = "User_College_Details";
    private $user_evt_details = "User_Event_Details";

    // object properties
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $active;
    private $created;
    private $hash;

    // Constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Getters
    public function getFName()
    {
        return $this->fname;
    }

    public function getLName()
    {
        return $this->lname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCreated()
    {
        return $this->created;
    }

    // Setters
    public function setFName($fname)
    {
        $this->fname = $fname;
    }

    public function setLName($lname)
    {
        $this->lname = $lname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    // Function to signup the user
    public function signup()
    {
        if ($this->doesAlreadyExist()) {
            return 'USER_ALREADY_EXIST';
        }

        // Query to insert record
        $query = "INSERT INTO " . $this->login_credentials . "(Email, Password, Active, Created, Hash) VALUES(:email, :password, 0, :created, :hash)";
        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Sanitize form data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));

        // Generate a random and unique sha512 hash for the user
        $this->hash = hash('sha512', strval(rand(10, 10000)) . $this->email);

        // Pass password through the hash function
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind values
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":hash", $this->hash);

        // Execute query
        if ($stmt->execute()) {
            // Send an email verification link
            $ses = new SesApi();
            if ($ses->sendCustomVerificationEmail($this->email, 'template-email-verification')) {
                // Query to insert email, fname and lname into records table
                $per_query = "INSERT INTO " . $this->user_per_details . "(Email, First_Name, Last_Name) VALUES(:email, :fname, :lname)";
                $clg_query = "INSERT INTO " . $this->user_clg_details . "(Email) VALUES(:email)";
                $evt_query = "INSERT INTO " . $this->user_evt_details . "(Email) VALUES(:email)";
                // Prepare query
                $per_stmt = $this->conn->prepare($per_query);
                $clg_stmt = $this->conn->prepare($clg_query);
                $evt_stmt = $this->conn->prepare($evt_query);
                // Bind values
                $per_stmt->bindParam(":email", $this->email);
                $per_stmt->bindParam(":fname", $this->fname);
                $per_stmt->bindParam(":lname", $this->lname);
                $clg_stmt->bindParam(":email", $this->email);
                $evt_stmt->bindParam(":email", $this->email);
                if ($per_stmt->execute() == false || $clg_stmt->execute() == false || $evt_stmt->execute() == false)
                    return 'SIGNUP_FAILED';
                else
                    return 'SIGNUP_SUCCESS';
            }
        }
        return 'SIGNUP_FAILED';
    }

    // Function to login the user
    public function login()
    {
        // Sanitize form data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        /* Get user's unique hash */
        $query = "SELECT Email, Password FROM " . $this->login_credentials . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();
        if ($result == false) {
            // No rows has been sent by DB
            return 'CREDENTIALS_INVALID';
        }

        // Check if password matched or not

        if (!password_verify($this->password, $result['Password'])) {
            // Password didn't matched
            return 'CREDENTIALS_INVALID';
        }
        // Check if email is verified or not
        $response = $this->isEmailVerified();
        if ($response == 'EMAIL_NOT_VERIFIED_IN_SES') {
            // User has not verified the email yet
            return $response;
        }
        if ($response == 'EMAIL_NOT_VERIFIED_IN_DB') {
            // Update Active to 1 in DB
            $update_query = "UPDATE " . $this->login_credentials . " SET Active=1 WHERE Email='" . $this->email . "'";
            // Prepare query statement
            $stmt = $this->conn->prepare($update_query);
            // Execute query
            $stmt->execute();
            //Active has been updated to 1
        }
        // Get user's name
        $query = "SELECT First_Name, Last_Name FROM " . $this->user_per_details . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();
        if ($result == false) {
            // Error in DB
            return 'DB_ERROR';
        }
        $this->fname = $result['First_Name'];
        $this->lname = $result['Last_Name'];
        // User can login now
        return 'CREDENTIALS_VALID';
    }

    // Function to check if the user already exist in db or not
    public function doesAlreadyExist()
    {
        $query = "SELECT Email FROM " . $this->login_credentials . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();
        // If nothing is returned, $result will be false
        if ($result == false)
            return false;
        return true;
    }

    // Function to check if the user's email is verified or not
    public function isEmailVerified()
    {
        $query = "SELECT Active FROM " . $this->login_credentials . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();

        if ($result['Active'] == '0') {
            // Email is not verified in DB check with SES
            $ses = new SesApi();
            if ($ses->isEmailVerified($this->email)) {
                // Email is verified in SES need an update in DB
                return 'EMAIL_NOT_VERIFIED_IN_DB';
            } else {
                //Ask user to verify email or offer a resend link
                return 'EMAIL_NOT_VERIFIED_IN_SES';
            }
        } else {
            // Email is verified in both DB and SES
            return 'EMAIL_VERIFIED';
        }
    }

    // Function to resend verification email for the user only if user has not verified his email yet
    public function resendVerificationEmail()
    {
        // Check if email exist or not
        $query = "SELECT Email FROM " . $this->login_credentials . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        $result = $stmt->fetch();
        // If no row has been returned
        if ($result == false)
            return 'EMAIL_DOES_NOT_EXIST';

        // Check if email is verified or not
        $response = $this->isEmailVerified();
        if ($response == 'EMAIL_NOT_VERIFIED_IN_SES') {
            // User has not verified the email yet
            // Send an email verification link
            $ses = new SesApi();
            if ($ses->sendCustomVerificationEmail($this->email, 'template-email-verification'))
                return 'EMAIL_SENT';
            else
                return 'SERVER_ERROR';
        }
        if ($response == 'EMAIL_NOT_VERIFIED_IN_DB') {
            // Update Active to 1 in DB
            $update_query = "UPDATE " . $this->login_credentials . " SET Active=1 WHERE Email='" . $this->email . "'";
            // Prepare query statement
            $stmt = $this->conn->prepare($update_query);

            // Execute query
            $stmt->execute();
            //Active has been updated to 1
        }
        return 'EMAIL_ALREADY_VERIFIED';
    }

    // Function to set password reset link on email
    function sendPasswordResetEmail()
    {
        //Check if email exist or not
        if (!$this->doesAlreadyExist())
            return 'EMAIL_DOES_NOT_EXIST';
        // Check if email is verified or not
        $response = $this->isEmailVerified();
        if ($response == 'EMAIL_NOT_VERIFIED_IN_SES')
            return 'EMAIL_NOT_VERIFIED';
        // Get user's Hash from DB
        $this->setHashFromDB();
        // Send an email having password reset link
        $ses = new SesApi();
        //if($ses->sendEmail('no-reply@shankhnaad.org', array($this->email), 'Reset your password', 'Click <a href = "https://shankhnaad.org/bin/user/reset-password?email=' . $this->email . '&key=' . $this->hash . '">here</a> to reset your password.', 'Password reset link: '))
        if ($ses->sendEmailUsingPHPMailer('no-reply@shankhnaad.org', 'Shankhnaad\'19', $this->email, 'Reset your password', 'Click <a href = "https://shankhnaad.org/bin/user/reset-password?email=' . $this->email . '&key=' . $this->hash . '">here</a> to reset your password.', 'Password reset link: '))
            return 'EMAIL_SENT';
        return 'SERVER_ERROR';
    }

    // Function to check whether email matches with hash value or not
    function checkEmailAndHash($email, $hash)
    {
        // Check if email and hash combo exist or not
        $query = "SELECT Email, Hash FROM " . $this->login_credentials . " WHERE Email='" . $email . "' AND Hash='" . $hash . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        $result = $stmt->fetch();
        // If no row has been returned
        if ($result == false)
            return false;
        return true;
    }

    // Function to set hash from DB
    function setHashFromDB()
    {
        // Check if email exist or not
        $query = "SELECT Email, Hash FROM " . $this->login_credentials . " WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        $result = $stmt->fetch();
        // If no row has been returned i.e., email does not exist
        if ($result == false)
            return false;
        $this->hash = $result['Hash'];
        return true;
    }

    // Function to update a user's hash in DB
    function updateHashInDB()
    {
        // Generate a random and unique sha512 hash for the user
        $this->hash = hash('sha512', strval(rand(10, 10000)) . $this->email);
        // Update Hash in DB
        $update_query = "UPDATE " . $this->login_credentials . " SET Hash=:hash WHERE Email='" . $this->email . "'";
        // Prepare query statement
        $stmt = $this->conn->prepare($update_query);
        $stmt->bindParam(":hash", $this->hash);
        // Execute query
        if ($stmt->execute() == false)
            return false;
        // Hash has been updated
        return true;
    }

    // Function to change the user's password in DB
    function updatePasswordInDB()
    {
        // Query to update password
        $query = "UPDATE " . $this->login_credentials . " SET Password=:password WHERE Email='" . $this->email . "'";
        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Pass the password through the hash function
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind values
        $stmt->bindParam(":password", $this->password);

        // Update hash in DB so that next time previous reset link will not work
        if (!$this->updateHashInDB())
            return false;
        // Execute query
        if ($stmt->execute() == false)
            return false;

        return true;
    }

    // Function to check if the user has filled all details or not
    function hasFilledDetailsForm()
    {
        // Query to update password
        $query = "SELECT Gender FROM " . $this->user_per_details . " WHERE Email='" . $this->email . "'";
        // Prepare query
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        $result = $stmt->fetch();

        // If no row has been returned i.e., email does not exist
        if ($result == false)
            return false;
        if ($result['Gender'] == NULL)
            return false;
        return true;
    }

    // Function to update user details in DB (It will be called when user enters details in first time dashboard)
    function updateUserDetails($phone, $altPhone, $dob, $gender, $address, $clgName, $rollNumber, $yearOfStudy, $branch, $clgCity)
    {
        // Only proceed if user has not filled details form yet
        if (!$this->hasFilledDetailsForm()) {
            // Query to insert user personal details
            if ($altPhone == "") // If alternate phone number is not provided
                $per_query = "UPDATE " . $this->user_per_details . " SET Gender=:gender, DOB=:dob, Address=:address, Contact_No=:phone";
            else
                $per_query = "UPDATE " . $this->user_per_details . " SET Gender=:gender, DOB=:dob, Address=:address, Contact_No=:phone, Alternate_No=:altPhone";
            $per_query = $per_query . " WHERE Email='" . $this->email . "'";

            // Query to insert user college details
            if ($rollNumber == "") // If roll number is not provided
                $clg_query = "UPDATE " . $this->user_clg_details . " SET Branch=:branch, Year=:year, College_Name=:clgName, College_City=:clgCity";
            else
                $clg_query = "UPDATE " . $this->user_clg_details . " SET Branch=:branch, Year=:year, College_Name=:clgName, College_City=:clgCity, Roll_Number=:rollNumber";
            $clg_query = $clg_query . " WHERE Email='" . $this->email . "'";

            // Prepare query
            $per_stmt = $this->conn->prepare($per_query);
            $clg_stmt = $this->conn->prepare($clg_query);

            // Bind values
            $per_stmt->bindParam(":gender", $gender);
            $per_stmt->bindParam(":dob", $dob);
            $per_stmt->bindParam(":address", $address);
            $per_stmt->bindParam(":phone", $phone);
            if ($altPhone != "")
                $per_stmt->bindParam(":altPhone", $altPhone);
            $clg_stmt->bindParam(":branch", $branch);
            $clg_stmt->bindParam(":year", $yearOfStudy);
            $clg_stmt->bindParam(":clgName", $clgName);
            $clg_stmt->bindParam(":clgCity", $clgCity);
            if ($rollNumber != "")
                $clg_stmt->bindParam(":rollNumber", $rollNumber);

            if ($per_stmt->execute() == false || $clg_stmt->execute() == false)
                return false;
            else
                return true;
        } else
            return false;
    }

    // Function to return all event details the user is registered to
    public function getAllEvents()
    {
        // Query to get all EIDs the user has registered to
        $query1 = "SELECT EID FROM User_Event_Details WHERE Email=\'" . $this->email . "\';";
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        // Get all EIDs as an array of strings
        $eidArray = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        $eids = $eidArray;
        foreach ($eids as &$str) {
            $str = str_replace($str, "EID='" . $str . "'", $str);
        }
        $joinedEID = join(" OR ", $eids);

        // Create a db instance
        $db = new Database();
        // Create an admin DB connection to get data from Events_Details table
        $adminDB = $db->getAdminDBConnection();
        // Query database for eid and get all details
        $query = "SELECT * FROM Event_Details WHERE " . $joinedEID . ";";
        // Prepare query statement
        $stmt = $adminDB->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch all rows
        $result = $stmt->fetchAll();

        return array($eidArray, $eids, $query1, $query, $result);
    }
}
