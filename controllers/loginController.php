<?php
if(isset($_POST['submit'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);

    $emptyInput = empty($email) || empty($password);

    if($emptyInput){
        header('Location: ../login.php?error=emptyInput');
        exit;
    }

    require '../config/autoloader.php';
    require '../classes/login.class.php';

    $login = new Login();

    $getUser = $login->getUser($email);
    if(!$getUser){
        header('Location: ../login.php?error=notFound');
        exit;
    }

    if(!password_verify($password, $getUser['password'])){
        header('Location: ../login.php?error=notMatch');
        exit;
    } else {
        $login->setOnline($email);
        session_start();
        $_SESSION['id'] = $getUser['id'];
        $_SESSION['reference'] = $getUser['reference'];
        $_SESSION['username'] = $getUser['username'];
        $_SESSION['email'] = $getUser['email'];
        $_SESSION['profilePicture'] = $getUser['profilePicture'];
        $_SESSION['online'] = $getUser['online'];
        header("Location: ../users.php");
    }
}

