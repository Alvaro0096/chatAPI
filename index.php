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
                    <!-- The users info is inserted from chatHeaderControllers.php called by chat.js -->
                </div>
                <div class="chat-messages">
                    <!-- Messages get display from chatMessagesControllers.php called by chat.js -->
                </div>
                <div class="chat-sent">
                    <form id="messageForm">
                        <input type="text" id="sendMessage" class="send-message" placeholder="Send a message..."/>
                        <button type="submit" id="sendButton" value="sent">►</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="./js/chat.js"></script>
</html>