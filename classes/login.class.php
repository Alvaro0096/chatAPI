<?php
require '../config/DBConnection.php';

class Login extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function getUser($email){
        $query = "SELECT id, reference, username, email, password, profilePicture, online FROM users WHERE email = :email;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count == 0){
            return false;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }

    public function setOnline($email){
        $query = "UPDATE users SET online = 1 WHERE email = :email;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);

        if(!$stmt->execute()){
            return false;
        } else {
            return true;
        }
    }
}