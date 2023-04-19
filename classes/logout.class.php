<?php
require '../config/DBConnection.php';

class Logout extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function setOffline($email){
        $query = "UPDATE users SET online = 0 WHERE email = :email;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);

        if(!$stmt->execute()){
            return false;
        } else {
            return true;
        }
    }
}