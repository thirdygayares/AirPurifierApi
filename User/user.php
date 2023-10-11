<?php


require_once   '../db.php';

class User {
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
 

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM user");
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $users = [];
            
            while ($user = $result->fetch_assoc()) {
                $users[] = $user;
            }
            
            return $users;
        }
    
        return null; // or handle error as needed
    }
    

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            return $user;
        }
    
        return null; // or handle error as needed
    }
    

    public function createUser($email, $fullName, $userName, $birthday, $position, $password) {
     
        $stmt = $this->db->prepare("INSERT INTO user (email,fullname,username,birthday,position,password) VALUES (?,?,?,?,?,?)");
       
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
       
        $stmt->bind_param("ssssss",$email,$fullName,$userName, $birthday,$position,$passwordHash );
        if($stmt->execute())
        return true; 
        return false; 

    }


    public function updateUser($id, $email, $fullName, $userName, $birthday, $position, $password) {
        $stmt = $this->db->prepare("UPDATE user SET email=?, fullname=?, username=?, birthday=?, position=?, password=? WHERE id=?");

        // Hash the password if it's provided
        $passwordHash = empty($password) ? null : password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("ssssssi", $email, $fullName, $userName, $birthday, $position, $passwordHash, $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
 

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, password, isAdmin FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
    
            if ($user && password_verify($password, $user['password'])) {
                // Password is correct
                return ['id' => $user['id'], 'isAdmin' => $user['isAdmin']];
            }
        }
    
        return null; // Invalid credentials or error
    }
    
    
}
