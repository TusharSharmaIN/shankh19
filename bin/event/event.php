<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/config/database.php';

class Event
{
    // Private members
    private $eid;
    private $name;
    private $venue;
    private $date;
    private $time;
    private $type;
    private $status;

    // Constructor
    public function __construct($eid)
    {
        $this->eid = $eid;
    }

    // Public methods
    // Getters
    public function getEID()
    {
        return $this->eid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Function to return all details of an event in JSON format
    public function getEventJSON()
    {
        $event = array(
            "eid" => $this->eid,
            "name" => $this->name,
            "venue" => $this->venue,
            "date" => $this->date,
            "time" => $this->time,
            "type" => $this->type,
            "status" => $this->status
        );
        $eventJSON = json_encode($event);
        return $eventJSON;
    }

    // Function to fill all remaining variables from database
    public function fillDetailsFromDB()
    {
        // Create a db instance
        $db = new Database();
        // Create an admin DB connection to get data from Events_Details table
        $adminDB = $db->getAdminDBConnection();
        // Query database for eid and get all details
        $query = "SELECT * FROM Event_Details WHERE EID='" . $this->eid . "';";
        // Prepare query statement
        $stmt = $adminDB->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();
        // If no row has been returned
        if ($result == false) {
            return false;
        }
        // Fill details
        $this->name = $result['Name'];
        $this->venue = $result['Venue'];
        $this->date = $result['DOE'];
        $this->time = $result['TOE'];
        $this->type = $result['Type'];
        $this->status = $result['Status'];
        return true;
    }

    // Register a user for this event
    public function registerUser($email)
    {
        // Create a db instance
        $db = new Database();
        // Create a user DB connection to get data from User_Event_Details table
        $userDB = $db->getUserDBConnection();
        // Query database for eid and get all details
        $query = "INSERT INTO User_Event_Details (Email, EID) VALUES (:email, :eid);";
        // Prepare query statement
        $stmt = $userDB->prepare($query);
        // Bind values
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":eid", $this->eid);
        // Execute query
        if ($stmt->execute()) {
            // Registration successful
            return true;
        }
        return false;
    }

    // Check if a user is registered for this event
    public function isRegistered($email)
    {
        // Create a db instance
        $db = new Database();
        // Create a user DB connection to get data from User_Event_Details table
        $userDB = $db->getUserDBConnection();
        // Query database for eid and get all details
        $query = "SELECT * FROM User_Event_Details WHERE Email='" . $email . "' AND EID='" . $this->eid . "';";
        // Prepare query statement
        $stmt = $userDB->prepare($query);
        // Execute query
        $stmt->execute();
        // Fetch a row
        $result = $stmt->fetch();
        // If no row has been returned
        if ($result == false) {
            return false;
        }
        return true;
    }
}
