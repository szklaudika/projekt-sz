<?php

if(isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($email, $password) !== false){
        header("location: ../user.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $email, $password);

}
else {
    header("location: ../login.php");
    exit();
}
