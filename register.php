<?php
require './header.php';
?>
<body>
    <?php require 'navbar.php'; ?>
    <main class="main-container">
        <div class="form-container">
            <form action="./controllers/registerController.php" method="POST" enctype="multipart/form-data" autocomplete="OFF">
                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Username" required />
                </div>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required />
                </div>
                <div class="input-container">
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required />
                </div>
                <div class="input-container">
                    <input type="file" id="userImage" name="userImage" />
                </div>
                <div class="input-container">
                    <input class="submit-input" type="submit" name="submit" value="Send" />
                </div>
                <?php
                    if(isset($_GET['error'])){
                        $errorMessage = '';
                        switch ($_GET['error']) {
                            case 'emptyInput':
                                $errorMessage = 'All fields must be complete';
                                break;

                            case 'invalidUsername':
                                $errorMessage = 'The username has forbidden characters';
                                break;

                            case 'invalidPassword':
                                $errorMessage = 'The password must have one uppercase letter, one lowercase letter and a minimum of 8 characters';
                                break;

                            case 'notMatch':
                                $errorMessage = 'Passwords do not match';
                                break;

                            case 'repeatUser':
                                $errorMessage = 'User already exists';
                                break;

                            case 'extImage':
                                $errorMessage = 'The image extension is not allowed';
                                break;
                            
                            case 'errorImage':
                                $errorMessage = 'There is an error with the image';
                                break;

                            case 'sizeImage':
                                $errorMessage = 'The size of the image has to be less than 10 MB';
                                break;

                            case 'insert':
                                $errorMessage = 'Error inserting the user in the data base';
                                break;
                            
                            default:
                                $errorMessage = 'Error trying to register user';
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