<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ./login.php");
    exit;
}
require './header.php';
?>
<body>
    <?php require 'navbar.php'; ?>
    <main class="main-container">
        <div class="users-container">
            <div class="users-header">
                <?php
                    if(!empty($_SESSION['profilePicture'])){
                        echo '<img class="users-logo" src="./images/'.$_SESSION['profilePicture'].'" alt="userImage">';
                    } else {
                        echo '<img class="users-logo" src="./images/default_user.png" alt="userImage">';
                    }
                ?>
                <div class="users-info">
                    <span class="users-name"><?php echo $_SESSION['username']; ?></span>
                </div>
            </div>
            <div class="users-search">
                <input type="text" id="usersInput" class="users-input" placeholder="Search available users...">
            </div>
            <div class="users-available">
                <!-- The users are inserted from usersControllers.php called by users.js -->
            </div>
        </div>
    </main>
</body>
<script src="./js/users.js"></script>
</html>