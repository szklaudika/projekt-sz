<?php

global $conn;


if (isset($_POST["submit"])) {
    $name = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $lastname, $email, $password) !== false){
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if(emailExists($conn, $email) !== false){
        header("location: ../register.php?error=mailused");
        exit();
    }

    createUser($conn, $name, $lastname, $email, $password);


}
else {
    header("location: ../register.php");
}

