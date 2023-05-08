<?php
session_start();
function emptyInputSignup($name, $lastname, $email, $password): bool
{
    $result;
    if (empty($name) || empty($lastname) || empty($email) || empty($password)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email): bool
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email){
    $sql = "SELECT * FROM users WHERE user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        return false;
    }
}

function createUser($conn, $name, $lastname, $email, $password){
    $sql = "INSERT INTO users (user_name, user_lastname, user_email, user_password) 
                VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $lastname, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}

function emptyInputLogin($email, $password): bool
{
    $result;
    if (empty($email) || empty($password)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $password){
    $emailExists = emailExists($conn, $email);

    if($emailExists === false){
        header("location: ../user.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $emailExists["user_password"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false) {
        header("location: ../user.php?error=wronglogin");
        exit();
    }
    else session_start();
    $_SESSION["user_id"] = $emailExists["user_id"];
    $_SESSION["email"] = $emailExists["email"];
    header("location: ../index.php");
    exit();
}
