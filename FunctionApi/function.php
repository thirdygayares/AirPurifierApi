<?php


require_once   '../db.php';

class FunctionAirPurifier {
    private $db;

    function __construct()
    {
        //Getting the DbConnect.php file
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->db = $db->connect();
    }
 

    

    public function getAirPurifierData() {
        $stmt = $this->db->prepare("SELECT * FROM airpurifier WHERE id = 1");
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $purify = $result->fetch_assoc();
            return $purify;
        }
    
        return null; // or handle error as needed
    }
    

    public function updateAirPurifierPower($power) {
        $stmt = $this->db->prepare("UPDATE airpurifier SET power=? WHERE id=1");

        $stmt->bind_param("s", $power);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
 
    public function updateAirPurifierLevel($level) {
        $stmt = $this->db->prepare("UPDATE airpurifier SET level=? WHERE id=1");

        $stmt->bind_param("s", $level);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateAirPurifierHumidity($humidity) {
        $stmt = $this->db->prepare("UPDATE airpurifier SET humidity=? WHERE id=1");

        $stmt->bind_param("s", $humidity);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
 
 
    
    
}
