<?php
require '../config/DBConnection.php';

class Register extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function insertUser($reference, $username, $email, $password, $online = 1, $profilePicture = NULL){
        $query = "INSERT INTO users 
            SET 
            reference = :reference,
            username = :username,
            email = :email,
            password = :password,
            online = :online";

        if($profilePicture != NULL){
            $query .= ", profilePicture = :profilePicture;";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':online', $online);

        $profilePicture != NULL ? $stmt->bindParam(':profilePicture', $profilePicture) : "";

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function checkRepeatUser($email){
        $query = "SELECT email FROM users WHERE email = :email;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $count = $stmt->rowCount();

        if($count > 0){
            return true;
        }
    }

    public function getUser($email){
        $query = "SELECT id, reference, username, email, profilePicture, online FROM users WHERE email = :email;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);

        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    }
}