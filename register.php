<?php
session_start();
global $conn;
include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        header('location:register.php?error=passwords dont match');
    } else if (strlen($password) < 6) {
        header('location: register.php?error=password must be at least 6 characters long');
    } //if there is no error
    else {
        //check whether there is a user with this email or not
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        //if there is a user already registered with this email
        if ($num_rows != 0) {
            header('location: register.php?error=user with this email already exists');
        } else {
            //create a new user
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
           VALUES (?,?,?)");

            $md5 = md5($password);
            $stmt->bind_param('sss', $name, $email, $md5);

            if($stmt->execute()){
                $$user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=You registered successfully');
            }else{
                header('location: register.php?error=could not create an account at the moment');
            }
        }
    }
}

?>


<?php
include_once 'header.php';
?>


<div class="item-details-page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <div class="section-heading text-center">
                    <div class="line-dec"></div>
                    <h2><em>Register</em></h2>
                </div>
                <form class="needs-validation" action="register.php" method="POST">
                    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="register-name" name="name" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="registration-email" name="email" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" required>
                        <div class="invalid-feedback">
                            Please re-enter your password.
                        </div>
                    </div>
                    <p>Already have an account? <a href="user.php" class="link-info">Log in here</a></p>
                    <br><br>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'footer.php';
?>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script>
    const form = document.getElementById('registration-form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');

    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }

        // Validate name
        if (nameInput.value.trim() === '') {
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }

        // Validate email
        if (emailInput.checkValidity() === false) {
            emailInput.classList.add('is-invalid');
        } else {
            emailInput.classList.remove('is-invalid');
        }

        // Validate password
        if (passwordInput.value.trim() === '') {
            passwordInput.classList.add('is-invalid');
        } else {
            passwordInput.classList.remove('is-invalid');
        }

        // Validate confirm password
        if (confirmPasswordInput.value.trim() === '' || confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordInput.classList.add('is-invalid');
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
        }
    });


