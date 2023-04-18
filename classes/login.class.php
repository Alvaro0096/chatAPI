<?php
require '../config/DBConnection.php';

class Login extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function getUser($email){
        $query = "SELECT id, username, email, password, profilePicture FROM users WHERE email = :email;";

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
}