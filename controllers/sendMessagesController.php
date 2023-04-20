<?php
session_start();
require '../config/autoloader.php';
require '../classes/chat.class.php';

if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Location: ../index.php?error=method');
    exit;
}

$senderMessage = $_SESSION['reference'];
$receiverMessage = $_GET['user'];
$message = htmlspecialchars($_POST['sentedMessage']);

if(empty($senderMessage) || empty($receiverMessage)){
    header('Location: ../index.php?error=usersIden');
    exit;
}

$chatMessages = new Chat();
$saveMessage = $chatMessages->saveMessage($senderMessage, $receiverMessage, $message);
if(!$saveMessage){
    header('Location: ../index.php?error=send');
    exit;
}