<?php

global $conn;
session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=logged in successfully');

        }else{
            header('location: user.php?error=could not verify your account');
        }

    }else{
        header('location: user.php?error=no account with this info');
    }
}
?>

<?php
include_once 'header.php';
?>


<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2><em>Login</em></h2>
                </div>
            </div>
            <div class="container my-5">
                <div class="row justify-content-center text-center">
                    <div class="col-md-6">
                        <form class="needs-validation" id="login-form" method="POST" action="user.php">
                            <p style="color: red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="" required>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                            <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="login_btn">Login</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        display: inline-block;
        width: 400px;
        margin-bottom: 0.5rem;
    }

    .form-control {
        display: inline-block;
        width: 250px;
        vertical-align: middle;
    }
</style>



<?php
include_once 'footer.php';
?>

<style>
    .form-control {
        width: 1%;

    }
</style>

<script>
    // Bootstrap validation
    (function() {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
