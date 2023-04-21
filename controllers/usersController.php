<?php
session_start();
require '../config/autoloader.php';
require '../classes/users.class.php';

$getUsers = new Users();
$searchTerm = '';
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
}

$usersList = $getUsers->getAllUsers($_SESSION['id'], $searchTerm);

$return = '';
if(!$usersList){
    $return = '
        <div class="noUsersFound">
            <span>No users found</span>
        </div>
    ';
    echo $return;
} else {
    for($i = 0; $i < count($usersList); $i++){
        $profilePicture = 'default_user.png';
        $online = 'Not available';
        $bubbleActive = 'bubbleInactive';

        if(!empty($usersList[$i]['profilePicture'])){
            $profilePicture = $usersList[$i]['profilePicture'];
        }
        if($usersList[$i]['online'] == 1){
            $online = 'Active Now';
            $bubbleActive = 'bubbleActive';
        }
        
        $return .= '
            <a href="index.php?user='.$usersList[$i]['reference'].'" class="users-link-container">
                <img class="users-available-logo" src="./images/'.$profilePicture.'" alt="userImage">
                <div class="users-available-info">
                    <span class="users-available-name">'.$usersList[$i]['username'].'</span>
                    <div class="users-available-state">
                        <span>'.$online.'</span>
                        <span class="'.$bubbleActive.'"></span>
                    </div>
                </div>
            </a>
        ';
    }
    echo $return;
}