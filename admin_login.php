<?php
session_start();
global $conn;
include('server/connection.php');

if(isset($_SESSION["admin_logged_in"])){
    header("location: admin_panel.php");
    exit();
}

if(isset($_POST["admin_login_btn"])){

    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email=? AND admin_password=?");

    $stmt->bind_param("ss", $email, $password);

    if($stmt->execute()){
        $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
        $stmt->store_result();

        if($stmt->num_rows()==1){
            $stmt->fetch();

            $_SESSION["admin_id"] = $admin_id;
            $_SESSION["admin_name"] = $admin_name;
            $_SESSION["admin_email"] = $admin_email;
            $_SESSION["admin_logged_in"] = true;

            header("location: admin_panel.php?login_success=Logged in successfully");

        }else{
            header("location: admin_login.php?error=Could not verify your account");
        }

    }else{
        //error
        header("location: admin_login.php?error=Something went wrong");

    }
}


include_once 'admin_header.php';
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
                        <form class="needs-validation" id="login-form" method="POST" action="admin_login.php">
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

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="admin_login_btn">Login</button>

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