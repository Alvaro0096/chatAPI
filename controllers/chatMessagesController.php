<?php
session_start();
require '../config/autoloader.php';
require '../classes/chat.class.php';

$senderMessage = $_SESSION['reference'];
$receiverMessage = $_GET['user'];

$chatMessages = new Chat();
$getMessages = $chatMessages->getMessages($senderMessage, $receiverMessage);

if(!$getMessages){
    echo '';
    exit;
}

$return = '';
for($i = 0; $i < count($getMessages); $i++){
    if($getMessages[$i]['senderMessage'] === $senderMessage){
        $return = '
            <div class="outgoin-message">
            <div class="details">
                    <p>'.$getMessages[$i]['message'].'</p>
                </div>
            </div>
        ';
        echo $return;
    } else {
        $profilePicture = 'default_user.png';
        $return = '
            <div class="incoming-message">
                <img class="incoming-message-logo" src="./images/'.$profilePicture.'" alt="userImage">
                <div class="details">
                    <p>'.$getMessages[$i]['message'].'</p>
                </div>
            </div>
        ';
        echo $return;
    }
}