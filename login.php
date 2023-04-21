<?php
require './header.php';
?>
<body>
    <?php require 'navbar.php'; ?>
    <main class="main-container">
        <div class="form-container">
            <form action="./controllers/loginController.php" method="POST" autocomplete="OFF">
                <div class="input-container">
                    <!-- <label for="email">Email:</label> -->
                    <input type="email" id="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-container">
                    <!-- <label for="password">Password:</label> -->
                    <input type="password" id="password" name="password" placeholder="Password" required />
                </div>
                <div class="input-container">
                    <input class="submit-input" type="submit" name="submit" value="Send" />
                </div>
                <div class="forgot-link">
                    <a href="">Forgot your password?</a>
                </div>
                <?php
                    if(isset($_GET['error'])){
                        $errorMessage = '';
                        switch ($_GET['error']) {
                            case 'emptyInput':
                                $errorMessage = 'All fields must be complete';
                                break;

                            case 'notFound':
                                $errorMessage = 'No user found in the data base';
                                break;

                            case 'notMatch':
                                $errorMessage = 'Passwords do not match';
                                break;

                            case 'insert':
                                $errorMessage = 'Error trying to login user';
                                break;
                            
                            default:
                                $errorMessage = 'Error trying to login user';
                                break;
                        }

                        echo '
                            <div class="error-container">
                                <span>'.$errorMessage.'</span>
                            </div>
                        ';
                    }
                ?>
            </form>
        </div>
    </main>
</body>
</html>