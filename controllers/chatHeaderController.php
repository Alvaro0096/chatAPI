<?php
require '../config/autoloader.php';
require '../classes/chat.class.php';

$chatUser = new Chat();
if (!isset($_GET['user'])) {
    header("Location: ../users.php?error=notFound");
    exit;
}

$userData = $chatUser->getUser($_GET['user']);

if(!$userData){
    header("Location: ../users.php?error=notFound");
    exit;
} else {
    $profilePicture = 'default_user.png';
    $online = 'Not available';

    if(!empty($userData['profilePicture'])){
        $profilePicture = $userData['profilePicture'];
    }
    if($userData['online'] == 1){
        $online = 'Active Now';
    }
    
    $return = '
        <img class="chat-logo" src="./images/'.$profilePicture.'" alt="userImage">
        <div class="chat-info">
            <span class="chat-name">'.$userData['username'].'</span>
            <span class="chat-state">'.$online.'</span>
        </div>
    ';

    echo $return;
}