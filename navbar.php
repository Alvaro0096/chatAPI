<nav class="navbar">
    <div class="navbar-logo">
        <a href="users.php">ChatAPI</a>
    </div>
    <div class="navbar-items">
        <ul>
            <?php
                if(isset($_SESSION['id'])){
                    echo '<li class="nav-item"><a href="./controllers/logoutController.php"><span>Profile</span></a></li>';
                    echo '<li class="nav-item"><a href="./controllers/logoutController.php"><span>Log Out</span></a></li>';
                } else {
                    echo '<li class="nav-item"><a href="./login.php"><span>Sign In</span></a></li>';
                    echo '<li class="nav-item"><a href="./register.php"><span>Sign Up</span></a></li>';
                }
            ?>
        </ul>
    </div>
</nav>