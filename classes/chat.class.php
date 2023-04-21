<?php
require '../config/DBConnection.php';

class Chat extends DBConnection{
    private $conn;
    
    public function __construct(){
        $this->conn = $this->getConnection();
    }

    public function getUser($reference){
        $query = "SELECT reference, username, online, profilePicture FROM users WHERE reference = :reference;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':reference', $reference);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count == 0){
            return false;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }

    public function saveMessage($senderMessage, $receiverMessage, $message = NULL){
        $query = "INSERT INTO messages
            SET
            senderMessage = :senderMessage,
            receiverMessage = :receiverMessage,
            message = :message,
            dateSend = NOW();";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':senderMessage', $senderMessage);
        $stmt->bindParam(':receiverMessage', $receiverMessage);
        $stmt->bindParam(':message', $message);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getMessages($senderMessage, $receiverMessage){
        $query = "SELECT senderMessage, receiverMessage, message, dateSend FROM messages 
            WHERE senderMessage = :senderMessage AND receiverMessage = :receiverMessage
            OR senderMessage = :receiverMessage AND receiverMessage = :senderMessage;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':senderMessage', $senderMessage);
        $stmt->bindParam(':receiverMessage', $receiverMessage);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count == 0){
            return false;
        } else {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }

    public function getReceiverUser($reference){
        $query = "SELECT profilePicture FROM users WHERE reference = :reference;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':reference', $reference);
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