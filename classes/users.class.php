<?php
require '../config/DBConnection.php';

class Users extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function getAllUsers($id, $searchTerm = NULL){
        $query = "SELECT id, reference, username, email, profilePicture, online FROM users WHERE id != :id";

        if($searchTerm != NULL){
            $query .= " AND username LIKE '%".$searchTerm."%';";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count == 0){
            return false;
        } else {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }

    public function getUserChat($id){
        $query = "SELECT id, reference, username, email, profilePicture, online FROM users WHERE id = :id;";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
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