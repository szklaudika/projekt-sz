<?php

session_start();

if(isset($_GET['admin_logout']) && $_GET['admin_logout'] == 1){
    if(isset($_SESSION['admin_logged_in'])){
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_name']);
        header('location: admin_login.php ');
        exit();
    }
}