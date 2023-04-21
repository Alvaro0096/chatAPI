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
    $bubbleActive = 'bubbleInactive';

    if(!empty($userData['profilePicture'])){
        $profilePicture = $userData['profilePicture'];
    }
    if($userData['online'] == 1){
        $online = 'Active Now';
        $bubbleActive = 'bubbleActive';
    }
    
    $return = '
        <img class="chat-logo" src="./images/'.$profilePicture.'" alt="userImage">
        <div class="chat-info">
            <span class="chat-name">'.$userData['username'].'</span>
            <div class="chat-state">
                <span>'.$online.'</span>
                <span class="'.$bubbleActive.'"></span>
            </div>
        </div>
    ';

    echo $return;
}