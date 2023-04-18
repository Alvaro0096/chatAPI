<?php
if(isset($_POST['submit'])){
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    $emptyInput = empty($username) || empty($email) || empty($password) || empty($confirmPassword);

    if($emptyInput){
        header('Location: ../register.php?error=emptyInput');
        exit;
    }

    if (!preg_match("/^[a-zA-Z0-9_-]*$/", $username)) {
        header("Location: ../register.php?error=invalidUsername");
        exit;
    }

    // One upper letter, one lower letter, 8 of lenght
    // if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z]).{8,}$/", $password)) {
    //     header("Location: ../register.php?error=invalidPassword");
    //     exit;
    // }

    if($password !== $confirmPassword){
        header("Location: ../register.php?error=notMatch");
        exit;
    }
    
    $profilePicture = NULL;
    if($_FILES['userImage']['size'] > 0){
        $file = $_FILES['userImage'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExtension = explode('.', $fileName);
        $fileActualExtension = strtolower(end($fileExtension));
        
        $allowed = ['jpg', 'jpeg', 'png'];
        if(!in_array($fileActualExtension, $allowed)){
            header("Location: ../register.php?error=extImage");
            exit;
        }

        if($fileError !== 0){
            header("Location: ../register.php?error=errorImage");
            exit;
        }

        if($fileSize > 10000000){
            header("Location: ../register.php?error=sizeImage");
            exit;
        }

        $fileNewName = uniqid('', true).".".$fileActualExtension;
        $fileDestination = '../images/'.$fileNewName;
        move_uploaded_file($fileTmpName, $fileDestination);

        $profilePicture = $fileNewName;
    }

    require '../config/autoloader.php';
    require '../classes/register.class.php';

    $register = new Register();

    $checkRepeatUser = $register->checkRepeatUser($email);
    if($checkRepeatUser){
        header("Location: ../register.php?error=repeatUser");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $insertUser = $register->insertUser($username, $email, $password_hash, $profilePicture);
    if($insertUser){
        $getUser = $register->getUser($email);
        session_start();
        $_SESSION['id'] = $getUser['id'];
        $_SESSION['username'] = $getUser['username'];
        $_SESSION['email'] = $getUser['email'];
        $_SESSION['profilePicture'] = $getUser['profilePicture'];
        header("Location: ../users.php");
    } else {
        header("Location: ../register.php?error=insert");
        exit;
    }
}