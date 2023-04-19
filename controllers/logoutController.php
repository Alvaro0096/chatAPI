<?php
session_start();
require '../config/autoloader.php';
require '../classes/logout.class.php';
$logout = new Logout();
$logout->setOffline($_SESSION['email']);
session_unset();
session_destroy();
header("Location: ../login.php");