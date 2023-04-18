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
        <div class="chat-container">
            <div class="chat-display">
                <div class="chat-header">
                    <?php
                        if(!empty($_SESSION['profilePicture'])){
                            echo '<img class="chat-logo" src="./images/'.$_SESSION['profilePicture'].'" alt="userImage">';
                        } else {
                            echo '<img class="chat-logo" src="./images/default_user.png" alt="userImage">';
                        }
                    ?>
                    <div class="chat-info">
                        <span class="chat-name"><?php echo $_SESSION['username']; ?></span>
                        <span class="chat-state"><?php echo 'online'; ?></span>
                    </div>
                </div>
                <div class="chat-messages">

                </div>
                <div class="chat-sent">
                    <form action="">
                        <input type="text" name="message" />
                        <button type="submit">=</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>